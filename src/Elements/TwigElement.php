<?php

namespace Curlyspoon\Core\Elements;

use Twig_Loader_Filesystem;
use Twig_Environment;

abstract class TwigElement extends Element
{
    public function render(): string
    {
        return $this->getEngine()->render($this->name.'.twig', $this->getOptions());
    }

    abstract protected function getPath(): string;

    protected function getEngine(): Twig_Environment
    {
        $loader = new Twig_Loader_Filesystem($this->getPath());
        return new Twig_Environment($loader);
    }
}
