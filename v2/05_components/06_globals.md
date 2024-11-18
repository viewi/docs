# Global methods

Let us say you use the same method in a lot of your components. You would want to refactor it so you do not repeat the implementation.

```html
<h1>
    {localize('email.layout.title')}
</h1>
```

```php
class ContentPage extends BaseComponent
{
    //...
    public function localize(string $key)
    {
        return $this->service->get($key);
    }
```

Likely, Viewi allows you to create a single implementation and share it between all of your templates.

Mark the method you want to share with `#[GlobalEntry]` attribute:

```php
#[Singleton]
class Localization
{
    private array $resources = [
        'profile.name' => 'Your name',
        'profile.phone' => 'Phone number'
    ];

    // this method will become globally available in any template:
    #[GlobalEntry]
    public function t(string $key)
    {
        return $this->resources[$key] ?? $key;
    }
}
```

And it is available in any of your templates:

```html
<h1>
    {t('profile.name')}
</h1>
```
