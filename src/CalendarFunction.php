<?php

namespace MilanTarami\NepaliCalendar;

use Exception;
use MilanTarami\NepaliCalendar\DataProvider\AD;
use MilanTarami\NepaliCalendar\DataProvider\BS;
use MilanTarami\NepaliCalendar\Exceptions\NepaliCalendarException;

class CalendarFunction
{
    const MIN_AD_YEAR = 1944;
    const MAX_AD_YEAR = 2042;
    const MIN_BS_YEAR = 2000;
    const MAX_BS_YEAR = 2099;

    /**
     * Get a date in array format.
     *
     * @param  string  $date
     * @param  string  $dateFormat
     * @param  string  $dateSeperator
     * @return array ['YYYY', 'MM', 'DD']
     */
    public static function getDateInArray($date, $dateFormat, $dateSeperator)
    {
        $dateSegregated = explode($dateSeperator, $date);
        $dateFormatSegregated = explode($dateSeperator, $dateFormat);
        $dateInArray = [
            $dateFormatSegregated[0] => (int) $dateSegregated[0],
            $dateFormatSegregated[1] => (int) $dateSegregated[1],
            $dateFormatSegregated[2] => (int) $dateSegregated[2]
        ];

        return [$dateInArray['YYYY'], $dateInArray['MM'], $dateInArray['DD']];
    }

    /**
     * get a date in given format.
     *
     * @param  int  $YYYY
     * @param  int  $MM
     * @param  int  $DD
     * @param  string  $dateFormat
     * @param  string  $dateSeperator
     * @return string
     */
    public static function dateResponseInFormat($YYYY, $MM, $DD, $dateFormat, $dateSeperator)
    {
        $dateInArray = [
            'YYYY' => $YYYY,
            'MM' => self::padZero($MM),
            'DD' => self::padZero($DD)
        ];
        $dateFormatSegregated = explode($dateSeperator, $dateFormat);

        return $dateInArray[$dateFormatSegregated[0]].$dateSeperator.
            $dateInArray[$dateFormatSegregated[1]].$dateSeperator.
            $dateInArray[$dateFormatSegregated[2]];
    }

    /**
     * pad zero before number if less than 10.
     *
     * @param  int  $number
     * @return string
     */
    private static function padZero($number)
    {
        if ($number < 10) {
            return (string) str_pad($number, 2, '0', STR_PAD_LEFT);
        }

        return (string) $number;
    }

    /**
     * get BS year month data
     * if ($returnType = NULL) than if bs year month data doesn't exists than it will return NULL.
     *
     * @param  int  $year
     * @param null
     * @return array
     */
    public static function getBsYearMonthData($year)
    {
        if ($year >= self::MIN_BS_YEAR && $year <= self::MAX_BS_YEAR) {
            foreach (BS::MONTH_DATA_FOR_YEAR as $key => $array) {
                if ($array[0] == $year) {
                    return $array;
                }
            }
        }

        return null;
    }

