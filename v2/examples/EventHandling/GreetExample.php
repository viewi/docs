<?php

namespace ExamplesV2\EventHandling;

use Viewi\Components\BaseComponent;

class GreetExample extends BaseComponent
{
    public string $greetingMessage = '';

    function greet()
    {
        $this->greetingMessage = 'Hello Viewi!';
    }
}
