# Nepali Calendar

This repository contains a rewrite of <a href="https://github.com/amant/Nepali-Date-Convert/blob/master/php/nepali_calendar.php">Nepali_Calendar.php</a> by Aman Tuladhar, which is a DateConverter. And this package designed to give more features and code sharing via the composer ( a dependency manager for PHP). Check out the features added.

# Installation & Configuration

You can install this package via composer using:

```bash
composer require milantarami/nepali-calendar
```

The package will automatically register its service provider for laravel 5.5.\* and above. <br>
For below version need to register a service provider manually in <code>config/app.php</code>

```php
'providers' => [

    /*
    * Package Service Providers...
    */

   MilanTarami\NepaliCalendar\NepaliCalendarServiceProvider::class

],
```

The package will automatically load alias for laravel 5.5.\* and above. <br>
For below version need to add alias manually in <code>config/app.php</code>

```php
'aliases' => [
    .
    .
    'NepaliCalendar' => MilanTarami\NepaliCalendar\Facades\NepaliCalendar::class,

]
```

To publish the config file to <code>config/nepali-calendar.php</code> run:

```bash
php artisan vendor:publish --tag=nepali-calendar-config
```

This is the default contents of the configuration:

```php
<?php

  return [

    /**
     * DEFAULT date format
    */
    'date_format' => 'YYYY-MM-DD',

    /**
     * DEFAULT return type
     * return types
     * [ date, string, array ]
    */
    'return_type' => 'string',

    /**
     * DEFAULT lang
    */
    'lang' => 'np',

    /**
     * Supported date formats
    */
    'date_formats' => [
        'YYYY-MM-DD',
        'MM-DD-YYYY',
        'DD-MM-YYYY',
        'YYYY/MM/DD',
        'MM/DD/YYYY',
        'DD/MM/YYYY'
    ],

    /**
     * Date Seperators
    */
    'date_seperators' => [
        'YYYY-MM-DD' => '-',
        'MM-DD-YYYY' => '-',
        'DD-MM-YYYY' => '-',
        'YYYY/MM/DD' => '/',
        'MM/DD/YYYY' => '/',
        'DD/MM/YYYY' => '/'
    ],

    /**
     * Supported Languages
    */
    'langs' => [
        'np',
        'en'
    ],

    /**
     * Supported return types
    */
    'return_types' => [
        'array',
        'string'
    ],

    /**
     * Calendar Types
    */
    'calendar_types' => [
        'BS',
        'AD'
    ]

  ];

```

# Changelog

All changes to <strong><a href="https://github.com/milantarami/nepali-calendar">nepali-calendar</a></strong> are documented <a href="https://github.com/milantarami/nepali-calendar/blob/master/CHANGELOG.md">to this file on Github</a>

# Basic Usage

## ✔ Basic Usage

Convert AD to BS

```php
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

$bsDate = NepaliCalendar::AD2BS('2023-11-05');

// output: 2080-07-19
```

Convert BS to AD

```php
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

$adDate = NepaliCalendar::BS2AD('2080-07-20');

// output: 2023-11-06
```

<strong>Note :</strong> <i>The default date format is</i> <mark>YYYY-MM-DD</mark> <i> if your date format differ than you need to provide a date format</i>
</i>

```php
$adDate = NepaliCalendar::BS2AD('19-07-2080', [
    'date_format' => 'DD-MM-YYYY',
]);

// output: 05-11-2023
```

## More Examples

### Example 1

```php
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

$date = NepaliCalendar::AD2BS('2023-12-26', [
    'lang' => 'np'
]);

// output: २०८०-०९-१०
```

### Example 2

```php
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

$date = NepaliCalendar::AD2BS('2023-12-26', [
        'lang' => 'np',
        'return_type' => 'array'
]);

// output
[
  "BS_DATE" => "२०८०-०९-१०",
  "YYYY" => 2080,
  "MM" => 9,
  "DD" => 10,
  "month" =>  [
    "np" =>  [
      "long" => "पुष",
      "abbr" => "पुष",
    ],
    "roman" =>  [
      "long" => "Poush",
      "abbr" => "Poush"
    ],
],
  "week_day" =>  [
    "np" =>  [
      "long" => "मगलवार",
      "abbr" => "मगल"
    ],
    "roman" =>  [
      "long" => "Mangalbar",
      "abbr" => "Mangal"
    ],
    "en" =>  [
      "long" => "Tuesday",
      "abbr" => "Tue"
    ]
  ]
]
```

### Example 3

```php

$date = NepaliCalendar::BS2AD('2080-12-26', [
    'lang' => 'en', // optional by default 'en'
    'return_type' => 'array'
]);

// output

[
  "AD_DATE" => "2024-04-08",
  "YYYY" => 2024,
  "MM" => 4,
  "DD" => 8,
  "day" => [
    "long" => "Monday",
    "abbr" => "Mon"
  ],
  "month" => [
    "long" => "April",
    "abbr" => "Apr"
  ]
]

```

# Configurations ( $config )

