<?php

namespace EmailValidation\Tests;

use EmailValidation\ValidationResults;
use PHPUnit\Framework\TestCase;

class ValidationResultsTest extends TestCase
{
    /** @var ValidationResults */
    private $validationResults;

    protected function setUp()
    {
        $this->validationResults = new ValidationResults();
    }

    public function testAddResult()
    {
        $this->validationResults->addResult('a-key', 'a-value');
        $actual = $this->validationResults->asArray();
        $expected = [
            'a-key' => 'a-value'
        ];

        $this->assertSame($expected, $actual);
    }

    public function testReturnsJson()
    {
        $this->validationResults->addResult('a-key', 'a-value');
        $actual = $this->validationResults->asJson();
        $expected = json_encode([
            'a-key' => 'a-value'
        ]);

        $this->assertSame($expected, $actual);
    }

    public function testHasResults()
    {
        $validationResults = new ValidationResults();
        $this->assertFalse($validationResults->hasResults());

        $validationResults->addResult('a-key', 'a-value');
        $this->assertTrue($validationResults->hasResults());
    }
}