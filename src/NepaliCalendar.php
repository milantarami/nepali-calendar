<?php

namespace MilanTarami\NepaliCalendar;

use MilanTarami\NepaliCalendar\Contracts\NepaliCalendarInterface;
use MilanTarami\NepaliCalendar\Exceptions\NepaliCalendarException;
use MilanTarami\NepaliCalendar\Traits\setCalendarConfig;

class NepaliCalendar implements NepaliCalendarInterface
{
    use setCalendarConfig;

    protected $dateFormat;
    protected $returnType;
    protected $lang;
    protected $dateSeparator;

    public function __construct()
    {
        date_default_timezone_set('Asia/Kathmandu');
        $this->setInitialConfig();
    }

    /**
     * Add days to BS Date.
     *
     * @param  string  $date
     * @param  int  $days
     * @param array #config
     * @return string
     */
    public function addDaysToBsDate($date, $days, $config = [])
    {
        $this->setUserConfig($config);
        $dateAd = CalendarFunction::bsToAd($date, $this->dateFormat, $this->dateSeparator)['AD_DATE'];
        [$year, $month, $date] = CalendarFunction::getDateInArray($dateAd, $this->dateFormat, $this->dateSeparator);
        $dateAd = CalendarFunction::dateResponseInFormat($year, $month, $date, 'YYYY-MM-DD', '-');
        $newDateAd = date('Y-m-d', strtotime($dateAd.'+'.$days.' days'));
        $newDateBs = CalendarFunction::adToBs($newDateAd, 'YYYY-MM-DD', '-')['BS_DATE'];
        [$year, $month, $date] = CalendarFunction::getDateInArray($newDateBs, 'YYYY-MM-DD', '-');

        return CalendarFunction::dateResponseInFormat($year, $month, $date, $this->dateFormat, $this->dateSeparator);
    }

    /**
     * remove days from BS Date.
     *
     * @param  string  $date
     * @param  int  $days
     * @param array #config
     * @return string|array
     */
    public function removeDaysFromBsDate($date, $days, $config = [])
    {
        $this->setUserConfig($config);
        $dateAd = CalendarFunction::bsToAd($date, $this->dateFormat, $this->dateSeparator)['AD_DATE'];
        [$year, $month, $date] = CalendarFunction::getDateInArray($dateAd, $this->dateFormat, $this->dateSeparator);
        $dateAd = CalendarFunction::dateResponseInFormat($year, $month, $date, 'YYYY-MM-DD', '-');
        $newDateAd = date('Y-m-d', strtotime($dateAd.'-'.$days.' days'));
        $newDateBs = CalendarFunction::adToBs($newDateAd, 'YYYY-MM-DD', '-')['BS_DATE'];
        [$year, $month, $date] = CalendarFunction::getDateInArray($newDateBs, 'YYYY-MM-DD', '-');

        return CalendarFunction::dateResponseInFormat($year, $month, $date, $this->dateFormat, $this->dateSeparator);
    }

    /**
     * Add months to BS Date.
     *
     * @param  string  $date
     * @param  int  $days
     * @param array #config
     * @return string
     */
    public function addMonthsToBsDate($date, $months, $config = [])
    {
        $this->setUserConfig($config);
        if (CalendarFunction::isValidBsDate($date, $this->dateFormat, $this->dateSeparator)) {
            [$cYear, $cMonth, $cDate] = CalendarFunction::getDateInArray($date, $this->dateFormat, $this->dateSeparator);
            $cYearMonthData = CalendarFunction::getBsYearMonthData($cYear);
            $totalMonths = ($cYear * 12) + $cMonth + $months;
            $rYear = (int) ($totalMonths / 12);
            $rMonth = ($totalMonths % 12) == 0 ? 12 : ($totalMonths % 12);
            $resBsYearMonthData = CalendarFunction::getBsYearMonthData($rYear);
            if ($cDate > $resBsYearMonthData[$rMonth]) {
                $rDate = $resBsYearMonthData[$rMonth];
            } else {
                $rDate = $cDate;
            }

            return CalendarFunction::dateResponseInFormat($rYear, $rMonth, $rDate, $this->dateFormat, $this->dateSeparator);
        }
    }

