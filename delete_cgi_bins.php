<?php
set_time_limit(0);
ini_set('memory_limit', '256M');

$rootDir = $_SERVER['DOCUMENT_ROOT'] ?? dirname(__FILE__);

function deleteDirectory($dir) {
    if (!is_dir($dir)) {
        return false;
    }

    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $path = $dir . DIRECTORY_SEPARATOR . $item;

        if (is_dir($path)) {
            deleteDirectory($path);
        } else {
            unlink($path);
        }
    }

    rmdir($dir);
    return true;
}

function findAndDeleteCgiBinDirs($dir) {
    $items = scandir($dir);
    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $path = $dir . DIRECTORY_SEPARATOR . $item;

        if (is_dir($path)) {
            if (strcasecmp($item, 'cgi-bin') === 0) {
                echo "Deleting directory: $path\n";
                deleteDirectory($path);
            } else {
                findAndDeleteCgiBinDirs($path);
            }
        }
    }
}

echo "Scanning for 'cgi-bin' directories in: $rootDir\n";
findAndDeleteCgiBinDirs($rootDir);
echo "Done.\n";
