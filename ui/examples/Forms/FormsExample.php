<?php

namespace ExamplesUi\Forms;

use ExamplesUi\HeroModel;
use Viewi\Components\BaseComponent;

class FormsExample extends BaseComponent
{
    public string $example = 'intro';
    
    //example 1
    public string $firstName = '';
    public string $lastName = '';
    
    //example 2
    public string $summary = '';

    //example slot
    public string $email = '';

    //example select
    public array $options = [
        'One',
        'Two',
        'Three',
        'Four',
    ];
    public string $selectedOption = '';

    /**
     * 
     * @var HeroModel[]
     */
    public array $items = [];
    public ?HeroModel $selectedHero = null;

    public function init(): void
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

    // example hero-assoc
    public array $itemsAssoc = [
        'superman' => 'Superman',
        'batman' => 'Batman',
        'wonder-woman' => 'Wonder Woman'
    ];
    public string $selectedHeroAssoc = '';
}
