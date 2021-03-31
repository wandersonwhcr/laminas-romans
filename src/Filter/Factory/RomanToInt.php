<?php

namespace Laminas\Romans\Filter\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Romans\Filter\RomanToInt as RomanToIntFilter;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Romans\Filter as RomansFilter;

/**
 * RomanToInt Filter Factory
 */
class RomanToInt implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $config = null)
    {
        unset($requestedName, $config); // PHPCS

        return new RomanToIntFilter(
            $container->get(RomansFilter\RomanToInt::class)
        );
    }
}
