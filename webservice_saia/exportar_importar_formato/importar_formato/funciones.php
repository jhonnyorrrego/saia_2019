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
 
function crear_modulo_formato_importar($idformato) {
	global $conn;
	$datos_formato = busca_filtro_tabla("nombre,etiqueta,cod_padre,nombre_tabla,ruta_mostrar,ruta_adicionar", "formato", "idformato=" . $idformato, "", $conn);
	$modulo_formato = busca_filtro_tabla("", "modulo", "nombre = 'modulo_formatos'", "", $conn);
	if(!$modulo_formato['numcampos']){
		$modulo_formato = busca_filtro_tabla("", "modulo", "nombre = 'creacion_formatos'", "", $conn);
	}
	if($modulo_formato["numcampos"]) {
		$submodulo_formato = busca_filtro_tabla("", "modulo", "nombre ='" . $datos_formato[0]["nombre"] . "'", "", $conn);
		if(!$submodulo_formato["numcampos"]) {
			$padre = busca_filtro_tabla("idmodulo", "formato A, modulo B", "idformato=" . $datos_formato[0]["cod_padre"] . " AND lower(A.nombre)=(B.nombre)", "", $conn);
			if($padre["numcampos"] > 0) {
				$papa = $padre[0]["idmodulo"];
			} else {
				$papa = $modulo_formato[0]["idmodulo"];
			}
			$sql = "INSERT INTO modulo(nombre,tipo,imagen,etiqueta,enlace,destino,cod_padre,orden,ayuda,busqueda) VALUES ('" . $datos_formato[0]["nombre"] . "','secundario','botones/formatos/modulo.gif','" . $datos_formato[0]["etiqueta"] . "','formatos/" . $datos_formato[0]["ruta_mostrar"] . "','centro','" . $papa . "','1','Permite administrar el formato " . $datos_formato[0]["etiqueta"] . ".',1)";
			
			//guardar_traza($sql, $datos_formato[0]["nombre_tabla"]);
			phpmkr_query($sql, $conn);
			$modulo_id = phpmkr_insert_id();
			$sql = "INSERT INTO permiso(funcionario_idfuncionario,modulo_idmodulo) VALUES('" . usuario_actual("id") . "'," . $modulo_id . ")";
			//guardar_traza($sql, $datos_formato[0]["nombre_tabla"]);
			phpmkr_query($sql, $conn);
		} else {
			$padre = busca_filtro_tabla("idmodulo", "formato A, modulo B", "idformato=" . $datos_formato[0]["cod_padre"] . " AND lower(A.nombre)=(B.nombre)", "", $conn);
			if($padre["numcampos"] > 0) {
				$papa = $padre[0]["idmodulo"];
			} else {
				$papa = $modulo_formato[0]["idmodulo"];
			}
			$sql = "update modulo set nombre='" . $datos_formato[0]["nombre"] . "',etiqueta='" . $datos_formato[0]["etiqueta"] . "',cod_padre='" . $papa . "' where idmodulo=" . $submodulo_formato[0]["idmodulo"];
			//guardar_traza($sql, $datos_formato[0]["nombre_tabla"]);
			phpmkr_query($sql, $conn);
		}
	}
	$modulo_crear = busca_filtro_tabla("", "modulo", "nombre = 'creacion_formatos'", "", $conn);
	if($modulo_crear["numcampos"]) {
		$submodulo_formato = busca_filtro_tabla("", "modulo", "nombre = 'crear_" . $datos_formato[0]["nombre"] . "'", "", $conn);
		if(!$submodulo_formato["numcampos"]) {
			$sql = "INSERT INTO modulo(nombre,tipo,imagen,etiqueta,enlace,destino,cod_padre,orden,ayuda) VALUES ('crear_" . $datos_formato[0]["nombre"] . "','secundario','botones/formatos/modulo.gif','Crear " . $datos_formato[0]["etiqueta"] . "','formatos/" . $datos_formato[0]["ruta_adicionar"] . "','centro','" . $modulo_crear[0]["idmodulo"] . "','1','Permite crear " . $datos_formato[0]["etiqueta"] . ".')";
			// /die($sql);
			//guardar_traza($sql, $formato[0]["nombre_tabla"]);
			phpmkr_query($sql, $conn);
		}
	}
}

