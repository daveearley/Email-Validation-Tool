<?php

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

    /**
     * @param EmailAddress $emailAddress
     * @param ValidationResults $validationResults
     */
    public function __construct(EmailAddress $emailAddress, ValidationResults $validationResults)
    {
        $this->emailAddress = $emailAddress;
        $this->validationResults = $validationResults;
    }

    /**
     * @param Validator $validator
     * @return self
     */
    public function registerValidator(Validator $validator): EmailValidator
    {
        $this->registeredValidators[] = $validator;
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
    public function runValidation(): void
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
}