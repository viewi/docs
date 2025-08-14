# CSS bundle

The `CssBundle` component is a special component that will help you with arranging your CSS styles.

It includes features like code minification, purging unused CSS rules, combining files together, and rendering them inline.

You can define your styles in the `assets` folder:

`viewi-app/assets`

Everything in that folder will be copied to the public directory of your server during the build process.

You can keep your images, fonts, scripts, etc. in that folder.

## Creating a CSS bundle

The syntax for `CssBundle` is next:

```html
<CssBundle links="$cssFiles" combine minify purge inline />
```

Where:

`links` - required parameter, list of CSS files that you want to use. The path is relative to your `assets` folder.

`combine` - optional, merges files into a single one.

`minify` - optional, minifies CSS, and makes your bundle smaller.

`purge` - optional, purges unused CSS rules, and makes your bundle smaller.

`inline` - optional, renders styles inline, must be used with `combine` option enabled.

`name` - optional, unique name, use to append links across files with `to` property.

`to` - optional, if set, links will be assigned to the appropriate bundler with the same `name` property.

Imagine you have these files:

`viewi-app/assets/app.css`, `viewi-app/assets/mui.css`;

To create a bundle simply put int somewhere in the head of the layout:

```html
<CssBundle links="{['/mui.css', '/app.css']}" combine minify purge />
```

Properties without a value are treated as boolean `true`: `prop="true"` or `prop="{true}"`.

You can also write:

```html
<CssBundle links="{['/mui.css', '/app.css']}" combine="true" minify="true" purge="true" />
```

`viewi-app/assets/app.css` - relative path is `/app.css`

`viewi-app/assets/mui.css` - relative path is `/mui.css`

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <title>
        $title | Viewi
    </title>
    <meta charset="utf-8">
    <CssBundle name="main-head" links="{['/mui.css', '/app.css']}" combine minify purge />
</head>
<body>
    <div id="content">
        <slot></slot>
    </div>
    <ViewiAssets />
</body>
</html>
```

## Appending links from different places

For example, if you decide to append another `css` file to the `main-head` bundle, and you don not have access or possibility (third party module or package), you can inject additional files using `to` property:

```html
<CssBundle to="main-head" links="{['/my-own.css']}" />
```
