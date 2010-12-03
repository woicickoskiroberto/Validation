<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\AlnumException;
use Respect\Validation\Exceptions\ComponentException;

class Alnum extends AbstractRule
{

    protected $additionalChars = '';

    public function __construct($additionalChars='')
    {
        if (!is_string($additionalChars))
            throw new ComponentException(
                'Invalid list of additional characters to be loaded'
            );
        $this->additionalChars = $additionalChars;
    }

    public function createException()
    {
        return new AlnumException;
    }

    public function validate($input)
    {
        return is_string($input) && preg_match(
            "#^[a-zA-Z0-9]+$#",
            str_replace(str_split($this->additionalChars), '', $input)
        );
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this
                ->getException()
                ->configure($input, $this->additionalChars);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}