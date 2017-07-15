<?php

namespace EmailValidation\Tests;

use EmailValidation\EmailValidator;
use EmailValidation\EmailValidatorFactory;
use PHPUnit\Framework\TestCase;

class EmailValidatorFactoryTest extends TestCase
{
    public function testFactoryReturnsCorrectType()
    {
        $emailValidator = EmailValidatorFactory::create('dave@gmail.com');
        $this->assertInstanceOf(EmailValidator::class, $emailValidator);
    }
}