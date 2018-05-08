<?php

use Curlyspoon\Core\Managers\ElementManager;
use Curlyspoon\Core\Tests\Elements\Native\Headline;
use PHPUnit\Framework\TestCase as PhpUnitTestCase;

abstract class TestCase extends PhpUnitTestCase
{
    protected function getElementManager(): ElementManager
    {
        $manager = new ElementManager();

        $manager->register('headline', Headline::class);

        return $manager;
    }
}
