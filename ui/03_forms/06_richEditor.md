# Rich text editor

A rich text editor UI component is a user interface element that allows users to create, edit, and format text with advanced styling and multimedia capabilities, similar to word processors like Microsoft Word or Google Docs. It provides a WYSIWYG (What You See Is What You Get) experience, enabling users to apply formatting (e.g., bold, italic, headings) and embed media (e.g., images, videos) without writing code.

## Usage

<div>
    <FormsExample example="rich-text" />
</div>

```html
<BaseInput name="Summary" id="Summary" label="Summary">
    <RichEditor placeholder="The summary of this page" id="Summary"  model="$summary" />
</BaseInput>
<div>
    <h4>Preview</h4>
    <div>{{$summary}}</div>
</div>
```

## Properties

`model` - two-way data binding.

`codeEditor` - (optional), boolean, will use Code editor based on Monaco editor.

## Events

`(input)` - event that happens when the element gets user input.
