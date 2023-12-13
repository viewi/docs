# Components and services

## Lifecycle hooks

Every Viewi component goes through a couple of steps during its lifecycle. It is possible to run custom code during these steps using lifecycle hooks. 

There it is a list of available lifecycle hooks at this moment:

 Hook            | Description                                                                                                                                         
-----------------|-----------------------------------------------------------------------------------------------------------------------------------------------------
 init        | Runs immediately a component is instantiated\. Can accept dependency injected services and route parameters\.
 mounted     | Runs right after passed through attribute values have been set to the component\.
 destroy     | Runs when instance is destroyed\. Use it to unsubscribe from events, etc\. Client side only\.


## Services and Models

Having Viewi components is good. But what about some service or model class? In this case you can take all advantages of using it, like sharing data or logic between components without repeating yourself. Let's move our Counter implementation into a separate `CounterState` class.

```php
<?php

namespace Application\Components\Services\Demo;

class CounterState
{
    public int $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
}
```

And now, we can reuse it anywhere by injecting into constructor, like this:

```php
<?php

namespace Application\Components\Views\Demo\ServicesAndModels;

use Application\Components\Services\Demo\CounterState;
use Viewi\Components\BaseComponent;

class ServicesExample extends BaseComponent
{
    public function __construct(public CounterState $counter)
    {
    }    
}
```

```html
<button (click)="$counter->decrement" class="mui-btn mui-btn--accent">-</button>
<span class="mui--text-dark mui--text-title">{$counter->count}</span>
<button (click)="$counter->increment" class="mui-btn mui-btn--accent">+</button>
```

Viewi takes care about dependency injections automatically, you do not need to worry about it.

Dependency Injection (DI) is a design pattern that allows you to inject automatically created services (or objects, etc.) without creating them manually.

The result will be next:

<CounterUseExample />

## Sharing a state

You can use a service as a store for sharing data between two components. It can even be preserved during your application lifecycle.

To specify lifecycle you can use attributes:

`Singleton` - creates one instance for the entire application.

`Scoped` - creates one instance per routing page. After you navigate to another page the previous instance will get disposed.

By default all components and services are `Transient` - new instance is created every time you request it.

An example:

`CounterStore.php`

```php
<?php

namespace Application\Components\Views\Demo\ServicesAndModels;

use Viewi\DI\Singleton;

#[Singleton]
class CounterStore
{
    public int $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
}
```

Now you can share this service between different components and all of them will have the same `count`. In case you change the `count` it will be updated in all places accordingly.

```php
ComponentA.php

<?php

namespace Application\Components\Views\Demo\ServicesAndModels;

use Viewi\Components\BaseComponent;
use Application\Components\Views\Demo\ServicesAndModels\CounterStore;

class ComponentA extends BaseComponent
{
    public function __construct(public CounterStore $counter)
    {
    }    
}
```

`ComponentA.html`

```html
<div>
    <div>Component A</div>
    <button (click)="$counter->decrement" class="mui-btn mui-btn--accent">-</button>
    <span class="mui--text-dark mui--text-title">{$counter->count}</span>
    <button (click)="$counter->increment" class="mui-btn mui-btn--accent">+</button>
</div>
```

```php
ComponentB.php

<?php

namespace Application\Components\Views\Demo\ServicesAndModels;

use Viewi\Components\BaseComponent;
use Application\Components\Views\Demo\ServicesAndModels\CounterStore;

class ComponentB extends BaseComponent
{
    public function __construct(public CounterStore $counter)
    {
    }    
}
```

`ComponentB.html`

```html
<div>
    Component B
    <div>Count: {$counter->count}</div>
</div>
```

The result:

<ComponentAExample />
<ComponentBExample />
