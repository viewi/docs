# Action Form

An Action Form component is a user interface element designed to collect
and submit user input in applications, commonly used in web and mobile development.

## Example

```html
<ActionForm #loginForm (submit)="onSubmit">
    <TextInput label="Name" type="text" model="$user->Name" />
    <TextInput label="Email" type="text" model="$user->Email" />
    <button type="submit">Submit</button>
</ActionForm>
```

```php
class FormExample extends BaseComponent
{
    public ExampleModel $user;

    public function onSubmit(DomEvent $event)
    {
        $event->preventDefault();
        // process $this->user        
    }
}
```

## Properties

`id` - (optional), id attribute of the form.

`method` - (optional), method attribute of the form.

`action` - (optional), action attribute for the form.

`classList` - (optional), additional classes for the form.

`autocomplete` - (optional), autocomplete attribute for the form.

`rules` - (optional), validation rules for the form.

## Events

`(submit)` - event that happens when the form gets submitted.


