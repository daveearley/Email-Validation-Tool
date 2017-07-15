<?php

namespace EmailValidation\Tests\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\EmailDataProvider;
use EmailValidation\Validations\MisspelledEmailValidator;
use PHPUnit\Framework\TestCase;

class MisspelledEmailValidatorTest extends TestCase
{
    /**
     * @dataProvider emailsDataProvider
     */
    public function testIsEmailAProvider($emailAddress, $expectedResult)
    {
        $misspelledEmailValidator = new MisspelledEmailValidator(
            new EmailAddress($emailAddress),
            new EmailDataProvider()
        );

        $this->assertSame($expectedResult, $misspelledEmailValidator->getResultResponse());
    }

    public function emailsDataProvider()
    {
        return [
            ['dave@gmail.con', 'dave@gmail.com'],
            ['dave@gmaal.com', 'dave@gmail.com'],
            ['dave@gmail.xom', 'dave@gmail.com'],
            ['dave@yahoo.oe', 'dave@yahoo.de'],
            ['dave@a-made-up-domain.infi', 'dave@a-made-up-domain.info'],
            ['info@iroland.cim', 'info@ireland.com'],
            ['info@gmail.com', '']
        ];
    }
}