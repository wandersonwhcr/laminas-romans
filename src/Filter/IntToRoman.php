<?php

namespace Laminas\Romans\Filter;

use Romans\Filter\Exception as FilterException;
use Romans\Filter\IntToRoman as IntToRomanFilter;
use Zend\Filter\FilterInterface;

/**
 * Integer to Roman Number Filter
 */
class IntToRoman implements FilterInterface
{
    /**
     * Base Integer to Roman Number Filter
     * @type IntToRomanFilter
     */
    private $intToRomanFilter;

    /**
     * Default Constructor
     *
     * @param IntToRomanFilter $intToRomanFilter IntToRomanFilter Object
     */
    public function __construct(IntToRomanFilter $intToRomanFilter = null)
    {
        if (! isset($intToRomanFilter)) {
            $intToRomanFilter = new IntToRomanFilter();
        }

        $this->setIntToRomanFilter($intToRomanFilter);
    }

    /**
     * Set Integer to Roman Number Filter
     *
     * @param  IntToRomanFilter $intToRomanFilter IntToRomanFilter Object
     * @return self             Fluent Interface
     */
    public function setIntToRomanFilter(IntToRomanFilter $intToRomanFilter) : self
    {
        $this->intToRomanFilter = $intToRomanFilter;
        return $this;
    }

    /**
     * Get Integer to Roman Number Filter
     *
     * @return IntToRomanFilter IntToRomanFilter Object
     */
    public function getIntToRomanFilter() : IntToRomanFilter
    {
        return $this->intToRomanFilter;
    }

    /**
     * {@inheritdoc}
     */
    public function filter($value)
    {
        try {
            $result = $this->getIntToRomanFilter()->filter($value);
        } catch (FilterException $e) {
            // default value: null
            $result = null;
        }

        return $result;
    }
}
