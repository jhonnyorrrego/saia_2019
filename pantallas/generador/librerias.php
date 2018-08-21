<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_xml.php");
include_once ($ruta_db_superior . "pantallas/lib/librerias_componentes.php");

function adicionar_pantalla_campos($idpantalla, $idpantalla_componente, $tipo_retorno = 1) {
	global $conn, $ruta_db_superior;
	$retorno = array(
			"exito" => 0
	);
	$dato = busca_filtro_tabla("", "pantalla_componente", "idpantalla_componente=" . $idpantalla_componente, "", $conn);
	if ($dato["numcampos"]) {
		$archivos = array();
		$funciones = array();
		$sql_campos = array();
		$sql_valores = array();
		//$default_campo = new SimpleXmlIterator("<?" . "xml version='1.0' standalone='yes'?" . ">" . $dato[0]["opciones"]);
		$default_campo = json_decode($dato[0]["opciones"],true);
		$texto = $dato[0]["componente"];
		foreach ($default_campo AS $key=>$value){
			array_push($sql_campos, $key);
			if ($key == "nombre") {
				$valor = strval($value) . "_" . rand();
			} else {
				$valor = strval($value);
			}
			array_push($sql_valores, $valor);			
		}
		/*
		 * Pilas con el tema de archivos que se quita porque en ningun componente se encuentra en las opciones el campo archivo 
		 * 
		 * Ejemplo:
		 * 
		 * <pantalla_campos><nombre>campo_texto</nombre><etiqueta>Campo de texto</etiqueta><tipo_dato>varchar</tipo_dato><longitud>255</longitud><obligatoriedad>1</obligatoriedad><valor></valor><acciones>a,e,b</acciones><ayuda></ayuda><predeterminado></predeterminado><banderas></banderas><etiqueta_html>text</etiqueta_html><orden>1</orden><mascara></mascara><adicionales></adicionales><autoguardado>1</autoguardado><fila_visible>1</fila_visible><placeholder>Campo texto</placeholder>
</pantalla_campos>
		 * {"nombre":"campo_texto","etiqueta":"campo de texto","tipo_dato":"varchar","longitud":255,"obligatoriedad":1,"valor":"","acciones":"a,e,b","ayuda":"","predeterminado":"","banderas":"","etiqueta_html":"text","orden":1,"mascara":"","adicionales":"","autoguardado":1,"fila_visible":1,"placeholder":"campo texto"}
		 * 
		 * 
		 * for($default_campo->rewind(); $default_campo->valid(); $default_campo->next()) {
			if ($default_campo->key() != "archivos") {
				array_push($sql_campos, $default_campo->key());
				if ($default_campo->key() == "nombre") {
					$valor = strval($default_campo->current()) . "_" . rand();
				} else {
					$valor = strval($default_campo->current());
				}
				array_push($sql_valores, $valor);
			} else {
				$func = $default_campo->getChildren();
				if (count($func)) {
					foreach ($func as $key2 => $value2) {
						if ($key2 == "archivo")
							array_push($archivos, strval($value2[0]));
						else if ($key2 == "funcion")
							array_push($funciones, strval($value2[0]));
					}
				}
			}
		}*/
		if (in_array("formato_idformato", $sql_campos) === false) {
			array_push($sql_campos, 'formato_idformato');
			array_push($sql_valores, $idpantalla);
		}
		if (count($sql_campos) && count($sql_valores)) {
			$sql2 = "INSERT INTO campos_formato(" . implode(",", $sql_campos) . ") VALUES('" . implode("','", $sql_valores) . "')";
			$retorno["sql"] = $sql2;    
			phpmkr_query($sql2);
			$idcampo = phpmkr_insert_id();  
			$retorno["sql"]=$sql2;
			if ($idcampo) {
				$cadena = load_pantalla_campos($idcampo, 0);
				$retorno["exito"] = 1;
				$retorno["idpantalla_campos"] = $idcampo;
				$retorno["codigo_html"] = $cadena["codigo_html"];
				$retorno["funciones"] = $archivos_php;
			}
		}
	}
	if ($tipo_retorno == 1)
		echo (json_encode($retorno));
	else {
		return ($retorno);
	}
}

