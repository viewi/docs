# Modal

A Modal UI component, often referred to as a modal window or dialog, is a user interface element that appears on top of the main content of an application or website, temporarily interrupting the user’s workflow to display information, prompt an action, or gather input. It’s designed to focus the user’s attention on a specific task or message, blocking interaction with the underlying content until the modal is dismissed.

## Example: 

<div>
    <button class="btn btn-primary" (click)="$_refs['demomodal']->show = true">Show Modal</button>
    <Modal #demomodal header="Modal demo" closeButton>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
        dolore magna aliqua.
    </Modal>
</div>

HTML:

```html
<button (click)="showModal">Show Modal</button>
<Modal #modal header="Modal demo" closeButton>
    Lorem ipsum dolor sit amet,
    consectetur adipiscing elit,
    sed do eiusmod tempor incididunt ut labore et
    dolore magna aliqua.
</Modal>
```

PHP:

```php
public ?Modal $modal = null;

function showModal() {
    $this->modal->show = true;
}
```

Or, just use `refs`

```php
function showModal() {
    $this->_refs['modal']->show = true;
}
```

Or, inline click:

```html
<button (click)="$_refs['modal']->show = true">Show Modal</button>
```

## Parameters

### `Modal`

`header` - (optional), sets the header text of the modal.

`title` - (optional), sets the title of the modal. Use it for short messages without the body content.

`size` - (optional), sets the size of the modal. Available values: `sm`, `lg`, `xl`.

`id` - (optional), sets the id of the container.

`classList` - (optional), sets the class list of the container.

`show` - (optional), sets the show state of the modal window. Default: `false`.

`closeButton` - (optional), displays the close icon button if set. Default: `false`.

Confirmation button:

`showConfirm` - (optional), show the confirmation button if set.

`confirmButtonText` - (optional), sets the confirmation button text. Default: `Ok`.

`confirmButtonClass` - (optional), sets the confirmation button class. Default: `btn-primary`.

Cancel button:

`showCancel` - (optional), show the cancel button if set.

`cancelButtonText` - (optional), sets the cancel button text. Default: `Cancel`.

## Events

`(confirm)` - Event that happens when you click the confirmation button.

`(cancel)` - Event that happens when you click the cancel button.

`(close)` - Event that happens when you click the close button.

<div>
    <button class="btn btn-primary" (click)="$_refs['modal']->show = true">Delete Item</button>
    <Modal #modal title="Are you sure you want to delete this item?" closeButton showConfirm
    confirmButtonText="Yes, delete" confirmButtonClass="btn-danger" showCancel cancelButtonText="No, cancel"
    />
</div>

HTML:

```html
<button (click)="showModal">Show Modal</button>
<Modal 
    #modal 
    title="Are you sure you want to delete this item?" 
    closeButton 
    showConfirm
    confirmButtonText="Yes, delete" 
    confirmButtonClass="btn-danger" 
    showCancel 
    cancelButtonText="No, cancel"
    (confirm)="deleteItem"
/>
```

