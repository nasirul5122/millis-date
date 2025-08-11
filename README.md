# Millis Date

**Millis Date** is a Laravel helper package for working with dates, time, and milliseconds.  
It provides utility methods for date formatting, conversion, ranges, and timezone‑aware output.

[![Packagist](https://img.shields.io/packagist/v/rakibhamid/millis-date.svg)](https://packagist.org/packages/rakibhamid/millis-date)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/rakibhamid/millis-date)](https://packagist.org/packages/rakibhamid/millis-date)
[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)

---

## 📦 Installation

```bash
composer require rakibhamid/millis-date
```

If auto-discovery is disabled (Laravel 7/8):

```php
// config/app.php
'providers' => [
    RakibHamid\MillisDate\MillisDateServiceProvider::class,
],
'aliases' => [
    'MillisDate' => RakibHamid\MillisDate\Facades\MillisDate::class,
],
```

---

## 🚀 Usage

```php
use RakibHamid\MillisDate\Facades\MillisDate;

// Date + time -> milliseconds
$ms = MillisDate::convertDateTimeToMillisecond('25/12/2025', '14:30:00');

// Milliseconds -> date / datetime
$date = MillisDate::millisecondToDate(1766653800000);                 // 2025-12-25
$dt   = MillisDate::millisecondToDateTime(1766653800000);             // 2025-12-25 14:30:00
$tzdt = MillisDate::millisecondToDateTimeWithTimezone(1766653800000, 'Y-m-d H:i:s', 'Asia/Dhaka');

// Range of dates
$days = MillisDate::getDatesFromRange('2025-01-01', '2025-01-05');

// Human readable elapsed
$ago = MillisDate::getTimeElapsedFromMilliseconds(7200000); // "2 hours 0 minutes ago"
```

### More helpers
- `formatDate('15/08/2025', 'd/m/Y', 'Y-m-d')`
- `getMonthName(5)` → `May`
- `millisecondToMonthYear(…)` → `['month'=>12,'month_name'=>'December','year'=>2025]`
- `getWeeksInRange('2025-01-01','2025-02-15')` → array of week blocks

---

## 📚 Available Methods (Facade)

- `formatDate($date, $input_format, $output_format)`
- `formatDateWithTime($date, $input_format, $output_format)`
- `getMonthYear($month_year, $delimiter)`
- `getMonthName($month_id)`
- `convertDateToEnglish($bn_date)`
- `convertDateTimeToMillisecond($date, $time, $timezone = null)`
- `convertCurrentDateTimeToMillisecond()`
- `getMonthStartDate($month, $year)`
- `getMonthEndDate($month, $year)`
- `getNoOfDaysInMonth($month, $year)`
- `findNthDate($date, $n, $output_format)`
- `findPreviousDate($date, $output_format)`
- `getTimeElapsedFromMilliseconds($millisecond_time)`
- `getMonth($date, $interval)`
- `getDatesFromRange($start, $end, $format)`
- `getMonthList($fromMonth, $toMonth, $output_format)`
- `getYearList($fromMonth, $toMonth)`
- `millisecondToDateTime($millisecond, $format)`
- `millisecondToDateTimeWithTimezone($millisecond, $format, $timezone)`
- `millisecondToDate($millisecond, $format)`
- `getIntervalBetweenDates($start, $end)`
- `getWeeksInRange($start_date, $end_date)`
- `getWeekDateRange($date, $weekNumber, $dateFormat)`
- `millisecondToMonthYear($millisecond)`
- `calculateAge($dob)`
- `getEpochTimeRange($date, $type, $timezone)`
- `getDayCountOfAmonth($dateString)`
- `getMonthNameAndDate($givenDate, $type)`
- `calculateAgeFromBirthYear($dob)`
- `getWeekDatesFromRange($startDate, $endDate, $weekdays)`
- `getDatesInIntervals($startDate, $endDate, $interval)`
- `getWeekdayAbbreviations($weekday_numbers)`

---

## 🛠 Requirements
- **PHP:** 7.2.5+
- **Laravel:** 7.x – 11.x

---

## 🧑‍💻 Maintainer
**Rakib Ibna Hamid Chowdhury**  
📧 [rakibibnahamidchowdhury@gmail.com](mailto:rakibibnahamidchowdhury@gmail.com)

---

## 🤝 Support
- Open an issue on GitHub: https://github.com/rakib-chowdhury/millis-date/issues
- Or email the maintainer

---

## 📄 License
This package is open-sourced software licensed under the [MIT license](LICENSE).
