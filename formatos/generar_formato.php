<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/librerias/funciones.php");
include_once ($ruta_db_superior . "formatos/generar_formato_buscar.php");
include_once ($ruta_db_superior . "pantallas/documento/class_documento_elastic.php");

if (@$_REQUEST["sesion"] && !@$_SESSION["LOGIN" . LLAVE_SAIA]) {
	$_SESSION["LOGIN" . LLAVE_SAIA] = $_REQUEST['sesion'];
}
if (@$_REQUEST["archivo"] != '') {
	$archivo = $ruta_db_superior . str_replace("-", "/", $_REQUEST["archivo"]);
}

if (@$_REQUEST["genera"]) {
	$accion = $_REQUEST["genera"];
	if (@$_REQUEST["idformato"]) {
		$idformato = $_REQUEST["idformato"];
		$generar = new GenerarFormato($idformato, $accion, $archivo);
		$redireccion = $generar->ejecutar_accion();
	} else {
		alerta_formatos("por favor seleccione un Formato a Generar");
		$redireccion = "formatolist.php";
		if ($archivo != '') {
			$redireccion = $archivo;
		}
	}
	redirecciona($redireccion);
}


class GenerarFormato {

	private $accion;
	private $idformato;
	private $archivo;
	private $incluidos;

	public function __construct($idformato, $accion, $archivo='') {
		$this->idformato = $idformato;
		$this->accion = $accion;
		$this->archivo = $archivo;
		$this->incluidos = array();
	}

	public function ejecutar_accion() {
		// ir a la carpeta anterior
		$ruta_padre = dirname(__DIR__);
		chdir($ruta_padre);
		$redireccion = false;
		switch (@$this->accion) {
			case "formato" :
				$redireccion= $this->generar_formato();
				//$redireccion = "formatoview.php?idformato=" . $this->idformato;
				break;
			case "tabla" :
				$this->generar_tabla();
				if (INDEXA_ELASTICSEARCH) {
					$doc_elastic = new DocumentoElastic(null);
					$doc_elastic->actualizar_indice_formato($this->idformato);
				}

				$redireccion = "campos_formatolist.php?idformato=" . $this->idformato;
				break;
			case "vista" :
				$this->generar_vista();
				$redireccion = "vista_formatoedit.php?key=" . $_REQUEST["idformato"];
				break;
			case "mostrar" :
				$this->crear_formato_mostrar();
				$redireccion = "funciones_formatolist.php?idformato=" . $this->idformato;
				break;
			case "adicionar" :
				$this->crear_formato_ae("adicionar");
				$redireccion = "funciones_formatolist.php?idformato=" . $this->idformato;
				break;
			case "editar" :
				$this->crear_formato_ae("editar");
				$redireccion = "funciones_formatolist.php?idformato=" . $this->idformato;
				break;
			case "buscar" :
				$generar = new GenerarBuscar($this->idformato, "buscar");
				$generar->crear_formato_buscar();
				$redireccion = "funciones_formatolist.php?idformato=" . $this->idformato;

				break;
			case "eliminar" :
				$this->crear_formato_mostrar("eliminar");
				$redireccion = "funciones_formatolist.php?idformato=" . $this->idformato;
				break;
		}

		if ($this->archivo != '') {
			$redireccion = $this->archivo;
		}

		chdir(__DIR__);
		return ($redireccion);
	}

	/*
	 * <Clase>
	 * <Nombre>generar_tabla</Nombre>
	 * <Parametros>$idformato:</Parametros>
	 * <Responsabilidades>Crear automaticamente los campos predeterminados como la serie,documento_iddocumento, la llave primaria... etc, verifica si la tabla est� creada, crea o actualiza la tabla con todos los campos como se han definido previamente<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	function generar_tabla() {
		global $sql, $conn;
		$sql_tabla = "";
		$lcampos = array();
		$idesta = 0;
		$iddocesta = 0;
		$formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
		if ($formato["numcampos"]) {
			//$resp["estado"] = "KO";
			//$resp["mensaje"] = "Problemas al Generar la tabla, No existen Campos";

			$resp = $conn->formato_generar_tabla($this->idformato, $formato);
			alerta_formatos($resp["mensaje"]);
		} else {
			alerta_formatos("No es posible Generar la tabla para el Formato");
			return (false);
		}
	}

	/*
	 * <Clase>
	 * <Nombre>elimina_indices_tabla</Nombre>
	 * <Parametros>$tabla</Parametros>
	 * <Responsabilidades>Busca los indices creados para cierta tabla y llama la funci�n que los elimina<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	private function elimina_indices_tabla($tabla) {
		global $conn, $sql;
		$tabla = strtoupper($tabla);
		if (MOTOR == "MySql") {
			$indices = ejecuta_filtro_tabla("SHOW INDEX FROM " . strtolower($tabla), $conn);
			for($i = 0; $i < $indices["numcampos"]; $i++) {
				$this->elimina_indice($tabla, $indices[$i]);
			}
		} else if (MOTOR == "Oracle") {
			$envio = array();
			$sql2 = "select ai.index_name AS column_name, ai.uniqueness AS Key_name FROM all_indexes ai WHERE ai.TABLE_OWNER='" . DB . "' AND ai.table_name = '" . $tabla . "'";
			$indices = ejecuta_filtro_tabla($sql2, $conn);
			for($i = 0; $i < $indices["numcampos"]; $i++) {
				array_push($envio, array(
						"Key_name" => $indices[$i]["key_name"],
						"Column_name" => $indices[$i]["column_name"]
				));
			}
			$sql2 = "SELECT cols.column_name AS Column_name, cons.constraint_type AS Key_name FROM all_constraints cons, all_cons_columns cols WHERE cons.constraint_type = 'P' AND cons.constraint_name = cols.constraint_name AND cons.owner = cols.owner AND cons.owner='" . DB . "' AND cols.table_name='" . $tabla . "' ORDER BY cols.table_name, cols.position";
			$primaria = ejecuta_filtro_tabla($sql2, $conn);
			for($i = 0; $i < $primaria["numcampos"]; $i++) {
				array_push($envio, array(
						"Key_name" => "PRIMARY",
						"Column_name" => $primaria[$i]["Column_name"]
				));
			}
			$numero_indices = count($envio);

			for($i = 0; $i < $numero_indices; $i++) {
				$this->elimina_indice($tabla, $envio[$i]);
			}
		} else if (MOTOR == "SqlServer" || MOTOR == "MSSql") {
			$sql2 = "SELECT name AS column_name FROM sys.objects WHERE type_desc LIKE '%CONSTRAINT' AND OBJECT_NAME(parent_object_id)='" . $tabla . "'";
			$indices = ejecuta_filtro_tabla($sql2, $conn);
			$numero_indices = count($indices);
			for($i = 0; $i < $numero_indices; $i++) {
				$this->elimina_indice($tabla, $envio[$i]);
			}
		}
		return;
	}


	/*
	 * <Clase>
	 * <Nombre>es_indice</Nombre>
	 * <Parametros>$campo:nombre del campo;$tabla:nombre de la tabla;$indice:vector donde se guarda la informacion consultada</Parametros>
	 * <Responsabilidades>Verifca si en la tabla y el campo elegidos existe algun indice<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	private function es_indice($campo, $tabla, $indice) {
		global $conn;
		$indice = ejecuta_filtro_tabla("SHOW INDEX FROM " . strtolower($tabla) . " WHERE Column_name LIKE '" . $campo . "'", $conn);
		if (!$indice["numcampos"]) {
			return (false);
		}
		return (true);
	}



	/*
	 * <Clase>
	 * <Nombre>maximo_valor</Nombre>
	 * <Parametros>$valor:valor asignado por configuraci�n;$maximo:valor m�ximo aceptado por el tipo de dato</Parametros>
	 * <Responsabilidades>Valida si el valor que se est� asignando al tipo de dato est� en el rango permitido, si no lo est� devuelve el m�ximo<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida>devuelve el n�mero m�ximo permitido</Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	private function maximo_valor($valor, $maximo) {
		if ($valor > $maximo || $valor == "NULL")
			return ($maximo);
		else
			return ($valor);
	}

	/*
	 * <Clase>
	 * <Nombre>crear_formato_mostrar</Nombre>
	 * <Parametros>$idformato:id del formato</Parametros>
	 * <Responsabilidades>Se encarga de crear el archivo con el mostrar del formato correspondiente basandose en la configuraciones realizadas<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	public function crear_formato_mostrar() {
		global $sql, $conn;
		$formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
		$includes = '';
		$texto = '';
		$enlace = "";
		if ($formato["numcampos"]) {
			// $datos=busca_filtro_tabla("","campos_formato","etiqueta_html LIKE 'detalle' AND valor=".$this->idformato,"",$conn);
			// buscar si el formato tiene hijos
			$hijos = busca_filtro_tabla("", "campos_formato", "etiqueta_html='detalle' and nombre like '" . $formato[0]["nombre_tabla"] . "'", "", $conn);

			// if($hijos["numcampos"])
			// $enlace='<a href="detalles_'.$formato[0]["ruta_mostrar"].'?idformato='.$this->idformato.'&iddoc=<?php echo($_REQUEST["iddoc"]); ?'.'>" target="centro"> Detalles</a>';
			if (strpos($formato[0]["banderas"], "acordeon") !== false) {
				$texto .= '<frameset cols="410,*" >';
				$texto .= '<frame name="arbol_formato" id="arbol_formato" src="../../' . FORMATOS_SAIA . 'librerias/formato_detalles.php?idformato=' . $this->idformato . '&iddoc=<?php echo($_REQUEST[' . "'" . "iddoc" . "'" . ']); ? >" marginwidth="0" marginheight="0" scrolling="no" >';
			} else {
				$texto .= '<frameset cols="250,*" >';
				$texto .= '<frame name="arbol_formato" id="arbol_formato" src="../../' . FORMATOS_SAIA . 'arboles/arbolformato_documento.php?idformato=' . $this->idformato . '&iddoc=<?php echo($_REQUEST[' . "'" . "iddoc" . "'" . ']); ? >" marginwidth="0" marginheight="0" scrolling="auto" >';
			}
			$texto .= '
  <frame name="detalles" src="" border="0" marginwidth="20px" marginheight="10" scrolling="auto">
</frameset>';
			$contenido_detalles = $texto;

			if (!crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/detalles_" . $formato[0]["ruta_mostrar"], $contenido_detalles)) {
				alerta_formatos("837 No es posible crear el Archivo de detalles");
			}
			$texto = '';
			// FIN if($hijos["numcampos"])
			/*
			 * else
			 * {if(is_file($formato[0]["nombre"]."/detalles_".$formato[0]["ruta_mostrar"]))
			 * unlink($formato[0]["nombre"]."/detalles_".$formato[0]["ruta_mostrar"]);
			 * }
			 */
			$texto .= '<tr><td>';
			$archivos = 0;
			$texto .= htmlspecialchars_decode($formato[0]["cuerpo"]);
			$texto .= '</td></tr>';
			$librerias = array();
			$funciones = busca_filtro_tabla("*", "funciones_formato A", "A.formato LIKE '" . $this->idformato . "' OR A.formato LIKE '%," . $this->idformato . ",%' OR A.formato LIKE '%," . $this->idformato . "' OR A.formato LIKE '" . $this->idformato . ",%' AND A.acciones LIKE '%m%'", "", $conn);
			$campos = busca_filtro_tabla("*", "campos_formato A", "A.formato_idformato=" . $this->idformato, "", $conn);
			$lcampos = extrae_campo($campos, "nombre", "U");

			for($i = 0; $i < $campos["numcampos"]; $i++) {
				if ($campos[$i]["etiqueta_html"] == "autocompletar") {
					$parametros = explode(";", $campos[$i]["valor"]);
					$texto = str_replace("{*" . $campos[$i]["nombre"] . "*}", "<?php busca_campo(" . "'" . $parametros[0] . "','" . $parametros[1] . "','" . $parametros[2] . "',mostrar_valor_campo('" . $campos[$i]["nombre"] . "','" . $this->idformato . "',$" . "_REQUEST['iddoc'],1)); ?" . ">", $texto);
				} elseif ($campos[$i]["etiqueta_html"] == "detalle") {
					$texto = str_replace("{*listado_detalles_" . str_replace("id", "", $campos[$i]["nombre"]) . "*}", $this->arma_funcion("buscar_listado_formato", "'" . $formato[0]["nombre"] . "'," . $campos[$i]["valor"], "mostrar"), $texto);
				} else {
					$texto = str_replace("{*" . $campos[$i]["nombre"] . "*}", $this->arma_funcion("mostrar_valor_campo", "'" . $campos[$i]["nombre"] . "',$this->idformato", "mostrar"), $texto);
				}
				if ($campos[$i]["etiqueta_html"] == "archivo") {
					$archivos++;
				}
			}

