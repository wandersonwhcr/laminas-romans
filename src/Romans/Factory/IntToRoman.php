<?php

namespace Laminas\Romans\Romans\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Romans\Filter\IntToRoman as IntToRomanFilter;
use Romans\Grammar\Grammar as RomansGrammar;

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
            $container->get(RomansGrammar::class)
        );
    }
}