function validar_contador($nombre_contador){
	global $conn;
	
	$existe_contador=busca_filtro_tabla("idcontador","contador","lower(nombre)='".strtolower($nombre_contador)."'","",$conn);
	if($existe_contador['numcampos']){ //existe contador
		$idcontador=$existe_contador[0]['idcontador'];
	}else{ //no existe contador
		$insert_contador=array();
		$insert_contador['consecutivo']=1;
		$insert_contador['nombre']=$nombre_contador;
		$insert_contador['reiniciar_cambio_anio']=0;
		$tabla="contador";
		$strsql = "INSERT INTO ".$tabla." (";
		$strsql .= implode(",", array_keys($insert_contador));			
		$strsql .= ") VALUES ('";			
		$strsql .= implode("','", array_values($insert_contador));			
		$strsql .= "')";			
		phpmkr_query($strsql);
		$idcontador=phpmkr_insert_id();
	}
	return($idcontador);	
}

function validar_encabezado_pie($etiqueta,$contenido){
	global $conn,$formato; 
	$idencabezado_formato=array();
	$existe_encabezado=busca_filtro_tabla("idencabezado_formato","encabezado_formato","lower(etiqueta)='".strtolower($etiqueta)."'","",$conn);	
	if($existe_encabezado['numcampos']){ //existe encabezado
		$idencabezado_formato['idencabezado_formato']=$existe_encabezado[0]['idencabezado_formato'];
	}else{ //no existe encabezado
		$insert_encabezado_pie=array();
		$insert_encabezado_pie['contenido']=$contenido;
		$insert_encabezado_pie['etiqueta']=$etiqueta;
		$tabla="encabezado_formato";
		$strsql = "INSERT INTO ".$tabla." (";
		$strsql .= implode(",", array_keys($insert_encabezado_pie));			
		$strsql .= ") VALUES ('";			
		$strsql .= implode("','", array_values($insert_encabezado_pie));			
		$strsql .= "')";			
		phpmkr_query($strsql);
		$idencabezado_formato['idencabezado_formato']=phpmkr_insert_id();
		$idencabezado_formato['sql_encabezado_pie']=$strsql;		
		
	}
	return($idencabezado_formato);			
}
function validar_serie($nombre_serie){
	global $conn; 
	
	$existe_serie=busca_filtro_tabla("idserie","serie","lower(nombre)='".strtolower($nombre_serie)."'","",$conn);	
	if($existe_serie['numcampos']){ //exite serie
		$idserie=$existe_serie[0]['idserie'];
	}else{ //no existe encabezado
		$insert_serie=array();
		$insert_serie['nombre']=$nombre_serie;
		$insert_serie['dias_entrega']=8;
		$insert_serie['retencion_gestion']=3;
		$insert_serie['retencion_central']=5;
		$insert_serie['copia']=0;
		$insert_serie['tipo']=0;
		$insert_serie['clase']=1;
		$insert_serie['estado']=1;
		$insert_serie['categoria']=3;
		$tabla="serie";
		$strsql = "INSERT INTO ".$tabla." (";
		$strsql .= implode(",", array_keys($insert_serie));			
		$strsql .= ") VALUES ('";			
		$strsql .= implode("','", array_values($insert_serie));			
		$strsql .= "')";			
		phpmkr_query($strsql);
		$idserie=phpmkr_insert_id();				
	}
	return($idserie);	
	
}

