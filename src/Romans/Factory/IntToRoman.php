<?php

namespace Laminas\Romans\Romans\Factory;

use Interop\Container\ContainerInterface;
use Romans\Filter\IntToRoman as IntToRomanFilter;
use Romans\Grammar\Grammar as RomansGrammar;
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
            $container->get(RomansGrammar::class)
        );
    }
}
