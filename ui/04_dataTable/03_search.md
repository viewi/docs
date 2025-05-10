# Data Table - Search

Data table supports searching. 

Simply enable it with `search` property and assign `(search)` event.

`(search)` - `(string $search): void`

## Example

```html
<DataTable columns="$columns" items="$items" search (search)="onSearch" />
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
    public array $filtered = [];
    
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
        
        // display all items by default
        $this->filtered = $this->items;
    }

    // handle table search event
    public function onSearch(string $filter)
    {
        $searchText = strtolower($filter);
        $this->filtered = array_filter(
            $this->items,
            fn(HeroModel $hero) => !$filter
                || strpos(
                    strtolower($hero->Name),
                    $searchText
                ) !== false
        );
    }
}
```

The result:

<div>
    <TableExample example="search" />
</div>
