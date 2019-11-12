<?php

namespace Encore\Remind;

use Encore\Admin\Extension;

class Remind extends Extension
{
    public $name = 'remind';

    public $views = __DIR__.'/../resources/views';

    public $assets = __DIR__.'/../resources/assets';

    public $menu = [
        'title' => 'Remind',
        'path'  => 'remind',
        'icon'  => 'fa-gears',
    ];
}