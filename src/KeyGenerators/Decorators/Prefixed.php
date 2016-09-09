<?php

namespace Mufuphlex\Cache\KeyGenerators\Decorators;

use Mufuphlex\Cache\KeyGeneratorInterface;

/**
 * Class Prefixed
 * @package Mufuphlex\Util\Cache\KeyGenerators\Decorators
 */
final class Prefixed extends AbstractDecorator
{
    /** @var string */
    private $prefix = '';

    /**
     * Prefixed constructor.
     * @param KeyGeneratorInterface $keyGenerator
     * @param string $prefix
     */
    public function __construct(KeyGeneratorInterface $keyGenerator, $prefix)
    {
        parent::__construct($keyGenerator);
        $this->prefix = $prefix;
    }

    /** @inheritdoc */
    public function generate()
    {
        return $this->prefix.$this->keyGenerator->generate();
    }
}