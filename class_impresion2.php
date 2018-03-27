<?php
set_time_limit(0);
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if(is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . 'formatos/librerias/encabezado_pie_pagina.php');
require_once ($ruta_db_superior . 'tcpdf/config/lang/spa.php');
require_once ($ruta_db_superior . 'tcpdf/tcpdf.php');
class Imprime_Pdf {
	private $orientacion = 'P'; // P-vertical ,L-horizontal
	private $margenes = array(
			"superior" => "10",
			"inferior" => "10",
			"izquierda" => "5",
			"derecha" => "10"
	);
	private $font_size = "12"; // tama�o de la letra
	private $font_family = "verdana"; // tipo de letra
	private $tipo_salida = "I"; // I para mostrar en pantalla, FI para guardar en el servidor y mostrar en pantalla
	private $mostrar_encabezado = 0; // define si se muestra o no el encabezado y el pie de pagina
	private $documento = ""; // datos del documento actual
	private $formato = ""; // datos del formato actual
	private $idpaginas = ""; // id de las paginas elegidas en el menu intermedio para imprimir
	private $idhijos = ""; // id de los documentos hijos del actual seleccionados en el menu intermedio para imprimir
	private $imprimir_plantilla = 0; // identifica si el documento actual es un formato y se va a imprimir
	private $imprimir_paginas = 0; // define si se desean imprimir las paginas del documento
	private $vincular_anexos = 0; // define si se desean adjuntar los anexos del documento al pdf
	private $pdf = ""; // variable que va a contener la instancia de la clase MYPDF
	private $versionamiento = 0; // variable que indica si se est� creando una nueva version
	private $version = 0; // variable que indica si se est� creando una nueva version en que numero va
	private $papel = "LETTER"; // tipo de papel a usar para la impresion LETTER.LEGAL,A4
	private $imprimir_vistas = 0; // variable que indica si vienen seleccionadas vistas para imprimir
	private $idvistas = ""; // id de las vistas seleccionadas para impresion
	private $direccion = array();
 // id de las vistas seleccionadas para impresion

	/*
	 * constructor de la clase
	 *
	 */
	function __construct($iddocumento) {
		global $conn, $ruta_db_superior;

		if($iddocumento != "p" && $iddocumento != "url") {

			$this->documento = busca_filtro_tabla("documento.*," . fecha_db_obtener("fecha", "Y-m-d") . " as fecha", "documento", "iddocumento=$iddocumento", "", $conn);

			$formato = busca_filtro_tabla("", "formato", "lower(nombre) like '" . strtolower($this->documento[0]["plantilla"]) . "'", "", $conn);

			if(!$this->documento["numcampos"]) {
				die("documento no encontrado.");
			}

			if($formato["numcampos"]) {

				if($this->documento[0]["pdf"] != "" && !isset($_REQUEST["seleccion"]) && !isset($_REQUEST["renombrar_pdf"])) { // si el pdf ya está guardado y el archivo si existe redirecciono
					if(is_file($this->documento[0]["pdf"])) {
						$this->tipo_salida = "I";
						// redirecciona($this->documento[0]["pdf"]."?rnd".rand(0,100));die();
					} elseif(is_file("html2ps/public_html/demo/" . $this->documento[0]["pdf"])) {
						redirecciona("html2ps/public_html/demo/" . $this->documento[0]["pdf"]);
						die();
					} else { // la ruta del pdf esta guardada pero el archivo fisico no fue encontrado
						$this->tipo_salida = "FI"; // para generarlo de nuevo y guardar la ruta
					}
				}
				// si el documento ya no esta activo, pero nunca le guardaron el pdf, se guarda
				if($this->documento[0]["pdf"] == "" && $this->documento[0]["estado"] != "ACTIVO") {
					$this->tipo_salida = "FI";
				}

				$tipo_fuente = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_letra'", "", $conn);

				$plantilla = busca_filtro_tabla("encabezado", $formato[0]["nombre_tabla"], "documento_iddocumento=$iddocumento", "", $conn);

				$this->mostrar_encabezado = $plantilla[0]["encabezado"];
				$this->imprimir_plantilla = 1;

				if($formato[0]["orientacion"]) {
					$this->orientacion = "L";
				}

				$vmargen = explode(",", $formato[0]["margenes"]);

				$this->margenes = array(
						"izquierda" => $vmargen[0],
						"derecha" => $vmargen[1],
						"superior" => $vmargen[2],
						"inferior" => $vmargen[3]
				);

				if($tipo_fuente["numcampos"]) {
					$this->font_family = $tipo_fuente[0][0];
				}

				$this->font_size = ($formato[0]["font_size"] - 2);
				$this->papel = $formato[0]["papel"];
				$this->formato = $formato;

				$this->pdfa = true;
			}
		} elseif($iddocumento == "url") {
			$this->tipo_salida = "FI";
			$this->imprimir_plantilla = 1;
			$this->documento[0]["iddocumento"] = "url";
		} else {
			$this->tipo_salida = "FI";
			$this->imprimir_plantilla = 0;
		}
	}

