<?php
set_time_limit(0);
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
if (!$_SESSION["LOGIN" . LLAVE_SAIA] && isset($_REQUEST["LOGIN"]) && @$_REQUEST["conexion_remota"]) {
	logear_funcionario_webservice($_REQUEST["LOGIN"]);
}
include_once ($ruta_db_superior . 'formatos/librerias/encabezado_pie_pagina.php');
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
require_once ($ruta_db_superior . 'tcpdf/tcpdf.php');

class Imprime_Pdf {
	private $orientacion = 'P';
	// P-vertical ,L-horizontal
	private $margenes = array("superior" => "10", "inferior" => "10", "izquierda" => "10", "derecha" => "10");
	private $font_size = "12";
	// tama�o de la letra
	private $font_family = "verdana";
	// tipo de letra
	private $tipo_salida = "I";
	// I para mostrar en pantalla, FI para guardar en el servidor y mostrar en pantalla
	private $mostrar_encabezado = 0;
	// define si se muestra o no el encabezado y el pie de pagina
	private $documento = "";
	// datos del documento actual
	private $formato = "";
	// datos del formato actual
	private $idpaginas = "";
	// id de las paginas elegidas en el menu intermedio para imprimir
	private $idhijos = "";
	// id de los documentos hijos del actual seleccionados en el menu intermedio para imprimir
	private $imprimir_plantilla = 0;
	// identifica si el documento actual es un formato y se va a imprimir
	private $imprimir_paginas = 0;
	// define si se desean imprimir las paginas del documento
	private $vincular_anexos = 0;
	// define si se desean adjuntar los anexos del documento al pdf
	private $pdf = "";
	// variable que va a contener la instancia de la clase MYPDF
	private $versionamiento = 0;
	// variable que indica si se est� creando una nueva version
	private $version = 0;
	// variable que indica si se est� creando una nueva version en que numero va
	private $papel = "LETTER";
	// tipo de papel a usar para la impresion LETTER.LEGAL,A4
	private $imprimir_vistas = 0;
	// variable que indica si vienen seleccionadas vistas para imprimir
	private $idvistas = "";
	private $extra_xmp = "";
	// id de las vistas seleccionadas para impresion
	private $info_ft = array();
	// todos los datos de la ft
	private $pmargen = 2;

	function __construct($iddocumento) {
		global $conn;
		if ($iddocumento != "url") {
			$this -> documento = busca_filtro_tabla("documento.*," . fecha_db_obtener("fecha", "Y-m-d") . " as fecha", "documento", "iddocumento=" . $iddocumento, "", $conn);
			if (!$this -> documento["numcampos"]) {
				die("documento no encontrado.");
			}
			$formato = busca_filtro_tabla("", "formato", "lower(nombre) like '" . strtolower($this -> documento[0]["plantilla"]) . "'", "", $conn);
			$this -> formato = $formato;

			if ($formato["numcampos"]) {
				if ($this -> documento[0]["pdf"] != "" && !isset($_REQUEST["seleccion"])) {
					if (is_file($this -> documento[0]["pdf"])) {
						$this -> tipo_salida = "I";
					} else {// la ruta del pdf esta guardada pero el archivo fisico no fue encontrado
						$this -> tipo_salida = "FI";
					}
				}
				if ($formato[0]["mostrar_pdf"] == 1 || ($this -> documento[0]["pdf"] == "" && $this -> documento[0]["estado"] != "ACTIVO")) {
					$this -> tipo_salida = "FI";
				}

				$plantilla = busca_filtro_tabla("", $formato[0]["nombre_tabla"], "documento_iddocumento=" . $iddocumento, "", $conn);
				$this -> mostrar_encabezado = $plantilla[0]["encabezado"];
				$this -> info_ft = $plantilla;
				$this -> imprimir_plantilla = 1;

				if ($formato[0]["orientacion"]) {
					$this -> orientacion = "L";
				} else {
					$this -> orientacion = "P";
				}
				$vmargen = explode(",", $formato[0]["margenes"]);
				$this -> margenes = array("izquierda" => ($vmargen[0] * $this -> pmargen), "derecha" => ($vmargen[1] * $this -> pmargen), "superior" => ($vmargen[2] * $this -> pmargen), "inferior" => ($vmargen[3] * $this -> pmargen));

				$tipo_fuente = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_letra_pdf'", "", $conn);
				if ($tipo_fuente["numcampos"]) {
					$this -> font_family = $tipo_fuente[0][0];
				}
				$this -> font_size = $formato[0]["font_size"];
				$this -> papel = $formato[0]["papel"];

			}
		} elseif ($iddocumento == "url") {
			$this -> tipo_salida = "FI";
			$this -> imprimir_plantilla = 1;
			$this -> documento[0]["iddocumento"] = "url";
			if ($_REQUEST["encabezado_papa"]) {
				$this -> font_size = 8;
			}
		}
	}

