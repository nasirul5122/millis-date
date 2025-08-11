<?php

/**
 * MillisDateManager
 *
 * Helper library for working with dates, time, and milliseconds in Laravel.
 *
 * Maintainer: Rakib Ibna Hamid Chowdhury
 * Email:      rakibibnahamidchowdhury@gmail.com
 *
 * @package  rakibhamid/millis-date
 */

namespace RakibHamid\MillisDate\Core;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateInterval;
use DatePeriod;
use DateTime;
use DateTimeZone;
use Exception;
use Illuminate\Support\Facades\Config;

/**
 * Class MillisDateManager
 *
 * Provides helper methods for date formatting, milliseconds conversion,
 * date calculations, and generating date/time ranges in various formats and timezones.
 */

class MillisDateManager
{
    /**
     * Format a date string from one format to another.
     *
     * @param string $date          The date string to format.
     * @param string $input_format  The input date format (default: d/m/Y).
     * @param string $output_format The desired output format (default: Y-m-d).
     * @return string
     */

    public function formatDate($date, $input_format = 'd/m/Y', $output_format = 'Y-m-d')
    {
        $formatted_date = \DateTime::createFromFormat($input_format, $date);

        return $formatted_date->format($output_format);
    }

    /**
     * Format a date/time string from one format to another.
     *
     * @param string $date          The datetime string to format.
     * @param string $input_format  The input datetime format (default: d/m/Y H:i:s).
     * @param string $output_format The desired output format (default: Y-m-d H:i:s).
     * @return string|null Returns formatted date or null if invalid.
     */

    public function formatDateWithTime($date, $input_format = 'd/m/Y H:i:s', $output_format = 'Y-m-d H:i:s')
    {
        $formatted_date = \DateTime::createFromFormat($input_format, $date);

        return $formatted_date ? $formatted_date->format($output_format) : null;
    }

    /**
     * Get month and year from a string separated by a delimiter.
     *
     * @param string $month_year Month and year string.
     * @param string $delimiter  Separator between month and year.
     * @return array{month_id:int,year_id:int}
     */

    public function getMonthYear($month_year, $delimiter)
    {
        $explode_month_year = explode($delimiter, $month_year);
        $response = [];
        $response['month_id'] = (int) $explode_month_year[0];
        $response['year_id'] = (int) $explode_month_year[1];

        return $response;
    }

    /**
     * Get the full month name from a numeric month ID.
     *
     * @param int|string $month_id Numeric month (1-12).
     * @return string
     */

    public function getMonthName($month_id)
    {
        $date_obj = \DateTime::createFromFormat('!m', $month_id);

        return $date_obj->format('F');
    }

    /**
     * Convert Bengali numerals in a date string to English numerals.
     *
     * @param string $bn_date Bengali date string.
     * @return string English date string.
     */

    public function convertDateToEnglish($bn_date)
    {
        $search_array = ['১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', '/'];

        $replace_array = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0', '/'];

        // convert all bangle char to English char
        $en_number = str_replace($search_array, $replace_array, $bn_date);

        // remove unwanted char
        return preg_replace('[^A-Za-z0-9:\-]', ' ', $en_number);
    }

    /**
     * Convert a date/time to milliseconds since Unix epoch.
     *
     * @param string      $date     Date string (e.g., d/m/Y).
     * @param string      $time     Time string (e.g., H:i:s).
     * @param string|null $timezone Optional timezone identifier.
     * @return int Milliseconds since epoch.
     */

    public function convertDateTimeToMillisecond($date, $time, $timezone = null)
    {
        if ($timezone) {
            date_default_timezone_set($timezone);
        }
        $concat = $date . ' ' . $time;
        $millisecond = strtotime($concat) * 1000;
        date_default_timezone_set(Config::get('app.timezone'));

        return $millisecond;
    }

    /**
     * Get current date/time in milliseconds since epoch.
     *
     * @return int
     */

    public function convertCurrentDateTimeToMillisecond()
    {
        return time() * 1000;
    }

