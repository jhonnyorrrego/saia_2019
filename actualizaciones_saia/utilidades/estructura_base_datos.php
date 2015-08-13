<?php
include_once("../../define.php");
include_once("../../db_externo.php");
//$conexion2=phpmkr_db_connect_externo('174.142.208.13',"SAIA_BASE","cerok_saia421_5","SAIA","Oracle",1521,"XE","SAIANUEVO_DATOS");
$conexion2=phpmkr_db_connect_externo();
$tablas=listar_tablas_externa($conexion2);  
$texto='<table width="100%" border="1px">';
for($i=0;$i<$tablas["cantidad"];$i++){
    $texto2='<tr><td colspan="4"><b>TABLA->'.$tablas["tablas"][$i].'</b></td></tr><tr><td colspan="4">'.mostrar_campos($conexion2,$tablas["tablas"][$i]).'</td></tr>';
  $texto.=$texto2;
}
$texto.='</table>';
echo($texto);

function mostrar_campos($conexion,$tabla){
$campos=listar_campos_tabla_externa($tabla,$conexion);
//print_r($campos);
$texto_campos='<table border="1" width="100%"><tr align="center"><td>Nombre</td><td>Tipo</td><td>Default</td><td>Nulo</td></tr>';

for($i=0;$i<$campos["cantidad"];$i++){
  //$tipo_campo=tipo_campo($campos["campos"][$i][1],$conexion);
  $tipo_campo=$campos["campos"][$i][1];
  $texto_campos.='<tr><td width="25%">'.$campos["campos"][$i][0].'</td><td>'.$tipo_campo."</td>";
  
  if($campos["campos"][$i][3]){
    $texto_campos.='<td width="25%">DEFAULT '.$campos["campos"][$i][3].'</td>';
  }
  else
    $texto_campos.='<td width="25%">&nbsp;</td>';
  if($campos["campos"][$i][2]=="N"){
    $texto_campos.='<td width="25%"> NOT NULL</td>';    
  }  
  else{
    $texto_campos.='<td width="25%"> NULL</td>';
  }
 
  $texto_campos.='</tr>';   
} 
$texto_campos.='</tr></table>';   

return($texto_campos);
} 
function tipo_campo($tipo,$conexion1){
$texto='';
$posl=strpos($tipo,'(');
$posr=strpos($tipo,')');
if($posl!==false && $posr!==false){
  $cadena=substr($tipo,0,$posl);
  $longitud=substr($tipo,$posl+1,($posr-$posl-1));
}
else{
  $cadena=$tipo;
  $longitud='';
}

if($conexion1->Conn->Motor=="MySql"){
return($tipo);
  switch($cadena){
    case "int":
      return($texto." ".dato_entero($conexion2->Conn->Motor,$longitud)); 
    break;
    case "varchar":
      return($texto." ".dato_varchar($conexion2->Conn->Motor,$longitud));
	case "text":
      return($texto." ".dato_text($conexion2->Conn->Motor,$longitud));
	case "date":
      return($texto." ".dato_date($conexion2->Conn->Motor,0));
	case "datetime":
      return($texto." ".dato_date($conexion2->Conn->Motor,1));
    break;
	case "tinyint":
      return($texto." ".dato_entero($conexion2->Conn->Motor,$longitud));
	case "enum":
      return($texto." ".dato_varchar($conexion2->Conn->Motor,$longitud));
	case "char":
      return($texto." ".dato_varchar($conexion2->Conn->Motor,$longitud));
	case "double":
      return($texto." ".dato_entero($conexion2->Conn->Motor,$longitud));
    break;
  }
}
else if($conexion1->Conn->Motor=="Oracle"){
 return($tipo);
} 
return($texto);
}
function dato_entero($motor2,$longitud){          
if($longitud==''){
  $longitud='11';  
}
switch($motor2){
  case "Oracle":    
    $cadena='number('.$longitud.',0)';
  break;
  case "MySql":
    $cadena='int '.$longitud;
  break;
}
return($cadena);  
}
function dato_varchar($motor2,$longitud){
if($longitud==''){
  $longitud='255';  
}
switch($motor2){
  case "Oracle":
    $cadena='varchar2('.$longitud.')';
  break;
  case "MySql":
    $cadena='varchar('.$longitud.')';
  break;
}
return($cadena);  
}
function dato_text($motor2,$longitud){
switch($motor2){
  case "Oracle":
    $cadena='CLOB';
  break;
  case "MySql":
    $cadena="text";
  break;
}
return($cadena);  
}
function dato_date($motor2,$longitud){
switch($motor2){
  case "Oracle":
    $cadena='date';
  break;
  case "MySql":
    if($longitud)       
      $cadena='datetime';
    else
      $cadena='date';  
  break;
}
return($cadena);  
}
?>