	public function configurar_pagina($datos) {
		if (isset($datos["imprimir_paginas"]) && $datos["imprimir_paginas"]) {
			$this -> imprimir_paginas = $datos["imprimir_paginas"];
		}

		if (isset($datos["vincular_anexos"]) && $datos["vincular_anexos"]) {
			$this -> vincular_anexos = $datos["vincular_anexos"];
		}

		if (isset($datos["tipo_salida"]) && $datos["tipo_salida"]) {
			$this -> tipo_salida = $datos["tipo_salida"];
		}
		if (isset($datos["seleccion"])) {
			$this -> configurar_seleccion_impresion($datos["seleccion"]);
		}
		if (isset($datos["versionamiento"])) {
			$this -> versionamiento = 1;
			$this -> version = $datos["version"];
		}

		if (isset($datos["vista"])) {
			$this -> imprimir_plantilla = 0;
			$this -> imprimir_vistas = 1;
			$this -> idvistas = $datos["vista"] . "-" . $datos["iddoc"];
			$vista = busca_filtro_tabla("", "vista_formato", "idvista_formato=" . $datos["vista"], "", $conn);
			$this -> formato[0]["encabezado"] = $vista[0]["encabezado"];
			$this -> formato[0]["pie_pagina"] = $vista[0]["pie_pagina"];
			$vmargen = explode(",", $vista[0]["margenes"]);
			$this -> margenes = array("izquierda" => $vmargen[0], "derecha" => $vmargen[1], "superior" => $vmargen[2], "inferior" => $vmargen[3]);
			$this -> papel = $vista[0]["papel"];
			$this -> orientacion = $vista[0]["orientacion"];
		}

		if (isset($datos["renombrar_pdf"]) && $datos["renombrar_pdf"]) {
			$this -> tipo_salida = "FI";
			$this -> renombrar_pdf_actual();
		}

		if (isset($datos["papel"]) && $datos["papel"]) {
			$this -> papel = $datos["papel"];
		}

		if (isset($datos["font_family"]) && $datos["font_family"]) {
			$this -> font_family = $datos["font_family"];
		}

		if (isset($datos["orientacion"])) {
			if ($datos["orientacion"]) {
				$this -> orientacion = "L";
			} else {
				$this -> orientacion = "P";
			}
		}
		if (isset($datos["font_size"]) && $datos["font_size"]) {
			$this -> font_size = $datos["font_size"];
		}

		if (isset($datos["margen_superior"]) && $datos["margen_superior"]) {
			$this -> margenes["superior"] = ($datos["margen_superior"] * $this -> pmargen);
		}

		if (isset($datos["margen_inferior"]) && $datos["margen_inferior"]) {
			$this -> margenes["inferior"] = ($datos["margen_inferior"] * $this -> pmargen);
		}

		if (isset($datos["margen_derecha"]) && $datos["margen_derecha"]) {
			$this -> margenes["derecha"] = ($datos["margen_derecha"] * $this -> pmargen);
		}

		if (isset($datos["margen_izquierda"]) && $datos["margen_izquierda"]) {
			$this -> margenes["izquierda"] = ($datos["margen_izquierda"] * $this -> pmargen);
		}
	}

