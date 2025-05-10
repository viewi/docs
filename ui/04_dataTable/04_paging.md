# Data Table - Paging

Data table supports pagination. 

Simply enable it with `paging` property.

Pass `total` property (number) to set the total number of items. If not passed, the length of passed items will be used.

Pass `pageSize` property (number) to set the page size. By default: 10.

Use `(page)` event to handle page change.

`(page)` - `(PaginationModel $paging): void.

## Example

```html
<DataTable 
    columns="$columns"
    items="$paged"
    paging
    pageSize="5"
    total="{count($items)}"
    (page)="onPageChange"
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
    public array $columns = [];
    // all items
    public array $items = [];
    // items for the table
    public array $paged = [];
    
    public function init()
    {
        $this->setUpColumns();
        $this->prepareHeroes();        
    }

    public function setUpColumns()
    {
        // Columns definition
        $this->columns = [
            new TableColumn('Id'),
            new TableColumn('Name'),
        ];        
    }

    public function prepareHeroes()
    {
        // let's pretend that we got these from some API
        $hero = new HeroModel();
        $hero->Id = 1;
        $hero->Name = 'Superman';
        $this->items[] = $hero;

        $hero = new HeroModel();
        $hero->Id = 2;
        $hero->Name = 'Batman';
        $this->items[] = $hero;

        $hero = new HeroModel();
        $hero->Id = 3;
        $hero->Name = 'Wonder Woman';
        $this->items[] = $hero;
        // ...
        
        // display first 5 items by default
        $this->paged = array_slice($this->items, 0, 5);
    }

    // handle table page change event
    public function onPageChange(PaginationModel $paging)
    {
        $this->paged = array_slice($this->items, $paging->entityFrom, $paging->size);
    }
}
```

The result:

<div>
    <TableExample example="paging" />
</div>
