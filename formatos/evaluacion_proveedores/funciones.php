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

function generar_lista_proveedores($idformato,$iddoc){
	global $conn;
	$guardados=busca_filtro_tabla("","ft_evaluacion_proveedores A, documento B","A.ft_justificacion_compra=".$_REQUEST["padre"]." AND A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO')","",$conn);
	$almacenados=extrae_campo($guardados,"ft_recepcion_cotizacion");
	$mostrar=busca_filtro_tabla("","ft_recepcion_cotizacion A, documento B","A.ft_justificacion_compra=".$_REQUEST["padre"]." AND A.idft_recepcion_cotizacion not in('".implode("','",$almacenados)."') AND A.documento_iddocumento=B.iddocumento AND B.estado not in('ELIMINADO','ANULADO')","",$conn);
	
	$texto="<td><select name='ft_recepcion_cotizacion' id='ft_recepcion_cotizacion' class='required'><option value=''>Por favor seleccione</option>";
	for($i=0;$i<$mostrar["numcampos"];$i++){
		$nombre=busca_filtro_tabla("","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$mostrar[$i]["proveedor"],"",$conn);
		$texto.="<option value='".$mostrar[$i]["idft_recepcion_cotizacion"]."'>".$nombre[0]["nombre"]."</option>";
	}
	$texto.="</select></td>";
	echo($texto);
}
function proveedor_funcion($idformato,$iddoc){
	global $conn;
	$almacenado=busca_filtro_tabla("","ft_evaluacion_proveedores A","A.documento_iddocumento=".$iddoc,"",$conn);
	$mostrar=busca_filtro_tabla("","ft_recepcion_cotizacion A","A.idft_recepcion_cotizacion in('".$almacenado[0]["ft_recepcion_cotizacion"]."')","",$conn);
	$nombre=busca_filtro_tabla("","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$mostrar[0]["proveedor"],"",$conn);
	echo($nombre[0]["nombre"]);
	
}
function puntaje_funcion($idformato,$iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","ft_evaluacion_proveedores A","A.documento_iddocumento=".$iddoc,"",$conn);
	$dato1=$datos[0]["precio_cotizaciones"];
	$dato2=$datos[0]["matriculado_camara"];
	$dato3=$datos[0]["atencion"];
	$dato4=$datos[0]["cumplimiento"];
	
	$dato11=$dato1*30;
	$dato22=$dato2*10;
	$dato33=$dato3*30;
	$dato44=$dato4*30;
	
	$preresultado=($dato11+$dato22+$dato33+$dato44)/300;
	$resultado=$preresultado*100;
	
	$tipo="";
	if($resultado>=80){
		$tipo="Tipo A";
	}
	else if($resultado>=60&&$resultado<=79){
		$tipo="Tipo B";
	}
	else if($resultado<=59){
		$tipo="Tipo C";
	}
	echo("<b>Calificaci&oacute;n: </b>".$tipo." <b>Resultado:</b> ".round($resultado)."%");
}
function almacenar_descripcion($idformato,$iddoc){
	global $conn;
	$almacenado=busca_filtro_tabla("","ft_evaluacion_proveedores A","A.documento_iddocumento=".$iddoc,"",$conn);
	$mostrar=busca_filtro_tabla("","ft_recepcion_cotizacion A","A.idft_recepcion_cotizacion in('".$almacenado[0]["ft_recepcion_cotizacion"]."')","",$conn);
	$nombre=busca_filtro_tabla("","datos_ejecutor A, ejecutor B","A.ejecutor_idejecutor=B.idejecutor AND A.iddatos_ejecutor=".$mostrar[0]["proveedor"],"",$conn);
	
	$nombre_proveedor=($nombre[0]["nombre"]);
	
	$datos=busca_filtro_tabla("","ft_evaluacion_proveedores A","A.documento_iddocumento=".$iddoc,"",$conn);
	$dato1=$datos[0]["precio_cotizaciones"];
	$dato2=$datos[0]["matriculado_camara"];
	$dato3=$datos[0]["atencion"];
	$dato4=$datos[0]["cumplimiento"];
	
	$dato11=$dato1*30;
	$dato22=$dato2*10;
	$dato33=$dato3*30;
	$dato44=$dato4*30;
	
	$preresultado=($dato11+$dato22+$dato33+$dato44)/300;
	$resultado=$preresultado*100;
	
	$tipo="";
	if($resultado>=80){
		$tipo="Tipo A";
	}
	else if($resultado>=60&&$resultado<=79){
		$tipo="Tipo B";
	}
	else if($resultado<=59){
		$tipo="Tipo C";
	}
	
	$cadena=$nombre_proveedor." - ".$tipo;
	$sql1="UPDATE ft_evaluacion_proveedores SET descripcion_almacenada='".$cadena."' WHERE documento_iddocumento=".$iddoc;
	phpmkr_query($sql1);
}
?>