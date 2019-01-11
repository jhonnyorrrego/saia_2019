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
function procesar_link($idcampo='',$seleccionado='',$accion='',$campo=''){
global $conn,$ruta_db_superior;
$texto='';
if($idcampo==''){
  return("<div class='alert alert-error'>No existe campo para procesar</div>");
}
if($campo==''){
	$dato=busca_filtro_tabla("","campos_formato","idcampos_formato=".$idcampo,"",$conn);
	$campo=$dato[0];
}	
if($campo["valor"]!=''){
  $cadena=explode(";",$campo["valor"]);
  if(@$cadena[0]!='')
    $texto.=' href="'.$cadena[0].'"';
  if($cadena[1]!=''){
    $texto.=' target="'.$cadena[1].'"';
  }  
} 
else{
  $texto.=' href="#" target="_self" ';
} 
return($texto);
}

?>