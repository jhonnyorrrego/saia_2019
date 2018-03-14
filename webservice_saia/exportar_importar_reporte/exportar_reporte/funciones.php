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
include_once($ruta_db_superior."db.php");

function generar_idreporte($datos){
	global $conn; 
	$datos = json_decode($datos);
	$idbusqueda=busca_filtro_tabla("idbusqueda","busqueda","lower(nombre)='".$datos->nombre_reporte."'","",$conn);
	$retorno=array();
	$retorno['exito']=0;
	if($idbusqueda['numcampos']){
		$retorno['idreporte']=$idbusqueda[0]['idbusqueda'];
		$retorno['exito']=1;
	}
	ob_end_clean();
	return(json_encode($retorno));
}

function generar_array_keys($consulta,$keys_no=array()){
	if(count($consulta)){
		$keys=array_keys($consulta[0]); //obtengo keys
		$keys_num = array_filter($keys, "is_numeric"); //filtro llaves numericas
		$keys=array_diff($keys, $keys_num); //retiro las llaves numericas
		if(count($keys_no)){
			$keys=array_diff($keys, $keys_no); //retiro llaves no permitidas
		}
		$keys=array_values($keys); //reseteo posiciones			
		return($keys);	
	}else{
		return(0);
	} 
} 

function generar_datos_busqueda($idbusqueda){
	global $conn;
	//DATOS busqueda
		$busqueda=array();
		$datos_busqueda=busca_filtro_tabla("","busqueda","idbusqueda=".$idbusqueda,"",$conn);
		if($datos_busqueda["numcampos"]){
    		$keys_no=array('idbusqueda');
    		$keys = generar_array_keys($datos_busqueda,$keys_no);
    		$cant_columnas=count($keys);
    		for($i=0;$i<$cant_columnas;$i++){
    				$busqueda['datos_busqueda'][$keys[$i]]=$datos_busqueda[0][$keys[$i]];
    		}
		}
		else{
		    $busqueda['error_datos_busqueda'][]="No existe la busqueda en el sistema";
		}
		return($busqueda);		
}
function generar_modulo($idmodulo){
    $modulo=array();
	$datos_modulo=busca_filtro_tabla("","modulo","idmodulo=".$idmodulo,"",$conn);
	if($datos_modulo["numcampos"]){
		$keys_no=array('idmodulo');
		$keys = generar_array_keys($datos_modulo,$keys_no);
		$cant_columnas=count($keys);
		for($i=0;$i<$cant_columnas;$i++){
		    if($keys[$i]=="enlace"){
		        $modulo[$keys[$i]]=preg_replace("/(\w+)=([0-9])+/", "$1={*$1*}", $datos_modulo[0][$keys[$i]]);
		    }
		    else if($keys[$i]=='cod_padre'){
		        if($datos_modulo[0][$keys[$i]]){
		            $modulo["modulo_padre"]=generar_modulo($datos_modulo[0][$keys[$i]]);
		        }
		        else{
		            $modulo[$keys[$i]]='';
		        }
		    }
		    else{
			    $modulo[$keys[$i]]=$datos_modulo[0][$keys[$i]];
		    }
		}
	}
	return($modulo);		
}
function generar_busqueda_componente($idbusqueda){
	global $conn; 
		$busqueda=array();
		$datos_busqueda=busca_filtro_tabla("","busqueda_componente","busqueda_idbusqueda=".$idbusqueda,"orden ASC",$conn);
		$keys_no = array("busqueda_idbusqueda",'idbusqueda_componente','modulo_idmodulo'); //llaves no permitidas
		$keys = generar_array_keys($datos_busqueda,$keys_no);
        for($a=0;$a<$datos_busqueda["numcampos"];$a++){		
            for($i=0;$i<count($keys);$i++){
    			$busqueda[$a][$keys[$i]]=$datos_busqueda[$a][$keys[$i]];
    		}
    		$busqueda[$a]['modulo']=generar_modulo($datos_busqueda[$a]["modulo_idmodulo"]);
    		$busqueda[$a]["busqueda_condicion"]=generar_busqueda_condicion($datos_busqueda[$a]["idbusqueda_componente"],"fk_busqueda_componente");
    		$busqueda[$a]["busqueda_encabezado"]=generar_busqueda_encabezado($datos_busqueda[$a]["idbusqueda_componente"]);
    		$busqueda[$a]["busqueda_grafico"]=generar_busqueda_grafico($datos_busqueda[$a]["idbusqueda_componente"]);
    		$busqueda[$a]["busqueda_indicador"]=generar_busqueda_indicador($datos_busqueda[$a]["idbusqueda_componente"]);
        }
		return($busqueda);		
}
//Se debe enviar la llave para definir se sale el listado de las busquedas condicion relacionados con la busqueda o con la busqueda_componente
function generar_busqueda_condicion($idbusqueda,$llave){
	global $conn; 
		$busqueda=array();
		$datos_busqueda=busca_filtro_tabla("","busqueda_condicion",$llave."=".$idbusqueda,"",$conn);
		$keys_no = array('busqueda_idbusqueda','idbusqueda_condicion','fk_busqueda_componente'); //llaves no permitidas
		$keys = generar_array_keys($datos_busqueda,$keys_no);
		for($a=0;$a<$datos_busqueda["numcampos"];$a++){
		    for($i=0;$i<count($keys);$i++){
			    $busqueda[$a][$keys[$i]]=$datos_busqueda[$a][$keys[$i]];
		    }
		    $condicion_enlace=busca_filtro_tabla("","busqueda_condicion_enlace","fk_busqueda_condicion=".$datos_busqueda[$a]["idbusqueda_condicion"],"",$conn);
		    for($j=0;$j<$condicion_enlace["numcampos"];$j++){
		        $busqueda[$a]["busqueda_condicion_enlace"][$j]["comparacion"]=$condicion_enlace[$j]["comparacion"];
		        $busqueda[$a]["busqueda_condicion_enlace"][$j]["orden"]=$condicion_enlace[$j]["orden"];
		        $busqueda[$a]["busqueda_condicion_enlace"][$j]["estado"]=$condicion_enlace[$j]["estado"];
		        //TODO: Pendiente validar si se va a utilizar con el desarrollo de interfaz para las busquedas
		        $busqueda[$a]["busqueda_condicion_enlace"][$j]["cod_padre"]=$condicion_enlace[$j]["cod_padre"];
		    }
		}
		return($busqueda);		
}
function generar_busqueda_encabezado($idbusqueda){
	global $conn; 
		$busqueda=array();
		$datos_busqueda=busca_filtro_tabla("","busqueda_encabezado","fk_idbusqueda_componente=".$idbusqueda,"",$conn);
		$keys_no = array('fk_idbusqueda_componente'); //llaves no permitidas
		$keys = generar_array_keys($datos_busqueda,$keys_no);
		for($a=0;$a<$datos_busqueda["numcampos"];$a++){
		    for($i=0;$i<count($keys);$i++){
			    $busqueda[$a][$keys[$i]]=$datos_busqueda[$a][$keys[$i]];
		    }
		}
		return($busqueda);		
}
function generar_busqueda_indicador($idbusqueda){
	global $conn; 
		$busqueda=array();
		$datos_busqueda=busca_filtro_tabla("","busqueda_indicador","busqueda_idbusqueda_componente=".$idbusqueda,"",$conn);
		$keys_no = array('idbusqueda_indicador','indicador_idindicador','busqueda_idbusqueda_componente'); //llaves no permitidas
		$keys = generar_array_keys($datos_busqueda,$keys_no);
		for($a=0;$a<$datos_busqueda["numcampos"];$a++){
		    for($i=0;$i<count($keys);$i++){
			    $busqueda[$a][$keys[$i]]=$datos_busqueda[$a][$keys[$i]];
		    }
		    $indicador=busca_filtro_tabla("","indicador","idindicador=".$datos_busqueda[$a]["indicador_idindicador"],"",$conn);
		    for($j=0;$j<$indicador["numcampos"];$j++){
		        $busqueda[$a]["indicador"][$j]["ruta_formulario"]=$indicador[$j]["ruta_formulario"];
		        $busqueda[$a]["indicador"][$j]["etiqueta"]=$indicador[$j]["etiqueta"];
		        $busqueda[$a]["indicador"][$j]["nombre"]=$indicador[$j]["nombre"];
		        $busqueda[$a]["indicador"][$j]["librerias"]=$indicador[$j]["librerias"];
		    }
		}
		return($busqueda);		
}
function generar_busqueda_grafico($idbusqueda){
	global $conn; 
		$busqueda=array();
		$datos_busqueda=busca_filtro_tabla("","busqueda_grafico","busqueda_idbusqueda_componente=".$idbusqueda,"",$conn);
		$keys_no = array('idbusqueda_grafico','busqueda_idbusqueda_componente', 'indicador_idindicador'); //llaves no permitidas
		$keys = generar_array_keys($datos_busqueda,$keys_no);
		$keys_no_gs = array('busqueda_grafico_idbusqueda_grafico','idbusqueda_grafico_serie'); //llaves no permitidas
		for($a=0;$a<$datos_busqueda["numcampos"];$a++){
		    for($i=0;$i<count($keys);$i++){
			    $busqueda[$a][$keys[$i]]=$datos_busqueda[$a][$keys[$i]];
		    }
		    $indicador=busca_filtro_tabla("","indicador","idindicador=".$datos_busqueda[$a]["indicador_idindicador"],"",$conn);
		    for($j=0;$j<$indicador["numcampos"];$j++){
		        $busqueda[$a]["indicador"][$j]["ruta_formulario"]=$indicador[$j]["ruta_formulario"];
		        $busqueda[$a]["indicador"][$j]["etiqueta"]=$indicador[$j]["etiqueta"];
		        $busqueda[$a]["indicador"][$j]["nombre"]=$indicador[$j]["nombre"];
		        $busqueda[$a]["indicador"][$j]["librerias"]=$indicador[$j]["librerias"];
		    }
		    $grafico_serie=busca_filtro_tabla("","busqueda_grafico_serie","busqueda_grafico_idbusqueda_grafico=".$datos_busqueda[$a]["idbusqueda_grafico"],"",$conn);
		    $keys_gs = generar_array_keys($grafico_serie,$keys_no_gs);
		    for($j=0;$j<$grafico_serie["numcampos"];$j++){
		        for($i=0;$i<count($keys_gs);$i++){
			        $busqueda[$a]["grafico_serie"][$j][$keys_gs[$i]]=$grafico_serie[$j][$keys_gs[$i]];
		        }
		    }
		}
		return($busqueda);		
}
function generar_exportar($datos){
	global $conn; 
	$datos = json_decode($datos);
	$idbusqueda=$datos->idreporte;
	$busqueda=array();
	$busqueda['exito']=0;
	$existe_busqueda=busca_filtro_tabla("idbusqueda","busqueda","idbusqueda=".$idbusqueda,"",$conn);
	if($existe_busqueda['numcampos']){
		$busqueda['exito']=1;
		$datos_busqueda = generar_datos_busqueda($idbusqueda);
		$busqueda_componente['busqueda_componente'] = generar_busqueda_componente($idbusqueda);
		$busqueda_condicion["busqueda_condicion"] = generar_busqueda_condicion($idbusqueda,"busqueda_idbusqueda");		
		$busqueda = array_merge($busqueda, $datos_busqueda,$busqueda_componente,$busqueda_condicion);
	}
	ob_end_clean();
	return(json_encode($busqueda));
}
?>