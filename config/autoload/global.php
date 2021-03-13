<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

use Laminas\Session\Container;
use Laminas\Session\Storage\SessionArrayStorage;

return [
    'db' => [
        'driver' => 'Pdo',
        'dsn' => 'mysql:dbname=free_to_lame;host=localhost'
    ],
    'session_containers' => [ Container::class ],
    'session_storage' => [ 'type' => SessionArrayStorage::class ],
    'session_config'  => [],
];
