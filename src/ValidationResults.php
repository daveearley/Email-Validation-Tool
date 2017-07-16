<?php

declare(strict_types=1);

namespace EmailValidation;

class ValidationResults
{
    /** @var array */
    private $results = array();

    /**
     * @param string $resultName
     * @param mixed $resultValue
     */
    public function addResult(string $resultName, $resultValue)
    {
        $this->results[$resultName] = $resultValue;
    }

    /**
     * @return array
     */
    public function asArray(): array
    {
        return $this->results;
    }

    /**
     * @return string
     */
    public function asJson(): string
    {
        return json_encode($this->results);
    }

    /**
     * @return bool
     */
    public function hasResults(): bool
    {
        return !empty($this->results);
    }
}