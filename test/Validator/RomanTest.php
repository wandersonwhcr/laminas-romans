<?php

namespace LaminasTest\Romans\Validator;

use Laminas\Romans\Validator\Roman;
use PHPUnit\Framework\TestCase;
use Zend\Validator\ValidatorInterface;

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
        $this->validator = new Roman();
    }

    /**
     * Test Instance Of
     */
    public function testInstanceOf()
    {
        $this->assertInstanceOf(ValidatorInterface::class, $this->validator);
    }

    /**
     * Test Is Valid
     */
    public function testIsValid()
    {
        $this->assertTrue($this->validator->isValid('I'));
        $this->assertTrue($this->validator->isValid('V'));
        $this->assertTrue($this->validator->isValid('X'));
    }

    /**
     * Test Is Valid With Invalid Values
     */
    public function testIsValidWithInvalidValues()
    {
        $this->assertFalse($this->validator->isValid('.'));
        $this->assertSame(['unknownToken' => 'Unknown token "." at position 0'], $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid('IAI'));
        $this->assertSame(['unknownToken' => 'Unknown token "A" at position 1'], $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid(''));
        $this->assertSame(['invalidRoman' => 'Invalid Roman number ""'], $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid('XIIIX'));
        $this->assertSame(['invalidRoman' => 'Invalid Roman number "XIIIX"'], $this->validator->getMessages());

        $this->assertFalse($this->validator->isValid([]));
        $this->assertSame(['invalidType' => 'Invalid type; must be "string"'], $this->validator->getMessages());
    }
}
