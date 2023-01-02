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
    
}