<?php

require_once '../../define.php';

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

/* por tunel ssh
 return [
 'dbname' => 'saia_release1',
 'user' => 'saia',
 'password' => 'cerok_saia421_5',
 'host' => '127.0.0.1',
 'driver' => 'pdo_mysql',
 'port' => '3307'
 ];
 */
