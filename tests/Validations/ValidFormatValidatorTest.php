<?php

namespace EmailValidation\Tests\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\Validations\ValidFormatValidator;
use PHPUnit\Framework\TestCase;

class ValidFormatValidatorTest extends TestCase
{
    /**
     * @dataProvider emailsDataProvider
     * @param mixed $emailAddress
     * @param bool $expectedResult
     */
    public function testIsValidFormat($emailAddress, bool $expectedResult): void
    {
        $disposableEmailValidation = new ValidFormatValidator(
            new EmailAddress($emailAddress)
        );

        $this->assertSame($expectedResult, $disposableEmailValidation->getResultResponse());
    }

    public function emailsDataProvider(): array
    {
        return [
            ['dave@gmail.com', true],
            ['dave.earley@yahoo.com', true],
            ['dave@something.ie', true],
            ['john.doe@buy.tickets', true],
            ['firstname+lastname@example.com', true],
            ['firstname-lastname@[127.0.0.1]', true],
            ['_______@example.com', true],
            ['someone@example.com.com.jp', true],
            ['dave', false],
            ['172.123.2.4', false],
            ['hello', false],
            [true, false],
            [12, false],
            [-99, false],
        ];
    }
}