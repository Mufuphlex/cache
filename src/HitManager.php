<?php

namespace Mufuphlex\Cache;

/**
 * Class HitManager
 * @package Mufuphlex\Cache
 */
class HitManager implements HitManagerInterface
{
    /** @var array */
    private $hitsCounter = array();

    /** @var array */
    private $hitsTimer = array();

    /** @var int */
    private $timerOffset = 0;

    /**
     * HitManager constructor.
     */
    public function __construct()
    {
        $this->timerOffset = time();
    }

    /**
     * @param string $key
     * @return $this
     */
    public function inc($key)
    {
        $this->incHitCounter($key);
        $this->updateTimer($key);
        return $this;
    }

    /**
     * @param string $key
     * @return $this
     */
    public function remove($key)
    {
        if (isset($this->hitsCounter[$key])) {
            unset($this->hitsCounter[$key]);
        }

        if (isset($this->hitsTimer[$key])) {
            unset($this->hitsTimer[$key]);
        }

        return $this;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->hitsCounter = array();
        $this->hitsTimer = array();
        return $this;
    }

    /**
     * @param int $sliceSize
     * @return array
     */
    public function getLessPopularKeys($sliceSize)
    {
        asort($this->hitsCounter);
        $keys = array_keys($this->hitsCounter);
        return array_slice($keys, 0, $sliceSize);
    }

    /**
     * @param string $key
     */
    private function incHitCounter($key)
    {
        if (!isset($this->hitsCounter[$key])) {
            $this->hitsCounter[$key] = 0;
        }

        $this->hitsCounter[$key]++;
    }

    /**
     * @param string $key
     */
    private function updateTimer($key)
    {
        $this->hitsTimer[$key] = time() - $this->timerOffset;
    }
}