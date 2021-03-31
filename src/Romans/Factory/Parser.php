<?php

namespace Laminas\Romans\Romans\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Romans\Grammar\Grammar as RomansGrammar;
use Romans\Parser\Parser as RomansParser;

/**
 * Parser Factory
 */
class Parser implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $config = null)
    {
        unset($requestedName, $config); // PHPCS

        return new RomansParser(
            $container->get(RomansGrammar::class)
        );
    }
}
