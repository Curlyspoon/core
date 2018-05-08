<?php

namespace Curlyspoon\Core\Tests\Elements\Native;

use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpperHeadline extends Headline
{
    protected $name = 'upper_headline';

    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setNormalizer('text', function (Options $options, string $value) {
            return mb_strtoupper($value);
        });
    }
}