	function configurar_seleccion_impresion($seleccionados) {
		$vector = explode(",", $seleccionados);
		$paginas = array();
		$vistas = array();
		$documentos = array();

		foreach ($vector as $fila) {
			if ($fila != "") {
				$campos = explode("-", $fila);
				if ($campos[0] == "p") {
					if ($campos[1] > 0) {
						$paginas[] = $campos[1];
					}
				} elseif ($campos[0] == "vista") {
					$formato = busca_filtro_tabla("nombre_tabla", "formato,vista_formato", "idformato=formato_padre and idvista_formato=" . $campos[1], "", $conn);
					$iddoc = busca_filtro_tabla("documento_iddocumento", $formato[0]["nombre_tabla"], "id" . $formato[0]["nombre_tabla"] . "=" . $campos[2], "", $conn);
					if ($iddoc["numcampos"]) {
						$vistas[] = $campos[1] . "-" . $iddoc[0][0];
					}
				} else {
					$formato = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $campos[0], "", $conn);
					$iddoc = busca_filtro_tabla("documento_iddocumento", $formato[0]["nombre_tabla"], "id" . $formato[0]["nombre_tabla"] . "=" . $campos[2], "", $conn);
					if ($iddoc["numcampos"] && $iddoc[0][0] != $this -> documento[0]["iddocumento"]) {
						$documentos[] = $iddoc[0][0];
					}
				}
			}
		}

