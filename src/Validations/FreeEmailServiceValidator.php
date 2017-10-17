<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class FreeEmailServiceValidator extends Validator implements ValidatorInterface
{
    /**
     * @return string
     */
    public function getValidatorName(): string
    {
        return 'free_email_provider'; //@codeCoverageIgnore
    }

    /**
     * @return mixed
     */
    public function getResultResponse()
    {
        return in_array(
            $this->getEmailAddress()->getHostPart(),
            $this->getEmailDataProvider()->getEmailProviders()
        );
    }
}