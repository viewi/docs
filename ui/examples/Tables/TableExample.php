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
    
    public function init()
    {
        $this->setUpColumns();
        $this->prepareHeroes();        
    }

    public function setUpColumns()
    {
        $this->columns = [
            new TableColumn('Id'),
            new TableColumn('Name')
        ];        
    }

    public function prepareHeroes()
    {
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
