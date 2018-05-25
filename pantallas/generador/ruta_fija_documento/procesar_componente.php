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
include_once($ruta_db_superior."pantallas/ruta_temporal/funciones.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
function procesar_ruta_fija_documento($idcampo='',$seleccionado='',$accion='',$campo=''){
global $conn,$ruta_db_superior;
$texto='';
if($idcampo==''){
  return("<div class='alert alert-error'>No existe campo para procesar</div>");
}
if($campo==''){
	$dato=busca_filtro_tabla("","campos_formato","idcampos_formato=".$idcampo,"",$conn);
	$campo=$dato[0];
}	                          
$_REQUEST["almacenar_en"]="pantalla_ruta";
$_REQUEST["pantalla_idpantalla"]=$campo["formato_idformato"];
$_REQUEST["encabezado_campo"]=true;
$valor=explode(";",$campo["valor"]);  
$texto.=informacion_ruta(1); 
return($texto); 
}
?>