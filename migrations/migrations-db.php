<?php
require_once  '../core/define.php';

$drivers = [
    "MySql" => "pdo_mysql",
    "Oracle" => "oci8",
    "SqlServer" => "pdo_sqlsrv",
    "MSSql" => "sqlsrv",
    "Postgres" => "pdo_pgsql"
];

return [
    'dbname' => DB,
    'user' => USER,
    'password' => PASS,
    'host' => HOST,
    'driver' => $drivers[MOTOR],
    'port' => PORT
];
