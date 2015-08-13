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
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");


function ver_documento($iddoc,$numero){
	if($numero=="numero"){$numero=0;}
$enlace = "<div class='link kenlace_saia' enlace='ordenar.php?key=".$iddoc."&amp;amp;mostrar_formato=1' conector='iframe' titulo='Documento numero ".$numero."'>".$numero."</div>";
return($enlace);
}

function mostrar_tipo_documento($documento_iddocumento,$idft_clinica_ortodoncia){
		
	if($consulta==1){
		$tipo="C.C";
	}
	else if($consulta==2){
		$tipo="T.I";
	}
	else if($consulta==3){
		$tipo="R.C";
	}
	else {
		$tipo="C.E";
	}
	
	return($tipo);
}

function mostrar_genero($genero){	
		
	if($genero==1){
		$tipo="Hombre";
	}
	else {
		$tipo="Mujer";
	}
	return($tipo);
}

function mostrar_motivo($consulta){	
		
	if($consulta==1){
		$tipo="Control";
	}
	else if($consulta==2){
		$tipo="Tratamiento";
	}
	else if($consulta==3){
		$tipo="Urgencia";
	}
	else {
		$tipo="Otro";
	}
	
	return($tipo);
}

function mostrar_control($consulta){	
		
	if($consulta==1){
		$tipo="Asistio";
	}
	else {
		$tipo="No asistio";
	}
	
	return($tipo);
}


?>