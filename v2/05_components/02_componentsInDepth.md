# Components In-Depth

## Unique Id

Each component has a unique id, which is assigned on component creation:

```php
abstract class BaseComponent
{
    public string $__id;
}
```

Useful for form components with labels:

```php
class MyTextInput extends BaseComponent
{
    public ?string $id = null;

    function getId(): string
    {
        return $this->id ?? "input-{$this->__id}";
    }
}
```

```html
<label for="{getId()}">First Name</label>
<input id="{getId()}" type="text" />
```

## DOM element reference

```php
abstract class BaseComponent
{
    public ?HtmlNode $_element = null;
}
```

`_element` contains a reference for the root DOM node of the component template:

```php
class MyButton extends BaseComponent
{
    function onClick(DOMEvent $event)
    {
        // _element has a reference to the button DOM node
        $this->_element->blur();
    }
}
```

```html
<button (click)="onClick"><slot></slot></button>
```

## References (Refs)

Sometimes it is useful to have references to specific DOM elements in your template.

Syntax: `#myName attribute`.

All references will be stored in the `_refs` (associative array) property and you can access it with the name of your reference: `$this->_refs['myTarget']`.

```html
<div (click)="onClickOutside"><span #myTarget>Inside Content</span></div>
```

```php
class NavigationDrawer extends BaseComponent
{
    // click outside
    function onClickOutside(DOMEvent $event)
    {
        if (
            $this->_refs['myTarget'] !== $event->target 
            && !$this->_refs['myTarget']->contains($event->target)
        ) {
            // click is outside
        }
    }
}
```

Additionally you can create a property with your reference name and it will be assigned automatically once element is rendered:

```php
class NavigationDrawer extends BaseComponent
{    
    public ?HtmlNode $myTarget = null;

    // click outside
    function onClickOutside(DOMEvent $event)
    {
        if (
            $myTarget !== $event->target 
            && !$myTarget->contains($event->target)
        ) {
            // click is outside
        }
    }
}
```

## Model and two-way data binding on components

```html
<ChildComponent model="$value"></ChildComponent>
```

In order to use that you just need to declare a `$model` property in your `ChildComponent`. And use `emitEvent('model', $event)` to notify the parent about the change:

```php
class TestInput extends BaseComponent
{
    public ?string $model = null;

    public function onInput(DomEvent $event)
    {
        $this->emitEvent('model', $event->target->value);
    }
}
```

```html
<input (input)="onInput" model="$model" placeholder="Test Input" />
```

## Input properties (Props)

```php
abstract class BaseComponent
{
    public array $_props = [];
}
```

`$_props` property (associative array) contains all input properties that had been passed to the component from parent:

```html
<MyComponent id="my-id" class="my-class" title="title" (click)="onClick"></MyComponent>
```

```php
class MyComponent extends BaseComponent
{
    function clickable(): bool
    {
        return isset($this->_props['(click)']);
    }

    function getClasses()
    {
        return $this->_props['class'] ?? '';
    }
}
```

### Passing properties all at once

Sometimes it is useful to pass all the properties as an array. 

```html
<MyComponent id="my-id" class="my-class" title="title"></MyComponent>
<!-- OR pass as an array -->
<MyComponent _props="$childProperties"></MyComponent>
<!-- OR pass all parent props -->
<MyComponent _props="{$_props}"></MyComponent>
```

## Emit Event

Once you have your component, you may want to pass some events to the parent component. You can do it with `emitEvent` method:

```php
abstract class BaseComponent
{
    function emitEvent(string $eventName, $event = null);
}
```

For example:

```php
class MyButton extends BaseComponent
{
    function onClick(DOMEvent $event)
    {
        // emit it to the parent
        $this->emitEvent('click', $event);
    }
}
```

```html
<button (click)="onClick"><slot></slot></button>
```

Here you will receive the event from children

```html
<MyButton (click)="onClick">My Button</MyButton>
```
