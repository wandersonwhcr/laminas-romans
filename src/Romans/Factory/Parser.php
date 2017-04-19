<?php

namespace Zend\Romans\Romans\Factory;

use Interop\Container\ContainerInterface;
use Romans\Grammar\Grammar as RomansGrammar;
use Romans\Parser\Parser as RomansParser;
use Zend\ServiceManager\Factory\FactoryInterface;

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
        return new RomansParser(
            $container->get(RomansGrammar::class)
        );
    }
}
