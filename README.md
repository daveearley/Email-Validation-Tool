<p align="center">
<img src='http://i.imgur.com/FEHjqbu.png' alt='PHP Email Validation Tool' />
</p>

[![codecov](https://codecov.io/gh/daveearley/Email-Validation-Tool/branch/master/graph/badge.svg)](https://codecov.io/gh/daveearley/Email-Validation-Tool/) [![Build Status](https://travis-ci.org/daveearley/Email-Validation-Tool.svg?branch=master)](https://travis-ci.org/daveearley/Email-Validation-Tool) [![Code Climate](https://codeclimate.com/github/daveearley/Email-Validation-Tool/badges/gpa.svg)](https://codeclimate.com/github/daveearley/Email-Validation-Tool/)

**An extensible email validation library for PHP 7+**

The aim of this library is to offer a more detailed email validation report than simply checking if an email is the valid format, and also to make it possible to easily add custom validations.

Currently this tool checks the following:


| Validation  | Description |
| ------------- | ------------- |
| MX records  | Checks if the email's domain has valid MX records  |
| Valid format  | Validates e-mail addresses against the syntax in RFC 822, with the exceptions that comments and whitespace folding and dotless domain names are not supported (as it uses PHP's [filter_var()](http://php.net/manual/en/function.filter-var.php)).  |
| Email Host  | Checks if the email's host (e.g gmail.com) is reachable  |
| Role/Business Email^  | Checks if the email is a role/business based email (e.g info@reddit.com).  |
| Disposable email provider^  | Checks if the email is a [disposable email](https://en.wikipedia.org/wiki/Disposable_email_address) (e.g person@10minutemail.com).  |
| Free email provider^  | Checks if the email is a free email (e.g person@yahoo.com).  |
| Misspelled Email ^ | Checks the email for possible typos and returns a suggested correction (e.g hi@gmaol.con -> hi@gmail.com).  |

^ **Data used for these checks can be found [here](https://github.com/daveearley/Email-Validation-Tool/tree/master/src/data)**

# Installation

```bash
composer require daveearley/daves-email-validation-tool
```

# Usage
## Quick Start

```php
// Include the composer autoloader
require __DIR__ . '/vendor/autoload.php';

$validator = EmailValidation\EmailValidatorFactory::create('dave@gmoil.con');

$jsonResult = $validator->getValidationResults()->asJson();
$arrayResult = $validator->getValidationResults()->asArray();

echo $jsonResult;

```

Expected output:

```json
{
"valid_format": true,
"valid_mx_records": false,
"possible_email_correction": "dave@gmail.com",
"free_email_provider": false,
"disposable_email_provider": false,
"role_or_business_email": false,
"valid_host": false
}
```

## Adding Custom Validations

To add a custom validation simply extend the [EmailValidation\Validations\Validator](https://github.com/daveearley/Email-Validation-Tool/blob/master/src/Validations/Validator.php) class and implement the **getResultResponse()** and **getValidatorName()** methods. You then register the validation using the **EmailValidation\EmailValidator->registerValidator()** method.


### Example code

// Validations/GmailValidator.php
```php
<?php

namespace EmailValidation\Validations;

class GmailValidator extends Validator
{
    public function getValidatorName(): string
    {
        return 'is_gmail';
    }

    public function getResultResponse(): bool
    {
        $hostName = $this->getEmailAddress()->getHostPart();
        return strpos($hostName, 'gmail.com') !== false;
    }
}
```

// file-where-you-are-doing-your-validation.php
```php
<?php

use EmailValidation\Validations\GmailValidator;

require __DIR__ . '/vendor/autoload.php';

$validator = EmailValidation\EmailValidatorFactory::create('dave@gmail.com');

$validator->registerValidator(new GmailValidator());

echo $validator->getValidationResults()->asJson();
```

The expected output will be:

```json
{
"is_gmail": true,
"valid_format": true,
"valid_mx_records": false,
"possible_email_correction": "",
"free_email_provider": true,
"disposable_email_provider": false,
"role_or_business_email": false,
"valid_host": false
}
```

## Running in Docker
```bash
docker-compose up -d 
```
You can then validate an email by navigating to http://localhost:8880?email=email.to.validate@example.com. The result will be JSON string as per above.

## Adding a custom data source

You can create your own data provider by creating a data provider class which implements the [EmailValidation\EmailDataProviderInterface](https://github.com/daveearley/Email-Validation-Tool/blob/master/src/EmailDataProviderInterface.php).

Example Code:

```php
<?php

declare(strict_types=1);

namespace EmailValidation;

class CustomEmailDataProvider implements EmailDataProviderInterface
{
    public function getEmailProviders(): array
    {
        return ['custom.com'];
    }

    public function getTopLevelDomains(): array
    {
        return ['custom'];
    }

    public function getDisposableEmailProviders(): array
    {
        return ['custom.com', 'another.com'];
    }

    public function getRoleEmailPrefixes(): array
    {
        return ['custom'];
    }
}
```

# FAQ

### Is this validation accurate?
No, none of these tests are 100% accurate. As with any email validation there will always be false positives & negatives. The only way to guarantee an email is valid is to send an email and solicit a response. However, this library is still useful for detecting disposable emails etc., and also acts as a good first line of defence.

### Can I manually update the disposable email provider data?
Yes, this project relies on [this great]( https://github.com/ivolo/disposable-email-domains) repository for its list of disposable email providers. To fetch the latest list from that repo you can run

```shell
./scripts/update-dispsable-email-providers.php
```

from the command line. This will fetch the data and save it to *./src/data/disposable-email-providers.php*