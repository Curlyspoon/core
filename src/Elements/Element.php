<?php

namespace Curlyspoon\Core\Elements;

use Curlyspoon\Core\Contracts\Element as ElementContract;
use Curlyspoon\NestedOptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolver as SymfonyOptionsResolver;

abstract class Element implements ElementContract
{
    const TYPE_SCALAR = 'scalar';
    const TYPE_STRING = 'string';
    const TYPE_BOOL = 'bool';

    const TYPE_INT = 'int';
    const TYPE_LONG = 'long';

    const TYPE_FLOAT = 'float';
    const TYPE_DOUBLE = 'double';
    const TYPE_REAL = 'real';

    const TYPE_NUMERIC = 'numeric';
    const TYPE_NAN = 'nan';
    const TYPE_FINITE = 'finite';
    const TYPE_INFINITE = 'infinite';

    const TYPE_NULL = 'null';
    const TYPE_ARRAY = 'array';
    const TYPE_OBJECT = 'object';
    const TYPE_CALLABLE = 'callable';
    const TYPE_COUNTABLE = 'countable';
    const TYPE_ITERABLE = 'iterable';
    const TYPE_RESOURCE = 'resource';

    const TYPE_DIR = 'dir';
    const TYPE_FILE = 'file';
    const TYPE_LINK = 'link';
    const TYPE_READABLE = 'readable';
    const TYPE_WRITABLE = 'writable';
    const TYPE_WRITEABLE = 'writeable';
    const TYPE_EXECUTABLE = 'executable';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     *
     * @see OptionsResolver::setDefault()
     */
    protected $defaults = [];

    /**
     * @var array
     *
     * @see OptionsResolver::setRequired()
     */
    protected $required = [];

    /**
     * @var array
     *
     * @see OptionsResolver::setAllowedTypes()
     */
    protected $types = [];

    /**
     * @var array
     *
     * @see OptionsResolver::setAllowedValues()
     */
    protected $values = [];

    /**
     * @var array
     *
     * @see OptionsResolver::setNested()
     */
    protected $nested = [];

    /**
     * @var array
     */
    protected $options = [];

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    public function setOptions(array $options)
    {
        $this->options = $this->optionsResolver()->resolve($options);
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    abstract public function render(): string;

    public function toString(): string
    {
        return $this->render();
    }

    public function __toString(): string
    {
        return $this->toString();
    }

    protected function optionsResolver(): SymfonyOptionsResolver
    {
        $resolver = OptionsResolver::make([
            'defaults' => $this->defaults,
            'required' => $this->required,
            'types'    => $this->types,
            'values'   => $this->values,
            'nested'   => $this->nested,
        ]);

        if (method_exists($this, 'configureOptions')) {
            $this->configureOptions($resolver);
        }

        return $resolver;
    }
}
