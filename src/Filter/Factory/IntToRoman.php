<?php

namespace Laminas\Romans\Filter\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Romans\Filter\IntToRoman as IntToRomanFilter;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Romans\Filter as RomansFilter;

/**
 * IntToRoman Filter Factory
 */
class IntToRoman implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $config = null)
    {
        unset($requestedName, $config); // PHPCS

        return new IntToRomanFilter(
            $container->get(RomansFilter\IntToRoman::class)
        );
    }
}
