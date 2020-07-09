<?php

namespace CarroPublic\Like\Facades;

use Illuminate\Support\Facades\Facade;

class Like extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'like';
    }
}