			for($i = 0; $i < $funciones["numcampos"]; $i++) {
				$ruta_orig = "";
				$formato_orig = explode(",", $funciones[$i]["formato"]);
				if ($formato_orig[0] != $this->idformato) { // busco el nombre del formato inicial
					$dato_formato_orig = busca_filtro_tabla("nombre", "formato", "idformato=" . $formato_orig[0], "", $conn);
					if ($dato_formato_orig["numcampos"] && ($dato_formato_orig[0]["nombre"] != $formato[0]["nombre"])) {
						$eslibreria = strpos($funciones[$i]["ruta"], "../librerias/");
						if ($eslibreria === false) {
							$eslibreria = strpos($funciones[$i]["ruta"], "../class_transferencia");
						}
						// si el archivo existe dentro de la carpeta del archivo inicial
						if (is_file(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"]) && $eslibreria === false) {
							$includes .= $this->incluir("../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
						} elseif (is_file(FORMATOS_CLIENTE . $funciones[$i]["ruta"]) && $eslibreria === false) { // si el archivo existe en la ruta especificada partiendo de la raiz

							$includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
						} else if ($eslibreria === false) { // si no existe en ninguna de las dos
						                                    // trato de crearlo dentro de la carpeta del formato actual
							alerta_formatos("Las funciones del Formato " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"] . " son requeridas  no se han encontrado");
							if (crear_archivo(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
								$includes .= $this->incluir($dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
							} else {
								alerta_formatos("892 No es posible generar el archivo " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
							}
						}
					}
				} else { // $ruta_orig=$formato[0]["nombre"];
				         // si el archivo existe dentro de la carpeta del formato actual
					if (is_file(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
						$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
					} elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
						$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
					} else { // si no existe en ninguna de las dos
					         // trato de crearlo dentro de la carpeta del formato actual
						if (crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
							$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
						} else {
							alerta_formatos("907 No es posible generar el archivo " . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
						}
					}
				}
				if ($funciones[$i]["parametros"] != "")
					$parametros = $this->idformato . "," . $funciones[$i]["parametros"];
				else
					$parametros = $this->idformato;
					$texto = str_replace($funciones[$i]["nombre"], $this->arma_funcion($funciones[$i]["nombre_funcion"], $parametros, "mostrar"), $texto);
			}
			if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
				$includes .= $this->incluir($formato[0]["librerias"], "librerias", 1);
			}
			$includes .= $this->incluir_libreria("funciones_generales.php", "librerias");
			$includes .= $this->incluir("../../librerias_saia.php", "librerias");
			$includes .= "<?php echo(librerias_jquery('1.7')); ?>";
			$includes .= $this->incluir_libreria("header_nuevo.php", "librerias");
			$includes .= $this->incluir("../../class_transferencia.php", "librerias");

			$contenido = $includes . $texto . $enlace . $this->incluir_libreria("footer_nuevo.php", "librerias");
			$mostrar = crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_mostrar"], $contenido);
			// Las siguientes lineas comentadas, estan pendientes por eliminar, todo el funcionamiento de la creacion de modulos y la creacion del permiso del formato se realiza en formatoaddp.php en la funcion crear_modulo_formato
			if ($mostrar != "") {
			}
		} else
			alerta_formatos("931 No es posible generar el Formato");
	}

	/*
	 * <Clase>
	 * <Nombre>generar_vista</Nombre>
	 * <Parametros>$idformato:id de la vista</Parametros>
	 * <Responsabilidades>Se encarga de revisar que todas las funciones y campos asociados a la vista se encuentren previamente configurados, antes de proceder a llamar la funci�n que genera el archivo con el mostrar de la vista<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	private function generar_vista() {
		global $sql, $conn;
		$vista = busca_filtro_tabla("*", "vista_formato A", "A.idvista_formato=" . $this->idformato, "", $conn);
		if ($vista["numcampos"]) {
			$encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $vista[0]["encabezado"] . "'", "", $conn);
			$pie = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $vista[0]["pie_pagina"] . "'", "", $conn);
			$formato_padre = busca_filtro_tabla("", "formato", "idformato=" . $vista[0]["formato_padre"], "", $conn);
			$lcampos = "";
			$regs = array();
			$regs1 = array();
			$texto = $vista[0]["cuerpo"];
			if ($encabezado["numcampos"])
				$texto .= $encabezado[0][0];
			if ($pie["numcampos"])
				$texto .= $pie[0][0];
			$resultado = preg_match_all('({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*)+\*})', $texto, $regs);
			$campos = array_unique($regs[0]);
			sort($campos);

			$campos_editar = array();
			$campos_edit = array();
			$campos_adicionar = array();
			$campos_otrosf = array();
			if ($campos) {
				$l1campos = array();
				$l1tablas = array();
				foreach ( $campos as $key => $value ) {
					$valor = explode('.', $value);
					if (@$valor[1] == "" && $valor[0] != "") {
						$valor[1] = $valor[0];
						$valor[0] = $formato_padre[0]["nombre_tabla"];
					}
					if (array_key_exists($valor[0], $l1tablas)) {
						array_push($l1tablas[$valor[0]], $valor[1]);
					} else {
						$l1tablas[$valor[0]] = array(
								$valor[1]
						);
					}
				}
			} else
				alerta_formatos("La Vista del formato no posee Parametros si esta seguro continue con el Proceso de lo contrario haga Click en Listar Vistas Formato y Luego Editela");
		} else
			alerta_formatos('No existen la vista seleccionada');

		$this->crear_vista_formato($l1tablas);
	}

	/*
	 * <Clase>
	 * <Nombre>crear_vista_formato</Nombre>
	 * <Parametros>$idformato:id de la vista;$arreglo:contiene como llave los nombres de los campos y como valor el id del formato padre de la vista</Parametros>
	 * <Responsabilidades>Se encarga de crear el archivo para mostrar en pantalla la vista seleccionada<Responsabilidades>
	 * <Notas>si se necesita alguna funci�n, o un campo, �stos debe estar registrados como asociados al formato padre de la vista, de lo contrario no funciona</Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	private function crear_vista_formato($arreglo) {
		global $sql, $conn;
		$vista = busca_filtro_tabla("*", "vista_formato A", "A.idvista_formato=" . $this->idformato, "", $conn);
		$includes = '';
		$texto = '';
		$enlace = "";
		if ($vista["numcampos"]) {
			$texto = '';
			$texto .= '<tr><td>';
			$archivos = 0;
			$texto .= htmlspecialchars_decode($vista[0]["cuerpo"]);
			$texto .= '</td></tr>';
			$librerias = array();
			$idformato_padre = $vista[0]["formato_padre"];
			$fpadre = busca_filtro_tabla("", "formato", "idformato=" . $idformato_padre, "", $conn);
			$funciones = busca_filtro_tabla("*", "funciones_formato A", "A.formato LIKE '" . $idformato_padre . "' OR A.formato LIKE '%," . $idformato_padre . ",%' OR A.formato LIKE '%," . $idformato_padre . "' OR A.formato LIKE '" . $idformato_padre . ",%' AND A.acciones LIKE '%m%'", "", $conn);
			$campos = busca_filtro_tabla("*", "campos_formato A", "A.formato_idformato=" . $idformato_padre, "", $conn);
			$lcampos = extrae_campo($campos, "nombre", "U");
			for($i = 0; $i < $campos["numcampos"]; $i++) {
				if ($campos[$i]["etiqueta_html"] == "autocompletar") {
					$parametros = explode(";", $campos[$i]["valor"]);
					$texto = str_replace("{*" . $campos[$i]["nombre"] . "*}", "<?php busca_campo(" . "'" . $parametros[0] . "','" . $parametros[1] . "','" . $parametros[2] . "',mostrar_valor_campo('" . $campos[$i]["nombre"] . "','" . $idformato_padre . "',$" . "_REQUEST['iddoc'],1)); ?" . ">", $texto);
				} /*
				   * elseif($campos[$i]["etiqueta_html"]=="detalle"){
				   * $texto=str_replace("{*listado_detalles_".str_replace("id","",$campos[$i]["nombre"])."*}",arma_funcion("buscar_listado_formato","'".$formato[0]["nombre"]."',".$campos[$i]["valor"],"mostrar"),$texto);
				   * }
				   */
else
	$texto = str_replace("{*" . $campos[$i]["nombre"] . "*}", $this->arma_funcion("mostrar_valor_campo", "'" . $campos[$i]["nombre"] . "',$idformato_padre", "mostrar"), $texto);
				if ($campos[$i]["etiqueta_html"] == "archivo") {
					$archivos++;
				}
			}
			if ($archivos) {
				$includes .= $this->incluir("../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js", "javascript");
				$includes .= $this->incluir("../../anexosdigitales/funciones_archivo.php", "librerias");
				$includes .= $this->incluir("../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js", "javascript");
				$includes .= '<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style>';
				$includes .= "<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>";
			}

			for($i = 0; $i < $funciones["numcampos"]; $i++) {
				$ruta_orig = "";
				$formato_orig = explode(",", $funciones[$i]["formato"]);
				if ($formato_orig[0] != $idformato_padre) { // busco el nombre del formato inicial
					$dato_formato_orig = busca_filtro_tabla("nombre", "formato", "idformato=" . $formato_orig[0], "", $conn);
					if ($dato_formato_orig["numcampos"] && ($dato_formato_orig[0]["nombre"] != $fpadre[0]["nombre"])) {
						$eslibreria = strpos($funciones[$i]["ruta"], "../librerias/");
						if ($eslibreria === false) {
							$eslibreria = strpos($funciones[$i]["ruta"], "../class_transferencia");
						}
						// si el archivo existe dentro de la carpeta del archivo inicial
						if (is_file($dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"]) && $eslibreria === false) {
							$includes .= $this->incluir("../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
						} elseif (is_file($funciones[$i]["ruta"]) && $eslibreria === false) { // si el archivo existe en la ruta especificada partiendo de la raiz

							$includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
						} else if ($eslibreria === false) // si no existe en ninguna de las dos
{ // trato de crearlo dentro de la carpeta del formato actual
							alerta_formatos("Las funciones del Formato " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"] . " son requeridas  no se han encontrado");
							if (crear_archivo(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
								$includes .= $this->incluir($dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
							} else
								alerta_formatos("1073 No es posible generar el archivo " . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
						}
					}
				} else // $ruta_orig=$formato[0]["nombre"];
{ // si el archivo existe dentro de la carpeta del formato actual
					if (is_file($fpadre[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
						$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
					} elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
						$includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
					} else // si no existe en ninguna de las dos
{ // trato de crearlo dentro de la carpeta del formato actual
						if (crear_archivo(FORMATOS_CLIENTE . $fpadre[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
							$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
						} else
							alerta_formatos("1087 No es posible generar el archivo " . $fpadre[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
					}
				}
				if ($funciones[$i]["parametros"] != "")
					$parametros = $idformato_padre . "," . $funciones[$i]["parametros"];
				else
					$parametros = $idformato_padre;
					$texto = str_replace($funciones[$i]["nombre"], $this->arma_funcion($funciones[$i]["nombre_funcion"], $parametros, "mostrar"), $texto);
			}
			if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
				$includes .= $this->incluir($formato[0]["librerias"], "librerias", 1);
			}
			$includes .= $this->incluir_libreria("funciones_generales.php", "librerias");
			$includes .= $this->incluir("../../js/jquery.js", "javascript");
			$includes .= $this->incluir_libreria("header_nuevo.php", "librerias");
			$includes .= $this->incluir("../../class_transferencia.php", "librerias");

			$contenido = $includes . $texto . $enlace . $this->incluir_libreria("footer_nuevo.php", "librerias");
			$mostrar = crear_archivo($fpadre[0]["nombre"] . "/" . $vista[0]["ruta_mostrar"], $contenido);
			if ($mostrar != "") {
				$modulo_formato = busca_filtro_tabla("", "modulo", "nombre LIKE 'modulo_formatos'", "", $conn);
				if ($modulo_formato["numcampos"]) {
					$submodulo_formato = busca_filtro_tabla("", "modulo", "nombre LIKE '" . $vista[0]["nombre"] . "'", "", $conn);
					if (!$submodulo_formato["numcampos"]) {
						$sql = "INSERT INTO modulo(nombre,tipo,imagen,etiqueta,enlace,destino,cod_padre,orden,ayuda) VALUES ('" . $vista[0]["nombre"] . "','secundario','botones/formatos/modulo.gif','" . $vista[0]["etiqueta"] . "','" . FORMATOS_CLIENTE . $vista[0]["ruta_mostrar"] . "','centro','" . $modulo_formato[0]["idmodulo"] . "','1','Permite administrar el formato " . $vista[0]["etiqueta"] . ".')";
						// /die($sql);
						guardar_traza($sql, $fpadre[0]["nombre_tabla"]);
						phpmkr_query($sql, $conn);
					}
				} else
					alerta_formatos("El modulo Formatos No existe por favor insertarlo a la tabla modulos");
				alerta_formatos("Vista Creada con exito por favor verificar la carpeta " . dirname($mostrar));
				return (TRUE);
			}
		} else
			alerta_formatos("1122 No es posible generar el Formato");
	}

	/*
	 * <Clase>
	 * <Nombre>codifica</Nombre>
	 * <Parametros>$texto:texto que se desea codificar</Parametros>
	 * <Responsabilidades>llama la funci�n que pasa el texto a mayusculas y devuelve el nuevo texto modificado<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	private function codifica($texto) { // strtoupper(codifica_encabezado(html_entity_decode($campos[$h]["etiqueta"])))
		return mayusculas($texto);
	}

	/*
	 * <Clase>
	 * <Nombre>crear_formato_ae</Nombre>
	 * <Parametros>$idformato:id del formato;$accion:adicionar o editar</Parametros>
	 * <Responsabilidades>Crea el archivo en el adicionar o el editar del formato segun la configuraci�n realizada<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	public function crear_formato_ae($accion) {
		global $sql, $conn;
		$datos_detalles["numcampos"] = 0;
		$texto = '';
		$includes = "";
		$obligatorio = "";
		$autoguardado = array();
		$formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
		if ($formato["numcampos"]) {
			if ($formato[0]["item"]) {
				$action = '../../' . FORMATOS_SAIA . 'librerias/funciones_item.php';
			} else {
				$action = '../../class_transferencia.php';
			}
			$texto .= '<body bgcolor="#F5F5F5"><?php llama_funcion_accion(@$_REQUEST["iddoc"],@$_REQUEST["idformato"],"ingresar","ANTERIOR");? ><form name="formulario_formatos" id="formulario_formatos" method="post" action="' . $action . '" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4">';

			if (!$formato[0]["item"]) {
				$texto .= '<tr><td colspan="2" class="encabezado_list">' . codifica_encabezado(html_entity_decode(mayusculas($formato[0]["etiqueta"]))) . '</td></tr>';
			}
			$librerias = array();
			if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
				$includes .= $this->incluir($formato[0]["librerias"], "librerias", 1);
			}

			$includes .= $this->incluir_libreria("funciones_formatos.js", "javascript");
			$includes .= $this->incluir("../../js/cmxforms.js", "javascript");
			if ($formato[0]["estilos"] && $formato[0]["estilos"] != "") {
				$includes .= $this->incluir($formato[0]["estilos"], "estilos", 1);
			}
			if ($formato[0]["javascript"] && $formato[0]["javascript"] != "") {
				$includes .= $this->incluir($formato[0]["javascript"], "javascript", 1);
			}
			$arboles = 0;
			$spinner = 0;
			$dependientes = 0;
			$mascaras = 0;
			$textareas = 0;
			$autocompletar = 0;
			$checkboxes = 0;
			$fecha = 0;
			$hora = 0;
			$archivo = 0;
			$lista_enmascarados = "";
			$indice_tabindex = 1;
			$listado_campos = array();
			$unico = array();
			$campos = busca_filtro_tabla("*", "campos_formato A", "A.acciones like '%" . $accion[0] . "%' and A.formato_idformato=" . $this->idformato, "orden ASC", $conn);
			// print_r($campos);die();
			// funciones creadas para el formato, pero que corresponden a nombres de campos
			$fun_campos = array();
			for($h = 0; $h < $campos["numcampos"]; $h++) {
				if ($campos[$h]["etiqueta_html"] == "arbol")
					$arboles = 1;
				elseif ($campos[$h]["etiqueta_html"] == "textarea")
					$textareas = 1;
				if ($campos[$h]["obligatoriedad"])
					$obliga = "*";
				else
					$obliga = "";

				$tabindex = " tabindex='$indice_tabindex' ";
				if ($campos[$h]["autoguardado"])
					$autoguardado[] = $campos[$h]["nombre"];
				// ******************** validaciones *****************
				$adicionales = "";
				// echo $campos[$h]["nombre"]." ".$valor."<br />";
				$longitud = busca_filtro_tabla("valor", "caracteristicas_campos", "tipo_caracteristica ='maxlength' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
				if ($longitud["numcampos"]) {
					if ($longitud[0][0] > $campos[$h]["longitud"])
						$adicionales .= "maxlength=\"" . $campos[$h]["longitud"] . "\" ";
					else
						$adicionales .= "maxlength=\"" . $longitud[0][0] . "\" ";
				} elseif ($campos[$h]["longitud"])
					$adicionales .= "maxlength=\"" . $campos[$h]["longitud"] . "\" ";

				$caracteristicas = busca_filtro_tabla("", "caracteristicas_campos", "tipo_caracteristica not in('adicionales','class','maxlength') and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
				for($c = 0; $c < $caracteristicas["numcampos"]; $c++) {
					$adicionales .= " " . $caracteristicas[$c]["tipo_caracteristica"] . "='" . $caracteristicas[$c]["valor"] . "' ";
				}
				// obligatoriedad
				$class = busca_filtro_tabla("valor", "caracteristicas_campos", "tipo_caracteristica='class' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);

				if ($campos[$h]["obligatoriedad"]) {
					if ($class["numcampos"])
						$adicionales .= " class=\"required " . $class[0][0] . "\" ";
					else
						$adicionales .= " class=\"required\" ";
				} elseif ($class["numcampos"])
					$adicionales .= " class=\"" . $class[0][0] . "\" ";
				// atributos adicionales
				$otros = busca_filtro_tabla("", "caracteristicas_campos", "tipo_caracteristica='adicionales' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
				if ($otros["numcampos"])
					$adicionales .= $otros[0]["valor"];

				// ***************************************************
				if ($campos[$h]["banderas"] != "") {
					$bandera_unico = strpos("u", $campos[$h]["banderas"]);
					if ($bandera_unico !== false) {
						array_push($unico, array(
								$campos[$h]["nombre"],
								$campos[$h]["idcampos_formato"]
						));
						$obligatorio = 'obligatorio="obligatorio"';
						$obliga = "(*)";
					}
				}
				if (strpos($campos[$h]["valor"], "*}") > 0) {
					$nombre_func = str_replace("{*", "", $campos[$h]["valor"]);
					$nombre_func = str_replace("*}", "", $nombre_func);
					$texto .= '<tr>
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     ';
					$parametros = $this->idformato . "," . $campos[$h]["idcampos_formato"];
					$texto .= $this->arma_funcion($nombre_func, $parametros, $accion) . "</tr>";
					array_push($fun_campos, $nombre_func);
				} else {
					if ($accion == 'adicionar')
						$valor = '<?php echo(validar_valor_campo(' . $campos[$h]["idcampos_formato"] . ')); ? >';
					elseif ($accion == "editar") { /*
					                                * if($formato[0]["item"])
					                                * $valor="<?php echo(mostrar_valor_campo('".$campos[$h]["nombre"]."',$this->idformato,$"."_REQUEST['item'])); ? >";
					                                * else
					                                */
						$valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ? >";
					}
					switch ($campos[$h]["etiqueta_html"]) {
						case "etiqueta" :
							$texto .= '<tr>
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '" colspan="2" id="' . $campos[$h]["nombre"] . '">' . $campos[$h]["valor"] . '</td>
                    </tr>';
							break;
						case "password" :
							$texto .= '<tr>
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     <td bgcolor="#F5F5F5"><input ' . $tabindex . ' type="password" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . " $adicionales " . ' value="' . $valor . '"></td>
                    </tr>';
							$indice_tabindex++;
							break;
						case "textarea" :
							$valor = $campos[$h]["valor"];
							echo ($valor);
							$valor2 = explode("|", $campos[$h]["valor"]);
							$nivel_barra = "";
							if (count($valor2)) {
								$nivel_barra = $valor2[0];
								if (@$valor2[1] != "") {
									if ($accion == "adicionar" && strpos($valor2[1], "*}")) {
										$includes .= $this->incluir("funciones.php", "librerias");
										$valor = $this->arma_funcion($valor2[1], $this->idformato . ",$" . "_REQUEST['iddoc']", $accion);
									} else if ($accion == "adicionar" && strpos($valor2[1], "*}") === false) {
										$valor = $valor2[1];
									}
								} else {
									$valor = "";
								}
							}
							echo ($valor);
							if ($accion == "editar") {
								$valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ? >";
							} else if ($valor == "")
								$valor = '<?php echo(validar_valor_campo(' . $campos[$h]["idcampos_formato"] . ')); ? >';
							if ($nivel_barra == "")
								$nivel_barra = "basico";
							$texto .= '<tr>
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     <td class="celda_transparente"><textarea ' . $tabindex . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" cols="53" rows="3" class="tiny_' . $nivel_barra;
							if ($campos[$h]["obligatoriedad"])
								$texto .= ' required';
							$texto .= '">' . $valor . '</textarea></td>
                    </tr>';
							$textareas++;
							$indice_tabindex++;
							break;
						case "fecha" :
							// si la fecha es obligatoria, que valide que no se vaya con solo ceros
							if ($campos[$h]["tipo_dato"] == "DATE") {
								$adicionales = str_replace("required", "required dateISO", $adicionales);

								$texto .= '<tr>
                       <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input ' . $tabindex . ' type="text" readonly="true" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" tipo="fecha" value="';
								if ($accion == "adicionar") {
									if ($campos[$h]["predeterminado"] == "now()")
										$texto .= '<?php echo(date("Y-m-d")); ?' . '>';
									else
										$texto .= '<?php echo(date("0000-00-00")); ?' . '>';
								} else
									$texto .= "<?php mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc']); ?" . ">";
								$texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR","VENTANA",FALSE,FALSE); ?' . '></span></font>';

								$fecha++;
								$indice_tabindex++;
							} else if ($campos[$h]["tipo_dato"] == "DATETIME") {
								$adicionales = str_replace("required", "required dateISO", $adicionales);
								$texto .= '<tr>
                    <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input ' . $tabindex . ' type="text" readonly="true" name="' . $campos[$h]["nombre"] . '" ' . $adicionales . ' id="' . $campos[$h]["nombre"] . '" value="';
								if ($accion == "adicionar") {
									if ($campos[$h]["predeterminado"] == "now()")
										$texto .= '<?php echo(date("Y-m-d H:i")); ?' . '>';
									else
										$texto .= '<?php echo(date("0000-00-00 00:00")); ?' . '>';
								} else
									$texto .= "<?php mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc']); ?" . ">";
								$texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '></span></font>';
								$fecha++;
								$indice_tabindex++;
							} else if ($campos[$h]["tipo_dato"] == "TIME") {
								$texto .= '<tr>
                    <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input ' . $tabindex . ' type="text"  name="' . $campos[$h]["nombre"] . '" ' . $adicionales . ' id="' . $campos[$h]["nombre"] . '" value="';
								if ($accion == "adicionar") {
									$texto .= '"></span></font>';
								} else {
									$texto .= "<?php mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc']); ?" . '>"></span></font>';
								}
								if ($accion == "adicionar") {
									$texto .= '<script type="text/javascript">
                      $(function(){
                        var now = new Date();
                        var h=(now.getHours());
                        var m=now.getMinutes();
                        var s=now.getSeconds();

                        $(' . "'#" . $campos[$h]["nombre"] . "'" . ').clock({displayFormat:' . "'24'" . ',
                                         defaultHour:h,
                                         defaultMinute:m,
                                         defaultSecond:s
                                         });
                      });
                      </script>';
								} elseif ($accion == "editar") {
									$texto .= '<script type="text/javascript">
                      $(function(){
                        var now = $(' . "'#" . $campos[$h]["nombre"] . "'" . ').val();
                        vector=now.split(":");
                        var h=vector[0];
                        var m=vector[1];
                        var s=0;

                        $(' . "'#" . $campos[$h]["nombre"] . "'" . ').clock({displayFormat:' . "'24'" . ',
                                         defaultHour:h,
                                         defaultMinute:m,
                                         defaultSecond:s
                                         });
                      });
                      </script>';
								}

								$hora++;
								$indice_tabindex++;
							} else
								alerta_formatos("No esta definido su formato de Fecha");
							$texto .= '</td>';

							break;
						case "radio":
              /* En los campos de este tipo se debe validar que valor contenga un listado con las siguentes caracteristicas*/
                $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '" >
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';

                $texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</td></tr>';
							break;
						case "link" :
							$texto .= '<tr>
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';
							if (strpos($adicionales, "class") !== false)
								$adicionales = str_replace("required", "required url", $adicionales);
							else
								$adicionales .= " class='url' ";
							$texto .= '<td bgcolor="#F5F5F5"><textarea cols="40" rows="3" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" ' . $adicionales . '>';
							if ($accion == "editar") {
								$valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ? >";
							} else if ($valor == "")
								$valor = '<?php echo(validar_valor_campo(' . $campos[$h]["idcampos_formato"] . ')); ? >';
							$texto .= $valor . '</textarea></td></tr>';
							break;
						case "checkbox" :
							$texto .= '<tr>
                  <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';
							$texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</td></tr>';
							$checkboxes++;
							break;
						case "select" :
							$texto .= '<tr>
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';
							$texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</td></tr>';
							break;
						case "dependientes":
              /*parametros:
              nombre del select padre; sql select padre| nombre del select hijo; sql select hijo....
              (ej: departamento;select iddepartamento as id,nombre from departamento order by nombre| municipio; select idmunicipio as id,nombre from municipio where departamento_iddepartamento=)*/
                $parametros = explode("|", $campos[$h]["valor"]);
							if (count($parametros) < 2)
								alerta_formatos("Por favor verifique los parametros de configuracion de su select dependiente " . $campos[$h]["etiqueta"]);
							else {
								$texto .= '<tr>
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';
								$texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $this->idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</td></tr>';
								$dependientes++;
							}
							break;
						case "archivo" :
							$tipo_input = 'unico';
							if ($campos[$h]["valor"] != '') {
								$mystring = $campos[$h]["valor"];
								$findme = '@';
								$pos = strpos($mystring, $findme);
								if ($pos !== false) { // fue encontrada
									$vector_extensiones_tipo = explode($findme, $mystring);
									$tipo_input = $vector_extensiones_tipo[1];
									$extensiones_fijas = $vector_extensiones_tipo[0];
								}
							}
							$funcion_adicional_archivo = '';
							$ul_adicional_archivo = '';
							switch ($tipo_input) {
								case 'unico' :
									if (strpos($adicionales, "class") !== false) {
										$adicionales = str_replace("required", "required multi", $adicionales);
									} else {
										$adicionales .= " class='multi' ";
									}
									break;
								case 'multiple' :
									$adicionales .= " multiple='multiple' onchange='makeFileList_" . $campos[$h]["nombre"] . "();' ";
									$ul_adicional_archivo = '<ul id="fileList_' . $campos[$h]["nombre"] . '"></ul>';
									$funcion_adicional_archivo = '
								<script>
								function makeFileList_' . $campos[$h]["nombre"] . '() {
									var input = document.getElementById("' . $campos[$h]["nombre"] . '");
									var ul = document.getElementById("fileList_' . $campos[$h]["nombre"] . '");

									while (ul.hasChildNodes()) {
										ul.removeChild(ul.firstChild);
									}
									for (var i = 0; i < input.files.length; i++) {
										var li = document.createElement("li");
										li.innerHTML = input.files[i].name;
										ul.appendChild(li);
									}
									if(!ul.hasChildNodes()) {
										var li = document.createElement("li");
										li.innerHTML = "No se eligi&oacute; archivo";
										ul.appendChild(li);
									}
								}
								</script>
								';
									break;
							}

							$texto .= '<tr>
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     <td class="celda_transparente">' . $funcion_adicional_archivo;

							if ($extensiones_fijas != "")
								$extensiones = $extensiones_fijas;
							else
								$extensiones = '<?php echo $extensiones;?' . '>';

							if ($accion == "adicionar") {
								$texto .= '<input ' . $tabindex . ' type="file" ' . $adicionales . ' id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '[]" ' . 'accept="' . $extensiones . '"' . '>';
								$texto .= $ul_adicional_archivo;
							}
							if ($accion == "editar") {

								/* SE DEBEN LISTAR TODOS LOS ANEXOS Y PERMITIR BORRARLOS CON UN AGREGA BOTON */
								$texto .= '<?php echo \'<div class="textwrapper">
			<a href="../../anexosdigitales/anexos_documento_edit.php?key=\'.$_REQUEST["iddoc"].\'&idformato=' . $campos[$h]["formato_idformato"] . '&idcampo=' . $campos[$h]["idcampos_formato"] . '" id="anexo_admin" class="highslide" onclick="return hs.htmlExpand( this, {
			objectType: \\\'iframe\\\', outlineType: \\\'rounded-white\\\', wrapperClassName: \\\'highslide-wrapper drag-header\\\',
			outlineWhileAnimating: true, preserveContent: false, width: 400 } )">Administrar Anexos</a>
			</div>\'; ?' . '>';
							}
							echo '</td></tr>';
							$indice_tabindex++;
							$archivo++;
							break;
						case "tarea" :
							// parametros:id de la tarea
							$texto .= '<tr>
                  <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td colspan="2" bgcolor="#F5F5F5"><font size="1,5" face="Verdana, Arial, Helvetica, sans-serif"><span ><input type="hidden" name="tarea_' . $campos[$h]["nombre"] . '" value="' . $campos[$h]["valor"] . '"><input type="text" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" value="';
							if ($accion == "adicionar") {
								if ($campos[$h]["predeterminado"] == "now()")
									$texto .= '<?php echo(date("Y-m-d H:i")); ?' . '>';
								else
									$texto .= '<?php echo(date("0000-00-00 00:00")); ?' . '>';
							} else
								$texto .= "<?php mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc']); ?" . ">";
							$texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '","formulario_formato","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '></span></font></td>';
							$fecha++;
							$mascaras++;
							$lista_enmascarados .= "
                  $('#" . $campos[$h]["nombre"] . "').mask('9999-99-99 99:99',{
                      completed:function(){
                        $.ajax({
                          type:'POST',
                          url:'../librerias/validar_fecha.php',
                          data:'formato=%Y-%m-%d %H:%s:00&valor='+this.val()+':00',
                          success: function(datos,exito){
                            if(datos==0){
                              alert('Fecha no valida');
                              this.focus();
                            }
                          }
                        });
                      }
                    });";
							break;
						case "hidden" :
							$texto .= '<input type="hidden" name="' . $campos[$h]["nombre"] . '" value="' . $valor . '">';
							break;
						case "autocompletar":
                /* parametros: campos a mostrar separados por comas; campo a guardar en el hidden; tabla
                  ej: nombres,apellidos;idfuncionario;funcionario
                */
                $texto .= '<tr>
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                   <td bgcolor="#F5F5F5">';
							$texto .= '<input type="text" size="30" ' . $adicionales . ' value="" id="input' . $campos[$h]["idcampos_formato"] . '" onkeyup="lookup(this.value,' . $campos[$h]["idcampos_formato"] . ');" onblur="fill(this.value,' . $campos[$h]["idcampos_formato"] . ');" />
                <div class="suggestionsBox" id="suggestions' . $campos[$h]["idcampos_formato"] . '" style="display: none;">
				        <div class="suggestionList" id="list' . $campos[$h]["idcampos_formato"] . '" >&nbsp;
        				</div>
        			  </div>
        			  <input ' . $obligatorio . ' type="text" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '">
                </td></tr>';
							$autocompletar++;
							break;
						case "etiqueta" :
							$texto .= '<tr>
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                   <td bgcolor="#F5F5F5"><label>' . $valor . '</label><input type="hidden" name="' . $campos[$h]["nombre"] . '" value="' . $valor . '"></td>
                  </tr>';
							break;
						case "ejecutor" :

							if ($accion == "editar") {
								$valor = "<?php echo(mostrar_valor_campo('" . $campos[$h]["nombre"] . "',$this->idformato,$" . "_REQUEST['iddoc'])); ? >";
							} else
								$valor = $campos[$h]["predeterminado"];

							$texto .= '<tr>
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                   <td bgcolor="#F5F5F5">
                   <input type="hidden" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '" value="' . $valor . '"><?php componente_ejecutor("' . $campos[$h]["idcampos_formato"] . '",@$_REQUEST["iddoc"]); ?' . '>';
							$texto .= '</td>
                  </tr>';
							break;
						case "arbol":
                $arreglo = explode(";", $campos[$h]["valor"]);
							if (isset($arreglo) && $arreglo[0] != "") {
								$ruta = "\"" . $arreglo[0] . "\"";
							} else {
								$ruta = "\"../arboles/test_dependencia.xml\"";
								$arreglo[1] = 0;
								$arreglo[2] = 0;
								$arreglo[3] = 0;
								$arreglo[4] = 1;
							}
							$texto .= '<tr>
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>';
							$texto .= '<td bgcolor="#F5F5F5">';
							$texto .= '<div id="seleccionados">' . $this->arma_funcion("mostrar_seleccionados", $this->idformato . "," . $campos[$h]["idcampos_formato"] . ",'" . $arreglo[6] . "'", "mostrar") . '</div>
                          <br />  ';
							if ($arreglo[4]) {
								$texto .= 'Buscar: <input ' . $tabindex . ' type="text" id="stext_' . $campos[$h]["nombre"] . '" width="200px" size="25"><a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value),1)"> <img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br />';
								$indice_tabindex++;
							}
							$texto .= '<div id="esperando_' . $campos[$h]["nombre"] . '"><img src="../../imagenes/cargando.gif"></div><div id="treeboxbox_' . $campos[$h]["nombre"] . '" height="90%"></div>';
							// miro si ya estan incluidas las librerias del arbol
							$texto .= '<input type="hidden" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '"  ';

							if ($accion == "editar") {
								$texto .= ' value="' . $this->arma_funcion("cargar_seleccionados", $this->idformato . "," . $campos[$h]["idcampos_formato"] . ",1", "mostrar") . '" >';
							} else
								$texto .= ' value="" ><label style="display:none" class="error" for="' . $campos[$h]["nombre"] . '">Campo obligatorio.</label>';
							$texto .= '<script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_' . $campos[$h]["nombre"] . '=new dhtmlXTreeObject("treeboxbox_' . $campos[$h]["nombre"] . '","100%","100%",0);
                			tree_' . $campos[$h]["nombre"] . '.setImagePath("../../imgs/");
                			tree_' . $campos[$h]["nombre"] . '.enableIEImageFix(true);';
							if ($arreglo[1] == 1) {
								$texto .= 'tree_' . $campos[$h]["nombre"] . '.enableCheckBoxes(1);
                			tree_' . $campos[$h]["nombre"] . '.enableThreeStateCheckboxes(1);';
							} else if ($arreglo[1] == 2) {
								$texto .= 'tree_' . $campos[$h]["nombre"] . '.enableCheckBoxes(1);
                    tree_' . $campos[$h]["nombre"] . '.enableRadioButtons(true);';
							}

							$texto .= 'tree_' . $campos[$h]["nombre"] . '.setOnLoadingStart(cargando_' . $campos[$h]["nombre"] . ');
                      tree_' . $campos[$h]["nombre"] . '.setOnLoadingEnd(fin_cargando_' . $campos[$h]["nombre"] . ');';
							if ($arreglo[3]) {
								$texto .= 'tree_' . $campos[$h]["nombre"] . '.enableSmartXMLParsing(true);';
							} else
								$texto .= 'tree_' . $campos[$h]["nombre"] . '.setXMLAutoLoading(' . $ruta . ');';
							if ($accion == "editar") {
								$ruta .= ",checkear_arbol";
							}
							$texto .= 'tree_' . $campos[$h]["nombre"] . '.loadXML(' . $ruta . ');
                	        ';
							if ($arreglo[1] == 1) {
								$texto .= '
                      tree_' . $campos[$h]["nombre"] . '.setOnCheckHandler(onNodeSelect_' . $campos[$h]["nombre"] . ');
                      function onNodeSelect_' . $campos[$h]["nombre"] . '(nodeId)
                      {valor_destino=document.getElementById("' . $campos[$h]["nombre"] . '");
                       destinos=tree_' . $campos[$h]["nombre"] . '.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("_")!=-1)
                             {vector[i]=vector[i].substr(0,vector[i].indexOf("_"));
                             }
                           nuevo=vector.join(",");
                           if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_' . $campos[$h]["nombre"] . '.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");

                               for(h=0;h<vectorh.length;h++)
                                  {if(vectorh[h].indexOf("_")!=-1)
                                      vectorh[h]=vectorh[h].substr(0,vectorh[h].indexOf("_"));
                                   nuevo=eliminarItem(nuevo,vectorh[h]);
                                  }
                              }
                          }
                       nuevo=nuevo.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       valor_destino.value=nuevo;
                      }';
							} elseif ($arreglo[1] == 2) {
								$texto .= 'tree_' . $campos[$h]["nombre"] . '.setOnCheckHandler(onNodeSelect_' . $campos[$h]["nombre"] . ');
                      function onNodeSelect_' . $campos[$h]["nombre"] . '(nodeId)
                      {valor_destino=document.getElementById("' . $campos[$h]["nombre"] . '");

                       if(tree_' . $campos[$h]["nombre"] . '.isItemChecked(nodeId))
                         {if(valor_destino.value!=="")
                          tree_' . $campos[$h]["nombre"] . '.setCheck(valor_destino.value,false);
                          if(nodeId.indexOf("_")!=-1)
                             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
                          valor_destino.value=nodeId;
                         }
                       else
                         {valor_destino.value="";
                         }
                      }';
							}
							$texto .= "
                      function fin_cargando_" . $campos[$h]["nombre"] . "() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else
                           document.poppedLayer =
                              eval('document.layers[\"esperando_" . $campos[$h]["nombre"] . "\"]');
                        document.poppedLayer.style.display = \"none\";
                      }

                      function cargando_" . $campos[$h]["nombre"] . "() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else
                           document.poppedLayer =
                               eval('document.layers[\"esperando_" . $campos[$h]["nombre"] . "\"]');
                        document.poppedLayer.style.display = \"\";
                      }
                	";
							if ($accion == "editar") {
								$texto .= "
                  function checkear_arbol(){
                  vector2=\"" . $this->arma_funcion("cargar_seleccionados", $this->idformato . "," . $campos[$h]["idcampos_formato"] . ",1", "mostrar") . "\";
                  vector2=vector2.split(\",\");
                  for(m=0;m<vector2.length;m++)
                    {tree_" . $campos[$h]["nombre"] . ".setCheck(vector2[m],true);
                    }}\n";
							}
							$texto .= "--></script>";
							$texto .= '</td></tr>';
							$arboles++;
							break;
						case "item" :
							break;
						case "detalle" :
							if ($formato[0]["item"]) {
								$padre = busca_filtro_tabla("nombre_tabla", "formato A", "idformato=" . $campos[$h]["valor"], "", $conn);
								if ($padre["numcampos"]) {
									$texto .= '<?php if($_REQUEST["padre"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["padre"]; ?' . '>"><input type="hidden"  name="idpadre" ' . $obligatorio . ' value="<?php echo $_REQUEST["idpadre"]; ?' . '>">' . '<?php } ?' . '>';
								} else
									$texto .= '<?php listar_select_padres(' . $padre[0]["nombre_tabla"] . '); ?' . '>';
							} else {
								$padre = busca_filtro_tabla("nombre_tabla", "formato A", "idformato=" . $campos[$h]["valor"], "", $conn);
								if ($padre["numcampos"] && $accion == "adicionar") {
									$texto .= '<?php if($_REQUEST["padre"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["padre"]; ?' . '>">' . '<?php } ?' . '>';
									$texto .= '<?php if($_REQUEST["anterior"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["anterior"]; ?' . '>">' . '<?php }  else {listar_select_padres(' . $padre[0]["nombre_tabla"] . ');} ?' . '>';
								}
							}
							break;
						case "spin" :
							$aux[] = "imageBasePath:'../../images/'";
							if ($campos[$h]["valor"] != "") {
								$parametros = explode("@", $campos[$h]["valor"]);
								if (is_numeric($parametros[0])) {
									$aux[] = 'min:' . $parametros[0];
									$aux2[] = 'min="' . $parametros[0] . '"';
								}
								if (is_numeric($parametros[1])) {
									$aux[] = 'max:' . $parametros[1];
									$aux2[] = 'max="' . $parametros[1] . '"';
								}
								if (is_numeric($parametros[2]))
									$aux[] = 'interval:' . $parametros[2];
								if (is_numeric($parametros[3]) && $parametros[3])
									$aux[] = 'lock:true';
							}
							if (is_array($aux2))
								$adicionales .= implode(" ", $aux2);
							$texto .= '<tr>
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     <td bgcolor="#F5F5F5"><input ' . " $adicionales $tabindex" . ' type="input" id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . ' value="' . $valor . '"></td>
                    </tr>
                 <script type="text/javascript">
              $(document).ready(function(){
		            $("#' . $campos[$h]["nombre"] . '").spin({';
							if (is_array($aux))
								$texto .= implode(",", $aux);
							$texto .= '});
              });
              </script>';
							$indice_tabindex++;
							$spinner++;
							break;
						default : // text
							$texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                     <td bgcolor="#F5F5F5"><input ' . " $adicionales $tabindex" . ' type="text" size="100" id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . ' value="' . $valor . '"></td>
                    </tr>';
							if ($campos[$h]["mascara"] != "") {
								$mascaras++;
								$lista_enmascarados .= "$('#" . $campos[$h]["nombre"] . "').mask('" . $campos[$h]["mascara"] . "');";
							}
							$indice_tabindex++;
							break;
					}
				}
				array_push($listado_campos, "'" . $campos[$h]["nombre"] . "'");
			}
			// ******************************************************************************************
			if ($formato[0]["item"] && $accion == "adicionar") {
				$texto .= '<tr><td class="encabezado">ACCION A SEGUIR LUEGO DE GUARDAR</td><td ><input type="radio" name="opcion_item" id="opcion_item1" value="adicionar">Adicionar otro&nbsp;&nbsp;<input type="radio" id="opcion_item2" name="opcion_item" value="terminar" checked>Terminar</td></tr>';
			}
			$wheref = "(A.formato LIKE '" . $this->idformato . "' OR A.formato LIKE '%," . $this->idformato . ",%' OR A.formato LIKE '%," . $this->idformato . "' OR A.formato LIKE '" . $this->idformato . ",%') AND A.acciones LIKE '%" . strtolower($accion[0]) . "%' ";
			if (count($listado_campos)) {
				$wheref .= "AND nombre_funcion NOT IN(" . implode(",", $listado_campos) . ")";
			}

			$funciones = busca_filtro_tabla("*", "funciones_formato A", $wheref, " idfunciones_formato asc", $conn);
			for($i = 0; $i < $funciones["numcampos"]; $i++) {
				$ruta_orig = "";
				// saco el primer formato de la lista de la funcion (formato inicial)
				$formato_orig = explode(",", $funciones[$i]["formato"]);
				// si el formato actual es distinto del formato inicial
				if ($formato_orig[0] != $this->idformato) { // busco el nombre del formato inicial
					$dato_formato_orig = busca_filtro_tabla("nombre", "formato", "idformato=" . $formato_orig[0], "", $conn);
					if ($dato_formato_orig["numcampos"]) {
						// si el archivo existe dentro de la carpeta del archivo inicial
						if (is_file(FORMATOS_CLIENTE . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
							$includes .= $this->incluir("../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
						} elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
							$includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
						} else { // si no existe en ninguna de las dos
						         // trato de crearlo dentro de la carpeta del formato actual
							if (crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
								$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
							} else {
								alerta_formatos("1843 No es posible generar el archivo " . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
							}
						}
					}
				} else { // $ruta_orig=$formato[0]["nombre"];
				         // si el archivo existe dentro de la carpeta del formato actual
					if (is_file(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
						$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
					} else if (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
						$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
					} else { // si no existe en ninguna de las dos
					         // trato de crearlo dentro de la carpeta del formato actual
						$ruta_libreria = FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"];
						$ruta_real = realpath($ruta_libreria);
						if($ruta_real === false) {
							$ruta_real = normalizePath($ruta_libreria);
						}
						if (crear_archivo($ruta_real)) {
							$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
						} else {
							alerta_formatos("1863 No es posible generar el archivo " . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
						}
					}
				}
				if (!in_array($funciones[$i]["nombre_funcion"], $fun_campos)) {
					$parametros = "$this->idformato,NULL";
					$texto .= $this->arma_funcion($funciones[$i]["nombre_funcion"], $parametros, $accion);
				}
			}
			// ******************************************************************************************
			$campo_descripcion = busca_filtro_tabla("", "campos_formato", "formato_idformato=" . $this->idformato . " AND acciones LIKE '%p%'", "", $conn);
			$valor1 = extrae_campo($campo_descripcion, "idcampos_formato", "U");
			$valor = implode(",", $valor1);
			if ($campo_descripcion["numcampos"]) {
				if ($accion == 'adicionar')
					;
				elseif ($accion == "editar") {
					if ($formato[0]["detalle"]) {
						$valor = "<?php echo('" . $valor . "'); ? >";
					} else {
						$valor = "<?php echo('" . $valor . "'); ? >";
					}
				}
				$texto .= '<input type="hidden" name="campo_descripcion" value="' . $valor . '">';
			} else
				alerta_formatos("Recuerde asignar el campo que sera almacenado como descripcion del documento");
			if ($accion == "editar")
				$texto .= '<input type="hidden" name="formato" value="' . $this->idformato . '">';
			if ($formato[0]["detalle"]) {
				$texto .= '<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?' . '>">';
				$texto .= '<input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?' . '>">';
				if ($accion == "adicionar") {
					$texto .= '<input type="hidden" name="accion" value="guardar_detalle" >';
				} elseif ($accion == "editar") {
					$texto .= '<input type="hidden" name="accion" value="editar" >';
					$texto .= '<input type="hidden" name="item" value="<?php echo $_' . 'REQUEST["item"]; ?' . '>" >';
					$texto .= '<input type="hidden" name="anterior" value="<?php echo $_' . 'REQUEST["campo"]; ?' . '>" >';
				}
			}
			if ($formato[0]["item"]) {
				$texto .= '<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?' . '>"><input type="hidden" name="formato" value="' . $formato[0]["nombre"] . '">';
				if ($accion == "adicionar") {
					$texto .= '<input type="hidden" name="accion" value="guardar_item" >';
				} elseif ($accion == "editar") {
					$texto .= '<input type="hidden" name="accion" value="editar" >';
					$texto .= '<input type="hidden" name="item" value="<?php echo $_' . 'REQUEST["item"]; ?' . '>" >';
					$texto .= '<input type="hidden" name="anterior" value="<?php echo $_' . 'REQUEST["campo"]; ?' . '>" >';
				}
			}
			$texto .= "<tr><td colspan='2'>" . $this->arma_funcion("submit_formato", $this->idformato, $accion);
			$texto .= '</td></tr></table>';
			$includes .= $this->incluir_libreria("funciones_generales.php", "librerias");
			$includes .= $this->incluir_libreria("funciones_acciones.php", "librerias");
			$includes .= $this->incluir_libreria("estilo_formulario.php", "librerias");
			if ($archivo)
				$texto .= "<input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>";
			$texto .= '</form></body>';
			if ($textareas) {
				$includes .= $this->incluir_libreria("header_formato.php", "librerias");
			}
			$includes.= $this->incluir("../../pantallas/lib/librerias_cripto.php", "librerias");
			if ($fecha) {
				$includes .= $this->incluir("../../calendario/calendario.php", "librerias");
			}

			$includes .= $this->incluir("../../librerias_saia.php", "librerias");
			$includes .= "<?php echo(librerias_jquery('1.7')); ?>";
			$includes .= "<?php echo(librerias_validar_formulario('1.16')); ?>";

			$includes .= $this->incluir("../../js/title2note.js", "javascript");
			if ($arboles) {
				$includes .= $this->incluir("../../js/dhtmlXCommon.js", "javascript");
				$includes .= $this->incluir("../../js/dhtmlXTree.js", "javascript");
				$includes .= $this->incluir_libreria("header_formato.php", "librerias");
				$includes .= '<link rel="STYLESHEET" type="text/css" href="../../css/dhtmlXTree.css">';
			}
			if ($autocompletar) {
				$includes .= $this->incluir("../librerias/autocompletar.js", "javascript");
			}
			if ($dependientes > 0) {
				$includes .= $this->incluir("../librerias/dependientes.js", "javascript");
			}

			if ($hora) {
				$includes .= $this->incluir("../../js/jquery.clock.js", "javascript");
			}
			$numero_unicos = count($unico);
			if ($numero_unicos) {
				$listado = array();
				$enmascarar .= '
        <script type="text/javascript">
       $().ready(function() {';
				for($k; $k < $numero_unicos; $k++) {
					$enmascarar .= "$('#" . $unico[0][0] . "').blur(function(){
$.ajax({url: '../librerias/validar_unico.php',
        type:'POST',
        data:'nombre=unico&valor='+$('#" . $unico[0][0] . "').val()+'&tabla=" . $formato[0]["nombre_tabla"] . "&iddoc=<" . "?php echo $" . "_REQUEST[\"iddoc\"]; ?" . ">',
        success: function(datos){

        if(datos==0){
          alert('El campo " . $unico[0][0] . " debe Ser unico');
          $('#" . $unico[0][0] . "').val('');
          $('#" . $unico[0][0] . "').focus();

         }
      }});
   });";
				}
				$enmascarar .= '});

       </script>';
			}

			if ($spinner)
				$includes .= $this->incluir("../../js/jquery.spin.js", "javascript");
			if ($mascaras) {
				$includes .= $this->incluir("../../js/jquery.maskedinput.js", "javascript");
				$enmascarar .= '
              <script type="text/javascript">jQuery.noConflict();(function($) {
                $(function() {' . $lista_enmascarados . '});
                })(jQuery);
              </script>';
			}
			if ($formato[0]["enter2tab"]) {
				$codigo_enter2tab = "<script>$(document).ready(function()
      {/* Para que el enter se comporte como tabulador    */
        tb = $('input');
        if ($.browser.mozilla)
           $(tb).keypress(enter2tab);
        else
           $(tb).keydown(enter2tab);
      });

      function enter2tab(e)
      {
        if (e.keyCode == 13)
        {
          cb = parseInt($(this).attr('tabindex'));
          if ($(':input[tabindex=\'' + (cb + 1) + '\']') != null)
            {
              $(':input[tabindex=\'' + (cb + 1) + '\']').focus();
              $(':input[tabindex=\'' + (cb + 1) + '\']').select();
              e.preventDefault();
              return false;
            }
        }
      }</script>";
			}
			if (count($autoguardado) > 0 && $accion == "adicionar") {
				$texto .= '
              <script type="text/javascript">
              setInterval("auto_save(' . "'" . implode(",", $autoguardado) . "'" . ',' . "'" . $formato[0]["nombre"] . "'" . ')",' . $formato[0]["tiempo_autoguardado"] . ');
              </script>';
			}

			if ($archivo) {
				$includes .= $this->incluir("../../anexosdigitales/multiple-file-upload/jquery.MultiFile.js", "javascript");
				$includes .= $this->incluir("../../anexosdigitales/funciones_archivo.php", "librerias");
				$includes .= $this->incluir("../../anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js", "javascript");
				$includes .= '<link rel="stylesheet" type="text/css" href="../../anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
    </style>';
				$includes .= "<script type='text/javascript'>
    hs.graphicsDir = '../../anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>";
			}
			$contenido = "<html><title>.:" . $this->codifica($accion . " " . $formato[0]["etiqueta"]) . ":.</title><head>" . $includes . "<script type='text/javascript'>
  $().ready(function() {
	// validar los campos del formato
	$('#formulario_formatos').validate();

});
</script>" . $enmascarar . " $codigo_enter2tab</head>" . $texto . "</html>";
			if ($accion == "editar")
				$contenido .= '<?php include_once("../librerias/footer_plantilla.php");?' . '>';

			$mostrar = crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $formato[0]["ruta_" . $accion], $contenido);
			if ($mostrar != "")
				alerta_formatos("Formato Creado con exito por favor verificar la carpeta " . dirname($mostrar));
		} else
			alerta_formatos("2033 No es posible generar el Formato");
		// die();
	}

	/*
	 * <Clase>
	 * <Nombre>crear_formato_buscar</Nombre>
	 * <Parametros>$idformato:id del formato;$accion:buscar</Parametros>
	 * <Responsabilidades>crear la interface para realizar las busquedas sobre los formatos<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	public function crear_formato_buscar($idformato, $accion) {
		global $sql, $conn;
		$datos_detalles["numcampos"] = 0;
		$texto = '';
		$includes = "";
		$obligatorio = "";
		$formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $idformato, "", $conn);
		if ($formato["numcampos"]) {
			$action = '../librerias/funciones_buscador.php';
			$texto .= '<body bgcolor="#F5F5F5"><form name="formulario_formatos" id="formulario_formatos" method="post" action="' . $action . '" enctype="multipart/form-data"><table width="100%" cellspacing="1" cellpadding="4" border="0"><tr><td colspan="4" class="encabezado_list">B&Uacute;SQUEDA ' . $this->codifica($formato[0]["etiqueta"]) . '</td></tr>';
			$librerias = array();
			if ($formato[0]["librerias"] && $formato[0]["librerias"] != "") {
				$includes .= $this->incluir($formato[0]["librerias"], "librerias", 1);
			}
			$includes .= $this->incluir_libreria("funciones_generales.php", "librerias");
			$includes .= $this->incluir_libreria("estilo_formulario.php", "librerias");
			$includes .= $this->incluir_libreria("funciones_formatos.js", "javascript");
			$includes .= $this->incluir("../../js/jquery.js", "javascript");
			if ($formato[0]["estilos"] && $formato[0]["estilos"] != "") {
				$includes .= $this->incluir($formato[0]["estilos"], "estilos", 1);
			}
			if ($formato[0]["javascript"] && $formato[0]["javascript"] != "") {
				$includes .= $this->incluir($formato[0]["javascript"], "javascript", 1);
			}
			$arboles = 0;
			$dependientes = 0;
			$mascaras = 0;
			$textareas = 0;
			$autocompletar = 0;
			$checkboxes = 0;
			$ejecutores = 0;
			$fecha = 0;
			$archivo = 0;
			$lista_enmascarados = "";
			$listado_campos = array();
			$unico = array();
			$obliga = "";
			$adicionales = "";
			$campos = busca_filtro_tabla("*", "campos_formato A", "A.acciones like '%" . $accion[0] . "%' and A.formato_idformato=" . $idformato, "orden ASC", $conn);
			// funciones creadas para el formato, pero que corresponden a nombres de campos
			// print_r($campos);die();
			$fun_campos = array();
			for($h = 0; $h < $campos["numcampos"]; $h++) {
				$saltar_campo = false;
				if ($campos[$h]["etiqueta_html"] == "arbol")
					$arboles = 1;
				elseif ($campos[$h]["etiqueta_html"] == "textarea")
					$textareas = 1;
				$obliga = "";
				// ******************** validaciones *****************
				$adicionales = "";
				$longitud = busca_filtro_tabla("valor", "caracteristicas_campos", "tipo_caracteristica ='maxlength' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
				if ($longitud["numcampos"]) {
					if ($longitud[0][0] > $campos[$h]["longitud"])
						$adicionales .= "maxlength=\"" . $campos[$h]["longitud"] . "\" ";
					else
						$adicionales .= "maxlength=\"" . $longitud[0][0] . "\" ";
				} elseif ($campos[$h]["longitud"])
					$adicionales .= "maxlength=\"" . $campos[$h]["longitud"] . "\" ";

				$caracteristicas = busca_filtro_tabla("", "caracteristicas_campos", "tipo_caracteristica not in('adicionales','class','maxlength') and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
				for($c = 0; $c < $caracteristicas["numcampos"]; $c++) {
					$adicionales .= $caracteristicas[$c]["tipo_caracteristica"] . "=\"" . $caracteristicas[$c]["valor"] . "\" ";
				}
				$class = busca_filtro_tabla("valor", "caracteristicas_campos", "tipo_caracteristica='class' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
				if ($class["numcampos"])
					$adicionales .= " class=\"" . $class[0][0] . "\" ";
				// atributos adicionales
				$otros = busca_filtro_tabla("", "caracteristicas_campos", "tipo_caracteristica='adicionales' and idcampos_formato=" . $campos[$h]["idcampos_formato"], "", $conn);
				if ($otros["numcampos"])
					$adicionales .= $otros[0]["valor"];
				/* */
				{
					$valor = "";
					switch ($campos[$h]["etiqueta_html"]) {
						case "password" :
							$texto .= '<tr>' . generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . generar_comparacion($campos[$h]["tipo_dato"], $campos[$h]["nombre"]) . '
                     <td bgcolor="#F5F5F5"><input type="password" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . " $adicionales " . ' value="' . $valor . '"></td>
                    </tr>';
							break;
						case "fecha" :
							// si la fecha es obligatoria, que valide que no se vaya con solo ceros
							$adicionales = str_replace("required", "required dateISO", $adicionales);
							if ($campos[$h]["tipo_dato"] == "DATE") {
								$texto .= '<tr>' . generar_condicion($campos[$h]["nombre"]) . '
                       <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><span class="phpmaker"><input type="text" readonly="true" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '_1" id="' . $campos[$h]["nombre"] . '_1" tipo="fecha" value="';

								$texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '_1","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '>&nbsp;&nbsp; Y &nbsp;&nbsp;';
								$texto .= '<input type="text" readonly="true" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '_2" id="' . $campos[$h]["nombre"] . '_2" tipo="fecha" value="';

								$texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '_2","formulario_formatos","Y-m-d",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '></span></font>';
								$fecha++;
							} else if ($campos[$h]["tipo_dato"] == "DATETIME") {
								$texto .= '<tr>' . generar_condicion($campos[$h]["nombre"]) . '
                    <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td><td class="encabezado">ENTRE &nbsp;</td><td colspan="2" bgcolor="#F5F5F5"><input type="text" readonly="true" name="' . $campos[$h]["nombre"] . '_1" ' . $adicionales . ' id="' . $campos[$h]["nombre"] . '_1" value="';

								$texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '_1","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '>&nbsp;&nbsp; Y &nbsp;&nbsp;';
								$texto .= '<input type="text" readonly="true" name="' . $campos[$h]["nombre"] . '_2" ' . $adicionales . ' id="' . $campos[$h]["nombre"] . '_2" value="';

								$texto .= '"><?php selector_fecha("' . $campos[$h]["nombre"] . '_2","formulario_formatos","Y-m-d H:i",date("m"),date("Y"),"default.css","../../","AD:VALOR"); ?' . '>';
								$fecha++;
							} else
								alerta_formatos("No esta definido su formato de Fecha");
							$texto .= '</td></tr>';
							break;
						case "radio":
              /* En los campos de este tipo se debe validar que valor contenga un listado con las siguentes caracteristicas*/
                $texto .= '<tr id="tr_' . $campos[$h]["nombre"] . '">' . generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . generar_comparacion($campos[$h]["tipo_dato"], $campos[$h]["nombre"]);

                $texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $idformato . "," . $campos[$h]["idcampos_formato"], 'buscar') . '</td></tr>';
							break;
						case "checkbox" :
							$texto .= '<tr>' . generar_condicion($campos[$h]["nombre"]) . '
                  <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . generar_comparacion("arbol", $campos[$h]["nombre"]);
							$texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $idformato . "," . $campos[$h]["idcampos_formato"], 'buscar') . '</td></tr>';
							$checkboxes++;
							break;
						case "select" :
							$texto .= '<tr>' . generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . generar_comparacion($campos[$h]["tipo_dato"], $campos[$h]["nombre"]);
							$texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $idformato . "," . $campos[$h]["idcampos_formato"], 'buscar') . '</td></tr>';
							break;
						case "dependientes":
              /*parametros:
              nombre del select padre; sql select padre| nombre del select hijo; sql select hijo....
              (ej: departamento;select iddepartamento as id,nombre from departamento order by nombre| municipio; select idmunicipio as id,nombre from municipio where departamento_iddepartamento=)*/
                $parametros = explode("|", $campos[$h]["valor"]);
							if (count($parametros) < 2)
								alerta_formatos("Por favor verifique los parametros de configuracion de su select dependiente " . $campos[$h]["etiqueta"]);
							else {
								$texto .= '<tr>' . generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . generar_comparacion($campos[$h]["tipo_dato"], $campos[$h]["nombre"]);
								$texto .= '<td bgcolor="#F5F5F5">' . $this->arma_funcion("genera_campo_listados_editar", $idformato . "," . $campos[$h]["idcampos_formato"], 'editar') . '</td></tr>';
								$dependientes++;
							}
							break;
						case "autocompletar":
                /* parametros: campos a mostrar separados por comas; campo a guardar en el hidden; tabla
                  ej: nombres,apellidos;idfuncionario;funcionario

                  Queda pendiente La parte de la busqueda.
                */
                $texto .= '<tr>
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . generar_comparacion($campos[$h]["tipo_dato"], $campos[$h]["nombre"]) . '
                   <td bgcolor="#F5F5F5">';
							$texto .= '<input type="text" size="30" ' . $adicionales . ' value="" id="input' . $campos[$h]["idcampos_formato"] . '" onkeyup="lookup(this.value,' . $campos[$h]["idcampos_formato"] . ');" onblur="fill(this.value,' . $campos[$h]["idcampos_formato"] . ');" />
                <div class="suggestionsBox" id="suggestions' . $campos[$h]["idcampos_formato"] . '" style="display: none;">
				        <div class="suggestionList" id="list' . $campos[$h]["idcampos_formato"] . '" >&nbsp;
        				</div>
        			  </div>
        			  <input ' . $obligatorio . ' type="text" name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '">
                </td></tr>';
							$autocompletar++;
							break;
						case "etiqueta" :
							$texto .= '<tr>
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>
                   <td bgcolor="#F5F5F5"><label>' . $valor . '</label><input type="hidden" name="' . $campos[$h]["nombre"] . '" value="' . $valor . '"></td>
                  </tr>';
							break;
						case "arbol":
                /*En campos valor se deben almacenar los siguientes datos:
                arreglo[0]:ruta de el xml
                arreglo[1]=1=> checkbox;arreglo[1]=2=>radiobutton
                arreglo[2] Modo calcular numero de nodos hijo
                arreglo[3] Forma de carga 0=>autoloading; 1=>smartXML
                arreglo[4] Busqueda
                arreglo[5] Almacenar 0=>iddato 1=>valordato
                arreglo[6] Tipo de arbol 0=>funcionarios 1=>series 2=>dependencias
                */
                $arreglo = explode(";", $campos[$h]["valor"]);
							// print_r($arreglo);
							/*
							 * print_r($campos[$h]);
							 * die("<br />".$campos[$h]["nombre"]."<br />".$campos[$h]["valor"]);
							 */
							if (isset($arreglo) && $arreglo[0] != "") {
								$ruta = "\"" . $arreglo[0] . "\"";
							} else {
								$ruta = "\"../arboles/test_dependencia.xml\"";
								$arreglo[1] = 0;
								$arreglo[2] = 0;
								$arreglo[3] = 0;
								$arreglo[4] = 1;
							}
							$texto .= '<tr>' . generar_condicion($campos[$h]["nombre"]) . '
                   <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . strtoupper($campos[$h]["etiqueta"]) . $obliga . '</td>' . generar_comparacion("arbol", $campos[$h]["nombre"]) . '<td bgcolor="#F5F5F5"><div id="esperando_' . $campos[$h]["nombre"] . '"><img src="../../imagenes/cargando.gif"></div>';
							$texto .= '<div id="seleccionados">' . $this->arma_funcion("mostrar_seleccionados", $idformato . "," . $campos[$h]["idcampos_formato"] . ",'" . $arreglo[6] . "'", "mostrar") . '</div>
                          <br />  ';
							if ($arreglo[4]) {
								$texto .= 'Buscar: <input type="text" id="stext_' . $campos[$h]["nombre"] . '" width="200px" size="25">
                   <a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value),1)"><img src="../../botones/general/anterior.png"border="0px"></a>
                   <a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value),0,1)"><img src="../../botones/general/buscar.png"border="0px"></a>
                          <a href="javascript:void(0)" onclick="tree_' . $campos[$h]["nombre"] . '.findItem((document.getElementById(\'stext_' . $campos[$h]["nombre"] . '\').value))"><img src="../../botones/general/siguiente.png"border="0px"></a>
                          <br /><br />
                ';
							}
							$texto .= '<div id="treeboxbox_' . $campos[$h]["nombre"] . '" height="90%"></div>';
							// miro si ya estan incluidas las librerias del arbol
							$texto .= '<input type="hidden" ' . $adicionales . ' name="' . $campos[$h]["nombre"] . '" id="' . $campos[$h]["nombre"] . '"  ';
							if ($accion == "editar") {
								$texto .= ' value="' . $this->arma_funcion("cargar_seleccionados", $idformato . "," . $campos[$h]["idcampos_formato"] . ",1", "mostrar") . '" >';
							} else
								$texto .= ' value="" ><label style="display:none" class="error" for="' . $campos[$h]["nombre"] . '">Campo obligatorio.</label>';
							$texto .= '<script type="text/javascript">
                  <!--
                      var browserType;
                      if (document.layers) {browserType = "nn4"}
                      if (document.all) {browserType = "ie"}
                      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
                         browserType= "gecko"
                      }
                			tree_' . $campos[$h]["nombre"] . '=new dhtmlXTreeObject("treeboxbox_' . $campos[$h]["nombre"] . '","100%","100%",0);
                			tree_' . $campos[$h]["nombre"] . '.setImagePath("../../imgs/");
                			tree_' . $campos[$h]["nombre"] . '.enableIEImageFix(true);';
							if ($arreglo[1] == 1) {
								$texto .= 'tree_' . $campos[$h]["nombre"] . '.enableCheckBoxes(1);
                			tree_' . $campos[$h]["nombre"] . '.enableThreeStateCheckboxes(1);';
							} else if ($arreglo[1] == 2) {
								$texto .= 'tree_' . $campos[$h]["nombre"] . '.enableCheckBoxes(1);
                    tree_' . $campos[$h]["nombre"] . '.enableRadioButtons(true);';
							}
							$texto .= 'tree_' . $campos[$h]["nombre"] . '.setOnLoadingStart(cargando_' . $campos[$h]["nombre"] . ');
                      tree_' . $campos[$h]["nombre"] . '.setOnLoadingEnd(fin_cargando_' . $campos[$h]["nombre"] . ');';
							if ($arreglo[3]) {
								$texto .= 'tree_' . $campos[$h]["nombre"] . '.enableSmartXMLParsing(true);';
							} else
								$texto .= 'tree_' . $campos[$h]["nombre"] . '.setXMLAutoLoading(' . $ruta . ');';
							if ($accion == "editar") {
								$ruta .= ",checkear_arbol";
							}
							$texto .= 'tree_' . $campos[$h]["nombre"] . '.loadXML(' . $ruta . ');
                      tree_' . $campos[$h]["nombre"] . '.setOnCheckHandler(onNodeSelect_' . $campos[$h]["nombre"] . ');
                      function onNodeSelect_' . $campos[$h]["nombre"] . '(nodeId)
                      {valor_destino=document.getElementById("' . $campos[$h]["nombre"] . '");
                       destinos=tree_' . $campos[$h]["nombre"] . '.getAllChecked();
                       nuevo=destinos.replace(/\,{2,}(d)*/gi,",");
                       nuevo=nuevo.replace(/\,$/gi,"");
                       vector=destinos.split(",");
                       for(i=0;i<vector.length;i++)
                          {if(vector[i].indexOf("#")!=-1)
                              {hijos=tree_' . $campos[$h]["nombre"] . '.getAllSubItems(vector[i]);
                               hijos=hijos.replace(/\,{2,}(d)*/gi,",");
                               hijos=hijos.replace(/\,$/gi,"");
                               vectorh=hijos.split(",");
                               for(h=0;h<vectorh.length;h++)
                                  nuevo=eliminarItem(nuevo,vectorh[h]);
                              }
                          }
                       valor_destino.value=nuevo;
                      }';
							$texto .= "
                      function fin_cargando_" . $campos[$h]["nombre"] . "() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else
                           document.poppedLayer =
                              eval('document.layers[\"esperando_" . $campos[$h]["nombre"] . "\"]');
                        document.poppedLayer.style.visibility = \"hidden\";
                      }
                      function cargando_" . $campos[$h]["nombre"] . "() {
                        if (browserType == \"gecko\" )
                           document.poppedLayer =
                               eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else if (browserType == \"ie\")
                           document.poppedLayer =
                              eval('document.getElementById(\"esperando_" . $campos[$h]["nombre"] . "\")');
                        else
                           document.poppedLayer =
                               eval('document.layers[\"esperando_" . $campos[$h]["nombre"] . "\"]');
                        document.poppedLayer.style.visibility = \"visible\";
                      }
                	";
							if ($accion == "editar") {
								$texto .= "
                  function checkear_arbol(){
                  vector2=\"" . $this->arma_funcion("cargar_seleccionados", $idformato . "," . $campos[$h]["idcampos_formato"] . ",1", "mostrar") . "\";
                  vector2=vector2.split(\",\");
                  for(m=0;m<vector2.length;m++)
                    {tree_" . $campos[$h]["nombre"] . ".setCheck(vector2[m],true);
                    }}\n";
							}
							$texto .= "--></script>";
							$texto .= '</td></tr>';
							$arboles++;
							break;
						case "detalle" :
							$padre = busca_filtro_tabla("nombre_tabla", "formato A", "idformato=" . $campos[$h]["valor"], "", $conn);
							if ($padre["numcampos"]) {
								$texto .= '<?php if($_REQUEST["padre"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["padre"]; ?' . '>">' . '<?php } ?' . '>';
								$texto .= '<?php if($_REQUEST["anterior"]) {?' . '><input type="hidden"  name="' . $padre[0]["nombre_tabla"] . '" ' . $obligatorio . ' value="<?php echo $_REQUEST["anterior"]; ?' . '>">' . '<?php }  else {listar_select_padres(' . $padre[0]["nombre_tabla"] . ');} ?' . '>';
							}
							break;
						case "ejecutor" :
							$texto .= '<tr>' . generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . generar_comparacion("arbol", $campos[$h]["nombre"]) . '
                     <td bgcolor="#F5F5F5"><select multiple ' . " $adicionales " . ' id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '" ' . $obligatorio . ' ></select></td>
                    </tr>
                    <script>
                     $(document).ready(function()
                      {
                      $("#' . $campos[$h]["nombre"] . '").fcbkcomplete({
                        complete_text:"Nombre o identificacion",
                        newel: true
                      });
                      });
                     </script>';
							$ejecutores++;
							break;
						default : // text
							$texto .= '<tr>' . generar_condicion($campos[$h]["nombre"]) . '
                     <td class="encabezado" width="20%" title="' . $campos[$h]["ayuda"] . '">' . $this->codifica($campos[$h]["etiqueta"]) . $obliga . '</td>' . generar_comparacion("arbol", $campos[$h]["nombre"]) . '
                     <td bgcolor="#F5F5F5"><select multiple id="' . $campos[$h]["nombre"] . '" name="' . $campos[$h]["nombre"] . '"></select><script>
                     $(document).ready(function()
                      {
                      $("#' . $campos[$h]["nombre"] . '").fcbkcomplete({
                        complete_text:"Presione enter para agregar una palabra.",
                        newel: true
                      });
                      });
                     </script></td>
                    </tr>';
							$ejecutores++;
							break;
					}
				}
				array_push($listado_campos, "'" . $campos[$h]["nombre"] . "'");
			}
			// die();
			// ******************************************************************************************
			$wheref = "(A.formato LIKE '" . $idformato . "' OR A.formato LIKE '%," . $idformato . ",%' OR A.formato LIKE '%," . $idformato . "' OR A.formato LIKE '" . $idformato . ",%') AND A.acciones LIKE '%" . strtolower($accion[0]) . "%' ";
			/*
			 * if(count($listado_campos)){
			 * $wheref.="AND nombre_funcion NOT IN(".implode(",",$listado_campos).")";
			 * }
			 */
			$funciones = busca_filtro_tabla("*", "funciones_formato A", $wheref, " idfunciones_formato asc", $conn);
			// print_r($funciones);
			// die();
			for($i = 0; $i < $funciones["numcampos"]; $i++) {
				$ruta_orig = "";
				// saco el primer formato de la lista de la funcion (formato inicial)
				$formato_orig = explode(",", $funciones[$i]["formato"]);
				// si el formato actual es distinto del formato inicial
				if ($formato_orig[0] != $idformato) { // busco el nombre del formato inicial
					$dato_formato_orig = busca_filtro_tabla("nombre", "formato", "idformato=" . $formato_orig[0], "", $conn);
					if ($dato_formato_orig["numcampos"]) {
						// si el archivo existe dentro de la carpeta del archivo inicial
						if (is_file($dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
							$includes .= $this->incluir("../" . $dato_formato_orig[0]["nombre"] . "/" . $funciones[$i]["ruta"], "librerias");
						} elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
							$includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
						} else { // si no existe en ninguna de las dos
							// trato de crearlo dentro de la carpeta del formato actual
							if (crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
								$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
							} else
								alerta_formatos("2412 No es posible generar el archivo " . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
						}
					}
				} else { // $ruta_orig=$formato[0]["nombre"];
					// si el archivo existe dentro de la carpeta del formato actual
					if (is_file($formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
						$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
					} elseif (is_file($funciones[$i]["ruta"])) { // si el archivo existe en la ruta especificada partiendo de la raiz
						$includes .= $this->incluir("../" . $funciones[$i]["ruta"], "librerias");
					} else { // si no existe en ninguna de las dos
						// trato de crearlo dentro de la carpeta del formato actual
						if (crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"])) {
							$includes .= $this->incluir($funciones[$i]["ruta"], "librerias");
						} else
							alerta_formatos("2426 No es posible generar el archivo " . $formato[0]["nombre"] . "/" . $funciones[$i]["ruta"]);
					}
				}
				if (!in_array($funciones[$i]["nombre_funcion"], $fun_campos)) {
					$parametros = "$idformato,NULL";
					$texto .= $this->arma_funcion($funciones[$i]["nombre_funcion"], $parametros, $accion);
				}
			}
			// ******************************************************************************************
			$campo_descripcion = busca_filtro_tabla("", "campos_formato", "formato_idformato=" . $idformato . " AND acciones LIKE '%p%'", "", $conn);
			$valor1 = extrae_campo($campo_descripcion, "idcampos_formato", "U");
			$valor = implode(",", $valor1);
			if ($campo_descripcion["numcampos"]) {
				if ($accion == 'adicionar')
					;
				elseif ($accion == "editar") {
					if ($formato[0]["detalle"]) {
						$valor = "<?php echo('" . $valor . "'); ? >";
					} else {
						$valor = "<?php echo('" . $valor . "'); ? >";
					}
				}
				$texto .= '<input type="hidden" name="campo_descripcion" value="' . $valor . '">';
			} else
				alerta_formatos("Recuerde asignar el campo que sera almacenado como descripcion del documento");
			if ($accion == "editar")
				$texto .= '<input type="hidden" name="formato" value="' . $idformato . '">';
			if ($formato[0]["detalle"]) {
				$texto .= '<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?' . '>">';
				$texto .= '<input type="hidden" name="anterior" value="<?php echo $_REQUEST["anterior"]; ?' . '>">';
				if ($accion == "adicionar") {
					$texto .= '<input type="hidden" name="accion" value="guardar_detalle" >';
				} elseif ($accion == "editar") {
					$texto .= '<input type="hidden" name="accion" value="editar" >';
					$texto .= '<input type="hidden" name="item" value="<?php echo $_' . 'REQUEST["item"]; ?' . '>" >';
					$texto .= '<input type="hidden" name="anterior" value="<?php echo $_' . 'REQUEST["campo"]; ?' . '>" >';
				}
			}
			if ($formato[0]["item"]) {
				$texto .= '<input type="hidden" name="padre" value="<?php echo $_REQUEST["padre"]; ?' . '>"><input type="hidden" name="formato" value="' . $formato[0]["nombre"] . '">';
				if ($accion == "adicionar") {
					$texto .= '<input type="hidden" name="accion" value="guardar_item" >';
				} elseif ($accion == "editar") {
					$texto .= '<input type="hidden" name="accion" value="editar" >';
					$texto .= '<input type="hidden" name="item" value="<?php echo $_' . 'REQUEST["item"]; ?' . '>" >';
					$texto .= '<input type="hidden" name="anterior" value="<?php echo $_' . 'REQUEST["campo"]; ?' . '>" >';
				}
			}
			$texto .= $this->arma_funcion("submit_formato", $idformato, "adicionar");
			$texto .= '</table>';
			if ($archivo)
				$texto .= "<input type='hidden' name='permisos_anexos' id='permisos_anexos' value=''>";
			/* Se debe tener especial cuidado con los campos con doble guion bajo ya que se muestra asi para evitar que un funcionario pueda seleccionar un campo con el mismo nombre */
			$texto .= '<?php if(@$_REQUEST["campo__retorno"]){ ?' . '>
                <input type="hidden" name="campo__retorno" value="<?php echo($_REQUEST["campo__retorno"]); ?' . '>">
              <?php }
               if(@$_REQUEST["formulario__retorno"]){ ?' . '>
                <input type="hidden" name="formulario__retorno" value="<?php echo($_REQUEST["formulario__retorno"]); ?' . '>">
              <?php }
                if(@$_REQUEST["pagina__retorno"]){ ?' . '>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_REQUEST["pagina__retorno"]); ?' . '>">
             <?php  }
              else{ ?' . '>
                <input type="hidden" name="pagina__retorno" value="<?php echo($_SERVER["PHP_SELF"]); ?' . '>">
             <?php  } ?' . '>';
			$texto .= '</form></body>';
			if ($fecha) {
				$includes .= $this->incluir("../../calendario/calendario.php", "librerias");
			}
			if ($textareas) {
				$includes .= $this->incluir_libreria("header_formato.php", "librerias");
			}
			$includes .= $this->incluir("../../js/jquery.js", "javascript");
			$includes .= $this->incluir("../../js/jquery.validate.js", "javascript");

			$includes .= $this->incluir("../../js/title2note.js", "javascript");
			if ($arboles) {
				$includes .= $this->incluir("../../js/dhtmlXCommon.js", "javascript");
				$includes .= $this->incluir("../../js/dhtmlXTree.js", "javascript");
				$includes .= $this->incluir("../../css/dhtmlXTree.css", "estilos");
			}
			if ($ejecutores) {
				$includes .= $this->incluir("../../js/jquery.fcbkcomplete.js", "javascript");
				$includes .= $this->incluir("../../css/style_fcbkcomplete.css", "estilos");
			}
			if ($autocompletar) {
				$includes .= $this->incluir("../../js/jquery.js", "javascript");
				$includes .= $this->incluir("../librerias/autocompletar.js", "javascript");
			}
			if ($dependientes > 0) {
				$includes .= $this->incluir("../../js/jquery.js", "javascript");
				$includes .= $this->incluir("../librerias/dependientes.js", "javascript");
			}
			$contenido = "<html><title>.:" . strtoupper($accion . " " . $formato[0]["etiqueta"]) . ":.</title><head>" . $includes . $enmascarar . "</head>" . $texto . "</html>";
			if ($accion == "editar")
				$contenido .= '<?php include_once("../librerias/footer_plantilla.php");?' . '>';
			$mostrar = crear_archivo(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/buscar_" . $formato[0]["nombre"] . ".php", $contenido);
			// die();
			if ($mostrar != "")
				alerta_formatos("Formato Creado con exito por favor verificar la carpeta " . dirname($mostrar));
		} else {
			alerta_formatos("2527 No es posible generar el Formato");
		}
	}

	/*
	 * <Clase>
	 * <Nombre>generar_condicion</Nombre>
	 * <Parametros>$nombre:nombre del campo</Parametros>
	 * <Responsabilidades>Crea un select para que se pueda elegir si la condici�n sobre el campo especificado es de obligatorio cumplimiento en la busqueda o no<Responsabilidades>
	 * <Notas>usado para la pantalla de busqueda del formato</Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	function generar_condicion($nombre) {
		$texto = '<td class="encabezado">&nbsp;';
		$texto .= '<select name="condicion_' . $nombre . '" id="condicion_' . $nombre . '">';
		$texto .= '<option value="AND">Y</option>';
		$texto .= '<option value="OR">O</option>';
		$texto .= "</td>";
		return ($texto);
	}

	/*
	 * <Clase>
	 * <Nombre>generar_comparacion</Nombre>
	 * <Parametros>$tipo:tipo de campo sobre el que se va a hacer la comparacion;$nombre:nombre del campo</Parametros>
	 * <Responsabilidades>genera un listado con las opciones de comparaci�n posibles seg�n el tipo de campo<Responsabilidades>
	 * <Notas>usado para la pantalla de busqueda del formato</Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	function generar_comparacion($tipo, $nombre) {
		$listado_like = array(
				"Similar" => "LIKE|%|%",
				"Inicia Con" => "LIKE|%|@",
				"Finaliza Con" => "LIKE|@|%"
		);
		$listado_compara = array(
				"Igual" => "=|@|@",
				"Menor" => "-|@|@",
				"Mayor" => "+|@|@",
				"Diferente" => "!|@|@"
		);
		$listado_arbol = array(
				"Alguno" => "or",
				"Todos" => "and"
		);
		echo $tipo . " " . $nombre . "<br />";
		$texto = '<td class="encabezado">&nbsp;';
		$listado = array();
		switch ($tipo) {
			case "INT" :
				$listado = $listado_compara;
				break;
			case "arbol" :
				$listado = $listado_arbol;
				break;
			default :
				$listado = $listado_like;
				break;
		}
		if (count($listado)) {
			$texto .= '<select name="compara_' . $nombre . '" id="compara_' . $nombre . '"> ';
			foreach ( $listado as $llave => $valor ) {

				$texto .= '<option value="' . $valor . '">' . $llave . '</option>';
			}
			$texto .= '</select>';
		}
		$texto .= '</td>';
		return ($texto);
	}

	/*
	 * <Clase>
	 * <Nombre></Nombre>
	 * <Parametros>cad:cadena con las rutas relativas de los archivos a incluir separadas por comas;
	 * tipo:Tipo de libreria a incluir librerias->php, javascript->js,estilos->css;
	 * eval:Si debe crear el archivo o no</Parametros>
	 * <Responsabilidades>Genera la cadena que se necesita incluir los archivos especificados<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida>Cadena de texto</Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	private function incluir($cad, $tipo, $eval = 0) {
		$includes = "";
		$lib = explode(",", $cad);
		switch ($tipo) {
			case "librerias" :
				$texto1 = '<?php include_once("';
				$texto2 = '"); ? >';
				break;
			case "javascript" :
				$texto1 = '<script type="text/javascript" src="';
				$texto2 = '"></script>';
				break;
			case "estilos" :
				$texto1 = '<link rel="stylesheet" type="text/css" href="';
				$texto2 = '"/>';
				break;
			default :
				return (""); // retorna un vacio si no existe el tipo
				break;
		}
		// file_put_contents("debug.txt", "\nLibreria: $cad :: $tipo", FILE_APPEND);

		for($j = 0; $j < count($lib); $j++) {
			$pos = array_search($texto1 . $lib[$j] . $texto2, $this->incluidos);
			if ($pos === false) {
				if (!is_file($lib[$j]) & $eval) {
					if (crear_archivo($lib[$j])) {
						$includes .= $texto1 . $lib[$j] . $texto2;
					} else {
						alerta_formatos("2650 Problemas al generar el Formato en " . $lib[$j]);
						return ("");
					}
				} else {
					$includes .= $texto1 . $lib[$j] . $texto2;
				}
				array_push($this->incluidos, $texto1 . $lib[$j] . $texto2);
			}
		}
		/*print_r($cad); echo "<br>";
		print_r($tipo); echo "<br>";
		print_r($includes);die("<---");*/
		return ($includes);
	}

	/*
	 * <Clase>
	 * <Nombre>incluir_libreria</Nombre>
	 * <Parametros>$nombre:nombre del archivo;$tipo:tipo de archivo php, js, css</Parametros>
	 * <Responsabilidades>Crea la cadena necesaria para incluir un archivo que se encuentre en la carpeta formatos/librerias<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	private function incluir_libreria($nombre, $tipo) {
		$includes = "";
		if (!is_file(FORMATOS_SAIA . "librerias/" . $nombre)) {
			if (!crear_archivo(FORMATOS_SAIA . "librerias/" . $nombre)) {
				alerta_formatos("2677 No es posible generar el archivo " . $nombre);
			}
		}
		$includes .= $this->incluir("../../" . FORMATOS_SAIA . "librerias/" . $nombre, $tipo);
		return ($includes);
	}

	/*
	 * <Clase>
	 * <Nombre>arma_funcion</Nombre>
	 * <Parametros>$nombre:nombre de la funci�n;$parametros:parametros que se le deben pasar;$accion:formato al cual corresponde (adicionar,editar,buscar)</Parametros>
	 * <Responsabilidades>Crea la cadena de texto necesaria para hacer el llamado a la funci�n especificada<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	private function arma_funcion($nombre, $parametros, $accion) {
		if ($parametros != "" && $accion != "adicionar" && $accion != 'buscar')
			$parametros .= ",";
		if ($accion == "mostrar")
			$texto = "<?php " . $nombre . "(" . $parametros . "$" . "_REQUEST['iddoc']);? >";
		elseif ($accion == "adicionar")
			$texto = "<?php " . $nombre . "(" . $parametros . ");? >";
		elseif ($accion == "editar")
			$texto = "<?php " . $nombre . "(" . $parametros . "$" . "_REQUEST['iddoc']);? >";
		elseif ($accion == "buscar")
			$texto = "<?php " . $nombre . "(" . $parametros . ",'',1);? >";

		return ($texto);
	}

	/*
	 * <Clase>
	 * <Nombre>generar_formato</Nombre>
	 * <Parametros>$idformato:id del formato</Parametros>
	 * <Responsabilidades>Verifica que las funciones y campos usados en el formato se encuentren todos previamente definidos y configurados<Responsabilidades>
	 * <Notas></Notas>
	 * <Excepciones></Excepciones>
	 * <Salida></Salida>
	 * <Pre-condiciones><Pre-condiciones>
	 * <Post-condiciones><Post-condiciones>
	 * </Clase>
	 */
	private function generar_formato() {
		global $sql, $conn, $ruta_db_superior;
		$formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $this->idformato, "", $conn);
		$encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $formato[0]["encabezado"] . "'", "", $conn);

		$data = "adicionar_" . $formato[0]['nombre'] . ".php
