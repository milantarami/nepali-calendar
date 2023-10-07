<?php

namespace MilanTarami\NepaliCalendar\DataProvider;

class AD
{
    public const AD_MONTH_NAMES = [
        'LONG' => [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December'
        ],
        'ABBREVIATED' => [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Aug',
            9 => 'Sept',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dec'
        ]
    ];

    public const AD_DAY_NAMES_OF_WEEK = [
        'LONG' => [
            '1' => 'Sunday',
            '2' => 'Monday',
            '3' => 'Tuesday',
            '4' => 'Wednesday',
            '5' => 'Thursday',
            '6' => 'Friday',
            '7' => 'Saturday'
        ],
        'ABBREVIATED' => [
            '1' => 'Sun',
            '2' => 'Mon',
            '3' => 'Tue',
            '4' => 'Wed',
            '5' => 'Thu',
            '6' => 'Fri',
            '7' => 'Sat'
        ]
    ];

    public const AD_MONTHS = [
        'year'      => [0, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31],
        'leap_year' => [0, 31, 29, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31]
    ];

    /**
     * get a english month name.
     *
     * @param  int  $monthInNumber  [ 1 to 12 ]
     * @param  string  $type  [ LONG, ABBREVIATED ]
     * @return string
     */
    public static function getMonthName($monthInNumber, $type): string
    {
        return self::AD_MONTH_NAMES[$type][$monthInNumber];
    }

    /**
     * get day neme of week.
     *
     * @param  int  $weekDayInNumber  [ 1 to 7 ]
     * @param  string  $type  [ LONG, ABBREVIATED ]
     * @return string
     */
    public static function getDayNameOfWeek($weekDayInNumber, $type): string
    {
        return self::AD_DAY_NAMES_OF_WEEK[$type][$weekDayInNumber];
    }
}
