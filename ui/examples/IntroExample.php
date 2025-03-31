<?php

namespace ExamplesUi;

use Pupils\Components\Services\Localization\HasLocalization;
use Viewi\Components\BaseComponent;
use Viewi\Components\DOM\DomEvent;
use Viewi\UI\Components\Forms\ActionForm;
use Viewi\UI\Components\Validation\ValidationMessage;

class IntroExample extends BaseComponent
{
    use HasLocalization;
    public ExampleModel $registerModel;
    public bool $loading = false;
    public ?ValidationMessage $generalMessages = null;
    private ?ActionForm $loginForm = null;
    public ?ValidationExample $validation = null;

    public function __construct() {}

    public function init()
    {
        $this->registerModel = new ExampleModel();
        $this->validation = new ValidationExample($this->registerModel, $this->translateFn());
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
