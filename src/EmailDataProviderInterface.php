<?php

namespace EmailValidation;

interface EmailDataProviderInterface
{
    /**
     * @return array
     */
    public function getEmailProviders(): array;

    /**
     * @return array
     */
    public function getTopLevelDomains(): array;

    /**
     * @return array
     */
    public function getDisposableEmailProviders(): array;

    /**
     * @return array
     */
    public function getRoleEmailPrefixes(): array;
}