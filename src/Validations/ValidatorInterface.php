<?php

declare(strict_types=1);

namespace EmailValidation\Validations;

interface ValidatorInterface
{
    public function getResultResponse();

    public function getValidatorName(): string;
}