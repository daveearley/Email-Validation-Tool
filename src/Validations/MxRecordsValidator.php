<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class MxRecordsValidator extends Validator implements ValidatorInterface
{
    private const VALID_DNS_RECORDS = ['MX', 'A', 'AAAA', 'NS'];

    public function getValidatorName(): string
    {
        return 'valid_mx_records'; // @codeCoverageIgnore
    }

    public function getResultResponse(): bool
    {
        if (!$this->getEmailAddress()->isValidEmailAddressFormat()) {
            return false; // @codeCoverageIgnore
        }

        $results = [];
        foreach (self::VALID_DNS_RECORDS as $dns) {
            $results[] = $this->checkDns($this->getEmailAddress()->getHostPart(true), $dns);
        }

        // To be considered valid we needs an NS record and at least one MX, A or AAA record
        return count(array_filter($results)) >= 2;
    }

    protected function checkDns(string $host, string $type = null): bool
    {
        return checkdnsrr($host, $type);
    }
}