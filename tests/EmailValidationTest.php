<?php

namespace EmailValidation\Tests;

use EmailValidation\EmailAddress;
use EmailValidation\EmailDataProvider;
use EmailValidation\EmailValidator;
use EmailValidation\ValidationResults;
use EmailValidation\Validations\MisspelledEmailValidator;
use EmailValidation\Validations\ValidFormatValidator;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class EmailValidationTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    /** @var EmailAddress|MockInterface */
    private $emailMock;

    /** @var ValidationResults|MockInterface */
    private $validationResultsMock;

    /** @var EmailValidator */
    private $emailValidation;

    /** @var EmailDataProvider|MockInterface */
    private $emailDataProviderMock;

    protected function setUp()
    {
        $this->emailMock = Mockery::mock(EmailAddress::class);
        $this->validationResultsMock = Mockery::mock(ValidationResults::class);
        $this->emailDataProviderMock = Mockery::mock(EmailDataProvider::class);
        $this->emailValidation = new EmailValidator(
            $this->emailMock,
            $this->validationResultsMock,
            $this->emailDataProviderMock
        );
    }

    public function testRunValidation()
    {
        $this->validationResultsMock
            ->shouldReceive('addResult')
            ->times(1);

        /** @var MisspelledEmailValidator|MockInterface $mockValidation */
        $mockValidation = Mockery::mock(MisspelledEmailValidator::class);

        $mockValidation->shouldReceive('getValidatorName')->andReturn('hello');
        $mockValidation->shouldReceive('getResultResponse')->andReturn('hello');
        $mockValidation->shouldReceive('setEmailAddress')->andReturnSelf();
        $mockValidation->shouldReceive('setEmailDataProvider')->andReturnSelf();

        $this->emailValidation->registerValidators([$mockValidation]);
        $this->emailValidation->runValidation();
    }

    public function testGetValidationResults()
    {
        $this->validationResultsMock->shouldReceive('addResult')->times(1);
        $this->validationResultsMock->shouldReceive('hasResults')->andReturn(false);
        $this->validationResultsMock->shouldReceive('getValidationResults')->andReturnSelf();
        $this->validationResultsMock->shouldReceive('asArray')->andReturn([
                'valid_email' => true
            ]
        );

        /** @var ValidFormatValidator|MockInterface $mockValidation */
        $mockValidation = Mockery::mock(ValidFormatValidator::class);

        $mockValidation->shouldReceive('getValidatorName')->andReturn('valid_format');
        $mockValidation->shouldReceive('getResultResponse')->andReturn(true);
        $mockValidation->shouldReceive('setEmailAddress')->andReturnSelf();
        $mockValidation->shouldReceive('setEmailDataProvider')->andReturnSelf();

        $this->emailValidation->registerValidator($mockValidation);

        $actual = $this->emailValidation->getValidationResults();
        $this->assertInstanceOf(ValidationResults::class, $actual);
    }
}
