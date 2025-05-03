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

The result

<div>
    <TableExample example="columns-title" />
</div>

## Custom Template

