<?php

namespace Laminas\Romans\Romans\Factory;

use Interop\Container\ContainerInterface;
use Romans\Grammar\Grammar as RomansGrammar;
use Romans\Lexer\Lexer as RomansLexer;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Lexer Factory
 */
class Lexer implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $config = null)
    {
        unset($requestedName, $config); // PHPCS

        return new RomansLexer(
            $container->get(RomansGrammar::class)
        );
    }
}
