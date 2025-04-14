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

