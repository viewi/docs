# Routing

## Basics

Viewi has built in routing support. And if you are familiar with at least one the popular PHP frameworks, you will find it very familiar. So, let's dig into. 

Your routes are defined in the file `\viewi-app\routes.php`. This file has access to the current application instance `Viewi\App $app`, which has its own router:

```php
<?php

use Viewi\App;
use Components\Views\Home\HomePage;

/**
 * @var App $app
 */
$router = $app->router();
$router->get('/', HomePage::class);
```

## Available route methods

You can register your component under any HTTP verb and it will be executed accordingly once url pattern has been matched.

```php
$router->get(string $url, $action, ?array $defaults = null, array $wheres = []);
$router->post(string $url, $action, ?array $defaults = null, array $wheres = []);
$router->put(string $url, $action, ?array $defaults = null, array $wheres = []);
$router->delete(string $url, $action, ?array $defaults = null, array $wheres = []);
$router->patch(string $url, $action, ?array $defaults = null, array $wheres = []);
$router->options(string $url, $action, ?array $defaults = null, array $wheres = []);

// Matches any verb
$router->all(string $url, $action, ?array $defaults = null, array $wheres = []);

// Register method on your own
$router->register(string $method, string $url, $action, ?array $defaults = null, array $wheres = []);
```

**Please note**, Viewi router supports your custom callable for standalone use.

```php
$router->get('/api/post/{id}', function (int $id) {
    $post = new PostModel();
    $post->id = $id;
    $post->name = 'View Post Demo';
    return $post;
});
```

## Route parameters

### Required parameter

`{param}` captures required segment from the URI and injects it into your component in place of parameter with the same name. Order doesn't matter. For example:

```php
$router->get('/post/{id}', PostPage::class);
```

```php
class PostPage extends BaseComponent
{
    public function __construct(private HttpClient $http, public int $id)
    {
        // id is available here
    }
}
```

### Optional parameter

`{param?}` captures optional segment from the URI and injects it into your component in place of parameter with the same name. In case if segment is empty, default or null value will be injected. Order doesn't matter. For example:

```php
$router->get('/post/{id?}', PostPage::class);
```

```php
class PostPage extends BaseComponent
{
    public function __construct(private HttpClient $http, public ?int $id = null)
    {
        // id is available here if present, otherwise NULL
    }
}
```

### Constraint rules

Method `where` and argument `$wheres` set constraint rules (regular expression constrains). Additionally you can use URL segment rules with `{param<regex>}`.

```php
$router->get('/post/{id}', PostPage::class)->where('id', '\\d+');
// OR all at once
$router->get('/post/{id}', PostPage::class)->where(['id' => '\\d+']);
// OR as argument
$router->get('/post/{id}', PostPage::class, null, ['id' => '\\d+']);
// OR as URL segment rule
$router->get('/post/{id<\\d+>}', PostPage::class);
```

**Segments allowed to contain all characters except `/`. But you can explicitly allow any character by using `where`.**

```php
// ignore '/'
$router->get('/search/{search}', SearchPage::class)->where('search', '.*');
```

## Transform

To modify your response from Viewi you can use `transform` method. Use case: send proper status code for `NotFoundPage` component:

```php
$router
    ->get('*', NotFoundPage::class)
    ->transform(function (Response $response) {
        return $response->withStatus(404, 'Not Found');
    });
```

## Route sections

You can group routes with similar prefixes:

```php
$router->get('/admin', Dashboard::class);
$router->get('/admin/content', PageList::class);
```

Same as:

```php
$router->section('admin', function (Router $router) {
    $router->get('/', Dashboard::class);
    $router->get('/content', PageList::class);
}
```

## Mark route as lazy

If you want to separate routes into multiple asset bundles, you can use `lazy` grouping method:

```php
$router->lazy('admin', function (Router $router) {
    $router->get('/admin', Dashboard::class);
    $router->get('/admin/content', PageList::class);
});
```

Now these components will be loaded only if you navigate to any of these routes.

Same effect can get with `LazyLoad` attribute.

## Priority

You can set priority of the route, the higher priority - the faster it can be resolved. And the opposite, the lower priority will make sure that route will be resolved last. By default, priority is set to `0`.

For example, `ContentPage` component is handling every `GET` request. And we do not want it to override any other route, so we make it with lower priority.

```php
$router
    ->get('*', ContentPage::class)
    ->priority(-100);
```

## More examples

```php
// optional 'query' with constraint
$router->get('/post/{type}/{query<[A-Za-z]+>?}', PostPage::class);
// wildcard for all URLs that start with '/docs'
$router->get('/docs/*', DocsPage::class);
```