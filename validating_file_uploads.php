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

?>