function set_pantalla_campos($idpantalla_campos, $tipo_retorno = 1) {
	global $conn, $ruta_db_superior;
	$retorno = array(
			"exito" => 0
	);
	$pantalla_campos = busca_filtro_tabla("", "campos_formato", "idcampos_formato=" . $idpantalla_campos, "", $conn);
	$procesar = 0;
	if ($pantalla_campos["numcampos"]) {
		$sql_update = array();
		foreach ($_REQUEST as $key => $value) {
			if (strpos($key, "fs_") !== false) {
				if ($key == 'fs_acciones') {
					$value = implode(",", $value);
				}
				if ($key == "fs_etiqueta") {
					$retorno["etiqueta"] = $value;
				}
				if ($key == "fs_placeholder") {
					$retorno["placeholder"] = $value;
				}
				array_push($sql_update, str_replace("fs_", "", $key) . "='" . $value . "'");
			}
		}
		if (count($sql_update)) {
			$sql2 = "UPDATE campos_formato SET " . implode(", ", $sql_update) . " WHERE idcampos_formato=" . $idpantalla_campos;
			phpmkr_query($sql2);
			$retorno["exito"] = 1;
			$cadena = load_pantalla_campos($idpantalla_campos, 0);
			$retorno["codigo_html"] = $cadena["codigo_html"];
		}
	}
	if ($tipo_retorno == 1)
		echo (json_encode($retorno));
	else {
		return ($retorno);
	}
}

function load_pantalla_campos($idpantalla_campos, $tipo_retorno = 1, $generar_archivo = "", $accion = '', $campos_pantalla = '') {
	global $ruta_db_superior;
	$retorno = array(
			"exito" => 0
	);
	$pantalla_campos = get_pantalla_campos($idpantalla_campos, 0);
	if ($pantalla_campos["numcampos"] && (strpos($pantalla_campos[0]["acciones"], substr($accion, 0, 1)) !== false || $accion == '' || $accion == 'retorno_campo')) {
		$retorno["exito"] = 1;
		$texto = $pantalla_campos[0]["componente"];
		$regs = array();
		preg_match_all('({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*[,]*[@]*)+\*})', $texto, $regs);
		$cant_reg = count($regs[0]);
		for($i = 0; $i < $cant_reg; $i++) {
			$nombre_campo = str_replace("*}", "", str_replace("{*", "", $regs[0][$i]));
			if (isset($pantalla_campos[0][$nombre_campo])) {
				if ($regs[0][$i] == '{*obligatoriedad*}') {
					if ($pantalla_campos[0][$nombre_campo]) {
						$texto = str_replace($regs[0][$i], " *", $texto);
					} else {
						$texto = str_replace($regs[0][$i], " ", $texto);
					}
				} else {
					$texto = str_replace($regs[0][$i], $pantalla_campos[0][$nombre_campo], $texto);
				}
				unset($regs[0][$i]);
			}
		}
		$ruta_componente = "pantallas/generador/" . $pantalla_campos[0]["nombre_componente"] . "/procesar_componente.php";
		if ($accion != '' && $accion != 'retorno_campo') {
			
			$texto = str_replace("{*clase_eliminar_pantalla_componente*}", "", $texto);
			if (file_exists($ruta_db_superior . $ruta_componente)) {
				foreach ($regs[0] as $key => $value) {
					$nombre_funcion = str_replace("*}", "", str_replace("{*", "", $value));
					$texto = str_replace($value, '<' . '?php  echo(' . $nombre_funcion . '(' . $idpantalla_campos . ',$' . $pantalla_campos[0]["pantalla"] . '->get_valor_' . $pantalla_campos[0]["pantalla"] . '("' . $campos_pantalla["nombre_tabla"] . '","' . $campos_pantalla["nombre"] . '"),"' . $accion . '",$' . $pantalla_campos[0]["pantalla"] . '->get_campo_' . $pantalla_campos[0]["pantalla"] . '("' . $campos_pantalla["nombre"] . '"))); ?' . '>' . "\n", $texto);
				}
			}
		} else {
			if ($accion == 'retorno_campo') {
				$texto = str_replace("{*clase_eliminar_pantalla_componente*}", "", $texto);
			}
			if (file_exists($ruta_db_superior . $ruta_componente)) {
				include_once ($ruta_db_superior . $ruta_componente);
			}
			foreach ($regs[0] as $key => $value) {				
				$nombre_funcion = str_replace("*}", "", str_replace("{*", "", $value));
				$proceso_componente = call_user_func_array($nombre_funcion, array(
						$idpantalla_campos,
						'',
						'',
						$pantalla_campos[0]
				));
				$texto = str_replace($value, $proceso_componente, $texto);
			}
		}
		$retorno["codigo_html"] = $texto;
	}
	if ($tipo_retorno == 1)
		echo (json_encode($retorno));
	else {
		return ($retorno);
	}
}

