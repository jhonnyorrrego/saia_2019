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
    $identidad_serie=$_REQUEST['identidad_serie'];
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
	
    if($accion==1){//insertar o actualizar
    	$sqlc = "INSERT INTO permiso_serie (entidad_identidad,fk_entidad_serie,llave_entidad,estado,permiso) VALUES (" . $entidad_identidad . "," . $identidad_serie . "," . $llave_entidad . ",1,'l')";
    }//eliminar
		else if($accion==2){//
				$sqlc = "UPDATE permiso_serie SET permiso = '$permisos' WHERE entidad_identidad = $entidad_identidad AND fk_entidad_serie = $identidad_serie AND llave_entidad=$llave_entidad AND estado = 1"; 
		}
		
    else{//
			$sqlc="DELETE FROM permiso_serie WHERE entidad_identidad=".$entidad_identidad." AND fk_entidad_serie=".$identidad_serie." AND llave_entidad=".$llave_entidad; 
		}
    phpmkr_query($sqlc) or die($sqlc);   
   
	$retorno=array();
    $retorno['accion']=$accion;
	$retorno['sqlc']=$sqlc;
	$retorno['exito']=$_REQUEST['permiso'];
    echo(json_encode($retorno));
    //die();
}
?>