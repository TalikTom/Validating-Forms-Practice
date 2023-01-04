<?php

$dsn = "mysql:host=localhost;port=3306;dbname=edunovapp26;user=root;charset=utf8mb4";

$pdo = new PDO($dsn);

$statement = $pdo->prepare("select * from osoba");

$statement->execute();

$osobe = $statement->fetchAll(PDO::FETCH_ASSOC);
class Person
{
    public string $name;
    public int $age;

    function __construct(string $name, int $age) {
        $this->name = $name;
        $this->age = $age;
    }
}

$moved = false;
$message = '';
$error = '';
$upload_path = 'uploads/';
$max_size = 5242880;
$allowed_types = ['image/jpeg', 'image/png', 'image/gif',];
$allowed_exts = ['jpeg', 'jpg', 'png', 'gif',];

function create_filename($filename, $upload_path) 
{
    $basename = pathinfo($filename, PATHINFO_FILENAME);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $basename = preg_replace('/[^A-z0-9]/', '-', $basename);
    $i = 0;
    while(file_exists($upload_path . $filename)) {
        $i = $i + 1;
        $filename = $basename . $i . '.' . $extension;
    }

    return $filename;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = ($_FILES['image']['size'] === 1) ? 'too big ' : '';
    
    if ($_FILES['image']['error'] == 0) {
        
        $error .= ($_FILES['image']['size'] <= $max_size) ? '' : 'too big ';

        $type = mime_content_type($_FILES['image']['tmp_name']);
        $error .= in_array($type, $allowed_types) ? '' : 'wrong type';

        $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
        $error .= in_array($ext, $allowed_exts) ? '' : 'wrong file extension';

        if(!$error) {
            $filename = create_filename($_FILES['image']['name'], $upload_path);
            $destination = $upload_path . $filename;
            $moved = move_uploaded_file($_FILES['image']['tmp_name'], $destination);
        }
    }

    if($moved === true) {
        $message = 'Uploaded:<br><img src="' . $destination . '">'; 
    } else {
        $message = '<b>Could not upload file:</b> ' . $error;
    }
}

$man = new Person('marko', 23);
?>

<?= var_dump($man); ?>
<?= var_dump($man->age); ?>

<?= $message ?>
<form action="validating_file_uploads.php" method="post" enctype="multipart/form-data">
    <label for="image">Upload file:</label>
    <input type="file" name="image" accept="image/*"><br>
    <input type="submit" value="Upload">
</form>


<?php
foreach ($osobe as $osoba) {
    echo "<li>" . $osoba['ime'] . ' ' . $osoba['prezime'] . "</li>";
}

?>