function get_pantalla_campos($idpantalla_campos, $tipo_retorno = 1) {
	$pantalla_campos = busca_filtro_tabla("A.*,B.nombre AS nombre_componente,B.etiqueta AS etiqueta_componente,B.componente,B.opciones,B.categoria,B.procesar,B.estado AS componente_estado,B.idpantalla_componente, B.eliminar, C.nombre AS pantalla,A.idcampos_formato AS idpantalla_campos,B.etiqueta_html AS etiqueta_html_componente", "campos_formato A,pantalla_componente B, formato C", "A.formato_idformato=C.idformato AND A.idcampos_formato=" . $idpantalla_campos . " AND A.etiqueta_html=B.etiqueta_html", "", $conn);
	$pantalla_campos["exito"] = 0;
	if ($pantalla_campos["numcampos"]) {
		$pantalla_campos["exito"] = 1;
	}
	if ($tipo_retorno == 1)
		echo (json_encode($pantalla_campos));
	else {
		return ($pantalla_campos);
	}
}

function incluir_librerias_pantalla($idpantalla, $tipo_retorno = 1, $ruta = '', $lugar_incluir = 'footer', $tipo_libreria = 2, $acciones = "") {
	$retorno = array(
			"exito" => 0
	);
	if ($ruta == '' && @$_REQUEST["ruta"]) {
		$ruta = $_REQUEST["ruta"];
	}
	if (@$_REQUEST["tipo_libreria"]) {
		$tipo_libreria = $_REQUEST["tipo_libreria"];
	}
	$ruta = str_replace("../", "", $ruta);
	$ruta = str_replace("./", "", $ruta);
	$ruta_include = busca_filtro_tabla("", "formato_libreria", "ruta='" . $ruta . "'", "", $conn);
	if ($ruta_include["numcampos"]) {
		$idlibreria = $ruta_include[0]["idpantalla_libreria"];
	} else {
		$sql2 = "INSERT INTO formato_libreria(ruta,funcionario_idfuncionario,fecha) VALUE('" . $ruta . "'," . usuario_actual("idfuncionario") . "," . fecha_db_almacenar(date("Y-m-d h:i:s"), "Y-m-d h:i:s") . ")";
		phpmkr_query($sql2);
		$idlibreria = phpmkr_insert_id();
	}
	if ($idlibreria) {
		$retorno["exito"] = 1;
		$retorno["mensaje"] = "La librer&iacute;a se vincula con &eacute;xito";
	} else {
		$retorno["mensaje"] = "Existe un error al insertar la librer&iacute;a ";
	}
	if ($tipo_retorno == 1)
		echo (json_encode($retorno));
	else {
		return ($retorno);
	}
}

function delete_pantalla_campos($idpantalla_campos, $tipo_retorno = 1) {
	global $ruta_db_superior;
	$retorno = array(
			"exito" => 0
	);
	$pantalla_campos = get_pantalla_campos($idpantalla_campos, 0);
	if ($pantalla_campos["numcampos"]) {
		if ($pantalla_campos[0]["eliminar"]) {
			$libreria = $ruta_db_superior . "pantallas/generador/" . $pantalla_campos[0]["nombre_componente"] . "/procesar_componente.php";
			if (file_exists($libreria)) {
				include_once ($libreria);
				$pantalla_campos[0]["eliminar"]($pantalla_campos);
			}
		}
		$sql_delete = 'DELETE FROM campos_formato WHERE idcampos_formato=' . $idpantalla_campos;
		$retorno["exito"] = 1;
		$retorno["sql"] = $sql_delete;
		phpmkr_query($sql_delete);
	}
	if ($tipo_retorno == 1)
		echo (json_encode($retorno));
	else {
		return ($retorno);
	}
}

