<?php

namespace LaminasTest\Romans;

use Interop\Container\ContainerInterface;
use Laminas\ModuleManager\Feature\FilterProviderInterface;
use Laminas\ModuleManager\Feature\ServiceProviderInterface;
use Laminas\ModuleManager\Feature\ValidatorProviderInterface;
use Laminas\ModuleManager\Feature\ViewHelperProviderInterface;
use Laminas\Mvc\Application;
use Laminas\Romans\Filter;
use Laminas\Romans\Hydrator\Strategy as HydratorStrategy;
use Laminas\Romans\Module;
use Laminas\Romans\Validator;
use Laminas\Romans\View\Helper as ViewHelper;
use PHPUnit\Framework\TestCase;
use Romans\Filter as RomansFilter;
use Romans\Grammar as RomansGrammar;
use Romans\Lexer as RomansLexer;
use Romans\Parser as RomansParser;

/**
 * Module Test
 */
class ModuleTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->module = new Module();
    }

    /**
     * Build an Application
     *
     * @return Application
     */
    protected function buildApplication() : Application
    {
        return Application::init([
            // Listeners
            'module_listener_options' => [],
            // Modules
            'modules' => [
                'Laminas\Router',
                'Laminas\Filter',
                'Laminas\Validator',
                'Laminas\Hydrator',
                'Laminas\Romans',
            ],
        ]);
    }

    /**
     * Assert Service
     *
     * @param  ContainerInterface $manager Service Container
     * @param  string             $className Name of the Class
     * @param  array              $identifiers Identifiers
     * @return self               Fluent Interface
     */
    protected function assertService(ContainerInterface $manager, string $className, array $identifiers = []) : self
    {
        array_unshift($identifiers, $className);

        foreach ($identifiers as $identifier) {
            $this->assertTrue($manager->has($identifier));
            $this->assertInstanceOf($className, $manager->get($identifier));
        }

        return $this;
    }

    /**
     * Test Instance Of
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(FilterProviderInterface::class, $this->module);
        $this->assertInstanceOf(ServiceProviderInterface::class, $this->module);
        $this->assertInstanceOf(ValidatorProviderInterface::class, $this->module);
        $this->assertInstanceOf(ViewHelperProviderInterface::class, $this->module);
    }

    /**
     * Test RomanToInt Filter
     */
    public function testRomanToIntFilter()
    {
        $manager = $this->buildApplication()->getServiceManager()->get('FilterManager');

        $this->assertService($manager, Filter\RomanToInt::class, ['RomanToInt', 'romanToInt', 'romantoint']);
    }

    /**
     * Test IntToRoman Filter
     */
    public function testIntToRomanFilter()
    {
        $manager = $this->buildApplication()->getServiceManager()->get('FilterManager');

        $this->assertService($manager, Filter\IntToRoman::class, ['IntToRoman', 'intToRoman', 'inttoroman']);
    }

    /**
     * Test Roman Validator
     */
    public function testRomanValidator()
    {
        $manager = $this->buildApplication()->getServiceManager()->get('ValidatorManager');

        $this->assertService($manager, Validator\Roman::class, ['Roman', 'roman']);
    }

    /**
     * Test Roman ViewHelper
     */
    public function testRomanViewHelper()
    {
        $manager = $this->buildApplication()->getServiceManager()->get('ViewHelperManager');

        $this->assertService($manager, ViewHelper\Roman::class, ['Roman', 'roman']);
    }

    /*
     * Test Roman Hydrator Strategy
     */
    public function testRomanHydratorStrategy()
    {
        $manager = $this->buildApplication()->getServiceManager();

        $this->assertService($manager, HydratorStrategy\Roman::class);
    }

    /**
     * Test Default Romans Services
     */
    public function testDefaultRomansServices()
    {
        $manager = $this->buildApplication()->getServiceManager();

        $this->assertService($manager, RomansFilter\IntToRoman::class);
        $this->assertService($manager, RomansFilter\RomanToInt::class);
        $this->assertService($manager, RomansGrammar\Grammar::class);
        $this->assertService($manager, RomansLexer\Lexer::class);
        $this->assertService($manager, RomansParser\Parser::class);
    }
}