    /**
     * Add months to BS Date.
     *
     * @param  string  $date
     * @param  int  $days
     * @param array #config
     * @return string
     */
    public function removeMonthsFromBsDate($date, $months, $config = [])
    {
        $this->setUserConfig($config);
        if (CalendarFunction::isValidBsDate($date, $this->dateFormat, $this->dateSeparator)) {
            [$cYear, $cMonth, $cDate] = CalendarFunction::getDateInArray($date, $this->dateFormat, $this->dateSeparator);
            $cYearMonthData = CalendarFunction::getBsYearMonthData($cYear);
            $totalMonths = ($cYear * 12) + $cMonth - $months;
            $rYear = (int) ($totalMonths / 12);
            $rMonth = ($totalMonths % 12) == 0 ? 12 : ($totalMonths % 12);
            $resBsYearMonthData = CalendarFunction::getBsYearMonthData($rYear);
            if ($cDate > $resBsYearMonthData[$rMonth]) {
                $rDate = $resBsYearMonthData[$rMonth];
            } else {
                $rDate = $cDate;
            }

            return CalendarFunction::dateResponseInFormat($rYear, $rMonth, $rDate, $this->dateFormat, $this->dateSeparator);
        }
    }

    /**
     * days difference in two bs days.
     *
     * @param  string  $fromDate
     * @param  string  $toDate
     * @param  array  $config
     * @return string|array
     */
    public function daysDifferenceInTwoBsDate($fromDate, $toDate, $config = [])
    {
        $this->setUserConfig($config);
        [$fYear, $fMonth, $fDate] = CalendarFunction::getDateInArray($fromDate, $this->dateFormat, $this->dateSeparator);
        [$tYear, $tMonth, $tDate] = CalendarFunction::getDateInArray($toDate, $this->dateFormat, $this->dateSeparator);
        $fromDateBs = CalendarFunction::dateResponseInFormat($fYear, $fMonth, $fDate, 'YYYY-MM-DD', '-');
        $toDateBs = CalendarFunction::dateResponseInFormat($tYear, $tMonth, $tDate, 'YYYY-MM-DD', '-');
        $fromDateAd = CalendarFunction::bsToAd($fromDateBs, 'YYYY-MM-DD', '-')['AD_DATE'];
        $toDateAd = CalendarFunction::bsToAd($toDateBs, 'YYYY-MM-DD', '-')['AD_DATE'];
        $daysDifference = (strtotime($toDateAd) - strtotime($fromDateAd)) / 60 / 60 / 24;

        return $daysDifference;
    }

    /**
     * days difference in two ad days.
     *
     * @param  string  $date
     * @param  int  $days
     * @param array #config
     * @return string|array
     */
    public function daysDifferenceInTwoAdDate($fromDate, $toDate, $config = [])
    {
        $this->setUserConfig($config);
        [$fYear, $fMonth, $fDate] = CalendarFunction::getDateInArray($fromDate, $this->dateFormat, $this->dateSeparator);
        [$tYear, $tMonth, $tDate] = CalendarFunction::getDateInArray($toDate, $this->dateFormat, $this->dateSeparator);
        $fromDateAd = CalendarFunction::dateResponseInFormat($fYear, $fMonth, $fDate, 'YYYY-MM-DD', '-');
        $toDateAd = CalendarFunction::dateResponseInFormat($tYear, $tMonth, $tDate, 'YYYY-MM-DD', '-');
        $daysDifference = (strtotime($toDateAd) - strtotime($fromDateAd)) / 60 / 60 / 24;

        return $daysDifference;
    }

    /**
     * Convert BS to AD.
     *
     * @param  string  $date
     * @param  array  $config
     * @return string|array
     */
    public function BS2AD($date, $config = [])
    {
        $this->setUserConfig($config);
        $data = CalendarFunction::bsToAd($date, $this->dateFormat, $this->dateSeparator);

        return $this->returnType === 'array' ? $data : $data['AD_DATE'];
    }

