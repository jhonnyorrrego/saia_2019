<?php
$retornar="";
$datos_ejecutor="";

function llamado_ejecutor($funcion,$campo,$idformato,$iddoc){
global $datos_ejecutor,$retornar,$conn;
$datos_formato=busca_filtro_tabla("A.nombre_tabla, B.idcampos_formato","formato A,campos_formato B","B.formato_idformato=A.idformato AND A.idformato=".$idformato." AND B.nombre='".$campo."'","");
//print_r($datos_formato);
if($datos_formato["numcampos"]){
  $datos=busca_filtro_tabla($campo,$datos_formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"");
  if($datos["numcampos"]){
    $datos_ejecutor=busca_filtro_tabla("A.*,B.*","ejecutor A,datos_ejecutor B","A.idejecutor=B.ejecutor_idejecutor AND B.iddatos_ejecutor in(".$datos[0][$campo].")","");
    $funcion();
  }
}
return($retornar);
}

function mostrar_nombre(){
global $retornar,$datos_ejecutor;
$nombres=array();
for($i=0;$i<$datos_ejecutor["numcampos"];$i++)
  $nombres[]=$datos_ejecutor[$i]["nombre"];
$retornar=implode(",",$nombres);
}
?>