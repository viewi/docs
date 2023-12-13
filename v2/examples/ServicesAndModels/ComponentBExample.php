<?php

namespace ExamplesV2\ServicesAndModels;

use Viewi\Components\BaseComponent;

class ComponentBExample extends BaseComponent
{
    public function __construct(public CounterStoreExample $counter)
    {
    } 
}