		$this -> idvistas = implode(",", $vistas);
		if ($this -> idvistas != "") {
			$this -> imprimir_vistas = 1;
		}
		$this -> idpaginas = implode(",", $paginas);
		if ($this -> idpaginas != "") {
			$this -> imprimir_paginas = 1;
		}
		$this -> idhijos = implode(",", $documentos);
	}

	public function imprimir() {
		$this -> pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false, true);

		$this -> pdf -> margenes = $this -> margenes;
		$this -> pdf -> documento = $this -> documento;
		$this -> pdf -> papel = $this -> papel;
		$this -> pdf -> orientacion = $this -> orientacion;

		$this -> pdf -> SetMargins($this -> margenes["izquierda"], $this -> margenes["superior"], $this -> margenes["derecha"], 1);
		$this -> pdf -> SetFont($this -> font_family, '', $this -> font_size);
		$this -> pdf -> setImageScale(PDF_IMAGE_SCALE_RATIO);
		$this -> pdf -> SetAutoPageBreak(TRUE, $this -> margenes["inferior"]);

		$this -> pdf -> SetCreator('SAIA');
		$this -> pdf -> SetTitle($this -> documento[0]["plantilla"] . "_" . $this -> documento[0]["numero"] . "_" . $this -> documento[0]["fecha"]);
		$autor = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . $this -> documento[0]["ejecutor"], "", $conn);
		if ($autor["numcampos"]) {
			$this -> pdf -> SetAuthor($autor[0]["nombres"] . " " . $autor[0]["apellidos"]);

		}
		$etiquetas = busca_filtro_tabla("A.nombre", "etiqueta A,documento_etiqueta B", "A.idetiqueta=B.etiqueta_idetiqueta AND B.documento_iddocumento=" . $this -> documento[0]["iddocumento"], "", $conn);
		$letiquetas = extrae_campo($etiquetas, "nombre");
		$cad_etiquetas = '';
		if ($this -> pdf -> getPDFa_mode() !== false) {
			$cad_etiquetas .= ',PDF/a-1b';
		}
		if (count($letiquetas)) {
			$cad_etiquetas .= ',' . implode(",", $letiquetas);
		}
		$this -> pdf -> SetKeywords("SAIA" . $cad_etiquetas);
		$this -> pdf -> SetSubject(codifica_encabezado(html_entity_decode($this -> documento[0]["descripcion"])));

		$campos_pdfa = busca_filtro_tabla("", "campos_formato", "(banderas like 'pdfa' or banderas like 'pdfa,%' or banderas like '%,pdfa' or banderas like '%,pdfa,%') AND formato_idformato=" . $this -> formato[0]['idformato'], "", $conn);
		if ($campos_pdfa['numcampos']) {
			for ($i = 0; $i < $campos_pdfa['numcampos']; $i++) {
				$this -> pdf -> SetExtraMetadata($campos_pdfa[$i]['nombre'] . '(' . mostrar_valor_campo($campos_pdfa[$i]['nombre'], $this -> formato[0]['idformato'], $this -> documento[0]["iddocumento"], 1) . ')');
			}
		}
		if ($this -> mostrar_encabezado) {
			$this -> configurar_encabezado();
		} else {
			$this -> pdf -> setPrintHeader(false);
			$this -> pdf -> setPrintFooter(false);
		}

		$nombre_pdf = "";
		if ($this -> imprimir_paginas) {
			$this -> imprimir_paginas();
		}
		if ($this -> imprimir_plantilla) {
			$this -> extraer_contenido($this -> documento[0]["iddocumento"]);
		}

		if ($this -> vincular_anexos) {
			$this -> vincular_anexos();
		}

		if ($this -> imprimir_vistas) {
			$vector = explode(",", $this -> idvistas);
			foreach ($vector as $fila) {
				$aux = explode("-", $fila);
				$this -> extraer_contenido($aux[1], $aux[0]);
			}
		}

		if ($this -> idhijos != "") {
			$this -> imprimir_hijos();
		}

		$fecha = explode("-", $this -> documento[0]["fecha"]);

		include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
		if (!$_REQUEST['url']) {
			$formato_ruta = aplicar_plantilla_ruta_documento($this -> documento[0]["iddocumento"]);
		} else {
			$configuracion_temporal = busca_filtro_tabla("valor", "configuracion", "nombre='ruta_temporal' AND tipo='ruta'", "", $conn);
			if ($configuracion_temporal["numcampos"]) {
				$ruta_temp = $configuracion_temporal[0]["valor"];
			}
			$formato_ruta = $ruta_db_superior . $ruta_temp . "_" . $_SESSION["LOGIN" . LLAVE_SAIA] . "/";
		}

		if ($this -> versionamiento) {
			$ruta_versiones = ruta_almacenamiento("versiones");
			$path_to_file = $ruta_versiones . $formato_ruta . "/version" . $this -> version;
			$nombre_pdf = $path_to_file . "/doc" . $this -> documento[0]["iddocumento"] . ".pdf";

			crear_destino($path_to_file);

			$this -> tipo_salida = "F";
		} else if ($this -> formato["numcampos"]) {
			$ruta_pdfs = ruta_almacenamiento("pdf");
			$carpeta = $ruta_pdfs . $formato_ruta . "/pdf";

			$adicional = "";
			if ($this -> imprimir_vistas) {
				$adicional = "_vista" . @$_REQUEST["vista"];
			}

			$nombre_pdf = $carpeta . "/" . strtoupper($this -> formato[0]["nombre"]) . "_" . $this -> documento[0]["numero"] . "_" . str_replace("-", "_", $this -> documento[0]["fecha"]) . $adicional . ".pdf";

			crear_destino($carpeta);
			chmod($carpeta, 0777);
		} else {
			$nombre_pdf = $this -> documento[0]["numero"] . "_" . str_replace("-", "_", $this -> documento[0]["fecha"]) . ".pdf";
		}

		chmod($nombre_pdf, 0777);
		if ($this -> documento[0]["estado"] == 'ACTIVO') {
			$this -> tipo_salida = "FI";
		}
		if ($this -> tipo_salida == "FI") {
			$codigo_hash = obtener_codigo_hash_pdf($nombre_pdf, 'crc32');
			$paginas_pdf = $this -> pdf -> getNumPages();
			phpmkr_query("update documento set paginas='" . $paginas_pdf . "',pdf='" . $nombre_pdf . "',pdf_hash='" . $codigo_hash . "' where iddocumento=" . $this -> documento[0]["iddocumento"]);
		} else if ($this -> tipo_salida == "FI" && $this -> formato[0]["mostrar_pdf"] == 1) {
			$codigo_hash = obtener_codigo_hash_pdf($nombre_pdf, 'crc32');
			$paginas_pdf = $this -> pdf -> getNumPages();
			phpmkr_query("update documento set paginas='" . $paginas_pdf . "',pdf='" . $nombre_pdf . "',pdf_hash='" . $codigo_hash . "' where iddocumento=" . $this -> documento[0]["iddocumento"]);
		} else if ($this -> tipo_salida == "I") {
			if ($this -> imprimir_vistas) {
				$this -> tipo_salida = "FI";
			} else {
				$nombre_pdf = basename($nombre_pdf);
			}
		}

		if ($_REQUEST["url"]) {
			$nombre_pdf = basename($_REQUEST["url"]);
		}

		$valor = $this -> pdf -> Output($nombre_pdf, $this -> tipo_salida);
		if ($this -> documento[0]["estado"] <> 'ACTIVO' && $this -> tipo_salida == "I") {
			redirecciona("visores/pdf/web/viewer2.php?iddocumento=" . $this -> documento[0]["iddocumento"]);
			die();
		} else {
			if ($this -> documento[0]["estado"] == 'ACTIVO') {
				redirecciona("visores/pdf/web/viewer2.php?iddocumento=" . $this -> documento[0]["iddocumento"]);
				die();
			} else {
				if ($_REQUEST["url"]) {
					$nombre_pdf = basename($_REQUEST["url"]);
				} else {
					$codigo_hash = obtener_codigo_hash_pdf($nombre_pdf, 'crc32');
					$paginas_pdf = $this -> pdf -> getNumPages();
					phpmkr_query("update documento set paginas='" . $paginas_pdf . "',pdf='" . $nombre_pdf . "',pdf_hash='" . $codigo_hash . "' where iddocumento=" . $this -> documento[0]["iddocumento"]);
					redirecciona("visores/pdf/web/viewer2.php?iddocumento=" . $this -> documento[0]["iddocumento"]);
					die();
				}
			}
		}
	}

	public function configurar_encabezado() {
		global $conn;
		if ($this -> documento[0]["estado"] == "ACTIVO" || $this -> documento[0]["estado"] == "ANULADO") {
			$this -> pdf -> marca_agua = 1;
		}
		if ($this -> formato[0]["encabezado"]) {
			$encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato=" . $this -> formato[0]["encabezado"], "", $conn);
			if ($encabezado["numcampos"]) {
				$this -> pdf -> encabezado = crear_encabezado_pie_pagina($encabezado[0]["contenido"], $this -> documento[0]["iddocumento"], $this -> formato[0]["idformato"], 1);
			}
		}

		if ($this -> formato[0]["pie_pagina"]) {
			$pie_pag = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato=" . $this -> formato[0]["pie_pagina"], "", $conn);
			if ($pie_pag["numcampos"]) {
				$this -> pdf -> pie_pagina = crear_encabezado_pie_pagina($pie_pag[0]["contenido"], $this -> documento[0]["iddocumento"], $this -> formato[0]["idformato"], 1);
			}
		}

		$this -> pdf -> setHeaderFont(Array($this -> font_family, '', $this -> font_size));
		$this -> pdf -> setFooterFont(Array($this -> font_family, '', $this -> font_size));
		//$this->pdf->setExtraXMP(genera_xmp_saia());
	}

	public function imprimir_paginas() {
		global $conn;
		if ($this -> idpaginas != "") {
			$paginas = busca_filtro_tabla("ruta", "pagina", "consecutivo in(" . $this -> idpaginas . ")", "", $conn);
		} else {
			$paginas = busca_filtro_tabla("ruta", "pagina", "id_documento=" . $this -> documento[0]["iddocumento"], "", $conn);
		}

		if ($paginas["numcampos"]) {
			$this -> pdf -> setJPEGQuality(75);
			for ($i = 0; $i < $paginas["numcampos"]; $i++) {
				if (is_file($paginas[$i]["ruta"])) {
					chmod($paginas[$i]["ruta"], 0777);
					$this -> pdf -> startPageGroup();
					$this -> pdf -> AddPage();
					$this -> pdf -> Image($paginas[$i]["ruta"], $this -> margenes["izquierda"], $this -> margenes["superior"], 0, 0, 'JPG', '', '', false, 300, '', false, false, 0, false, false, true);
				}
			}
		}
	}

	public function extraer_contenido($iddocumento, $vista = 0) {
		global $conn;
		$mh = curl_multi_init();
		$ch = curl_init();
		$direccion = array();

		if ($_REQUEST["url"]) {
			$request_url = str_replace('.php', '.php?1=1', $_REQUEST['url']);
			$direccion[] = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/" . str_replace('|', '&', $request_url);
		} else {
			$datos_formato = busca_filtro_tabla("papel,orientacion,nombre,nombre_tabla,ruta_mostrar,idformato", "formato,documento", "lower(plantilla)=nombre and iddocumento=" . $iddocumento, "", $conn);
			$datos_plantilla = busca_filtro_tabla("", $datos_formato[0]["nombre_tabla"], "documento_iddocumento=" . $iddocumento, "", $conn);
			if ($vista > 0) {
				$datos_vista = busca_filtro_tabla("", "vista_formato", "idvista_formato=$vista", "", $conn);
				$direccion[] = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/formatos/" . $datos_formato[0]["nombre"] . "/" . $datos_vista[0]["ruta_mostrar"] . "?tipo=5&iddoc=" . $datos_plantilla[0]["documento_iddocumento"] . "&formato=" . $datos_formato[0]["idformato"] . "&idfunc=" . usuario_actual("id");
			} elseif ($datos_formato[0]["nombre"] == "carta") {
				$destinos = explode(",", $datos_plantilla[0]["destinos"]);
				foreach ($destinos as $fila) {
					$direccion[] = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/formatos/" . $datos_formato[0]["nombre"] . "/" . $datos_formato[0]["ruta_mostrar"] . "?tipo=5&iddoc=" . $datos_plantilla[0]["documento_iddocumento"] . "&formato=" . $datos_formato[0]["idformato"] . "&idfunc=" . usuario_actual("id") . "&destino=$fila";
				}
			} else {
				$direccion[] = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/formatos/" . $datos_formato[0]["nombre"] . "/" . $datos_formato[0]["ruta_mostrar"] . "?tipo=5&iddoc=" . $datos_plantilla[0]["documento_iddocumento"] . "&formato=" . $datos_formato[0]["idformato"] . "&idfunc=" . usuario_actual("id");
			}
		}
		//$this -> pdf -> startPageGroup();
		foreach ($direccion as $fila) {
			curl_setopt($ch, CURLOPT_URL, $fila);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$contenido = curl_exec($ch);

			$contenido = str_replace("../../../images", PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/../images", $contenido);
			$contenido = str_replace("<pagebreak/>", "<br pagebreak=\"true\"/>", $contenido);
			$contenido = str_replace("<p> </p>", "<p></p>", $contenido);
			$contenido = str_replace("<p>&nbsp;</p>", "<p></p>", $contenido);
			$contenido = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $contenido);
			$contenido = preg_replace('#onclick="(.*?)"#is', '', $contenido);
			$contenido = preg_replace("/([^0-9]*)([0-9]+)px/", "$1$2pt", $contenido);
			//Cambia los px por pt

			if ($datos_formato[0]["orientacion"]) {
				$datos_formato[0]["orientacion"] = "L";
			} else {
				$datos_formato[0]["orientacion"] = "P";
			}
			$this -> pdf -> AddPage($datos_formato[0]["orientacion"], $datos_formato[0]["papel"]);
			$this -> pdf -> writeHTML(stripslashes($contenido), true, false, false, false, '');
		}
		curl_close($ch);
	}

	public function vincular_anexos() {
		global $conn;
		$anexos = busca_filtro_tabla("", "anexos", "documento_iddocumento=" . $this -> documento[0]["iddocumento"], "", $conn);
		if ($anexos["numcampos"]) {
			for ($i = 0; $i < $anexos["numcampos"]; $i++) {
				$this -> pdf -> Annotation(10, 5, 5, 5, "Anexos digitales", array('Subtype' => 'FileAttachment', 'Name' => $anexos[$i]["etiqueta"], 'FS' => $anexos[$i]["ruta"]));
			}
		}
	}

	public function imprimir_hijos() {
		$hijos = explode(",", $this -> idhijos);
		foreach ($hijos as $fila) {
			$this -> extraer_contenido($fila);
		}
	}

	public function renombrar_pdf_actual() {
		if ($this -> documento[0]["pdf"] != "") {
			$nombre = $this -> documento[0]["pdf"];
			$i = 1;
			$nombre_revisar = str_replace('.pdf', 'version' . $i . '.pdf', $nombre);
			while (is_file($nombre_revisar)) {
				$i++;
				$nombre_revisar = str_replace('.pdf', 'version' . $i . '.pdf', $nombre);
			}
			if (is_file($nombre)) {
				chmod($nombre, 0777);
				rename($nombre, $nombre_revisar);
			}
			phpmkr_query("update documento set pdf='' where iddocumento=" . $this -> documento[0]["iddocumento"]);
			$this -> documento[0]["pdf"] = "";
		}
	}

}

