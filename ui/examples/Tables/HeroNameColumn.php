<?php

namespace ExamplesUi\Tables;

use ExamplesUi\HeroModel;
use Viewi\Components\BaseComponent;

class HeroNameColumn extends BaseComponent
{
    public ?string $value = null;
    public ?HeroModel $data = null;
}
