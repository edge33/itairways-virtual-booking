<?php

$files = glob('./*'); // get all file names

$files = array_filter($files, fn($file) => strpos($file, 'cgi-bin') == false);
function removeDirectory($path) {
    $files = glob($path . '/*');
    foreach ($files as $file) {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }
    rmdir($path);;
}

foreach($files as $file){ // iterate files
    // if ($file != 'vendor') {
    is_dir($file) ? removeDirectory($file) : unlink($file);
    // }

}
echo "ok\n";

?>
