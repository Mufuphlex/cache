<?php

namespace Mufuphlex\Cache\KeyGenerators;

use Mufuphlex\Cache\KeyGeneratorInterface;

/**
 * Class TimelyAbstract
 * @package Mufuphlex\Cache\KeyGenerators
 */
abstract class TimelyAbstract implements KeyGeneratorInterface
{
    /** @var string */
    protected $format = '';

    /**
     * @return string
     */
    public function generate()
    {
        if ($this->format === '') {
            throw new \RuntimeException('format is not set for a particular Timely cache key generator');
        }

        return date($this->format);
    }
}