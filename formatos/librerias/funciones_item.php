<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once $ruta_db_superior . "core/autoload.php";

if (isset($_REQUEST["accion"])) {
	$_REQUEST["accion"]();
}

function editar() {
	global $conn, $ruta_db_superior;
	$lista_campos = listar_campos_tabla();
	for ($i = 0; $i < count($lista_campos); $i++) {
		$lista_campos[$i] = strtolower($lista_campos[$i]);
	}
	$i = 0;
	$formato = busca_filtro_tabla("", "formato", "nombre='" . $_REQUEST["formato"] . "'", "");
	foreach ($_REQUEST as $key => $valor) {
		if (in_array(strtolower($key), $lista_campos) && $key <> "id" . $_REQUEST["tabla"]) {
			$campos[$i] = $key;
			$tipo = busca_filtro_tabla("tipo_dato,etiqueta_html,predeterminado", "campos_formato A", "lower(A.nombre)='" . strtolower($key) . "' and formato_idformato='" . $formato[0]["idformato"] . "'", "");
			if (strtolower($tipo[0]["tipo_dato"]) == 'date') {
				if ($valor != '0000-00-00 00:00' && $valor != "") {
					$update[$i] = $key . "=" . htmlentities(decodifica_encabezado(fecha_db_almacenar($valor, 'Y-m-d')));
				} else {
					unset($update[$i]);
					unset($campos[$i]);
				}
			} else if (strtolower($tipo[0]["tipo_dato"]) == 'datetime') {
				if ($valor != '0000-00-00 00:00' && $valor != "") {
					$update[$i] = $key . "=" . htmlentities(decodifica_encabezado(fecha_db_almacenar($valor, 'Y-m-d H:i:s')));
				} else {
					unset($update[$i]);
					unset($campos[$i]);
				}
			} else {
				$update[$i] = $key . "='" . str_replace("'", "&#39;", htmlentities(decodifica_encabezado($valor))) . "'";
			}
		}
		$i++;
	}

	if ($_REQUEST["anterior_editar"]) {
		include_once ($ruta_db_superior . 'formatos/' . $formato[0]['nombre'] . "/funciones.php");
		$funciones = explode(",", $_REQUEST["anterior_editar"]);
		foreach ($funciones as $funcion) {
			$funcion($formato[0]['idformato'], $_REQUEST["item"]);
		}
	}

	$sql = "update " . $_REQUEST["tabla"] . " set " . implode(",", $update) . " where id" . $_REQUEST["tabla"] . "=" . $_REQUEST["item"];
	phpmkr_query($sql);

	if ($_REQUEST["posterior_editar"]) {
		include_once ($ruta_db_superior . 'formatos/' . $formato[0]['nombre'] . "/funciones.php");
		$funciones = explode(",", $_REQUEST["posterior_editar"]);
		foreach ($funciones as $funcion) {
			$funcion($formato[0]['idformato'], $_REQUEST["item"]);
		}
	}

	$padre = busca_filtro_tabla("", "formato", "idformato='" . $formato[0]["cod_padre"] . "'", "");
	$doc_padre = busca_filtro_tabla("documento_iddocumento", $formato[0]["nombre_tabla"] . "," . $padre[0]["nombre_tabla"], "id" . $padre[0]["nombre_tabla"] . "=" . $padre[0]["nombre_tabla"] . " and id" . $formato[0]["nombre_tabla"] . "=" . $_REQUEST["item"], "");

	redirecciona($ruta_db_superior . 'formatos/' . $padre[0]["nombre"] . "/" . $padre[0]["ruta_mostrar"] . "?idformato=" . $padre[0]["idformato"] . "&iddoc=" . $doc_padre[0][0]);
}

