<?php

namespace Curlyspoon\Core\Tests\Elements\Pug;

use Curlyspoon\Core\Elements\PugElement;

class Headline extends PugElement
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
        return realpath(sprintf(__DIR__.'/../../templates/pug/%s.pug', $this->name));
    }
}
