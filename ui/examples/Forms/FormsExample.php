<?php

namespace ExamplesUi\Forms;

use ExamplesUi\ExampleModel;
use ExamplesUi\HeroModel;
use Viewi\Components\BaseComponent;
use Viewi\Components\DOM\DomEvent;
use Viewi\UI\Components\Forms\ActionForm;
use Viewi\UI\Components\Validation\ValidationMessage;

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

        $this->user = new ExampleModel();
        $this->validationRules = [
            'FirstName' => [
                'required' => fn() => !$this->user->FirstName ? 'First Name is required' : true
            ],
            'Email' => [
                'required' => fn() => !$this->user->Email ? 'Email is required' : true,
                'email' => function () {
                    if ($this->user->Email) {
                        $parts = explode('@', $this->user->Email, 2);
                        return !!(explode('.', $parts[1] ?? '')[1] ?? false) ? true : 'Wrong email format.';
                    }
                    // no value
                    return true;
                }
            ],
            'general' => [
                'shouldNotMatch' => fn() => $this->user->FirstName && $this->user->FirstName === $this->user->Email ? 'Email can not be used as a First Name' : true
            ]
        ];
    }

    // example hero-assoc
    public array $itemsAssoc = [
        'superman' => 'Superman',
        'batman' => 'Batman',
        'wonder-woman' => 'Wonder Woman'
    ];
    public string $selectedHeroAssoc = '';

    // example checkbox
    public bool $rememberMe = false;

    // validation
    public ExampleModel $user;
    private ?ActionForm $loginForm = null;
    public ?ValidationMessage $generalMessages = null;

    public array $validationRules = [];

    public function onSubmit(DomEvent $event)
    {
        $event->preventDefault();
        // validate loginForm
        if (!$this->loginForm->validate()) {
            return;
        }
        // process $this->user        
    }
}
