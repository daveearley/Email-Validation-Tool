<?php

use EmailValidation\EmailValidatorFactory;

require __DIR__ . '/../vendor/autoload.php';

$validator = EmailValidatorFactory::create($_REQUEST['email']);

var_dump($validator->getValidationResults()->asJson());
