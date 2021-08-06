<?php

// namespace MilanTarami\NepaliCalendar\Tests;

use Orchestra\Testbench\TestCase;
use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;

class CustomValidationRulesTest extends TestCase
{

    /** @test */
    public function validDateBS()
    {
        $rules = [
            'dob_bs' => 'date_bs'
        ];

        $data = [
            'dob_bs' => '2051-10-10'
        ];

        $v = $this->app['validator']->make($data, $rules);
        $this->assertTrue($v->passes());
    }

    // When testing inside of a Laravel installation, this is not needed
    protected function getPackageProviders($app)
    {
        return [
            'MilanTarami\NepaliCalendar\NepaliCalendarServiceProvider',
        ];
    }
}
