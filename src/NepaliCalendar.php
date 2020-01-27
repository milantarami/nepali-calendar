<?php

namespace MilanTarami\NepaliCalendar;

use MilanTarami\NepaliCalendar\Traits\SetConfig;
use MilanTarami\NepaliCalendar\Traits\CalendarMessage;
use MilanTarami\NepaliCalendar\Interfaces\CalendarInterface;

class NepaliCalendar implements CalendarInterface
{

    use SetConfig, CalendarMessage;

    protected $dateFormat;
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

    public function addDaysToBsDate($date, $days, $config = [])
    {

    }

    public function addMonthToBsDate($date, $months, $config = [])
    {

    }

    public function BS2AD($date, $config = [])
    {

    }

    public function AD2BS($date, $config = [])
    {

    }

    public function get()
    {
        dd($this->dateFormat);
    }



}
