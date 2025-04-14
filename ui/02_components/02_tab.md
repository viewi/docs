# Tabs

A Tabs UI component is a widely used user interface element in web and mobile applications designed to organize and display content efficiently. It allows users to navigate between different sections or categories of information within a single view, making it ideal for saving screen space and improving user experience.

## Example: 

<div>
    <Tabs>
        <Tab title="First tab" active>
            <strong>This is the first item's tab body.</strong>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt
            ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat.
        </Tab>
        <Tab title="Second tab">
            <strong>This is the second item's tab body.</strong>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt
            ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat.
        </Tab>
    </Tabs>
</div>

```html
<Tabs>
    <Tab title="First tab" active>
        <strong>This is the first item&amp;s tab body.</strong>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
        sed do eiusmod tempor incididunt
        ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip
        ex ea commodo consequat.
    </Tab>
    <Tab title="Second tab">
        <strong>This is the second item&amp;s tab body.</strong>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit,
        sed do eiusmod tempor incididunt
        ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip
        ex ea commodo consequat.
    </Tab>
</Tabs>
```

## Parameters

### `Tabs`

`id` - (optional), sets the id of the container.

`classList` - (optional), sets the class list of the container.

<div>
    <Tabs id="general" classList="px-5">
        <Tab title="First tab" active>
            The content
        </Tab>
        <Tab title="Second tab">
            The content
        </Tab>
    </Tabs>
</div>

```html
<Tabs id="general" classList="px-5">
    <Tab title="First tab" open>
        The content
    </Tab>
    <Tab title="Second tab">
        The content
    </Tab>
</Tabs>
```

### `Tab`

`id` - (optional), sets the id of the tab.

`classList` - (optional), sets the class list of the tab.

`title` - sets the title of the tab. Default: '' (empty).

`active` - sets the open state of the tab. Default: `false`.

```html
<Tabs>
    <Tab
        id="general"
        classList="bg-primary"
        title="First tab"
        active
    >
        The content
    </Tab>
</Tabs>
```