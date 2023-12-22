<?php

namespace ExamplesV2\ComponentsBasics;

use Viewi\Components\BaseComponent;

class CounterExample extends BaseComponent
{
    public int $count = 0;

    public function increment()
    {
        $this->count++;
    }
}
