<?php

namespace Mufuphlex\Tests\Cache\KeyGenerators\Decorators;

use Mufuphlex\Cache\KeyGenerators\Decorators\Prefixed;

class PrefixedTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $date = time();
        $generator = $this->getGenerator($date);
        $prefix = 'prefix';
        $generator = new Prefixed($generator, $prefix);
        static::assertEquals($prefix.$date, $generator->generate());
    }

    private function getGenerator($date)
    {
        $mock = static::getMock('\Mufuphlex\Cache\KeyGeneratorInterface');
        $mock->method('generate')->willReturn($date);
        return $mock;
    }
}