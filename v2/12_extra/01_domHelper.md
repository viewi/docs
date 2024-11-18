# DOM helper

`DomHelper` is a service that helps you with some elements on the front-end side:

```php
class DomHelper
{
    public function getDocument(): ?HtmlNode;
    public function getWindow(): ?HtmlNode;
}
```

`getDocument` - will return `Document` node to perform some actions.

For example, click outside

```php
    public function __construct(private DomHelper $dom) {}

    public function trackOutside()
    {
        $this->onDocumentClick = function (DomEvent $event) {
            if (
                $this->area !== $event->target
                && !$this->area->contains($event->target)
            ) {
                // click is outside
                $this->onOutside();
            }
        };
        $this->dom->getDocument()->addEventListener('click', $this->onDocumentClick);
    }

    public function destroy()
    {
        $this->dom->getDocument()->removeEventListener('click', $this->onDocumentClick);
    }
```

`getWindow` -- will return `Window` node.

Useful for calculating scroll position.

```php
    public function calculateStyle()
    {
        $position = '';
        if ($this->base) {
            $contentBox = $this->base->getBoundingClientRect();
            $window = $this->dom->getWindow();
            $top = $contentBox->bottom + $window->scrollY;
            $left = $contentBox->left + $window->scrollX;
            $position = "top: {$top}px; left: {$left}px; width: {$contentBox->width}px; max-height: 310px;";
        }
        $this->style = "display: block; z-index: {$this->zIndex}; $position";
    }
```