editar_" . $formato[0]['nombre'] . ".php
buscar_" . $formato[0]['nombre'] . ".php
buscar_" . $formato[0]['nombre'] . "2.php
mostrar_" . $formato[0]['nombre'] . ".php
detalles_mostrar_" . $formato[0]['nombre'] . ".php";
		if (intval($formato[0]["pertenece_nucleo"]) == 0) {
			// Ignorar todo el contenido de la carpeta
			$data = "*";
		}
		// file_put_contents($ruta_db_superior . FORMATOS_CLIENTE . $formato[0]["nombre"] . "/.gitignore", $data);
		$fp = fopen(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/.gitignore", 'w+');
		fwrite($fp, $data);
		fclose($fp);
		chmod(FORMATOS_CLIENTE . $formato[0]["nombre"] . "/.gitignore", PERMISOS_ARCHIVOS);
		$pie = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato='" . $formato[0]["pie_pagina"] . "'", "", $conn);
		$lcampos = "";
		$regs = array();
		$regs1 = array();

		if ($formato["numcampos"]) {
			$texto = $formato[0]["cuerpo"];
			if ($encabezado["numcampos"])
				$texto .= $encabezado[0][0];
			if ($pie["numcampos"])
				$texto .= $pie[0][0];
			$texto = str_replace("listado_detalles_", "id", $texto);
			$resultado = preg_match_all('({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*)+\*})', $texto, $regs);
			$campos = array_unique($regs[0]);
			sort($campos);
			$campos_editar = array();
			$campos_edit = array();
			$campos_adicionar = array();
			$campos_otrosf = array();

			if ($campos) {
				/* Busco el listado de las funciones para compararlas con los campos que se van a ingresar */
				$listado = busca_filtro_tabla("*", "campos_formato A", "A.formato_idformato=" . $this->idformato, "", $conn);
				for($i = 0; $i < $listado["numcampos"]; $i++) {
					array_push($campos_edit, "{*" . $listado[$i]["nombre"] . "*}");
				}
				$funciones = array_diff($campos, $campos_edit);
				sort($funciones);

				$lcampos = busca_filtro_tabla("*", "funciones_formato A", "A.nombre IN('" . implode("','", $funciones) . "')", "", $conn);

				for($i = 0; $i < $lcampos["numcampos"]; $i++) {

					array_push($campos_editar, $lcampos[$i]["idfunciones_formato"]);
					$formatos = explode(",", $lcampos[$i]["formato"]);
					$eval = in_array($this->idformato, $formatos);

					if ($eval === false) {
						array_push($campos_otrosf, $lcampos[$i]["idfunciones_formato"]);
						$formatos_func = busca_filtro_tabla("formato", "funciones_formato", "idfunciones_formato=" . $lcampos[$i]["idfunciones_formato"], "", $conn);
						$vector_f = explode(",", $formatos_func[0][0]);
						if (!in_array($this->idformato, $vector_f)) {
							$vector_f[] = $this->idformato;
							$sqlf = "UPDATE funciones_formato SET formato='" . implode(",", $vector_f) . "' WHERE idfunciones_formato=" . $lcampos[$i]["idfunciones_formato"];
							guardar_traza($sqlf, $formato[0]["nombre_tabla"]);
							phpmkr_query($sqlf);
						}
					}
					array_push($campos_edit, $lcampos[$i]["nombre"]);
				}
				$campos_adicionar = array_diff($campos, $campos_edit);
				sort($campos_adicionar);
			} else
				alerta_formatos("El formato mostrar no posee Parametros si esta seguro continue con el Proceso de lo contrario haga Click en Listar Formato y Luego Editelo");
		}
		$tadd = "";
		$ted = "";
		$tod = "";
		$tadd .= implode(",", $campos_adicionar);
		$ted .= implode(",", $campos_editar);
		$tod .= implode(",", $campos_otrosf);
		if ($campos_otrosf != "") {
			alerta_formatos("Existen otros Formatos Vinculados");
		}
		$adicionales = "";
		if (@$_REQUEST["pantalla"] == "tiny")
			$adicionales = "&pantalla=tiny";
		$redireccion = "formatoview.php?idformato=" . $this->idformato . $adicionales;
		if (usuario_actual('login') == 'cerok') {
			$redireccion = "funciones_formatoadd.php?adicionar=" . $tadd . "&editar=" . $ted . "&idformato=" . $this->idformato . $adicionales;
		}
		return $redireccion;
	}
}
?>
