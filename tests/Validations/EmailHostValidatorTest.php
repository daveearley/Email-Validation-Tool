<?php

namespace EmailValidation\Tests\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\Validations\EmailHostValidator;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class EmailHostValidatorTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var EmailHostValidator|Mockery\MockInterface $hostValidator */
    private $hostValidator;

    protected function setUp()
    {
        $this->hostValidator = Mockery::mock(EmailHostValidator::class, [
            new EmailAddress('dave@gmail.com'),
        ])
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();
    }

    public function testHostIsChecked()
    {
        $this->hostValidator->shouldReceive('getHostByName')->with('gmail.com');
        $this->hostValidator->getResultResponse();
    }
}