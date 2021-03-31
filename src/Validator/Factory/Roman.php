<?php

namespace Laminas\Romans\Validator\Factory;

use Interop\Container\ContainerInterface;
use Laminas\Romans\Validator\Roman as RomanValidator;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Romans\Filter\RomanToInt as RomanToIntFilter;

/**
 * Roman Validator Factory
 */
class Roman implements FactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $config = null)
    {
        unset($requestedName, $config); // PHPCS

        return new RomanValidator(
            $container->get(RomanToIntFilter::class)
        );
    }
}
