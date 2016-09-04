<?php

namespace Mufuphlex\Cache\Decorators;

use Mufuphlex\Cache\CacheInterface;
use Mufuphlex\Cache\GuardInterface;

/**
 * Class DecoratorGuarded
 * @package Mufuphlex\Cache\Decorators
 */
class DecoratorGuarded implements CacheInterface
{
    /** @var CacheInterface */
    private $cache;

    /** @var GuardInterface */
    private $guard;

    /**
     * DecoratorGuarded constructor.
     * @param CacheInterface $cache
     * @param GuardInterface $guard
     */
    public function __construct(CacheInterface $cache, GuardInterface $guard)
    {
        $this->cache = $cache;
        $this->guard = $guard;
    }

    /**
     * @param string $key
     * @param mixed $value
     * @param int $expirationTime
     * @return mixed
     */
    public function set($key, $value, $expirationTime = 0)
    {
        if (!$this->guard->check()) {
            return $this->cache;
        }

        return $this->cache->set($key, $value, $expirationTime);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->cache->get($key);
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function delete($key)
    {
        return $this->cache->delete($key);
    }

    /**
     * @param  void
     * @return mixed
     */
    public function clear()
    {
        return $this->cache->clear();
    }
}