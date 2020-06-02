<?php

declare(strict_types=1);

namespace EmailValidation;

use EmailValidation\Validations\DisposableEmailValidator;
use EmailValidation\Validations\EmailHostValidator;
use EmailValidation\Validations\FreeEmailServiceValidator;
use EmailValidation\Validations\MisspelledEmailValidator;
use EmailValidation\Validations\MxRecordsValidator;
use EmailValidation\Validations\RoleBasedEmailValidator;
use EmailValidation\Validations\Validator;
use EmailValidation\Validations\ValidFormatValidator;

class EmailValidatorFactory
{
    /** @var Validator[] */
    protected static array $defaultValidators = [
        ValidFormatValidator::class,
        MxRecordsValidator::class,
        MisspelledEmailValidator::class,
        FreeEmailServiceValidator::class,
        DisposableEmailValidator::class,
        RoleBasedEmailValidator::class,
        EmailHostValidator::class
    ];

    public static function create(string $emailAddress): EmailValidator
    {
        $emailAddress = new EmailAddress($emailAddress);
        $emailDataProvider = new EmailDataProvider();
        $emailValidationResults = new ValidationResults();
        $emailValidator = new EmailValidator($emailAddress, $emailValidationResults, $emailDataProvider);

        foreach (self::$defaultValidators as $validator) {
            $emailValidator->registerValidator(new $validator);
        }

        return $emailValidator;
    }
}