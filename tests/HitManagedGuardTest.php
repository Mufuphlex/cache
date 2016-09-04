<?php

namespace Mufuphlex\Tests\Cache;

use Mufuphlex\Cache\CachePhpNative;
use Mufuphlex\Cache\Guards\HitManaged\HitManagedGuard;

class HitManagedGuardTest extends GuardAbstractTest
{
    public function testConstructor()
    {
        $cache = new CachePhpNative();  //@TODO How to mock 2 imterfaces in  the meantime?
        $hitManager = $this->getHitManager();
        $maxVolume = 1;

        $guard = new HitManagedGuard($cache, $hitManager, $maxVolume);

        static::assertInstanceOf('\Mufuphlex\Cache\Guards\HitManaged\HitManagedGuard', $guard);
    }

    private function getHitManager()
    {
        return static::getMock('\Mufuphlex\Cache\HitManagerInterface');
    }
}