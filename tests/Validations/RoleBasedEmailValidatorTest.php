<?php

namespace EmailValidation\Tests\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\EmailDataProvider;
use EmailValidation\Validations\RoleBasedEmailValidator;
use PHPUnit\Framework\TestCase;

class RoleBasedEmailValidatorTest extends TestCase
{
    /**
     * @dataProvider rolesDataProvider
     */
    public function testIsRoleBasesEMail(string $emailAddress, bool $expectedResult): void
    {
        $roleBasedEmailValidator = new RoleBasedEmailValidator(
            new EmailAddress($emailAddress),
            new EmailDataProvider()
        );

        $this->assertSame($expectedResult, $roleBasedEmailValidator->getResultResponse());
    }

    public function rolesDataProvider(): array
    {
        return [
            ['info@email.com', true],
            ['support@yahoo.com', true],
            ['contact@hotmail.com', true],
            ['accounts@apple.com', true],
            ['brian.mcgee@something.com', false],
            ['john.johnson@anonfreeemailservice.com', false],
            ['somerandom.name@reddit.com', false],
        ];
    }
}