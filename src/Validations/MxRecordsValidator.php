<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class MxRecordsValidator extends Validator implements ValidatorInterface
{
    /**
     * @return string
     */
    public function getValidatorName(): string
    {
        return 'valid_mx_records'; // @codeCoverageIgnore
    }

    /**
     * @return bool
     */
    public function getResultResponse(): bool
    {
        if ($this->getEmailAddress()->isValidEmailAddressFormat()) {
            return $this->checkDns($this->getEmailAddress()->getHostPart(), 'MX');
        }

        return false; // @codeCoverageIgnore
    }

    /**
     * @param string $host
     * @param null $type
     * @return bool
     */
    protected function checkDns(string $host, $type = null): bool
    {
        return checkdnsrr($host, $type);
    }
}