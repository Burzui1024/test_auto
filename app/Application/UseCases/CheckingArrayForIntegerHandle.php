<?php

namespace App\Application\UseCases;

class CheckingArrayForIntegerHandle
{
    public function make(array $array): bool
    {
       return ctype_digit(implode('',$array));
    }
}
