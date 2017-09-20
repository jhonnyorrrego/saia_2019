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
$_SESSION["LOGIN".LLAVE_SAIA]='cerok';
$_SESSION["LOGIN"]='cerok';
include_once($ruta_db_superior."db.php");
$retorno=array();
$resultado=array();
$particiones=array();
$mensaje="";
$alerta=0;

$cliente=busca_filtro_tabla("valor","configuracion","nombre='nombre'","",$conn);
if($cliente['numcampos']){
    $retorno['bd']='ok';
}else{
    $retorno['bd']='no_ok';
}

exec("df -h",$resultado);
unset($resultado[0]);
for ($i=1; $i < count($resultado); $i++) {
	$parti=explode("%", $resultado[$i]);
  	$particiones[]=trim($parti[1]);
}
for ($i=0; $i < count($particiones); $i++) { 
	$dev = $particiones[$i];
    
	$freespace = disk_free_space($dev);
	$totalspace = disk_total_space($dev);
	$freespace_mb = $freespace/1024/1024;
	$totalspace_mb = $totalspace/1024/1024;
	$freespace_percent = ($freespace/$totalspace)*100;
	$used_percent = (1-($freespace/$totalspace))*100;
	$retorno["disco"][$i]['particion']=$dev;
    $retorno["disco"][$i]['espacio_total']=$totalspace_mb;
    $retorno["disco"][$i]['espacio_libre']=$freespace_mb;
    $retorno["disco"][$i]['porcent_libre']=$freespace_percent;
}
echo(json_encode($retorno));
@session_unset();
@session_destroy();
?>