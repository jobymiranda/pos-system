<?php

use CodeIgniter\Boot;
use Config\Paths;

$minPhpVersion = '8.2';

if (version_compare(PHP_VERSION, $minPhpVersion, '<')) {
    http_response_code(503);
    echo 'PHP 8.2 or newer is required.';
    exit(1);
}

define(
    'FCPATH',
    dirname(__DIR__) . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR
);

if (getcwd() . DIRECTORY_SEPARATOR !== FCPATH) {
    chdir(FCPATH);
}

require dirname(__DIR__)
    . DIRECTORY_SEPARATOR
    . 'app'
    . DIRECTORY_SEPARATOR
    . 'Config'
    . DIRECTORY_SEPARATOR
    . 'Paths.php';

$paths = new Paths();

$paths->writableDirectory = rtrim(
    sys_get_temp_dir(),
    DIRECTORY_SEPARATOR
) . DIRECTORY_SEPARATOR . 'casaforma-writable';

foreach (['cache', 'debugbar', 'logs', 'session', 'uploads'] as $folder) {
    $directory = $paths->writableDirectory
        . DIRECTORY_SEPARATOR
        . $folder;

    if (! is_dir($directory)) {
        mkdir($directory, 0755, true);
    }
}

require $paths->systemDirectory . '/Boot.php';

exit(Boot::bootWeb($paths));