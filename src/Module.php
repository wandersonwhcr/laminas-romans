<?php

namespace Laminas\Romans;

use Laminas\ModuleManager\Feature\FilterProviderInterface;
use Laminas\ModuleManager\Feature\ServiceProviderInterface;
use Laminas\ModuleManager\Feature\ValidatorProviderInterface;
use Laminas\ModuleManager\Feature\ViewHelperProviderInterface;
use Laminas\Romans\Hydrator\Strategy as HydratorStrategy;
use Laminas\Romans\Romans\Factory as RomansFactory;
use Laminas\Romans\Validator;
use Laminas\Romans\View\Helper as ViewHelper;
use Romans\Filter as RomansFilter;
use Romans\Grammar as RomansGrammar;
use Romans\Lexer as RomansLexer;
use Romans\Parser as RomansParser;

/**
 * Romans Module
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Module implements
    FilterProviderInterface,
    ServiceProviderInterface,
    ValidatorProviderInterface,
    ViewHelperProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getFilterConfig()
    {
        return [
            'factories' => [
                Filter\IntToRoman::class => Filter\Factory\IntToRoman::class,
                Filter\RomanToInt::class => Filter\Factory\RomanToInt::class,
            ],
            'aliases' => [
                'RomanToInt' => Filter\RomanToInt::class,
                'romanToInt' => Filter\RomanToInt::class,
                'romantoint' => Filter\RomanToInt::class,
                'IntToRoman' => Filter\IntToRoman::class,
                'intToRoman' => Filter\IntToRoman::class,
                'inttoroman' => Filter\IntToRoman::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getServiceConfig()
    {
        return [
            'invokables' => [
                RomansGrammar\Grammar::class   => RomansGrammar\Grammar::class,
            ],
            'factories' => [
                HydratorStrategy\Roman::class  => HydratorStrategy\Factory\Roman::class,
                RomansFilter\IntToRoman::class => RomansFactory\IntToRoman::class,
                RomansFilter\RomanToInt::class => RomansFactory\RomanToInt::class,
                RomansLexer\Lexer::class       => RomansFactory\Lexer::class,
                RomansParser\Parser::class     => RomansFactory\Parser::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getValidatorConfig()
    {
        return [
            'factories' => [
                Validator\Roman::class => Validator\Factory\Roman::class,
            ],
            'aliases' => [
                'Roman' => Validator\Roman::class,
                'roman' => Validator\Roman::class,
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getViewHelperConfig()
    {
        return [
            'factories' => [
                ViewHelper\Roman::class => ViewHelper\Factory\Roman::class,
            ],
            'aliases' => [
                'Roman' => ViewHelper\Roman::class,
                'roman' => ViewHelper\Roman::class,
            ],
        ];
    }
}
