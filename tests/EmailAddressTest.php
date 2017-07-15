<?php

namespace EmailValidation\Tests;

use EmailValidation\EmailAddress;
use PHPUnit\Framework\TestCase;

class EmailAddressTest extends TestCase
{
    const VALID_TEST_EMAIL = 'dave@gmail.com';
    const INVALID_TEST_EMAIL = 'dave----gmail.com';

    /** @var EmailAddress */
    private $validEmail;

    /** @var EmailAddress */
    private $invalidEmail;

    protected function setUp()
    {
        $this->validEmail = new EmailAddress(self::VALID_TEST_EMAIL);
        $this->invalidEmail = new EmailAddress(self::INVALID_TEST_EMAIL);
    }

    public function testAsString()
    {
        $this->assertSame(self::VALID_TEST_EMAIL, $this->validEmail->asString());
    }

    public function testGetHostPart()
    {
        $this->assertSame('gmail.com', $this->validEmail->getHostPart());
    }

    public function testGetTldPart()
    {
        $this->assertSame('com', $this->validEmail->getTopLevelDomainPart());
    }

    public function testGetNamePart()
    {
        $this->assertSame('dave', $this->validEmail->getNamePart());
    }

    public function testGetHostPartForInvalidEmail()
    {
        $this->assertSame(null, $this->invalidEmail->getHostPart());
    }

    public function testGetTldPartForInvalidEmail()
    {
        $this->assertSame(null, $this->invalidEmail->getTopLevelDomainPart());
    }

    public function testGetNamePartForInvalidEmail()
    {
        $this->assertSame(null, $this->invalidEmail->getNamePart());
    }

    public function testIsValidFormat()
    {
        $this->assertTrue($this->validEmail->isValidEmailAddressFormat());
    }

    public function testIsValidFormatForInvalidEmail()
    {
        $this->assertFalse($this->invalidEmail->isValidEmailAddressFormat());
    }
}