    /**
     * Convert AD to BS.
     *
     * @param  string  $date
     * @param  array  $config
     * @return string|array
     */
    public function AD2BS($date, $config = [])
    {
        $this->setUserConfig($config);
        $data = CalendarFunction::adToBs($date, $this->dateFormat, $this->dateSeparator);
        if ($this->lang === 'np') {
            $data['BS_DATE'] = CalendarFunction::enToNp($data['BS_DATE']);
        }

        return $this->returnType === 'array' ? $data : $data['BS_DATE'];
    }

    /**
     * get today BS date.
     *
     * @param  string  $calendarType
     * @return string
     */
    public function today($calendarType = 'BS')
    {
        $this->calendarType($calendarType);
        $output = date('Y-m-d');
        if ($calendarType == 'BS') {
            $output = $this->AD2BS($output);
        }

        return $output;
    }

    /**
     * get yesterday BS date.
     *
     * @param  string  $calendarType
     * @return string
     */
    public function yesterday($calendarType = 'BS')
    {
        $this->calendarType($calendarType);
        $adDate = date('Y-m-d');
        $output = date('Y-m-d', strtotime($adDate.' - 1 days'));
        if ($calendarType == 'BS') {
            $output = $this->AD2BS($output);
        }

        return $output;
    }

    /**
     * get tomorrow BS date.
     *
     * @param  string  $calendarType
     * @return string
     */
    public function tomorrow($calendarType = 'BS')
    {
        $this->calendarType($calendarType);
        $adDate = date('Y-m-d');
        $output = date('Y-m-d', strtotime($adDate.' + 1 days'));
        if ($calendarType == 'BS') {
            $output = $this->AD2BS($output);
        }

        return $output;
    }

    /**
     * check is BS date exists in calendar
     * Note: It support between date range.
     *
     * @param  string  $date
     * @param  array  $config
     * @return bool
     */
    public function bsDateExists($date, $config = [])
    {
        $this->setUserConfig($config);

        return CalendarFunction::isValidBsDate($date, $this->dateFormat, $this->dateSeparator);
    }

    /**
     * check is AD date exists in calendar
     * Note: It support between date range.
     *
     * @param  string  $date
     * @param  array  $config
     * @return bool
     */
    public function adDateExists($date, $config = [])
    {
        $this->setUserConfig($config);

        return CalendarFunction::isValidAdDate($date, $this->dateFormat, $this->dateSeparator);
    }

    /**
     * Count days fromDateBS to toDateBS including (fromDate day ) and (toDate day).
     *
     * @param  string  $fromDate
     * @param  string  $toDate
     * @return int
     */
    public function daysCountBetweenIncludingBsDates(string $fromDate, string $toDate, array $config = []): int
    {
        $this->setUserConfig($config);
        $daysCount = $this->daysDifferenceInTwoBsDate($fromDate, $toDate);
        if ($daysCount >= 0) {
            return $daysCount + 1;
        }
        throw new NepaliCalendarException('From Date must be less than To Date');
    }

    /**
     * compare BS dates.
     *
     * @param  string  $date1
     * @param  string  $comparisonOperator
     * @param  string  $date2
     * @param  array  $config  ( optional )
     * @return bool
     */
    public function compareBsDates(string $date1, string $comparisonOperator, string $date2, array $config = []): bool
    {
        $this->setUserConfig($config);
        $date1 = $this->BS2AD($date1);
        $date2 = $this->BS2AD($date2);

        return CalendarFunction::compareAdDates($date1, $date2, $comparisonOperator);
    }

    /**
     * get bs month end dates
     * ['start_date_of_month' => , 'end_date_of_month' =>  ].
     */
    public function bsMonthStartEndDates(int $mm = null, int $yyyy = null): array
    {
        return CalendarFunction::getBsMonthStartEndDates($mm, $yyyy);
    }
}
