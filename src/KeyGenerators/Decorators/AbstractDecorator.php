<?php

namespace Mufuphlex\Cache\KeyGenerators\Decorators;

use Mufuphlex\Cache\KeyGeneratorInterface;

/**
 * Class AbstractDecorator
 * @package Mufuphlex\Util\Cache\KeyGenerators\Decorators
 */
abstract class AbstractDecorator implements KeyGeneratorInterface
{
    /** @var KeyGeneratorInterface */
    protected $keyGenerator;

    /**
     * AbstractDecorator constructor.
     * @param KeyGeneratorInterface $keyGenerator
     */
    public function __construct(KeyGeneratorInterface $keyGenerator)
    {
        $this->keyGenerator = $keyGenerator;
    }
}