# Conditional Rendering

## `if` directive

To render the block based on condition use `if` attribute with an expression. The block will be rendered only if the condition is `true`:

```html
<div if="$marvelous">
    Viewi is marvelous!
</div>
```

Will result to:

```html
<div>
    Viewi is marvelous!
</div>
```

## `else-if` directive

You can extend conditional rendering by using `else-if` attribute with an expression. The block will be rendered only if the condition is `true` and previous `if` or `else-if` blocks are `false`:

```html
<div if="$weather == 'sunny'">
    It is nice and sunny outside today.
</div>
<div else-if="$weather == 'rainy'">
    Oh no, it is raining again.
</div>
```

Will result to:

```html
<div>
    Oh no, it is raining again.
</div>
```

**Please note:** `else-if` block should be right after another `if` or `else-if` block.

## `else` directive

Of course you can also have `else` conditional block. The block will be rendered only if all the previous conditions are `false`:

```html
<div if="$weather == 'sunny'">
    It is nice and sunny outside today.
</div>
<div else-if="$weather == 'rainy'">
    Oh no, it is raining again.
</div>
<div else>
    Take an umbrella in case it may rain.
</div>
```

Will result to:

```html
<div>
    Take an umbrella in case it may rain.
</div>
```

**Please note:** `else` block should be right after another `if` or `else-if` block.

## Grouping with `template`

You can group a couple of elements into one conditional block by using `template`.

Useful when you want to render some text or group of elements based on condition:

```html
<template if="$show">
    Just text
</template>
<template if="$open">
    <h1>Title</h1>
    <div>Message</div>
    <p>Content</p>
</template>
```

Will result to:

```html
Just text
<h1>Title</h1>
<div>Message</div>
<p>Content</p>
```