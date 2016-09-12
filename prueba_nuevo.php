<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include($ruta_db_superior.'db.php');
include_once($ruta_db_superior."librerias_saia.php");
include_once("pantallas/lib/librerias_cripto.php");
//include_once($ruta_db_superior."workflow/libreria_paso.php");
$numero_usuarios=encrypt_blowfish(60,LLAVE_SAIA_CRYPTO);
//$numero_usuarios=decrypt_blowfish('a3171917621ac77ec05609d8207d0dfb',LLAVE_SAIA_CRYPTO);
echo($numero_usuarios);die();



?>