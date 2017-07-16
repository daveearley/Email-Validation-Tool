<?php

declare(strict_types=1);

namespace EmailValidation;

class EmailAddress
{
    const EMAIL_NAME_PART = 0;
    const EMAIL_HOST_PART = 1;

    /** @var string */
    private $emailAddress;

    /**
     * @param string $emailAddress
     */
    public function __construct(string $emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

    /**
     * @return mixed
     */
    public function getNamePart()
    {
        if ($this->isValidEmailAddressFormat()) {
            return $this->getEmailPart(self::EMAIL_NAME_PART);
        }

        return null;
    }

    /**
     * @return mixed
     */
    public function getHostPart()
    {
        if ($this->isValidEmailAddressFormat()) {
            return $this->getEmailPart(self::EMAIL_HOST_PART);
        }

        return null;
    }

    /**
     * @return string|null
     */
    public function getTopLevelDomainPart()
    {
        if ($this->isValidEmailAddressFormat()) {
            return explode('.', $this->getEmailPart(self::EMAIL_HOST_PART))[1];
        }

        return null;
    }

    /**
     * @return bool
     */
    public function isValidEmailAddressFormat(): bool
    {
        return filter_var($this->emailAddress, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * @return string
     */
    public function asString(): string
    {
        return (string)$this->emailAddress;
    }

    /**
     * @param int $partNumber
     * @return mixed
     */
    private function getEmailPart(int $partNumber)
    {
        return (explode('@', $this->emailAddress))[$partNumber];
    }
}