    /**
     * check is bs date is valid.
     *
     * @param  date  $bsDate
     * @param  string  $dateFormat
     * @param  string  $dateSeperator
     */
    public static function isValidBsDate($date, $dateFormat, $dateSeperator): bool
    {
        if (count(explode($dateSeperator, $date)) === 3) {
            [$yyyy, $mm, $dd] = self::getDateInArray($date, $dateFormat, $dateSeperator);
            $bsYearData = self::getBsYearMonthData($yyyy);
            if ($bsYearData !== null) {
                if ($mm > 0 && $mm < 13 && $dd > 0) {
                    if ($dd <= $bsYearData[$mm]) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * check is ad date is valid.
     *
     * @param  date  $bsDate
     * @param  string  $dateFormat
     * @param  string  $dateSeperator
     */
    public static function isValidAdDate($date, $dateFormat, $dateSeperator)
    {
        if (count(explode($dateSeperator, $date)) === 3) {
            [$yyyy, $mm, $dd] = self::getDateInArray($date, $dateFormat, $dateSeperator);
            if ($yyyy >= self::MIN_AD_YEAR && $yyyy <= self::MAX_AD_YEAR) {
                if ($mm > 0 && $mm < 13 && $dd > 0) {
                    if (self::isAdYearLeapYear($yyyy)) {
                        $monthMaxDateCount = AD::AD_MONTHS['leap_year'][$mm];
                    } else {
                        $monthMaxDateCount = AD::AD_MONTHS['year'][$mm];
                    }
                    if ($dd <= $monthMaxDateCount) {
                        return true;
                    }
                }
            }
        }

        return false;
    }

    /**
     * Check if date is with in nepali data range.
     *
     * @param  int  $yy
     * @param  int  $mm
     * @param  int  $dd
     * @return bool
     */
    private static function isBsDateIsInRange($yy, $mm, $dd)
    {
        if ($yy < self::MIN_BS_YEAR || $yy > self::MAX_BS_YEAR) {
            throw new NepaliCalendarException(sprintf(CalendarMessage::E_UNSUPPORTED_BS_YEAR_RANGE, self::MIN_BS_YEAR, self::MAX_BS_YEAR));
        }

        if ($mm < 1 || $mm > 12) {
            throw new NepaliCalendarException(CalendarMessage::E_BAD_MONTH_VALUE);
        }

        if ($dd < 1 || $dd > 32) {
            throw new NepaliCalendarException(CalendarMessage::E_BS_BAD_DAY_VALUE);
        }

        return true;
    }

    /**
     * Check if date range is in english.
     *
     * @param  int  $yy
     * @param  int  $mm
     * @param  int  $dd
     * @return bool
     */
    private static function isAdDateInRange($yy, $mm, $dd)
    {
        if ($yy < self::MIN_AD_YEAR || $yy > self::MAX_AD_YEAR) {
            throw new NepaliCalendarException(sprintf(CalendarMessage::E_UNSUPPORTED_AD_YEAR_RANGE, self::MIN_AD_YEAR, self::MAX_AD_YEAR));
        }

        if ($mm < 1 || $mm > 12) {
            throw new NepaliCalendarException(CalendarMessage::E_BAD_MONTH_VALUE);
        }

        if ($dd < 1 || $dd > 31) {
            throw new NepaliCalendarException(CalendarMessage::E_AD_BAD_DAY_VALUE);
        }

        return true;
    }

    /**
     * Check whether AD Year is Leap Year.
     *
     * @param  int  $year
     * @return bool
     */
    private static function isAdYearLeapYear($year): bool
    {
        if ($year % 100 == 0) {
            if ($year % 400 == 0) {
                return true;
            } else {
                return false;
            }
        } else {
            if ($year % 4 == 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    /**
     * currently can only calculate the date between AD 1944-2033...
     *
     * @param  string  $adDate
     * @param  string  $dateFormat
     * @param  string  $dateSeperator
     * @return array
     */
    public static function adToBs($adDate, $dateFormat, $dateSeperator)
    {
        [$yy, $mm, $dd] = self::getDateInArray($adDate, $dateFormat, $dateSeperator);

        if (self::isAdDateInRange($yy, $mm, $dd)) {
            // Month data.
            $month = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

            // Month for leap year
            $lmonth = [31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

            $def_eyy = 1944;    // initial english date.
            $def_nyy = 2000;
            $def_nmm = 9;
            $def_ndd = 17 - 1;    // inital nepali date.
            $total_eDays = 0;
            $total_nDays = 0;
            $a = 0;
            $day = 7 - 1;
            $m = 0;
            $y = 0;
            $i = 0;
            $j = 0;
            $numDay = 0;

            // Count total no. of days in-terms year
            for ($i = 0; $i < ($yy - $def_eyy); $i++) { //total days for month calculation...(english)
                if (self::isAdYearLeapYear($def_eyy + $i) === true) {
                    for ($j = 0; $j < 12; $j++) {
                        $total_eDays += $lmonth[$j];
                    }
                } else {
                    for ($j = 0; $j < 12; $j++) {
                        $total_eDays += $month[$j];
                    }
                }
            }

            // Count total no. of days in-terms of month
            for ($i = 0; $i < ($mm - 1); $i++) {
                if (self::isAdYearLeapYear($yy) === true) {
                    $total_eDays += $lmonth[$i];
                } else {
                    $total_eDays += $month[$i];
                }
            }

            // Count total no. of days in-terms of date
            $total_eDays += $dd;

            $i = 0;
            $j = $def_nmm;
            $total_nDays = $def_ndd;
            $m = $def_nmm;
            $y = $def_nyy;

            // Count nepali date from array
            while ($total_eDays != 0) {
                $a = BS::MONTH_DATA_FOR_YEAR[$i][$j];

                $total_nDays++;        //count the days
                $day++;                //count the days interms of 7 days

                if ($total_nDays > $a) {
                    $m++;
                    $total_nDays = 1;
                    $j++;
                }

                if ($day > 7) {
                    $day = 1;
                }

                if ($m > 12) {
                    $y++;
                    $m = 1;
                }

                if ($j > 12) {
                    $j = 1;
                    $i++;
                }

                $total_eDays--;
            }

            $numDay = $day;

            $_nep_date['BS_DATE'] = self::dateResponseInFormat($y, $m, $total_nDays, $dateFormat, $dateSeperator);
            $_nep_date['YYYY'] = $y;
            $_nep_date['MM'] = $m;
            $_nep_date['DD'] = $total_nDays;
            $_nep_date['month']['np']['long'] = BS::getMonthNameInNepali($m, 'LONG');
            $_nep_date['month']['np']['abbr'] = BS::getMonthNameInNepali($m, 'ABBREVIATED');
            $_nep_date['month']['roman']['long'] = BS::getMonthNameInRoman($m, 'LONG');
            $_nep_date['month']['roman']['abbr'] = BS::getMonthNameInRoman($m, 'ABBREVIATED');
            $_nep_date['week_day']['np']['long'] = BS::getDayNameOfWeekInNepali($day, 'LONG');
            $_nep_date['week_day']['np']['abbr'] = BS::getDayNameOfWeekInNepali($day, 'ABBREVIATED');
            $_nep_date['week_day']['roman']['long'] = BS::getDayNameOfWeekInRoman($day, 'LONG');
            $_nep_date['week_day']['roman']['abbr'] = BS::getDayNameOfWeekInRoman($day, 'ABBREVIATED');
            $_nep_date['week_day']['en']['long'] = BS::getDayNameOfWeekInEnglish($day, 'LONG');
            $_nep_date['week_day']['en']['abbr'] = BS::getDayNameOfWeekInEnglish($day, 'ABBREVIATED');

            return $_nep_date;
        }
    }

    /**
     * Currently can only calculate the date between BS 2000-2089.
     *
     * @param  string  $bsDate
     * @param  string  $dateFormat
     * @param  string  $dateSeperator
     * @return array
     */
    public static function bsToAd($bsDate, $dateFormat, $dateSeperator)
    {
        [$yy, $mm, $dd] = self::getDateInArray($bsDate, $dateFormat, $dateSeperator);

        $def_eyy = 1943;
        $def_emm = 4;
        $def_edd = 14 - 1;    // initial english date.
        $def_nyy = 2000;
        $def_nmm = 1;
        $def_ndd = 1;        // iniital equivalent nepali date.
        $total_eDays = 0;
        $total_nDays = 0;
        $a = 0;
        $day = 4 - 1;
        $m = 0;
        $y = 0;
        $i = 0;
        $k = 0;
        $numDay = 0;

        $month = [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        $lmonth = [0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

        if (self::isBsDateIsInRange($yy, $mm, $dd)) {
            // Count total days in-terms of year
            for ($i = 0; $i < ($yy - $def_nyy); $i++) {
                for ($j = 1; $j <= 12; $j++) {
                    $total_nDays += BS::MONTH_DATA_FOR_YEAR[$k][$j];
                }
                $k++;
            }

            // Count total days in-terms of month
            for ($j = 1; $j < $mm; $j++) {
                $total_nDays += BS::MONTH_DATA_FOR_YEAR[$k][$j];
            }

            // Count total days in-terms of dat
            $total_nDays += $dd;

            // Calculation of equivalent english date...
            $total_eDays = $def_edd;
            $m = $def_emm;
            $y = $def_eyy;
            while ($total_nDays != 0) {
                if (self::isAdYearLeapYear($y)) {
                    $a = $lmonth[$m];
                } else {
                    $a = $month[$m];
                }

                $total_eDays++;
                $day++;

                if ($total_eDays > $a) {
                    $m++;
                    $total_eDays = 1;
                    if ($m > 12) {
                        $y++;
                        $m = 1;
                    }
                }

                if ($day > 7) {
                    $day = 1;
                }

                $total_nDays--;
            }

            $numDay = $day;

            $_eng_date['AD_DATE'] = self::dateResponseInFormat($y, $m, $total_eDays, $dateFormat, $dateSeperator);
            $_eng_date['YYYY'] = $y;
            $_eng_date['MM'] = $m;
            $_eng_date['DD'] = $total_eDays;
            $_eng_date['day']['long'] = AD::getDayNameOfWeek($day, 'LONG');
            $_eng_date['day']['abbr'] = AD::getDayNameOfWeek($day, 'ABBREVIATED');
            $_eng_date['month']['long'] = AD::getMonthName($m, 'LONG');
            $_eng_date['month']['abbr'] = AD::getMonthName($m, 'ABBREVIATED');
            // $_eng_date['week_num_day'] = $numDay;

            return $_eng_date;
        }
    }

    public static function daysCountIncludingBsDates($fromDate, $toDate, $dateFormat, $dateSeperator)
    {
        // $daysDifference =
    }

    public static function compareAdDates($date1, $date2, $comparisonOperator)
    {
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        switch ($comparisonOperator) {
            case '==':
                return $time1 == $time2;
                break;
            case '===':
                return $time1 === $time2;
                break;
            case '>':
                return $time1 > $time2;
                break;
            case '<':
                return $time1 < $time2;
                break;
            case '>=':
                return $time1 >= $time2;
                break;
            case '<=':
                return $time1 <= $time2;
                break;
            case '!==':
                return $time1 !== $time2;
                break;
            case '<>':
                return $time1 !== $time2;
                break;
            default:
                throw new NepaliCalendarException('Comparison Operator not supported !');
        }
    }

    /**
     * get bs month start , end dates.
     */
    public static function getBsMonthStartEndDates(int $bsMonth = null, int $bsYear = null): array
    {
        $dateBsArr = self::getDateInArray(self::adToBs(date('Y-m-d'), 'YYYY-MM-DD', '-')['BS_DATE'], 'YYYY-MM-DD', '-');

        if (empty($bsMonth)) {
            $bsMonth = $dateBsArr[1];
        }

        if (empty($bsYear)) {
            $bsYear = $dateBsArr[0];
        }

        $monthData = self::getBsYearMonthData($bsYear);

        if (empty($monthData)) {
            throw new Exception('Date is not supported');
        }

        $maxDayInMonth = $monthData[$bsMonth];

        return [
            'start_date_of_month' => self::dateResponseInFormat($bsYear, $bsMonth, 1, 'YYYY-MM-DD', '-'),
            'end_date_of_month' => self::dateResponseInFormat($bsYear, $bsMonth, $maxDayInMonth, 'YYYY-MM-DD', '-')
        ];
    }

    /**
     * convert eng number to nepali number.
     *
     * @param  string  $string
     * @return string
     */
    public static function enToNp($string)
    {
        $replace_array = [
            '0' => '०',
            '1' => '१',
            '2' => '२',
            '3' => '३',
            '4' => '४',
            '5' => '५',
            '6' => '६',
            '7' => '७',
            '8' => '८',
            '9' => '९',
        ];

        $output_string = str_replace(array_keys($replace_array), array_values($replace_array), $string);

        return $output_string;
    }
}
