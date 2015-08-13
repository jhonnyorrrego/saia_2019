<?php 
function barra_superior_ejecutores($idejecutor){
$texto='<div class="btn-group barra_superior">
<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" enlace="ejecutorview.php?key='.$idejecutor.'" titulo="Datos del ejecutor" conector="iframe"><i class="icon-signal"></i></button>
<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Editar ejecutor" enlace="ejecutoredit.php?key='.$idejecutor.'" conector="iframe"><i class="icon-wrench"></i></button>
<button type="button" class="btn btn-mini kenlace_saia tooltip_saia" titulo="Eliminar ejecutor" enlace="ejecutordelete.php?key='.$idejecutor.'" conector="iframe"><i class="icon-trash"></i></button>
<button type="button" class="adicionar_seleccionados btn btn-mini tooltip_saia" titulo="Seleccionar ejecutor" idregistro="'.$idejecutor.'"><i class="icon-download"></i></button>
<button type="button" class="eliminar_seleccionado btn btn-mini tooltip_saia" idregistro="'.$idejecutor.'" titulo="Deseleccionar ejecutor"><i class="icon-edit"></i></button>
</div>';
return(($texto));
}
function mostrar_datos_ejecutor($idejecutor){
$tejecutor='';
$ejecutor=datos_ejecutor($idejecutor);
  $tejecutor.='<hr /><span class="resaltar">Remitente externo</span><br />';
if($ejecutor[0]["nombre"]!='')  
  $tejecutor.='<span class="resaltar">Nombre:</span> '.$ejecutor[0]["nombre"]."<br />";
if($ejecutor[0]["identificacion"]!='')
  $tejecutor.='<span class="resaltar">Identificaci&oacute;n:</span> '.$ejecutor[0]["identificacion"]."<br />";
if($ejecutor[0]["cargo"]!='')  
  $tejecutor.='<span class="resaltar">Cargo:</span> '.$ejecutor[0]["cargo"]."<br />";
if($ejecutor[0]["empresa"]!='')  
  $tejecutor.='<span class="resaltar">Empresa:</span> '.$ejecutor[0]["empresa"]."<br />";
if($ejecutor[0]["direccion"]!='')  
  $tejecutor.='<span class="resaltar">Direcci&oacute;n:</span> '.$ejecutor[0]["direccion"]."<br />";
if($ejecutor[0]["telefono"]!='')  
  $tejecutor.='<span class="resaltar">Tel&eacute;fono:</span> '.$ejecutor[0]["telefono"]."<br />";
if($ejecutor[0]["ciudad"]!='')  
  $tejecutor.='<span class="resaltar">Ciudad:</span> '.$ejecutor[0]["ciudad_ejecutor"]."<br />";
return($tejecutor);
}
function datos_ejecutor($idejecutor){
$ejecutor=busca_filtro_tabla("","vejecutor","iddatos_ejecutor=".$idejecutor,"",$conn);
return($ejecutor);	
}
?>