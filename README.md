# Nepali Calendar

## Installation and setup

You can install this package via composer using:

``` bash
composer require milantarami/nepali-calendar
```

The package will automatically register its service provider for laravel 5.5.* and above. <br>
For below version need to register a service provider manually in <code>config/app.php</code>

``` bash
'providers' => [

    /*
    * Package Service Providers...
    */
    
   MilanTarami\NepaliCalendar\NepaliCalendarServiceProvider::class         

],
```

The package will automatically load alias for laravel 5.5.* and above. <br>
For below version need to add alias manually in <code>config/app.php</code>

``` bash
'aliases' => [
    .
    .
    'NumberToWords' => MilanTarami\NepaliCalendar\Facades\NepaliCalendar::class,

]
```

To publish the config file to <code>config/number_to_words.php</code> run:

``` bash
php artisan vendor:publish --tag=nepali-calendar-config
```

This is the default contents of the configuration:

``` bash
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

