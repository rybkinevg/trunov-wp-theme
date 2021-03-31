<?php

function getDirContents($dir, &$results = array())
{
    $files = scandir($dir);

    foreach ($files as $key => $value) {

        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);

        if (!is_dir($path)) {

            $results[] = $path;
        } else if ($value != "." && $value != "..") {

            getDirContents($path, $results);

            $results[] = $path;
        }
    }

    return $results;
}

$files = getDirContents(dirname(__FILE__));

foreach ($files as $file) {

    $ext = isset(pathinfo(basename($file))['extension']) ? pathinfo(basename($file))['extension'] : null;

    $filename = pathinfo(basename($file))['filename'];

    if ($ext) {

        if ($ext == 'php' && $filename != 'autoload') {

            include($file);
        }
    }
}
