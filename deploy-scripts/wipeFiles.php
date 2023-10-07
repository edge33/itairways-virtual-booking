<?php

$files = glob($path . '{,.}[!.,!..]*',GLOB_MARK|GLOB_BRACE);

$files = array_filter($files, fn($file) => strpos($file, 'cgi-bin') == false);
$filesToExclude = ['wipeFiles.php', 'unzip.php', 'cleanup.php', "config-inc.php", "banner.html", "briefing.html", ".htaccess"];
function removeDirectory($path) {
    $files = glob($path . '{,.}[!.,!..]*',GLOB_MARK|GLOB_BRACE);
    foreach ($files as $file) {
        if (!in_array($file, $filesToExclude)) {
            is_dir($file) ? removeDirectory($file) : unlink($file);
        }
    }
    rmdir($path);;
}

foreach($files as $file){ // iterate files
    if (!in_array($file, $filesToExclude)) {
        is_dir($file) ? removeDirectory($file) : unlink($file);
    }    
}
echo "ok\n";

?>
