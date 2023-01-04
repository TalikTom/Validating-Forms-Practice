<?php

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
    $basename = preg_replace('/[^A-z0-9]', '-', $basename);
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
    }
}

?>