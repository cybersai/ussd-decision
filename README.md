# UssdDecision
[![Packagist Version](https://img.shields.io/packagist/v/cybersai/ussd-decision?style=for-the-badge)](https://packagist.org/packages/cybersai/ussd-decision)
[![Travis (.org)](https://img.shields.io/travis/cybersai/ussd-decision?style=for-the-badge)](https://travis-ci.org/cybersai/ussd-decision)
[![GitHub repo size](https://img.shields.io/github/repo-size/cybersai/ussd-decision?style=for-the-badge)](https://github.com/CyberSai/ussd-decision)
![GitHub](https://img.shields.io/github/license/cybersai/ussd-decision?style=for-the-badge)

Making decision using an Object Oriented Decision fallback

No Real Documentation for now, but for now you can [read the tests](https://github.com/cybersai/ussd-decision/blob/master/tests/UssdDecisionTest.php).
```php
include 'vendor/autoload.php';

use Cybersai\UssdDecision\UssdDecision;

echo UssdDecision::using('0241122331') // Argument to use for decision making
    ->integer('It an integer') // Return this is the argument is an integer
    ->equal('0241122442', 'It my Number') // Return this is the argument is equal to the parameter given
    ->in(['05451111111', '05452222222'], 'It a schools line') // Return this is the argument is array provider
    ->length(6, 'Too short') // Return this is the argument length is 6
    ->phoneNumber('It a phone number') // Return this is the argument is a valid phone number
    ->any('Did not match any') // Just return this
    ->outcome(); // Given the outcome of the decision chain

```
```text
// Output
It a phone number
```

## Installation
`composer require cybersai/ussd-decision`
