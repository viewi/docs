# Portals

Portals allows you to render something outside of the current DOM element or outside of the current component.

Useful when you need to display the content somewhere outside of your component. Like modal windows or tooltips.

## Using portals

To define the content that should be rendered somewhere else simply use the `Portal` component with `to` attribute:

```html
<Portal to="body">
    <div>
        This should appear at the end of the body (portal with name "body").
        Title of the page: $title
    </div>
</Portal>
```

Component `Portal` with attribute `name` defines a destination of your content:

```html
<Portal name="body" />
```

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        $title | Viewi
    </title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
    <Portal name="header" />
    <div id="content">
        <slot></slot>
    </div>
    <Portal name="body" />
    <ViewiAssets />
</body>
</html>
```

You can port as many contents as you want.

```html
<Portal to="body">
    <div>
        This should appear at the end of the body (portal with name "body").
        Title of the page: $title
    </div>
</Portal>
<div>My component</div>
<Portal to="body">
    <div>
        Body: $title
    </div>
</Portal>
```

**Important**: The name of the portal should be unique across your application and you can have only one portal with such name.

## Server-side rendering and portals

Portals have full server-side rendering (SSR) support unless you specify different with custom JavaScript or conditions.
In that case, you should write your code with consideration of the hydration process.