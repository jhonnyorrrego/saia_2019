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

include_once $ruta_db_superior . "core/autoload.php";

try {
	JwtController::check($_REQUEST['token'], $_REQUEST['key']);
} catch (\Throwable $th) {
	die("invalid access");
}

include_once $ruta_db_superior . FORMATOS_SAIA . 'librerias/encabezado_pie_pagina.php';
include_once $ruta_db_superior . 'pantallas/qr/librerias.php';
include_once $ruta_db_superior . 'pantallas/lib/librerias_cripto.php';

class Imprime_Pdf
{
	private $orientacion = 'P';
	// P-vertical ,L-horizontal
	private $margenes = array(
		"superior" => "5",
		"inferior" => "5",
		"izquierda" => "5",
		"derecha" => "5"
	);
	private $font_size = "12";
	// tamaño de la letra
	private $font_family = "verdana";
	// tipo de letra
	private $tipo_salida = "F";
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
	private $papel = "Letter";
	// tipo de papel a usar para la impresion LETTER.LEGAL,A4
	private $imprimir_vistas = 0;
	// variable que indica si vienen seleccionadas vistas para imprimir
	private $idvistas = "";
	// id de las vistas seleccionadas para impresion
	private $info_ft = array();
	// todos los datos de la ft
	public $nombre_archivo = false;

	function __construct($iddocumento)
	{
		global $conn;
		if ($iddocumento == "url") {
			$this->tipo_salida = "FI";
			$this->imprimir_plantilla = 1;
			$this->documento[0]["iddocumento"] = "url";
		} else if ($iddocumento) {
			$this->documento = busca_filtro_tabla("d.*," . fecha_db_obtener("fecha", "Y-m-d") . " as fecha1", "documento d", "iddocumento=" . $iddocumento, "", $conn);
			if (!$this->documento["numcampos"]) {
				die("documento no encontrado.");
			}
			$formato = busca_filtro_tabla("", "formato", "lower(nombre) like '" . strtolower($this->documento[0]["plantilla"]) . "'", "", $conn);
			$this->formato = $formato;

			if ($formato["numcampos"]) {
				$plantilla = busca_filtro_tabla("", $formato[0]["nombre_tabla"], "documento_iddocumento=" . $iddocumento, "", $conn);
				$this->mostrar_encabezado = $plantilla[0]["encabezado"];
				$this->info_ft = $plantilla;
				$this->imprimir_plantilla = 1;

				if ($formato[0]["orientacion"]) {
					$this->orientacion = "L";
				} else {
					$this->orientacion = "P";
				}
				$vmargen = explode(",", $formato[0]["margenes"]);
				$this->margenes = array(
					"izquierda" => $vmargen[0],
					"derecha" => $vmargen[1],
					"superior" => $vmargen[2],
					"inferior" => $vmargen[3]
				);

				$tipo_fuente = busca_filtro_tabla("valor", "configuracion", "nombre='tipo_letra_pdf'", "", $conn);
				if ($tipo_fuente["numcampos"]) {
					$this->font_family = $tipo_fuente[0][0];
				}
				$this->font_size = $formato[0]["font_size"];
				$this->papel = $formato[0]["papel"];
			}
		}
	}

