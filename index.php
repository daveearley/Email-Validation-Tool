<?php

// Include the compose autoload file
use EmailValidation\Validations\GmailValidator;

require __DIR__ . '/vendor/autoload.php';

$validator = EmailValidation\EmailValidatorFactory::create('dave@gmoil.con');



echo $validator->getValidationResults()->asJson();
