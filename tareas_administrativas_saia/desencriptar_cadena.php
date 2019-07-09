<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
        if(is_file($ruta . "db.php")) {
                $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
        }
        $ruta .= "../";
        $max_salida--;
}
include_once($ruta_db_superior."define.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
print_r($_REQUEST);
$_POST=$_REQUEST;
$cfg['Servers'][$i]['host'] = 'saia-laboratorio.ct00qljbq3lp.us-east-1.rds.amazonaws.com';

if(@$_REQUEST["cadena"]){
    print_r(desencriptar_sqli("cadena"));
}
print_r($_REQUEST);
