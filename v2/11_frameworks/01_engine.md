# Viewi `Engine`

Use `Viewi\Engine`

```php
namespace Viewi;

class Engine
{
    public function render(string $component, array $params = [], ?Request $request = null): Response;
    public function renderComponent(string $component, ?BaseComponent $parentComponent, array $props, array $slots, array $scope, array $params = []): string;
    public function getResponse(): Response;
    public function getRequest(): ?Request;
    public function isComponent(string $name): boolean;
    public function getAssets(): array;
    public function getState(): array;
    public function shortName(string $name): string;
    public function getIfExists(string $name);
    public function set(string $name, $mixed);
    public function resolve(string $name, array $params = [], bool $canBeNull = false): mixed;
}
```

## Use case

The most common use case is to set up dependencies for Viewi application with factory method

```php
/**
 * @var Viewi\App $app
 */
$app->factory()->add(Viewi\Bridge\IViewiBridge::class, function (Engine $engine) use ($bridge) {
    // use $engine
});
```

Or for framework integration and request handling:

```php
// get engine
/**
 * @var Viewi\App $app
 */
$engine = $app->engine(); // returns fresh Engine instance every time
// set instance in the container
$engine->set(MyClass::class, $myClassObject);
```

And now you can use when needed:

```php
class RequestHandlerInYourFramework
{
    // ...
    public function handle(/** arguments */)
    {
        /**
         * @var Viewi\App $app
         */
        $engine = $app->engine();
        // set instance in the container
        $engine->set(MyClass::class, $myClassObject);
        // get something
        /**
         * @var ?MyClass $myClassObject
         */
        $myClassObject = $currentEngine->getIfExists(MyClass::class);
        // create Viewi Request
        $request = new Request('/post/3', 'get');
        // render component
        $response = $engine->render('PostComponent', ['id' => 3], $request);
        // process Viewi response with your framework
    }
}
```

## Viewi `App`

```php
namespace Viewi;

class App
{
    // get public configuration
    public function getPublicConfig(): array;
    // get router to register components
    public function router(): Router;
    // get factory to set up dependencies
    public function factory(): Factory;
    // get new Engine instance
    public function engine(): Engine;
    // get Response for specific URI and method
    public function run(?string $uri = null, string $method = null);
    // get config
    public function getConfig(): AppConfig;
    // build application
    public function build(): string;
}
```