# Template Syntax

## Text

To render the component's property in your template you can use it as PHP variable without any opening and closing tags (`<?php`, `?>`, `<?=`):

```html
<div>$message</div>
```

On front-end side Viewi will track changes in your component and will trigger rerendering of that specific part only. In this case if `$message` gets changed, Viewi will update that `div` content accordingly.

For complex expressions you ca use `{expression}` syntax:

```html
<div>{!empty($message) ? $message : ''}</div>
```

```html
<div>{ $valid ? 'OK': 'Error' }</div>
```

**Please note:** all values are automatically HTML encoded (rendered as plain text).

**Please note:** if you need to output `$` or `{` without triggering interpolation you can escape these with backslash: `\$` and `\{`

## Raw HTML

To output raw HTML use a double mustache syntax, like this:

```html
<div>{{$html}}</div>
```

**WARNING**  
Rendering HTML on your website can be very dangerous due to <a target="_blank" href="https://en.wikipedia.org/wiki/Cross-site_scripting" rel="noopener noreferrer">XSS vulnerabilities</a>. Use it only on trusted content.

## Expressions

It you need to render something that component method returns, you can use method as a function in your template:

```html
<div>{getFullName()}</div>
```

Viewi will trigger rerendering of that HTML element only if you change properties and dependencies that this method uses. Viewi gets you covered automatically.

## Attributes

Rendering attribute values could not be easier, the syntax is all the same:

```html
<a href="$href" class="red $myClass">Click here</a>
<a href="{getLatestUrl()}">Latest</a>
```

## Nullable Attributes

Viewi will automatically recognize `NULL` values and will not render attribute in this case. For example:

```html
<div id="$id">Content</div>
```

If your `$id` is `null`, you will get `div` without an id attribute:

```html
<div>Content</div>
```

If your `$id` is `'my-id'`, you will get `div` with an id attribute:

```html
<div id="my-id">Content</div>
```

## Dynamic Attributes

Do not know your attribute name upfront? Not a problem:

```html
<div $attributeName="my-value"></div>
<div {getName()}="my-value"></div>
```

## Boolean Attributes

If the HTML attribute is boolean you can bypass a condition into an attribute value, and it will render the attribute based on that condition. 

List of boolean attributes: 

```
async autofocus autoplay checked controls default defer disabled formnovalidate hidden ismap itemscope loop multiple muted nomodule novalidate open readonly required reversed selected
```

```html
<button disabled="$isDisabled">Send</button>
```

Based on value of `isDisabled` property, the results will be next:

`false`

```html
<button>Send</button>
```

`true`

```html
<button disabled="disabled">Send</button>
```

## Conditional Attributes

Conditional attributes help you to simplify using the attributes based on conditions. 

For example, instead of using `$condition ? 'one' : 'two'` like here:

```html
<div class="panel {$selected ? 'show' : ''}"></div>
```

you can use `class.show="$selected"` like this:

```html
<div class="panel" class.show="$selected"></div>
```

You can have as many attributes as you want, all of them will be merged together during rendering.

## Template Tag

`template` tag allows you to combine the content into one logical entity. It is a virtual tag and only its content will be rendered.

It is useful for grouping and combinations with `if` or `foreach`, which you can learn more in the next chapters.

Wrapping text node into `template` in order to use `if` directive:

```html
<template if="$user !== null">
    {$user->name}
</template>
```

## Dynamic Tag

It happens that at some point you don not know what tag it will be during the application`s life. Therefore you are free to use a dynamic tag, like this:

```html
<$tag>Some content</$tag>
```