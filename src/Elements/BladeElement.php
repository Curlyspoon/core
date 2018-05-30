<?php

namespace Curlyspoon\Core\Elements;

use Illuminate\View\Factory;
use Illuminate\Container\Container;

abstract class BladeElement extends Element
{
    public function render(): string
    {
        return $this->getEngine()->make(implode('.', array_filter([
            $this->getPath(),
            $this->name
        ])), $this->getOptions())->render();
    }

    abstract protected function getPath(): string;

    protected function getEngine(): Factory
    {
        return Container::getInstance()->make('view');
    }
}
