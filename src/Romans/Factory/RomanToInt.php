<?php

namespace Laminas\Romans\Romans\Factory;

use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Romans\Filter\RomanToInt as RomanToIntFilter;
use Romans\Grammar\Grammar as RomansGrammar;
use Romans\Lexer\Lexer as RomansLexer;
use Romans\Parser\Parser as RomansParser;

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

        $service = new RomanToIntFilter(
            $container->get(RomansGrammar::class)
        );

        $service
            ->setLexer($container->get(RomansLexer::class))
            ->setParser($container->get(RomansParser::class));

        return $service;
    }
}
