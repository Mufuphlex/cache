<?php

namespace Mufuphlex\Cache;

/**
 * Interface CheckStrategyInterface
 * @package Mufuphlex\Cache
 */
interface CheckStrategyInterface
{
    /**
     * @return bool
     */
    public function check();

    /**
     * @return int
     */
    public function getVolumeDiff();
}