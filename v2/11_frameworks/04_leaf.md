# Viewi Leaf integration

You can find all files here:

<a target="_blank" href="https://github.com/ivanvoitovych/viewi-leaf" rel="noopener noreferrer">github.com/ivanvoitovych/viewi-leaf</a>

## Create Leaf project

`leaf create <project-name>`

or

`composer create-project leafs/mvc <project-name>`

## Install viewi

`composer require viewi/viewi`

## Create Viewi app

Use `-a` parameter.

`vendor/bin/viewi new -a`

## Run web-server

`php -S localhost:8000`

## Run NPM watch

In another terminal.

`cd viewi-app/js`

`npm run watch`

## Implementation details

### Viewi routing

`routes\web.php`

Integrates Viewi routing.

Modify your `index.php` to handle requests to Viewi:

```php

// pass action to the Viewi app
/**
 * Viewi set up
 * The idea is to let Viewi handle its own routes by registering a 404 action
 * @param RouteCollection $routes 
 * @return void 
 */
function viewiSetUp(\Leaf\App $leafApp)
{
    /**
     * @var App
     */
    $app = require __DIR__ . '/src/ViewiApp/viewi.php';
    require __DIR__ . '/src/ViewiApp/routes.php';
    $bridge = new ViewiLeafBridge($leafApp);
    $app->factory()->add(IViewiBridge::class, function () use ($bridge) {
        return $bridge;
    });
    ViewiHandler::setViewiApp($app);
    $leafApp->all('.*', function () {
        (new ViewiHandler())->handle();
    });
}

viewiSetUp($app);

$app->run();
```

### API routes

You should use `RawResponse` in order to supply typed response to Viewi component.

You must use Viewi model classes defined within Viewi application, use mapping if necessary.

```php
<?php

namespace App\Http;

use Leaf\Http\Response;

class RawResponse extends \Leaf\Http\Response
{
    /**
     * 
     * @var mixed
     */
    private $data = null;
    /**
     * 
     * @var bool Stop sending the response (no echo)
     */
    private bool $doNotSend = false;
    /**
     * Output json encoded data with an HTTP code/message
     * 
     * 
     * @return $this
     */
    public function send(): Response
    {
        if (!$this->doNotSend) parent::send();
        return $this;
    }

    public function getRawData()
    {
        return $this->data;
    }
}

// RawResponse should be injected here automatically

$app->get("/api/posts/{id}", function ($id) {
    $post = new PostModel();
    $post->Id = $id ?? 0;
    $post->Name = 'Viewi ft. Leaf';
    $post->Version = 1;
    response()->json($post);
});
```

### Leaf bridge

`src/App/Bridge/ViewiLeafBridge.php`

This allows you to handle internal requests during server-side rendering (SSR).

```php
<?php
namespace App\Bridge;

use App\Http\RawResponse;
use Viewi\Bridge\DefaultBridge;
use Viewi\Components\Http\Message\Request;
use Viewi\Engine;

class ViewiLeafBridge extends DefaultBridge
{
    public function __construct(protected \Leaf\App $leafInstance) {}

    public function request(Request $viewiRequest, Engine $engine): mixed
    {
        if ($viewiRequest->isExternal) {
            return parent::request($viewiRequest, $engine);
        }
        $originResponse = $this->leafInstance->response();
        // new response instance
        $internalResponse = new RawResponse();
        $internalResponse->makeInternal(); // make it not to send output
        // set as current response instance
        \Leaf\Config::singleton('response', function () use ($internalResponse) {
            return $internalResponse;
        });
        // handle url internally
        $this->leafInstance::handleUrl(strtoupper($viewiRequest->method), $viewiRequest->url);
        // set original response back
        \Leaf\Config::singleton('response', function () use ($originResponse) {
            return $originResponse;
        });
        // return data to Viewi
        return $internalResponse->getRawData();
    }
}
```

### Viewi handler

Located here:

`src/App/Bridge/ViewiHandler.php`

```php
<?php
namespace App\Bridge;

use Exception;
use Viewi\App;
use Viewi\Components\Http\Message\Request;
use Viewi\Router\ComponentRoute;
use Viewi\Router\Router;

class ViewiHandler
{
    protected static App $viewiApp;

    protected static Router $viewiRouter;

    public function handle()
    {
        $urlPath = explode('?', \Leaf\Http\Request::getPathInfo())[0];
        $requestMethod = \Leaf\Http\Request::getMethod();
        $match = self::$viewiRouter->resolve($urlPath, $requestMethod);
        if ($match === null) {
            throw new Exception('No route was matched!');
        }
        /** @var RouteItem */
        $routeItem = $match['item'];
        $action = $routeItem->action;
        $leafResponse = response();
        if ($action instanceof ComponentRoute) {
            $viewiRequest = new Request($urlPath, strtolower($requestMethod));
            $response = self::$viewiApp->engine()->render($action->component, $match['params'], $viewiRequest);
            if ($routeItem->transformCallback !== null && $response instanceof \Viewi\Components\Http\Message\Response) {
                $response = ($routeItem->transformCallback)($response);
            }
            foreach ($response->headers as $key => $value) {
                $leafResponse->withHeader($key, $value);
            }
            $statusCode = isset($response->headers['Location']) ? 302 : $response->status;
            $leafResponse->status($statusCode);
            $leafResponse->markup($response->body, $statusCode);
        } else {
            throw new Exception('Unknown action type.');
        }
    }

    public static function setViewiApp(App $viewiApp)
    {
        self::$viewiApp = $viewiApp;
        self::$viewiRouter = $viewiApp->router();
    }
}
```

Now, when you navigate to the `localhost:8000`, you will see your Viewi application.

*Thanks and feel free to review, ask questions, contribute in any way.*