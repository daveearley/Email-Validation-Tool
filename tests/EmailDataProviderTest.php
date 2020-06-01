<?php

namespace EmailValidation\Tests;

use EmailValidation\EmailDataProvider;
use PHPUnit\Framework\TestCase;

class EmailDataProviderTest extends TestCase
{
    private EmailDataProvider $emailDataProvider;

    public function testGetEmailProviders(): void
    {
        $emailProviders = $this->emailDataProvider->getEmailProviders();
        $this->assertIsArray($emailProviders);
        $this->assertContains('gmail.com', $emailProviders);
    }

    public function testGetDisposableEmailProviders(): void
    {
        $emailProviders = $this->emailDataProvider->getDisposableEmailProviders();
        $this->assertIsArray($emailProviders);
        $this->assertContains('banit.club', $emailProviders);
    }

    public function testGetRoleBasesPrefixes(): void
    {
        $prefixes = $this->emailDataProvider->getRoleEmailPrefixes();
        $this->assertIsArray($prefixes);
        $this->assertContains('ceo', $prefixes);
    }

    public function testGetTopLevelDomains(): void
    {
        $tlds = $this->emailDataProvider->getTopLevelDomains();
        $this->assertIsArray($tlds);
        $this->assertContains('aero', $tlds);
    }

    protected function setUp(): void
    {
        $this->emailDataProvider = new EmailDataProvider();
    }
}