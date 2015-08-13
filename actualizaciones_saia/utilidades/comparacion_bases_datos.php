<?php
include_once("../../db_externo.php");
$conexion1=phpmkr_db_connect_externo("saia-aguas.ct00qljbq3lp.us-east-1.rds.amazonaws.com","saia", "cerok_saia421_5","saia_release1","MySql",3306,"");
$conexion2=phpmkr_db_connect_externo("saia-aguas.ct00qljbq3lp.us-east-1.rds.amazonaws.com","saia", "cerok_saia421_5","saia_carder_release","MySql",3306,"");
comparar_tablas($conexion1,$conexion2);
phpmkr_db_close_externo($conexion1);
phpmkr_db_close_externo($conexion2);
function comparar_tablas($conexion1,$conexion2){
$tablas=listar_tablas_externa($conexion1);
$texto='<table width="100%" border="1px">';
for($i=0;$i<$tablas["cantidad"];$i++){
  $existe_tabla=" 0k ";
  $verifica_tabla=listar_tablas_externa($conexion2,$tablas["tablas"][$i]);
  if(!$verifica_tabla["cantidad"]){
    $existe_tabla=" <span sytle='background:red'>Falta</span> ";
    $texto2='<tr><td colspan="4">'.crear_tabla($conexion1,$conexion2,$tablas["tablas"][$i]).'</td></tr>';
  }
  else{
    $texto2='<tr><td colspan="4">'.comparar_campos($conexion1,$conexion2,$tablas["tablas"][$i]).'</td></tr>';
  }
  $texto.='<tr><td colspan="3" bgcolor="#ccccccc">'.$tablas["tablas"][$i].'</td><td>'.$existe_tabla.'</td></tr>';
  $texto.=$texto2;
}
$texto.='</table>';
echo($texto);
}
function crear_tabla($conexion1,$conexion2,$tabla){
$texto='';
if($conexion2->Conn->Motor=="Oracle")
  $texto='<br>CREATE SEQUENCE  '.strtoupper($tabla).'_SEQ  MINVALUE 1 MAXVALUE 999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE;';
$texto_campos=''; 
$tipo_campo='';
$campos=listar_campos_tabla_externa($tabla,$conexion1);
for($i=0;$i<$campos["cantidad"];$i++){
  $tipo_campo=tipo_campo($campos["campos"][$i][1],$conexion1,$conexion2);
  $texto_campos.=''.$campos["campos"][$i][0].' '.$tipo_campo." ";
  
  if($campos["campos"][$i][3]){
    $texto_campos.=' DEFAULT '.$campos["campos"][$i][3];
  }
  
  if($campos["campos"][$i][2]=="NO"){
    $texto_campos.=' NOT NULL';    
  }  
  else{
    $texto_campos.=' NULL';
  }
  if($i<($campos["cantidad"]))
    $texto_campos.=', ';
} 

$texto.='<br>CREATE TABLE '.strtoupper($tabla).' (';
$texto.=$texto_campos;
if($conexion2->Conn->Motor=="Oracle"){
  $texto.=' CONSTRAINT '.strtoupper($tabla).' PRIMARY KEY (id'.$tabla.')';
  $texto.=')LOGGING NOCOMPRESS NOCACHE NOPARALLEL MONITORING;';
  $texto.=' TABLESPACE '.$conexion2->Conn->Tablespace.';';  
  $texto.='<br>CREATE OR REPLACE TRIGGER '.strtoupper($tabla).'_TRG BEFORE INSERT ON '.strtoupper($tabla).' FOR EACH ROW BEGIN  IF INSERTING AND :NEW.ID'.strtoupper($tabla).' IS NULL THEN SELECT '.strtoupper($tabla).'_SEQ.NEXTVAL INTO :NEW.ID'.strtoupper($tabla).' FROM DUAL; END IF; END;';
}
else if($conexion2->Conn->Motor=='MySql'){
  $texto.=',PRIMARY KEY  (id'.$tabla.'))ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;';
}  
return($texto);    
}
function tipo_campo($tipo,$conexion1,$conexion2){
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
function comparar_campos($conexion1,$conexion2,$tabla,$alter=1){
$campos=listar_campos_tabla_externa($tabla,$conexion1);
$texto='<table width="100%" border="1px">';
for($i=0;$i<$campos["cantidad"];$i++){
  $existe_campo=" 0k ";
  $verifica_campo=listar_campos_tabla_externa($tabla,$conexion2,$campos["campos"][$i][0]);
  //print_r($verifica_campo);
  if(!$verifica_campo["cantidad"]){
    $existe_campo=" Falta ";
    $texto.='<tr><td>'.$campos["campos"][$i][0].'</td><td>'.$campos["campos"][$i][1].'</td><td>'.$campos["campos"][$i][2].'</td><td>'.$existe_campo.'</td>'; 
  }
  else{
    $sql_alter=verificar_campos($campos["campos"][$i],$verifica_campo["campos"][0]);
    if($sql_alter){
      $texto.='<tr><td colspan="3">'.$sql_alter.'</td><td>'.$existe_campo.'</td></tr>';
    }
    else{
      $texto.='<tr><td>'.$campos["campos"][$i][0].'</td><td>'.$campos["campos"][$i][1].'</td><td>'.$campos["campos"][$i][2].'</td><td>'.$existe_campo.'</td></tr>';    
    }    
  }
}
$texto.='</table>';
return($texto);
}
//Retorna FALSE SI SON IGUALES DE LO CONTRARIO DEVUELVE EL ALTER TABLE DEL CAMPO
function verificar_campos($campo1,$campo2,$tabla){
return(false);
}
?>
