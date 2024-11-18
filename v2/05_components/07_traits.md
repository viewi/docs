# Traits support

Well, it speaks for itself. Viewi supports traits now in both - server and client sides.

```php
trait HasLocalization
{
    #[Inject(Scope::SINGLETON)]
    public Localization $localization;
}
```

Dependency injection is available with `Inject` attribute.

```php
class ContentPage extends BaseComponent
{
    use HasLocalization;

    public function init()
    {
        //...
        if ($pageNotFound) {
              $this->title = $this->localization->t('layout.page-not-found');
          }
    }
}
```

Easy!