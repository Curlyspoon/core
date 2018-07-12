<?php

namespace Curlyspoon\Core\Elements;

use Pug\Pug;

abstract class PugElement extends Element
{
    public function render(): string
    {
        $this->resolve();

        return $this->getEngine()->renderFile($this->getPath().'/'.$this->name.'.pug', $this->getOptions());
    }

    abstract protected function getPath(): string;

    protected function getEngine(): Pug
    {
        return new Pug();
    }
}
