<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
function imagen_remitente($imagen){
	global $ruta_db_superior;
	$texto="<img src='".$ruta_db_superior."imagenes/sin_foto_funcionario.png'>";
	if($imagen!='anexos'){
		$idanexo=busca_filtro_tabla("","anexos A","A.idanexos=".$imagen,"",$conn);
		$texto="<img src='".$ruta_db_superior.$idanexo[0]["ruta"]."'>";
	}
	return($texto);
}
function ciudad_remitente($ciudad){
	$ciudad=busca_filtro_tabla("","municipio A","A.idmunicipio=".$ciudad,"",$conn);
	return($ciudad[0]["nombre"]);
}
function tipo_remitente($tipo){
	$texto="";
	if($tipo==1){
		$texto="Natural";
	}
	else if($tipo==2){
		$texto="Jur&iacute;dico";
	}
	else{
		$texto="Sin definir";
	}
	return($texto);
}
function inferior_remitente($id,$nombre,$identificacion,$empresa,$direccion,$telefono,$email){
$texto='<button type="button" class="adicionar_seleccionados btn btn-mini tooltip_saia" title="Seleccionar Remitente" idregistro="'.$id.'" datos="<b>Nombre:</b> '.$nombre.' <b>Identificacion:</b> '.$identificacion.' <b>Empresa:</b>'.$empresa.' <b>Direccion:</b> '.$direccion.'"><i class="icon-uncheck"></i></button>';
return($texto);
}
?>