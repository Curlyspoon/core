<?php

use Curlyspoon\Core\Tests\Elements\Headline;
use Curlyspoon\Core\Tests\Elements\UpperHeadline;
use Symfony\Component\OptionsResolver\Exception\InvalidOptionsException;
use Symfony\Component\OptionsResolver\Exception\MissingOptionsException;

class ElementTest extends TestCase
{
    /** @test */
    public function text_option_is_required()
    {
        $this->expectException(MissingOptionsException::class);
        $this->expectExceptionMessage('The required option "text" is missing.');

        new Headline();
    }

    /** @test */
    public function text_option_accepts_string()
    {
        $headline = new Headline([
            'text' => 'my headline',
        ]);

        $this->assertEquals('my headline', $headline->getOptions()['text']);
    }

    /** @test */
    public function text_option_does_not_accept_array()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('The option "text" with value array is expected to be of type "string", but is of type "array".');

        new Headline([
            'text' => [
                'my',
                'headline',
            ],
        ]);
    }

    /** @test */
    public function size_option_has_default()
    {
        $headline = new Headline([
            'text' => 'my headline',
        ]);

        $this->assertEquals(1, $headline->getOptions()['size']);
    }

    /** @test */
    public function size_option_does_not_accept_zero()
    {
        $this->expectException(InvalidOptionsException::class);
        $this->expectExceptionMessage('The option "size" with value 0 is invalid. Accepted values are: 1, 2, 3, 4, 5, 6.');

        new Headline([
            'text' => 'my headline',
            'size' => 0,
        ]);
    }

    /** @test */
    public function headline_renders_to_string()
    {
        $headline = new Headline([
            'text' => 'my headline',
        ]);

        $this->assertEquals('<h1>my headline</h1>', $headline->render());
    }

    /** @test */
    public function headline_is_stringable()
    {
        $headline = new Headline([
            'text' => 'my headline',
        ]);

        $this->assertEquals('<h1>my headline</h1>', (string) $headline);
    }

    /** @test */
    public function allow_to_customize_options_resolver()
    {
        $headline = new UpperHeadline([
            'text' => 'My HeadLine',
        ]);

        $this->assertEquals('<h1>MY HEADLINE</h1>', $headline->render());
    }
}
