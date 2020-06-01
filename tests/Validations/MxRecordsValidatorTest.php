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
        $this->mxValidator->shouldReceive('checkDns')->with('dave@gmail.com', 'MX');
        $this->mxValidator->getResultResponse();
    }

    protected function setUp(): void
    {
        $this->mxValidator = Mockery::mock(MxRecordsValidator::class, [
            new EmailAddress('dave@gmail.com'),
        ])
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();
    }
}