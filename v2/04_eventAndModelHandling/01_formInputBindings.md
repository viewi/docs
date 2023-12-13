# Form input bindings

## Text

You can use `model="$myValue"` directive to create two-way data binding on form inputs. For example:

```php
class EventHandling extends BaseComponent
{
    public string $name = '';
}
```

```html
<input model="$name" placeholder="Enter your name" />
<div>Your name is: $name</div>
```

The result:

<TextBindExample />

### Multiline Text

For `textarea` everything is the same. For example:

```php
class EventHandling extends BaseComponent
{
    public string $message = '';
}
```

```html
<textarea model="$message" placeholder="Enter your message"></textarea>
<div>Your message is:</div>
<p style="white-space: pre-line;">$message</p>
```

The result:

<TextAreaBindExample />

**Please note:** interpolation `<textarea>$message</textarea>` will not work.

## Checkbox

Same here, use two-way data binding directive for `checkbox` type. For example:

```php
class EventHandling extends BaseComponent
{
    public bool $checked = false;
}
```

```html
<label>
    <input type="checkbox" model="$checked" /> Visible
</label>
<div if="$checked">I am visible!</div>
```

The result:

<CheckboxBindExample />

### Multiple checkboxes with array value binding:

```php
class EventHandling extends BaseComponent
{
    public array $checkedNames = [];

    function getNames()
    {
        return json_encode($this->checkedNames);
    }
}
```

```html
<input type="checkbox" id="jack" value="Jack" model="$checkedNames">
<label for="jack">Jack</label>
<input type="checkbox" id="john" value="John" model="$checkedNames">
<label for="john">John</label>
<input type="checkbox" id="mike" value="Mike" model="$checkedNames">
<label for="mike">Mike</label>
<br>
<span>Checked names: {getNames()}</span>
```

The result:

<CheckboxMultiBindExample />

## Radio

Same here, use two-way data binding directive for radio type. For example:

```php
class EventHandling extends BaseComponent
{
    public string $picked = '';
}
```

```html
<input type="radio" id="one" value="One" model="$picked">
<label for="one">One</label>
<br>
<input type="radio" id="two" value="Two" model="$picked">
<label for="two">Two</label>
<br>
<span>Picked: $picked</span>
```

The result:

<RadioBindExample />

## Select

Same as well:

```php
class EventHandling extends BaseComponent
{
    public string $selected = '';
}
```

```html
<select model="$selected">
    <option disabled value="">Please select one</option>
    <option>A</option>
    <option>B</option>
    <option>C</option>
</select>
<span>Selected: $selected</span>
```

The result:

### Multiple select and array binding

```php
class EventHandling extends BaseComponent
{
    public array $selectedList = [];
}
```

```html
<select model="$selectedList" multiple>
    <option>A</option>
    <option>B</option>
    <option>C</option>
</select>
<br>
<span>Selected: {json_encode($selectedList)}</span>
```

The result:

<SelectMultiBindExample />