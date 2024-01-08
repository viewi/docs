# Using with CodeIgniter4

You can find all files here:

<a target="_blank" href="https://github.com/kenjis/ci4-viewi-demo" rel="noopener noreferrer">github.com/kenjis/ci4-viewi-demo</a>

Or here:

<a target="_blank" href="https://github.com/ivanvoitovych/ci4-viewi-demo" rel="noopener noreferrer">github.com/ivanvoitovych/ci4-viewi-demo</a>

## Requirements

`codeigniter4/framework`

## Architecture design

CodeIgniter4 will serve our API. 

And Viewi will be responsible for rendering HTML pages on the client-side as a front-end application. But also it will be responsible for rendering HTML on the server-side (SSR). In both cases, Viewi application can consume the server's API using HttpClient:

- In the browser - AJAX
- During SSR - simulate a request and pass it to the CodeIgniter4 application (direct invocation)

(CodeIgniter4 - API)   <-- data -->  (Viewi application)

## Basic idea

Viewi is capable of handling routes on its own, so the simplest solution here is to assign Viewi handler to a 404 CodeIgniter route:

```php
$routes->set404Override('App\ViewiBridge\ViewiHandler::handle');
```

## Configuration

Couple of important settings to consider here.

To run Viewi application you need to tell Viewi where to put its compiled files.
It should be a public folder.

In this case, it is a `public` folder:

 `__DIR__ . '/../public/'` 

Public url path to resolve assets, in this case it's an empty string `''` (means assets base URL is `http://localhost/`)

NPM watch setting, you can either use it, or you can disable it.

`->watchWithNPM(true)` or `->watchWithNPM(false)`

Setting it to `false` will trigger a build process on the first request.

The final config should look something like this:

`app\ViewiApp\config.php`

```php
<?php

use Viewi\AppConfig;

$d = DIRECTORY_SEPARATOR;
$viewiAppPath = __DIR__ . $d;
$componentsPath =  $viewiAppPath . 'Components';
$buildPath = $viewiAppPath . 'build';
$jsPath = $viewiAppPath . 'js';
$assetsSourcePath = $viewiAppPath . 'assets';
$publicPath = __DIR__ . $d . '..' . $d . '..' . $d . 'public';
$assetsPublicUrl = '';

return (new AppConfig('ci4'))
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
    ->watchWithNPM(true);
```

## Implementation

Viewi application is located here: `app\ViewiApp`

Viewi bridge and handler files are located here: `app\ViewiBridge`

## Extend the Response

In order to supply Viewi with original typed data that CodeIgniter4 returns from the API, we need to preserve that data in the response.

Typical `Response` class converts your data into a JSON string that will not satisfy our Viewi application.

Let's extend it

```php
<?php

namespace App\ViewiBridge;

use CodeIgniter\HTTP\Response;

class TypedResponse extends Response
{
    /**
     * @var array|object
     */
    private $rawData;

    public function __construct()
    {
        $config = config('App');

        parent::__construct($config);
    }

    public function setJSON($body, bool $unencoded = false)
    {
        $this->rawData = $body;
        return parent::setJSON($body, $unencoded);
    }

    /**
     * @return array|object
     */
    public function getRawData()
    {
        return $this->rawData;
    }
}
```

Now, we can use it like before, but we also will have the original data passed into the response:

```php
<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\ViewiBridge\TypedResponse;
use Components\Models\PostModel;

class Posts extends BaseController
{
    public function index($id): TypedResponse
    {
        $postModel          = new PostModel();
        $postModel->Id      = (int) $id;
        $postModel->Name    = 'CodeIgniter4 ft. Viewi';
        $postModel->Version = 1;
    
        $response = (new TypedResponse())->setJSON($postModel);
        return $response;
    }
}
```

This will pass this typed data as a response here:

```php
<?php

namespace Components\Views\Posts;

use Components\Models\PostModel;
use Viewi\Components\BaseComponent;
use Viewi\Components\Http\HttpClient;

class PostsPage extends BaseComponent
{
    public string $title = 'Viewi - Reactive application for PHP';

    public ?PostModel $post = null;

    public function __construct(private HttpClient $http, private int $postId)
    {
    }

    public function init()
    {
        $this->http->get("/api/posts/{$this->postId}")->then(function (PostModel $data) {
            $this->post = $data;
        }, function ($error) {
            echo $error;
        });
    }
}
```

**Important note**: model classes should be defined within your Viewi application. Using models outside of it will cause an error.
If you are using a database model, you will need to convert it to the Viewi model type.

## Viewi handler

Viewi handler is our 404 CodeIgniter route that will pass the execution to your Viewi application.