	function obtener_url($iddocumento, $vista) {
		global $conn;

		$datos_formato = busca_filtro_tabla("nombre,nombre_tabla,ruta_mostrar", "formato,documento", "lower(plantilla)=nombre and iddocumento=$iddocumento", "", $conn);

		$datos_plantilla = busca_filtro_tabla("", $datos_formato[0]["nombre_tabla"], "documento_iddocumento=$iddocumento", "", $conn);

		if($vista > 0) {
			$datos_vista = busca_filtro_tabla("", "vista_formato", "idvista_formato=$vista", "", $conn);

			$this->direccion[] = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/" . FORMATOS_CLIENTE . $datos_formato[0]["nombre"] . "/" . $datos_vista[0]["ruta_mostrar"] . "?tipo=6&iddoc=" . $datos_plantilla[0]["documento_iddocumento"] . "&formato=" . $datos_formato[0]["idformato"] . "&idfunc=" . usuario_actual("id");
		} elseif($datos_formato[0]["nombre"] == "carta") {
			$destinos = explode(",", $datos_plantilla[0]["destinos"]);

			foreach($destinos as $fila) {
				$this->direccion[] = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/" . FORMATOS_CLIENTE . $datos_formato[0]["nombre"] . "/" . $datos_formato[0]["ruta_mostrar"] . "?tipo=6&iddoc=" . $datos_plantilla[0]["documento_iddocumento"] . "&formato=" . $datos_formato[0]["idformato"] . "&idfunc=" . usuario_actual("id") . "&destino=$fila";
			}
		} else {
			$this->direccion[] = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/" . FORMATOS_CLIENTE . $datos_formato[0]["nombre"] . "/" . $datos_formato[0]["ruta_mostrar"] . "?tipo=5&iddoc=" . $datos_plantilla[0]["documento_iddocumento"] . "&formato=" . $datos_formato[0]["idformato"] . "&idfunc=" . usuario_actual("id");
		}
	}

