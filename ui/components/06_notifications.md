# Notifications

To simplify usage of Alert UI components, there is `AlertService` available for you to use.

## Usage

Include the `AlertContainer` component in your root layout (the one that contains the `body` tag):

```html
<!DOCTYPE html>
<html lang="en">

<head>
    ...
</head>

<body>
    <slot></slot>
    <AlertContainer />
    <ViewiAssets />
</body>

</html>
```

Inject `AlertService` in your component.

## Example: 

```php
class ListPage extends BaseComponent
{
    public function __construct(
        private AlertService $notifications
    ) {}

    public function onSave($item)
    {
        $this->messages->notifications("Item was successfully created.", null, 5000);
    }
```

## Methods

`success(string $message, ?int $timeout = null)` - Success notification.

`error(string $message, ?int $timeout = null)` - Error notification.

`warning(string $message, ?int $timeout = null)` - Warning notification.

`info(string $message, ?int $timeout = null)` - Information notification.

Confirmation dialog, make sure the user confirms his actions before making something important.

### Parameters

`message` - The message that you want to display.

`timeout` - (optional), time, in seconds, after which the Alert will be dismissed.
