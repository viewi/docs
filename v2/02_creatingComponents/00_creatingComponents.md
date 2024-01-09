# Creating Components

## Creating a simple component

To create a new component all you have to do is just to create two files in your components folder (`viewi-app/Components` and its sub folders): `.html` for template and `.php` for code logic.

**Please note:** both files should be in the same folder and should have the same base name.

Inside your php file create a class derived from `Viewi\Components\BaseComponent`.

For example, let's create a `Counter` component.

`viewi-app/Components/Views/Counter/Counter.php`

```php
<?php

namespace Components\Views\Counter;

use Viewi\Components\BaseComponent;

class Counter extends BaseComponent
{
    public int $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
}
```

`viewi-app/Components/Views/Counter/Counter.html`

```html
<button (click)="decrement()" class="mui-btn mui-btn--accent">-</button>
<span class="mui--text-dark mui--text-title">$count</span>
<button (click)="increment()" class="mui-btn mui-btn--accent">+</button>
```

Now you can use it as a tag in any other component's template: `<Counter />`


**Please note:** Class name should match the tag name and therefore should be unique across all the application.

## Creating component with Layout

Layouts are components that have `html` tag and special tag `<slot>` for placing the content of parent component. For example:

`viewi-app/Components/Views/Layouts/Layout.html`

```html
<!DOCTYPE html>
<html lang="en">

<head>
    <title>$title</title>
</head>

<body>
    <div id="content">
        <slot></slot>
    </div>
    <ViewiAssetss />
</body>

</html>
```

`viewi-app/Components/Views/Layouts/Layout.php`

```php
<?php

namespace Components\Views\Layouts;

use Viewi\Components\BaseComponent;

class Layout extends BaseComponent
{
    public string $title = 'Viewi'; // default title
}
```

And then any other components can reuse it like this:

```html
<Layout title="$title">
    <h1>$title</h1>
</Layout>
```

Here `<h1>$title</h1>` will be placed instead of `<slot></slot>` in your Layout component. Also you can pass properties `title="$title"` to the Layout so it can use it in its code logic or render in its template.

`ViewiAssetss` is a special component that is responsible for reactivity in browser. It is optional and can be omitted if you do not wish to have reactive application in your browser. For example, for rendering emails, etc.

## Creating a CounterPage component

Now let us create a CounterPage component.

`viewi-app/Components/Views/Pages/CounterPage.php`

```php
<?php

namespace Components\Views\Pages;

use Viewi\Components\BaseComponent;

class CounterPage extends BaseComponent
{
}
```

`viewi-app/Components/Views/Pages/CounterPage.html`

```html
<Layout title="Counter">
    <h1>Counter</h1>
    <div class="mui-container-fluid">
        <Counter />
    </div>
</Layout>
```

If you render `CounterPage` component, the result will be next:

```html
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Counter</title>
</head>

<body>
    <div id="content">
        <h1>Counter</h1>
        <div class="mui-container-fluid">
            <button class="mui-btn mui-btn--accent">-</button>
            <span class="mui--text-dark mui--text-title">0</span>
            <button class="mui-btn mui-btn--accent">+</button>
        </div>
    </div>
    <script async defer src="/viewi-default/viewi.js"></script>
</body>

</html>
```

## Assigning component to specific route

Viewi supports routing and will automatically render components based on assigned url or route rule.

Le us assign `CounterPage` component to `/counter` url so every time user navigates to that url in the browser he will receive HTML content of that page.

File with all assigned routes is located here:

`viewi-app/routes.php`

To add the component simply use this syntax:

```php
// add using at the top of the file
use Components\Views\Pages\CounterPage;

// ...

// add new route
$router->get('/counter', CounterPage::class);
```

Please make sure you add your routes before `404` (Page not found) handler, otherwise your component will not be reachable.

```php
$router->get('/counter', CounterPage::class);
// ...

// '*' (wildcard syntax to catch any url) handler should be at the end
$router
    ->get('*', NotFoundPage::class)
    ->transform(function (Response $response) {
        return $response->withStatus(404, 'Not Found');
    });
```