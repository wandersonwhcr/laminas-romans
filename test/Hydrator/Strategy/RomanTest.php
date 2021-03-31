<?php

namespace LaminasTest\Romans\Hydrator\Strategy;

use InvalidArgumentException;
use Laminas\Hydrator\Strategy\StrategyInterface;
use Laminas\Romans\Hydrator\Strategy\Roman as RomanStrategy;
use PHPUnit\Framework\TestCase;

/**
 * Roman Test
 */
class RomanTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        $this->strategy = new RomanStrategy();
    }

    /**
     * Test Instance Of
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(StrategyInterface::class, $this->strategy);
    }

    /**
     * Test Hydrate
     */
    public function testHydrate()
    {
        $this->assertSame('I', $this->strategy->hydrate(1));
        $this->assertSame('V', $this->strategy->hydrate(5));
        $this->assertSame('X', $this->strategy->hydrate(10));
    }

    /**
     * Test Hydrate with Invalid Value
     */
    public function testHydrateWithInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->strategy->hydrate('FOOBAR');
    }

    /**
     * Test Hydrate with Invalid Integer
     */
    public function testHydrateWithInvalidInteger()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->strategy->hydrate(-1);
    }

    /**
     * Test Extract
     */
    public function testExtract()
    {
        $this->assertSame(1, $this->strategy->extract('I'));
        $this->assertSame(5, $this->strategy->extract('V'));
        $this->assertSame(10, $this->strategy->extract('X'));
    }

    /**
     * Test Extract with Invalid Value
     */
    public function testExtractWithInvalidValue()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->strategy->extract(false);
    }

    /**
     * Test Extract with Invalid Roman
     */
    public function testExtractWithInvalidRoman()
    {
        $this->expectException(InvalidArgumentException::class);

        $this->strategy->extract('XIXX');
    }
}
