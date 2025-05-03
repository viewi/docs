# Data Table - Essentials

A data table UI component is a user interface element used to display structured, tabular data in a clear and organized manner.

## Usage

Data table has two required properties to set up.

First one is `columns` - columns that should be displayed, defined with the help of `TableColumn` class.

`TableColumn` accepts a property key as a first argument.

```php
// defining column for Title property
$column = new TableColumn('Title');
```

It has other arguments as well, described in next sections.

The second property is `items` - the list of items that should be displayed in the table.

So, for the list of items `{ string $Title; }` the columns definition should look like this:

```php
$this->columns = [
    new TableColumn('Title')
];
```

## Example

Let's display the list of `HeroModel` items.

```php
class HeroModel
{
    public ?int $Id = null;
    public ?string $Name = null;
}
```

Defining columns and getting the list of data:

```php
<?php

namespace ExamplesUi\Tables;

use ExamplesUi\HeroModel;
use Viewi\Components\BaseComponent;
use Viewi\UI\Components\Tables\TableColumn;

class FormsExample extends BaseComponent
{
    public array $columns = [];
    public array $items = [];
    
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
    }
}
```

Assigning columns and items to the `DataTable` component:

```html
<DataTable columns="$columns" items="$items" />
```

The result:

<div>
    <TableExample example="essentials" />
</div>