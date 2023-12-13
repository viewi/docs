<?php

namespace ExamplesV2\ServicesAndModels;

use Viewi\DI\Singleton;

#[Singleton]
class CounterStoreExample
{
    public int $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
}