    /**
     * Get the first date of a month.
     *
     * @param int|string $month Month number.
     * @param int|string $year  Year.
     * @return string
     */

    public function getMonthStartDate($month, $year)
    {
        $temp_date = $year . '-' . $month . '-' . '05';

        return date('Y-m-01', strtotime($temp_date));
    }

    /**
     * Get the last date of a month.
     *
     * @param int|string $month Month number.
     * @param int|string $year  Year.
     * @return string
     */

    public function getMonthEndDate($month, $year)
    {
        $temp_date = $year . '-' . $month . '-' . '05';

        return date('Y-m-t', strtotime($temp_date));
    }

    /**
     * Get number of days in a month.
     *
     * @param int|string $month Month number.
     * @param int|string $year  Year.
     * @return int
     */

    public function getNoOfDaysInMonth($month, $year)
    {
        $temp_date = $year . '-' . $month . '-' . '05';

        return (int) date('t', strtotime($temp_date));
    }

    /**
     * Find the Nth date from the given date.
     *
     * @param string $date          Base date.
     * @param int    $n             Number of days ahead (0 for same day).
     * @param string $output_format Output format.
     * @return string
     */

    public function findNthDate($date, $n, $output_format = 'Y-m-d')
    {
        if ($n == 0) {
            $n = 1;
        }
        $n += 1; // to include current day
        $date = new \DateTime(date($date));
        $date->modify("$n day");

        return $date->format($output_format);
    }

    /**
     * Get the previous date from a given date.
     *
     * @param string $date          Base date.
     * @param string $output_format Output format.
     * @return string
     */

    public function findPreviousDate($date, $output_format = 'Y-m-d')
    {
        $date = new \DateTime(date($date));
        $date->modify('-1 day');

        return $date->format($output_format);
    }

    /**
     * Get a human-readable elapsed time from milliseconds.
     *
     * @param int $millisecond_time Milliseconds.
     * @return string
     */

    public function getTimeElapsedFromMilliseconds($millisecond_time)
    {
        $time = '';
        $datetime = $millisecond_time / 1000;
        if ($millisecond_time > 86400000) {
            $days = round($millisecond_time / (1000 * 60 * 60 * 24));
            $time = $days . ' days ago';
        } elseif ($millisecond_time > 3600000) {
            $hours = floor($datetime / 3600);
            $minutes = floor(($datetime / 60) - ($hours * 60));
            $seconds = round($datetime - ($hours * 3600) - ($minutes * 60));
            $time = $hours . ' hours ' . $minutes . ' minutes ago';
        } elseif ($millisecond_time > 60000) {
            $hours = floor($datetime / 3600);
            $minutes = floor(($datetime / 60) - ($hours * 60));
            $seconds = round($datetime - ($hours * 3600) - ($minutes * 60));
            $time = $minutes . ' minutes ' . $seconds . ' seconds ago';
        } elseif ($millisecond_time > 1000) {
            $hours = floor($datetime / 3600);
            $minutes = floor(($datetime / 60) - ($hours * 60));
            $seconds = round($datetime - ($hours * 3600) - ($minutes * 60));
            $time = $seconds . ' seconds ago';
        }

        return $time;
    }

    /**
     * Get month/year from a date minus an interval.
     *
     * @param string $date     Date string.
     * @param string $interval DateInterval spec string (e.g., 'P1M').
     * @return string
     */

    public function getMonth($date, $interval)
    {
        $format_date = $this->formatDate($date);
        $now = new \DateTime(date($format_date));
        $lastMonth = $now->sub(new \DateInterval($interval));

        return $lastMonth->format('m/Y');
    }

    /**
     * Get all dates between two dates.
     *
     * @param string $start  Start date.
     * @param string $end    End date.
     * @param string $format Output format.
     * @return string[]
     */

    public function getDatesFromRange($start, $end, $format = 'Y-m-d')
    {
        $array = [];
        $interval = new \DateInterval('P1D');

        $realEnd = new \DateTime($end);
        $realEnd->add($interval);

        $period = new \DatePeriod(new \DateTime($start), $interval, $realEnd);

        foreach ($period as $date) {
            $array[] = $date->format($format);
        }

        return $array;
    }

