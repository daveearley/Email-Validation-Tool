<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class DisposableEmailValidator extends Validator implements ValidatorInterface
{
    public function getValidatorName(): string
    {
        return 'disposable_email_provider'; // @codeCoverageIgnore
    }

    public function getResultResponse(): bool
    {
        return in_array(
            $this->getEmailAddress()->getHostPart(),
            $this->getEmailDataProvider()->getDisposableEmailProviders(),
            true
        );
    }
}