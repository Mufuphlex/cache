<?php

namespace Mufuphlex\Tests\Cache;

use Mufuphlex\Cache\CachePhpNative;

class CachePhpNativeTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param $cache
     * @param $key
     * @param $value
     * @dataProvider cacheDataProvider
     */
    public function testSetGet($cache, $key, $value)
    {
        $cache->set($key, $value);
        static::assertSame($value, $cache->get($key));
    }

    /**
     * @param $cache
     * @param $key
     * @param $value
     * @dataProvider cacheDataProvider
     */
    public function testExpiration($cache, $key, $value)
    {
        $cache->set($key, $value, 1);
        static::assertSame($value, $cache->get($key));
        sleep(2);
        static::assertNull($cache->get($key));
    }

    /**
     * @param $cache
     * @param $key
     * @param $value
     * @dataProvider cacheDataProvider
     */
    public function testDelete($cache, $key, $value)
    {
        $cache->set($key, $value);
        static::assertSame($value, $cache->get($key));
        $res = $cache->delete($key);
        static::assertNull($cache->get($key));
        static::assertTrue($res);
        $res = $cache->delete($key);
        static::assertFalse($res);
    }

    /**
     * @param $cache
     * @param $key
     * @param $value
     * @dataProvider cacheDataProvider
     */
    public function testClear($cache, $key, $value)
    {
        $cache->set($key, $value);
        static::assertSame($value, $cache->get($key));
        $cache->clear();
        static::assertNull($cache->get($key));
    }

    public function testGetCount()
    {
        $cache = new CachePhpNative();
        static::assertSame(0, $cache->getCount());
        $key = 'key';
        $cache->set($key, 'value');
        static::assertSame(1, $cache->getCount());
        $cache->delete($key);
        static::assertSame(0, $cache->getCount());
    }

    public function testGetVolume()
    {
        $cache = new CachePhpNative();
        static::assertSame(6, $cache->getVolume());
        $key = 'key';
        $cache->set($key, 'value');
        static::assertSame(54, $cache->getVolume());
        $cache->delete($key);
        static::assertSame(6, $cache->getVolume());
    }

    public function cacheDataProvider()
    {
        return array(array(
            new CachePhpNative(),
            'key',
            'value',
        ));
    }
}