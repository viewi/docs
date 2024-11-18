# Watch feature

If you want to track component`s property change, you can use `watch` method inside of `init` hook:

```php
class SelectInput extends BaseComponent
{
    public $myProperty = null;
    // ...
    public function init()
    {
        $this->watch('myProperty', function() { 
            // myProperty has changed
        });
    }
```

