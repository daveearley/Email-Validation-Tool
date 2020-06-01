<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class ValidFormatValidator extends Validator implements ValidatorInterface
{
    public function getValidatorName(): string
    {
        return 'valid_format'; // @codeCoverageIgnore
    }

    public function getResultResponse(): bool
    {
        return $this->getEmailAddress()->isValidEmailAddressFormat();
    }
}