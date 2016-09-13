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
//$numero_usuarios=encrypt_blowfish(59,LLAVE_SAIA_CRYPTO);
//$numero_usuarios=decrypt_blowfish('a3171917621ac77ec05609d8207d0dfb',LLAVE_SAIA_CRYPTO);
//echo($numero_usuarios);die();
    /*
	 * cerok 			 1
	 * radicador_salida	 2
	 * mensajero 		 9
	 * radicador_web 	 111222333
  */
 	$funcionarios=busca_filtro_tabla("","funcionario a","a.estado=1 AND lower(a.login) NOT IN ('cerok','radicador_salida','mensajero','radicador_web')","",$conn);
	$reemplazos=busca_filtro_tabla("","reemplazo_saia b","b.estado=1","",$conn);
	$funcionarios_activos=$funcionarios['numcampos'];
	$reemplazos_activos=$reemplazos['numcampos'];
	$cupos_usados=$funcionarios_activos+$reemplazos_activos;   
	echo($cupos_usados);


?>