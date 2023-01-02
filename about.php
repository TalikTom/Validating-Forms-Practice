<?php

$user = ['name' => '', 'age' => '', 'terms' => '',];
$errors = ['name' => '', 'age' => '', 'terms' => '',];
$message = '';

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
        $message = 'Thank you, all your data is valid';
    }

    $user['name'] = filter_var($user['name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $user['age'] = filter_var($user['age'], FILTER_SANITIZE_NUMBER_INT);
}
?>

<?= $message ?>


<form action="about.php" method="POST">
    Name: <input type="text" name="name" value="<?= $user['name']; ?>">
    <span><?= $errors['name'] ;?></span> <br>
    Age: <input type="text" name="age" value="<?= $user['age']; ?>">
    <span><?= $errors['age'] ;?></span> <br>
    <input type="submit" value="Save">
    <input type="checkbox" name="terms" value="true" <?= $user['terms'] ? 'checked' : '' ?>> I agree to the terms and
    conditions
    <span><?= $errors['terms'] ;?></span> <br>
</form>