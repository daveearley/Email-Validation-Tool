<?php

declare(strict_types=1);

namespace EmailValidation;

class ValidationResults
{
    private array $results = [];

    public function addResult(string $resultName, $resultValue)
    {
        $this->results[$resultName] = $resultValue;
    }

    public function asArray(): array
    {
        return $this->results;
    }

    public function asJson(): string
    {
        return json_encode($this->results);
    }

    public function hasResults(): bool
    {
        return !empty($this->results);
    }
}