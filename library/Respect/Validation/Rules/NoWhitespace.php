<?php

namespace Respect\Validation\Rules;

use Respect\Validation\Rules\AbstractRule;
use Respect\Validation\Exceptions\NoWhitespaceException;

class NoWhitespace extends AbstractRule
{

    public function createException()
    {
        return new NoWhitespaceException;
    }

    public function validate($input)
    {
        return preg_match('#^\S+$#', $input);
    }

    public function assert($input)
    {
        if (!$this->validate($input))
            throw $this
                ->getException()
                ->configure($input);
        return true;
    }

    public function check($input)
    {
        return $this->assert($input);
    }

}