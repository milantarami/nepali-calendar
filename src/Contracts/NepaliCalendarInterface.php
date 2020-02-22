<?php

namespace MilanTarami\NepaliCalendar\Contracts;

interface NepaliCalendarInterface
{
    /**
     * Add months to BS Date
     * @param string $date
     * @param int $days
     * @param array #config
     * @return string
    */
    public function addMonthsToBsDate(string $date, int $months, array $config = []);
    /**
    * Add months to BS Date
    * @param string $date
    * @param int $days
    * @param array #config
    * @return string
    */
    public function removeMonthsFromBsDate(string $date, int $months, array $config = []);
    /**
     * Add days to BS Date
     * @param string $date
     * @param int $days
     * @param array #config
     * @return string
    */
    public function addDaysToBsDate(string $date, int $days, array $config = []);

    /**
     * remove days from BS Date
     * @param string $date
     * @param int $days
     * @param array #config
     * @return string|array
    */
    public function removeDaysFromBsDate(string $date, int $days, array $config = []);
    /**
     * days difference in two bs days
     * @param string $date
     * @param int $days
     * @param array #config
     * @return string|array
    */
    public function daysDifferenceInTwoBsDate(string $fromDate, string $toDate, array $config = []);

    /**
     * days difference in two ad days
     * @param string $date
     * @param int $days
     * @param array #config
     * @return string|array
    */
    public function daysDifferenceInTwoAdDate(string $fromDate, string $toDate, array $config = []);

    /**
     * Convert AD to BS
     * @param string $date
     * @param array $config
     * @return string|array
    */
    public function AD2BS(string $date, array $config = []);

    /**
     * Convert BS to AD
     * @param string $date
     * @param array $config
     * @return string|array
    */
    public function BS2AD(string $date, array $config = []);

    /**
     * get today BS date
     * @param string $calendarType
     * @return string
    */
    public function today(string $calendarType = 'BS');
    /**
     * get yesterday BS date
     * @param string $calendarType
     * @return string
    */
    public function yesterday(string $calendarType = 'BS');

    /**
     * get tomorrow BS date
     * @param string $calendarType
     * @return string
    */
    public function tomorrow(string $calendarType = 'BS');
    /**
     * check is BS date exists in calendar
     * Note: It support between date range
     * @param string $date
     * @param array $config
     * @return bool
    */
    public function bsDateExists(string $date, array $config = []);
    /**
     * check is AD date exists in calendar
     * Note: It support between date range
     * @param string $date
     * @param array $config
     * @return bool
     */
    public function adDateExists(string $date, array $config = []);
}
