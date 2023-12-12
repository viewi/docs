<?php

namespace ExamplesV2\EventHandling;

use Viewi\Components\BaseComponent;

class GreetByNameExample extends BaseComponent
{
    public string $greetingMessage = '';

    function greetByName($name)
    {
        $this->greetingMessage = "Hello $name!";
    }
}
