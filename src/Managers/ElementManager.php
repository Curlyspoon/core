<?php

namespace Curlyspoon\Core\Managers;

use Curlyspoon\Core\Contracts\Element as ElementContract;
use Curlyspoon\Core\Contracts\ElementManager as ElementManagerContract;
use Curlyspoon\Core\Exceptions\ElementNotFoundException;
use Curlyspoon\Core\Exceptions\Exception;

class ElementManager implements ElementManagerContract
{
    protected $elements = [];

    public function register(string $name, string $element): ElementManagerContract
    {
        if (!isset(class_implements($element)[ElementContract::class])) {
            throw new Exception(sprintf('The given classname [%s] for [%s] is not a [%s].', $element, $name, ElementContract::class));
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
            throw new ElementNotFoundException($name);
        }

        return new $this->elements[$name]($options);
    }

    public function getElements(): array
    {
        return $this->elements;
    }
}
