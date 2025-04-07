# Dialogs

To simplify usage of Modal UI components, there is `ModalService` available for you to use.

## Usage

Include the `ModalContainer` component in your root layout (the one that contains the `body` tag):

```html
<!DOCTYPE html>
<html lang="en">

<head>
    ...
</head>

<body>
    <slot></slot>
    <ModalContainer />
    <ViewiAssets />
</body>

</html>
```

Inject `ModalService` in your component.

## Example: 

```php
class ListPage extends BaseComponent
{
    public function __construct(
        private ModalService $modal
    ) {
    }

    public function onDelete($item)
    {
        $this->modal->confirm(
            "Are you sure you want to delete this item?",
            function () use ($item) {
                $this->deleteItem($item);
            }
        );
    }

    private function deleteItem($item)
    {
        $this->http->delete("/api/admin/item/{$item->Id}")
            ->then(function () {
            // item has been deleted
        });
    }
```

## Methods

`confirm(string $title, ?callable $onConfirm = null, ?callable $onCancel = null)`

Confirmation dialog, make sure the user confirms his actions before making something important.

### Parameters

`title` - The message (confirmation question) that you want to display.

`onConfirm` - (optional), action, that will be performed if user confirms his action.

`onCancel` - (optional), action, that will be performed if user cancels his action.
