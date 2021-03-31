<?php

namespace Zend\Romans\Hydrator\Strategy;

use InvalidArgumentException;
use Zend\Hydrator\Strategy\StrategyInterface;
use Zend\Romans\Filter\IntToRoman as IntToRomanFilter;
use Zend\Romans\Filter\RomanToInt as RomanToIntFilter;

/**
 * Roman Number Hydrator Strategy
 */
class Roman implements StrategyInterface
{
    /**
     * IntToRoman Filter
     * @type IntToRomanFilter
     */
    private $intToRomanFilter;

    /**
     * RomanToInt Filter
     * @type RomanToIntFilter
     */
    private $romanToIntFilter;

    /**
     * Default Constructor
     *
     * @param IntToRomanFilter $intToRomanFilter Integer to Roman Number Filter
     * @param RomanToIntFilter $romanToIntFilter Roman Number to Integer Filter
     */
    public function __construct(IntToRomanFilter $intToRomanFilter = null, RomanToIntFilter $romanToIntFilter = null)
    {
        if (! isset($intToRomanFilter)) {
            $intToRomanFilter = new IntToRomanFilter();
        }

        if (! isset($romanToIntFilter)) {
            $romanToIntFilter = new RomanToIntFilter();
        }

        $this
            ->setIntToRomanFilter($intToRomanFilter)
            ->setRomanToIntFilter($romanToIntFilter);
    }

    /**
     * Set IntToRoman Filter
     *
     * @param  IntToRomanFilter $intToRomanFilter IntToRoman Filter Object
     * @return self             Fluent Interface
     */
    public function setIntToRomanFilter(IntToRomanFilter $intToRomanFilter) : self
    {
        $this->intToRomanFilter = $intToRomanFilter;
        return $this;
    }

    /**
     * Get IntToRoman Filter
     *
     * @return IntToRomanFilter IntToRoman Filter Object
     */
    public function getIntToRomanFilter() : IntToRomanFilter
    {
        return $this->intToRomanFilter;
    }

    /**
     * Set RomanToInt Filter
     *
     * @param  RomanToIntFilter $romanToIntFilter RomanToInt Filter Object
     * @return self             Fluent Interface
     */
    public function setRomanToIntFilter(RomanToIntFilter $romanToIntFilter) : self
    {
        $this->romanToIntFilter = $romanToIntFilter;
        return $this;
    }

    /**
     * Get RomanToInt Filter
     *
     * @return RomanToIntFilter RomanToInt Filter Object
     */
    public function getRomanToIntFilter() : RomanToIntFilter
    {
        return $this->romanToIntFilter;
    }

    /**
     * {@inheritdoc}
     */
    public function hydrate($value, ?array $data = [])
    {
        unset($data); // unused

        if (! is_int($value)) {
            throw new InvalidArgumentException('Invalid value type; must be "int"');
        }

        $result = $this->getIntToRomanFilter()->filter($value);

        if (! is_string($result)) {
            throw new InvalidArgumentException('Invalid result; cannot convert value');
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function extract($value, ?object $object = null)
    {
        unset($object); // unused

        if (! is_string($value)) {
            throw new InvalidArgumentException('Invalid value type; must be "string"');
        }

        $result = $this->getRomanToIntFilter()->filter($value);

        if (! is_int($result)) {
            throw new InvalidArgumentException('Invalid result; cannot convert value');
        }

        return $result;
    }
}