    /**
     * Get list of month names between two months.
     *
     * @param string $fromMonth     Start month.
     * @param string $toMonth       End month.
     * @param string $output_format Output format.
     * @return string[]
     */

    public function getMonthList($fromMonth, $toMonth, $output_format = 'F y')
    {
        $months = CarbonPeriod::create(Carbon::parse($fromMonth)->format('Y-m-d'), ($toMonth))->month();

        foreach ($months as $key => $value) {
            $monthNames[] = $value->format($output_format);
        }

        return $monthNames;
    }

    /**
     * Get list of years between two months.
     *
     * @param string $fromMonth Start month.
     * @param string $toMonth   End month.
     * @return string[]
     */

    public function getYearList($fromMonth, $toMonth)
    {
        $all_years = CarbonPeriod::create(Carbon::parse($fromMonth)->format('Y-m-d'), ($toMonth))->year();
        $years = [];
        foreach ($all_years as $key => $value) {
            array_push($years, $value->format('Y'));
        }

        return $years;
    }

    /**
     * Convert milliseconds to date/time string.
     *
     * @param int    $millisecond Milliseconds.
     * @param string $format      Output format.
     * @return string
     */

    public function millisecondToDateTime($millisecond, $format = 'Y-m-d H:i:s')
    {
        return date($format, $millisecond / 1000);
    }

    /**
     * Convert milliseconds to date/time string with timezone.
     *
     * @param int    $millisecond Milliseconds.
     * @param string $format      Output format.
     * @param string $timezone    Timezone identifier.
     * @return string
     */

    public function millisecondToDateTimeWithTimezone($millisecond, $format = 'Y-m-d H:i:s', $timezone)
    {
        $seconds = floor($millisecond / 1000);

        $dateTime = new DateTime("@$seconds"); // The '@' symbol creates a DateTime object from Unix timestamp

        $dateTime->setTimezone(new DateTimeZone($timezone)); // Change to your desired timezone

        return $dateTime->format($format);
    }

    /**
     * Convert milliseconds to date string.
     *
     * @param int    $millisecond Milliseconds.
     * @param string $format      Output format.
     * @return string
     */

    public function millisecondToDate($millisecond, $format = 'Y-m-d')
    {
        return date($format, $millisecond / 1000);
    }

    /**
     * Get number of days between two dates (inclusive).
     *
     * @param string $start Start date format (d/m/Y).
     * @param string $end   End date format (d/m/Y).
     * @return int
     */

    public function getIntervalBetweenDates($start = 'd/m/Y', $end = 'd/m/Y')
    {
        $start = $this->formatDate($start);
        $end = $this->formatDate($end);
        $start_date = new \DateTime($start);
        $end_date = new \DateTime($end);
        $length = $start_date->diff($end_date);
        if (strtotime($start) > strtotime($end)) {
            return '-' . ($length->days + 1);
        } else {
            return $length->days + 1;
        }
    }

    /**
     * Get weeks (up to 40) between two dates, each with start/end and all dates in the week.
     *
     * @param string $start_date Start date in Y-m-d.
     * @param string $end_date   End date in Y-m-d.
     * @return array<int, array{week:int,start:string,end:string,dates:array}>
     */

    public function getWeeksInRange($start_date, $end_date)
    {
        $weeks = [];
        $start = new DateTime($start_date);
        $end = new DateTime($end_date);
        $end->modify('+1 day');
        $interval = DateInterval::createFromDateString('1 week');
        $period = new DatePeriod($start, $interval, $end);
        $weekCount = 1;

        foreach ($period as $dt) {
            if ($weekCount <= 40) {
                $weekStart = $dt->format('Y-m-d');
                $weekEnd = $dt->modify('+6 days')->format('Y-m-d');

                $weeks[] = [
                    'week' => $weekCount,
                    'start' => $weekStart,
                    'end' => $weekEnd,
                    'dates' => self::get_dates_from_range($weekStart, $weekEnd),
                ];
            }
            $weekCount++;
        }

        return $weeks;
    }

