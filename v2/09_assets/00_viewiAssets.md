# Viewi assets

`ViewiAssets` component is a special component that is responsible for making your application dynamic. It is a front-end framework that makes your page alive.

Is also includes all of the cached requests that were made on the server during server-side-rendering (SSR). See HTTP client for more.

Without `ViewiAssets` you application becomes static.

**Important**: Only one instance per application life scope should be used, otherwise the application will break.

Viewi does not include Viewi assets automatically in case you want to render static pages, like emails, etc.

Include it in reusable top-level components, like layouts:

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        $title | Viewi
    </title>
    <meta charset="utf-8">
</head>
<body>
    <div id="content">
        <slot></slot>
    </div>
    <ViewiAssets />
</body>
</html>
```