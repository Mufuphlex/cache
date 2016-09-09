<?php

namespace Mufuphlex\Cache;

/**
 * Interface KeyGeneratorInterface
 * @package Mufuphlex\Util\Cache
 */
interface KeyGeneratorInterface
{
    /**
     * @return string
     */
    public function generate();
}