## ✔ Supported Date Formats

Only six date formats are currently supported as listed below. You need to pass the value as key value<br/><mark><b>'date_format' => 'YYYY/MM/DD'</b></mark> in optional param \$config = []

```
'YYYY-MM-DD',
'MM-DD-YYYY',
'DD-MM-YYYY',
'YYYY/MM/DD',
'MM/DD/YYYY',
'DD/MM/YYYY'
```

<strong>Note:</strong> default <i><b> date_format </b></i> is <i><b>'YYYY-MM-DD'</b></i>

## ✔ Supported Return Types

You need to pass the value as key value <mark><b>'return_type' => 'array'</b></mark> in optional param \$config = []

```
'string',
'array'
```

<strong>Note:</strong> default <i><b> return_type </b></i> is <i><b>string</b></i>

## ✔ Calendar Types

Supported calendar types is

```
'BS',
'AD'
```

<strong>Note:</strong> default <i><b> \$caledarType </b></i> is <i><b>BS</b></i>

# Available Methods

<table width="100">
    <thead>
        <tr>
            <th>Function</th>
            <th style="width: 250px;">Parameter</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>AD2BS()</td>
            <td>
                <li>@param <i>string</i> &nbsp;$date</li>
                <li>@param <i>array</i> &nbsp;$config</li>
                <li>@return <i>string</i>|<i>array</i> </li>
            </td>
            <td>
                Convert AD date to equivalent BS date
            </td>
        </tr>
        <tr>
            <td>BS2AD()</td>
            <td>
                <li>@param <i>string</i> &nbsp;$date</li>
                <li>@param <i>array</i> &nbsp;$config</li>
                <li>@return <i>string</i>|<i>array</i> </li>
            </td>
            <td>
                Convert BS date to equivalent AD date
            </td>
        </tr>
        <tr>
            <td>addMonthsToBsDate()</td>
            <td>
                <li>@param <i>string</i> &nbsp;$date</li>
                <li>@param <i>int</i> &nbsp;$months</li>
                <li>@param <i>array</i> &nbsp;$config</li>
                <li>@return <i>string</i></li>
            </td>
            <td>
               Add number of months to a given BS date
            </td>
        </tr>
                <tr>
            <td>removeMonthsFromBsDate()</td>
            <td>
                <li>@param <i>string</i> &nbsp;$date</li>
                <li>@param <i>int</i> &nbsp;$months</li>
                <li>@param <i>array</i> &nbsp;$config</li>
                <li>@return <i>string</i></li>
            </td>
            <td>
               Subtract number of months from a given BS date
            </td>
        </tr>
        <tr>
            <td>addDaysToBsDate()</td>
            <td>
                <li>@param <i>string</i> &nbsp;$date</li>
                <li>@param <i>int</i> &nbsp;$days</li>
                <li>@param <i>array</i> &nbsp;$config</li>
                <li>@return <i>string</i></li>
            </td>
            <td>
               Add number of days to given BS date
            </td>
        </tr>
        <tr>
            <td>removeDaysFromBsDate()</td>
            <td>
                <li>@param <i>string</i> &nbsp;$date</li>
                <li>@param <i>int</i> &nbsp;$days</li>
                <li>@param <i>array</i> &nbsp;$config</li>
                <li>@return <i>string</i></li>
            </td>
            <td>
               Subtract number of days from given BS date
            </td>
        </tr>
        <tr>
            <td>daysDifferenceInTwoBsDate()</td>
            <td>
                <li>@param <i>string</i> &nbsp;$fromDateBS</li>
                <li>@param <i>string</i> &nbsp;$toDateBS</li>
                <li>@param <i>array</i> &nbsp;$config</li>
                <li>@return <i>int</i></li>
            </td>
            <td>
               get days difference between two BS days
            </td>
        </tr>
        <tr>
            <td>daysDifferenceInTwoAdDate()</td>
            <td>
                <li>@param <i>string</i> &nbsp;$fromDateAD</li>
                <li>@param <i>string</i> &nbsp;$toDateAD</li>
                <li>@param <i>array</i> &nbsp;$config</li>
                <li>@return <i>int</i></li>
            </td>
            <td>
               get days difference between two AD days
            </td>
        </tr>
        <tr>
            <td>today()</td>
            <td>
                <li>@param <i>string</i> &nbsp;$calendarType</li>
                 <li>@return <i>string</i></li>
            </td>
            <td>
                Get current date
            </td>
        </tr>
        <tr>
            <td>tomorrow()</td>
            <td>
                <li>@param <i>string</i> &nbsp;$calendarType</li>
                <li>@return <i>string</i></li>
            </td>
            <td>
                Get tomorrow date
            </td>
        </tr>
        <tr>
            <td>yesterday()</td>
            <td>
                <li>@param <i>string</i> &nbsp;$calendarType</li>
                <li>@return <i>string</i></li>
            </td>
            <td>
                Get yesterday date
            </td>
        </tr>
    </tbody>
</table>

# Created By Milan Tarami with 💖 love
