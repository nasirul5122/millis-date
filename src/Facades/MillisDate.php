<?php

namespace RakibHamid\MillisDate\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static string formatDate(string $date, string $input_format = 'd/m/Y', string $output_format = 'Y-m-d')
 * @method static string|null formatDateWithTime(string $date, string $input_format = 'd/m/Y H:i:s', string $output_format = 'Y-m-d H:i:s')
 * @method static array getMonthYear(string $month_year, string $delimiter)
 * @method static string getMonthName(int $month_id)
 * @method static string convertDateToEnglish(string $bn_date)
 * @method static int convertDateTimeToMillisecond(string $date, string $time, ?string $timezone = null)
 * @method static int convertCurrentDateTimeToMillisecond()
 * @method static string getMonthStartDate(int|string $month, int|string $year)
 * @method static string getMonthEndDate(int|string $month, int|string $year)
 * @method static int getNoOfDaysInMonth(int|string $month, int|string $year)
 * @method static string findNthDate(string $date, int $n, string $output_format = 'Y-m-d')
 * @method static string findPreviousDate(string $date, string $output_format = 'Y-m-d')
 * @method static string getTimeElapsedFromMilliseconds(int $millisecond_time)
 * @method static string getMonth(string $date, string $interval)
 * @method static array getDatesFromRange(string $start, string $end, string $format = 'Y-m-d')
 * @method static array getMonthList(string $fromMonth, string $toMonth, string $output_format = 'F y')
 * @method static array getYearList(string $fromMonth, string $toMonth)
 * @method static string millisecondToDateTime(int $millisecond, string $format = 'Y-m-d H:i:s')
 * @method static string millisecondToDateTimeWithTimezone(int $millisecond, string $format, string $timezone)
 * @method static string millisecondToDate(int $millisecond, string $format = 'Y-m-d')
 * @method static int getIntervalBetweenDates(string $start = 'd/m/Y', string $end = 'd/m/Y')
 * @method static array getWeeksInRange(string $start_date, string $end_date)
 * @method static array getWeekDateRange(string $date, int $weekNumber, string $dateFormat = 'd/m/Y')
 * @method static array millisecondToMonthYear(int $millisecond)
 * @method static int calculateAge(string $dob = 'd/m/Y')
 * @method static array getEpochTimeRange(string $date, int $type, string $timezone)
 * @method static int getDayCountOfAmonth(string $dateString)
 * @method static array getMonthNameAndDate(string $givenDate, int $type)
 * @method static int calculateAgeFromBirthYear(string $dob = 'Y')
 * @method static array getWeekDatesFromRange(string $startDate, string $endDate, array $weekdays)
 * @method static array getDatesInIntervals(string $startDate, string $endDate, int $interval)
 * @method static array getWeekdayAbbreviations(array $weekday_numbers)
 *
 * @see \RakibHamid\MillisDate\Core\MillisDateManager
 */
class MillisDate extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'millis-date';
    }
}
