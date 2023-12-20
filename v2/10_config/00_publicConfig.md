# Public configuration

You public configuration file is located at `viewi-app/publicConfig.php` and contains all necessary values that can be used in your components.

**Important** All values of public configuration will be exposed to the browser. Don not put your secrets in it.

```php
<?php

return [
    'baseUrl' => 'https://viewi.net'
];
```

## Using the configuration

To use it in your components simply inject a `Viewi\Components\Config\ConfigService` service into your component:

```php
<?php

namespace Components\Views\Pages;

use Viewi\Components\BaseComponent;
use Viewi\Components\Config\ConfigService;

class TestPage extends BaseComponent
{
    public ?string $baseUrl = '';

    public function __construct(private ConfigService $config)
    {
        $this->baseUrl = $config->get('baseUrl');
    }
}
```

## Available methods

```php
// Get everything
public function getAll(): array;

// Get specific config by name
public function get(string $name);

// Check if your application is running on the server (SSR)
public function isServer(): bool;

// Check if your application is running in the browser (JavaScript)
public function isBrowser(): bool;
```