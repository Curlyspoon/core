<?php

use Curlyspoon\Core\Exceptions\Exception;
use Curlyspoon\Core\Exceptions\ElementNotFoundException;

class ElementManagerTest extends TestCase
{
    /** @test */
    public function register_fails_if_not_element_given()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('The given classname [ElementManagerTest] for [not_existing_element] is not a [Curlyspoon\Core\Contracts\Element].');

        $this->getElementManager()->register('not_existing_element', self::class);
    }

    /** @test */
    public function get_elements_returns_array()
    {
        $this->assertInternalType('array', $this->getElementManager()->getElements());
        $this->assertArrayHasKey('headline', $this->getElementManager()->getElements());
    }

    /** @test */
    public function able_to_render_element()
    {

        $this->assertEquals('<h1>my headline</h1>', $this->getElementManager()->render('headline', [
            'text' => 'my headline',
        ]));
    }

    /** @test */
    public function fails_to_render_not_existing_element()
    {
        $this->expectException(ElementNotFoundException::class);

        $this->getElementManager()->render('not_existing_element');
    }
}
