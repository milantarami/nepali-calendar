# Nepali Calendar

This repository contains a rewrite of <a href="https://github.com/amant/Nepali-Date-Convert/blob/master/php/nepali_calendar.php">Nepali_Calendar.php</a> by Aman Tuladhar, which is a DateConverter. And this package designed to give more features and code sharing via the composer ( a dependency manager for PHP). Check out the features added.

# Installation in Laravel

You can install this package via composer using:

```bash
composer require milantarami/nepali-calendar
```

The package will automatically register its service provider for laravel 5.5.\* and above. <br>
For below version need to register a service provider manually in <code>config/app.php</code>

```bash
'providers' => [

    /*
    * Package Service Providers...
    */

   MilanTarami\NepaliCalendar\NepaliCalendarServiceProvider::class

],
```

The package will automatically load alias for laravel 5.5.\* and above. <br>
For below version need to add alias manually in <code>config/app.php</code>

```bash
'aliases' => [
    .
    .
    'NumberToWords' => MilanTarami\NepaliCalendar\Facades\NepaliCalendar::class,

]
```

To publish the config file to <code>config/number_to_words.php</code> run:

```bash
php artisan vendor:publish --tag=nepali-calendar-config
```

This is the default contents of the configuration:

```bash
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

## Basic Usage

Convert AD to BS

```bash
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

$bsDate = NepaliCalendar::AD2BS('2076-10-20');
```

<strong>Note :</strong> <i>The default date format is</i> <mark>YYYY-MM-DD</mark> <i> if your date format differ than you need to provide a date format</i>
</i>

```bash
$bsDate = NepaliCalendar::AD2BS('20-10-2076', [
    'date_format' => 'DD-MM-YYYY'
]);
```

## Supported Date Formats

Only six date formats are currently supported as listed below. You need to pass the value as key value<br/><mark><b>'date_format' => 'YYYY/MM/DD'</b></mark> in optional param \$config = []

```bash
'YYYY-MM-DD',
'MM-DD-YYYY',
'DD-MM-YYYY',
'YYYY/MM/DD',
'MM/DD/YYYY',
'DD/MM/YYYY'
```

<strong>Note:</strong> default <i><b> date_format </b></i> is <i><b>'YYYY-MM-DD'</b></i>

## Supported Return Types

You need to pass the value as key value <mark><b>'return_type' => 'array'</b></mark> in optional param \$config = []

```bash
'string',
'array'
```

<strong>Note:</strong> default <i><b> return_type </b></i> is <i><b>string</b></i>

## \$config = [] as param

## Methods Avaliable

<table width="100">
    <thead>
        <tr>
            <th>Function</th>
            <th>Parameter</th>
            <th>Description</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>AD2BS()</td>
            <td>
                <li>@param string $date</li>
                <li>@param array $config</li>
                <li>@return string|array </li>
            </td>
            <td>
                Convert AD date to equivalent BS date
            </td>
        </tr>
        <tr>
            <td>BS2AD()</td>
            <td>
                <li>@param string $date</li>
                <li>@param array $config</li>
                <li>@return string|array </li>
            </td>
            <td>
                Convert BS date to equivalent AD date
            </td>
        </tr>
        <tr>
            <td>addMonthsToBsDate()</td>
            <td>
                <li></li>
            </td>
            <td></td>
        </tr>
        <tr>
            <td>today()</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>tomorrow()</td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>yesterday()</td>
            <td></td>
            <td></td>
        </tr>
    </tbody>
</table>
