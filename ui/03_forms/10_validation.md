# Validation

Validation in UI forms ensures user input meets specific criteria before submission, enhancing data quality and user experience.

It involves checking input for correctness, completeness, and compliance with predefined rules.

Using validation in your `ActionForm` is easy with validation `rules` property.

Validation rules format is next:

Array with associative keys that match input's `name` or `id` attribute.

The values is the associative list of different validation rules, where the key is the name of the rule, like `required`, `email`, `my-rule`, etc.

And the value is the validation function.

For example:

```html
<TextInput label="Email" name="Email" type="text" model="$user->Email" />
```

```php
$this->validationRules = [
    // input's name attribute, Email
    'Email' => [
        // list of rules
        // the Name is required
        'required' => function() {
            // return false or the error string if value is invalid
            if (!$this->user->Email) {
                return "Email is required";
            } 
            // return true if value is valid
            return true;
        }
    ]
];
```

## Example

<div>
    <FormsExample example="validation" />
</div>

```html
<ActionForm #loginForm (submit)="onSubmit" rules="$validationRules">
    <TextInput label="FirstName" name="FirstName" type="text" model="$user->FirstName" />
    <TextInput label="Email" name="Email" type="text" model="$user->Email" />
    <button type="submit" class="btn btn-primary">Submit</button>
</ActionForm>
```

```php
class FormExample extends BaseComponent
{
    public ExampleModel $user;
    private ?ActionForm $loginForm = null;
    public array $validationRules = [];

    public function init(): void
    {
        $this->user = new ExampleModel();
        $this->validationRules = [
            'FirstName' => [
                'required' => fn() => !$this->user->FirstName 
                    ? 'First Name is required' 
                    : true
            ],
            'Email' => [
                'required' => fn() => !$this->user->Email 
                    ? 'Email is required' 
                    : true,
                'email' => function () {
                    if ($this->user->Email) {
                        $parts = explode('@', $this->user->Email, 2);
                        return !!(explode('.', $parts[1] ?? '')[1] ?? false) 
                            ? true 
                            : 'Wrong email format.';
                    }
                    // no value
                    return true;
                }
            ]
        ];
    }

    public function onSubmit(DomEvent $event)
    {
        $event->preventDefault();
        // validate loginForm
        if (!$this->loginForm->validate()) {
            return;
        }
        // process $this->user        
    }
}
```

## Fallback validation

If you need to validate the form regardless of the input rules, 
or if you need to display a generic error message 
you can use `ValidationMessage` component with `fallback` property set to true:

```html
<ActionForm #loginForm (submit)="onSubmit" rules="$validationRules">
    <TextInput label="FirstName" name="FirstName" type="text" model="$user->FirstName" />
    <TextInput label="Email" name="Email" type="text" model="$user->Email" />
    <ValidationMessage #generalMessages fallback="true" />
    <button type="submit" class="btn btn-primary">Submit</button>
</ActionForm>
```

```php
// ...
public function init(): void
{
    // general validation rule, not attached to any of the input
    $this->validationRules = [
        'general' => [
            'shouldNotMatch' => fn() => $this->user->FirstName === $this->user->Email 
                ? 'Email can not be used as a First Name' 
                : true
        ],
    ];
}
```

Or you can display errors dynamically from the code:

```php
public ?ValidationMessage $generalMessages = null;

public function showError(DomEvent $event)
{
    $this->generalMessages->messages = ['Validation has failed'];
    $this->generalMessages->show = true;
}
```

<div>
    <FormsExample example="validation-fallback" />
</div>