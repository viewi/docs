<?php

namespace ExamplesV2\EventHandling;

use Viewi\Components\BaseComponent;

class CheckboxMultiBindExample extends BaseComponent
{
    public array $checkedNames = [];

    function getNames(): string
    {
        return json_encode($this->checkedNames);
    }
}
