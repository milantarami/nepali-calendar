<?php

namespace MilanTarami\NepaliCalendar\Traits;

use MilanTarami\NepaliCalendar\CalendarMessage;
use MilanTarami\NepaliCalendar\Exceptions\NepaliCalendarException;

trait setCalendarConfig
{
    protected $dateFormat;
    protected $returnType;
    protected $lang;
    protected $dateSeparator;

    /**
     * load a initial config from np_calendar config file.
     *
     * @return void
     */
    private function setInitialConfig(): void
    {
        $this->dateFormat = config('nepali-calendar.date_format');
        $this->returnType = config('nepali-calendar.return_type');
        $this->lang = config('nepali-calendar.lang');
        $this->dateSeparator = config('nepali-calendar.date_separators')[$this->dateFormat];
    }

    /**
     * Set config from user input.
     *
     * @param  array  $config
     * @return void
     */
    private function setUserConfig($config = []): void
    {
        if (gettype($config) === 'array') {
            if (array_key_exists('date_format', $config)) {
                $this->setDateFormat($config['date_format']);
                $this->setDateSeparator();
            }
            if (array_key_exists('return_type', $config)) {
                $this->setReturnType($config['return_type']);
            }
            if (array_key_exists('lang', $config)) {
                $this->setLang($config['lang']);
            }
        } else {
            throw new NepaliCalendarException(sprintf(CalendarMessage::E_ARRAY_TYPE, $config));
        }
    }

    /**
     * set a date format.
     *
     * @param  string  $value
     * @return void
     */
    private function setDateFormat($dateFormat): void
    {
        if (in_array($dateFormat, config('nepali-calendar.date_formats'))) {
            $this->dateFormat = $dateFormat;
        } else {
            throw new NepaliCalendarException(sprintf(CalendarMessage::E_UNSUPPORTED_DATE_FORMAT, $dateFormat));
        }
    }

    /**
     * set a return type.
     *
     * @param  string  $value
     * @return void
     */
    private function setReturnType($returnType): void
    {
        if (in_array($returnType, config('nepali-calendar.return_types'))) {
            $this->returnType = $returnType;
        } else {
            throw new NepaliCalendarException(sprintf(CalendarMessage::E_UNSUPPORTED_RETURN_TYPE, $returnType));
        }
    }

    /**
     * set a lang.
     *
     * @param  string  $value
     * @return void
     */
    private function setLang($lang): void
    {
        if (in_array($lang, config('nepali-calendar.langs'))) {
            $this->lang = $lang;
        } else {
            throw new NepaliCalendarException(sprintf(CalendarMessage::E_UNSUPPORTED_LANG, $lang));
        }
    }

    /**
     * set a dateSeparator.
     *
     * @return void
     */
    private function setDateSeparator(): void
    {
        $this->dateSeparator = config('nepali-calendar.date_separators')[$this->dateFormat];
    }

    /**
     * check is calendar type is supported.
     *
     * @return void
     */
    private function calendarType($calendarType)
    {
        if (in_array($calendarType, config('nepali-calendar.calendar_types'))) {
            return;
        }
        throw new NepaliCalendarException(CalendarMessage::E_UNSUPPORTED_CALENDAR_TYPE);
    }

    /**
     * check date format.
     */
    private function checkDateFormat($dateFormat)
    {
        if (in_array($dateFormat, config('nepali-calendar.date_formats'))) {
            return true;
        }
        throw new NepaliCalendarException(sprintf(CalendarMessage::E_UNSUPPORTED_DATE_FORMAT, $dateFormat));
    }

    /**
     * get a dateSeparator.
     *
     * @param string
     * @return string
     */
    private function getDateSeparator($dateFormat): string
    {
        return config('nepali-calendar.date_separators')[$dateFormat];
    }
}
