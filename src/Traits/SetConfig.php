<?php

namespace MilanTarami\NepaliCalendar\Traits;

use MilanTarami\NepaliCalendar\Exceptions\NepaliCalendarException;

trait SetConfig {

    /**
     * load a initial config from np_calendar config file
    */
    private function setIntitalConfig()
    {
        $this->dateFormat = config('nepali-calendar.date_format');
        $this->returnType = config('nepali-calendar.return_type');
        $this->lang = config('nepali-calendar.lang');
    }

    /**
     * Set config from user input
     * @param array $config
    */
    private function setUserConfig($config = [])
    {
       if(gettype($config) === 'array') {

       }
       throw new NepaliCalendarException();
    }

}
