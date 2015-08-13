<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}

if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
  @session_start();
  $_SESSION["LOGIN".LLAVE_SAIA]="radicador_web";
  $_SESSION["usuario_actual"]="123456";
  $_SESSION["conexion_remota"]=1;
}
else{  
  $_SESSION["conexion_remota"]=1;
}

include_once($ruta_db_superior ."db.php");
include_once($ruta_db_superior ."librerias_saia.php");

function almacenar_ejecutor($request){					
 	$ejecutor = agregar_ejecutor_externo($request);
	return $ejecutor;			 
}

function agregar_ejecutor_externo($datos){      
        $nuevo_ejecutor = array('identificacion' => $datos['identificacion'],'nombre'=> $datos['nombres_apellidos']);
        $nuevo_datos_ejecutor = array('direccion' => $datos['direccion'],'telefono'=> $datos['telefono'],'email'=>$datos['email']);		
				                        
    if(!strcmp($nuevo_ejecutor['nombre'],"Nombres y Apellidos") || !strcmp($nuevo_ejecutor['nombre'],"")){
        //no hace nada
    }else{    	
        $idejecutor = obtener_ejecutor($nuevo_ejecutor['identificacion'],$nuevo_ejecutor['nombre']);				            
        if(!$idejecutor){        	        	
            $idejecutor = agregar_ejecutor($nuevo_ejecutor);
            $iddatos_ejecutor = agregar_datos_ejecutor($idejecutor, $nuevo_datos_ejecutor);			                                
        }else{        	                
            $iddatos_ejecutor = obtener_datos_ejecutor($idejecutor,$nuevo_datos_ejecutor);                                        
            if(!$iddatos_ejecutor){
                $iddatos_ejecutor = agregar_datos_ejecutor($idejecutor,$nuevo_datos_ejecutor);
            }
        }
        $nuevo_ejecutor['idejecutor'] = $idejecutor;
        return $nuevo_ejecutor;
    }        
}

function obtener_ejecutor($identifiacion, $nombre){
	global $conn;    
    $idejecutor = busca_filtro_tabla("idejecutor","ejecutor","identificacion=".$identifiacion." AND LOWER (nombre) LIKE '".$nombre."'","", $conn);    
    if($idejecutor['numcampos']){
       return $idejecutor[0]['idejecutor'];
    }else{
       return false;
    }
}
function obtener_datos_ejecutor($idejecutor, $datos){
    global $conn;    
    $valor_campo = busca_filtro_tabla('iddatos_ejecutor',"datos_ejecutor","ejecutor_idejecutor=".$idejecutor." AND LOWER (direccion) LIKE '".$datos['direccion']."' AND telefono=".$datos['telefono']." AND LOWER(email) LIKE '".$datos['email']."'","", $conn);           
    if($valor_campo['numcampos']){
        return $valor_campo[0]['iddatos_ejecutor'];
    }else{
        return false;
    }    
}
function agregar_ejecutor($array_datos){
	global $conn;							
    $sql_ejecutor = "INSERT INTO ejecutor(identificacion, nombre, fecha_ingreso)VALUES('".$array_datos['identificacion']."', '".$array_datos['nombre']."',".fecha_db_almacenar(date('Y-m-d H:m:s'),'Y-m-d H:m:s').")";			    	
    phpmkr_query($sql_ejecutor);   
    $idejecutor = phpmkr_insert_id();   
    return $idejecutor;
}

function agregar_datos_ejecutor($idejecutor,$array_datos){   
    $sql_datos_ejecutor = "INSERT INTO datos_ejecutor (ejecutor_idejecutor, direccion, telefono, cargo, ciudad, titulo, empresa, fecha, email, codigo) VALUES(".$idejecutor.", '".$array_datos['direccion']."', '".$array_datos['telefono']."','".$array_datos['cargo']."',".$array_datos['ciudad'].", '".$array_datos['titulo']."','".$array_datos['empresa']."', '".date('Y-m-d H:m:s')."','".$array_datos['email']."','".$array_datos['codigo']."')";        
    phpmkr_query($sql_datos_ejecutor);
    $iddatos_ejecutor = phpmkr_insert_id();        
    return $iddatos_ejecutor;
}

function obtener_idmunicipio($nombre){
    if(is_numeric($nombre)){
        return $nombre;
    }else{
        $idmunicipio = busca_filtro_tabla("idmunicipio","municipio","LOWER(nombre) LIKE '".$nombre."'","",$conn);        
        if($idmunicipio['numcampos']){
            return $idmunicipio[0]['idmunicipio'];
        }else{
            return false;
        }
    }
    
}


?>