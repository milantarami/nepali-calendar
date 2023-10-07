<?php

return [

    /**
     * DEFAULT date format.
     */
    'date_format' => 'YYYY-MM-DD',

    /**
     * DEFAULT return type
     * return types
     * [ date, string, array ].
     */
    'return_type' => 'string',

    /**
     * DEFAULT lang.
     */
    'lang' => 'en',

    /**
     * Supported date formats.
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
     * Date Separators.
     */
    'date_separators' => [
        'YYYY-MM-DD' => '-',
        'MM-DD-YYYY' => '-',
        'DD-MM-YYYY' => '-',
        'YYYY/MM/DD' => '/',
        'MM/DD/YYYY' => '/',
        'DD/MM/YYYY' => '/'
    ],

    /**
     * Supported Languages.
     */
    'langs' => [
        'np',
        'en'
    ],

    /**
     * Supported return types.
     */
    'return_types' => [
        'array',
        'string'
    ],

    /**
     * Calendar Types.
     */
    'calendar_types' => [
        'BS',
        'AD'
    ]

];
