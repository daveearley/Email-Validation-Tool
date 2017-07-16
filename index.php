<?php

use EmailValidation\EmailValidatorFactory;

require __DIR__ . '/vendor/autoload.php';

$validator = EmailValidatorFactory::create($_REQUEST['email'] ?: '');

header('Content-Type: application/json');
echo $validator->getValidationResults()->asJson();
