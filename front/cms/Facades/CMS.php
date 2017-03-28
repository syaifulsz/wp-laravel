<?php

namespace SSZ\CMS\Facades;

use Illuminate\Support\Facades\Facade;

class CMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'ssz-cms';
    }
}