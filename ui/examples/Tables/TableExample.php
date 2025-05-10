<?php

namespace ExamplesUi\Tables;

use ExamplesUi\HeroModel;
use Viewi\Components\BaseComponent;
use Viewi\UI\Components\Pagination\PaginationModel;
use Viewi\UI\Components\Tables\TableColumn;

class TableExample extends BaseComponent
{
    public string $example = 'intro';

    public array $columns = [];
    public array $items = [];
    public array $filtered = [];
    public array $paged = [];

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

        $hero = new HeroModel();
        $hero->Id = 4;
        $hero->Name = 'Abomination';
        $hero->Description = "Ex-Spy'";
        $this->items[] = $hero;
        $hero = new HeroModel();
        $hero->Id = 5;
        $hero->Name = 'Abraxas';
        $hero->Description = "Dimensional destroyer'";
        $this->items[] = $hero;
        $hero = new HeroModel();
        $hero->Id = 6;
        $hero->Name = 'Absorbing Man';
        $hero->Description = "Professional criminal; former professional boxer'";
        $this->items[] = $hero;
        $hero = new HeroModel();
        $hero->Id = 7;
        $hero->Name = 'Adam Monroe';
        $hero->Description = "former samurai swordsman, former British mercenary commander, former soldier in the Confederate Army'";
        $this->items[] = $hero;
        $hero = new HeroModel();
        $hero->Id = 8;
        $hero->Name = 'Adam Strange';
        $hero->Description = "Adventurer, archaelogist, ambassador'";
        $this->items[] = $hero;
        $hero = new HeroModel();
        $hero->Id = 10;
        $hero->Name = 'Agent Bob';
        $hero->Description = "Mercenary, janitor; former pirate, terrorist'";
        $this->items[] = $hero;
        if ($this->example === 'paging') {
            $hero = new HeroModel();
            $hero->Id = 11;
            $hero->Name = 'Agent Zero';
            $hero->Description = "Mercenary, former government operative, freedom fighter'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 12;
            $hero->Name = 'Air-Walker';
            $hero->Description = "Former starship captain, Herald of Galactus'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 13;
            $hero->Name = 'Ajax';
            $hero->Description = "-'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 14;
            $hero->Name = 'Alan Scott';
            $hero->Description = "-'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 15;
            $hero->Name = 'Alex Mercer';
            $hero->Description = "-'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 17;
            $hero->Name = 'Alfred Pennyworth';
            $hero->Description = "Butler; Caretaker, former Actor; Field Medic; Government Agent'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 18;
            $hero->Name = 'Alien';
            $hero->Description = "-'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 20;
            $hero->Name = 'Amazo';
            $hero->Description = "-'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 23;
            $hero->Name = 'Angel';
            $hero->Description = "-'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 24;
            $hero->Name = 'Angel';
            $hero->Description = "Adventurer, chairman & principal stockholder of Worthington Industries, former terrorist'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 25;
            $hero->Name = 'Angel Dust';
            $hero->Description = "-'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 26;
            $hero->Name = 'Angel Salvadore';
            $hero->Description = "-'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 28;
            $hero->Name = 'Animal Man';
            $hero->Description = "-'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 29;
            $hero->Name = 'Annihilus';
            $hero->Description = "Conqueror, scavenger'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 30;
            $hero->Name = 'Ant-Man';
            $hero->Description = "Adventurer, Biochemist, former manager of Avengers Compound'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 31;
            $hero->Name = 'Ant-Man II';
            $hero->Description = "Electronics Technician,'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 32;
            $hero->Name = 'Anti-Monitor';
            $hero->Description = "-'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 34;
            $hero->Name = 'Anti-Venom';
            $hero->Description = "Vigilante; former journalist for the Daily Globe'";
            $this->items[] = $hero;
            $hero = new HeroModel();
            $hero->Id = 35;
            $hero->Name = 'Apocalypse';
            $hero->Description = "Student; formerly Conqueror; Scientist'";
            $this->items[] = $hero;
        }

        $this->filtered = $this->items;
        $this->paged = array_slice($this->items, 0, 5);
    }

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

    public function onPageChange(PaginationModel $paging)
    {
        $this->paged = array_slice($this->items, $paging->entityFrom, $paging->size);
    }
}
