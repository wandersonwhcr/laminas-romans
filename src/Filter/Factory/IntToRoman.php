<?php

namespace Laminas\Romans\Filter\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Romans\Filter\IntToRoman as IntToRomanFilter;
use Romans\Filter as RomansFilter;
use Zend\ServiceManager\Factory\FactoryInterface;

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
