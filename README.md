# laminas-romans

Laminas Project Romans Integration

[![Latest Stable Version](https://poser.pugx.org/wandersonwhcr/laminas-romans/v/stable?format=flat)](https://packagist.org/packages/wandersonwhcr/laminas-romans)
[![License](https://poser.pugx.org/wandersonwhcr/laminas-romans/license?format=flat)](https://packagist.org/packages/wandersonwhcr/laminas-romans)

## Description

This package provides a Laminas Project integration for
[Romans](https://github.com/wandersonwhcr/romans) library, providing tools to
filter a `string` with a Roman number to `int` and vice-versa, validate a
`string` that contains this type of number and, finally, hydrate the content to
`int`.

## Installation

This package uses Composer as default repository. You can install it adding the
name of package in `require` attribute of `composer.json`, pointing to the last
stable version.

```json
{
    "require": {
        "wandersonwhcr/laminas-romans": "^1.0"
    }
}
```

## Usage

This package provide filters, validators and hydrators to use with Laminas
projects. Also, this package is provided as a Laminas module, automatically
configuring services inside application, but this action is not required.

### Filters

Laminas Romans provides a couple of filters to convert a `string` with Roman
number to `int` and a Integer to a `string` that represents the input as Roman
number.

```php
use Laminas\Romans\Filter\RomanToInt as RomanToIntFilter;
use Laminas\Romans\Filter\IntToRoman as IntToRomanFilter;

$value = 'MCMXCIX';

$filter = new RomanToIntFilter();
$value  = $filter->filter($value); // 1999

$filter = new IntToRomanFilter();
$value  = $filter->filter($value); // MCMXCIX
```

### Validator

Also, this package include a validator to verify if a `string` contains a valid
Roman number.

```php
use Laminas\Romans\Validator\Roman as RomanValidator;

$validator = new RomanValidator();

$result = $validator->isValid('MCMXCIX'); // true

$result   = $validator->isValid('IAI'); // false
$messages = $validator->getMessages();

/*
$messages = [
    'unknownToken' => 'Unknown token "A" at position 1',
];
*/

$result   = $validator->isValid('XIIIX'); // false
$messages = $validator->getMessages();

/*
$messages = [
    'invalidRoman' => 'Invalid Roman number "XIIX"',
];
 */
```

### Hydrator

There is a hydrator strategy, responsible to handle Roman numbers. Like any
other Laminas strategy, exceptions will be throw for errors.

```php
use InvalidArgumentException;
use Laminas\Romans\Hydrator\Strategy\Roman as RomanHydratorStrategy;

$value    = 'MCMXCIX';
$strategy = new RomanHydratorStrategy();

try {
    $value = $strategy->hydrate($value); // 1999
    $value = $strategy->extract($value); // MCMXCIX
} catch (InvalidArgumentException $e) {
    // unable to convert
}
```

### ViewHelper

Finally, there is a view helper to convert `int` to Roman numbers directly,
using an internal filter for this job.

```php
use Laminas\Romans\View\Helper\Roman as RomanViewHelper;

$helper = new RomanViewHelper();

// Simple Access
echo $helper(1999); // MCMXCIX

// ... or Inside ViewRenderer
echo $this->roman(1999); // MCMXCIX
```

### Module

This package is provided as a Laminas module. To initialize this module, add the
package namespace into application loaded modules configuration.

```php
<?php
return [
    'modules' => [
        // ...
        'Laminas\Romans',
        // ...
    ],
];
```

Using this feature you must require Laminas ModuleManager and ServiceManager in
your `composer.json` file.

```json
{
    "require": {
        "laminas/laminas-modulemanager": "2.10.*",
        "laminas/laminas-servicemanager": "3.6.*"
    }
}
```

## Services Available

If you configure this package as a Laminas module, there is a lot of services
configured. The list below shows all services available with `Laminas\Romans`
module. Items with double-arrow represents services aliases.

* `Romans\Grammar\Grammar`
* `Romans\Lexer\Lexer`
* `Romans\Parser\Parser`
* `Romans\Filter\IntToRoman`
* `Romans\Filter\RomanToInt`
* `Laminas\Romans\Hydrator\Strategy\Roman`
* `FilterManager`
  * `Laminas\Romans\Filter\IntToRoman`
  * `Laminas\Romans\Filter\RomanToInt`
  * `IntToRoman` => `Laminas\Romans\Filter\IntToRoman`
  * `intToRoman` => `Laminas\Romans\Filter\IntToRoman`
  * `inttoroman` => `Laminas\Romans\Filter\IntToRoman`
  * `RomanToInt` => `Laminas\Romans\Filter\RomanToInt`
  * `romanToInt` => `Laminas\Romans\Filter\RomanToInt`
  * `romantoint` => `Laminas\Romans\Filter\RomanToInt`
* `ValidatorManager`
  * `Laminas\Romans\Validator\Roman`
  * `Roman` => `Laminas\Romans\Validator\Roman`
  * `roman` => `Laminas\Romans\Validator\Roman`
* `ViewHelperManager`
  * `Laminas\Romans\View\Helper\Roman`
  * `Roman` => `Laminas\Romans\View\Helper\Roman`
  * `roman` => `Laminas\Romans\View\Helper\Roman`

## Development

You can use Docker Compose to build an image and run a container to develop and
test this package.

```bash
docker-compose up --detach

docker-compose exec romans composer install

docker-compose exec romans composer test
```

## License

This package is opensource and available under license MIT described in
[LICENSE](https://github.com/wandersonwhcr/laminas-romans/blob/main/LICENSE).
