<?php

namespace Mufuphlex\Cache\Guards\HitManaged;

use Mufuphlex\Cache\CheckStrategy\Volume;
use Mufuphlex\Cache\CleanupStrategy\Popularity;
use Mufuphlex\Cache\HitManagerInterface;
use Mufuphlex\Cache\CacheInterface;

/**
 * Class HitManagedGuard
 * @package Mufuphlex\Cache\Guards\HitManaged
 */
class HitManagedGuard extends HitManagedGuardAbstract
{
    /**
     * HitManagedGuard constructor.
     * @param CacheInterface $cache
     * @param HitManagerInterface $hitManager
     * @param int $maxVolume
     */
    public function __construct(CacheInterface $cache, HitManagerInterface $hitManager, $maxVolume)
    {
        parent::__construct($cache);

        $checkStrategy = new Volume($this->cache);
        $checkStrategy->setMaxVolume($maxVolume);

        $this->checkStrategies = array($checkStrategy);

        $this->setCleanupStrategy(new Popularity($hitManager));
    }
}