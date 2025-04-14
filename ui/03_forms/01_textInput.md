# Text Input

A Text Input component is a UI element within a form or interface that allows users to enter and edit text data, such as names, emails, or search queries.

## Usage

<div>
    <FormsExample />
</div>

```html
<TextInput label="First Name" type="text" model="$firstName" />
<TextInput label="Last Name" type="text" model="$lastName" />
<div>
    You have entered: {$firstName} {$lastName}
</div>
```

```php
<?php
class FormsExample extends BaseComponent
{
    public string $firstName = '';
    public string $lastName = '';
}
```

## Text Area

To make your input a textarea, set `textarea` property:

<div>
    <FormsExample example="textarea" />
</div>

```html
<TextInput label="Summary" textarea model="$summary" />
```

Add `rows` and `cols` if necessary:

```html
<TextInput label="Summary" textarea cols="6" rows="6" model="$summary" />
```

## Placeholder and Hint

You can add a placeholder for your input with `placeholder` property.

And hint with `hint` property:

<div>
    <FormsExample example="placeholder" />
</div>

```html
<TextInput 
    label="First Name" 
    type="text"
    placeholder="Enter your first name"
    hint="Example: Mike, Josh, etc."
    model="$firstName" 
/>
```

## Slot

If you need to extend the content of the input, you can use the slot feature:

```html
<TextInput 
    label="First Name" 
    type="text"
    model="$firstName" 
>
```

## Properties

`model` - two-way data binding.

`type` - (optional), type of the input. 

`type` options: `color, date, datetime-local, email, month, number, password, tel, text, time, url, week`. Default: `null`, means `text`.

`placeholder` - (optional), placeholder of the input.

`label` - (optional), label text for the input.

`hint` - (optional), hint text for the input.

`autocomplete` - (optional), autocomplete attribute for the input.

`inputClass` - (optional), class attribute for the input.

`wrapperClass` - (optional), class attribute for the wrapper container.

`id` - (optional), id attribute of the input.

`name` - (optional), name attribute of the input.

`textarea` - (optional), will use `textarea` instead of `input`.

`rows` - (optional), rows attribute for textarea.

`cols` - (optional), cols attribute for textarea.

`inset` - (optional), boolean, makes the height of the input smaller.

## Events

`(input)` - event that happens when the element gets user input.

## Slots

`default` - (optional), default slot, renders after the hint container.
