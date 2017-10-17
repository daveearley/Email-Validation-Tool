<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\EmailDataProvider;
use EmailValidation\EmailDataProviderInterface;

abstract class Validator
{
    /** @var EmailAddress */
    private $emailAddress;

    /** @var EmailDataProvider|null */
    private $emailDataProvider;

    /**
     * @param EmailAddress $emailAddress
     * @param EmailDataProviderInterface $emailDataProvider
     */
    public function __construct(EmailAddress $emailAddress = null, EmailDataProviderInterface $emailDataProvider = null)
    {
        $this->emailAddress = $emailAddress;
        $this->emailDataProvider = $emailDataProvider;
    }

    /**
     * @return EmailAddress
     */
    public function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    /**
     * @return EmailDataProviderInterface
     */
    public function getEmailDataProvider(): EmailDataProviderInterface
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
     * @param EmailDataProviderInterface|null $emailDataProvider
     * @return $this
     */
    public function setEmailDataProvider(EmailDataProviderInterface $emailDataProvider)
    {
        $this->emailDataProvider = $emailDataProvider;
        return $this;
    }
}