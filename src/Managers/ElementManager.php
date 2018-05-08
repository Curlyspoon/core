<?php

namespace Curlyspoon\Core\Managers;

use Curlyspoon\Core\Contracts\Element as ElementContract;
use Curlyspoon\Core\Contracts\ElementManager as ElementManagerContract;
use InvalidArgumentException;

class ElementManager implements ElementManagerContract
{
    protected $elements = [];

    public function register(string $name, string $element): ElementManagerContract
    {
        if (!isset(class_implements($element)[ElementContract::class])) {
            throw new InvalidArgumentException(sprintf('The given classname [%s] for [%s] is not a [%s].', $element, $name, ElementContract::class));
        }

        $this->elements[$name] = $element;

        return $this;
    }

    public function render(string $name, array $options = []): string
    {
        return $this->createElement($name, $options)->render();
    }

    public function createElement(string $name, array $options = []): ElementContract
    {
        if (!isset($this->elements[$name])) {
            throw new InvalidArgumentException(sprintf('No element with name [%s] found.', $name));
        }

        return new $this->elements[$name]($options);
    }

    public function getElements(): array
    {
        return $this->elements;
    }
}
