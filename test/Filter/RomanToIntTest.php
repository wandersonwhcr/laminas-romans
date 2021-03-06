<?php

namespace LaminasTest\Romans\Filter;

use Laminas\Filter\FilterInterface;
use Laminas\Romans\Filter\RomanToInt;
use PHPUnit\Framework\TestCase;

/**
 * Roman to Int Test
 */
class RomanToIntTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->filter = new RomanToInt();
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
        $this->assertSame(1, $this->filter->filter('I'));
        $this->assertSame(5, $this->filter->filter('V'));
        $this->assertSame(10, $this->filter->filter('X'));
    }

    /**
     * Test Filter with Invalid Input
     */
    public function testFilterWithInvalidInput()
    {
        $this->assertNull($this->filter->filter('.'));
        $this->assertNull($this->filter->filter('IIX'));
        $this->assertNull($this->filter->filter(1));
        $this->assertNull($this->filter->filter(false));
    }
}
