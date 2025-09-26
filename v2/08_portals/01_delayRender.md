# Delay render

`DelayRender` component allows you to postpone the render until the end.

## Using delayed rendering

To define the content that should be rendered after everything else is rendered, use `DelayRender` component :

```html
<DelayRender>
    <div>
        Page score is $calculatedTotal
    </div>
</DelayRender>
```

Useful when the render of your component happens at the top (ex., SEO meta tags in the head),
but the necessary information is being collected during other components' lifetimes.

## Server-side rendering and delaying

`RenderDelay` has full server-side rendering (SSR) support unless you specify different with custom JavaScript or conditions.
In that case, you should write your code with consideration of the hydration process.