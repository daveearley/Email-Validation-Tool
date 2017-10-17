<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

interface ValidatorInterface
{
    /**
     * @return mixed
     */
    public function getResultResponse();

    /**
     * @return string
     */
    public function getValidatorName(): string;
}