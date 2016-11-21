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

function funcion_ver_documento($iddocumento) {
  
  return('<div class="link kenlace_saia" enlace="ordenar.php?key='.$iddocumento.'&amp;accion=mostrar&amp;mostrar_formato=1" conector="iframe" titulo="No Radicado"><center><span class="badge">Ver</span></center></div>');
  
}

function mostrar_datos_descripcion($iddocumento,$plantilla){
	
	
	if(strtolower($plantilla)=="inventario_retirados"){
		$datos=busca_filtro_tabla("","ft_inventario_retirados","documento_iddocumento=".$iddocumento,"",$conn);
		$cadena="Nombre: ".$datos[0]['nombre_completo']."<br>Apellidos: ".$datos[0]['primer_apellido']." ".$datos[0]['segundo_apellido']."<br>Identificación: ".$datos[0]['num_identificacion']."<br>Fecha Retiro: ".$datos[0]['fecha_retiro']."<br>Ultimo Cargo: ".$datos[0]['ultimo_cargo']."<br>Estamento: ".$datos[0]['estamento']."<br>Jubilado Otra Institución: ".$datos[0]['jubilado_otra_instit'];
	}elseif(strtolower($plantilla)=="inventario_jubilados"){
		$datos=busca_filtro_tabla("","ft_inventario_jubilados","documento_iddocumento=".$iddocumento,"",$conn);
		$cadena="Nombre: ".$datos[0]['nombre_completo']."<br>Apellidos: ".$datos[0]['primer_apellido']." ".$datos[0]['segundo_apellido']."<br>Identificación: ".$datos[0]['num_identificacion']."<br>Fecha Jubilación: ".$datos[0]['fecha_jubilacion']."<br>Número Resolución: ".$datos[0]['numero_resolucion']."<br>Emanada de: ".$datos[0]['emanada_de']."<br>Ultimo Cargo: ".$datos[0]['ultimo_cargo']."<br>Estamento: ".$datos[0]['estamento']."<br>Demandado: ".$datos[0]['demandado']."<br>Sustitución Pensional: ".$datos[0]['sustitucion_pensiona']."<br>Cédula Sustitución Pensional: ".$datos[0]['cedula_sustitucion']."<br>Fecha de Reconocimiento Sustitución Pensional: ".$datos[0]['fecha_reconocimiento'];
	}
	
	return $cadena;
}

function mostrar_tipo_inventario($plantilla){
	
	if(strtolower($plantilla)=="inventario_retirados"){
		return('Retirados');
	}elseif(strtolower($plantilla)=="inventario_jubilados"){
		return('Jubilados');
	}
}

?>
