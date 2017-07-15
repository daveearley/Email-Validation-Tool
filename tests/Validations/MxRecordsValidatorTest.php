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

    /** @var MxRecordsValidator|Mockery\MockInterface $mxValidator */
    private $mxValidator;

    protected function setUp()
    {
        $this->mxValidator = Mockery::mock(MxRecordsValidator::class, [
            new EmailAddress('dave@gmail.com'),
        ])
            ->shouldAllowMockingProtectedMethods()
            ->makePartial();
    }

    public function testMxRecordIsChecked()
    {
        $this->mxValidator->shouldReceive('checkDns')->with('dave@gmail.com', 'MX');
        $this->mxValidator->getResultResponse();
    }
}