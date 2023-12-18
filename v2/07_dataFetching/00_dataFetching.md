# Data Fetching and HTTP client

Data fetching is an essential part of any modern web application. In Viewi it can be handled by using `Viewi\Components\Http\HttpClient`. 

## Using

Just inject it in your component or service and you are good to go. Like this:

```php
class PostPage extends BaseComponent
{
    public function __construct(private HttpClient $http)
    {
    }
}
```

### Making requests

To make a request simply use appropriate method and provide URL with data id needed:

```php
class PostPage extends BaseComponent
{
    public ?PostModel $post = null;
    public string $email = '';
    public string $name = '';
    public string $message = '';

    public function __construct(private HttpClient $http)
    {
    }

    public function init()
    {
        $this->http
            ->get("/api/post/1")
            ->then(function (?PostModel $post) {
                $this->post = $post;
            }, function () {
                // handle error
            });

        $this->http
            ->post("/api/contact-us", [
                'email' => $this->email,
                'name' => $this->name,
                'message' => $this->message
            ])
            ->then(function ($response) {
                // message has been sent successfully
            }, function () {
                // handle error
            });
    }
}
```

**Remember**: this is your font-end and in the browser your response is a plain JSON object. `PostModel $post` is used only for server-side rendering and autocomplete suggestions during development.

This will throw an error in the browser:

```php
 $this->http
    ->get("/api/post/1")
    ->then(function (?PostModel $post) {
        // This will throw an error in the browser
        // since JSON object does not have such method
        $post->getMetaTags();
    }, function () {
        // handle error
    });
```

**Remember**: In order to receive `PostModel $post` as a response, your backend needs to provide a mechanism to extract this class instance from the response. Most of the frameworks can do that so you do not have to worry about it. Worse case: you can always use associative array or not typed response:

```php
 $this->http
    ->get("/api/post/1")
    ->then(function ($post) {
        $this->post = $post;
    }, function () {
        // handle error
    });
```

### Supported methods

```php
$httpClient->get(string $url, ?array $headers = null): Resolver;
$httpClient->post(string $url, $body = null, ?array $headers = null): Resolver;
$httpClient->put(string $url, $body = null, ?array $headers = null): Resolver;
$httpClient->delete(string $url, $body = null, ?array $headers = null): Resolver;
$httpClient->patch(string $url, $body = null, ?array $headers = null): Resolver;
$httpClient->request(string $method, string $url, $body = null, ?array $headers = null): Resolver;
```

### Response callbacks

To register callbacks simply defined them with `then`:

```php
 $httpCall->then(callable $onSuccess, callable $onError = null, callable $always = null);
```

### Caching data during server-side rendering

All your requests that were made on the server during SSR are being cached and sent with the initial HTML page.

This allows you to efficiently run the hydration process on the client-side by reusing cached requests.

After the application is activated, further requests will be made as usual.