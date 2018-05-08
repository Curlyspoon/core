<?php

use Curlyspoon\Core\Tests\Elements\Twig\Headline;

class TwigElementTest extends TestCase
{
    /** @test */
    public function headline_renders_to_string()
    {
        $headline = new Headline([
            'text' => 'my headline',
        ]);

        $this->assertEquals('<h1>my headline</h1>', $headline->render());
    }
}
