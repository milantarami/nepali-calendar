<?php

namespace MilanTarami\NepaliCalendar\Facades;

use Illuminate\Support\Facades\Facade;

class NepaliCalendar extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'nepalicalendar';
    }
}
