<?php

namespace Mufuphlex\Cache;

/**
 * Interface MeasurableCacheInterface
 * @package Mufuphlex\Cache
 */
interface MeasurableCacheInterface
{
    /**
     * @return int
     */
    public function getVolume();

    /**
     * @return int
     */
    public function getCount();
}