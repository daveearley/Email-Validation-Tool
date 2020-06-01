<?php

namespace EmailValidation;

interface EmailDataProviderInterface
{
    public function getEmailProviders(): array;

    public function getTopLevelDomains(): array;

    public function getDisposableEmailProviders(): array;

    public function getRoleEmailPrefixes(): array;
}