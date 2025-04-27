<?php
set_time_limit(0);
ini_set('memory_limit', '256M');

$rootDir = $_SERVER['DOCUMENT_ROOT'] ?? dirname(__FILE__);

/**
 * Recursively deletes a directory and all its contents.
 *
 * @param string $dir Path to the directory to delete.
 * @return bool True on success, false on failure.
 */
function deleteDirectory(string $dir): bool
{
    if (!is_dir($dir)) {
        return false;
    }

    $items = scandir($dir);
    if ($items === false) {
        return false;
    }

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $path = $dir . DIRECTORY_SEPARATOR . $item;

        if (is_dir($path)) {
            deleteDirectory($path);
        } else {
            if (!unlink($path)) {
                error_log("Failed to delete file: $path");
            }
        }
    }

    if (!rmdir($dir)) {
        error_log("Failed to remove directory: $dir");
        return false;
    }

    return true;
}

/**
 * Recursively searches for directories named 'cgi-bin' and deletes them.
 *
 * @param string $dir Directory to start searching in.
 */
function findAndDeleteCgiBinDirs(string $dir): void
{
    $items = scandir($dir);
    if ($items === false) {
        error_log("Failed to read directory: $dir");
        return;
    }

    foreach ($items as $item) {
        if ($item === '.' || $item === '..') {
            continue;
        }

        $path = $dir . DIRECTORY_SEPARATOR . $item;

        if (is_dir($path)) {
            if (strcasecmp($item, 'cgi-bin') === 0) {
                echo "Deleting directory: $path\n";

                if (deleteDirectory($path)) {
                    echo "Successfully deleted: $path\n";
                } else {
                    echo "Failed to delete: $path\n";
                }
            } else {
                findAndDeleteCgiBinDirs($path);
            }
        }
    }
}

echo "Starting scan for 'cgi-bin' directories in: $rootDir\n";

findAndDeleteCgiBinDirs($rootDir);

echo "Done.\n";
