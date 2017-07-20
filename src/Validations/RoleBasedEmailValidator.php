<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

class RoleBasedEmailValidator extends Validator
{
    /**
     * @return string
     */
    public function getValidatorName(): string
    {
        return 'role_or_business_email'; // @codeCoverageIgnore
    }

    /**
     * @return bool
     */
    public function getResultResponse(): bool
    {
        return in_array(
            $this->getEmailAddress()->getNamePart(),
            $this->getEmailDataProvider()->getRoleEmailPrefixes()
        );
    }
}