```php
<?php

namespace App\ViewiBridge;

use App\Controllers\BaseController;
use Exception;
use Throwable;
use Viewi\App;
use Viewi\Components\Http\Message\Request;
use Viewi\Router\ComponentRoute;
use Viewi\Router\Router;

class ViewiHandler extends BaseController
{
    protected static App $viewiApp;
    protected static Router $viewiRouter;

    public function handle()
    {
        $urlPath = str_replace('/index.php', '', $this->request->getUri()->getPath());
        $requestMethod = $this->request->getMethod();
        $match = self::$viewiRouter->resolve($urlPath, $requestMethod);
        if ($match === null) {
            throw new Exception('No route was matched!');
        }
        /** @var RouteItem */
        $routeItem = $match['item'];
        $action = $routeItem->action;

        if ($action instanceof ComponentRoute) {
            $viewiRequest = new Request($urlPath, strtolower($requestMethod));
            $response = self::$viewiApp->engine()->render($action->component, $match['params'], $viewiRequest);

            $this->response->setBody($response->body);
            foreach ($response->headers as $key => $value) {
                $this->response->setHeader($key, $value);
            }
            $this->response->setStatusCode(isset($response->headers['Location']) ? 302 : $response->status);
        } else {
            throw new Exception('Unknown action type.');
        }
        $this->response->send();
    }

    public static function setViewiApp(App $viewiApp)
    {
        self::$viewiApp = $viewiApp;
        self::$viewiRouter = $viewiApp->router();
    }
}
```

This will resolve Viewi route, call the render action for the assigned component, and convert it to the CodeIgniter4 response:

```php
$match = self::$viewiRouter->resolve($urlPath, $requestMethod);
//...
$response = self::$viewiApp->engine()->render($action->component, $match['params'], $viewiRequest);
//...
$this->response->setBody($response->body);
foreach ($response->headers as $key => $value) {
    $this->response->setHeader($key, $value);
}
$this->response->setStatusCode(isset($response->headers['Location']) ? 302 : $response->status);
```

## Viewi bridge

Viewi bridge is responsible for handling the server-side rendering (SSR) internal requests.

```php
interface IViewiBridge
{
    // file_exists - Checks whether a file or directory exists
    function file_exists(string $filename): bool;
    
    // is_dir - Tells whether the filename is a directory
    function is_dir(string $filename): bool;
    
    // file_get_contents - Reads entire file into a string
    function file_get_contents(string $filename): string | false;
    
    // request - Server-side internal request handler. Request that comes from Viewi component.
    function request(Request $request): mixed;
}
```

In our case, it will look like this:

```php
<?php

namespace App\ViewiBridge;

use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\URI;
use CodeIgniter\HTTP\UserAgent;
use Viewi\Bridge\DefaultBridge;
use Viewi\Components\Http\Message\Request;

class ViewiCodeIgniterBridge extends DefaultBridge
{
    public function __construct()
    {
    }

    public function request(Request $viewiRequest): mixed
    {
        if ($viewiRequest->isExternal) {
            return parent::request($viewiRequest);
        }
        
        // simulate a new internal request base on SSR Viewi request
        /** @var CodeIgniter $app */
        $app = Services::codeigniter(null, false);
        $app->initialize();
        $context = is_cli() ? 'php-cli' : 'web';
        $app->setContext($context);
        $app->disableFilters();

        $uri       = new URI();
        $userAgent = new UserAgent();
        $request   = new IncomingRequest(
            config('App'),
            $uri,
            'php://input',
            $userAgent
        );
        $request->setMethod($viewiRequest->method);
        $request->setPath($viewiRequest->url);
        $app->setRequest($request);
        // handle the request
        $response = $app->run(null, true);

        // extract typed data if possible
        if ($response instanceof TypedResponse) {
            return $response->getRawData();
        }

        // by default we convert it from JSON
        return json_decode($response->getBody());
    }
}
```

## Setting up the 404 route

In you `app\Config\Routes.php`:

```php
/**
 * @var RouteCollection $routes
 */

$routes->get('api/posts/(:num)', [Posts::class, 'index']);


/**
 * Viewi set up
 * The idea is to let Viewi handle its own routes by registering a 404 action
 * @param RouteCollection $routes 
 * @return void 
 */
function viewiSetUp(RouteCollection $routes)
{
    // initialize Viewi application
    /**
     * @var App
     */
    $app = require __DIR__ . '/../ViewiApp/viewi.php';
    require __DIR__ . '/../ViewiApp/routes.php';
    // create Viewi bridge
    $bridge = new ViewiCodeIgniterBridge();
    // register a bridge in Viewi app
    $app->factory()->add(IViewiBridge::class, function () use ($bridge) {
        return $bridge;
    });
    // pass Viewi app to our handler
    ViewiHandler::setViewiApp($app);
    // set 404 route
    $routes->set404Override('App\ViewiBridge\ViewiHandler::handle');
}

viewiSetUp($routes);
```

## Build Viewi application

Viewi application is not about PHP. It is also a fully capable JavaScript application.

To set it up you need to perform simple steps.

If you are using `vendor/bin/viewi new` that may not be necessary.

But if you are cloning this repository you will need to install NPM packages.

Assuming that you have installed `composer` packages:

`cd app\ViewiApp\js`

`npm install`

Wait for the installation.

### Watching mode

Watching mode will monitor your Viewi application for changes and will trigger a build process automatically.

Go to your Viewi application `js` folder

`cd app\ViewiApp\js`

Run NPM watch command

`npm run watch`

You will need to keep two terminals open in order to run this and ReactPHP server for development.

Watch mode is optional, please follow [watch-mode](/docs/watch-mode) for more.

Open the second terminal and run:

```console
php spark serve
```

Navigate to <http://localhost:8080/>.

*Thanks and feel free to review, ask questions, contribute in any way.*