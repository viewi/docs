<?php

namespace ExamplesV2\ServicesAndModels;

use Viewi\Components\BaseComponent;

class CounterUseExample extends BaseComponent
{
    public function __construct(public CounterStateExample $counter)
    {
    } 
}
