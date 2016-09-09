<?php

namespace Mufuphlex\Tests\Cache\KeyGenerators;

use Mufuphlex\Tests\Cache\Dummies\KeyGeneratorTimelyDummy;

class TimelyAbstractTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage format is not set for a particular Timely cache key generator
     */
    public function testExceptionOnNotSetFormat()
    {
        $generator = new KeyGeneratorTimelyDummy();
        $generator->generate();
    }
}