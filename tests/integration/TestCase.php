<?php

use PHPUnit\Framework\TestCase as PhpUnitTestCase;
use Curlyspoon\Core\Managers\ElementManager;
use Curlyspoon\Core\Tests\Elements\Headline;
use Curlyspoon\Core\Tests\Elements\UpperHeadline;

abstract class TestCase extends PhpUnitTestCase
{
    protected function getElementManager(): ElementManager
    {
        $manager = new ElementManager();

        $manager->register('headline', Headline::class);
        $manager->register('upper_headline', UpperHeadline::class);

        return $manager;
    }
}
