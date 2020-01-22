<?php

namespace MilanTarami\NepaliCalendar;

use MilanTarami\NepaliCalendar\Traits\SetConfig;
use MilanTarami\NepaliCalendar\Traits\CalendarMessage;
use MilanTarami\NepaliCalendar\Interfaces\CalendarInterface;

class Calendar implements CalendarInterface
{

    use SetConfig, CalendarMessage;

    protected $dateFormat;
    protected $dateSeperator;
    protected $returnType;
    protected $lang;

    public function __construct()
    {
        $this->setIntitalConfig();
    }

    /**
     * Get a date in array format
     * @param string|date $date
     * @param array $config
    */
    private function getDateInArray($date, $config = [])
    {
       $this->setUserConfig($config);
    }



}
