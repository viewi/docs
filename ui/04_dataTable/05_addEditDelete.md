# Data Table - Create Edit Delete Actions

Data table has action buttons and column available for use.

## Create button

Pass `add` property (boolean) to enable create button.

Optionally, pass `addText` text for the button.

Use `(create)` event to handle the creation.

Example:

```html
<DataTable columns="$columns" items="$items" add addText="Create Hero" (create)="addNew" />
```

```php
<?php

namespace ExamplesUi\Tables;

use ExamplesUi\HeroModel;
use Viewi\Components\BaseComponent;
use Viewi\UI\Components\Tables\TableColumn;

class FormsExample extends BaseComponent
{
    //...

    public function addNew()
    {
        $id = count($this->items) + 1;
        $hero = new HeroModel();
        $hero->Id = ++$id;
        $hero->Name = 'Ant-Man #' . $id;
        $hero->Description = "Adventurer, Biochemist, former manager of Avengers Compound'";
        $this->items = [...$this->items, $hero];
    }
}
```

The result:

<div>
    <TableExample example="create" />
</div>

## Edit and Delete

To enable edit and delete action pass `edit` and `remove` (boolean) properties.

To handle events use `(edit)` and `(delete)`.

`(edit)` - `(T $item): void`

`(delete)` - `(T $item): void`

Type is optional.

Example:

```html
<DataTable
    columns="$columns"
    items="$items"
    edit
    remove
    (edit)="onEdit"
    (delete)="onDelete"
/>
```

```php
<?php

namespace ExamplesUi\Tables;

use ExamplesUi\HeroModel;
use Viewi\Components\BaseComponent;
use Viewi\UI\Components\Tables\TableColumn;

class FormsExample extends BaseComponent
{
    //...

    public function onEdit(HeroModel $hero)
    {
        $hero->Name = 'New ' . $hero->Name;
    }

    public function onDelete(HeroModel $hero)
    {
        $this->items = array_filter($this->items, fn(HeroModel $m) => $m !== $hero);
    }
}
```

The result:

<div>
    <TableExample example="edit-delete" />
</div>

## Inline Edit

You can use inline editing with `editInline` property set to `true`.

Pass `edit_{COLUMN_NAME}` slots for the template if edit mode is activated.

Use `(save)` event to save the result.

Or `(cancel)` to reset the editing.

Example:

```html
<DataTable
    #dataTable
    columns="$columns"
    items="$items"
    edit
    editInline
    (save)="onSave"
    (edit)="preserveHero"
    (cancel)="onCancel"
>
    <slotContent name="edit_Name" data="$item">
        <td>
            <TextInput inset name="Name" model="$item->Name" />
        </td>
    </slotContent>
</DataTable>
```

```php
<?php

namespace ExamplesUi\Tables;

use ExamplesUi\HeroModel;
use Viewi\Components\BaseComponent;
use Viewi\UI\Components\Tables\TableColumn;

class FormsExample extends BaseComponent
{
    public ?DataTable $dataTable = null;
    public string $heroNameBeforeEdit = '';
    //...

    public function onSave(HeroModel $hero)
    {
        // switch off the edit mode
        $this->dataTable->finishEdit();
        // save the hero, in our case it's already updated
    }

    public function preserveHero(HeroModel $hero)
    {
        $this->heroNameBeforeEdit = $hero->Name;
    }

    public function onCancel(HeroModel $hero)
    {
        // cancel the edit, reset all changes if need
        $hero->Name = $this->heroNameBeforeEdit;
    }
}
```

The result:

<div>
    <TableExample example="edit-inline" />
</div>