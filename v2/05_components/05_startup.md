# Startup services

You can define a service that will run some login on application startup stage.

Simply implement `IStartUp` interface:

```php
#[Singleton]
class Localization implements IStartUp
{
    private array $resources = /* @jsobject */ [];

    public function __construct(private HttpClient $http)
    {
    }

    // execute the action on application start up
    public function setUp()
    {
        $this->http->get("/api/locale-resource/1")
            ->then(function ($resources) {
                $this->resources = $resources;
            }, function () {
                // error
            });
    }
```

You can use to set up some cache, configuration, localization resources, to log some information, etc.