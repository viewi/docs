<?php

namespace ExamplesUi;

use Pupils\Components\Services\Localization\HasLocalization;
use Viewi\Components\BaseComponent;
use Viewi\Components\DOM\DomEvent;
use Viewi\UI\Components\Forms\ActionForm;
use Viewi\UI\Components\Tables\TableColumn;
use Viewi\UI\Components\Validation\ValidationMessage;

class IntroExample extends BaseComponent
{
    use HasLocalization;
    public ExampleModel $registerModel;
    public bool $loading = false;
    public ?ValidationMessage $generalMessages = null;
    private ?ActionForm $loginForm = null;
    public ?ValidationExample $validation = null;
    public array $columns = [];
    public array $items = [];

    public function __construct() {}

    public function init()
    {
        $this->registerModel = new ExampleModel();
        $this->validation = new ValidationExample($this->registerModel, $this->translateFn());
        $this->setUpColumns();
    }

    public function setUpColumns()
    {
        $this->columns = [
            new TableColumn('Id'),
            new TableColumn('FirstName'),
            new TableColumn('Active'),
            new TableColumn('CreatedOn', 'Created', 'DateColumn'),
        ];
        for ($i = 1; $i <= 10; $i++) {
            $model = new ExampleModel();
            $model->Id = $i;
            $model->FirstName = 'Miki';
            $model->LastName = 'Darkness';
            $model->Active = $i % 2 === 0 ? true : false;
            $model->CreatedOn = 1739008277789309;
            $this->items[] = $model;
        }
    }

    public function handleSubmit(DomEvent $event)
    {
        $event->preventDefault();
        // validate
        if (!$this->loginForm->validate()) {
            return;
        }
    }
}
