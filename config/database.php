


<?php
$dbUrl = parse_url(getenv("DATABASE_URL"));
$db = isset($dbUrl["path"]) ? ltrim($dbUrl["path"], '/') : 'forge';

return [

    // …
    'default' => env('DB_CONNECTION', 'pgsql'),

    'connections' => [
      'pgsql' => [
        'driver' => 'pgsql',
        'host' => isset($dbUrl['host']) ? $dbUrl['host'] : env('DB_HOST', '127.0.0.1'),
        'port' => isset($dbUrl['port']) ? $dbUrl['port'] : env('DB_PORT', '5432'),
        'database' =>  env('DB_DATABASE', $db),
        'username' => isset($dbUrl["user"]) ? $dbUrl["user"] : env('DB_USERNAME', 'forge'),
        'password' => isset($dbUrl["pass"]) ? $dbUrl["pass"] : env('DB_PASSWORD', ''),
        'charset' => 'utf8',
        'prefix' => '',
        'schema' => 'public',
        'sslmode' => 'prefer',
      ]

    ],
    'migrations' => 'migrations',
    // …

];
