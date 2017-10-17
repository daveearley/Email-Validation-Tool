<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class DisposableEmailValidator extends Validator implements ValidatorInterface
{
    /**
     * @return string
     */
    public function getValidatorName(): string
    {
        return 'disposable_email_provider'; // @codeCoverageIgnore
    }

    /**
     * @return bool
     */
    public function getResultResponse()
    {
        return in_array(
            $this->getEmailAddress()->getHostPart(),
            $this->getEmailDataProvider()->getDisposableEmailProviders()
        );
    }
}