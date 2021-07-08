<?php

namespace Curlyspoon\Core\Elements;

use Illuminate\Container\Container;
use Illuminate\View\Factory;

abstract class BladeElement extends Element
{
    public function render(): string
    {
        $this->resolve();

        return $this->getEngine()->make(implode('.', array_filter([
            $this->getPath(),
            $this->name,
        ])), $this->getOptions())->render();
    }

    abstract protected function getPath(): string;

    protected function getEngine(): Factory
    {
        return Container::getInstance()->make('view');
    }
}
