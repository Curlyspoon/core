<?php

namespace Curlyspoon\Core\Contracts;

interface ElementManager
{
    public function register(string $name, string $element): self;

    public function render(string $name, array $options = []): string;

    public function createElement(string $name, array $options = []): Element;

    public function getElements(): array;
}
