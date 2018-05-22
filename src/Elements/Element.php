<?php

namespace Curlyspoon\Core\Elements;

use Curlyspoon\Core\Contracts\Element as ElementContract;
use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class Element implements ElementContract
{
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

    public function __construct(array $options = [])
    {
        $this->resolve($options);
    }

    public function resolve(array $options)
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

    protected function optionsResolver(): OptionsResolver
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults($this->defaults);

        $resolver->setRequired($this->required);

        foreach ($this->types as $option => $types) {
            $resolver->setAllowedTypes($option, $types);
        }

        foreach ($this->values as $option => $values) {
            $resolver->setAllowedValues($option, $values);
        }

        if (method_exists($this, 'configureOptions')) {
            $this->configureOptions($resolver);
        }

        return $resolver;
    }
}
