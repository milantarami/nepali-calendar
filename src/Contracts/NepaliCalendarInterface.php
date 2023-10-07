<?php

namespace MilanTarami\NepaliCalendar\Contracts;

interface NepaliCalendarInterface
{
    /**
     * Add months to BS Date.
     *
     * @param  string  $date
     * @param  int  $days
     * @param array #config
     * @return string
     */
    public function addMonthsToBsDate($date, $months, $config = []);

    /**
     * Add months to BS Date.
     *
     * @param  string  $date
     * @param  int  $days
     * @param array #config
     * @return string
     */
    public function removeMonthsFromBsDate($date, $months, $config = []);

    /**
     * Add days to BS Date.
     *
     * @param  string  $date
     * @param  int  $days
     * @param array #config
     * @return string
     */
    public function addDaysToBsDate($date, $days, $config = []);

    /**
     * remove days from BS Date.
     *
     * @param  string  $date
     * @param  int  $days
     * @param array #config
     * @return string|array
     */
    public function removeDaysFromBsDate($date, $days, $config = []);

    /**
     * days difference in two bs days.
     *
     * @param  string  $date
     * @param  int  $days
     * @param array #config
     * @return string|array
     */
    public function daysDifferenceInTwoBsDate($fromDate, $toDate, $config = []);

    /**
     * days difference in two ad days.
     *
     * @param  string  $date
     * @param  int  $days
     * @param array #config
     * @return string|array
     */
    public function daysDifferenceInTwoAdDate($fromDate, $toDate, $config = []);

    /**
     * Convert AD to BS.
     *
     * @param  string  $date
     * @param  array  $config
     * @return string|array
     */
    public function AD2BS($date, $config = []);

    /**
     * Convert BS to AD.
     *
     * @param  string  $date
     * @param  array  $config
     * @return string|array
     */
    public function BS2AD($date, $config = []);

    /**
     * get today BS date.
     *
     * @param  string  $calendarType
     * @return string
     */
    public function today($calendarType = 'BS');

    /**
     * get yesterday BS date.
     *
     * @param  string  $calendarType
     * @return string
     */
    public function yesterday($calendarType = 'BS');

    /**
     * get tomorrow BS date.
     *
     * @param  string  $calendarType
     * @return string
     */
    public function tomorrow($calendarType = 'BS');

    /**
     * check is BS date exists in calendar
     * Note: It support between date range.
     *
     * @param  string  $date
     * @param  array  $config
     * @return bool
     */
    public function bsDateExists($date, $config = []);

    /**
     * check is AD date exists in calendar
     * Note: It support between date range.
     *
     * @param  string  $date
     * @param  array  $config
     * @return bool
     */
    public function adDateExists($date, $config = []);
}
