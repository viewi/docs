# Get started

## Install Viewi

```
composer require viewi/viewi
```

## Create a new Viewi project

```
vendor/bin/viewi new
```

This will generate for you the Starter application with home page component. Also it will insert the default code for using Viewi as a standalone application into your `/index.php` or `/public/index.php`. If it didn't happen for some reason just go and include this code by yourself:

```php
/**
 * @var Viewi\App
 */
$app = include __DIR__ . '/viewi-app/viewi.php';

// Viewi components
include __DIR__ . '/viewi-app/routes.php';

$response = $app->run();

if (is_string($response)) {
    header("Content-type: text/html; charset=utf-8");
    echo $response;
} elseif ($response instanceof Response) {
    http_response_code($response->status);
    foreach ($response->headers as $name => $value) {
        header("$name: $value");
    }
    echo $response->body;
} else {
    header("Content-type: application/json; charset=utf-8");
    echo json_encode($response);
}
```

Depending on the folder structure of your application, Viewi components will be located in one of these folders:

```
viewi-app/
// or
src/ViewiApp/
```

Also make sure you didn't forget about the autoload:

```php
require __DIR__ . '/vendor/autoload.php';
```

By default, Viewi is configured to use files watcher. To run it, go into your JavaScript project at `viewi-app/js` and run the NPM watch command:

```
cd viewi-app/js
npm run watch
```

Open another terminal and run your server or use a built in PHP development server:

```
php -S localhost:8000
```

and open your browser at `http://localhost:8000/`. If everything was done correctly you should be able to see the Starter application.

**Important**
Your Viewi logic will be exposed to the browser. Treat it as you would treat any other javascript code. And remember not to use any secret(s) as it will become publicly visible. Isolate your frontend application!
