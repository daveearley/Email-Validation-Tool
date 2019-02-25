<?php

declare(strict_types=1);

namespace EmailValidation;

class EmailDataProvider implements EmailDataProviderInterface
{
    const EMAIL_PROVIDERS = __DIR__ . '/data/email-providers.php';
    const TOP_LEVEL_DOMAINS = __DIR__ . '/data/top-level-domains.php';
    const ROLE_BASED_EMAIL_PREFIXES = __DIR__ . '/data/role-based-email-prefixes.php';

    protected $disposable_email_providers = null;

    /**
     * {@inheritdoc}
     */
    public function getEmailProviders(): array
    {
        return include self::EMAIL_PROVIDERS;
    }

    /**
     * {@inheritdoc}
     */
    public function getTopLevelDomains(): array
    {
        return include self::TOP_LEVEL_DOMAINS;
    }

    /**
     * {@inheritdoc}
     */
    public function getDisposableEmailProviders(): array
    {
        if (null == $this->disposable_email_providers) {
            // load index with known disposable email providers
            $index = \file_get_contents(__DIR__.'/../vendor/ivolo/disposable-email-domains/index.json');

            $this->disposable_email_providers = \json_decode($index, true);
        }

        return $this->disposable_email_providers;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoleEmailPrefixes(): array
    {
        return include self::ROLE_BASED_EMAIL_PREFIXES;
    }
}