function listado_archivos_incluidos($idpantalla, $tipo_retorno,$heredado=0) {
	global $ruta_db_superior;
	$retorno = array(
			"exito" => 0
	);
	$pantalla=busca_filtro_tabla("","formato A","A.idformato=".$idpantalla,"",$conn);
	$listado = busca_filtro_tabla("", "formato_libreria A", "A.formato_idformato=" . $idpantalla, "", $conn);
	$retorno["sql"]=$listado["sql"];
	$retorno["sql2"]=$pantalla["sql"];
	if ($listado["numcampos"]) {
	    $retorno["codigo_html"].='<h5>Librerias '.$pantalla[0]["etiqueta"].':</h5>';
		for($i = 0; $i < $listado["numcampos"]; $i++) {
			$retorno["codigo_html"] .= '<div class="well" id="libreria' . $listado[$i]["idformato_libreria"] . '" title="' . $listado[$i]["ruta"] . '">' . $listado[$i]["ruta"];
			$retorno["codigo_html"].= ' <div class="pull-right"><i id="eliminar_libreria2" class="icon-minus-sign eliminar_libreria" ruta_archivo="' . $listado[$i]["ruta"] . '" idformato_libreria="'.$listado[$i]["idformato_libreria"].'" idformato="'.$idpantalla.'" heredado="'.$heredado.'"></i>';
			if($listado[$i]['tipo_libreria']==1){
			    $heredado=0;
			}
		    $retorno["codigo_html"].='</div></div>';
		}
		$retorno["exito"] = 1;
	}
	if ($tipo_retorno == 1)
		echo (json_encode($retorno));
	else {
		return ($retorno);
	}
	return;
}

function eliminar_archivo_incluido($idpantalla_include, $tipo_retorno) {
	$retorno = array(
			"exito" => 0,
			"exito_funciones" => 0,
			"mensaje" => "existe un error al desasociar la libreria"
	);
	$libreria = busca_filtro_tabla("", "formato_libreria", "idformato_libreria=" . $idpantalla_include, "", $conn);
	if ($libreria["numcampos"]) {
		$sql2 = "DELETE from formato_libreria WHERE idformato_libreria=" . $idpantalla_include;
		phpmkr_query($sql2);
		$retorno["exito"] = 1;
		$retorno["idformato"]=$idpantalla_include;
		$retorno["mensaje"] = "Librer&iacute;a  desasociada de forma exitosa de la pantalla";
		/**
		 * TODO: Validar que se hace con las funciones de los formatos actualmente vinculados 
		//ELIMINO FUNCIONES y PARAMETROS (SI TIENE)
		$funciones_asociadas=busca_filtro_tabla("","pantalla_funcion_exe a, pantalla_funcion b","b.fk_idpantalla_libreria=".$idpantalla_libreria." AND a.fk_idpantalla_funcion=b.idpantalla_funcion AND a.pantalla_idpantalla=".$pantalla_idpantalla,"",$conn);
		if($funciones_asociadas['numcampos']){
    		$ids_pantalla_funcion_exe=implode(',',extrae_campo($funciones_asociadas,'idpantalla_funcion_exe'));
    		$nombres_funciones=strtolower(implode(', ',extrae_campo($funciones_asociadas,'nombre')));

    		$sql3="DELETE FROM pantalla_funcion_exe WHERE idpantalla_funcion_exe IN(".$ids_pantalla_funcion_exe.")";
    		phpmkr_query($sql3);

    		$sql4="DELETE FROM pantalla_func_param WHERE fk_idpantalla_funcion_exe IN(".$ids_pantalla_funcion_exe.")";
    		phpmkr_query($sql4);


    		//BUSCO CAMPOS TIPO=acciones_pantalla para eliminarlos
    		$acciones_pantalla_asociadas=busca_filtro_tabla("idpantalla_campos","pantalla_campos a","valor IN(".$ids_pantalla_funcion_exe.") AND etiqueta_html='acciones_pantalla' AND a.pantalla_idpantalla=".$pantalla_idpantalla,"",$conn);
    		if($acciones_pantalla_asociadas['numcampos']){
    		    $idspantalla_campos=implode(',',extrae_campo($acciones_pantalla_asociadas,'idpantalla_campos'));
        		$sql5="DELETE FROM pantalla_campos WHERE idpantalla_campos IN(".$idspantalla_campos.")";
        		phpmkr_query($sql5);
    		}

    		$retorno["mensaje_funciones"] = "Las siguientes funciones se desvincularon satisfactoriamente: ".$nombres_funciones;
    		$retorno['exito_funciones']=1;
		}*/

	}
	if ($tipo_retorno == 1)
		echo (json_encode($retorno));
	else {
		return ($retorno);
	}
}

