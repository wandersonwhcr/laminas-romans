<?php

namespace Laminas\Romans\Filter;

use Romans\Lexer\Exception as LexerException;
use Romans\Parser\Exception as ParserException;
use Romans\Filter\RomanToInt as BaseRomanToInt;
use Zend\Filter\FilterInterface;

/**
 * Roman Number to Integer Filter
 */
class RomanToInt implements FilterInterface
{
    /**
     * {@inheritdoc}
     */
    public function filter($value)
    {
        try {
            $result = (new BaseRomanToInt())->filter($value);
        } catch (LexerException $e) {
            // default value: null
            $result = null;
        } catch (ParserException $e) {
            // default value: null
            $result = null;
        }

        return $result;
    }
}
