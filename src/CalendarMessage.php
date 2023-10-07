<?php

namespace MilanTarami\NepaliCalendar;

class CalendarMessage
{
    const E_UNSUPPORTED_DATE_FORMAT = '%s date_format is not supported';
    const E_UNSUPPORTED_RETURN_TYPE = '%s return_type is not supported';
    const E_UNSUPPORTED_LANG = '%s lang is not supported';
    const E_ARRAY_TYPE = '%s must be array';

    const E_UNSUPPORTED_AD_YEAR_RANGE = 'Supported only between %s-%s';
    const E_UNSUPPORTED_BS_YEAR_RANGE = 'Supported only between %s-%s';
    const E_BAD_MONTH_VALUE = 'Month value can be only from 1 to 12.';
    const E_AD_BAD_DAY_VALUE = 'Day value can be only from 1 to 31';
    const E_BS_BAD_DAY_VALUE = 'Day value can be only from 1 to 32';

    const E_UNSUPPORTED_CALENDAR_TYPE = 'Calendar Type is not supported';
    const E_INVALID_BS_DATE = '%s is not a valid BS date';
}
