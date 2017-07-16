<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\EmailDataProvider;

abstract class Validator
{
    /** @var EmailAddress */
    private $emailAddress;

    /** @var EmailDataProvider|null */
    private $emailDataProvider;

    /**
     * @param EmailAddress $emailAddress
     * @param EmailDataProvider $emailDataProvider
     */
    public function __construct(EmailAddress $emailAddress = null, EmailDataProvider $emailDataProvider = null)
    {
        $this->emailAddress = $emailAddress;
        $this->emailDataProvider = $emailDataProvider;
    }

    /**
     * @return mixed
     */
    abstract public function getResultResponse();

    /**
     * @return string
     */
    abstract public function getValidatorName(): string;

    /**
     * @return EmailAddress
     */
    public function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    /**
     * @return EmailDataProvider
     */
    public function getEmailDataProvider(): EmailDataProvider
    {
        return $this->emailDataProvider;
    }

    /**
     * @param EmailAddress $emailAddress
     * @return $this
     */
    public function setEmailAddress(EmailAddress $emailAddress)
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    /**
     * @param EmailDataProvider|null $emailDataProvider
     * @return $this
     */
    public function setEmailDataProvider($emailDataProvider)
    {
        $this->emailDataProvider = $emailDataProvider;
        return $this;
    }
}