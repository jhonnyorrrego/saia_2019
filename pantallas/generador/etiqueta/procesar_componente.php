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
function procesar_etiqueta($idcampo='',$seleccionado='',$accion='',$campo=''){	
	global $conn,$ruta_db_superior;
  if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
	if($campo==''){
		$dato=busca_filtro_tabla("","pantalla_campos A","A.idpantalla_campos=".$idcampo,"",$conn);
		$campo=$dato[0];
	}	
	if($seleccionado!=''){
		$predeterminado=$seleccionado;
	}
	else{
		$predeterminado=$campo["predeterminado"];
	}
	$datos=explode("/**/",$campo["valor"]);
	if($accion){
		if($datos[0]==1){
			if(!$datos[1]){
				$texto="<b>Texto informativo:</b> no se almacena en base de datos, por favor llenar sobre el campo valor de llenado";
			}
			else{
				$texto=$datos[1];
			}
		}
		else if($datos[0]==2){
			if($datos[1])
				include_once($ruta_db_superior.$datos[1]);
			$texto=$datos[2]();
		}
		else{
			$texto="<b>Texto informativo:</b> no se almacena en base de datos, por favor llenar sobre el campo valor de llenado";
		}
	}
	else{
		if($datos[0]==1){
			if(!$datos[1]){
				$texto="<b>Texto informativo:</b> no se almacena en base de datos, por favor llenar sobre el campo valor de llenado";
			}
			else{
				$texto=$datos[1];
			}
		}
		else if($datos[0]==2){
			$ruta_libreria=$datos[1];
			$funcion=$datos[2];
			$texto="<b>Funci&oacute;n vinculada:</b> ".$ruta_libreria." <b>function</b> ".$funcion."()";
		}
		else{
			$texto="<b>Texto informativo:</b> no se almacena en base de datos, por favor llenar sobre el campo valor de llenado";
		}
	}
	return($texto);
}
?>