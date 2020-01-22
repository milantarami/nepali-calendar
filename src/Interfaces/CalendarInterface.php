<?php

namespace MilanTarami\NepaliCalendar\Interfaces;

interface CalendarInterface
{
    /**
     * Add number of months to given date
     * @param string|date $date
     * @param int $months
     * @param array $config
     * @return array|string
    */
    public function addMonthToBsDate($date, $months, $config = []);

    public function addDaysToBsDate($date, $days, $config = []);

    public function AD2BS($date, $config = []);

    public function BS2AD($date, $config = []);

}
