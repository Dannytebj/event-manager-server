<?php

$url = parse_url(getenv("DATABASE_URL"));

$host = $url["host"];
$username = $url["user"];
$password = $url["pass"];
$database = substr($url["path"], 1);

return [
    ...
    'connections' => [
        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', $host),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', $database),
            'username' => env('DB_USERNAME', $username),
            'password' => env('DB_PASSWORD', $password),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ],
