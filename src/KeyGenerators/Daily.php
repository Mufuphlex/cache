<?php

namespace Mufuphlex\Cache\KeyGenerators;

/**
 * Class Daily
 * @package Mufuphlex\Util\Cache\KeyGenerators
 */
final class Daily extends TimelyAbstract
{
    protected $format = 'Ymd';
}