<?php

namespace Mufuphlex\Cache\CleanupStrategy;

use Mufuphlex\Cache\CheckStrategy\VolumeInterface;
use Mufuphlex\Cache\CheckStrategyInterface;
use Mufuphlex\Cache\CleanupStrategyInterface;
use Mufuphlex\Cache\CacheInterface;
use Mufuphlex\Cache\HitManagerInterface;
use Mufuphlex\Cache\MeasurableCacheInterface;

/**
 * Class Popularity
 * @package Mufuphlex\Cplt\Container\Cache\CleanupStrategy
 */
class Popularity implements CleanupStrategyInterface
{
    /** How many times the volume difference must be multiplied for preventive cleanup */
    const CLEANUP_SIZE_ALLOWANCE = 3;

    /** @var HitManagerInterface */
    protected $hitManager;

    /**
     * Popularity constructor.
     * @param HitManagerInterface $hitManager
     */
    public function __construct(HitManagerInterface $hitManager)
    {
        $this->hitManager = $hitManager;
    }

    /**
     * @param CacheInterface $cache
     * @param CheckStrategyInterface $checkStrategy
     * @return bool
     */
    public function cleanup(CacheInterface $cache, CheckStrategyInterface $checkStrategy)
    {
        $this->validateInput($cache, $checkStrategy);

        /** @var $checkStrategy VolumeInterface */
        $numOfKeys = $this->getCountOfKeysToBeCleaned($cache, $checkStrategy->getMaxVolume());
        $keys = $this->hitManager->getLessPopularKeys($numOfKeys);

        if (!$keys) {
            //@TODO Partial dichotomy cleanup is required
            return false;
        }

        foreach ($keys as $key) {
            $cache->delete($key);
        }

        return true;
    }

    /**
     * @param MeasurableCacheInterface $cache
     * @param int $maxVolume
     * @return int
     */
    private function getCountOfKeysToBeCleaned(MeasurableCacheInterface $cache, $maxVolume)
    {
        $actualVolume = $cache->getVolume();
        $avgKeyVolume = $actualVolume / $cache->getCount();
        $numOfKeysToBeCleaned = ceil(abs(($actualVolume - $maxVolume) / $avgKeyVolume));
        return (round($numOfKeysToBeCleaned * static::CLEANUP_SIZE_ALLOWANCE));
    }

    /**
     * @param CacheInterface $cache
     * @param CheckStrategyInterface $checkStrategy
     * @return void
     */
    private function validateInput(CacheInterface $cache, CheckStrategyInterface $checkStrategy)
    {
        if (!($cache instanceof MeasurableCacheInterface)) {
            throw new \InvalidArgumentException(
                'Popularity cleanup strategy applicable to MeasurableCacheInterface only'
            );
        }

        if (!($checkStrategy instanceof VolumeInterface)) {
            throw new \InvalidArgumentException(
                'Popularity cleanup strategy applicable to Volume check strategy Interface only'
            );
        }
    }
}