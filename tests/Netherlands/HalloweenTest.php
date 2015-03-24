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
 * Class HalloweenTest.
 */
class HalloweenTest extends NetherlandsBaseTestCase
{
    /**
     * The name of the holiday
     */
    const HOLIDAY = 'halloween';

    /**
     * Tests Halloween.
     *
     * @dataProvider HalloweenDataProvider
     *
     * @param int           $year     the year for which Halloween needs to be tested
     * @param Carbon\Carbon $expected the expected date
     */
    public function testHalloween($year, $expected)
    {
        $this->assertHoliday(self::COUNTRY, self::HOLIDAY, $year, $expected);

    }

    /**
     * Returns a list of random test dates used for assertion of Halloween.
     *
     * @return array list of test dates for Halloween
     */
    public function HalloweenDataProvider()
    {
        return $this->generateRandomDates(10, 31);
    }
}
