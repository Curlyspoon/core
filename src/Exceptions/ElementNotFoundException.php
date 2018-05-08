<?php

namespace Curlyspoon\Core\Exceptions;

class ElementNotFoundException extends Exception
{
    public function __construct(string $name)
    {
        parent::__construct(sprintf('No element with name [%s] found.', $name));
    }
}
