<?php

namespace Mufuphlex\Cache\CheckStrategy;

/**
 * Interface VolumeInterface
 * @package Mufuphlex\Cache\CheckStrategy
 */
interface VolumeInterface
{
    /**
     * @param int $maxVolume
     * @return $this
     */
    public function setMaxVolume($maxVolume);

    /**
     * @return int
     */
    public function getMaxVolume();
}