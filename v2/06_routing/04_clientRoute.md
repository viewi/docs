# Client route

`ClientRoute` is a singleton service that can help you with navigation, URL information, and query parameters.

```php
class ClientRoute
{
    public function navigateBack(): void;
    public function navigate(string $url): void;
    public function getUrl(): ?string;
    public function getUrlPath(): ?string;
    public function getQueryParams(): array;
    public function urlWatcher(): Subscriber;
}
```

`navigateBack` - navigates to a previous page.

`navigate` - navigates to a specific URL.

`getUrl` - returns the current URL.

`getUrlPath` - return current URL path without query parameters.

`getQueryParams` - returns query parameters as an array.

Useful for middleware guard or query filters.

```php
<?php

namespace Components\Services\Middleware;

use Viewi\Components\Middleware\IMIddleware;
use Viewi\Components\Middleware\IMIddlewareContext;
use Viewi\Components\Routing\ClientRoute;
use Viewi\DI\Singleton;

#[Singleton]
class MemberGuardNoAccess implements IMIddleware
{
    public function __construct(private ClientRoute $route)
    {
    }

    public function run(IMIddlewareContext $c)
    {
        $c->next(false); // user does not have access
        $this->route->navigate('/login'); // redirect to the login page
    }
}
```

## Watch URL change and get notified

```php
class MyComponent implements BaseComponent
{
    public string $activeLink = '';
    public ?Subscription $pathSubscription = null;

    public function __construct(private ClientRoute $route)
    {
    }

    public function init()
    {
        $this->pathSubscription = $this->route->urlWatcher()->subscribe(function (string $urlPath) {
            $this->activeLink = $urlPath;
        });
    }

    public function destroy()
    {
        $this->pathSubscription->unsubscribe();
    }
```

## Set response status for SSR

You can set the response status code from your component.

For example, if some data does not exist in your database, you would want to return the component with `404` status code:

```php
class ContentPage extends BaseComponent
{
    //...
    public function init()
    {
        $this->http->get("/api/content?path=my-page")
            ->then(function (?PageModel $page) {
                $this->page = $page;
            }, function (Response $response) {
                if ($response && $response->status) {
                    if ($response->status === 404) {
                        $this->title = "Page not found";
                        $this->route->setResponseStatus(404);
                    }
                }
            });
    }
```