	function configurar_encabezado() {
		global $conn;

		if($_REQUEST["url_encabezado"]) {
			$mh = curl_multi_init();
			$ch = curl_init();
        if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	}			
			curl_setopt($ch, CURLOPT_URL, $_REQUEST["url_encabezado"]);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$contenido = curl_exec($ch);
			$contenido = str_replace("<pagebreak/>", "<br pagebreak=\"true\"/>", $contenido);
			$contenido = str_replace("<p> </p>", "<p></p>", $contenido);
			$contenido = str_replace("<p>&nbsp;</p>", "<p></p>", $contenido);
			// $contenido = preg_replace("/&nbsp;/"," ", $contenido);
			$contenido = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $contenido);
			$contenido = preg_replace('#onclick="(.*?)"#is', '', $contenido);
			$contenido = preg_replace('#href="(.*?)"#is', '', $contenido);
			$contenido = preg_replace('/(table-width-pdf:)(.*);/', "${1}width: $2;", $contenido);
			$contenido = preg_replace('/(table-td-width-pdf:)(.*);/', "${1}width: $2;", $contenido);
			$contenido = preg_replace('/(height-pdf:)(.*);/', "${1}height: $2;", $contenido);
			$contenido = preg_replace('/<dobble-br\/>/', "<br /><br />", $contenido);
			curl_close($ch);
			$marca_agua = 0;
			$this->pdf->set_header($contenido, $marca_agua);
		} elseif(@$this->formato[0]["encabezado"]) {

			$encabezado = busca_filtro_tabla("", "encabezado_formato", "idencabezado_formato=" . $this->formato[0]["encabezado"], "", $conn);

			$marca_agua = 0;

			if(@$this->documento[0]["estado"] == "ACTIVO") {
				$marca_agua = 1;
			}
			$this->pdf->set_header(crear_encabezado_pie_pagina($encabezado[0]["contenido"], $this->documento[0]["iddocumento"], $this->formato[0]["idformato"], 1), $marca_agua);
		}

		if(@$this->formato) {
			if(@$this->formato[0]["pie_pagina"]) {
				$encabezado = busca_filtro_tabla("", "encabezado_formato", "idencabezado_formato=" . $this->formato[0]["pie_pagina"], "", $conn);
				$this->pdf->set_footer(crear_encabezado_pie_pagina($encabezado[0]["contenido"], $this->documento[0]["iddocumento"], $this->formato[0]["idformato"], 1));
			}
		}
		$this->pdf->SetHeaderMargin(5);
		$this->pdf->SetFooterMargin($this->margenes["inferior"]);
		$this->pdf->setHeaderFont(Array(
				$this->font_family,
				'',
				$this->font_size
		));
		$this->pdf->setFooterFont(Array(
				$this->font_family,
				'',
				$this->font_size
		));
	}

	function imprimir() {
		$this->pdf = new MYPDF($this->orientacion, PDF_UNIT, $this->papel, true, 'UTF-8', false);
		$this->pdf->SetMargins($this->margenes["izquierda"], $this->margenes["superior"], $this->margenes["derecha"], 1);
		$this->pdf->AddFont($this->font_family);
		$this->pdf->SetFont($this->font_family, '', $this->font_size);
		$this->pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$this->pdf->SetAutoPageBreak(TRUE, $this->margenes["inferior"]);

		$nombre_pdf = "";
		if($_REQUEST["url_encabezado"]) {
			$this->configurar_encabezado();
			$this->pdf->setPrintHeader(true);
			$this->pdf->setPrintFooter(false);
			$this->pdf->SetMargins($this->margenes["izquierda"], 27, $this->margenes["derecha"], 1);
		} elseif(@$this->mostrar_encabezado) {
			$this->configurar_encabezado();
			$this->pdf->setPrintHeader(true);
			$this->pdf->setPrintFooter(true);
		} else {
			$this->pdf->setPrintHeader(false);
			$this->pdf->setPrintFooter(false);
		}

		if($this->imprimir_paginas) {
			$this->imprimir_paginas();
		}

		if($this->imprimir_plantilla) {

			if($this->mostrar_encabezado) {
				$this->pdf->setPrintHeader(true);
				$this->pdf->setPrintFooter(true);
			}

			$this->extraer_contenido($this->documento[0]["iddocumento"]);
		}

		if(@$this->vincular_anexos) {
			$this->vincular_anexos();
		}

		if(@$this->imprimir_vistas) {
			$vector = explode(",", $this->idvistas);
			foreach($vector as $fila) {
				$aux = explode("-", $fila);
				$this->extraer_contenido($aux[1], $aux[0]);
			}
		}

		if(@$this->idhijos != "") {
			$this->imprimir_hijos();
		}

		if(@$this->documento) {
			$fecha = explode("-", $this->documento[0]["fecha"]);
		}

		include_once ($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
		$formato_ruta = aplicar_plantilla_ruta_documento($this->documento[0]["iddocumento"]);

		if(@$this->versionamiento) {
			$ruta_versiones = ruta_almacenamiento("versiones");
			$path_to_file = $ruta_versiones . $formato_ruta . "/version" . $this->version;
			$nombre_pdf = $path_to_file . "/doc" . $this->documento[0]["iddocumento"] . ".pdf";

			crear_destino($path_to_file);

			$this->tipo_salida = "F";
		} else if(@$this->formato["numcampos"]) {
			$ruta_pdfs = ruta_almacenamiento("pdf");
			$carpeta = $ruta_pdfs . $formato_ruta . "/pdf";

			$adicional = "";
			if($this->imprimir_vistas) {
				$adicional = "_vista" . @$_REQUEST["vista"];
			}

			$nombre_pdf = $carpeta . "/" . strtoupper($this->formato[0]["nombre"]) . "_" . $this->documento[0]["numero"] . "_" . str_replace("-", "_", $this->documento[0]["fecha"]) . $adicional . ".pdf";

			crear_destino($carpeta);
		} else {
			if($this->documento && @$this->documento[0]["numero"]) {
				$nombre_pdf = $this->documento[0]["numero"] . "_" . $this->documento[0]["fecha"] . ".pdf";
			} elseif($this->idpaginas) {
				$nombre_pdf = $this->idpaginas . "_" . date("y-m-d") . ".pdf";
			} else {
				$nombre_pdf = "pdf_" . date("y-m-d") . ".pdf";
			}
		}

		if($this->tipo_salida == "FI" && !$this->documento) {
			$nombre_pdf = basename($nombre_pdf);
		} elseif($this->tipo_salida == "FI" && $this->documento[0]["estado"] != 'ACTIVO') {
			phpmkr_query("update documento set pdf='" . $nombre_pdf . "' where iddocumento=" . $this->documento[0]["iddocumento"]);
		} elseif($this->tipo_salida == "I") {

			$nombre_pdf = basename($nombre_pdf);
		}

		$this->pdf->Output($nombre_pdf, $this->tipo_salida);
	}

	function imprimir_paginas() {
		if($this->idpaginas != "") {
			$paginas = busca_filtro_tabla("", "pagina", "consecutivo in(" . $this->idpaginas . ")", "", $conn);
		} else {
			$paginas = busca_filtro_tabla("", "pagina", "id_documento=" . $this->documento[0]["iddocumento"], "", $conn);
		}

		if($paginas["numcampos"]) {

			$this->pdf->setJPEGQuality(75);

			for($i = 0; $i < $paginas["numcampos"]; $i++) {

				if(is_file($paginas[$i]["ruta"])) {

					chmod($paginas[$i]["ruta"], 0777);
					$this->pdf->setPrintHeader(false);
					$this->pdf->setPrintFooter(false);
					$this->pdf->startPageGroup();
					$this->pdf->AddPage();
					$this->pdf->Image($paginas[$i]["ruta"], $this->margenes["izquierda"], $this->margenes["superior"], 0, 0, 'JPG', '', '', false, 300, '', false, false, 0, false, false, true);
				}
			}
		}
	}

	function extraer_contenido($iddocumento, $vista = 0) {
		global $conn;

		$mh = curl_multi_init();
		$ch = curl_init();

		if($_REQUEST["url"]) {
			$this->direccion[] = str_replace('|', '&', $_REQUEST['url']);
		} else {
			$this->obtener_url($iddocumento, $vista);
		}

		foreach($this->direccion as $fila) {

			$fila .= "&font_size=" . $this->font_size;
        if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		}			

			curl_setopt($ch, CURLOPT_URL, $fila);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			$this->pdf->startPageGroup();
			$this->pdf->AddPage();
			$contenido = curl_exec($ch);
			$contenido = preg_replace("/(..\/){3}images/", PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/../images", $contenido);
			$contenido = preg_replace("/(..\/)*imagenes/", PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/imagenes", $contenido);
			$contenido = preg_replace("/(..\/)*botones/", PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/botones", $contenido);
			$contenido = str_replace("<pagebreak/>", "<br pagebreak=\"true\"/>", $contenido);
			$contenido = str_replace("<p> </p>", "<p></p>", $contenido);
			$contenido = str_replace("<p>&nbsp;</p>", "<p></p>", $contenido);
			// $contenido = preg_replace("/&nbsp;/"," ", $contenido);
			$contenido = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $contenido);
			$contenido = preg_replace('#onclick="(.*?)"#is', '', $contenido);
			$contenido = preg_replace('#href="(.*?)"#is', '', $contenido);
			$contenido = preg_replace('/(table-width-pdf:)(.*);/', "${1}width: $2;", $contenido);
			$contenido = preg_replace('/(table-td-width-pdf:)(.*);/', "${1}width: $2;", $contenido);
			$contenido = preg_replace('/(table-margin-left:)(.*);/', "${1}margin-left: $2;", $contenido);
			$contenido = preg_replace('/(height-pdf:)(.*);/', "${1}height: $2;", $contenido);
			$contenido = preg_replace('/<dobble-br\/>/', "<br /><br />", $contenido);

			if($_SESSION['LOGIN' . LLAVE_SAIA] == 'cerok') {
				// print_r($contenido);
				// die();
			}

			$config = array(
					'indent' => true,
					'output-xhtml' => true,
					'wrap' => 200
			);

			// Tidy
			$tidy = new tidy();
			$tidy->errorBuffer;
			$tidy->parseString($contenido, $config, 'utf8');
			$tidy->cleanRepair();
			// Output

			$contenido = $tidy;

			if($_REQUEST["url_encabezado"]) {
				$this->pdf->writeHTMLCell(0, 0, '', 27, stripslashes($contenido), "", 1, 0, false, '', true);
			} else {
				$this->pdf->writeHTML(stripslashes($contenido), true, false, false, false, '');
			}
		}
		curl_close($ch);
	}

	function vincular_anexos() {
		global $conn;

		$anexos = busca_filtro_tabla("", "anexos", "documento_iddocumento=" . $this->documento[0]["iddocumento"], "", $conn);

		for($i = 0; $i < $anexos["numcampos"]; $i++) {
			$this->pdf->Annotation(10, 5, 5, 5, "Anexos digitales", array(
					'Subtype' => 'FileAttachment',
					'Name' => $anexos[$i]["etiqueta"],
					'FS' => $anexos[$i]["ruta"]
			));
		}
	}

	function adicionar_postit($condicion, $iddoc) {
		global $conn;

		$comentarios = busca_filtro_tabla("", "comentario_img", "documento_iddocumento=" . $iddoc . " $condicion", "", $conn);

		for($i = 0; $i < $comentarios["numcampos"]; $i++) {
			$this->pdf->Annotation(($comentarios[$i]["posx"] / 3), ($comentarios[$i]["posy"] / 3), 100, 100, $comentarios[$i]["comentario"], array(
					'Subtype' => 'Text',
					'Name' => 'Comment',
					'T' => 'comentario ' . ($i + 1),
					'Subj' => 'example',
					'C' => array(
							255,
							255,
							0
					)
			));
		}
	}

	function imprimir_hijos() {
		$hijos = explode(",", $this->idhijos);

		foreach($hijos as $fila) {
			$this->extraer_contenido($fila);
		}
	}

	function configurar_seleccion_impresion($seleccionados) {
		$vector = explode(",", $seleccionados);
		$paginas = array();
		$vistas = array();
		$documentos = array();

		foreach($vector as $fila) {

			if($fila != "") {
				$campos = explode("-", $fila);
				if($campos[0] == "p") {
					if($campos[1] > 0) {
						$paginas[] = $campos[1];
					}
				} elseif($campos[0] == "vista") {

					$formato = busca_filtro_tabla("nombre_tabla", "formato,vista_formato", "idformato=formato_padre and idvista_formato=" . $campos[1], "", $conn);

					$iddoc = busca_filtro_tabla("documento_iddocumento", $formato[0]["nombre_tabla"], "id" . $formato[0]["nombre_tabla"] . "=" . $campos[2], "", $conn);

					if($iddoc["numcampos"]) {
						$vistas[] = $campos[1] . "-" . $iddoc[0][0];
					}
				} else {

					$formato = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $campos[0], "", $conn);

					$iddoc = busca_filtro_tabla("documento_iddocumento", $formato[0]["nombre_tabla"], "id" . $formato[0]["nombre_tabla"] . "=" . $campos[2], "", $conn);

					if($iddoc["numcampos"] && $iddoc[0][0] != $this->documento[0]["iddocumento"]) {
						$documentos[] = $iddoc[0][0];
					}
				}
			}
		}

		$this->idvistas = implode(",", $vistas);

		if($this->idvistas != "") {
			$this->imprimir_vistas = 1;
		}

		$this->idpaginas = implode(",", $paginas);

		if($this->idpaginas != "") {
			$this->imprimir_paginas = 1;
		}

		$this->idhijos = implode(",", $documentos);
	}

	function configurar_pagina($datos) {
		if(isset($datos["imprimir_paginas"]) && $datos["imprimir_paginas"]) {
			$this->imprimir_paginas = $datos["imprimir_paginas"];
		}

		if(isset($datos["vincular_anexos"]) && $datos["vincular_anexos"]) {
			$this->vincular_anexos = $datos["vincular_anexos"];
		}

		if(isset($datos["tipo_salida"]) && $datos["tipo_salida"]) {
			$this->tipo_salida = $datos["tipo_salida"];
		}

		if(isset($datos["seleccion"])) {
			$this->configurar_seleccion_impresion($datos["seleccion"]);
		}

		if(isset($datos["versionamiento"])) {
			$this->versionamiento = 1;
			$this->version = $datos["version"];
		}

		if(isset($datos["vista"])) {

			$this->imprimir_plantilla = 0;
			$this->imprimir_vistas = 1;
			$this->idvistas = $datos["vista"] . "-" . $datos["iddoc"];
			$vista = busca_filtro_tabla("", "vista_formato", "idvista_formato=" . $datos["vista"], "", $conn);
			$this->formato[0]["encabezado"] = $vista[0]["encabezado"];
			$this->formato[0]["pie_pagina"] = $vista[0]["pie_pagina"];
			$vmargen = explode(",", $vista[0]["margenes"]);
			$this->margenes = array(
					"izquierda" => $vmargen[0],
					"derecha" => $vmargen[1],
					"superior" => $vmargen[2],
					"inferior" => $vmargen[3]
			);
			$this->papel = $vista[0]["papel"];
			$this->orientacion = $vista[0]["orientacion"];
		}

		if(isset($datos["renombrar_pdf"]) && $datos["renombrar_pdf"]) {
			$this->renombrar_pdf_actual();
			$this->tipo_salida = "FI";
		}

		if(isset($datos["papel"]) && $datos["papel"]) {
			$this->papel = $datos["papel"];
		}

		if(isset($datos["font_family"]) && $datos["font_family"]) {
			$this->font_family = $datos["font_family"];
		}

		if(isset($datos["orientacion"])) {

			if($datos["orientacion"]) {
				$this->orientacion = "L";
			} else {
				$this->orientacion = "P";
			}
		}

		if(isset($datos["font_size"]) && $datos["font_size"]) {
			$this->font_size = ($datos["font_size"] - 2);
		}

		if(isset($datos["margen_superior"]) && $datos["margen_superior"]) {
			$this->margenes["superior"] = $datos["margen_superior"];
		}

		if(isset($datos["margen_inferior"]) && $datos["margen_inferior"]) {
			$this->margenes["inferior"] = $datos["margen_inferior"];
		}

		if(isset($datos["margen_derecha"]) && $datos["margen_derecha"]) {
			$this->margenes["derecha"] = $datos["margen_derecha"];
		}

		if(isset($datos["margen_izquierda"]) && $datos["margen_izquierda"]) {
			$this->margenes["izquierda"] = $datos["margen_izquierda"];
		}
	}

	function renombrar_pdf_actual() {
		if($this->documento[0]["pdf"] != "") {

			$nombre = $this->documento[0]["pdf"];
			$i = 1;
			$nombre_revisar = str_replace('.pdf', 'version' . $i . '.pdf', $nombre);

			while(is_file($nombre_revisar)) {
				$i++;
				$nombre_revisar = str_replace('.pdf', 'version' . $i . '.pdf', $nombre);
			}

			if(is_file($nombre)) {
				chmod($nombre, 0777);
				rename($nombre, $nombre_revisar);
			}

			phpmkr_query("update documento set pdf='' where iddocumento=" . $this->documento[0]["iddocumento"]);
			$this->documento[0]["pdf"] = "";
		}
	}
}
class MYPDF extends TCPDF {
	public $encabezado = "";
	public $pie_pagina = "";
	public $marca_agua = 0;

