<?php

namespace Curlyspoon\Core\Tests\Elements\Blade;

use Curlyspoon\Core\Elements\BladeElement;

class Headline extends BladeElement
{
    protected $name = 'headline';

    protected $defaults = [
        'size' => 1,
    ];

    protected $required = [
        'text',
    ];

    protected $types = [
        'text' => 'string',
        'size' => 'int',
    ];

    protected $values = [
        'size' => [1, 2, 3, 4, 5, 6],
    ];

    protected function getPath(): string
    {
        return '';
    }
}
