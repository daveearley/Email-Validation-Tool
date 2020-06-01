<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class RoleBasedEmailValidator extends Validator implements ValidatorInterface
{
    public function getValidatorName(): string
    {
        return 'role_or_business_email'; // @codeCoverageIgnore
    }

    public function getResultResponse(): bool
    {
        return in_array(
            $this->getEmailAddress()->getNamePart(),
            $this->getEmailDataProvider()->getRoleEmailPrefixes(),
            true
        );
    }
}