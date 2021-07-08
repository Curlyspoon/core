<?php

namespace Curlyspoon\Core\Elements;

use Curlyspoon\Core\Contracts\Element as ElementContract;
use Exception;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
     */
    protected $options = [];

    /**
     * @var OptionsResolver
     */
    protected $resolver;

    public function __construct(array $options = [])
    {
        $this->setOptions($options);
    }

    public static function make(array $options = []): ElementContract
    {
        return new static($options);
    }

    public function setOptions(array $options): ElementContract
    {
        $this->options = $options;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function resolve(): ElementContract
    {
        $this->setOptions($this->optionsResolver()->resolve($this->getOptions()));

        return $this;
    }

    public function isValid(): bool
    {
        try {
            $this->optionsResolver()->resolve($this->getOptions());

            return true;
        } catch (Exception $exception) {
            return false;
        }
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

    protected function optionsResolver(): OptionsResolver
    {
        if (is_null($this->resolver)) {
            $this->resolver = new OptionsResolver();
            $this->resolver->setDefaults($this->defaults);

            $this->resolver->setRequired($this->required);

            foreach ($this->types as $option => $types) {
                $this->resolver->setAllowedTypes($option, $types);
            }

            foreach ($this->values as $option => $values) {
                $this->resolver->setAllowedValues($option, $values);
            }

            if (method_exists($this, 'configureOptions')) {
                $this->configureOptions($this->resolver);
            }
        }

        return $this->resolver;
    }
}
