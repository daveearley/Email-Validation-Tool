<?php

declare(strict_types=1);

namespace EmailValidation;

use EmailValidation\Validations\Validator;

class EmailValidator
{
    /** @var EmailAddress */
    private $emailAddress;

    /** @var Validator[] */
    private $registeredValidators = array();

    /** @var ValidationResults */
    private $validationResults;

    /** @var EmailDataProviderInterface */
    private $emailDataProvider;

    /**
     * @param EmailAddress $emailAddress
     * @param ValidationResults $validationResults
     * @param EmailDataProviderInterface $emailDataProvider
     */
    public function __construct(
        EmailAddress $emailAddress,
        ValidationResults $validationResults,
        EmailDataProviderInterface $emailDataProvider
    ) {
        $this->emailAddress = $emailAddress;
        $this->validationResults = $validationResults;
        $this->emailDataProvider = $emailDataProvider;
    }


    /**
     * @param Validator $validator
     * @return self
     */
    public function registerValidator(Validator $validator): EmailValidator
    {
        $this->registeredValidators[] = $validator
            ->setEmailAddress($this->getEmailAddress())
            ->setEmailDataProvider($this->getEmailDataProvider());
        return $this;
    }

    /**
     * @param Validator[] $validators
     * @return self
     */
    public function registerValidators(array $validators): EmailValidator
    {
        foreach ($validators as $validator) {
            $this->registerValidator($validator);
        }
        return $this;
    }

    /**
     * @return void
     */
    public function runValidation()
    {
        foreach ($this->registeredValidators as $validator) {
            $this->validationResults->addResult($validator->getValidatorName(), $validator->getResultResponse());
        }
    }

    /**
     * @return ValidationResults
     */
    public function getValidationResults(): ValidationResults
    {
        if (!$this->validationResults->hasResults()) {
            $this->runValidation();
        }
        return $this->validationResults;
    }

    /**
     * @return EmailAddress
     */
    private function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    /**
     * @return EmailDataProviderInterface
     */
    private function getEmailDataProvider(): EmailDataProviderInterface
    {
        return $this->emailDataProvider;
    }
}