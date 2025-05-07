<?php

namespace ExamplesUi\Tables;

use ExamplesUi\HeroModel;
use Viewi\Components\BaseComponent;
use Viewi\UI\Components\Tables\TableColumn;

class TableExample extends BaseComponent
{
    public string $example = 'intro';

    public array $columns = [];
    public array $items = [];

    public function mounted()
    {
        $this->setUpColumns();
        $this->prepareHeroes();
    }

    public function setUpColumns()
    {
        if ($this->example === 'columns-title') {
            $this->columns = [
                new TableColumn('Id', 'Hero Unique Number'),
                new TableColumn('Name', 'Hero Name'),
            ];
        } elseif ($this->example === 'columns-template') {
            $this->columns = [
                new TableColumn('Id', 'Hero Unique Number'),
                // let's use HeroNameColumn component for the Name column
                new TableColumn('Name', 'Hero Name', 'HeroNameColumn'),
            ];
        } else {
            $this->columns = [
                new TableColumn('Id'),
                new TableColumn('Name'),
            ];
        }
    }

    public function prepareHeroes()
    {
        $hero = new HeroModel();
        $hero->Id = 1;
        $hero->Name = 'Superman';
        $hero->Description = 'I am Superman!';
        $this->items[] = $hero;

        $hero = new HeroModel();
        $hero->Id = 2;
        $hero->Name = 'Batman';
        $hero->Description = "I'm Batman!";
        $this->items[] = $hero;

        $hero = new HeroModel();
        $hero->Id = 3;
        $hero->Name = 'Wonder Woman';
        $hero->Description = "Amazon forest must be protected!";
        $this->items[] = $hero;
    }
}
