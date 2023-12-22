# Reusing layouts

Viewi supports layout sharing between different components. And if you navigate to another page component, Viewi will reuse same layout and will preserve its state, including child components of that layout. 

In other words - you do not need to worry about nesting your routes, preserving shared contents, menus, headers, footers, and animations or jumpy pages.

For example, this `Layout` component can be reused with its state and content preservation. For demonstration we will use timer that will keep updating the page each second:

```php
<?php

namespace Components\Views\Layouts;

use Viewi\Components\BaseComponent;

class Layout extends BaseComponent
{
    public string $title = 'Viewi';

    public int $timerId = 0;
    public int $seconds = 0;

    public function init()
    {
        $this->seconds = 500;
        <<<'javascript'
        this.timerId = setInterval(() => $this.tick(), 1000);
        javascript;
    }

    public function destroy()
    {
        <<<javascript
        clearInterval(this.timerId);
        javascript;
    }

    public function tick()
    {
        $this->seconds++;
        <<<'javascript'
        console.log('Layout time ' + $this.seconds);
        javascript;
    }
}
```

```html
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        $title | Viewi
    </title>
</head>

<body>
    <div id="sidebar">
        <MenuBar />
    </div>
    <h2><i>Layout time: $seconds</i></h2>
    <DemoContainer>
        <slot></slot>
    </DemoContainer>
    <ViewiAssets />
</body>

</html>
```

And use this layout in two different pages:

`HomePage`

```php
<Layout title="Home page">
    <h1>Home page</h1>
</Layout>
```

`PostPage`

```php
<Layout title="Post page">
    <h1>Post page</h1>
</Layout>
```

Routing:

```php
$router->get('/', HomePage::class);
$router->get('/post/{id}', PostPage::class);
```

Now, if you navigate from one page into another, a `Layout` component will preserve its state and page content after navigation and the timer will keep running and updating the page each second.

**Important**

Only top level components are reused and only if next page is also using it.

For example, `Layout` will is shared because both pages are using it at the top level:

```html
<Layout title="Post page">
    <h1>Post page</h1>
</Layout>
```

This will not be shared, it is not at the top level, it is just a regular child component:

```html
<html>
    <Layout title="Post page">
        <h1>Post page</h1>
    </Layout>
</html>
```

## Multiple layouts

You can have many sub layouts or even different layout at all.

### Sub layouts

You can have `BaseLayout` and `PublicLayout` for example:

`BaseLayout`

```html
<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        $title | Viewi
    </title>
</head>

<body>
    <slot></slot>
    <ViewiAssets />
</body>

</html>
```

`PublicLayout`

```html
<BaseLayout title="$title">
    <div id="sidebar">
        <MenuBar />
    </div>
    <DemoContainer>
        <slot></slot>
    </DemoContainer>
</BaseLayout>
```

In this case both layouts are going to be reused if navigation happens to the page with the same layout `PublicLayout`.

If you next page uses different sub layout, but the same top level layout `BaseLayout`, only the `BaseLayout` layout will be reused.

### Different HTML level layout

Layout with `html` tag and `ViewiAssets` component is called a top level layout.

**Please be aware**.

If you use many top level layouts, the content will not be preserved and page refresh will occur from the server due to its environment nature in the browser. Scripts can not be unloaded from the memory, full page refresh is needed.