function eliminar_item() {
	global $conn, $ruta_db_superior;
	$formato = busca_filtro_tabla("idformato,nombre,ruta_mostrar,ruta_adicionar", "formato", "nombre_tabla like '" . $_REQUEST["tabla"] . "'", "");
	if ($_REQUEST["anterior_eliminar"]) {
		include_once ($ruta_db_superior . 'formatos/' . $formato[0]['nombre'] . "/funciones.php");
		$funciones = explode(",", $_REQUEST["anterior_eliminar"]);
		foreach ($funciones as $funcion) {
			$funcion($formato[0]['idformato'], $_REQUEST["id"]);
		}
	}
	phpmkr_query("delete from " . $_REQUEST["tabla"] . " where id" . $_REQUEST["tabla"] . "=" . $_REQUEST["id"]);
	if ($_REQUEST["posterior_eliminar"]) {
		include_once ($ruta_db_superior . 'formatos/' . $formato[0]['nombre'] . "/funciones.php");
		$funciones = explode(",", $_REQUEST["posterior_eliminar"]);
		foreach ($funciones as $funcion) {
			$funcion($formato[0]['idformato'], 0);
		}
	}
	$padre = busca_filtro_tabla("idformato,nombre,ruta_mostrar,nombre_tabla,cod_padre", "formato", "idformato=(select cod_padre from formato where nombre_tabla like '" . $_REQUEST["tabla"] . "')", "");
	$superior = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $padre[0]["cod_padre"], "");
	$doc_padre = busca_filtro_tabla("documento_iddocumento", $padre[0]["nombre_tabla"], "id" . $padre[0]["nombre_tabla"] . "=" . $_REQUEST["padre"], "");
	if ($_REQUEST["formato"] == 'adicionales_orden') {
		$superior["numcampos"] = 0;
	}
	if ($superior["numcampos"])
		echo "<script>
     var direccion = new String(window.parent.frames[0].location);
     param=direccion.split('&');
     direccion=param[0]+'&'+param[1]+'&seleccionar=" . $padre[0]["idformato"] . "-" . $superior[0][0] . "-" . $padre[0]["nombre_tabla"] . "-" . $doc_padre[0][0] . "';
     window.parent.frames[0].location=direccion;
     </script>";
	else
		echo "<script>
     var direccion = new String(parent.location);
     param=direccion.split('&');
     direccion=param[0]+'&'+param[1];
     parent.location=direccion+'&rand=" . rand(0, 100) . "';  
     </script>";
}

