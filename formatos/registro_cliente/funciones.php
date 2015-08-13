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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

function mostrar_logo_cliente($idformato, $iddoc){
	global $conn,$ruta_db_superior;

	$datos=busca_filtro_tabla("A.ruta","anexos A, documento B","A.documento_iddocumento=B.iddocumento AND B.iddocumento=".$iddoc,"",$conn);

	$imagen="<img src='../../".$datos[0]['ruta']."' title='Imagen cliente' width='150px' height='150px'>";
	
	echo($imagen);
}
?>
