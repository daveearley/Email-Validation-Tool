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
     * @param string $emailAddress
     * @param bool $expectedResult
     */
    public function testIsRoleBasesEMail($emailAddress, $expectedResult)
    {
        $roleBasedEmailValidator = new RoleBasedEmailValidator(
            new EmailAddress($emailAddress),
            new EmailDataProvider()
        );

        $this->assertSame($expectedResult, $roleBasedEmailValidator->getResultResponse());
    }

    /**
     * @return array
     */
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