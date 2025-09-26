# Browser Session

`BrowserSession` service is a PHP wrapper around the JavaScript variant of `sessionStorage` .

It helps you manage session data that lives while your window or tab page is active. Session data can not be shared between tabs or windows. Please be aware.

```php
#[Singleton]
class BrowserSession
{
    public function getItem(string $key): ?string;

    public function setItem(string $key, string $value);

    public function removeItem(string $key);

    public function clear();
}
```

## Usage

You can store the product ID while waiting for the user to log in. And restore the buying process.

```php
class Login extends BaseComponent
{
    public function __construct(
        private HttpClient $http, 
        private ClientRoute $route, 
        private BrowserSession $browserSession
    ) {}

    public function handleSubmit(DomEvent $event)
    {
        $event->preventDefault();
        $productId = $this->browserSession->getItem('purchaseItem');
        if ($productId !== null) {
            $this->route->navigate("/catalog/product/$productId");
        } else {
            $this->route->navigate('/');
        }
    }
}
```