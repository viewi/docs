# Checkbox

A checkbox UI component is a graphical element in a user interface that allows users to make a binary choice, typically between selecting or deselecting an option.

## Usage

<div>
    <FormsExample example="checkbox" />
</div>

```html
<CheckBox label="Remember Me" model="$rememberMe" />
<div if="$rememberMe">
    You will be remembered!
</div>
<div else>
    Sure, do not worry, we will keep you safe!
</div>
```

```php
<?php

class FormsExample extends BaseComponent
{
    public bool $rememberMe = false;
}
```

## Properties

`model` - two-way data binding.

`label` - (optional), label text for the input.

`hint` - (optional), hint text for the input.

`id` - (optional), id attribute of the input.

`name` - (optional), name attribute of the input.

`isInvalid` - (optional), boolean, marks the input as invalid, adds error highlight.

## Events

`(change)` - event that happens when the value gets changed.

## Slots

`default` - (optional), default slot, renders after the hint container.