	public function Header() {
		$texto = str_replace("##PAGES##", "    " . $this->total_paginas(), $this->encabezado);
		$texto = str_replace("##PAGE##", $this->pagina_actual(), $texto);

		$margin_top = preg_match('/attr-margin-top: .*;/', $texto, $coincidencias);
		$margin_top = ( int ) preg_replace('/(attr-margin-top:)(.*);/', "$2", $coincidencias[0]);

		$margin_left = preg_match('/attr-margin-left: .*;/', $texto, $coincidencias);
		$margin_left = ( int ) preg_replace('/(attr-margin-left:)(.*);/', "$2", $coincidencias[0]);

		if(!$margin_top) {
			$margin_top = 0;
		}

		if(!$margin_left) {
			$margin_left = 0;
		}

		$this->writeHTMLCell(216, 0, $margin_left, $margin_top, stripslashes($texto), "", 1, 0, false, '', true);

		$img_file = 'imagenes/marca_agua_pdf.png';

		$doc_carta = busca_filtro_tabla("plantilla", "documento", "iddocumento=" . $_REQUEST["iddoc"], "", $conn);
		$formato = busca_filtro_tabla("pie_pagina", "formato", "lower(nombre) like '" . strtolower($doc_carta[0][0]) . "'", "", $conn);
		$this->piepagina = $formato[0]["pie_pagina"];

		if($this->marca_agua) { // get the current page break margin

			$bMargin = $this->getBreakMargin();
			// get current auto-page-break mode
			$auto_page_break = $this->AutoPageBreak;
			// disable auto-page-break
			$this->SetAutoPageBreak(true, 0);
			// set bacground image
			$this->Image($img_file, 50, 50, 110, 197, '', '', '', false, 300, '', false, false, 0);
			// restore auto-page-break status
			$this->SetAutoPageBreak($auto_page_break, $bMargin);
			// set the starting point for the page content
			$this->setPageMark();
		}
	}

