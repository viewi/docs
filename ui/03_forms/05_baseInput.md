# Base Input

A base input UI component is a wrapper element for your custom inputs with default items, such as label, hint, validation. etc.

## Usage

<div>
    <FormsExample example="base-input" />
</div>

```html
<BaseInput name="Summary" label="Summary">
    <textarea 
        placeholder="The summary of this page" 
        id="Summary" 
        rows="5" 
        model="$summary"
        class="w-100"
    ></textarea>
</BaseInput>
```

## Properties

`id` - (optional), id attribute of the label `for` attribute.

`label` - (optional), label text for the input.

`hint` - (optional), hint text for the input.

`wrapperClass` - (optional), class attribute for the wrapper container.

`inset` - (optional), boolean, makes the height of the input smaller.

## Slots

`default` - default slot fot the input.
