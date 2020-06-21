<?php

namespace EmailValidation\Tests\Validations;

use EmailValidation\EmailAddress;
use EmailValidation\Validations\MxRecordsValidator;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

class MxRecordsValidatorTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    private MxRecordsValidator $mxValidator;

    public function testMxRecordIsChecked(): void
    {
        foreach (['MX', 'AAAA', 'NS', 'A'] as $dns) {
            $this->mxValidator
                ->shouldReceive('checkDns')
                ->with('gmail.com.', $dns);
        }

        $this->mxValidator->getResultResponse();
    }

    protected function setUp(): void
    {
        $this->mxValidator = Mockery::mock(MxRecordsValidator::class, [
            new EmailAddress('dave@gmail.com'),
        ])
            ->shouldAllowMockingProtectedMethods()
            ->shouldReceive('getResultResponse')
            ->passthru()
            ->getMock()
            ->shouldReceive('getEmailAddress')
            ->passthru()
            ->getMock();
    }
}