	public function configurar_pagina($datos)
	{
		if (isset($datos["imprimir_paginas"]) && $datos["imprimir_paginas"]) {
			$this->imprimir_paginas = $datos["imprimir_paginas"];
		}
		if (isset($datos["nombre_archivo"]) && $datos["nombre_archivo"] != "") {
			$this->nombre_archivo = $datos["nombre_archivo"];
		}

		if (isset($datos["vincular_anexos"]) && $datos["vincular_anexos"]) {
			$this->vincular_anexos = $datos["vincular_anexos"];
		}

		if (isset($datos["seleccion"])) {
			$this->configurar_seleccion_impresion($datos["seleccion"]);
		}
		if (isset($datos["versionamiento"])) {
			$this->versionamiento = 1;
			$this->version = $datos["version"];
		}

		if (isset($datos["vista"])) {
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

		if (isset($datos["renombrar_pdf"]) && $datos["renombrar_pdf"]) {
			$this->renombrar_pdf_actual();
		}

		if (isset($datos["papel"]) && $datos["papel"]) {
			$this->papel = $datos["papel"];
		}

		if (isset($datos["font_family"]) && $datos["font_family"]) {
			$this->font_family = $datos["font_family"];
		}

		if (isset($datos["orientacion"])) {
			if ($datos["orientacion"]) {
				$this->orientacion = "L";
			} else {
				$this->orientacion = "P";
			}
		}
		if (isset($datos["font_size"]) && $datos["font_size"]) {
			$this->font_size = $datos["font_size"];
		}

		if (isset($datos["margenes"]) && $datos["margenes"]) {
			$vmargen = explode(",", $datos["margenes"]);
			$this->margenes = array(
				"izquierda" => $vmargen[0],
				"derecha" => $vmargen[1],
				"superior" => $vmargen[2],
				"inferior" => $vmargen[3]
			);
		}

		if (isset($datos["tipo_salida"]) && $datos["tipo_salida"]) {
			$this->tipo_salida = $datos["tipo_salida"];
		}
	}

	public function configurar_seleccion_impresion($seleccionados)
	{
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
					if ($iddoc["numcampos"] && $iddoc[0][0] != $this->documento[0]["iddocumento"]) {
						$documentos[] = $iddoc[0][0];
					}
				}
			}
		}

		$this->idvistas = implode(",", $vistas);
		if ($this->idvistas != "") {
			$this->imprimir_vistas = 1;
		}
		$this->idpaginas = implode(",", $paginas);
		if ($this->idpaginas != "") {
			$this->imprimir_paginas = 1;
		}
		$this->idhijos = implode(",", $documentos);
	}

	public function imprimir()
	{
		global $conn;
		$this->pdf = new \Mpdf\Mpdf([
			'mode' => 'utf-8',
			'format' => $this->papel,
			'margin_left' => $this->margenes["izquierda"],
			'margin_right' => $this->margenes["derecha"],
			'margin_top' => $this->margenes["superior"],
			'margin_bottom' => $this->margenes["inferior"],
			'margin_header' => 5,
			'margin_footer' => $this->margenes["inferior"],
			'orientation' => $this->orientacion
		]);
		$this->pdf->PDFA = true;
		$this->pdf->setAutoTopMargin = "stretch";
		$this->pdf->setAutoBottomMargin = "stretch";

		/*
		 //Agregar style al PDF
		 $stylesheet = file_get_contents($ruta_db_superior . 'vendor/mpdf/style/mpdfstyletables.css');//utilizar style en el html
		 $this -> pdf -> WriteHTML($stylesheet, 1);
		 */
		$this->pdf->SetAutoPageBreak(TRUE, $this->margenes["inferior"]);

		if (!$this->documento && $_REQUEST["iddoc_pag"]) {
			$this->documento = busca_filtro_tabla("d.*," . fecha_db_obtener("fecha", "Y-m-d") . " as fecha1", "documento d", "iddocumento=" . $_REQUEST["iddoc_pag"], "", $conn);
		}

		//
		$this->pdf->SetCreator('SAIA');
		$this->pdf->SetTitle($this->documento[0]["plantilla"] . "_" . $this->documento[0]["numero"] . "_" . $this->documento[0]["fecha1"]);
		$autor = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . $this->documento[0]["ejecutor"], "", $conn);
		if ($autor["numcampos"]) {
			$this->pdf->SetAuthor($autor[0]["nombres"] . " " . $autor[0]["apellidos"]);
		}
		$cad_etiquetas = '';

		/*$etiquetas = busca_filtro_tabla("A.nombre", "etiqueta A,documento_etiqueta B", "A.idetiqueta=B.etiqueta_idetiqueta AND B.documento_iddocumento=" . $this -> documento[0]["iddocumento"], "", $conn);
		if ($etiquetas["numcampos"]) {
			$letiquetas = extrae_campo($etiquetas, "nombre");
			$cad_etiquetas .= ',' . implode(",", $letiquetas);
		}*/
		$this->pdf->SetKeywords("SAIA" . $cad_etiquetas);
		$this->pdf->SetSubject(codifica_encabezado(strip_tags($this->documento[0]["descripcion"])));
		//
		if ($this->mostrar_encabezado) {
			$this->configurar_encabezado();
		} else {
			$this->pdf->setPrintHeader(false);
			$this->pdf->setPrintFooter(false);
		}

		$nombre_pdf = "";
		if ($this->imprimir_paginas) {
			$this->imprimir_paginas();
		}
		if ($this->imprimir_plantilla) {
			$this->extraer_contenido($this->documento[0]["iddocumento"]);
		}

		if ($this->vincular_anexos) {
			$this->vincular_anexos();
		}

		if ($this->imprimir_vistas) {
			$vector = explode(",", $this->idvistas);
			foreach ($vector as $fila) {
				$aux = explode("-", $fila);
				$this->extraer_contenido($aux[1], $aux[0]);
			}
		}

		if ($this->idhijos != "") {
			$this->imprimir_hijos();
		}

		include_once($ruta_db_superior . "pantallas/lib/librerias_archivo.php");
		$ruta_tmp_usr = $_SESSION["ruta_temp_funcionario"];

		if (!$_REQUEST['url']) {
			if ($this->documento[0]["iddocumento"]) {
				$formato_ruta = aplicar_plantilla_ruta_documento($this->documento[0]["iddocumento"]);
			}
		} else {
			$formato_ruta = $ruta_db_superior . $ruta_tmp_usr;
		}

		$prefijo_nombre = "";
		if ($this->documento[0]["serie_idserie"] && $this->formato[0]["mostrar_tipodoc_pdf"]) {
			$datos_serie = busca_filtro_tabla("nombre, codigo", "serie", "idserie=" . $this->documento[0]["serie_idserie"], "", $conn);
			if ($datos_serie["numcampos"] && !empty($datos_serie[0]["codigo"])) {
				$prefijo_nombre = str_replace("-", "_", $datos_serie[0]["codigo"]);
				$prefijo_nombre .= "_";
			}
		}

		if ($this->nombre_archivo !== false) {
			$this->pdf->Output(__DIR__ . "/" . $prefijo_nombre . $this->nombre_archivo, $this->tipo_salida);
		} else {
			$pdf_temp = StorageUtils::obtener_archivo_temporal("impresion_", $ruta_tmp_usr);
			chmod($pdf_temp, 0777);
			$tipo_almacenamiento = null;
			if ($this->versionamiento) {
				$tipo_almacenamiento = new SaiaStorage("versiones");
				$path_to_file = $formato_ruta . "/version" . $this->version;
				$nombre_pdf = $path_to_file . "/doc" . $this->documento[0]["iddocumento"] . ".pdf";
			} else if ($this->formato["numcampos"]) {
				$tipo_almacenamiento = new SaiaStorage("pdf");
				$carpeta = $formato_ruta . "/pdf";

				$adicional = "";
				$versiones = busca_filtro_tabla("", "documento_version", "documento_iddocumento=" . $this->documento[0]["iddocumento"], "numero_version ASC", $conn);
				if ($versiones["numcampos"]) {
					$adicional = "_V" . $versiones[0]["numero"];
				}
				if ($this->imprimir_vistas) {
					$adicional .= "_vista" . @$_REQUEST["vista"];
				}

				$nombre_pdf = $carpeta . "/" . strtoupper($prefijo_nombre . $this->formato[0]["nombre"]) . "_" . $this->documento[0]["numero"] . "_" . str_replace("-", "_", $this->documento[0]["fecha1"]) . $adicional . ".pdf";
			} else {
				$tipo_almacenamiento = new SaiaStorage("archivos");
				$nombre_pdf = $this->documento[0]["numero"] . "_" . str_replace("-", "_", $this->documento[0]["fecha1"]) . ".pdf";
			}
			$paginas_pdf = 0;
			if ($this->documento[0]["estado"] != 'ACTIVO' || $this->formato[0]["mostrar_pdf"] == 1) {
				$actualizar_y_hash = true;
			}
			$ruta_pdf = array(
				"servidor" => $tipo_almacenamiento->get_ruta_servidor(),
				"ruta" => $nombre_pdf
			);
			$this->pdf->Output($pdf_temp, $this->tipo_salida);
			$codigo_hash = $tipo_almacenamiento->almacenar_recurso($nombre_pdf, $pdf_temp, $actualizar_y_hash);
			//if ($actualizar_y_hash) {
			$sqlu = "update documento set paginas='" . $paginas_pdf . "',pdf='" . json_encode($ruta_pdf) . "',pdf_hash='" . $codigo_hash . "' where iddocumento=" . $this->documento[0]["iddocumento"];
			phpmkr_query($sqlu) or die($sqlu);
			//}
		}
	}

	public function configurar_encabezado()
	{
		global $conn;
		/*Marca de agua, no sirve para PDFA/
		   /*if ($this -> documento[0]["estado"] == "ACTIVO") {
		        $this -> pdf -> SetWatermarkImage('imagenes/marca_agua_borrador.png');
		        $this -> pdf ->showWatermarkImage = true;
		    }
		    if ($this -> documento[0]["estado"] == "ANULADO") {
		        $this -> pdf -> SetWatermarkImage('imagenes/marca_agua_anulado.png');
		        $this -> pdf ->showWatermarkImage = true;
		    }*/

		if ($this->formato[0]["encabezado"]) {
			$encabezado = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato=" . $this->formato[0]["encabezado"], "", $conn);
			if ($encabezado["numcampos"]) {
				//$this -> pdf ->setHeader('{PAGENO}');
				//$this -> pdf ->setHeader('Pagina {PAGENO} de {nbpg}');
				$header = crear_encabezado_pie_pagina($encabezado[0]["contenido"], $this->documento[0]["iddocumento"], $this->formato[0]["idformato"], 1);
				$this->pdf->SetHTMLHeader($header, 'O', TRUE);
			}
		}

		if ($this->formato[0]["pie_pagina"]) {
			$pie_pag = busca_filtro_tabla("contenido", "encabezado_formato", "idencabezado_formato=" . $this->formato[0]["pie_pagina"], "", $conn);
			if ($pie_pag["numcampos"]) {
				$this->pdf->SetHTMLFooter(crear_encabezado_pie_pagina($pie_pag[0]["contenido"], $this->documento[0]["iddocumento"], $this->formato[0]["idformato"]), 'O');
			}
		}
	}

	public function imprimir_paginas()
	{
		global $conn;
		if ($this->idpaginas != "") {
			$paginas = busca_filtro_tabla("ruta", "pagina", "consecutivo in(" . $this->idpaginas . ")", "", $conn);
		} else {
			$paginas = busca_filtro_tabla("ruta", "pagina", "id_documento=" . $this->documento[0]["iddocumento"], "", $conn);
		}

		if ($paginas["numcampos"]) {
			$tipo_almacenamiento = new SaiaStorage(RUTA_ARCHIVOS);
			$this->pdf->setJPEGQuality(75);
			for ($i = 0; $i < $paginas["numcampos"]; $i++) {
				$ruta_pag = json_decode($paginas[$i]["ruta"]);
				$this->pdf->startPageGroup();
				$this->pdf->AddPage();
				if (is_object($ruta_pag)) {
					if ($tipo_almacenamiento->get_filesystem()->has($ruta_pag->ruta)) {
						$archivo_binario = ltrim(StorageUtils::get_binary_file($paginas[$i]["ruta"]), "@");
						$pos = strpos($archivo_binario, ";base64,");
						if ($pos !== false) {
							$pos = intval($pos) + 8;
							$archivo_binario = substr($archivo_binario, $pos);
						}
						$imgdata = base64_decode($archivo_binario);
						$this->pdf->Image('@' . $imgdata, $this->margenes["izquierda"], $this->margenes["superior"], 0, 0, 'JPG', '', '', false, 300, '', false, false, 0, false, false, true);
					}
				} else if (is_file($paginas[$i]["ruta"])) {
					chmod($paginas[$i]["ruta"], 0777);
					$this->pdf->Image($paginas[$i]["ruta"], $this->margenes["izquierda"], $this->margenes["superior"], 0, 0, 'JPG', '', '', false, 300, '', false, false, 0, false, false, true);
				}
			}
		}
	}

	public function extraer_contenido($iddocumento, $vista = 0)
	{
		global $conn;
		$mh = curl_multi_init();
		$ch = curl_init();
		$direccion = array();
		$idfunc_crypto = encrypt_blowfish($_SESSION["idfuncionario"], LLAVE_SAIA_CRYPTO);
		if ($_REQUEST["url"]) {
			$request_url = str_replace('.php', '.php?1=1', $_REQUEST['url']);
			$direccion[] = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/" . str_replace('|', '&', $request_url);
		} else {
			$datos_formato = busca_filtro_tabla("papel,orientacion,nombre,nombre_tabla,ruta_mostrar,idformato", "formato,documento", "lower(plantilla)=nombre and iddocumento=" . $iddocumento, "", $conn);
			$datos_plantilla = busca_filtro_tabla("", $datos_formato[0]["nombre_tabla"], "documento_iddocumento=" . $iddocumento, "", $conn);
			if ($vista > 0) {
				$datos_vista = busca_filtro_tabla("", "vista_formato", "idvista_formato=" . $vista, "", $conn);
				$url = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/" . FORMATOS_CLIENTE . $datos_formato[0]["nombre"] . "/" . $datos_vista[0]["ruta_mostrar"] . "?";
				$queryParams = http_build_query([
					'tipo' => 5,
					'iddoc' => $datos_plantilla[0]["documento_iddocumento"]
				]);

				$direccion[] = $url . $queryParams;
			} elseif ($datos_formato[0]["nombre"] == "carta") {
				$destinos = explode(",", $datos_plantilla[0]["destinos"]);
				foreach ($destinos as $fila) {
					$url = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/" . FORMATOS_CLIENTE . $datos_formato[0]["nombre"] . "/" . $datos_formato[0]["ruta_mostrar"] . "?";
					$queryParams = http_build_query([
						'tipo' => 5,
						'iddoc' => $datos_plantilla[0]["documento_iddocumento"],
						'destino' => $fila
					]);
					$direccion[] = $url . $queryParams;
				}
			} else {
				$url = PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/" . FORMATOS_CLIENTE . $datos_formato[0]["nombre"] . "/" . $datos_formato[0]["ruta_mostrar"] . "?";
				$queryParams = http_build_query([
					'tipo' => 5,
					'iddoc' => $datos_plantilla[0]["documento_iddocumento"]
				]);
				$direccion[] = $url . $queryParams;
			}
		}
		$userId = SessionController::getValue('idfuncionario');
		$Funcionario = new Funcionario($userId);
		foreach ($direccion as $fila) {
			$fila .= "&" . http_build_query([
				"font_size" => $this->font_size,
				"token" => FuncionarioController::generateToken($Funcionario, 5, true),
				"key" => $userId
			]);

			if (strpos(PROTOCOLO_CONEXION, 'https') !== false) {
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			}
			curl_setopt($ch, CURLOPT_URL, $fila);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$contenido = curl_exec($ch);

			$contenido = str_replace("../../../images", PROTOCOLO_CONEXION . RUTA_PDF_LOCAL . "/../images", $contenido);
			$contenido = str_replace("<pagebreak/>", "<br pagebreak=\"true\"/>", $contenido);
			$contenido = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $contenido);
			$contenido = preg_replace('#onclick="(.*?)"#is', '', $contenido);

			if ($datos_formato[0]["orientacion"]) {
				$datos_formato[0]["orientacion"] = "L";
			} else {
				$datos_formato[0]["orientacion"] = "P";
			}
			$this->pdf->AddPage($datos_formato[0]["orientacion"], $datos_formato[0]["papel"]);
			$this->pdf->writeHTML(stripslashes($contenido), 0);
		}
		curl_close($ch);
	}

	public function vincular_anexos()
	{
		global $conn;
		$anexos = busca_filtro_tabla("", "anexos", "documento_iddocumento=" . $this->documento[0]["iddocumento"], "", $conn);
		if ($anexos["numcampos"]) {
			for ($i = 0; $i < $anexos["numcampos"]; $i++) {
				$this->pdf->Annotation(10, 5, 5, 5, "Anexos digitales", array(
					'Subtype' => 'FileAttachment',
					'Name' => $anexos[$i]["etiqueta"],
					'FS' => $anexos[$i]["ruta"]
				));
			}
		}
	}

	public function imprimir_hijos()
	{
		$hijos = explode(",", $this->idhijos);
		foreach ($hijos as $fila) {
			$this->extraer_contenido($fila);
		}
	}

	public function renombrar_pdf_actual()
	{
		if ($this->documento[0]["pdf"] != "") {
			$nombre = $this->documento[0]["pdf"];
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
			phpmkr_query("update documento set pdf='' where iddocumento=" . $this->documento[0]["iddocumento"]);
			$this->documento[0]["pdf"] = "";
		}
	}

	public function set_variable($campo, $valor)
	{
		$this->$campo = $valor;
	}
	function TotalPaginas()
	{
		return count($this->pages);
	}
}

if (@$_REQUEST["iddoc"]) {
	$pdf = new Imprime_Pdf($_REQUEST["iddoc"]);
	$pdf->configurar_pagina($_REQUEST);
	$pdf->imprimir();
} elseif ($_REQUEST["url"]) {
	$pdf = new Imprime_Pdf("url");
	$pdf->configurar_pagina($_REQUEST);
	$pdf->imprimir();
}