function genera_xmp_saia() {
	return ('<rdf:RDF xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">
      <rdf:Description rdf:about=""
            xmlns:xmp="http://ns.adobe.com/xap/1.0/"
            xmlns:pdfx="http://ns.adobe.com/pdfx/1.3/"
            xmlns:pdf="http://ns.adobe.com/pdf/1.3/"
            xmlns:dc="http://purl.org/dc/elements/1.1/">
         <pdfx:CustomData>my custom data</pdfx:CustomData>
         <dc:creator>
            <rdf:Seq>
               <rdf:li>Me!</rdf:li>
            </rdf:Seq>
         </dc:creator>
      </rdf:Description>
   </rdf:RDF>');
}

class MYPDF extends TCPDF {
	public $encabezado = "";
	public $pie_pagina = "";
	public $marca_agua = 0;
	public $margenes = array();
	public $documento = array();
	public $papel = "";
	public $orientacion;

	public function Header() {
		$texto = str_replace("##PAGE##", $this -> total_paginas(), $this -> encabezado);
		$texto = str_replace("##PAGES##", $this -> pagina_actual(), $texto);
		$texto = preg_replace("/([^0-9]*)([0-9]+)px/", "$1$2pt", $texto);  //cambia px por pt

		$this -> writeHTMLCell(0, 0, $this -> margenes["izquierda"], 5, stripslashes($texto), 0, 1, 0, false, '', true);

		if ($this -> marca_agua) {
			$img_file = 'imagenes/marca_agua_borrador.png';
			if ($this -> documento["estado"] == 'ANULADO') {
				$img_file = 'imagenes/marca_agua_anulado.png';
			}
			$bMargin = $this -> getBreakMargin();
			$auto_page_break = $this -> AutoPageBreak;
			$this -> SetAutoPageBreak(false, 0);

			if ($this -> orientacion == "L") {
				$this -> Image($img_file, 20, 40, 200, 100, '', '', '', false, 300, '', false, false, 0);
			} else {
				$this -> Image($img_file, 10, 50, 200, 197, '', '', '', false, 300, '', false, false, 0);
			}

			$this -> SetAutoPageBreak($auto_page_break, $bMargin);
			$this -> setPageMark();
		}
	}

	public function Footer() {
		$texto = str_replace("##PAGES##", $this -> total_paginas(), $this -> pie_pagina);
		$texto = str_replace("##PAGE##", $this -> pagina_actual(), $texto);
		$texto = preg_replace("/([^0-9]*)([0-9]+)px/", "$1$2pt", $texto); //cambia px por pt

		if ($this -> papel == "Letter") {
			if ($this -> orientacion == "L") {
				$this -> writeHTMLCell(0, 0, $this -> margenes["izquierda"], 200, stripslashes($texto), 0, 2, 0, false, '', true);
			} else {
				$this -> writeHTMLCell(0, 0, $this -> margenes["izquierda"], 260, stripslashes($texto), 0, 2, 0, false, '', true);
			}
		} else if ($this -> papel == "A4") {
			if ($this -> orientacion == "L") {
				$this -> writeHTMLCell(0, 0, $this -> margenes["izquierda"], 190, stripslashes($texto), 0, 2, 0, false, '', true);
			} else {
				$this -> writeHTMLCell(0, 0, $this -> margenes["izquierda"], 270, stripslashes($texto), 0, 2, 0, false, '', true);
			}
		} else if ($this -> papel == "A5") {
			if ($this -> orientacion == "L") {
				$this -> writeHTMLCell(0, 0, $this -> margenes["izquierda"], 125, stripslashes($texto), 0, 2, 0, false, '', true);
			} else {
				$this -> writeHTMLCell(0, 0, $this -> margenes["izquierda"], 185, stripslashes($texto), 0, 2, 0, false, '', true);
			}
		} else if ($this -> papel == "Legal") {
			if ($this -> orientacion == "L") {
				$this -> writeHTMLCell(0, 0, $this -> margenes["izquierda"], 195, stripslashes($texto), 0, 2, 0, false, '', true);
			} else {
				$this -> writeHTMLCell(0, 0, $this -> margenes["izquierda"], 330, stripslashes($texto), 0, 2, 0, false, '', true);
			}
		}
	}

	public function pagina_actual() {
		if (empty($this -> pagegroups)) {
			return (trim($this -> getAliasNumPage()));
		} else {
			return (trim($this -> getPageNumGroupAlias()));
		}
	}

	public function total_paginas() {
		if (empty($this -> pagegroups)) {
			return (trim($this -> getAliasNbPages()));
		} else {
			return (trim($this -> getPageGroupAlias()));
		}
	}

}

if (@$_REQUEST["iddoc"]) {

	$pdf = new Imprime_Pdf($_REQUEST["iddoc"]);
	$pdf -> configurar_pagina($_REQUEST);
	$pdf -> imprimir();

} elseif ($_REQUEST["url"]) {

	$pdf = new Imprime_Pdf("url");
	$pdf -> configurar_pagina($_REQUEST);
	if (@$_REQUEST["encabezado_papa"]) {

		$arreglo1 = explode("|", $_REQUEST["url"]);
		$arreglo2 = explode("=", $arreglo1[1]);
		$doc_papa = $arreglo2[1];
		$encabezado_papa = busca_filtro_tabla("", "documento A,formato B", "lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=" . $doc_papa, "", $conn);
		if (@$_REQUEST["tercero"]) {
			$encabezado_papa = busca_filtro_tabla("", "documento A,formato B", "lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=1721872", "", $conn);
		}
		if (@$_REQUEST["seguridad"]) {
			$encabezado_papa = busca_filtro_tabla("", "documento A,formato B", "lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=1721474", "", $conn);
		}

		if ($encabezado_papa["numcampos"]) {
			$pdf -> formato[0]["encabezado"] = $encabezado_papa[0]["encabezado"];
			$pdf -> formato[0]["idformato"] = $encabezado_papa[0]["idformato"];
			$pdf -> mostrar_encabezado = 1;

		}
	}

	$pdf -> imprimir();
}
?>
