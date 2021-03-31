<?php

namespace Laminas\Romans\View\Helper;

use Laminas\Romans\Filter\IntToRoman as IntToRomanFilter;
use Laminas\View\Helper\AbstractHelper;

/**
 * Roman Helper
 */
class Roman extends AbstractHelper
{
    /**
     * IntToRoman Filter
     * @type IntToRomanFilter
     */
    private $intToRomanFilter;

    /**
     * Default Constructor
     *
     * @param IntToRomanFilter IntToRoman Filter
     */
    public function __construct(IntToRomanFilter $intToRomanFilter = null)
    {
        if (! isset($intToRomanFilter)) {
            $intToRomanFilter = new IntToRomanFilter();
        }

        $this->setIntToRomanFilter($intToRomanFilter);
    }

    /**
     * Set IntToRoman Filter
     *
     * @param  IntToRomanFilter $intToRomanFilter IntToRoman Object
     * @return self             Fluent Interface
     */
    protected function setIntToRomanFilter(IntToRomanFilter $intToRomanFilter) : self
    {
        $this->intToRomanFilter = $intToRomanFilter;
        return $this;
    }

    /**
     * Get IntToRoman Filter
     *
     * @return IntToRomanFilter IntToRoman Object
     */
    protected function getIntToRomanFilter() : IntToRomanFilter
    {
        return $this->intToRomanFilter;
    }

    /**
     * Invoke Support
     */
    public function __invoke(string $value)
    {
        return $this->getIntToRomanFilter()->filter($value);
    }
}
