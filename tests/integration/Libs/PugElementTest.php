<?php

use Curlyspoon\Core\Tests\Elements\Pug\Headline;

class PugElementTest extends TestCase
{
    /** @test */
    public function headline_renders_to_string()
    {
        $headline = new Headline([
            'text' => 'my headline',
        ]);

        $this->assertEquals("<h1>my headline\n</h1>", $headline->render());
    }
}
