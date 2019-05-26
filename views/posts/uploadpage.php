<?php
print_r($_FILES).PHP_EOL;
const InputKey = 'file';
const AllowedTypes = ['image/png'];

if (empty($_FILES[InputKey]['name'])){
    die ("File Missing!");
}

if ($_FILES[InputKey]['error'] > 0){
    die ("Handle error");
}

if (!in_array($_FILES[InputKey]['type'], AllowedTypes)){
    die ("File type not allowed!");
}
$tmpfile =  $_FILES[InputKey]['tmp_name'];
$dstfile = 'C:\xampp\htdocs\Pellag\views\images\Uploads'.$_FILES[InputKey]['name'];

if (!move_uploaded_file($tmpfile, $dstfile)){
    die ('Handle error');
}

if (file_exists($tmpfile)){
    unlink($tmp);
}

