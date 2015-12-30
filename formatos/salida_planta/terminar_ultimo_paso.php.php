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
include_once($ruta_db_superior."workflow/libreria_paso.php");

$idpaso=@$_REQUEST["idpaso"];
$iddoc=@$_REQUEST["iddoc"];

$actividad=busca_filtro_tabla("","paso_actividad a","paso_idpaso=".$idpaso,"idpaso_actividad desc",$conn);
$paso_documento=busca_filtro_tabla("","paso_documento a","a.documento_iddocumento=".$iddoc." AND estado_paso_documento=4","idpaso_documento desc",$conn);

if($actividad["numcampos"]){
	terminar_actividad_paso($iddoc,"",1,$paso_documento[0]["idpaso_documento"],$actividad[0]["idpaso_actividad"]);  
}
?>