# Event Handling

## Listening to the events

To attach the event handler to an event use the event binding syntax:

```
(eventName)="statement"
```

For example:

```php
class EventHandling extends BaseComponent
{
    public int $count = 0;
}
```

```html
<button (click)="$count = $count + 1">Add 1</button>
<span>Count: <b>$count</b></span>
```

The result:

<EventHandling />

You can find the list of all available events at 
<a href="https://developer.mozilla.org/en-US/docs/Web/Events" target="_blank" rel="noopener noreferrer">Event reference</a>.

## Component's method as an event handler

You can use component's method as an event handler:

```php
class EventHandling extends BaseComponent
{
    public string $greetingMessage = '';
    
    function greet()
    {
        $this->greetingMessage = 'Hello Viewi!';
    }
}
```

```html
<button (click)="greet">Greet</button>
<b>$greetingMessage</b>
```

The result:

<GreetExample />

## Passing arguments

You can also pass arguments into the method:

```php
class EventHandling extends BaseComponent
{
    public string $greetingMessage = '';
    
    function greetByName($name)
    {
        $this->greetingMessage = "Hello $name!";
    }
```

```html
<button (click)="greetByName('Viewi')">Greet Viewi</button>
<button (click)="greetByName('Diana')">Greet Diana</button>
<b>$greetingMessage</b>
```

The result:

<GreetByNameExample />

## Event object

Sometimes you also need to access the original DOM event in your statement. For that purpose use `$event` variable or argument.

```html
<form (submit)="handleSubmit($event)">
    <button>Send</button>
</form>
```

Or

```html
<form (submit)="handleSubmit">
    <button>Send</button>
</form>
```

And now you can access it in your `handleSubmit` method:

```php
use Viewi\Components\DOM\DomEvent;

class EventHandling extends BaseComponent
{
    public function handleSubmit(DOMEvent $event)
    {
        $event->preventDefault();
    }
}
```

**Please note:** if you already have in your component property `$event`, then you will have to use `{$_component->event}` in order to use the template. `$event` is a magic variable that contains reference to the DOM event.

## Dynamic event

Well, if you really do not know what event it will be, you can use a dynamic syntax: 

`$myEventName="expression"`

Where `$myEventName` should contain a valid event attribute name, like this:

```php
public string $myEventName = '(click)';
```

Whenever you decide to change event name, the application will reattach events accordingly. You are allowed to change it to regular attribute name, that is also ok and application will remove the event and set attribute accordingly.