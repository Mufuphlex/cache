<?php

namespace Mufuphlex\Tests\Cache\KeyGenerators;

use Mufuphlex\Cache\KeyGenerators\Minutely;

class MinutelyTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $generator = new Minutely();
        $key = $generator->generate();
        static::assertRegExp('@^\d{4}\d{2}\d{2}\d{2}\d{2}$@', $key);
    }
}