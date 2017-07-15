<?php

namespace EmailValidation\Tests;

use EmailValidation\EmailDataProvider;
use PHPUnit\Framework\TestCase;

class EmailDataProviderTest extends TestCase
{
    /** @var EmailDataProvider  */
    private $emailDataProvider;

    protected  function setUp()
    {
        $this->emailDataProvider = new EmailDataProvider();
    }

    public function testGetEmailProviders()
    {
        $emailProviders = $this->emailDataProvider->getEmailProviders();
        $this->assertTrue(is_array($emailProviders));
        $this->assertTrue(in_array('gmail.com', $emailProviders));
    }

    public function testGetDisposableEmailProviders()
    {
        $emailProviders = $this->emailDataProvider->getDisposableEmailProviders();
        $this->assertTrue(is_array($emailProviders));
        $this->assertTrue(in_array('banit.club', $emailProviders));
    }

    public function testGetRoleBasesPrefixes()
    {
        $prefixes = $this->emailDataProvider->getRoleEmailPrefixes();
        $this->assertTrue(is_array($prefixes));
        $this->assertTrue(in_array('ceo', $prefixes));
    }

    public function testGetTopLevelDomains()
    {
        $tlds = $this->emailDataProvider->getTopLevelDomains();
        $this->assertTrue(is_array($tlds));
        $this->assertTrue(in_array('aero', $tlds));
    }
}