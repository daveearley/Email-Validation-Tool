<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class EmailHostValidator extends Validator implements ValidatorInterface
{
    /**
     * @return string
     */
    public function getValidatorName(): string
    {
        return 'valid_host'; // @codeCoverageIgnore
    }

    /**
     * @return bool
     */
    public function getResultResponse(): bool
    {
        $hostName = $this->getEmailAddress()->getHostPart();
        if ($hostName) {
            return ($this->getHostByName($hostName) !== $hostName);
        }

        return false; // @codeCoverageIgnore
    }

    /**
     * @param string $hostName
     * @return string
     */
    protected function getHostByName(string $hostName): string
    {
        return gethostbyname($hostName); // @codeCoverageIgnore
    }
}