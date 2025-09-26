# Override component

Viewi allows you to override the component with another, your own implementation.

Simply apply the `OverrideComponent` attribute to the class of the new implementation with the name of the component that you are trying to override.

For example, let’s say there is a component `FooterIcon` in some third-party package that you would like to extend or replace. And you don’t have access, or the package is auto-updated during CI.

All you have to do is create a new component and mark it with override target:

```php
use Viewi\Components\Attributes\OverrideComponent;

#[OverrideComponent(FooterIcon::class)]
class BetterFooterIcon extends FooterIcon
{
    public string $classList = "animated-app-icon";
}
```

```html
<Icon classList="$classList" name="flower" />
```

In this example, `BetterFooterIcon` overrides the `FooterIcon` component completely. 
Meaning it will render our `BetterFooterIcon` in places where `FooterIcon` is used.

Declaring an HTML template is optional; you can skip that, and the component will reuse its target template.