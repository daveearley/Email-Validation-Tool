<?php

declare(strict_types=1);

namespace EmailValidation;

use EmailValidation\Validations\Validator;

class EmailValidator
{
    private EmailAddress $emailAddress;

    /** @var Validator[] */
    private array $registeredValidators = [];

    private ValidationResults $validationResults;

    private EmailDataProviderInterface $emailDataProvider;

    public function __construct(
        EmailAddress $emailAddress,
        ValidationResults $validationResults,
        EmailDataProviderInterface $emailDataProvider
    )
    {
        $this->emailAddress = $emailAddress;
        $this->validationResults = $validationResults;
        $this->emailDataProvider = $emailDataProvider;
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

    public function registerValidator(Validator $validator): EmailValidator
    {
        $this->registeredValidators[] = $validator
            ->setEmailAddress($this->getEmailAddress())
            ->setEmailDataProvider($this->getEmailDataProvider());
        return $this;
    }

    private function getEmailAddress(): EmailAddress
    {
        return $this->emailAddress;
    }

    private function getEmailDataProvider(): EmailDataProviderInterface
    {
        return $this->emailDataProvider;
    }

    public function getValidationResults(): ValidationResults
    {
        if (!$this->validationResults->hasResults()) {
            $this->runValidation();
        }
        return $this->validationResults;
    }

    public function runValidation(): void
    {
        foreach ($this->registeredValidators as $validator) {
            $this->validationResults->addResult($validator->getValidatorName(), $validator->getResultResponse());
        }
    }
}