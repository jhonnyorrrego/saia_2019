<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/generador/librerias.php");
echo(estilo_bootstrap());
$pantalla=busca_filtro_tabla("","campos_formato","idcampos_formato=".$_REQUEST["idpantalla_campos"],"",$conn);
if($pantalla["numcampos"]){
  redirecciona($ruta_db_superior."pantallas/ruta_temporal/adicionar_ruta_temporal.php?almacenar_en=pantalla_ruta&pantalla_idpantalla=".$pantalla[0]["pantalla_idpantalla"]);
}

?>