function validar_categorias($nombre_categorias){
	global $conn;
	
	$vector_nombre_categorias=explode(',',$nombre_categorias);
	$vector_fk_categoria_formato=array();
	$vector_no_insertadas=array();
	for($i=0;$i<count($vector_nombre_categorias);$i++){
		$existe_categoria=busca_filtro_tabla("idcategoria_formato","categoria_formato","lower(nombre)='".strtolower($vector_nombre_categorias[$i])."'","",$conn);
		
		if($existe_categoria['numcampos']){ //existe categoria formato
			$vector_fk_categoria_formato[]=$existe_categoria[0]['idcategoria_formato'];
		}else{ //no existe categoria formato
			$insert_categoria_formato=array();
			$insert_categoria_formato['nombre']=$vector_nombre_categorias[$i];
			$insert_categoria_formato['cod_padre']=0;
			$insert_categoria_formato['estado']=1;
			$tabla="categoria_formato";
			$strsql = "INSERT INTO ".$tabla." (";
			$strsql .= implode(",", array_keys($insert_categoria_formato));			
			$strsql .= ") VALUES ('";			
			$strsql .= implode("','", array_values($insert_categoria_formato));			
			$strsql .= "')";			
			phpmkr_query($strsql);
				
			if( phpmkr_insert_id() ){
				$vector_fk_categoria_formato[]=phpmkr_insert_id();	
			}else{
				$vector_no_insertadas[]=$strsql;
			}
				
		}
	}
	$fk_categoria_formato=array();
	$fk_categoria_formato['categorias_no_insertadas']=$vector_no_insertadas;
	$fk_categoria_formato['fk_categoria_formato']=implode(',',$vector_fk_categoria_formato);
	return($fk_categoria_formato);		
	
}

function validar_cod_padre($nombre_padre){
	global $conn;
	
	$existe_padre=busca_filtro_tabla("idformato","formato","lower(nombre)='".strtolower($nombre_padre)."'","",$conn);
	if($existe_padre['numcampos']){
		$cod_padre=$existe_padre[0]['idformato'];
	}else{
		$cod_padre=0; //no existe padre
	}
	return($cod_padre);
}

