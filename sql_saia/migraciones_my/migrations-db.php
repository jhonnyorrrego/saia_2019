<?php
require_once  __DIR__ . '/../../define.php';

$motores = array(
    "MySql" => "pdo_mysql",
    "Oracle" => "pdo_oci",
    "SqlServer" => "pdo_sqlsrv",
    "MSSql" => "pdo_sqlsrv",
    "Postgres" => "pdo_pgsql"
);

return [
    'dbname' => DB,
    'user' => USER,
    'password' => PASS,
    'host' => HOST,
    'driver' => $motores[MOTOR],
    'port' => PORT];
