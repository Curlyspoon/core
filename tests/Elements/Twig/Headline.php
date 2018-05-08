<?php

namespace Curlyspoon\Core\Tests\Elements\Twig;

use Curlyspoon\Core\Elements\TwigElement;

class Headline extends TwigElement
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
        return realpath(__DIR__.'/../../templates/twig/');
    }
}
