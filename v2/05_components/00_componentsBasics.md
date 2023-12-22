# Components Basics

## Creating

To create a new component all you have to do is just to create two files with the same name: `ComponentName.html` for template and `ComponentName.php` for code logic.

**Please note:** both files should be in the same folder.

Inside your php file create a class derived from `Viewi\Components\BaseComponent`

For example, let's create `Counter` component.

`viewi-app/Components/Views/Counter/Counter.php`

```php
<?php

namespace Components\Views\Counter;

use Viewi\Components\BaseComponent;

class Counter extends BaseComponent
{
    public int $count = 0;
    
    public function increment()
    {
        $this->count++;
    }
}
```

`viewi-app/Components/Views/Counter/Counter.html`

```html
<button (click)="increment">Clicked $count times.</button>
```

From now on you can use it as a tag with the same name as your class name: `<Counter />`

## Reusing Components

You can reuse components as many times as you want. Each of them will have their own scope of data and reactive flow. For example:

```html
<Counter />
<Counter />
<Counter />
```

The result:

<CounterExample />
<CounterExample />
<CounterExample />

## Passing Data through Properties

You can pass data to the child component using html attributes. It can pass literals like strings, numbers, booleans or you can pass an expression. 

For example, let's create `HelloMessage` component:

```php
<?php

namespace Application\Components\Views\Demo;

use Viewi\Components\BaseComponent;

class HelloMessage extends BaseComponent
{
    public string $name;
}
```

```html
<div>Hello $name</div>
```

And now we can pass data to the component as a custom attribute:

```html
<HelloMessage name="John Smith" />
<HelloMessage name="Viewi" />
<HelloMessage name="{getFullName()}" />
```

The result:

<HelloMessageExample name="John Smith" />
<HelloMessageExample name="Viewi" />
<HelloMessageExample name="Bruce Wayne" />

## Dynamic Components

In case you want to define your component name dynamically at runtime you can use dynamic component syntax. 

For example:

```php
class ComponentsBasics extends BaseComponent
{
    public $currentPage = 'HelloMessage';
}
```

```html
<$currentPage name="Dynamic Component" />
```

The result:

<HelloMessageExample name="Dynamic Component" />

## Slots

Quite often you will need to pass the content into child component through inner HTML like this:

```html
<Notification>
    <i>Karolina</i> sent you a message.
</Notification>
```

This can be easily achieved with a special `slot` tag, like this:

`Notification.html`

```html
<div>
    <strong>New notification:</strong>
    <slot></slot>
</div>
```

The result:

<NotificationExample>
    <i>Karolina</i> sent you a message.
</NotificationExample>

### Named Slots

Sometimes you will need to pass different contents into different places to render. A good example for this case is layout. Consider we want something like this:

```html
<div class="header">
    <!-- header content here -->
</div>
<main>
    <!-- main content here -->
</main>
<footer>
    <!-- footer content here -->
</footer>
```

For that cases a `slot` tag can be used with a `name` attribute to define where each content belongs to. To specify content for each `slot` use `slotContent` tag with a `name` attribute. 

Content from `slotContent` goes to `slot` with the same name. The rest of the content (outside slotContent) goes to `slot` without `name` attribute (slot by default). 

For example:

`BaseLayout.html`

```html
<div class="header">
    <slot name="header"></slot>
</div>
<main>
    <slot></slot>
</main>
<footer>
    <slot name="footer"></slot>
</footer>
```

Using `BaseLayout`:

```html
<BaseLayout>
    <slotContent name="header">
        This is my header content
    </slotContent>
    <p>
        Some blog post
    </p>
    <slotContent name="footer">
        <p>Some footer links and copyright</p>
    </slotContent>
</BaseLayout>
```

The result:

<BaseLayoutExample>
    <slotContent name="header">
        This is my header content
    </slotContent>
    <p>
        Some blog post
    </p>
    <slotContent name="footer">
        <p>Some footer links and copyright</p>
    </slotContent>
</BaseLayoutExample>

### Fallback Content

You can set a default content in case if no content is provided. Just place fallback content inside a `slot` tag:

```html
<button>
    <slot>Submit</slot>
</button>
```

Then use it without content:

```html
<SubmitButton></SubmitButton>
```

Will generate:

<button>Submit</button>

Or with provided content:

```html
<SubmitButton>
    Save
</SubmitButton>
```

Will generate:

<button>Save</button>

## Using with if and foreach

You can use `foreach` with components as well as `if`, `else`, `else-if`:

Let's say you have a `PostComponent` component:

```php
class PostComponent extends BaseComponent
{
    public string $content;
}
```

```html
<p>$content</p>
```

You can use it with `foreach`:

```php
class ComponentsBasics extends BaseComponent
{
    public array $posts = [
        'Viewi is awesome!',
        'Lorem ipsum dolor sit amet'
    ];
}
```

```html
<PostComponent foreach="$posts as $post" content="$post"></PostComponent>
```

Will generate:

Viewi is awesome!

Lorem ipsum dolor sit amet

And this:

```html
<PostComponent if="true" content="Viewi is awesome!"></PostComponent>
```

Will generate:

Viewi is awesome!