<?php

$user = ['name' => '', 'age' => '', 'terms' => '',];
$errors = ['name' => '', 'age' => '', 'terms' => '',];
$user = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $validation_filters['name']['filter'] = FILTER_VALIDATE_REGEXP;
    $validation_filters['name']['options']['regexp'] = '/^[A-z]{2,10}$/';
    $validation_filters['age']['filter'] = FILTER_VALIDATE_INT;
    $validation_filters['age']['options']['min_range'] = 16;
    $validation_filters['age']['options']['max_range'] = 65;
    $validation_filters['terms'] = FILTER_VALIDATE_BOOLEAN;

    $user = filter_input_array(INPUT_POST, $validation_filters); //validate data

    //error messages
    $errors['name'] = $user['name'] ? '' : 'Your name must be between 2 and 10 letters using characters A-z';
    $errors['age'] = $user['age'] ? '' : 'Your age must be between 16 and 65';
    $errors['terms'] = $user['terms'] ? '' : 'You must agree to terms and conditions';
    $invalid = implode($errors);

    if ($invalid) {
        $message = 'Please correct the following errors';
    } else {
        $message = 'Thank you';
    }
}