<?php
ini_set('max_execution_time', 0);


$dir = $_POST['dir'];
$file = $_POST['file'];

function unzip ($dir, $file) {
    $zip = new ZipArchive;
    if ($zip->open("$dir/$file") === TRUE) {
        $zip->extractTo($dir);
        $zip->close();
        echo "ok\n";
    } else {
        echo "failed\n";
    }
    unlink("$dir/$file");
}

unzip($dir, $file);

?>
