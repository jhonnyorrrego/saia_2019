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
include_once($ruta_db_superior . 'db.php');
if($_REQUEST['id']){
    $accion=$_REQUEST['accion'];
	$llave_entidad=$_REQUEST['id'];
    $idserie=$_REQUEST['serie'];
    $entidad_identidad=$_REQUEST['tipo_entidad'];       
    if(isset($_REQUEST['permiso']))//permiso para editar
    {
    	if($_REQUEST['permiso']==1)
    	{
    		$permisos = "l,a,v";
		}
		else{
			$permisos = "l";
		}
    }
	
	$buscar_permisos = busca_filtro_tabla("", "permiso_serie", "estado=1 and serie_idserie=".$idserie." and entidad_identidad=".$entidad_identidad." and llave_entidad=".$llave_entidad." and permiso like '%a,v'", "", $conn);		
	if($buscar_permisos["numcampos"]){
		$actualizar="si";
	}
	else{
		$actualizar="no";
	}
    if($accion==1){//insertar o actualizar
    	$sqlc = "INSERT INTO permiso_serie (entidad_identidad,serie_idserie,llave_entidad,estado,permiso) VALUES (" . $entidad_identidad . "," . $idserie . "," . $llave_entidad . ",1,'l')";
    }//eliminar
		else if($accion==2){//
				$sqlc = "UPDATE permiso_serie SET permiso = '$permisos' WHERE entidad_identidad = $entidad_identidad AND serie_idserie = $idserie AND llave_entidad=$llave_entidad AND estado = 1"; 
		}
		
    else{//
			$sqlc="DELETE FROM permiso_serie WHERE entidad_identidad=".$entidad_identidad." AND serie_idserie=".$idserie." AND llave_entidad=".$llave_entidad; 
		}
    phpmkr_query($sqlc,$conn);   
   
	$retorno=array();
    $retorno['accion']=$accion;
	$retorno['sqlc']=$sqlc;
    echo(json_encode($retorno));
    //die();
}
?>