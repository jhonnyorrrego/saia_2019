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
	$dato=busca_filtro_tabla("","pantalla_campos","idpantalla_campos=".$idcampo,"",$conn);
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
		$guardados[]='<div id="remitente_'.$datos[$i]["iddatos_ejecutor"].'"><b>Nombre:</b> '.$datos[$i]["nombre"].' <b>Identificacion:</b> '.$datos[$i]["identificacion"].' <b>Empresa:</b>'.$datos[$i]["empresa"].' <b>Direccion:</b> '.$datos[$i]["direccion"].' <button class="btn btn-mini eliminar_remitente" idregistro="'.$datos[$i]["iddatos_ejecutor"].'" nombre="'.$campo["nombre"].'"><i class="icon-remove"></i></button></div>';
	}
	$texto='<div id="capa_'.$campo["nombre"].'" class="highslide" style="cursor:pointer;" name="capa_'.$campo["nombre"].'">Seleccionar
    <input type="hidden" name="'.$campo["nombre"].'" id="'.$campo["nombre"].'" value="'.$predeterminado.'">
    </div>
    <div id="remitentes_'.$campo["nombre"].'">'.implode("",$guardados).'</div>';
}
else{
	$texto='<div id="capa_'.$campo["nombre"].'" class="highslide" style="cursor:pointer;" name="capa_'.$campo["nombre"].'">Seleccionar
    <input type="hidden" name="'.$campo["nombre"].'" id="'.$campo["nombre"].'">
    </div>
    <div id="remitentes_'.$campo["nombre"].'"></div>';
}
return($texto);
}
function mostrar_remitente($idcampo='',$seleccionado='',$accion='',$campo=''){
	global $conn;
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
	
	$datos=busca_filtro_tabla("","ejecutor A, datos_ejecutor B","A.idejecutor=B.ejecutor_idejecutor AND B.iddatos_ejecutor in(".$predeterminado.")","",$conn);
	
	$guardados=array();
	for($i=0;$i<$datos["numcampos"];$i++){
		$guardados[]="<b>Nombre:</b> ".$datos[$i]["nombre"]." <b>Identificacion:</b> ".$datos[$i]["identificacion"];
	}
	return(implode("<br />",$guardados));
}
?>