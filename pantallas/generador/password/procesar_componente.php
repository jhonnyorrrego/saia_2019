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
include_once $ruta_db_superior . 'core/autoload.php';
include_once($ruta_db_superior."pantallas/lib/librerias_componentes.php");
function procesar_password($idcampo='',$seleccionado='',$accion='',$campo=''){	
	global $conn;
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
	if($campo==''){
			$dato=busca_filtro_tabla("A.*","campos_formato A","A.idcampos_formato=".$idcampo,"",$conn);
		$campo=$dato[0];
	}	
	if($seleccionado!=''){
		$texto=$seleccionado;
	}
	else{
		$texto=$campo["predeterminado"];
	}
	return($texto);
}
?>