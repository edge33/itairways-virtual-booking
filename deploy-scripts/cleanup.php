<?php

$basePath = './';
$files = [$basePath . 'app.zip', 'cleanup.php', 'unzip.php', 'wipeFiles.php'];

function removeDirectory($path)
{
    $files = glob($path . '/*');
    foreach ($files as $file) {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }
    rmdir($path);;
}

foreach ($files as $file) { // iterate files
    // if ($file != 'vendor') {
    is_dir($file) ? removeDirectory($file) : unlink($file);
    // }

}
echo "ok\n";

?>
