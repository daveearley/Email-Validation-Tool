<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class MxRecordsValidator extends Validator implements ValidatorInterface
{
    public function getValidatorName(): string
    {
        return 'valid_mx_records'; // @codeCoverageIgnore
    }

    public function getResultResponse(): bool
    {
        if ($this->getEmailAddress()->isValidEmailAddressFormat()) {
            return $this->checkDns($this->getEmailAddress()->getHostPart(), 'MX');
        }

        return false; // @codeCoverageIgnore
    }

    protected function checkDns(string $host, string $type = null): bool
    {
        return checkdnsrr($host, $type);
    }
}