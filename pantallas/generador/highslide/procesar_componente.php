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
function procesar_highslide($idcampo='',$seleccionado='',$accion='',$campo=''){
global $conn,$ruta_db_superior;
$texto='';
if($idcampo==''){
  return("<div class='alert alert-error'>No existe campo para procesar</div>");
}
if($campo==''){
	$dato=busca_filtro_tabla("","campos_formato","idcampos_formato=".$idcampo,"",$conn);
	$campo=$dato[0];
}	
$datos=explode(";",$campo["valor"]);
if($accion!=''){
  $texto=' hs.htmlExpand(this, {objectType: "iframe", width:"'.$datos[1].'", height:"'.$datos[2].'", preserveContent:false ,src: "'.$ruta_db_superior.$datos[0].'"});';
}
return($texto);
}
?>