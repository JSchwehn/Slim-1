<?php

$_cfg = [
    'app.name' => '<App Name>',
    'db.host' => 'localhost',
    'db.user' => '<user>',
    'db.pass' => '',
    'db.name' => '<dbname>',
    'db.charset' => 'utf8mb4',
    'cookies.secret_key' => 'sdf43rsfdg43453edrfv fvxsfdc',
    'debug' => true,
    'templates.path' => '../templates/'
];

$_dev_cfg = [];

if ('development' === $environment && (file_exists(__DIR__ . "/config.dev.php") && is_readable(__DIR__ . "/config.dev.php"))) {
    $_dev_cfg = require __DIR__ . "/config.dev.php";
}

return array_merge($_cfg, $_dev_cfg);