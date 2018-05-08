<?php

namespace Curlyspoon\Core\Tests\Elements;

use Curlyspoon\Core\Libs\Element;

class Headline extends Element
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

    public function render(): string
    {
        return sprintf('<h%d>%s</h%d>', $this->options['size'], $this->options['text'], $this->options['size']);
    }
}
