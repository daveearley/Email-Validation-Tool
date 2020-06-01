<?php

declare(strict_types=1);

namespace EmailValidation;

class EmailDataProvider implements EmailDataProviderInterface
{
    private const EMAIL_PROVIDERS = __DIR__ . '/data/email-providers.php';
    private const TOP_LEVEL_DOMAINS = __DIR__ . '/data/top-level-domains.php';
    private const DISPOSABLE_EMAIL_PROVIDERS = __DIR__ . '/data/disposable-email-providers.php';
    private const ROLE_BASED_EMAIL_PREFIXES = __DIR__ . '/data/role-based-email-prefixes.php';

    public function getEmailProviders(): array
    {
        return include self::EMAIL_PROVIDERS;
    }

    public function getTopLevelDomains(): array
    {
        return include self::TOP_LEVEL_DOMAINS;
    }

    public function getDisposableEmailProviders(): array
    {
        return include self::DISPOSABLE_EMAIL_PROVIDERS;
    }

    public function getRoleEmailPrefixes(): array
    {
        return include self::ROLE_BASED_EMAIL_PREFIXES;
    }
}