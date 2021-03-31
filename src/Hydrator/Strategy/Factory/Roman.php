<?php

namespace Laminas\Romans\Hydrator\Strategy\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Romans\Filter\IntToRoman as IntToRomanFilter;
use Laminas\Romans\Filter\RomanToInt as RomanToIntFilter;
use Laminas\Romans\Hydrator\Strategy\Roman as RomanStrategy;
use Laminas\ServiceManager\Factory\FactoryInterface;

/**
 * Roman Hydrator Strategy Factory
 */
class Roman implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $config = null)
    {
        unset($requestedName, $config); // PHPCS

        return new RomanStrategy(
            $container->get('FilterManager')->get(IntToRomanFilter::class),
            $container->get('FilterManager')->get(RomanToIntFilter::class)
        );
    }
}
