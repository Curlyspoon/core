<?php

namespace Curlyspoon\Core\Contracts;

interface Element
{
    public function __construct(array $options = []);

    public function setOptions(array $options): Element;

    public function getOptions(): array;

    public function isValid(): bool;

    public function resolve(): Element;

    public function render(): string;

    public function toString(): string;

    public function __toString(): string;
}
