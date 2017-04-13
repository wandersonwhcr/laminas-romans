<?php

namespace Zend\Romans;

use Zend\ModuleManager\Feature\FilterProviderInterface;
use Zend\Romans\Filter;

/**
 * Romans Module
 */
class Module implements FilterProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function getFilterConfig()
    {
        return [
            'invokables' => [
                Filter\RomanToInt::class => Filter\RomanToInt::class,
            ],
        ];
    }
}
