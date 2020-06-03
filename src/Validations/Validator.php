<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\EmailDataProviderInterface;

abstract class Validator
{
    private ?EmailAddress $emailAddress;

    private ?EmailDataProviderInterface $emailDataProvider;

    public function __construct(EmailAddress $emailAddress = null, EmailDataProviderInterface $emailDataProvider = null)
    {
        $this->emailAddress = $emailAddress;
        $this->emailDataProvider = $emailDataProvider;
    }

    public function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    public function setEmailAddress(EmailAddress $emailAddress): Validator
    {
        $this->emailAddress = $emailAddress;
        return $this;
    }

    public function getEmailDataProvider(): EmailDataProviderInterface
    {
        return $this->emailDataProvider;
    }

    public function setEmailDataProvider(EmailDataProviderInterface $emailDataProvider): Validator
    {
        $this->emailDataProvider = $emailDataProvider;
        return $this;
    }
}