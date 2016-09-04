<?php

namespace Mufuphlex\Tests\Cache;

use Mufuphlex\Cache\CheckStrategy\Volume;

class CheckStrategyVolumeTest extends TestCase
{
    public function testSetGetMaxVolume()
    {
        $strategy = $this->getStrategy();
        $maxValue = mt_rand(100, 999);
        $strategy->setMaxVolume($maxValue);
        static::assertSame($maxValue, $strategy->getMaxVolume());
    }

    /**
     * @expectedException \RuntimeException
     * @expectedExceptionMessage Can not redefine $maxVolume
     */
    public function testSetMaxVolumeFailsOnExistingValue()
    {
        $strategy = $this->getStrategy();
        $maxValue = mt_rand(100, 999);
        $strategy->setMaxVolume($maxValue);
        $maxValue = mt_rand(100, 999);
        $strategy->setMaxVolume($maxValue);
    }

    /**
     * @dataProvider notIntegerDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function testSetMaxVolumeFailsOnNotInteger($value)
    {
        $strategy = $this->getStrategy();
        $strategy->setMaxVolume($value);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $maxVolume must be positive
     */
    public function testSetMaxVolumeFailsOnNegative()
    {
        $strategy = $this->getStrategy();
        $strategy->setMaxVolume(-1);
    }

    public function testGetVolumeDiff()
    {
        $volume = mt_rand(100, 999);
        $cache = $this->getCache();
        $cache
            ->expects(static::once())
            ->method('getVolume')
            ->willReturn($volume);

        $maxVolume = 50;

        $strategy = new Volume($cache);
        static::assertEquals(0, $strategy->getVolumeDiff());

        $strategy->setMaxVolume($maxVolume);
        static::assertEquals(($maxVolume - $volume), $strategy->getVolumeDiff());
    }

    public function testCheck()
    {
        $this->falseCheck1();
        $this->falseCheck2();
        $this->falseCheck3();
        $this->trueCheck();
    }

    private function getStrategy()
    {
        $strategy = new Volume($this->getCache());
        return $strategy;
    }

    private function getCache()
    {
        return static::getMock('\Mufuphlex\Cache\MeasurableCacheInterface');
    }

    private function falseCheck1()
    {
        $strategy = new Volume($this->getCache());
        static::assertFalse($strategy->check());
    }

    private function falseCheck2()
    {
        $cache = $this->getCache();
        $cache
            ->expects(static::once())
            ->method('getCount')
            ->willReturn(0);

        $strategy = new Volume($cache);
        $strategy->setMaxVolume(5);

        static::assertFalse($strategy->check());
    }

    private function falseCheck3()
    {
        $cache = $this->getCache();
        $cache
            ->expects(static::once())
            ->method('getCount')
            ->willReturn(1);
        $cache
            ->expects(static::once())
            ->method('getVolume')
            ->willReturn(1);

        $strategy = new Volume($cache);
        $strategy->setMaxVolume(5);

        static::assertFalse($strategy->check());
    }

    private function trueCheck()
    {
        $cache = $this->getCache();
        $cache
            ->expects(static::once())
            ->method('getCount')
            ->willReturn(1);
        $cache
            ->expects(static::once())
            ->method('getVolume')
            ->willReturn(6);

        $strategy = new Volume($cache);
        $strategy->setMaxVolume(5);

        static::assertTrue($strategy->check());
    }
}