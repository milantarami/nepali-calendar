<?php

// namespace MilanTarami\NepaliCalendar\Tests;

use MilanTarami\NepaliCalendar\Facades\NepaliCalendar;
use Orchestra\Testbench\TestCase;

class NepaliCalendarTest extends TestCase
{

    /** @test */
    public function daysCountBetweenIncludingBsDates()
    {
        $daysCount = NepaliCalendar::daysCountBetweenIncludingBsDates('2076-12-10', '2076-12-20');
        $this->assertTrue($daysCount == 11, 'days count');
    }

    /** @test */
    public function compareBsDates()
    {
        $adDate = NepaliCalendar::compareBsDates('2076-12-10', '>', '2076-12-20');
        $this->assertTrue($adDate === false, '2076-12-10 is less than 2076-12-20');
    }

    /** @test */
    public function BS2AD()
    {
        $adDate = NepaliCalendar::BS2AD('2099-12-10');
        $this->assertTrue(!!$adDate, 'ad 2 bs');
    }

    /** @test */
    public function AD2BS()
    {
        $adDate = NepaliCalendar::AD2BS('2020-12-10');
        $this->assertTrue(!!$adDate, 'ad 2 bs');
    }

    /** @test */
    public function adDateExists()
    {
        $ad = NepaliCalendar::adDateExists('2034-09-12');
        $this->assertTrue($ad, 'AD date do exists');
    }

    /** @test */
    public function adDateDontExists()
    {
        $ad = NepaliCalendar::adDateExists('2034-09-33');
        $this->assertTrue($ad === false, 'AD date don\'t exists');
    }

    /** @test */
    public function bsDateExists()
    {
        $bs = NepaliCalendar::bsDateExists('2051-10-10');
        $this->assertTrue($bs, 'BS date do exists');
    }

    /** @test */
    public function bsDateDontExists()
    {
        $bs = NepaliCalendar::bsDateExists('2099-12-32');
        $this->assertTrue($bs === false, 'BS date don\'t exists');
    }

    /** @test */
    public function getBsDateStartEndDates()
    {
        $bs = NepaliCalendar::bsMonthStartEndDates(1, 2079);

        $this->assertTrue(gettype($bs) == 'array', 'Generated bs start & end dates');
    }


    // When testing inside of a Laravel installation, this is not needed
    protected function getPackageProviders($app)
    {
        return [
            'MilanTarami\NepaliCalendar\NepaliCalendarServiceProvider'
        ];
    }
    // // When testing inside of a Laravel installation, this is not needed
    // protected function setUp()
    // {
    //     parent::setUp();
    // }
}
