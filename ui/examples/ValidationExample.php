<?php

namespace ExamplesUi;

use SharedPaws\Validation\ValidationRules;

class ValidationExample
{
    public function __construct(private ExampleModel $model, private $localize) {}

    public function getValidationRules()
    {
        return ValidationRules::rules($this->model)
            ->required('FirstName', ($this->localize)('register.validation.first-name-required'))
            ->required('Email', ($this->localize)('login.validation.email-required'))
            ->email('Email', ($this->localize)('register.validation.wrong-email'))
            ->required('Password', ($this->localize)('login.validation.password-required'))
            ->required('PasswordConfirmation', ($this->localize)('register.validation.password-confirmation-required'))
            ->match('PasswordConfirmation', 'Password', ($this->localize)('register.validation.password-confirmation-match'))
            ->toList();
    }
}
