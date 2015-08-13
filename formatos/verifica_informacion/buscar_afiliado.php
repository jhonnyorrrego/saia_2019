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

$idft_solicitud=$_REQUEST['idft_solicitud'];

$datos=busca_filtro_tabla("A.fecha_solicitud, A.numero_folios_afilia, C.identificacion","ft_solicitud_afiliacion A, datos_ejecutor B, ejecutor C","A.datos_solicitante=B.iddatos_ejecutor AND B.ejecutor_idejecutor=C.idejecutor and A.idft_solicitud_afiliacion=".$idft_solicitud,"",$conn);

$datos_formato = array(
									"identificacion" => $datos[0]['identificacion'],
									"fecha_solicitud" => $datos[0]['fecha_solicitud'],
									"numero_folios" => $datos[0]['numero_folios_afilia'],
									
								);
echo(json_encode($datos_formato));
?>