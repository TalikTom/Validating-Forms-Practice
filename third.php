<?php
$message = '';

$moved = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_FILES['image']['error'] === 0) {

        $temp = $_FILES['image']['tmp_name'];
        $message = '<b>File:</b> ' . $_FILES['image']['name'] . '<br>';
        $message .= '<b>File:</b> ' . $_FILES['image']['size'] . '<br>';
        $path = 'uploads/' . $_FILES['image']['name'];
        $moved = move_uploaded_file($temp, $path);
        if ($moved === true) {
            $message = 'img src="' . $path . '">';
        } else {
            $message = 'This file could not be saved';
        }
    } else {
        $message = 'Nope';
    }
}



$destination = '../uploads/' . $_FILES['image']['name'];

?>
<?= $message ?>
<form action="third.php" method="post" enctype="multipart/form-data">
    <label for="image">Upload file:</label>
    <input type="file" name="image" accept="image/*"><br>
    <input type="submit" value="Upload">
</form>
<?= $temp; ?>
<?= $_FILES['image']['name'] . '<br>'; ?>
<?= $_FILES['image']['tmp_name']. '<br>'; ?>
<?= $_FILES['image']['size']. '<br>' ;?>
<?= $_FILES['image']['type']. '<br>'; ?>
<?= $_FILES['image']['error']. '<br>'; ?>