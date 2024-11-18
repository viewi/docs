# Client Timer 

`ClientTimer ` is a service that helps you with timer on client side:

```php
#[Singleton]
class ClientTimer
{
    public static function setTimeoutStatic(callable $action, int $milliseconds): int;
    public function setTimeout(callable $action, int $milliseconds): int;
    public static function clearTimeoutStatic(int $timerId);
    public function clearTimeout(int $timerId);
    public static function setIntervalStatic(callable $action, int $milliseconds): int;
    public function setInterval(callable $action, int $milliseconds): int;
    public static function clearIntervalStatic(int $timerId);
    public function clearInterval(int $timerId);
}
```

For example:

```php
    public function init() {
        ClientTimer::setTimeoutStatic(function () {
            // execute some action after 100 ms
        }, 100);
    }
```
