# Code editor

A code editor UI component is a specialized user interface element designed for writing, editing, and managing source code. It provides features tailored to developers, such as syntax highlighting, autocompletion, and error detection, to enhance productivity and code quality. Unlike rich text editors, code editors focus on plain text with programming-specific functionality, often resembling lightweight versions of IDEs like Visual Studio Code.

## Usage

The usage is similar to rich text component, but with `codeEditor` property set to `true`.

<div>
    <FormsExample example="code-editor" summary="<h1>Code editor right in your browser</h1>" />
</div>

```html
<BaseInput name="Summary" id="Summary" label="Summary">
    <RichEditor 
        codeEditor 
        id="Summary"  
        model="$summary" 
    />
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
