# Configuration

After the installation you will find your initial configuration file here:

`viewi-app/config.php`

This file should return an instance of the `Viewi\AppConfig` class.

`Viewi\AppConfig` has helper methods to make configuration easier for you.

If you have installed your Viewi application in the `viewi-app` folder and your public directory is `public` then your config will look like this:

```php
<?php

use Viewi\AppConfig;

$d = DIRECTORY_SEPARATOR;
$viewiAppPath = __DIR__ . $d;
$componentsPath =  $viewiAppPath . 'Components';
$buildPath = $viewiAppPath . 'build';
$jsPath = $viewiAppPath . 'js';
$assetsSourcePath = $viewiAppPath . 'assets';
$publicPath = __DIR__ . '/../public/';
$assetsPublicUrl = '';

return (new AppConfig())
    ->buildTo($buildPath)
    ->buildFrom($componentsPath)
    ->withJsEntry($jsPath)
    ->putAssetsTo($publicPath)
    ->assetsPublicUrl($assetsPublicUrl)
    ->withAssets($assetsSourcePath)
    // ->combine()
    ->developmentMode(true)
    ->buildJsSourceCode()
    ->watchWithNPM(true);
```

## Config methods and parameters

```php
// Name of your application. Has to be unique.
public string $name = 'default' 

// Destination folder for Viewi's build files, usually it's `viewi-app/build`
buildTo(string $buildPath): self // OR
public ?string $buildPath = null

// Development mode - each new request will trigger a build process
developmentMode(?bool $mode = null): self // OR
public bool $devMode = false

// Path to your Viewi project, usually it's `viewi-app/Components`
buildFrom(string $sourcePath): self // OR
public ?string $sourcePath = null

// Path to the JavaScript project, autogenerated, usually it's `viewi-app/js`
withJsEntry(string $jsPath): self // OR
public ?string $jsPath = null

// Path to the public assets, usually it's `viewi-app/assets`
withAssets(?string $assetsPath): self // OR
public ?string $assetsPath = null 

// Destination path for public assets, `public` folder path
putAssetsTo(string $publicPath): self // OR
public ?string $publicPath = null

// Relative URL path for public assets, `` (empty) in this case
assetsPublicUrl(string $publicUrl): self // OR
public ?string $publicUrl = null 

// Enables minification for javascript build files
minify(?bool $minify = null): self // OR
public bool $minifyJs = false 

// Combines javascript bundle with JSON templates
combine(?bool $combine = null): self // OR
public bool $combineJsJson = false 

// Appends version/build ID to every asset HTTP request to avoid caching in the browser
appendVersionToPath(?bool $append = null): self // OR
public bool $appendVersionPath = false 

// Enables production mode - no build process for each request
production(?bool $mode = null): self // OR
public bool $prod = false 

// Enables internal development mode, and overrides all of your custom files every time. For core developers only.
public bool $internalDevMode = false 

// Runs npm build command for javascript source code
buildJsSourceCode(?bool $buildJSwithNode = null): self // OR
public bool $buildJSwithNode = false 

// Watch changes with Node js NPM script with rebuild instead of on-request build.
watchWithNPM(?bool $useNpmWatch = null): self // OR
public bool $useNpmWatch = false 

// Additional components and packages
public array $includes = []
```

## Production

Using `$config->production()` will set up `devMode` to `false`, `minifyJs`, and `appendVersionPath` to `true`.

Additionally, you can set up `$config->combine()` to combine templates JSON file with JavaScript bundle file and avoid additional requests.

You can build project with NPM:

`npm run build`

or using php:

Go to your Viewi application:

`php build.php`
