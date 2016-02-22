<?php

namespace Shuc324\Support\Traits;

use BadMethodCallException;

trait Macro
{
    public static function __call($method, $parameters)
    {
     
        throw new BadMethodCallException('Method ' . $method . ' does not exists. ');
    }

    public static function __callStatic($method, $parameters)
    {
    
        throw new BadMethodCallException('Method ' . $method . ' does not exists. ');
    }
}
