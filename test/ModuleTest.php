<?php

namespace ZendTest\Romans;

use PHPUnit\Framework\TestCase;
use Zend\ModuleManager\Feature\FilterProviderInterface;
use Zend\ModuleManager\Feature\ValidatorProviderInterface;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\Mvc\Application;
use Zend\Romans\Filter;
use Zend\Romans\Module;
use Zend\Romans\Validator;
use Zend\Romans\View\Helper as ViewHelper;

/**
 * Module Test
 */
class ModuleTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
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
                'Zend\Router',
                'Zend\Filter',
                'Zend\Validator',
                'Zend\Romans',
            ],
        ]);
    }

    /**
     * Test Instance Of
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(FilterProviderInterface::class, $this->module);
        $this->assertInstanceOf(ValidatorProviderInterface::class, $this->module);
        $this->assertInstanceOf(ViewHelperProviderInterface::class, $this->module);
    }

    /**
     * Test RomanToInt Filter
     */
    public function testRomanToIntFilter()
    {
        $manager = $this->buildApplication()->getServiceManager()->get('FilterManager');

        $identifiers = [
            Filter\RomanToInt::class,
            'RomanToInt',
            'romanToInt',
            'romantoint',
        ];

        foreach ($identifiers as $identifier) {
            $this->assertTrue($manager->has($identifier));
            $this->assertInstanceOf(Filter\RomanToInt::class, $manager->get($identifier));
        }
    }

    /**
     * Test IntToRoman Filter
     */
    public function testIntToRomanFilter()
    {
        $manager = $this->buildApplication()->getServiceManager()->get('FilterManager');

        $identifiers = [
            Filter\IntToRoman::class,
            'IntToRoman',
            'intToRoman',
            'inttoroman',
        ];

        foreach ($identifiers as $identifier) {
            $this->assertTrue($manager->has($identifier));
            $this->assertInstanceOf(Filter\IntToRoman::class, $manager->get($identifier));
        }
    }

    /**
     * Test Roman Validator
     */
    public function testRomanValidator()
    {
        $manager = $this->buildApplication()->getServiceManager()->get('ValidatorManager');

        $identifiers = [
            Validator\Roman::class,
            'Roman',
            'roman',
        ];

        foreach ($identifiers as $identifier) {
            $this->assertTrue($manager->has($identifier));
            $this->assertInstanceOf(Validator\Roman::class, $manager->get($identifier));
        }
    }

    /**
     * Test Roman ViewHelper
     */
    public function testRomanViewHelper()
    {
        $manager = $this->buildApplication()->getServiceManager()->get('ViewHelperManager');

        $identifiers = [
            ViewHelper\Roman::class,
            'Roman',
            'roman',
        ];

        foreach ($identifiers as $identifier) {
            $this->assertTrue($manager->has($identifier));
            $this->assertInstanceOf(ViewHelper\Roman::class, $manager->get($identifier));
        }
    }
}