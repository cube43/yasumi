<?php
/*
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
use Yasumi\Tests\Netherlands\NetherlandsBaseTestCase;

/**
 * Class stMartinsDayTest.
 */
class stMartinsDayTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'stMartinsDay';

    /**
     * Tests Sint Martins Day.
     *
     * @dataProvider stMartinsDayDataProvider
     *
     * @param int           $year     the year for which Sint Martins Day needs to be tested
     * @param Carbon\Carbon $expected the expected date
     */
    public function teststMartinsDay($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, $expected);

    }

    /**
     * Returns a list of random test dates used for assertion of Sint Martins Day.
     *
     * @return array list of test dates for Sint Martins Day
     */
    public function stMartinsDayDataProvider()
    {
        return $this->generateRandomDates(11, 11);
    }
}
