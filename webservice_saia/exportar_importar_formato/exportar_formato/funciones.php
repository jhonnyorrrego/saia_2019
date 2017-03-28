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
include_once($ruta_db_superior."define.php");
if(!@$_SESSION["LOGIN".LLAVE_SAIA]){
  @session_start();
  $_SESSION["LOGIN".LLAVE_SAIA]=LOGIN_LOGIN;
  $_SESSION["usuario_actual"]=FUNCIONARIO_CODIGO_LOGIN;
  $_SESSION["conexion_remota"]=1; 
}
include_once($ruta_db_superior."db.php");

function generar_idformato($datos){
	global $conn; 
	$datos = json_decode($datos);	
	$idformato=busca_filtro_tabla("idformato","formato","lower(nombre)='".$datos->nombre_formato."'","",$conn);
	$retorno=array();
	$retorno['exito']=0;
	if($idformato['numcampos']){
		$retorno['idformato']=$idformato[0]['idformato'];
		$retorno['exito']=1;
	}
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

function generar_datos_formato($idformato){
	global $conn;
	
	//DATOS FORMATO
		$formato=array();
		$datos_formato=busca_filtro_tabla("","formato","idformato=".$idformato,"",$conn);
		$keys_no=array('idformato');
		$keys = generar_array_keys($datos_formato,$keys_no);
		
		$campos_especiales=array('cod_padre','contador_idcontador','encabezado','pie_pagina','funcionario_idfuncionario','fecha','serie_idserie','fk_categoria_formato'); //campos con validaciones particulares
		for($i=0;$i<count($keys);$i++){
			
			if(in_array($keys[$i], $campos_especiales)){
				if($datos_formato[0][$keys[$i]]){
					switch($keys[$i]){
						case 'cod_padre':
							$nombre_padre=busca_filtro_tabla("nombre","formato","idformato=".$datos_formato[0][$keys[$i]],"",$conn);	
							$formato['datos_formato']['cod_padre']=$nombre_padre[0]['nombre'];						
							break;
						case 'contador_idcontador':
							$nombre_contador=busca_filtro_tabla("nombre","contador","idcontador=".$datos_formato[0][$keys[$i]],"",$conn);	
							$formato['datos_formato']['contador_idcontador']=$nombre_contador[0]['nombre'];
							break;		
						case 'encabezado':
							$encabezado=busca_filtro_tabla("","encabezado_formato","idencabezado_formato=".$datos_formato[0][$keys[$i]],"",$conn);
							$formato['datos_formato']['encabezado_etiqueta']=$encabezado[0]['etiqueta'];
							$formato['datos_formato']['encabezado_contenido']=$encabezado[0]['contenido'];					
							break;	
						case 'pie_pagina':
							$pie=busca_filtro_tabla("","encabezado_formato","idencabezado_formato=".$datos_formato[0][$keys[$i]],"",$conn);
							$formato['datos_formato']['pie_etiqueta']=$pie[0]['etiqueta'];
							$formato['datos_formato']['pie_contenido']=$pie[0]['contenido'];				
							break;	
						case 'funcionario_idfuncionario':
							$formato['datos_formato'][$keys[$i]]=1;
							break;		
						case 'fecha':
							$formato['datos_formato'][$keys[$i]]=date('Y-m-d H:i:s');
							break;			
						case 'serie_idserie':
							$serie_formato=busca_filtro_tabla("nombre","serie","idserie=".$datos_formato[0][$keys[$i]],"",$conn);
							$formato['datos_formato']['nombre_serie']=$serie_formato[0]['nombre'];
							break;		
						case 'fk_categoria_formato':
							$categorias_formato=busca_filtro_tabla("nombre","categoria_formato","idcategoria_formato IN(".$datos_formato[0][$keys[$i]].")","",$conn);
							$nombres_categorias=implode(',',extrae_campo($categorias_formato,'nombre'));
							$formato['datos_formato']['nombre_categorias']=$nombres_categorias;
							break;																						
					}				
				}
			}else{
				$formato['datos_formato'][$keys[$i]]=$datos_formato[0][$keys[$i]];
			}
		}
		return($formato);		
}
function generar_campos_formato($idformato){
	global $conn; 

		//CAMPOS_FORMATO
		$formato=array();
		$campos_formato=busca_filtro_tabla("","campos_formato","formato_idformato=".$idformato,"orden ASC",$conn);
		$keys_no = array('formato_idformato','idcampos_formato'); //llaves no permitidas
		$keys = generar_array_keys($campos_formato,$keys_no);
		for($j=0;$j<$campos_formato['numcampos'];$j++){
			for($i=0;$i<count($keys);$i++){
				$formato['campos_formato'][$j][$keys[$i]]=$campos_formato[$j][$keys[$i]];
			}
		}	
		return($formato);		
}
function generar_funciones_formato($idformato){
	global $conn; 

		//FUNCIONES_FORMATO
		$formato=array();
		$condicional="formato LIKE'%,$idformato,%' OR formato LIKE '$idformato,%' OR formato LIKE'%,$idformato' OR formato='$idformato'";
		$funciones_formato=busca_filtro_tabla("","funciones_formato",$condicional,"",$conn);
		
		if($funciones_formato['numcampos']){
			$keys_no = array('idfunciones_formato','formato'); //llaves no permitidas
			$keys = generar_array_keys($funciones_formato,$keys_no);
			for($j=0;$j<$funciones_formato['numcampos'];$j++){	
				for($i=0;$i<count($keys);$i++){
					$formato['funciones_formato'][$j][$keys[$i]]=$funciones_formato[$j][$keys[$i]];
				} 
				
				//FUNCIONES_FORMATO_ACCION
				$funciones_formato_accion=busca_filtro_tabla("","funciones_formato_accion","formato_idformato=".$idformato." AND idfunciones_formato=".$funciones_formato[$j]['idfunciones_formato'],"",$conn);
				if($funciones_formato_accion['numcampos']){
					for($x=0;$x<$funciones_formato_accion['numcampos'];$x++){
						$formato['funciones_formato'][$j]['accion_funcion'][$x]['momento']=$funciones_formato_accion[$x]['momento'];	
						$formato['funciones_formato'][$j]['accion_funcion'][$x]['estado']=$funciones_formato_accion[$x]['estado'];
						$formato['funciones_formato'][$j]['accion_funcion'][$x]['orden']=$funciones_formato_accion[$x]['orden'];
						$nombre_accion=busca_filtro_tabla("nombre","accion","idaccion=".$funciones_formato_accion[$x]['accion_idaccion'],"",$conn); 
						$formato['funciones_formato'][$j]['accion_funcion'][$x]['nombre_accion']=$nombre_accion[$x]['nombre'];					
					}
				} //fin if $funciones_formato_accion numcampos			
			}//fin for $funciones_formato
		} //fin if $funciones_formato numcampos
		return($formato);	
}
function generar_exportar($datos){
	global $conn; 
	$datos = json_decode($datos);
	$idformato=$datos->idformato;
	$formato=array();
	$formato['exito']=0;
	
	$existe_formato=busca_filtro_tabla("idformato","formato","idformato=".$idformato,"",$conn);
	if($existe_formato['numcampos']){
		$formato['exito']=1;
		$datos_formato = generar_datos_formato($idformato);
		$campos_formato = generar_campos_formato($idformato);
		$funciones_formato = generar_funciones_formato($idformato);		
		$formato = array_merge($formato, $datos_formato,$campos_formato,$funciones_formato);
	}
	return(json_encode($formato));
}	
?>