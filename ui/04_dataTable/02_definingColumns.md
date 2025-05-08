# Data Table - Defining Columns

Data table supports columns customization, allowing you to set up custom title or template for every column. 

## Custom Title

To set up title of the column, use `Title` property of `TableColumn` class, that also comes as a second parameter of the constructor.

Example:

```php
public function setUpColumns()
{
    // Columns definition
    $this->columns = [
        new TableColumn('Id', 'Hero Unique Number'),
        new TableColumn('Name', 'Hero Name'),
    ];        
}
```

The result:

<div>
    <TableExample example="columns-title" />
</div>

## Custom Template

To implement your custom template view for particular column you can use two available options.

### Template slot

To define your custom template for the column you just need to insert a `slotContent` with the name property as `column_{COLUMN_NAME}` into the `DataTable` component.

And  use the `data` property that will contain the variable name for the item of the list.

This slot content will replace the default `td` tag and its content, so make sure to wrap your slot content with a `td` tag.

You can use this opportunity to set up additional attributes, such as `class`, `width`, etc.

For example, a slot content for the `Name` column can be defined like this:

`<slotContent name="column_Name" data="$item">...`

Where `column_Name` is a slot name,

and `$item` is a variable name, in our case, `HeroModel` object, that you can use in your template.

```html
<DataTable columns="$columns" items="$items">
    <slotContent name="column_Name" data="$item">
        <td>
            <div>{$item->Name} ({$item->Id})</div>
            <div class="mt-2">
                {$item->Description}
            </div>
        </td>
    </slotContent>
</DataTable>
```

The result:

<div>
    <TableExample example="columns-slot" />
</div>


### Template Component

You can also use another component as a template for the column.

The benefit of this is that you can define the template once, and use it for multiple tables.

Like dates, boolean checkmark, etc.

Pass it as a third argument, for example:

```php
public function setUpColumns()
{
    // Columns definition
    $this->columns = [
        new TableColumn('Id', 'Hero Unique Number'),
        // let's use HeroNameColumn component for the Name column
        new TableColumn('Name', 'Hero Name', 'HeroNameColumn'),
    ];        
}
```

And `HeroNameColumn` itself should implement these structure:

```php
{
    // current column value, e.g. value of the Name property
    public $value = null;
    // current list item, e.g. HeroModel instance
    // use it if you need to implement more advanced template
    public $data = null;
}
```

In our case, the code will look like this:

```php
class HeroNameColumn extends BaseComponent
{
    public ?string $value = null;
    public ?HeroModel $data = null;
}
```

```html
<td class="text-center text-success">
    <Icon name="bi-check2-circle" />
    <div>{$value} ({$data->Id})</div>
    <div class="mt-2">
        {$data->Description}
    </div>
</td>
```

Or, you can extend `BaseColumnTemplate` abstract class, that will have `$value` and `$data` inside.

Optionally: you can use the mounted hook to reassign values to your preferred format and type.

Use `getCurrentValue` and `getCurrentItem` method to get current values.

Mark the component with `IncludeAlways` attribute to avoid tree shaking during the build.

```php
<?php

namespace ExamplesUi\Tables;

use ExamplesUi\HeroModel;
use Viewi\Components\Attributes\IncludeAlways;
use Viewi\Components\Lifecycle\OnMounted;
use Viewi\UI\Components\Tables\BaseColumnTemplate;

#[IncludeAlways]
class HeroNameColumn extends BaseColumnTemplate implements OnMounted
{
    public ?string $name = null;
    public ?HeroModel $hero = null;

    public function mounted()
    {
        $this->name = $this->getCurrentValue();
        $this->hero = $this->getCurrentItem();
    }
}
```

Now you can use `$name` and `$hero` instead:

```html
<td class="text-center text-success">
  <Icon name="bi-check2-circle" />
  <div>{$name} ({$hero->Id})</div>
  <div class="mt-2">
      {$hero->Description}
  </div>
</td>
```

The result:

<div>
    <TableExample example="columns-template" />
</div>