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

`viewi-app/Components/Views/Layouts/Layout.php`

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
    <ViewiScripts />
</body>

</html>
```

And then any other components can reuse it like this:

```html
<Layout title="$title">
    <h1>$title</h1>
</Layout>
```

Here `<h1>$title</h1>` will be placed instead of `<slot></slot>` in your Layout component. Also you can pass properties `title="$title"` to the Layout so it can use it in its code logic or render in its template.

## Creating a CountPage component

Now let us create a CountPage component.