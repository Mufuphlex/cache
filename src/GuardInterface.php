<?php

namespace Mufuphlex\Cache;

/**
 * Interface GuardInterface
 * @package Mufuphlex\Cplt\Container\Cache
 */
interface GuardInterface
{
    /**
     * @param CacheInterface $cache
     * @return mixed
     */
    public function setCache(CacheInterface $cache);

    /**
     * @param CleanupStrategyInterface $cleanupStrategy
     * @return mixed
     */
    public function setCleanupStrategy(CleanupStrategyInterface $cleanupStrategy);

    /**
     * @return mixed
     */
    public function check();
}