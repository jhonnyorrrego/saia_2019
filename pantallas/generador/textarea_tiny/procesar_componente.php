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
function procesar_textarea_tiny($idcampo='',$seleccionado='',$accion='',$campo=''){  
  global $conn, $ruta_db_superior;
  $campo='';
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
  if($campo==''){
    $dato=busca_filtro_tabla("A.*","campos_formato A","A.idcampos_formato=".$idcampo,"",$conn);
    $campo=$dato[0];
  }	
  if($seleccionado!=''){
    $selec=$seleccionado;
  }
  else{
    $selec=$campo["predeterminado"];
  }
	$texto='<textarea class="tiny_avanzado" name="'.$campo["nombre"].'" id="'.$campo["nombre"].'">'.$selec.'</textarea>';
  return($texto);
}
?>