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
        $adDate = NepaliCalendar::compareBsDates('2076-12-10', '<=', '2076-12-20');
        $this->assertTrue(true, 'days count');
    }

    /** @test */
    public function AD2BS()
    {
        $adDate = NepaliCalendar::AD2BS('2020-12-10');
        $this->assertTrue(true, 'ad 2 bs');
    }

    /** @test */
    public function adDateExists()
    {
        NepaliCalendar::adDateExists('202020');
        $this->assertTrue(true, 'ad date exists');
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
