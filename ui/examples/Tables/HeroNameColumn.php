<?php

namespace ExamplesUi\Tables;

use ExamplesUi\HeroModel;
use Viewi\Components\Attributes\IncludeAlways;
use Viewi\Components\Lifecycle\OnMounted;
use Viewi\UI\Components\Tables\BaseColumnTemplate;

#[IncludeAlways]
class HeroNameColumn extends BaseColumnTemplate implements OnMounted
{
    public ?string $name = null;
    public ?HeroModel $hero = null;

    public function mounted()
    {
        $this->name = $this->getCurrentValue();
        $this->hero = $this->getCurrentItem();
    }
}
