<?php

namespace LaminasTest\Romans\Filter;

use Laminas\Romans\Filter\IntToRoman;
use PHPUnit\Framework\TestCase;
use Zend\Filter\FilterInterface;

/**
 * Int to Roman Test
 */
class IntToRomanTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->filter = new IntToRoman();
    }

    /**
     * Test Instance Of
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(FilterInterface::class, $this->filter);
    }

    /**
     * Test Filter
     */
    public function testFilter()
    {
        $this->assertSame('I', $this->filter->filter(1));
        $this->assertSame('V', $this->filter->filter(5));
        $this->assertSame('X', $this->filter->filter(10));
    }

    /**
     * Test Filter with Invalid Input
     */
    public function testFilterWithInvalidInput()
    {
        $this->assertNull($this->filter->filter(-1));
    }
}