    /**
     * Get the date range (start/end) for a given week number after a given date.
     *
     * @param string $date       Base date in Y-m-d or d/m/Y.
     * @param int    $weekNumber Week number (0-based offset from date).
     * @param string $dateFormat Output format (default: d/m/Y).
     * @return array{start_date:string,end_date:string}
     */

    public function getWeekDateRange($date, $weekNumber, $dateFormat = 'd/m/Y')
    {
        $startDate = new DateTime($date);

        $daysToAdd = ($weekNumber) * 7;

        $startDate->modify("+$daysToAdd days");

        $endDate = clone $startDate;
        $endDate->modify('+6 days');

        $startDate = $startDate->format($dateFormat);
        $endDate = $endDate->format($dateFormat);

        return [
            'start_date' => $startDate,
            'end_date' => $endDate,
        ];
    }

    /**
     * Convert milliseconds to an array with month, month name, and year.
     *
     * @param int $millisecond Milliseconds since epoch.
     * @return array{month:int,month_name:string,year:int}
     */

    public function millisecondToMonthYear($millisecond)
    {
        $str_time = $millisecond / 1000;

        return [
            'month' => (int) date('m', $str_time),
            'month_name' => date('F', $str_time),
            'year' => (int) date('Y', $str_time),
        ];
    }

    /**
     * Calculate age from a date of birth (format: d/m/Y).
     *
     * @param string $dob Date of birth in d/m/Y.
     * @return int Age in years.
     */
    public function calculateAge($dob = 'd/m/Y')
    {
        $tz = new \DateTimeZone('America/New_York');

        return DateTime::createFromFormat('d/m/Y', $dob, $tz)
            ->diff(new DateTime('now', $tz))
            ->y;
    }

    /**
     * Get start and end epoch time (in milliseconds) for a given date and type.
     *
     * @param string $date     Date in d/m/Y.
     * @param int    $type     1 = same day, 2 = last 7 days, else = last 30 days.
     * @param string $timezone Timezone identifier.
     * @return array{epoch_start:int,epoch_end:int}
     * @throws Exception
     */
    public function getEpochTimeRange($date, $type, $timezone)
    {
        $dateRange = [];
        $dateTime = DateTime::createFromFormat('d/m/Y', $date, new DateTimeZone($timezone));

        if (!$dateTime) {
            throw new Exception('Invalid date or timezone format');
        }

        // Start of the given date in milliseconds
        $startOfDay = clone $dateTime;
        $startOfDay->setTime(0, 0, 0);
        $startOfDayEpoch = $startOfDay->getTimestamp() * 1000;

        // End of the given date in milliseconds
        $endOfDay = clone $dateTime;
        $endOfDay->setTime(23, 59, 59);
        $endOfDayEpoch = $endOfDay->getTimestamp() * 1000;

        if ($type == 1) {
            // For type 1, we use the start and end of the given date
            $dateRange = [
                'epoch_start' => $startOfDayEpoch,
                'epoch_end' => $endOfDayEpoch,
            ];
        } elseif ($type == 2) {
            // For type 2, we calculate the date range for the last 7 days including the given date
            $startOfLastWeek = clone $dateTime;
            $startOfLastWeek->modify('-6 days')->setTime(0, 0, 0); // -6 days to include the given date
            $startOfLastWeekEpoch = $startOfLastWeek->getTimestamp() * 1000;

            $dateRange = [
                'epoch_start' => $startOfLastWeekEpoch,
                'epoch_end' => $endOfDayEpoch,
            ];
        } else {
            // For any other type, we calculate the date range for the last 30 days including the given date
            $startOfLastMonth = clone $dateTime;
            $startOfLastMonth->modify('-29 days')->setTime(0, 0, 0); // -29 days to include the given date
            $startOfLastMonthEpoch = $startOfLastMonth->getTimestamp() * 1000;

            $dateRange = [
                'epoch_start' => $startOfLastMonthEpoch,
                'epoch_end' => $endOfDayEpoch,
            ];
        }

        return $dateRange;
    }

