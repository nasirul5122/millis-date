# Millis Date

**Millis Date** is a Laravel helper package for working with dates, time, and milliseconds.  
It provides utility methods for date formatting, conversion, and calculations in various formats and timezones.

## 📦 Installation

You can install the package via Composer:

```bash
composer require rakibhamid/millis-date

If you are not using Laravel auto-discovery, add the service provider manually to your config/app.php:

'providers' => [
    RakibHamid\MillisDate\MillisDateServiceProvider::class,
],

And the facade (optional):

'aliases' => [
    'MillisDate' => RakibHamid\MillisDate\Facades\MillisDate::class,
],


---

**Usage**  
```markdown
## 🚀 Usage

### Convert Date to Milliseconds
```php
use MillisDate;

$milliseconds = MillisDate::convertDateTimeToMillisecond('25/12/2025', '14:30:00');
// Example output: 1766653800000

Convert Milliseconds to Date

$date = MillisDate::millisecondToDate(1766653800000, 'Y-m-d');
// Example output: 2025-12-25

Get Dates in a Range

$dates = MillisDate::getDatesFromRange('2025-01-01', '2025-01-05');
// Example output: ['2025-01-01', '2025-01-02', '2025-01-03', '2025-01-04', '2025-01-05']

Get Month Name

$monthName = MillisDate::getMonthName(5);
// Example output: May

Calculate Age

$age = MillisDate::calculateAge('25/12/2000');
// Example output: 24


---

**Features & Requirements**  
```markdown
## 📚 Features

- Convert between date/time and milliseconds.
- Format dates with and without time.
- Get month/year information.
- Find dates within a given range.
- Get start/end dates for a month.
- Calculate age from date of birth or birth year.
- Work with different timezones.

---

## 🛠 Requirements

- **PHP:** 7.0 – latest  
- **Laravel:** 7.x – latest

## 🧑‍💻 Maintainer

**Rakib Ibna Hamid Chowdhury**  
📧 [rakibibnahamidchowdhury@gmail.com](mailto:rakibibnahamidchowdhury@gmail.com)  

---

## 🤝 Support

If you find any issues or want to request new features:  

1. Open an issue on [GitHub Issues](https://github.com/yourusername/millis-date/issues)  
2. Or email me at [rakibibnahamidchowdhury@gmail.com](mailto:rakibibnahamidchowdhury@gmail.com)

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).