function guardar_item() {
	global $conn, $ruta_db_superior;

	$lista_campos = listar_campos_tabla();
	for ($i = 0; $i < count($lista_campos); $i++) {
		$lista_campos[$i] = strtolower($lista_campos[$i]);
	}
	$i = 0;
	$formato = busca_filtro_tabla("", "formato", "nombre='" . $_REQUEST["formato"] . "'", "");
	foreach ($_REQUEST as $key => $valor) {
		if (in_array(strtolower($key), $lista_campos) && $key <> "id" . $_REQUEST["tabla"]) {
			$campos[$i] = $key;
			$tipo = busca_filtro_tabla("tipo_dato,etiqueta_html,predeterminado", "campos_formato A", "lower(A.nombre)='" . strtolower($key) . "' and formato_idformato='" . $formato[0]["idformato"] . "'", "");
			if (strtolower($tipo[0]["tipo_dato"]) == 'date') {
				if ($valor != '0000-00-00 00:00' && $valor != "") {
					$valores[$i] = htmlentities(decodifica_encabezado(fecha_db_almacenar($valor, 'Y-m-d')));
				} else {
					unset($valores[$i]);
					unset($campos[$i]);
				}
			} else if (strtolower($tipo[0]["tipo_dato"]) == 'datetime') {
				if ($valor != '0000-00-00 00:00' && $valor != "") {
					$valores[$i] = htmlentities(decodifica_encabezado(fecha_db_almacenar($valor, 'Y-m-d H:i:s')));
				} else {
					unset($valores[$i]);
					unset($campos[$i]);
				}
			} else {
				$valores[$i] = "'" . str_replace("'", "&#39;", htmlentities(decodifica_encabezado($valor))) . "'";
			}
		}
		$i++;
	}

	if ($_REQUEST["anterior_adicionar"]) {
		include_once ($ruta_db_superior . 'formatos/' . $formato[0]['nombre'] . "/funciones.php");
		$funciones = explode(",", $_REQUEST["anterior_adicionar"]);
		foreach ($funciones as $funcion) {
			$funcion($formato[0]['idformato'], 0);
		}
	}

	$sql = "insert into " . $_REQUEST["tabla"] . "(" . implode(",", $campos) . ") values(" . implode(",", $valores) . ")";
	phpmkr_query($sql);
	$insertado = phpmkr_insert_id();
	if ($insertado > 0) {
		if (isset($_REQUEST["plantilla"]) && $_REQUEST["plantilla"] == 1) {
			if ($_REQUEST["contenido"]) {
				crear_pretexto_item($_REQUEST["asplantilla"], $_REQUEST["contenido"]);
			}
		}
		if ($_REQUEST["posterior_adicionar"]) {
			include_once ($ruta_db_superior . 'formatos/' . $formato[0]['nombre'] . "/funciones.php");
			$funciones = explode(",", $_REQUEST["posterior_adicionar"]);
			foreach ($funciones as $funcion) {
				$funcion($formato[0]['idformato'], $insertado);
			}
		}
		$formato = busca_filtro_tabla("idformato,nombre,ruta_mostrar,ruta_adicionar", "formato", "nombre like '" . $_REQUEST["formato"] . "'", "");
		$padre = busca_filtro_tabla("idformato,nombre,ruta_mostrar,nombre_tabla,cod_padre", "formato", "idformato=(select cod_padre from formato where nombre like '" . $_REQUEST["formato"] . "')", "");
		$superior = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $padre[0]["cod_padre"], "");
		$doc_padre = busca_filtro_tabla("documento_iddocumento", $padre[0]["nombre_tabla"], "id" . $padre[0]["nombre_tabla"] . "=" . $_REQUEST["padre"], "");

		if ($_REQUEST["opcion_item"] <> "adicionar") { 
			echo(json_encode([
				"success" => 1, 
				"message" => "Creación Exitosa", 
				"id" => $insertado
			]));
			//echo(json_encode(["refresca"=>2]));
			/*die();
			if ($superior["numcampos"] && @$_REQUEST["pantalla"] <> "externo")
				echo "<script>
             var direccion = new String(window.parent.frames[0].location);
             param=direccion.split('&');
             direccion=param[0]+'&'+param[1]+'&seleccionar=" . $padre[0]["idformato"] . "-" . $superior[0][0] . "-" . $padre[0]["nombre_tabla"] . "-" . $doc_padre[0][0] . "';
             //window.parent.frames[0].location=direccion;
             window.location='../../" . 'formatos/' . $padre[0]["nombre"] . "/" . $padre[0]["ruta_mostrar"] . "?idformato=" . $padre[0]["idformato"] . "&iddoc=" . $doc_padre[0]["documento_iddocumento"] . "';  //correccion para que los items no recargen el arbol
             </script>";
			else
				echo "<script>
             var direccion = new String(parent.location);
             param=direccion.split('&');
             direccion=param[0]+'&'+param[1];
             parent.location=direccion+'&mostrar_formato=item&rand=" . rand(0, 100) . "';  
             </script>";*/
		}
		if ($_REQUEST["opcion_item"] == "adicionar") {
			echo(json_encode([
					"success" => 1, 
					"message" => "Creación Exitosa", 
					"id" => $insertado,
					"refresh" => 1
				]));
			//die();
			//redirecciona($ruta_db_superior . 'formatos/' . $formato[0]["nombre"] . "/" . $formato[0]["ruta_adicionar"] . "?idpadre=" . $doc_padre[0][0] . "&idformato=" . $padre[0]["idformato"] . "&padre=" . $_REQUEST["padre"]);
		}
	}else{
		echo(json_encode([
				"success" => 1, 
				"message" => "No fue posible crear el item", 
		]));
	}
}

function crear_pretexto_item($asunto, $contenido) {
	global $conn, $ruta_db_superior;
	$campos = "asunto";
	$valores = "'" . $asunto . "'";
	$sql = "INSERT INTO " . "pretexto" . "(" . $campos . ") VALUES (" . $valores . ")";
	phpmkr_query($sql);
	$idpretexto = phpmkr_insert_id();
	guardar_lob("contenido", "pretexto", "idpretexto=$idpretexto", $contenido, "texto");
	// Guardo la relacion de la plantilla con el suaurio
	$idfuncionario = usuario_actual("idfuncionario");
	$campos = "pretexto_idpretexto,entidad_identidad,llave_entidad";
	$valores = "'" . $idpretexto . "','1'," . "'" . $idfuncionario . "'";
	$sql = "INSERT INTO " . "entidad_pretexto" . "(" . $campos . ") VALUES (" . $valores . ") ";
	phpmkr_query($sql);
	return;
}
