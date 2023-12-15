# HTTP interceptors

Sometimes it happens that you need to perform some additional checks before sending the request, for example, make sure you protect your form with CSRF or use authorization header, etc.

For that purpose there is a way to perform some actions before and after the request.

You can define the interceptor as a class that implements `Viewi\Components\Http\Interceptor\IHttpInterceptor` interface:

```php
interface IHttpInterceptor
{
    function request(Request $request, IRequestHandler $handler);
    function response(Response $response, IResponseHandler $handler);
}
```

### Request method

`request` is used for intercepting request before it get send to the server. It provides a current `Request` instance and a handler that you can use to either continue the request or reject it:

```php
public function request(Request $request, IRequestHandler $handler)
{
    $handler->next($request);
    // OR
    $handler->reject($request);
}
```

Rejecting the request will prevent it from being sent to the server.

Also, HTTP client will proceed with error handler instead of success handler.

### Response method

`response` is used for intercepting response after receiving it from the server. It provides a current `Response` instance and a handler that you can use to either continue response handling or reject it:

```php
public function response(Response $response, IResponseHandler $handler)
{
    $handler->next($response);
    // OR
    $handler->reject($response);
}
```

Rejecting the response will prevent it from being sent to the server.

Also, HTTP client will proceed with error handler instead of success handler.

### Interceptor Example

**It is recommended to make interceptors as singletons**

This example shows you how to send additional header in the request.

Also we will replace original response and set it to `Access denied`.

```php
<?php

namespace Components\Services\Interceptors;

use Viewi\Components\Http\Interceptor\IHttpInterceptor;
use Viewi\Components\Http\Interceptor\IRequestHandler;
use Viewi\Components\Http\Interceptor\IResponseHandler;
use Viewi\Components\Http\Message\Request;
use Viewi\Components\Http\Message\Response;
use Viewi\DI\Singleton;

#[Singleton]
class ExampleInterceptor implements IHttpInterceptor
{
    public function request(Request $request, IRequestHandler $handler)
    {
        // modify/clone request
        $newRequest = $request->withHeader('X-Test-ID', 'mytoken');
        $handler->next($newRequest);
    }

    public function response(Response $response, IResponseHandler $handler)
    {
        // modify response
        $nextResponse = $response->withBody('Access denied')->withStatus(400);
        $handler->next($nextResponse);
    }
}
```

### Using interceptors

Once you have defined your interceptor, you can use it with your HTTP client:

```php
$this->http
    ->withInterceptor(ExampleInterceptor::class)
    ->get("/api/post/1")
    ->then(function (?PostModel $post) {
        // success handler
        $this->post = $post;
    }, function () {
        // error handler
    });
```

You can use as many interceptors as you want within the same request.

Using interceptors is useful for logging or even for mocking the server.

Simulating the server, no real HTTP call will be made:

```php
public function request(Request $request, IRequestHandler $handler)
{
    $handler->reject($request);
}

public function response(Response $response, IResponseHandler $handler)
{
    $response->status = 200; // to avoid failing
    $response->body = new PostModel();
    $response->body->id = 1;
    $response->body->name = 'My post #1';
    $handler->next($response);
}
```

### CSRF token interceptor example

```php
<?php

namespace Components\Services\Interceptors;

use Components\Models\PostModel;
use Viewi\Components\Http\HttpClient;
use Viewi\Components\Http\Interceptor\IHttpInterceptor;
use Viewi\Components\Http\Interceptor\IRequestHandler;
use Viewi\Components\Http\Interceptor\IResponseHandler;
use Viewi\Components\Http\Message\Request;
use Viewi\Components\Http\Message\Response;
use Viewi\DI\Singleton;

#[Singleton]
class SessionInterceptor implements IHttpInterceptor
{
    private ?string $CSRFToken = null;
    public function __construct(private HttpClient $http)
    {
    }

    public function request(Request $request, IRequestHandler $handler)
    {
        if ($this->CSRFToken === null) {
            $this->http->post("/api/session")
                ->then(function ($session) use ($request, $handler) {
                    $this->CSRFToken = $session['CSRFToken'];
                    $this->handleRequest($request, $handler);
                }, function () use ($request, $handler) {
                    $handler->reject($request);
                });
        } else {
            $this->handleRequest($request, $handler);
        }
    }

    private function handleRequest(Request $request, IRequestHandler $handler)
    {
        // modify the request
        $newRequest = $request->withHeader('X-CSRF-TOKEN', $this->CSRFToken);
        $handler->next($newRequest);
    }

    public function response(Response $response, IResponseHandler $handler)
    {
        $handler->next($response);
    }
}
```