    /**
     * Get total days in the month for a given date string.
     *
     * @param string $dateString Date in d/m/Y.
     * @return int Days in month.
     */

    public function getDayCountOfAmonth($dateString)
    {

        // Create a DateTime object from the given date string
        $date = DateTime::createFromFormat('d/m/Y', $dateString);

        // Get the number of days in the month
        return $date->format('t');
    }

    /**
     * Get month names and their 2nd day dates for a range of months ending at a given date.
     *
     * @param string $givenDate Date in d/m/Y.
     * @param int    $type      1 = 1 month, 2 = 3 months, 3 = 6 months, else = 12 months.
     * @return array<int, array{month:string,date:string}>
     */

    public function getMonthNameAndDate($givenDate, $type)
    {
        switch ($type) {
            case 1:
                $monthRange = 1;
                break;
            case 2:
                $monthRange = 3;
                break;
            case 3:
                $monthRange = 6;
                break;

            default:
                $monthRange = 12;
                break;
        }
        $date = DateTime::createFromFormat('d/m/Y', $givenDate);
        $months = [];
        for ($i = 0; $i < $monthRange; $i++) {
            $currentDate = clone $date;
            $currentDate->modify("-$i month");
            $monthName = $currentDate->format('F');
            $secondOfMonth = DateTime::createFromFormat('d/m/Y', '02/' . $currentDate->format('m/Y'));
            $months[] = [
                'month' => $monthName,
                'date' => $secondOfMonth->format('d/m/Y')
            ];
        }

        return $months;
    }

    /**
     * Calculate age from a birth year.
     *
     * @param string $dob Birth year (Y).
     * @return int Age in years.
     */

    public function calculateAgeFromBirthYear($dob = 'Y')
    {
        $tz = new \DateTimeZone('America/New_York');

        return DateTime::createFromFormat('Y', $dob, $tz)
            ->diff(new DateTime('now', $tz))
            ->y;
    }

    /**
     * Get all dates within a range that fall on specific weekdays.
     *
     * @param string $startDate Start date in Y-m-d.
     * @param string $endDate   End date in Y-m-d.
     * @param int[]  $weekdays  Weekday numbers (1=Mon, 7=Sun).
     * @return string[]
     */
    public function getWeekDatesFromRange($startDate, $endDate, array $weekdays)
    {
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);
        $end->modify('+1 day');

        $interval = new DateInterval('P1D');
        $dateRange = new DatePeriod($start, $interval, $end);

        $result = [];

        foreach ($dateRange as $date) {
            $dayOfWeek = (int) $date->format('N'); // 1 (Mon) to 7 (Sun)

            if (in_array($dayOfWeek, $weekdays)) {
                $result[] = $date->format('Y-m-d');
            }
        }

        return $result;
    }

    /**
     * Get all dates between two dates with a given interval in days.
     *
     * @param string $startDate Start date in Y-m-d.
     * @param string $endDate   End date in Y-m-d.
     * @param int    $interval  Number of days between dates.
     * @return string[]
     */
    public function getDatesInIntervals($startDate, $endDate, $interval)
    {
        $start = new DateTime($startDate);
        $end = new DateTime($endDate);

        $dates = [];

        while ($start <= $end) {
            $dates[] = $start->format('Y-m-d');
            $start->modify('+' . $interval . ' days');
        }

        return $dates;
    }

    /**
     * Convert weekday numbers to their 3-letter abbreviations.
     *
     * @param int[] $weekday_numbers Array of weekday numbers (1=Mon, 7=Sun).
     * @return string[] Array of abbreviations (Mon, Tue, etc.).
     */
    public function getWeekdayAbbreviations(array $weekday_numbers): array
    {
        $map = [
            1 => 'Mon',
            2 => 'Tue',
            3 => 'Wed',
            4 => 'Thu',
            5 => 'Fri',
            6 => 'Sat',
            7 => 'Sun',
        ];

        return array_map(function ($number) use ($map) {
            return $map[$number] ?? null; // fallback to null if invalid
        }, $weekday_numbers);
    }
}
