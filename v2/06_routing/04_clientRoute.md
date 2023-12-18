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