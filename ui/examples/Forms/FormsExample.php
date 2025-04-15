<?php

namespace ExamplesUi\Forms;

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
}