function get_pantalla_libreria($idpantalla_libreria, $tipo_retorno) {
	$libreria = busca_filtro_tabla("", "pantalla_libreria A, pantalla_include B", "A.idpantalla_libreria=B.fk_idpantalla_libreria AND A.idpantalla_libreria=" . $idpantalla_libreria, "", $conn);
	$libreria["exito"] = 0;
	if ($libreria["numcampos"]) {
		$libreria["exito"] = 1;
	}
	if ($tipo_retorno == 1)
		echo (json_encode($libreria));
	else {
		return ($libreria);
	}
}

function guardar_configurar_pantalla_libreria($idpantalla, $tipo_retorno) {
	$retorno = array(
			"mensaje" => "error vinculando las funciones de la librer&iacute;a",
			"exito" => 0
	);
	$nombre = $_REQUEST["funcion"];
	$ruta = @$_REQUEST["ruta"];
	$tipo_archivo = explode(".", $ruta);
	$cant_punto = count($tipo_archivo);
	$extension = $tipo_archivo[($cant_punto - 1)];
	$idpantalla = @$_REQUEST["pantalla_idpantalla"];
	$parametros_funcion = @$_REQUEST["parametros"];
	if (@$_REQUEST["idpantalla_libreria"]) {
		$idpantalla_libreria = $_REQUEST["idpantalla_libreria"];
	} else if (@$ruta && @$idpantalla) {
		$libreria = busca_filtro_tabla("", "pantalla_libreria A", "A.ruta LIKE '" . $ruta . "'", "", $conn);
		if ($libreria["numcampos"]) {
			$idpantalla_libreria = $libreria[0]["idpantalla_libreria"];
		} else {
			$sql2 = "INSERT INTO pantalla_libreria(ruta,funcionario_idfuncionario,fecha,tipo_archivo,tipo_libreria) VALUES('" . trim($ruta) . "'," . usuario_actual("funcionario_codigo") . "," . fecha_db_almacenar(date("Y-m-d H:i:s")) . ",'" . $extension . "','1')";
			phpmkr_query($sql2);
			$idpantalla_libreria = phpmkr_insert_id();
		}
	} else {
		$retorno["mensaje"] .= "No se ha podido vincular la librer&iacute;a a la pantalla<br />";
	}
	if ($idpantalla_libreria && $idpantalla) {
		$include = busca_filtro_tabla("", "pantalla_include A", "A.fk_idpantalla_libreria =" . $idpantalla_libreria . " AND A.pantalla_idpantalla=" . $idpantalla, "", $conn);
		if (!$include["numcampos"]) {
			if (@$_REQUEST["lugar_incluir"]) {
				$lugar = $_REQUEST["lugar_incluir"];
			} else {
				$lugar = "footer";
			}
			$sql2 = "INSERT INTO pantalla_include(fk_idpantalla_libreria,pantalla_idpantalla,lugar_incluir) VALUES(" . $idpantalla_libreria . "," . $idpantalla . ",'" . $lugar . "')";
			phpmkr_query($sql2);
			if (!phpmkr_insert_id()) {
				$retorno["Mensaje"] .= 'No se ha podido incluir la librer&iacute;a en la pantalla<br />';
			}
		}
	}
	$funcion = busca_filtro_tabla("", "pantalla_funcion A", "A.nombre LIKE '" . $nombre . "'  AND fk_idpantalla_libreria=" . $idpantalla_libreria, "", $conn);
	if ($funcion["numcampos"]) {
		$idfuncion = $funcion[0]["idpantalla_funcion"];
		if (@$_REQUEST["lugar_incluir"]) {
			$lugar = $_REQUEST["lugar_incluir"];
		} else {
			$lugar = "footer";
		}
		$sql2 = "UPDATE pantalla_funcion SET parametros='" . $parametros_funcion . "',tipo_funcion='" . $extension . "',lugar_incluir='" . $lugar_incluir . "' WHERE idpantalla_funcion=" . $idfuncion;
		phpmkr_query($sql2);
	} else {
		$sql2 = "INSERT INTO pantalla_funcion(nombre,parametros,fk_idpantalla_libreria,tipo_funcion) VALUES('" . $nombre . "','" . $parametros_funcion . "'," . $idpantalla_libreria . ",'" . $extension . "')";
		phpmkr_query($sql2);
		$idfuncion = phpmkr_insert_id();
	}
	if ($idfuncion) {
		$where = '';
		if (@$_REQUEST["idpantalla_funcion_exe"]) {
			$where = " idpantalla_funcion_exe=" . $_REQUEST["idpantalla_funcion_exe"] . " AND A.pantalla_idpantalla=" . $idpantalla;
		} else {
			$where = "A.fk_idpantalla_funcion=" . $idfuncion . " AND A.pantalla_idpantalla=" . $idpantalla;
		}
		$funcion_exe = busca_filtro_tabla("", "pantalla_funcion_exe A", $where, "", $conn);

		$vistas = '';
		if (@$_REQUEST["vistas"]) {
			$vistas = implode($_REQUEST["vistas"]);
		} else {
			$vistas = 'v,l';
		}
		if (@$_REQUEST["momento"] == '') {
			$_REQUEST["momento"] = 1;
		}
		// (@$_REQUEST["tipo_funcion_exe"]=="modificar" && @$_REQUEST["accion"]=='mostrar'||
		if ($funcion_exe["numcampos"] && @$_REQUEST["idpantalla_funcion_exe"]) {
			$idfuncion_exe = $funcion_exe[0]["idpantalla_funcion_exe"];
			$sql2 = "UPDATE pantalla_funcion_exe SET momento='" . $_REQUEST["momento"] . "', accion='" . @$_REQUEST["accion"] . "', vistas='" . $vistas . "', fk_idpantalla_funcion=" . $idfuncion . " WHERE idpantalla_funcion_exe=" . $idfuncion_exe;
			phpmkr_query($sql2);
			$retorno["update_funcion_exe"] = $sql2;
		} else {
			$sql2 = "INSERT INTO pantalla_funcion_exe(momento,accion,vistas, fk_idpantalla_funcion,pantalla_idpantalla) VALUES('" . $_REQUEST["momento"] . "','" . @$_REQUEST["accion"] . "','" . $vistas . "'," . $idfuncion . "," . $idpantalla . ")";
			phpmkr_query($sql2);
			$idfuncion_exe = phpmkr_insert_id();
		}
		if ($idfuncion_exe) {
			$retorno["idfuncion_exe"] = $idfuncion_exe;
			$retorno["update_pfp"] = '';
			$sql2 = "DELETE FROM pantalla_func_param WHERE fk_idpantalla_funcion_exe=" . $idfuncion_exe;
			phpmkr_query($sql2);
			$param = str_replace("$", "", $parametros_funcion);
			$param_temp = explode(",", $param);
			$cant_param = count($param_temp);
			for($i = 0; $i < $cant_param; $i++) {
				$tipo_param = '';
				$valor_param = '';
				if (@$_REQUEST["div_" . $param_temp[$i]]) {
					$tipo_param = $_REQUEST["div_" . $param_temp[$i]];
				}
				if (@$_REQUEST[$param_temp[$i] . "_dato"]) {
					$valor_param = $_REQUEST[$param_temp[$i] . "_dato"];
				}
				$sql2 = "INSERT INTO pantalla_func_param(nombre,valor,tipo,fk_idpantalla_funcion_exe) VALUES('" . $param_temp[$i] . "', '" . $valor_param . "'," . $tipo_param . "," . $idfuncion_exe . ")";
				phpmkr_query($sql2);
			}
		}
	} else {
		$retorno["mensaje"] .= "No se ha podido vincular la funci&oacute;n a la pantalla";
	}
	if ($idfuncion_exe) {
	    $retorno["idpantalla_funcion_exe"] = $idfuncion_exe;
		$retorno["mensaje"] = "Funci&oacute;n vinculada con &eacute;xito.";
		$retorno["exito"] = 1;
		$cantidad=busca_filtro_tabla("","pantalla_funcion_exe","fk_idpantalla_funcion=".$idfuncion." AND pantalla_idpantalla=".$idpantalla,"",$conn);
		$retorno["cantidad"]=$cantidad["numcampos"];
	}
	if ($tipo_retorno == 1)
		echo (json_encode($retorno));
	else {
		return ($retorno);
	}
}

if (@$_REQUEST["ejecutar_pantalla_campo"]) {
	if (!@$_REQUEST["tipo_retorno"]) {
		$_REQUEST["tipo_retorno"] = 1;
	}
	$_REQUEST["ejecutar_pantalla_campo"]($_REQUEST["idformato"], $_REQUEST["tipo_retorno"]);
}
if (@$_REQUEST["ejecutar_campos_formato"]) {
	if (!@$_REQUEST["tipo_retorno"]) {
		$_REQUEST["tipo_retorno"] = 1;
	}
	$_REQUEST["ejecutar_campos_formato"]($_REQUEST["idpantalla_campos"], $_REQUEST["tipo_retorno"]);
}
?>
