# Guards and Middleware

Viewi provides you a mechanism to run additional code logic before navigating to a certain route. You can either allow a navigation or cancel it.

## Implementation

To implement a middleware simply create a class that implements `Viewi\Components\Middleware\IMIddleware` interface:

```php
interface IMIddleware
{
    function run(IMIddlewareContext $c);
}
```

Where `IMIddlewareContext` is:

```php
interface IMIddlewareContext
{
    function next(bool $allow = true);
}
```

For example:

```php
<?php

namespace Components\Services\Middleware;

use Viewi\Components\Middleware\IMIddleware;
use Viewi\Components\Middleware\IMIddlewareContext;
use Viewi\Components\Routing\ClientRoute;
use Viewi\DI\Singleton;

#[Singleton]
class MemberGuard implements IMIddleware
{
    public function __construct(private ClientRoute $route)
    {
    }

    public function run(IMIddlewareContext $c)
    {
        $c->next();
        // OR cancel the navigation and redirect
        $c->next(false); // cancel
        $this->route->navigate('/'); // redirect
    }
}
```

## Using a middleware

Now you can use it with by setting a `Viewi\Components\Attributes\Middleware` attribute for your component and providing a list of middleware classes:

`#[Middleware([MemberGuard::class])]`

```php
<?php

namespace Components\Views\Pages;

use Components\Services\Middleware\MemberGuard;
use Viewi\Components\Attributes\Middleware;
use Viewi\Components\BaseComponent;

#[Middleware([MemberGuard::class])]
class MemberPage extends BaseComponent
{
}
```

```php
$router->get('/member', MemberPage::class);
```

Now every time you navigate to this component the additional logic will be executed before making the actual navigation.

You can chain as many middleware guards as you want.