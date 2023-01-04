<?php

declare (strict_types = 1);

require 'includes/functions.php';

$user =
    [
    'name' => '',
    'age' => '',
    'terms' => '',
];

$errors =
    [
    'name' => '',
    'age' => '',
    'terms' => '',
];

$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user['name'] = $_POST['name'];
    $user['age'] = $_POST['age'];
    $user['terms'] = (isset($_POST['terms']) and $_POST['terms'] == true) ? true : false;

    $errors['name'] = is_text($user['name'], 2, 20) ? '' : 'Your username must be between 2 and 20 characters';
    $errors['age'] = is_number($user['age'], 18, 65) ? '' : 'Your age must be between 18 and 65 characters';
    $errors['terms'] = $user['terms'] ? '' : 'You must agree to the terms and conditions';

    $invalid = implode($errors);
    if ($invalid) {
        $message = 'Please correct the following errors:';
    } else {
        $message = 'Your data was valid';
    }
}

?>

<?=$message?>



<form action="/" method="POST">

    Name:<input type="text" name="name" value="<?=htmlspecialchars($user['name'])?>"><span
        class="error"><?=$errors['name']?></span><br>
    Age:<input type="text" name="age" value="<?=htmlspecialchars($user['age'])?>"><span
        class="error"><?=$errors['age']?></span><br>
    <input type="checkbox" name="terms" value="true" <?=$user['terms'] ? 'checked' : ''?>><br>
    I agree to the terms and conditions
    <span class="error"></span><br>
    <input type="submit" value="Save"><br>


</form>