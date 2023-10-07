<?php

if (! function_exists('date_bs')) {
    /**
     * returns nepali bs date format YYYY-MM-DD.
     *
     * @return string
     */
    function date_bs(): string
    {
        return MilanTarami\NepaliCalendar\Facades\NepaliCalendar::today();
    }
}

if (! function_exists('AD2BS')) {
    /**
     * returns nepali bs date format YYYY-MM-DD.
     *
     * @param  date  $dateAD
     * @param  array  $config
     * @return string
     */
    function AD2BS($dateAD, array $config = []): string
    {
        return MilanTarami\NepaliCalendar\Facades\NepaliCalendar::AD2BS($dateAD, $config);
    }
}

if (! function_exists('BS2AD')) {
    /**
     * returns nepali bs date format YYYY-MM-DD.
     *
     * @param  date  $dateBS
     * @param  array  $config
     * @return string
     */
    function BS2AD($dateBS, array $config = []): string
    {
        return MilanTarami\NepaliCalendar\Facades\NepaliCalendar::BS2AD($dateBS, $config);
    }
}
