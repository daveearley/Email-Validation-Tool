<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class ValidFormatValidator extends Validator implements ValidatorInterface
{
    /**
     * @return string
     */
    public function getValidatorName(): string
    {
        return 'valid_format'; // @codeCoverageIgnore
    }

    /**
     * @return bool
     */
    public function getResultResponse(): bool
    {
        return $this->getEmailAddress()->isValidEmailAddressFormat();
    }
}