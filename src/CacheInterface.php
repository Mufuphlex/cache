<?php

namespace Mufuphlex\Cache;

/**
 * Interface CacheInterface
 * @package Mufuphlex\Cache
 */
interface CacheInterface
{
    /**
     * @param string $key
     * @param mixed $value
     * @param int $expirationTime
     * @return mixed
     */
    public function set($key, $value, $expirationTime = 0);

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key);

    /**
     * @param string $key
     * @return mixed
     */
    public function delete($key);

    /**
     * @param  void
     * @return mixed
     */
    public function clear();
}