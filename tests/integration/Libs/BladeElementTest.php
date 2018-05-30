<?php

use Curlyspoon\Core\Tests\Elements\Blade\Headline;

class BladeElementTest extends TestCase
{
    /** @test */
    public function headline_renders_to_string()
    {
        new Laravel\Lumen\Application(realpath(__DIR__.'/../..'));

        $headline = new Headline([
            'text' => 'my headline',
        ]);

        $this->assertEquals('<h1>my headline</h1>', $headline->render());
    }
}
