<?php

$file = getcwd() . '/files/test_file.txt' or die('Could not open file');

$fh = fopen($file, 'r') or die('Could not open file');

$data = fread($fh, filesize($file)) or die('Could not read file!');

fclose($fh);

echo $data;
echo 'File size: ' . filesize($file) . ';';
echo 'File owner: ' . fileowner($file) . ';';
echo 'File group: ' . filegroup($file) . ';';
echo 'File permissions ' . fileperms($file) . ';';
echo 'File type: ' . filetype($file) . ';';
echo 'File last accessed on: ' . date('Y-m-d', fileatime($file)) . ';';
echo 'File last modified on: ' . date('Y-m-d', filemtime($file)) . ';'

?>