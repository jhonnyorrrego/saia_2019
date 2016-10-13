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
$texto_alter='';
ini_set("display_errors",true);
include_once($ruta_db_superior."db_externo.php");
include_once($ruta_db_superior."librerias_saia.php");
ini_set("display_errors",true);
echo(estilo_bootstrap());
$conexion1=phpmkr_db_connect_externo('liceo-frances.ct00qljbq3lp.us-east-1.rds.amazonaws.com',"cerok","cerok_saia421_5","saia_release1_temp","MySql",3306,"saia_release1_temp");
$conexion2=phpmkr_db_connect_externo('liceo-frances.ct00qljbq3lp.us-east-1.rds.amazonaws.com',"cerok","cerok_saia421_5","liceo_release1","MySql",3306,"liceo_frances");
comparar_tablas($conexion1,$conexion2);
phpmkr_db_close_externo($conexion1);
phpmkr_db_close_externo($conexion2);
//echo(librerias_bootstrap());
echo("<hr>".$texto_alter);
function comparar_tablas($conexion1,$conexion2){
global $texto_alter;
$tablas=listar_tablas_externa($conexion1);
$texto='<style> .obligatorio{ width:30px;} size{width:400px;}.nombre_campo{width:300px; background-color:#cccccc;}</style>';
for($i=0;$i<$tablas["cantidad"];$i++){
	$texto.='<table width="100%" border="1px" class="table"><tbody>';
  $existe_tabla=" 0k ";
  $verifica_tabla=listar_tablas_externa($conexion2,$tablas["tablas"][$i]);
  if(!$verifica_tabla["cantidad"]){
    $existe_tabla=" <span sytle='background:red'>Falta</span> ";
    $texto_tabla=crear_tabla($conexion1,$conexion2,$tablas["tablas"][$i]);
    $texto_alter.=$texto_tabla."<br>";
    $texto2='<tr class="error"><td colspan="4">'.$texto_tabla.'</td></tr>';
  }
  else{
  	//tipo_alter en 1 crea el alter table para el add
  	$texto_tabla=comparar_campos($conexion1,$conexion2,$tablas["tablas"][$i],1);
  	$texto2='<table  class="table"><tbody>';
  	$texto2.='<thead><tr><th>Nombre</th><th>Tipo</th><th>Null</th><th>Existe</th></tr></thead>';
  	$texto2.='<tr><td colspan="4">'.$texto_tabla.'</td></tr>';
  	//tipo_alter en 2 crea el alter table para el drop 
  	$texto2.=comparar_campos($conexion2,$conexion1,$tablas["tablas"][$i],2);
  	$texto2.='</tbody></table>';
  }
  $texto.='<tr><td colspan="3" bgcolor="#ccccccc">'.$tablas["tablas"][$i].'</td><td>'.$existe_tabla.'</td></tr>';
  $texto.=$texto2;
  $texto.='</tbody></table><br>';
}
echo($texto);
}
function crear_tabla($conexion1,$conexion2,$tabla){
$texto='';
if($conexion2->Conn->Motor=="Oracle")
  $texto='<br>CREATE SEQUENCE  '.strtolower($tabla).'_SEQ  MINVALUE 1 MAXVALUE 999999999999999999999999 INCREMENT BY 1 START WITH 1 CACHE 20 NOORDER  NOCYCLE;';
$texto_campos=''; 
$tipo_campo_temp='';
$campos=listar_campos_tabla_externa($tabla,$conexion1);
for($i=0;$i<$campos["cantidad"];$i++){
  $tipo_campo_temp=tipo_campo($campos["campos"][$i][1],$conexion1,$conexion2);
  $texto_campos.=''.$campos["campos"][$i][0].' '.$tipo_campo_temp." ";
  //Validar la forma en que se deben tratar los default dependiendo del motor y tipo de dato
  if($campos["campos"][$i][3]){
    $texto_campos.=" DEFAULT '".$campos["campos"][$i][3]."'";
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

$texto.='<br>CREATE TABLE '.strtolower($tabla).' (';
$texto.=$texto_campos;
if($conexion2->Conn->Motor=="Oracle"){
  $texto.=' CONSTRAINT '.strtolower($tabla).' PRIMARY KEY (id'.$tabla.')';
  $texto.=')LOGGING NOCOMPRESS NOCACHE NOPARALLEL MONITORING;';
  $texto.=' TABLESPACE '.$conexion2->Conn->Tablespace.';';  
  $texto.='<br>CREATE OR REPLACE TRIGGER '.strtolower($tabla).'_TRG BEFORE INSERT ON '.strtolower($tabla).' FOR EACH ROW BEGIN  IF INSERTING AND :NEW.ID'.strtolower($tabla).' IS NULL THEN SELECT '.strtolower($tabla).'_SEQ.NEXTVAL INTO :NEW.ID'.strtolower($tabla).' FROM DUAL; END IF; END;';
}
else if($conexion2->Conn->Motor=='MySql'){
  $texto.='PRIMARY KEY  (id'.$tabla.') )ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;';
  $texto.='ALTER TABLE  '.$tabla.' CHANGE id'.$tabla.' id'.$tabla.' INT( 11 ) NOT NULL AUTO_INCREMENT;';
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
      return($texto." ".dato_enum($conexion2->Conn->Motor,$longitud));
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
  $longitud=' (11) ';  
}
switch($motor2){
  case "Oracle":    
    $cadena='number('.$longitud.',0)';
  break;
  case "MySql":
    $cadena='int ('.$longitud.')';
  break;
}
return($cadena);  
}
function dato_varchar($motor2,$longitud){
if($longitud==''){
  $longitud='(255)';  
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
function dato_enum($motor2,$longitud){
	switch($motor2){
		case "MySql":
			$cadena='enum('.$longitud.')';
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
function comparar_campos($conexion1,$conexion2,$tabla,$tipo_alter){
global $texto_alter;
$campos=listar_campos_tabla_externa($tabla,$conexion1);
$sql_alter='';
$texto='';
for($i=0;$i<$campos["cantidad"];$i++){
  $existe_campo=" 0k ";
  $sql_alter_temp='';
  $obliga='';
  $verifica_campo=listar_campos_tabla_externa($tabla,$conexion2,$campos["campos"][$i][0]);
  if(!$verifica_campo["cantidad"]){
  	if($campos["campos"][$i][3]){
  		$obliga.=" DEFAULT '".$campos["campos"][$i][3]."'";;
  	}
  	if($campos["campos"][$i][2]=="NO"){
  		$obliga.=' NOT NULL';
  	}
  	else{
  		$obliga.=' NULL';
  	}
  	if($tipo_alter==1){
    	$sql_alter.="ALTER TABLE ".strtolower($tabla)." ADD  ".strtolower($campos["campos"][$i][0])." ".strtolower($campos["campos"][$i][1])." ".$obliga.";<br>"; 
  	}	
  	else if($tipo_alter==2){
  		$sql_alter.="ALTER TABLE ".strtolower($tabla)." DROP  ".strtolower($campos["campos"][$i][0]).";<br>";
  	}
  }
  else{
  	if($tipo_alter==1){
	    $sql_alter_temp=verificar_campos($campos["campos"][$i],$verifica_campo["campos"][0],$tabla);
	    if($sql_alter_temp){
	      $sql_alter.=$sql_alter_temp;
	      $texto.='<tr class="error"><td>'.$verifica_campo["campos"][0][0].'</td><td>'.$verifica_campo["campos"][0][1].'</td><td>'.$verifica_campo["campos"][0][2].'</td><td>'.$existe_campo.'</td>';
	    }
	    else{
	      $texto.='<tr><td>'.$verifica_campo["campos"][0][0].'</td><td class="size">'.$verifica_campo["campos"][0][1].'</td><td class="obligatorio">'.$verifica_campo["campos"][0][2].'</td><td class="'.trim($existe_campo).'">'.$existe_campo.'</td>';    
	    }
  	}    
  }
}
if($sql_alter){
	if($tipo_alter==1){
		$clase="info";
	}
	else if($tipo_alter==2){
		$clase="error";
	}
	$texto.='<tr class="'.$clase.'"><td colspan="4">'.$sql_alter.'</td></tr>';
	$texto_alter.=$sql_alter."<br>";
}	
return($texto);
}
//Retorna FALSE SI SON IGUALES DE LO CONTRARIO DEVUELVE EL ALTER TABLE DEL CAMPO
function verificar_campos($campo1,$campo2,$tabla){	
	$diferencias=array_diff($campo1,$campo2);
	$obliga='';
	if(count($diferencias)){
		//se debe verificar como se configura para los valores que estan como default 0 o default ' '
		if(!empty($campo1[3])){
			$obliga.=" DEFAULT '".$campo1[3]."' ";
		}
		if($campo1[2]=="NO"){
			$obliga.=' NOT NULL';
		}
		else{
			$obliga.=' NULL';
		}
		$texto='ALTER TABLE '.$tabla." CHANGE ".$campo1[0]." ".$campo1[0]." ".$campo1[1]." ".$obliga.";<br>";
		return($texto);
	}
	
	return(false);
}
?>
