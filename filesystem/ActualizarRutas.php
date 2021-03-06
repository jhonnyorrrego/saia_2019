<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
$prefijo_ruta = TIPO_ALM;
$actualizacion = new ActualizarRutas($prefijo_ruta);
$actualizacion -> actualizar_rutas();

class ActualizarRutas {
	private $qry_upd = "update %s set %s='%s' where %s=%s";
	private $prefijo_ruta;
	private $tablas = array(
		"anexos" => array("ruta"),
		"anexos_despacho" => array("ruta"),
		"anexos_version" => array("ruta"),
		"caja" => array("ruta_qr"),
		"configuracion" => array("valor"),
		"contenidos_carrusel" => array("imagen"),
		"dependencia" => array("logo"),
		"documento" => array("pdf"),
		"documento_verificacion" => array("ruta_qr"),
		"expediente" => array("ruta_qr"),
		"funcionario" => array(
			"foto_original",
			"foto_recorte"
		),
		"noticia_index" => array("imagen"),
		"pagina" => array(
			"ruta",
			"imagen"
		),
		"paso_acitividad_anexo" => array("ruta"),
		"tareas_listado_anexos" => array("ruta"),
		"version_anexos" => array("ruta"),
		"version_documento" => array("pdf"),
		"version_pagina" => array(
			"ruta",
			"ruta_miniatura"
		)
	);

	public function __construct($prefijo_ruta, $tablas = null) {
		$this -> prefijo_ruta = $prefijo_ruta;
		if ($tablas) {
			$this -> tablas = $tablas;
		}
	}

	public function actualizar_rutas() {
		
		$actualizados = 0;
		foreach ($this->tablas as $tabla => $campos) {
			foreach ($campos as $campo) {
				$key = "id$tabla";
				if ($tabla == "pagina") {
					$key = "consecutivo";
				}

				$cond_extra = "";
				if ($tabla == "configuracion") {
					$cond_extra = " AND nombre='logo'";
				}
				$datos = busca_filtro_tabla("$key, $campo", $tabla, "$campo not like '{%'" . $cond_extra, "");
				// print_r($datos);die();
				if ($datos["numcampos"]) {
					for ($i = 0; $i < $datos["numcampos"]; $i++) {
						$valor_origen = $datos[$i][$campo];
						$output_array = array();
						$ruta_alm = "almacenamiento";
						if (preg_match("#(\.\./)+(almacenamiento[0-9]*)/#", $valor_origen, $output_array)) {
							$ruta_alm = $output_array[2];
						}
						$arr_ruta = preg_split("#(\.\./)+almacenamiento[0-9]*/#", $valor_origen, null, PREG_SPLIT_NO_EMPTY);
						// {"servidor":"local:///vol1/almacenamiento/","ruta":"APROBADO/2016-11-11/276/pdf/MEMORANDO_54_2016_11_11.pdf"}
						if (count($arr_ruta)) {
							$json = array(
								"servidor" => $this -> prefijo_ruta . $ruta_alm . "/",
								"ruta" => $arr_ruta[0]
							);
							$valor = json_encode($json);
							$qry = sprintf($this -> qry_upd, $tabla, $campo, $valor, $key, $datos[$i][$key]);
							phpmkr_query($qry) or die($qry);
							// echo "$valor_origen => $qry <br>";
							$actualizados++;
						}
					}
				}
			}
		}
		echo "$actualizados registros actualizados";
	}
}