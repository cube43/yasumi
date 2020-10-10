<?php

declare(strict_types=1);
/**
 * This file is part of the Yasumi package.
 *
 * Copyright (c) 2015 - 2020 AzuyaLabs
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @author Sacha Telgenhof <me@sachatelgenhof.com>
 */

namespace Yasumi\tests\Base;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yasumi\Filters\BankHolidays;
use Yasumi\Filters\ObservedHolidays;
use Yasumi\Filters\OfficialHolidays;
use Yasumi\Filters\OtherHolidays;
use Yasumi\Filters\SeasonalHolidays;
use Yasumi\tests\YasumiBase;
use Yasumi\Yasumi;

/**
 * Class HolidayFiltersTest.
 *
 * Contains tests for testing the filter classes
 */
class HolidayFiltersTest extends TestCase
{
    use YasumiBase;

    /**
     * Tests the Official Holidays filter.
     *
     * @throws ReflectionException
     */
    public function testOfficialHolidaysFilter(): void
    {
        // There are 11 official holidays in Ireland in the year 2018, with 1 substituted holiday.
        $holidays = Yasumi::create('Ireland', 2018);

        $filteredHolidays = new OfficialHolidays($holidays->getIterator());
        $filteredHolidaysArray = \iterator_to_array($filteredHolidays);

        // Assert array definitions
        self::assertArrayHasKey('newYearsDay', $filteredHolidaysArray);
        self::assertArrayHasKey('stPatricksDay', $filteredHolidaysArray);
        self::assertArrayHasKey('easter', $filteredHolidaysArray);
        self::assertArrayHasKey('easterMonday', $filteredHolidaysArray);
        self::assertArrayHasKey('mayDay', $filteredHolidaysArray);
        self::assertArrayHasKey('juneHoliday', $filteredHolidaysArray);
        self::assertArrayHasKey('augustHoliday', $filteredHolidaysArray);
        self::assertArrayHasKey('octoberHoliday', $filteredHolidaysArray);
        self::assertArrayHasKey('christmasDay', $filteredHolidaysArray);
        self::assertArrayHasKey('stStephensDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('pentecost', $filteredHolidaysArray);
        self::assertArrayNotHasKey('pentecostMonday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('goodFriday', $filteredHolidaysArray);

        // Assert number of results returned
        self::assertCount(10, $filteredHolidays);
        self::assertNotCount(\count($holidays), $filteredHolidays);
        self::assertEquals(10, $filteredHolidays->count());
        self::assertNotEquals(\count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests the Observed Holidays filter.
     *
     * @throws ReflectionException
     */
    public function testObservedHolidaysFilter(): void
    {
        // There are 2 observed holidays in Ireland in the year 2018.
        $holidays = Yasumi::create('Ireland', 2018);

        $filteredHolidays = new ObservedHolidays($holidays->getIterator());
        $filteredHolidaysArray = \iterator_to_array($filteredHolidays);

        // Assert array definitions
        self::assertArrayNotHasKey('newYearsDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('stPatricksDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('easter', $filteredHolidaysArray);
        self::assertArrayNotHasKey('easterMonday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('pentecostMonday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('mayDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('juneHoliday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('augustHoliday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('octoberHoliday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('christmasDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('stStephensDay', $filteredHolidaysArray);
        self::assertArrayHasKey('pentecost', $filteredHolidaysArray);
        self::assertArrayHasKey('goodFriday', $filteredHolidaysArray);

        // Assert number of results returned
        self::assertCount(2, $filteredHolidays);
        self::assertNotCount(\count($holidays), $filteredHolidays);
        self::assertEquals(2, $filteredHolidays->count());
        self::assertNotEquals(\count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests Bank Holidays.
     *
     * @throws ReflectionException
     */
    public function testBankHolidaysFilter(): void
    {
        // There are no bank holidays in Ireland in the year 2018.
        $holidays = Yasumi::create('Ireland', 2018);

        $filteredHolidays = new BankHolidays($holidays->getIterator());
        $filteredHolidaysArray = \iterator_to_array($filteredHolidays);

        // Assert array definitions
        self::assertArrayNotHasKey('newYearsDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('stPatricksDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('easter', $filteredHolidaysArray);
        self::assertArrayNotHasKey('easterMonday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('mayDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('juneHoliday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('augustHoliday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('octoberHoliday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('christmasDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('stStephensDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('pentecost', $filteredHolidaysArray);
        self::assertArrayNotHasKey('pentecostMonday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('goodFriday', $filteredHolidaysArray);

        // Assert number of results returned
        self::assertCount(0, $filteredHolidays);
        self::assertNotCount(\count($holidays), $filteredHolidays);
        self::assertEquals(0, $filteredHolidays->count());
        self::assertNotEquals(\count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests Seasonal Holidays.
     *
     * @throws ReflectionException
     */
    public function testSeasonalHolidaysFilter(): void
    {
        $holidays = Yasumi::create('Netherlands', 2017);

        $filteredHolidays = new SeasonalHolidays($holidays->getIterator());
        $filteredHolidaysArray = \iterator_to_array($filteredHolidays);

        // Assert array definitions
        self::assertArrayHasKey('summerTime', $filteredHolidaysArray);
        self::assertArrayHasKey('winterTime', $filteredHolidaysArray);
        self::assertArrayNotHasKey('newYearsDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('easter', $filteredHolidaysArray);
        self::assertArrayNotHasKey('easterMonday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('kingsDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('ascensionDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('pentecost', $filteredHolidaysArray);
        self::assertArrayNotHasKey('pentecostMonday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('christmasDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('secondChristmasDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('stMartinsDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('goodFriday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('ashWednesday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('commemorationDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('liberationDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('halloween', $filteredHolidaysArray);
        self::assertArrayNotHasKey('stNicholasDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('carnivalDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('secondCarnivalDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('thirdCarnivalDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('internationalWorkersDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('valentinesDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('worldAnimalDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('fathersDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('mothersDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('epiphany', $filteredHolidaysArray);
        self::assertArrayNotHasKey('princesDay', $filteredHolidaysArray);

        // Assert number of results returned
        self::assertCount(2, $filteredHolidays);
        self::assertNotCount(\count($holidays), $filteredHolidays);
        self::assertEquals(2, $filteredHolidays->count());
        self::assertNotEquals(\count($holidays), $filteredHolidays->count());
    }

    /**
     * Tests other type of Holidays.
     *
     * @throws ReflectionException
     */
    public function testOtherHolidaysFilter(): void
    {
        $holidays = Yasumi::create('Netherlands', 2017);

        $filteredHolidays = new OtherHolidays($holidays->getIterator());
        $filteredHolidaysArray = \iterator_to_array($filteredHolidays);

        // Assert array definitions
        self::assertArrayHasKey('internationalWorkersDay', $filteredHolidaysArray);
        self::assertArrayHasKey('valentinesDay', $filteredHolidaysArray);
        self::assertArrayHasKey('worldAnimalDay', $filteredHolidaysArray);
        self::assertArrayHasKey('fathersDay', $filteredHolidaysArray);
        self::assertArrayHasKey('mothersDay', $filteredHolidaysArray);
        self::assertArrayHasKey('epiphany', $filteredHolidaysArray);
        self::assertArrayHasKey('princesDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('summerTime', $filteredHolidaysArray);
        self::assertArrayNotHasKey('winterTime', $filteredHolidaysArray);
        self::assertArrayNotHasKey('newYearsDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('easter', $filteredHolidaysArray);
        self::assertArrayNotHasKey('easterMonday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('kingsDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('ascensionDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('pentecost', $filteredHolidaysArray);
        self::assertArrayNotHasKey('pentecostMonday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('christmasDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('secondChristmasDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('stMartinsDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('goodFriday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('ashWednesday', $filteredHolidaysArray);
        self::assertArrayNotHasKey('commemorationDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('liberationDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('halloween', $filteredHolidaysArray);
        self::assertArrayNotHasKey('stNicholasDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('carnivalDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('secondCarnivalDay', $filteredHolidaysArray);
        self::assertArrayNotHasKey('thirdCarnivalDay', $filteredHolidaysArray);

        // Assert number of results returned
        self::assertCount(7, $filteredHolidays);
        self::assertNotCount(\count($holidays), $filteredHolidays);
        self::assertEquals(7, $filteredHolidays->count());
        self::assertNotEquals(\count($holidays), $filteredHolidays->count());
    }
}
