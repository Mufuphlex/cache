<?php

namespace Mufuphlex\Cache\KeyGenerators;

/**
 * Class Hourly
 * @package Mufuphlex\Cache\KeyGenerators
 */
final class Hourly extends TimelyAbstract
{
    protected $format = 'YmdH';
}