<?php
$message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $message = '<b>File:</b> ' . $_FILES['image']['name'] . '<br>';
    $message .= '<b>File:</b> ' . $_FILES['image']['size'] . '<br>';
} else {
    $message = 'Nope';
}

?>
<?= $message ?>
<form action="third.php" method="post" enctype="multipart/form-data">
    <label for="image">Upload file:</label>
    <input type="file" name="image" accept="image/*"><br>
    <input type="submit" value="Upload">
</form>

<?= $_FILES['image']['name']; ?>
<?= $_FILES['image']['tmp_name']; ?>
<?= $_FILES['image']['size']; ?>
<?= $_FILES['image']['type']; ?>
<?= $_FILES['image']['error']; ?>