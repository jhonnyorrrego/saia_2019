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

$busqueda=array();
$busqueda['exito']=0;
$busqueda['mensaje']=array();
function validar_campos_arreglo($arreglo,$tabla,$keys_no_validas){
    global $busqueda;
    $retorno=array();
    $retorno["mensaje"]='';
    $retorno["valida_campos_tabla"]=1;
	$retorno["tabla"]=$tabla;
    //VALIDO busqueda
	$keys_datos_busqueda=array_keys($arreglo);  //keys recibidas
	for($i=0;$i<count($keys_datos_busqueda);$i++){
		if(in_array($keys_datos_busqueda[$i],$keys_no_validas)){
			unset($keys_datos_busqueda[$i]);
		}
	}
	$keys_datos_busqueda=array_values($keys_datos_busqueda);
	$keys_datos_busqueda=array_diff($keys_datos_busqueda, $keys_no_validas); //esto no esta en release1
	
	$keys_busqueda_insertar=listar_campos_tabla($tabla);  //key a insertar
	$keys_busqueda_insertar=array_map('strtolower', $keys_busqueda_insertar);
	$campos_no_encontrados=array_diff($keys_datos_busqueda,$keys_busqueda_insertar);
	if(count($campos_no_encontrados)){
	    $busqueda["exito"]=0;
		$cadena_valida_campos.="Los siguientes campos no existen en la tabla ".$tabla." en el servidor destino: ".implode(',',$campos_no_encontrados)."<br>";
		//ALTER TABLE `busqueda_componente` ADD `funciones_agregacion` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL AFTER `info`
		$busqueda["error_".$tabla][]=$cadena_valida_campos;
		$retorno["valida_campos_tabla"]=$valida_campos_tabla;
	}
	return($retorno);
}
function generar_importar($datos){
	global $conn,$busqueda; 
	$datos = json_decode($datos,true);
	$valida_campos_tabla=1;
	$cadena_valida_campos="";
	if($datos["usuario_saia_radica_ws"]){
		$usuario_saia=busca_filtro_tabla("idfuncionario,login,funcionario_codigo","funcionario","login='".$datos["usuario_saia_radica_ws"]."' AND estado=1","",$conn);
		if($usuario_saia["numcampos"]){
			session_start();
			$_SESSION["LOGIN".LLAVE_SAIA]=$usuario_saia[0]["login"];
			$_SESSION["idfuncionario"]=$usuario_saia[0]["idfuncionario"];
			$_SESSION["usuario_actual"]=$usuario_saia[0]["funcionario_codigo"];
			$usuactual=$_SESSION["LOGIN".LLAVE_SAIA];
		}
		else{
		    $valida_campos_tabla=0;
			return(json_encode(array("exito"=>0,"msn"=>"No se encuentra el funcionario para crear la sesion y almacenar la informacion")));
		}
	}	
	if($datos["datos_busqueda"]["nombre"]==""){
	    $busqueda["exito"]=0;
	    array_push($busqueda["mensaje"],"El nombre de la busqueda no puede ser vacio");
	    $valida_campos_tabla=0;
	}
	$existe_busqueda=busca_filtro_tabla("","busqueda","lower(nombre)='".strtolower($datos['datos_busqueda']['nombre'])."'","",$conn);
    if($existe_busqueda["numcampos"]){
        array_push($busqueda["mensaje"],"La busqueda ".$datos["datos_busqueda"]["nombre"]." ya existe.");
	    array_push($busqueda["warning_busqueda"],"La busqueda ".$datos["datos_busqueda"]["nombre"]." ya existe.");
	}
	//VALIDA busqueda
	$valida_campos=validar_campos_arreglo($datos["datos_busqueda"],"busqueda",array());
	
	$cadena_valida_campos.=$valida_campos["mensaje"];
	$cant_componentes=count($datos["busqueda_componente"]);
    if($valida_campos_tabla)
	    $valida_campos_tabla=$valida_campos["valida_campos_tabla"];
    //VALIDO busqueda_componente
	if(@$cant_componentes){
        $keys_no_validas=array('busqueda_condicion','busqueda_encabezado','busqueda_grafico',"modulo","busqueda_indicador");
    	$valida_campos=validar_campos_arreglo($datos["busqueda_componente"][0],"busqueda_componente",$keys_no_validas);
    	$cadena_valida_campos.=$valida_campos["mensaje"];
    	//se valida porque si es 1 implica que no se encuentra error, si es 0 debe reportar error sin importar el nuevo estado 
    	if($valida_campos_tabla)
    	    $valida_campos_tabla=$valida_campos["valida_campos_tabla"];
	}
	//VALIDO busqueda_condicion vinculada con la busqueda pilas  que se debe repetir para validar el enlace con busqueda_componente
	if(@count($datos['busqueda_condicion'])){
        $keys_no_validas=array('busqueda_condicion_enlace');
    	$valida_campos=validar_campos_arreglo($datos["busqueda_componente"][0],"busqueda_condicion",$keys_no_validas);
    	$cadena_valida_campos.=$valida_campos["mensaje"];
    	if($valida_campos_tabla)
    	    $valida_campos_tabla=$valida_campos["valida_campos_tabla"];
	}
	$validaciones=array("busqueda_encabezado"=>0,"busqueda_grafico"=>0,"busqueda_condicion"=>0);
	for($i=0;$i<$cant_componentes;$i++){
	    //VALIDO busqueda_encabezado
    	 if(count($datos["busqueda_componente"][$i]["busqueda_encabezado"]) && !$validaciones["busqueda_encabezado"]){
            $keys_no_validas=array();
        	$valida_campos=validar_campos_arreglo($datos["busqueda_componente"][$i]["busqueda_encabezado"],"busqueda_encabezado",$keys_no_validas);
        	$cadena_valida_campos.=$valida_campos["mensaje"];
        	if($valida_campos_tabla)
        	    $valida_campos_tabla=$valida_campos["valida_campos_tabla"];
        	$validaciones["busqueda_encabezado"]=1;
    	}
    	//VALIDO busqueda_grafico
    	if(count($datos["busqueda_componente"][$i]["busqueda_grafico"])&& !$validaciones["busqueda_grafico"]){
            $keys_no_validas=array("indicador","grafico_serie");
        	$valida_campos=validar_campos_arreglo($datos["busqueda_componente"][$i]["busqueda_grafico"][0],"busqueda_grafico",$keys_no_validas);
        	$cadena_valida_campos.=$valida_campos["mensaje"];
        	if($valida_campos_tabla)
        	    $valida_campos_tabla=$valida_campos["valida_campos_tabla"];
        	$validaciones["busqueda_grafico"]=1;    
    	}
    	//VALIDO busqueda_indicador
    	if(count($datos["busqueda_componente"][$i]["busqueda_indicador"])&& !$validaciones["busqueda_indicador"]){
            $keys_no_validas=array("indicador");
        	$valida_campos=validar_campos_arreglo($datos["busqueda_componente"][$i]["busqueda_indicador"][0],"busqueda_indicador",$keys_no_validas);
        	$cadena_valida_campos.=$valida_campos["mensaje"];
        	if($valida_campos_tabla)
        	    $valida_campos_tabla=$valida_campos["valida_campos_tabla"];
        	$validaciones["busqueda_indicador"]=1;    
    	}
	}
	//Pilas quitar esto cuando se terminen las pruebas 
	//$valida_campos_tabla=1;
	
    //FIN VALIDA que el nombre no sea vacio que el formato no exista y que los campos de las tablas existen en el destino
	if($valida_campos_tabla){
		//INICIO INSERT busqueda
		$result_busqueda=insertar_registro("busqueda","nombre='".$datos["datos_busqueda"]["nombre"]."'",array_keys($datos['datos_busqueda']), array_values($datos['datos_busqueda']));
		$consulta_insert_busqueda=busca_filtro_tabla("idbusqueda","busqueda","lower(nombre)='".strtolower($datos['datos_busqueda']['nombre'])."'","",$conn);
		
		if($consulta_insert_busqueda['numcampos']){
			$idbusqueda=$consulta_insert_busqueda[0]['idbusqueda'];
		}
		
		if(@$idbusqueda){
			$busqueda['exito']=1;
			if($datos["datos_busqueda"]["tablas"]){
			    $busqueda["tablas"][]=$datos['datos_busqueda']["tablas"];
			}
			if($datos['datos_busqueda']['ruta_librerias']){
			    $busqueda["archivos"][]=$datos['datos_busqueda']['ruta_librerias'];
			}
			if($datos['datos_busqueda']['ruta_librerias_pantallas']){
			    $busqueda["archivos"][]=$datos['datos_busqueda']['ruta_librerias_pantallas'];
			}
			if($datos['datos_busqueda']['ruta_visualizacion']){
			    $busqueda["archivos"][]=$datos['datos_busqueda']['ruta_visualizacion'];
			}
			
		}else{
			$busqueda['exito']=0;
			array_push($busqueda['mensaje'],"Existe un error con la busqueda ".$datos["datos_busqueda"]["nombre"]);
		}
		if(@$cant_componentes && @$idbusqueda){
			for($i=0;$i<$cant_componentes;$i++){
				$datos['busqueda_componente'][$i]['busqueda_idbusqueda']=$idbusqueda;
				if(count($datos["busqueda_componente"][$i]["modulo"])){
				    $modulo=insertar_modulo($datos["busqueda_componente"][$i]["modulo"]);
			        $datos["busqueda_componente"][$i]["modulo_idmodulo"]=$modulo;
				}
                $datos_temp=$datos['busqueda_componente'][$i];
                unset($datos_temp["busqueda_grafico"]);
                unset($datos_temp["busqueda_indicador"]);
                unset($datos_temp["busqueda_condicion"]);
                unset($datos_temp["busqueda_encabezado"]);
                unset($datos_temp["modulo"]);
                if($datos['busqueda_componente'][$i]["tablas_adicionales"]){
                    $busqueda["tablas"][]=$datos['busqueda_componente'][$i]["tablas_adicionales"];
                }
			    $idbusqueda_componente=insertar_registro("busqueda_componente","nombre='".$datos["busqueda_componente"][$i]["nombre"]."'",array_keys($datos_temp),array_values($datos_temp));
				if($idbusqueda_componente){
				    if($datos["busqueda_componente"][$i]["url"]){
				        $busqueda["archivos"][]=$datos["busqueda_componente"][$i]["url"];
				    }
				    if($datos['busqueda_componente'][$i]['busqueda_avanzada']){
			            $busqueda["archivos"][]=$datos['busqueda_componente'][$i]['busqueda_avanzada'];
			        }
			        if($datos['busqueda_componente'][$i]['enlace_adicionar']){
			            $busqueda["archivos"][]=$datos['busqueda_componente'][$i]['enlace_adicionar'];
			        }
			        if($datos['busqueda_componente'][$i]['tablas_adicionales']){
            		    $busqueda["tablas"][]=$datos['busqueda_componente'][$i]['tablas_adicionales'];
            		}
				    $cant_graficos=count($datos["busqueda_componente"][$i]["busqueda_grafico"]);
				    for($j=0;$j<$cant_graficos;$j++){
				        $busqueda_grafico=$datos["busqueda_componente"][$i]["busqueda_grafico"][$j];
				        //El indicador[0] debido a que partimos del hecho de que el modelo esta formado para que una relacion uno a muchos indicador->busqueda_grafico (un indicador a muchas busqueda_grafico)
				        $indicador=insertar_registro("indicador","nombre='".$busqueda_grafico["indicador"][0]["nombre"]."'",array_keys($busqueda_grafico["indicador"][0]),array_values($busqueda_grafico["indicador"][0]));
				        $busqueda_grafico_tmp=$busqueda_grafico;
				        $busqueda_grafico_tmp["indicador_idindicador"]=$indicador;
				        if($busqueda_grafico["indicador"][0]){
            		        $busqueda["archivos"][]=$busqueda_grafico["indicador"][0]["ruta_formulario"];
            		    }  
				        $busqueda_grafico_tmp["busqueda_idbusqueda_componente"]=$idbusqueda_componente;
				        unset($busqueda_grafico_tmp["indicador"]);
				        unset($busqueda_grafico_tmp["grafico_serie"]);
				        $idbusqueda_grafico=insertar_registro("busqueda_grafico","nombre='".$busqueda_grafico["nombre"]."'",array_keys($busqueda_grafico_tmp),array_values($busqueda_grafico_tmp));
				        if($idbusqueda_grafico){
				            $cant_graficos_series=count($busqueda_grafico["grafico_serie"]);
				            for($k=0;$k<$cant_graficos_series;$k++){
				                $busqueda_grafico["grafico_serie"][$k]["busqueda_grafico_idbusqueda_grafico"]=$idbusqueda_grafico;
				                $idbusqueda_grafico_serie=insertar_registro("busqueda_grafico_serie","nombre='".$busqueda_grafico["grafico_serie"][$k]["nombre"]."'",array_keys($busqueda_grafico["grafico_serie"][$k]),array_values($busqueda_grafico["grafico_serie"][$k]));
				            }
				        }//if busqueda_grafico
				    }//for $cant_graficos
				    $cant_bindicador=count($datos["busqueda_componente"][$i]["busqueda_indicador"]);
				    for($j=0;$j<$cant_bindicador;$j++){
				        $busqueda_indicador=$datos["busqueda_componente"][$i]["busqueda_indicador"][$j];
				        //El indicador[0] debido a que partimos del hecho de que el modelo esta formado para que una relacion uno a muchos indicador->busqueda_indicador (un indicador a muchas busqueda_indicador)
				        $indicador=insertar_registro("indicador","nombre='".$busqueda_indicador["indicador"][0]["nombre"]."'",array_keys($busqueda_indicador["indicador"][0]),array_values($busqueda_indicador["indicador"][0]));
				        $busqueda_indicador_tmp=$busqueda_indicador;
				        $busqueda_indicador_tmp["indicador_idindicador"]=$indicador;
				        $busqueda_indicador_tmp["busqueda_idbusqueda_componente"]=$idbusqueda_componente;
				        if($busqueda_indicador["indicador"][0]){
            		        $busqueda["archivos"][]=$busqueda_indicador["indicador"][0]["ruta_formulario"];
            		    }
				        unset($busqueda_indicador_tmp["indicador"]);
				        $idbusqueda_indicador=insertar_registro("busqueda_indicador","nombre='".$busqueda_indicador["nombre"]."'",array_keys($busqueda_indicador_tmp),array_values($busqueda_indicador_tmp));
				    }//for $cant_bindicador
				    $cant_condiciones=count($datos["busqueda_componente"][$i]["busqueda_condicion"]);
				    for($j=0;$j<$cant_condiciones;$j++){
				        $busqueda_condicion=$datos["busqueda_componente"][$i]["busqueda_condicion"][$j];
				        $busqueda_condicion["fk_busqueda_componente"]=$idbusqueda_componente;
				        $idbusqueda_condicion=insertar_registro("busqueda_condicion","etiqueta_condicion='".$busqueda_condicion["etiqueta_condicion"]."'",array_keys($busqueda_condicion),array_values($busqueda_condicion));
				        if($idbusqueda_condicion){
				            $cant_condiciones_enlace=count($busqueda_condicion["busqueda_condicion_enlace"]);
				            $actuales=busca_filtro_tabla("B.idbusqueda_condicion_enlace,A.etiqueta_condicion,B.comparacion","busqueda_condicion A, busqueda_condicion_enlace B"," A.idbusqueda_condicion=B.fk_busqueda_condicion AND A.etiqueta_condicion='".$busqueda_condicion["etiqueta_condicion"]."'","",$conn);
				            $arreglo_etiqueta_comparacion=array();
			                for($l=0;$l<$actuales["numcampos"];$l++){
			                    //TODO: el ultimo parametro debe ir ya que en versiones diferentes de php hace retornos diferentes, se debe investigar mejor
			                   $arreglo_etiqueta_comparacion[$actuales[$l]["idbusqueda_condicion_enlace"]]=hash("md5",$actuales[$l]["etiqueta_condicion"].$actuales[$l]["comparacion"],false);
			                }
				            for($k=0;$k<$cant_condiciones_enlace;$k++){
				                $idbusqueda_condicion_enlace=0;
				                $actuales=busca_filtro_tabla("B.idbusqueda_condicion_enlace,A.etiqueta_condicion,B.comparacion","busqueda_condicion A, busqueda_condicion_enlace B"," A.idbusqueda_condicion=B.fk_busqueda_condicion AND A.etiqueta_condicion='".$busqueda_condicion["etiqueta_condicion"]."' AND (B.comparacion='".$busqueda_condicion["busqueda_condicion_enlace"][$k]["comparacion"]."' OR B.comparacion='' OR B.comparacion='1=1')","",$conn);
                                if($actuales["numcampos"]){
                                    $idbusqueda_condicion_enlace=$actuales[0]["idbusqueda_condicion_enlace"];
                                    $busqueda["warning_busqueda_condicion_enlace"][]="busqueda_condicion_enlace ya existe con id :".$idbusqueda_condicion_enlace." y SQL:".$actuales["sql"];
                                }
				                if(!$idbusqueda_condicion_enlace){
				                    //1=0 porque en la condicion anterior se valida que no existe la condicion enlace 
				                    $idbusqueda_condicion_enlace=insertar_registro("busqueda_condicion_enlace","1=0",array_keys($busqueda_condicion["condicion_serie"][$k]),array_values($busqueda_condicion["condicion_serie"][$k]));
				                }
				            }
				            if(count($datos["busqueda_componente"][$i]["busqueda_encabezado"])){
				               $idbusqueda_encabezado=insertar_registro("busqueda_encabezado","encabezado='".$datos["busqueda_componente"][$i]["busqueda_encabezado"][0]["encabezado"]."' AND pie='".$datos["busqueda_componente"][$i]["busqueda_encabezado"][0]["pie"]."'",array_keys($busqueda_condicion["condicion_serie"][$k]),array_values($busqueda_condicion["condicion_serie"][$k]));
				            }
				        }//if busqueda_condicion
				    }//for $cant_condicions
				    
				}//if busqueda_componente
			}//for $cant_componentes
		}
	} //fin if valida campos
	ob_end_clean();
	$busqueda["archivos"]=implode(",",$busqueda["archivos"]);
	$busqueda["archivos"]=explode(",",$busqueda["archivos"]);
	$busqueda["archivos"]=array_unique($busqueda["archivos"]);
	sort($busqueda["archivos"]);
	foreach($busqueda["archivos"] AS $key=>$valor){
	    $temp=explode("?",$valor);
	    $busqueda["archivos"][$key]=$temp[0];
	}
	$busqueda["tablas"]=implode(",",$busqueda["tablas"]);
	$busqueda["tablas"]=explode(",",$busqueda["tablas"]);
	$busqueda["tablas"]=array_unique($busqueda["tablas"]);
	sort($busqueda["tablas"]);
	return(json_encode($busqueda));
}	
function insertar_modulo($datos_modulo){
    $cod_padre=0;
    $modulo=array();
    $modulo["error_modulo"]=array();
    if($datos_modulo["modulo_padre"]){
        $cod_padre=insertar_modulo($datos_modulo["modulo_padre"]);
        if($cod_padre){
            $datos_modulo["cod_padre"]=$cod_padre;
        }
    }
    unset($datos_modulo["modulo_padre"]);
    $modulo=insertar_registro("modulo","nombre='".$datos_modulo["nombre"]."'",array_keys($datos_modulo),array_values($datos_modulo));
    return($modulo);
}
function insertar_registro($tabla,$where_llave,$keys,$values){
    global $busqueda;
    $existe=busca_filtro_tabla('',$tabla,$where_llave,'',$conn);
    if(!$existe["numcampos"]){
    	$strsql = "INSERT INTO ".$tabla." (";
    	$strsql .= implode(",",$keys );			
    	$strsql .= ") VALUES ('";			
    	$strsql .= implode("','",$values);			
    	$strsql .= "')";
    	phpmkr_query($strsql);
        $idregistro_temp=phpmkr_insert_id();
        $existe2=busca_filtro_tabla('',$tabla,$where_llave,'',$conn);
        if($existe2["numcampos"]){
            $idregistro=$idregistro_temp;
            $busqueda["insertados_".$tabla]["sql"][]=$strsql;
            $busqueda["insertados_".$tabla]["registros"][]=$idregistro;
        }
        else{
            $idregistro=0;
            $busqueda["error_".$tabla][]=$tabla." No es posible crear el registro ".$tabla." con el SQL:".$strsql;
        }
    }
    else{
    	$busqueda["warning_".$tabla][]=$tabla." ya existe con id=".$existe[0]["id".$tabla]." y SQL: SELECT * FROM ".$tabla." WHERE ".$where_llave;
    	$idregistro=$existe[0]["id".$tabla];
    }
	return($idregistro);
}

?>