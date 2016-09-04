<?php

namespace Mufuphlex\Cache;

/**
 * Interface CleanupStrategyInterface
 * @package Mufuphlex\Cache
 */
interface CleanupStrategyInterface
{
    /**
     * @param CacheInterface $cache
     * @param CheckStrategyInterface $checkStrategy
     * @return mixed
     */
    public function cleanup(CacheInterface $cache, CheckStrategyInterface $checkStrategy);
}