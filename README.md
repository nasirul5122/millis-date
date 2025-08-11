# Millis Date

[![Packagist](https://img.shields.io/packagist/v/rakibhamid/millis-date.svg)](https://packagist.org/packages/rakibhamid/millis-date)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](LICENSE)

**Millis Date** is a Laravel helper package for working with dates, time, and milliseconds.  
It provides utility methods for date formatting, conversion, and calculations in various formats and timezones.

---

## 📦 Installation

You can install the package via Composer:

```bash
composer require rakibhamid/millis-date
```

---

## 🚀 Usage

### Import Facade

```php
use RakibHamid\MillisDate\Facades\MillisDate;
```

### Examples

#### Convert DateTime to Milliseconds
```php
$milliseconds = MillisDate::convertDateTimeToMillisecond('2025-08-11', '14:30:00');
```

#### Convert Milliseconds to DateTime
```php
$dateTime = MillisDate::millisecondToDateTime(1691765400000);
```

#### Get Dates in Range
```php
$dates = MillisDate::getDatesFromRange('2025-08-01', '2025-08-10');
```

---

## 📚 Features

- Convert between date/time and milliseconds.
- Format dates into custom formats.
- Get month/year lists.
- Find dates in a range.
- Timezone-aware date conversions.
- And more…

---

## 🛠 Requirements

- **PHP**: 7.0 or higher
- **Laravel**: 7.x or higher

---

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

---

## 🤝 Support

For issues, please open a GitHub issue in the [repository](https://github.com/rakib-chowdhury/millis-date).  
View the package on Packagist: [rakibhamid/millis-date](https://packagist.org/packages/rakibhamid/millis-date)  
Maintainer: **Rakib Ibna Hamid Chowdhury** – rakibibnahamidchowdhury@gmail.com
