<?php

namespace Mufuphlex\Tests\Cache;

abstract class CacheTestCase extends TestCase
{
    protected function getHitManagerMock()
    {
        return static::getMock('\Mufuphlex\Cache\HitManagerInterface');
    }

    protected function getCacheInitialMock()
    {
        return static::getMockBuilder('\Mufuphlex\Cache\CachePhpNative')->disableOriginalConstructor()->getMock();
    }
}