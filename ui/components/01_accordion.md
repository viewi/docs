# Accordion

Accordion is designed to save space by splitting the content into logical parts and collapsing unnecessary information.

## Example: 

<div>
    <Accordion>
        <AccordionTab title="Accordion Item #1" open="true">
            <strong>This is the first item's accordion body.</strong> 
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
            sed do eiusmod tempor incididunt
            ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat.
        </AccordionTab>
        <AccordionTab title="Accordion Item #2" open="false">
            <strong>This is the second item's accordion body.</strong> 
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
            sed do eiusmod tempor incididunt
            ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat.
        </AccordionTab>
    </Accordion>
</div>

```html
<Accordion>
    <AccordionTab title="Accordion Item #1" open="true">
        <strong>This is the first item&amp;s accordion body.</strong> 
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
        sed do eiusmod tempor incididunt
        ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip
        ex ea commodo consequat.
    </AccordionTab>
    <AccordionTab title="Accordion Item #2" open="false">
        <strong>This is the second item&amp;s accordion body.</strong> 
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
        sed do eiusmod tempor incididunt
        ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip
        ex ea commodo consequat.
    </AccordionTab>
</Accordion>
```

## Parameters

### `Accordion`

`id` - (optional), sets the id of the container.

`classList` - (optional), sets the class list of the container.

`multiple` - (optional), allows multiple tabs to be opened at the same time. Default: false.

<div>
    <Accordion id="general" classList="px-5" multiple>
        <AccordionTab title="Accordion Item #1" open="true">
            The content
        </AccordionTab>
        <AccordionTab title="Accordion Item #2">
            The content
        </AccordionTab>
    </Accordion>
</div>

```html
<Accordion id="general" classList="px-5" multiple>
    <AccordionTab title="Accordion Item #1" open="true">
        The content
    </AccordionTab>
    <AccordionTab title="Accordion Item #2">
        The content
    </AccordionTab>
</Accordion>
```

### `AccordionTab`

`id` - (optional), sets the id of the tab.

`classList` - (optional), sets the class list of the tab.

`title` - sets the title of the tab. Default: '' (empty).

`open` - sets he open state of the tab. Default: `false`.

```html
<Accordion>
    <AccordionTab
        id="general"
        classList="bg-primary"
        title="Accordion Item #1"
        open="true"
    >
        The content
    </AccordionTab>
</Accordion>
```