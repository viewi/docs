# WebSocket client

`WebsocketClient` is a service that helps you with websocket communication on client side:

```php
#[Singleton]
class WebsocketClient
{
    /**
     * 
     * @param string | URL $url 
     * @param string | string[] | null $protocols 
     * @return null|WebSocket 
     */
    public function getConnection($url = null, $protocols = null): ?WebSocket;
}
```

For example:

```php
namespace Components\Services\Web;

use Throwable;
use Viewi\Components\Environment\Platform;
use Viewi\Components\Http\WebSocket;
use Viewi\Components\Http\WebsocketClient;
use Viewi\DI\Singleton;

#[Singleton]
class HubClient
{
    protected ?WebSocket $websocket = null;

    public function __construct(WebsocketClient $client, Platform $platform)
    {
        if ($platform->browser) {
            $this->websocket = $client->getConnection();
            $this->websocket->onopen = function ($event) {
                echo "Connected to WebSocket server.";
            };
            $this->websocket->onclose = function ($event) {
                echo "Disconnected", $event;
            };
            $this->websocket->onmessage = function ($event) {
                 echo "Got message", $event;
            };
        }
    }

    public function send(string $message )
    {
        $this->websocket->send($message);
    }
}
```
Be default, `url` is set to `'wss://{location.host}/websocket'`