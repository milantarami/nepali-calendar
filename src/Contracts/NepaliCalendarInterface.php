<?php

namespace MilanTarami\NepaliCalendar\Contracts;

interface NepaliCalendarInterface
{
    /**
     * Add number of months to given date
     * @param string|date $date
     * @param int $months
     * @param array $config
     * @return array|string
    */
    public function addMonthsToBsDate($date, $months, $config = []);
    
    public function removeMonthsToBsDate($date, $months, $config = []);

    public function addDaysToBsDate($date, $days, $config = []);
    public function removeDaysToBsDate($date, $days, $config = []);

    public function daysDifferenceInTwoBsDate($fromDate, $toDate, $config = []);

    public function AD2BS($date, $config = []);

    public function BS2AD($date, $config = []);

    public function today();

    public function yesterday();

    public function tomorrow();

}
