<?php

$files = glob($path . '{,.}[!.,!..]*',GLOB_MARK|GLOB_BRACE);

$files = array_filter($files, fn($file) => strpos($file, 'cgi-bin') == false);
function removeDirectory($path) {
    $files = glob($path . '{,.}[!.,!..]*',GLOB_MARK|GLOB_BRACE);
    foreach ($files as $file) {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }
    rmdir($path);;
}

foreach($files as $file){ // iterate files
    if ($file != 'wipeFiles.php' && $file != 'unzip.php' && $file != 'cleanup.php') {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }

}
echo "ok\n";

?>
