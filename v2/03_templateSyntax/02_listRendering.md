# List Rendering

## `foreach` directive

To render a list of items use `foreach` directive like this:

```php
public $fruits = ["Orange", "Apple"];
```

```html
<div foreach="$fruits as $fruit">
    $fruit
</div>
<div foreach="$fruits as $index => $fruit">
    {$index + 1}. $fruit
</div>
```

Will result to:

```html
<div>
    Orange
</div>
<div>
    Apple
</div>
<div>
    1. Orange
</div>
<div>
    2. Apple
</div>
```

# `foreach` and `if` combinations

You are free to use `foreach` and `if` (`else-if`, `else`) on the same element. But keep in mind that the order matters: firstly will be evaluated whatever it is declared first. For example, this will check `if` condition first, and if it is `true` then will run `foreach`:

```html
<div if="$open" foreach="$fruits as $fruit">
    $fruit
</div>
```

And this will run `foreach` first, and then check `if` condition for each iteration:

```html
<div foreach="$users as $user" if="$user->isActive">
    {$user->name}
</div>
```

# `foreach` and `template`

`foreach` can be easily used in combination with `template` to group elements for each iteration:

```html
<template foreach="$fruits as $fruit">
    <h1>$fruit</h1>
    <p>Some text..</p>
</template>
```