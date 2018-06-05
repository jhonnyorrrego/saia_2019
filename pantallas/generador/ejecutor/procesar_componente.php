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
function procesar_remitente($idcampo='',$seleccionado='',$accion='',$campo=''){
global $conn,$ruta_db_superior;
$texto='';
if($idcampo==''){
  return("<div class='alert alert-error'>No existe campo para procesar</div>");
}
if($campo==''){
	$dato=busca_filtro_tabla("","campos_formato","idcampos_formato=".$idcampo,"",$conn);
	$campo=$dato[0];
}	
if($accion!=''){
  $texto='';	
}
if($seleccionado!=''){
	$predeterminado=$seleccionado;
}
else{
	$predeterminado=$campo["predeterminado"];
}
if($predeterminado){
	$datos=busca_filtro_tabla("","ejecutor A, datos_ejecutor B","A.idejecutor=B.ejecutor_idejecutor AND B.iddatos_ejecutor in(".$predeterminado.")","",$conn);
	
	$guardados=array();
	for($i=0;$i<$datos["numcampos"];$i++){
		$guardados[]='<div id="remitente_'.$datos[$i]["iddatos_ejecutor"].'"><br><b>Nombre:</b> '.$datos[$i]["nombre"].' <br><b>Identificacion:</b> '.$datos[$i]["identificacion"].' <br><b>Empresa:</b>'.$datos[$i]["empresa"].' <br><b>Direccion:</b> '.$datos[$i]["direccion"].'<br><b>Tel&eacute;fono:</b>'.$datos[$i]["telefono"].' <br><b>Correo electr&oacute;nico:</b>'.$datos[$i]["email"].' <br><b>T&iacute;tulo:</b>'.$datos[$i]["titulo"].' <br><b>Ciudad:</b>'.$datos[$i]["ciudad"].' <br></div>';
	}
	
	$texto='<div id="remitentes_'.$campo["nombre"].'">'.implode("",$guardados).'</div>';
}
else{
	$texto='<div id="remitentes_'.$campo["nombre"].'">Sin remitente seleccionado</div>';
}
return($texto);
}
function mostrar_remitente($idcampo='',$seleccionado='',$accion='',$campo=''){
	global $conn;
	if($idcampo==''){
    return("<div class='alert alert-error'>No existe campo para procesar</div>");
  }

}
?>