<?php

namespace MilanTarami\NepaliCalendar;

use MilanTarami\NepaliCalendar\CalendarFunction;
use MilanTarami\NepaliCalendar\Traits\setCalendarConfig;
use MilanTarami\NepaliCalendar\Contracts\NepaliCalendarInterface;

class NepaliCalendar implements NepaliCalendarInterface
{
    use setCalendarConfig;

    protected $dateFormat;
    protected $returnType;
    protected $lang;
    protected $dateSeperator;

    public function __construct()
    {
        date_default_timezone_set('Asia/Kathmandu');
        $this->setIntitalConfig();
    }

    /**
     * Add days to BS Date
     * @param string $date
     * @param int $days
     * @param array #config
     * @return date
    */
    public function addDaysToBsDate($date, $days, $config = [])
    {
        $this->setUserConfig($config);
        $dateAd = CalendarFunction::bsToAd($date, $this->dateFormat, $this->dateSeperator)['AD_DATE'];
        list($year, $month, $date) = CalendarFunction::getDateInArray($dateAd, $this->dateFormat, $this->dateSeperator);
        $dateAd = CalendarFunction::dateResponseInFormat($year, $month, $date, 'YYYY-MM-DD', '-');
        $newDateAd = date('Y-m-d', strtotime($dateAd . '+' . $days . ' days'));
        $newDateBs = CalendarFunction::adToBs($newDateAd, 'YYYY-MM-DD', '-')['BS_DATE'];
        list($year, $month, $date) = CalendarFunction::getDateInArray($newDateBs, 'YYYY-MM-DD', '-');
        return CalendarFunction::dateResponseInFormat($year, $month, $date, $this->dateFormat, $this->dateSeperator);
    }

    /**
     * remove days from BS Date
     * @param string $date
     * @param int $days
     * @param array #config
     * @return string|array
    */
    public function removeDaysToBsDate($date, $days, $config = [])
    {
        $this->setUserConfig($config);
        $dateAd = CalendarFunction::bsToAd($date, $this->dateFormat, $this->dateSeperator)['AD_DATE'];
        list($year, $month, $date) = CalendarFunction::getDateInArray($dateAd, $this->dateFormat, $this->dateSeperator);
        $dateAd = CalendarFunction::dateResponseInFormat($year, $month, $date, 'YYYY-MM-DD', '-');
        $newDateAd = date('Y-m-d', strtotime($dateAd . '-' . $days . ' days'));
        $newDateBs = CalendarFunction::adToBs($newDateAd, 'YYYY-MM-DD', '-')['BS_DATE'];
        list($year, $month, $date) = CalendarFunction::getDateInArray($newDateBs, 'YYYY-MM-DD', '-');
        return CalendarFunction::dateResponseInFormat($year, $month, $date, $this->dateFormat, $this->dateSeperator);
    }

    /**
     * Add months to BS Date
     * @param string $date
     * @param int $days
     * @param array #config
     * @return string
    */
    public function addMonthsToBsDate($date, $months, $config = [])
    {
        $this->setUserConfig($config);
        if (CalendarFunction::isValidBsDate($date, $this->dateFormat, $this->dateSeperator)) {
            list($cYear, $cMonth, $cDate) = CalendarFunction::getDateInArray($date, $this->dateFormat, $this->dateSeperator);
            $cYearMonthData = CalendarFunction::getBsYearMonthData($cYear);
            $totalMonths = ($cYear * 12) + $cMonth + $months;
            $rYear = (int)($totalMonths / 12);
            $rMonth = ($totalMonths % 12) == 0 ? 12 : ($totalMonths % 12);
            $resBsYearMonthData = CalendarFunction::getBsYearMonthData($rYear);
            if ($cDate > $resBsYearMonthData[$rMonth]) {
                $rDate = $resBsYearMonthData[$rMonth];
            } else {
                $rDate = $cDate;
            }
            return CalendarFunction::dateResponseInFormat($rYear, $rMonth, $rDate, $this->dateFormat, $this->dateSeperator);
        }
    }

