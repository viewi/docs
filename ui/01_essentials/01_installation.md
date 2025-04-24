# Installation

To install UI package for Viewi follow these steps.

`composer require viewi/ui`

Add `ViewiUI` package to your application using configuration:

`config.php`

```php
use Viewi\UI\ViewiUI;

///...
$viewiConfig->use(ViewiUI::class)
```

Include UI CSS files into your bundle:

`/viewi-ui/bs-theme.css, /viewi-ui/bootstrap.css, /viewi-ui/ui.css`.

```html
<CssBundle
    links="{[
        '/viewi-ui/bs-theme.css',
        '/viewi-ui/bootstrap.css',
        '/viewi-ui/ui.css'
    ]}"
    minify purge combine 
/>
```

## Example

```php
<?php

use Viewi\AppConfig;
use Viewi\UI\ViewiUI;

$d = DIRECTORY_SEPARATOR;
$viewiAppPath = __DIR__ . $d;
$componentsPath =  $viewiAppPath . 'Components';
$buildPath = $viewiAppPath . 'build';
$jsPath = $viewiAppPath . 'js';
$assetsSourcePath = $viewiAppPath . 'assets';
$publicPath = __DIR__ . $d . '..' . $d . 'public';
$assetsPublicUrl = '';

$viewiConfig = (new AppConfig('viewi'))
    ->buildTo($buildPath)
    ->buildFrom($componentsPath)
    ->withJsEntry($jsPath)
    ->putAssetsTo($publicPath)
    ->assetsPublicUrl($assetsPublicUrl)
    ->withAssets($assetsSourcePath)
    ->combine(false)
    ->minify(false)
    ->developmentMode(true)
    ->buildJsSourceCode()
    ->watchWithNPM(true)
    ->use(ViewiUI::class); // <--

return $viewiConfig;
```