function generar_importar($datos){
	global $conn; 
	$datos = json_decode($datos,true);
	$formato=array();
	$formato['exito']=0;
	
	
	
//VALIDA CAMPOS TALBA
	$valida_campos_tabla=1;
	$cadena_valida_campos="";
	
	//VALIDO FORMATO
	$keys_datos_formato=array_keys($datos['datos_formato']);  //keys recibidas
	$keys_no_validas=array('encabezado_etiqueta','encabezado_contenido','pie_etiqueta','pie_contenido','nombre_serie','nombre_categorias');
	for($i=0;$i<count($keys_datos_formato);$i++){
		if(in_array($keys_datos_formato[$i],$keys_no_validas)){
			unset($keys_datos_formato[$i]);
		}
	}
	$keys_datos_formato=array_values($keys_datos_formato);
	$keys_datos_formato=array_diff($keys_datos_formato, $keys_no_validas); //esto no esta en release1
	$keys_datos_formato[]='encabezado';
	$keys_datos_formato[]='pie_pagina';
	$keys_datos_formato[]='serie_idserie';
	$keys_datos_formato[]='fk_categoria_formato';
	
	$keys_formato_insertar=listar_campos_tabla('formato');  //key a insertar
	$keys_formato_insertar=array_map('strtolower', $keys_formato_insertar);
	$campos_no_encontrados=array_diff($keys_datos_formato,$keys_formato_insertar);
	if(count($campos_no_encontrados)){
		$cadena_valida_campos.="Los siguientes campos no existen en la tabla formato destino: ".implode(',',$campos_no_encontrados)."<br><br>";
		$formato['mensaje']=$cadena_valida_campos;
		$valida_campos_tabla=0;
	}	
	//VALIDO CAMPOS_FORMATO
	if(@$datos['campos_formato']){
		$keys_campos_formato=array_keys($datos['campos_formato'][0]);  //keys campos_formato recibidas
		$keys_campos_formato_insertar=listar_campos_tabla('campos_formato');  //keys a insertar
		$keys_campos_formato_insertar=array_map('strtolower', $keys_campos_formato_insertar);
		$campos_formato_no_encontrados=array_diff($keys_campos_formato,$keys_campos_formato_insertar);
		if(count($campos_formato_no_encontrados)){
			$cadena_valida_campos.="Los siguientes campos no existen en la tabla campos_formato destino: ".implode(',',$campos_formato_no_encontrados)."<br><br>";
			$formato['mensaje']=$cadena_valida_campos;
			$valida_campos_tabla=0;			
		}	
	}
	//VALIDO FUNCIONES_FORMATO
	if(@$datos['funciones_formato']){
		$keys_funciones_formato=array_keys($datos['funciones_formato'][0]);  //keys campos_formato recibidas
		$keys_no_validas=array('accion_funcion');
		for($i=0;$i<count($keys_funciones_formato);$i++){
			if(in_array($keys_funciones_formato[$i], $keys_no_validas)){
				unset($keys_funciones_formato[$i]);
			}
		}
		$keys_funciones_formato=array_values($keys_funciones_formato);		
		$keys_funciones_formato[]='formato';
		$keys_funciones_formato_insertar=listar_campos_tabla('funciones_formato');  //keys a insertar
		$keys_funciones_formato_insertar=array_map('strtolower', $keys_funciones_formato_insertar);
		$funciones_formato_no_encontrados=array_diff($keys_funciones_formato,$keys_funciones_formato_insertar);
		if(count($funciones_formato_no_encontrados)){
			$cadena_valida_campos.="Los siguientes campos no existen en la tabla funciones_formato destino: ".implode(',',$funciones_formato_no_encontrados)."<br><br>";
			$formato['mensaje']=$cadena_valida_campos;
			$valida_campos_tabla=0;			
		}	
	}
	//VALIDO FUNCIONES_FORMATO_ACCION
	if(@$datos['funciones_formato']){
		if(@$datos['funciones_formato'][0]['accion_funcion']){
			$keys_funciones_formato_accion=array_keys($datos['funciones_formato'][0]['accion_funcion'][0]);  //keys campos_formato recibidas
			$keys_no_validas=array('nombre_accion');
			for($i=0;$i<count($keys_funciones_formato_accion);$i++){
				if(in_array($keys_funciones_formato_accion[$i], $keys_no_validas)){
					unset($keys_funciones_formato_accion[$i]);
				}
			}
			$keys_funciones_formato_accion=array_values($keys_funciones_formato_accion);		
			$keys_funciones_formato_accion[]='accion_idaccion';
			$keys_funciones_formato_accion[]='formato_idformato';
			$keys_funciones_formato_accion[]='idfunciones_formato';
			$keys_funciones_formato_accion_insertar=listar_campos_tabla('funciones_formato_accion');  //keys a insertar
			$keys_funciones_formato_accion_insertar=array_map('strtolower', $keys_funciones_formato_accion_insertar);
			$funciones_formato_accion_no_encontrados=array_diff($keys_funciones_formato_accion,$keys_funciones_formato_accion_insertar);
			if(count($funciones_formato_accion_no_encontrados)){
				$cadena_valida_campos.="Los siguientes campos no existen en la tabla funciones_formato_accion destino: ".implode(',',$funciones_formato_accion_no_encontrados)."<br><br>";
				$formato['mensaje']=$cadena_valida_campos;
				$valida_campos_tabla=0;			
			}	
		}
	}	
//FIN VALIDA CAMPOS TALBA

	if($valida_campos_tabla){
	
		$existe_formato=busca_filtro_tabla("","formato","lower(nombre)='".strtolower($datos['datos_formato']['nombre'])."'","",$conn);
		
		if($existe_formato['numcampos']){
			//desarrollo cuando existe el formato
			$formato['mensaje']="El formato ya existe";
			
		}else{
			//desarrollo cuando no existe el formato		
	
		//INICIO INSERT FORMATO
			$insertar_formato=1;
			//CONTADOR
			if($datos['datos_formato']['contador_idcontador']){
				$datos['datos_formato']['contador_idcontador']=validar_contador($datos['datos_formato']['contador_idcontador']);
				if(!$datos['datos_formato']['contador_idcontador']){
					$insertar_formato=0;
					$formato['mensaje']="No fue posible crear el contador";					
				}
				
			} 
			//ENCABEZADO
			if($datos['datos_formato']['encabezado_etiqueta'] && $datos['datos_formato']['encabezado_contenido']){
				$idencabezado_formato=validar_encabezado_pie($datos['datos_formato']['encabezado_etiqueta'],$datos['datos_formato']['encabezado_contenido']);
				
				if($idencabezado_formato['idencabezado_formato']){
					$datos['datos_formato']['encabezado']=$idencabezado_formato['idencabezado_formato'];					
				}else{
					$insertar_formato=0;
					$formato['mensaje']="No fue posible crear el encabezado: ".$idencabezado_formato['sql_encabezado_pie'];					
				}
				unset($datos['datos_formato']['encabezado_etiqueta']);	
				unset($datos['datos_formato']['encabezado_contenido']);	
			}
			//PIE_PAGINA
			if($datos['datos_formato']['pie_etiqueta'] && $datos['datos_formato']['pie_contenido']){
				$idencabezado_formato=validar_encabezado_pie($datos['datos_formato']['pie_etiqueta'],$datos['datos_formato']['pie_contenido']);
				
				if($idencabezado_formato['idencabezado_formato']){
					$datos['datos_formato']['pie_pagina']=$idencabezado_formato['idencabezado_formato'];				
				}else{
					$insertar_formato=0;
					$formato['mensaje']="No fue posible crear el pie de pagina: ".$idencabezado_formato['sql_encabezado_pie'];					
				}
				unset($datos['datos_formato']['pie_etiqueta']);	
				unset($datos['datos_formato']['pie_contenido']);	
			}		
			//SERIE
			if($datos['datos_formato']['nombre_serie']){
				$idserie=validar_serie($datos['datos_formato']['nombre_serie']);
				
				if($idserie){
					unset($datos['datos_formato']['nombre_serie']);	
					$datos['datos_formato']['serie_idserie']=$idserie;					
				}else{
					$insertar_formato=0;
					$formato['mensaje']="No fue posible crear la serie del formato";					
				}
			}
			
			//CATERGORIA_FORMATO
			if($datos['datos_formato']['nombre_categorias']){
				$fk_categoria_formato=validar_categorias($datos['datos_formato']['nombre_categorias']);
				unset($datos['datos_formato']['nombre_categorias']);	
				$datos['datos_formato']['fk_categoria_formato']=$fk_categoria_formato['fk_categoria_formato'];
				if(@$fk_categoria_formato['categorias_no_insertadas']){
					$formato['exito']=0;
					$insertar_formato=0;
					$formato['mensaje']="No se pudo crear las siguientes categorias: ".implode(',',$fk_categoria_formato['categorias_no_insertadas']);
				}
				
				
			}		
			//COD_PADRE
			if($datos['datos_formato']['cod_padre']){
				$cod_padre=validar_cod_padre($datos['datos_formato']['cod_padre']);
				if(!$cod_padre){
					$insertar_formato=0;
					$formato['mensaje']="No existe el formato Padre";
				}
				$datos['datos_formato']['cod_padre']=$cod_padre;
			}		
				
            unset($datos['datos_formato']['fecha']);//FECHA
			
			if($insertar_formato){
				$tabla="formato";
				$strsql = "INSERT INTO ".$tabla." (fecha,"; //FECHA
				$strsql .= implode(",", array_keys($datos['datos_formato']));			
				$strsql .= ") VALUES (".fecha_db_almacenar(date('Y-m-d H:i:s'),'Y-m-d H:i:s').",'";	//FECHA		
				$strsql .= implode("','", array_values($datos['datos_formato']));			
				$strsql .= "')";
				phpmkr_query($strsql);
				$idformato=phpmkr_insert_id();	
				
				if($idformato){
					$formato['exito']=1;
					$formato['mensaje']="Formato Creado con Exito!";
					crear_modulo_formato_importar($idformato);
				}else{
					$formato['exito']=0;
					$formato['mensaje']="Inconvenientes al generar el insert del formato: ".$strsql;
				}

			}
			
		//FIN INSERT FORMATO
			
	
		//INICIO INSERT CAMPOS_FORMATO	
			if(@$datos['campos_formato'] && @$idformato){
				$vector_idcampos_formato=array();
				for($i=0;$i<count($datos['campos_formato']);$i++){
					$datos['campos_formato'][$i]['formato_idformato']=$idformato;
					$tabla="campos_formato";
					$strsql = "INSERT INTO ".$tabla." (";
					$strsql .= implode(",", array_keys($datos['campos_formato'][$i]));			
					$strsql .= ") VALUES ('";			
					$strsql .= implode("','", array_values($datos['campos_formato'][$i]));			
					$strsql .= "')";
					phpmkr_query($strsql);
					$idcampos_formato=0;
					$idcampos_formato=phpmkr_insert_id();
					if($idcampos_formato){
						$vector_idcampos_formato[]=$idcampos_formato;
					}else{
						$formato['campos_formato_error']['campos_formato_error_'.$i]=$strsql;
					}
				}
				$idcampos_formato=implode(',',$vector_idcampos_formato);		
			}
		//FIN INSERT CAMPOS_FORMATO	
		
		
		
		//INICIO INSERT FUNCIONES_FORMATO
			if(@$datos['funciones_formato'] && @$idformato){
				for($i=0;$i<count($datos['funciones_formato']);$i++){
					
					$existe_funcion=busca_filtro_tabla("idfunciones_formato,formato","funciones_formato","lower(nombre_funcion)='".strtolower($datos['funciones_formato'][$i]['nombre_funcion'])."'","",$conn);
					
					if($existe_funcion['numcampos']){
						$vector_formatos_funcion=explode(',',$existe_funcion[0]['formato']);
						$vector_formatos_funcion[]=$idformato;
						$vector_formatos_funcion=array_unique($vector_formatos_funcion);
						$cadena_formatos_funcion=implode(',',$vector_formatos_funcion);
						$strsql="UPDATE funciones_formato SET formato='".$cadena_formatos_funcion."' WHERE idfunciones_formato=".$existe_funcion[0]['idfunciones_formato'];
						phpmkr_query($strsql);
						$idfunciones_formato=$existe_funcion[0]['idfunciones_formato'];
						
					}else{
						$datos['funciones_formato'][$i]['formato']=$idformato;
						$vector_funciones_formato=$datos['funciones_formato'][$i];
						unset($vector_funciones_formato['accion_funcion']);
						
						$tabla="funciones_formato";
						$strsql = "INSERT INTO ".$tabla." (";
						$strsql .= implode(",", array_keys($vector_funciones_formato));			
						$strsql .= ") VALUES ('";			
						$strsql .= implode("','", array_values($vector_funciones_formato));			
						$strsql .= "')";
						phpmkr_query($strsql);
						$idfunciones_formato=0;
						$idfunciones_formato=phpmkr_insert_id();		
					}
					
					if(!$idfunciones_formato){
						$formato['funciones_formato_error']['funciones_formato_error_'.$i]=$strsql;
					}
					
					
					
					//FUNCIONES_FORMATO_ACCION
					if(@$idfunciones_formato && @$datos['funciones_formato'][$i]['accion_funcion']){
						for($j=0;$j<count($datos['funciones_formato'][$i]['accion_funcion']);$j++){
							
							$vector_accion_funcion=$datos['funciones_formato'][$i]['accion_funcion'][$j];
							
							$accion_sistema=busca_filtro_tabla("idaccion","accion","lower(nombre)='".strtolower($vector_accion_funcion['nombre_accion'])."'","",$conn);
							if($accion_sistema['numcampos']){ //existe la accion en el sistema
								$existe_accion_funcion=busca_filtro_tabla("","funciones_formato_accion","formato_idformato=".$idformato." AND accion_idaccion=".$accion_sistema[0]['idaccion']." AND idfunciones_formato=".$idfunciones_formato." AND lower(momento)='".strtolower($vector_accion_funcion['momento'])."'","",$conn);
							
								if(!$existe_accion_funcion['numcampos']){
									unset($vector_accion_funcion['nombre_accion']);
									$vector_accion_funcion['accion_idaccion']=$accion_sistema[0]['idaccion'];
									$vector_accion_funcion['formato_idformato']=$idformato;
									$vector_accion_funcion['idfunciones_formato']=$idfunciones_formato;
									
									$tabla="funciones_formato_accion";
									$strsql = "INSERT INTO ".$tabla." (";
									$strsql .= implode(",", array_keys($vector_accion_funcion));			
									$strsql .= ") VALUES ('";			
									$strsql .= implode("','", array_values($vector_accion_funcion));			
									$strsql .= "')";
									phpmkr_query($strsql);
									$idfunciones_formato_accion=0;
									$idfunciones_formato_accion=phpmkr_insert_id();	
									if(!$idfunciones_formato_accion){
										$formato['funciones_formato_accion_error']['funciones_formato_accion_error_'.$j]=$strsql;
									}									
									
																
								}
							
							}
							
	
						}
					} //fin if FUNCIONES_FORMATO_ACCION
	
				}//FIN FOR FUNCIONES_FORMATO	
			}//FIN INSERT FUNCIONES_FORMATO		
			
							
		}

	} //fin if valida campos
		
	return(json_encode($formato));
}	



?>