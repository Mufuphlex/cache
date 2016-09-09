<?php

namespace Mufuphlex\Cache\KeyGenerators;

/**
 * Class Minutely
 * @package Mufuphlex\Cache\KeyGenerators
 */
final class Minutely extends TimelyAbstract
{
    protected $format = 'YmdHi';
}