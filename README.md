# UssdDecision
[![Packagist Version](https://img.shields.io/packagist/v/cybersai/ussd-decision?style=for-the-badge)](https://packagist.org/packages/cybersai/ussd-decision)
[![Travis (.com)](https://img.shields.io/travis/cybersai/ussd-decision?style=for-the-badge)](https://travis-ci.com/cybersai/ussd-decision)
[![GitHub repo size](https://img.shields.io/github/repo-size/cybersai/ussd-decision?style=for-the-badge)](https://github.com/CyberSai/ussd-decision)
![GitHub](https://img.shields.io/github/license/cybersai/ussd-decision?style=for-the-badge)

Making decision using an Object Oriented Decision fallback

No Real Documentation for now, but for now you can [read the tests](https://github.com/cybersai/ussd-decision/blob/master/tests/UssdDecisionTest.php).
```php
include 'vendor/autoload.php';

use Cybersai\UssdDecision\UssdDecision;

// if input is an integer
echo UssdDecision::input(0)
    ->isInteger('Input is an integer')
    ->default('No match')
    ->outcome();

// if input is equal to value
echo UssdDecision::input('0241122331')
    ->isEqual('0241122331', 'Input is equal to value')
    ->default('Not a match')
    ->outcome();

// if input exist in array
echo UssdDecision::input('0241122331')
    ->in(['0241122331', '05452222222'], 'Input exist in array')
    ->default('Not a match')
    ->outcome();

// if length is equal to value length
echo UssdDecision::input('024111')
    ->length(6, 'Input length is equal to value length')
    ->default('Not a match')
    ->outcome();

// if input is a phone number
echo UssdDecision::input('0241122331')
    ->isPhoneNumber('Input is a phone number')
    ->default('Not a match')
    ->outcome();

```
```text
// Output
It a phone number
```

## Installation
`composer require cybersai/ussd-decision`
