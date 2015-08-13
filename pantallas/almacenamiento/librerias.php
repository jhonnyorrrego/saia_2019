<?php
include_once(dirname(__FILE__)."../../db.php");
function mostrar_datos_almacenamiento($iddoc){
$caja='';
$talmacenamiento='';
$almacenamiento=datos_almacenamiento($iddoc);
if($almacenamiento[0]["ubicacion"]!='')  
  $caja.='<span class="resaltar">Ubicaci&oacute;n:</span> '.$almacenamiento[0]["ubicacion"]."<br />";
if($almacenamiento[0]["estanteria"]!='')
  $caja.='<span class="resaltar">Estanter&iacute;a:</span> '.$almacenamiento[0]["estanteria"]."<br />";
if($almacenamiento[0]["nivel"]!='')  
  $caja.='<span class="resaltar">Nivel:</span> '.$almacenamiento[0]["nivel"]."<br />";
if($almacenamiento[0]["panel"]!='')  
  $caja.='<span class="resaltar">Panel:</span> '.$almacenamiento[0]["panel"]."<br />";
if($almacenamiento[0]["numero"]!='')  
  $caja.='<span class="resaltar">Caja:</span> '.$almacenamiento[0]["numero"]."<br />";
if($almacenamiento[0]["etiqueta"]!='')  
  $caja.='<span class="resaltar">Folder:</span> '.$almacenamiento[0]["etiqueta"];
if($almacenamiento[0]["num_folios"]!='')
  $talmacenamiento.='<span class="resaltar">N&uacute;mero folios:</span> '.$almacenamiento[0]["num_folios"]."<br />";
if($almacenamiento[0]["anexos"]!='')  
  $talmacenamiento.='<span class="resaltar">N&uacute;mero Anexos:</span> '.$almacenamiento[0]["anexos"]."<br />";
if($almacenamiento[0]["deterioro"]!='')
  $talmacenamiento.='<span class="resaltar">Deterioro:</span> '.$almacenamiento[0]["deterioro"]."<br />";
if($almacenamiento[0]["soporte"]!='')
  $talmacenamiento.='<span class="resaltar">Soporte:</span> '.$almacenamiento[0]["soporte"]."<br />";
return(array($caja,$talmacenamiento));
}
function datos_almacenamiento($iddoc){
	global $conn;
	$datos=busca_filtro_tabla("","valmacenamiento","documento_iddocumento=".$iddoc,"",$conn);
	return($datos);
}
function ver_caja($idcaja,$fondo){
	$texto.='
  <button type="button" class="btn btn-mini kenlace_saia tooltip_saia documento_leido" enlace="pantallas/almacenamiento/almacenamiento.php?idcaja='.$idcaja.'" titulo="'.$fondo.'" conector="iframe" idregistro="'.$idcaja.'" onClick=" ">Ir a la caja
  </button>
  <button type="button" class="btn btn-mini btn-success tooltip_saia" value="../almacenamiento/rotulo.php?idcaja='.$idcaja.'&no_redireccionar=1" titulo="Imprimir rotulo" idregistro="'.$idcaja.'" onClick="window.open(this.value)">Rotulo
  </button>
  ';
	return ($texto);
}
function filtrar_documentos_carpetas(){
	global $conn;
	$variable='';
	if(@$_REQUEST["variable_busqueda"])
		$variable=" and folder_idfolder=".$_REQUEST["variable_busqueda"];
	return ($variable);
}
function ver_carpeta($idcarpeta){
	global $conn;
	$carpeta=busca_filtro_tabla("a.nombre_expediente, b.fondo, b.idcaja","folder a, caja b","a.caja_idcaja=b.idcaja and idfolder=".$idcarpeta,"",$conn);
	$texto='';
	$texto.='<b>Caja:</b>'.$carpeta[0]["fondo"].'<br>';
	$texto.='<button type="button" class="btn btn-mini kenlace_saia tooltip_saia documento_leido" enlace="pantallas/almacenamiento/almacenamiento.php?idcarpeta='.$idcarpeta.'&idcaja='.$carpeta[0]["idcaja"].'" titulo="'.$carpeta[0]["nombre_expediente"].'" conector="iframe" idregistro="'.$idcaja.'" onClick=" ">Ir a la carpeta
  </button>';
  return ($texto);
}
?>