    /**
     * Add months to BS Date
     * @param string $date
     * @param int $days
     * @param array #config
     * @return string
    */
    public function removeMonthsToBsDate($date, $months, $config = [])
    {
        $this->setUserConfig($config);
        if (CalendarFunction::isValidBsDate($date, $this->dateFormat, $this->dateSeperator)) {
            list($cYear, $cMonth, $cDate) = CalendarFunction::getDateInArray($date, $this->dateFormat, $this->dateSeperator);
            $cYearMonthData = CalendarFunction::getBsYearMonthData($cYear);
            $totalMonths = ($cYear * 12) + $cMonth - $months;
            $rYear = (int)($totalMonths / 12);
            $rMonth = ($totalMonths % 12) == 0 ? 12 : ($totalMonths % 12);
            $resBsYearMonthData = CalendarFunction::getBsYearMonthData($rYear);
            if ($cDate > $resBsYearMonthData[$rMonth]) {
                $rDate = $resBsYearMonthData[$rMonth];
            } else {
                $rDate = $cDate;
            }
            return CalendarFunction::dateResponseInFormat($rYear, $rMonth, $rDate, $this->dateFormat, $this->dateSeperator);
        }
    }

    /**
     * days difference in two bs days
     * @param string $date
     * @param int $days
     * @param array #config
     * @return string|array
    */
    public function daysDifferenceInTwoBsDate($fromDate, $toDate, $config = [])
    {
        $this->setUserConfig($config);
        list($fYear, $fMonth, $fDate) = CalendarFunction::getDateInArray($fromDate, $this->dateFormat, $this->dateSeperator);
        list($tYear, $tMonth, $tDate) = CalendarFunction::getDateInArray($toDate, $this->dateFormat, $this->dateSeperator);
        $fromDateBs = CalendarFunction::dateResponseInFormat($fYear, $fMonth, $fDate, 'YYYY-MM-DD', '-');
        $toDateBs = CalendarFunction::dateResponseInFormat($tYear, $tMonth, $tDate, 'YYYY-MM-DD', '-');
        $fromDateAd = CalendarFunction::bsToAd($fromDateBs, 'YYYY-MM-DD', '-')['AD_DATE'];
        $toDateAd = CalendarFunction::bsToAd($toDateBs, 'YYYY-MM-DD', '-')['AD_DATE'];
        $daysDifference = (strtotime($toDateAd) - strtotime($fromDateAd)) / 60 / 60 / 24;
        return $daysDifference;
    }


    /**
     * days difference in two ad days
     * @param string $date
     * @param int $days
     * @param array #config
     * @return string|array
    */
    public function daysDifferenceInTwoAdDate($fromDate, $toDate, $config = [])
    {
        $this->setUserConfig($config);
        list($fYear, $fMonth, $fDate) = CalendarFunction::getDateInArray($fromDate, $this->dateFormat, $this->dateSeperator);
        list($tYear, $tMonth, $tDate) = CalendarFunction::getDateInArray($toDate, $this->dateFormat, $this->dateSeperator);
        $fromDateAd = CalendarFunction::dateResponseInFormat($fYear, $fMonth, $fDate, 'YYYY-MM-DD', '-');
        $toDateAd = CalendarFunction::dateResponseInFormat($tYear, $tMonth, $tDate, 'YYYY-MM-DD', '-');
        $daysDifference = (strtotime($toDateAd) - strtotime($fromDateAd)) / 60 / 60 / 24;
        return $daysDifference;
    }

    /**
     * Convert BS to AD
     * @param string $date
     * @param array $config
     * @return string|array
    */
    public function BS2AD($date, $config = [])
    {
        $this->setUserConfig($config);
        $data = CalendarFunction::bsToAd($date, $this->dateFormat, $this->dateSeperator);
        return $this->returnType === 'array' ? $data : $data['AD_DATE'];
    }

    /**
     * Convert AD to BS
     * @param string $date
     * @param array $config
     * @return string|array
    */
    public function AD2BS($date, $config = [])
    {
        $this->setUserConfig($config);
        $data = CalendarFunction::adToBs($date, $this->dateFormat, $this->dateSeperator);
        return $this->returnType === 'array' ? $data : $data['BS_DATE'];
    }

    /**
     * get today BS date
     * @param string $calendarType
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
     * get yesterday BS date
     * @param string $calendarType
     * @return string
    */
    public function yesterday($calendarType = 'BS')
    {
        $this->calendarType($calendarType);
        $adDate = date('Y-m-d');
        $output = date('Y-m-d', strtotime($adDate . ' - 1 days'));
        if ($calendarType == 'BS') {
            $output = $this->AD2BS($output);
        }
        return $output;
    }

    /**
     * get tomorrow BS date
     * @param string $calendarType
     * @return string
    */
    public function tomorrow($calendarType = 'BS')
    {
        $this->calendarType($calendarType);
        $adDate = date('Y-m-d');
        $output = date('Y-m-d', strtotime($adDate . ' + 1 days'));
        if ($calendarType == 'BS') {
            $output = $this->AD2BS($output);
        }
        return $output;
    }
}
