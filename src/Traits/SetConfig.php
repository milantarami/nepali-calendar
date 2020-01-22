<?php

namespace MilanTarami\NepaliCalendar\Traits;

use MilanTarami\NepaliCalendar\NepaliCalendarException;

trait SetConfig {

    /**
     * load a initial config from np_calendar config file
    */
    private function setIntitalConfig()
    {
        $this->dateFormat = config('np_calendar.date_format');
        $this->dateSeperator = config('np_calendar.date_seperator');
        $this->returnType = config('np_calendar.return_type');
        $this->lang = config('np_calendar.lang');
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