	public function Footer() {
		$texto = str_replace("##PAGES##", $this->total_paginas(), $this->pie_pagina);
		$texto = str_replace("##PAGE##", $this->pagina_actual(), $texto);

		if($this->piepagina == 2) {
			$img_file = PROTOCOLO_CONEXION.'saia.eep.com.co/saia_actualizacion3/saia/imagenes/logo_superservicios.jpg';
			$this->Image($img_file, 5, 243, 0, 0, 'JPG', '', '', false, 300, '', false, false, 0);
			$texto = preg_replace('#(<img.*?>)#', '', $texto);
		}
		// muestra el pie de pagina en el pdf
		$this->writeHTMLCell(0, 0, '', 250, stripslashes($texto), "", 1, 0, false, '', true);
	}

	function pagina_actual() {
		if(empty($this->pagegroups)) {
			return ($this->getAliasNumPage());
		} else {
			return ($this->getPageNumGroupAlias());
		}
	}

	function total_paginas() {
		if(empty($this->pagegroups)) {
			return ($this->getAliasNbPages());
		} else {
			return ($this->getPageGroupAlias());
		}
	}

	public function set_footer($texto) {
		$this->pie_pagina = $texto;
	}

	public function set_header($texto, $marca_agua) {
		$texto = str_replace("<p> </p>", "<p></p>", $texto);
		$texto = str_replace("<p>&nbsp;</p>", "<p></p>", $texto);
		$this->encabezado = $texto;
		$this->marca_agua = $marca_agua;
	}
}

if(@$_REQUEST["iddoc"]) {
	$pdf = new Imprime_Pdf($_REQUEST["iddoc"]);
	$pdf->configurar_pagina($_REQUEST);
	$pdf->imprimir();
} elseif(@$_REQUEST["seleccion"]) {
	$pdf = new Imprime_Pdf("p");
	$pdf->configurar_pagina($_REQUEST);
	$pdf->imprimir();
} elseif($_REQUEST["url"]) {
	$pdf = new Imprime_Pdf("url");
	$pdf->configurar_pagina($_REQUEST);
	$pdf->imprimir();
}

?>
