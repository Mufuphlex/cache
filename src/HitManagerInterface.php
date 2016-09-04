<?php

namespace Mufuphlex\Cache;

/**
 * Class HitManager
 * @package Mufuphlex\Cache
 */
interface HitManagerInterface
{
    /**
     * @param string $key
     * @return $this
     */
    public function inc($key);

    /**
     * @param string $key
     * @return $this
     */
    public function remove($key);

    /**
     * @return $this
     */
    public function clear();

    /**
     * @param int $sliceSize
     * @return array
     */
    public function getLessPopularKeys($sliceSize);
}