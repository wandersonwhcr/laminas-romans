<?php

namespace Zend\Romans\View\Helper;

use PHPUnit\Framework\TestCase;
use Zend\View\Helper\HelperInterface;

/**
 * Roman Test
 */
class RomanTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->helper = new Roman();
    }

    /**
     * Test Instance Of
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(HelperInterface::class, $this->helper);
    }

    /**
     * Test Roman
     */
    public function testRoman()
    {
        $this->assertSame('N', ($this->helper)(0));
        $this->assertSame('I', ($this->helper)(1));

        $this->assertSame('CDLXIX', ($this->helper)(469));
        $this->assertSame('MCMXCIX', ($this->helper)(1999));
    }
}
