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

require_once ($ruta_db_superior . 'vendor/autoload.php');
require_once 'SaiaTemplateProcessor.php';
date_default_timezone_set('UTC');

use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\SaiaTemplateProcessor;
error_reporting(E_ALL);

if (!defined('CLI')) {
	define('CLI', (PHP_SAPI == 'cli') ? true : false);
	define('EOL', CLI ? PHP_EOL : '<br />');
	define('SCRIPT_FILENAME', basename($_SERVER['SCRIPT_FILENAME'], '.php'));
	define('IS_INDEX', SCRIPT_FILENAME == 'index');
}

class RadicadoWord {

	private $ruta_db_superior;
	private $conn;

	private $iddocumento;
	private $idformato;
	private $campo_word;
	private $campo_combinar;
	public $retorno;
	private $ruta_docx;
	private $ruta_imagen;
	private $temp_fs;

	private $combinar;
	private $archivo_combinar;
	private $alm_comb;
	private $alm_servidor;
	private $ruta_procesar;
	private $ruta_combinar;

	private $ruta_plantilla;
	private $alm_plantilla;
	private $extension;

	public function __construct($idformato, $iddoc, $nom_campo_word, $nom_campo_combinar) {
		global $ruta_db_superior, $conn;

		$this -> ruta_db_superior = $ruta_db_superior;
		$this -> conn = $conn;
		$this -> iddocumento = $iddoc;
		$this -> idformato = $idformato;
		$this -> campo_word = $nom_campo_word;
		$this -> campo_combinar = $nom_campo_combinar;
		$this -> retorno = array(
			"exito" => 0,
			"msn" => ""
		);
		$this -> ruta_docx = '';
		$this -> ruta_imagen = '';
		$this -> combinar = false;
		$this -> archivo_combinar = null;

		$this -> alm_comb = null;
		$this -> alm_servidor = null;
		$this -> ruta_procesar = null;
		$this -> extension = null;
	}

	public function prepare() {
		if ($this -> iddocumento || $this -> idformato) {
			$update = "UPDATE documento SET pdf=NULL,pdf_hash=NULL WHERE iddocumento=" . $this -> iddocumento;
			phpmkr_query($update) or die("Error al actualizar");
			$idcampo_anexo_word = busca_filtro_tabla("idcampos_formato", "campos_formato", "formato_idformato=" . $this -> idformato . " and nombre='" . $this -> campo_word . "'", "", $this -> conn);
			if ($idcampo_anexo_word["numcampos"]) {
				$word = busca_filtro_tabla("ruta", "anexos", "documento_iddocumento=" . $this -> iddocumento . " and campos_formato=" . $idcampo_anexo_word[0]["idcampos_formato"], "", $this -> conn);
				if ($word["numcampos"] == 1) {
					$idcampo_anexo_comb = busca_filtro_tabla("idcampos_formato", "campos_formato", "formato_idformato=" . $this -> idformato . " and nombre='" . $this -> campo_combinar . "'", "", $this -> conn);
					if ($idcampo_anexo_comb["numcampos"]) {
						$arch_comb = busca_filtro_tabla("ruta", "anexos", "documento_iddocumento=" . $this -> iddocumento . " and campos_formato=" . $idcampo_anexo_comb[0]["idcampos_formato"], "", $this -> conn);
						$ok = 1;
						if ($arch_comb['numcampos'] == 1) {
							$this -> ruta_combinar = StorageUtils::obtener_tempdir();
							$this -> alm_comb = StorageUtils::resolver_ruta($arch_comb[0]["ruta"]);
							$combinar_file = $this -> alm_comb["clase"] -> get_filesystem() -> get($this -> alm_comb["ruta"]);
							$this -> extension = strtolower(pathinfo($this -> alm_comb["ruta"], PATHINFO_EXTENSION));
							$this -> archivo_combinar = $this -> ruta_combinar . "/tmp_archivo." . $this -> extension;
							file_put_contents($this -> archivo_combinar, $combinar_file -> getContent());
							$this -> combinar = true;
						} else if ($arch_comb['numcampos'] > 1) {
							$ok = 0;
						}
						if ($ok) {
							$arr_ruta_w = StorageUtils::resolver_ruta($word[0]["ruta"]);
							$this -> temp_fs = StorageUtils::get_memory_filesystem("tmp_docx", "saia");
							$this -> ruta_docx = "saia://tmp_docx/docx/";
							$this -> ruta_imagen = "saia://tmp_docx/firma_temp/";

							if (!$arr_ruta_w["error"]) {
								$this -> ruta_plantilla = $arr_ruta_w["ruta"];
								$this -> alm_plantilla = $arr_ruta_w["clase"];
								$this -> alm_servidor = $arr_ruta_w["servidor"];

								$archivo_plantilla = $this -> alm_plantilla -> get_filesystem() -> get($this -> ruta_plantilla);
								$this -> ruta_procesar = $this -> ruta_docx . basename($archivo_plantilla -> getName());

								if (!$this -> temp_fs -> write("docx/" . basename($archivo_plantilla -> getName()), $archivo_plantilla -> getContent(), true)) {
									$this -> retorno["msn"] = "No se pudo copiar el archivo: " . basename($archivo_plantilla -> getName());
								} else {
									$this -> retorno["exito"] = 1;
								}
							} else {
								$this -> retorno["msn"] = $arr_ruta_w["mensaje"];
							}
						} else {
							$this -> retorno["msn"] = "Existen varios archivos " . $this -> extension . " cargados";
						}
					} else {
						$this -> retorno["msn"] = "No existe el idcampo " . $this -> campo_combinar;
					}
				} else if ($word["numcampos"] > 1) {
					$this -> retorno["msn"] = "Existen varios archivos word cargados";
				} else {
					$this -> retorno["msn"] = "No existe el archivo de word";
				}
			} else {
				$this -> retorno["msn"] = "No existe el idcampo " . $this -> campo_word;
			}

		} else {
			$this -> retorno["msn"] = "NO existe el identificador del documento o formato (iddoc-idformato)";
		}
	}

	public function generar_pdf_word() {
		require_once ($this -> ruta_db_superior . "pantallas/lib/librerias_cripto.php");
		$this -> retorno["exito"] = 0;
		$templateProcessor = new SaiaTemplateProcessor($this -> ruta_procesar);
		$this -> templateProcessor = $templateProcessor;
		$campos_word = $templateProcessor -> getVariables();
		if (count($campos_word)) {
			$funciones_ejecutar = array(
				'espacio_firma',
				'logo_empresa',
				'ciudad_fecha',
				'nombre_formato',
				'formato_numero',
				'elaborado_por',
				'codigo_qr'
			);
			$estado_marca_agua = array(
				"ACTIVO",
				"ANULADO"
			);
			$estados_aprob = array(
				"APROBADO",
				"GESTION",
				"HISTORICO"
			);
			$espacio_firma = 0;
			if (!in_array("espacio_firma", $campos_word)) {
				$campos_word[] = "espacio_firma";
				$espacio_firma = 1;
			}
			$datos_doc = busca_filtro_tabla("ejecutor,estado,numero," . fecha_db_obtener('fecha', 'Y-m-d') . " as fecha", "documento", "iddocumento=" . $this -> iddocumento, "", $this -> conn);
			$datos_for = busca_filtro_tabla("etiqueta", "formato", "idformato=" . $this -> idformato, "", $this -> conn);
			for ($i = 0; $i < count($funciones_ejecutar); $i++) {
				$nombre = $funciones_ejecutar[$i];
				if (in_array($nombre, $campos_word)) {
					switch ($nombre) {
						case 'elaborado_por' :
							$elaborador_por = "";
							$ejecutor = busca_filtro_tabla("nombres,apellidos", "funcionario", "funcionario_codigo=" . $datos_doc[0]['ejecutor'], "", $this -> conn);
							if ($ejecutor["numcampos"]) {
								$elaborador_por = ucwords(strtolower(codifica_encabezado(html_entity_decode($ejecutor[0]['nombres'] . ' ' . $ejecutor[0]['apellidos']))));
							}
							$templateProcessor -> setValue('elaborado_por', $elaborador_por);
							break;

						case 'logo_empresa' :
							$logo_empresa = busca_filtro_tabla("valor", "configuracion", "nombre='logo'", "", $this -> conn);
							$ruta_logo = $ruta_db_superior . $logo_empresa[0]['valor'];
							$img = array( array(
									'img' => htmlspecialchars($ruta_logo),
									'size' => array(
										170,
										100
									)
								));
							$templateProcessor -> setImg('logo_empresa', $img);
							break;
						case 'ciudad_fecha' :
							$cadena = "";
							$config_ciudad = busca_filtro_tabla("valor", "configuracion", "nombre='ciudad'", "", $this -> conn);
							$ciudad = busca_filtro_tabla("nombre", "municipio", "idmunicipio=" . $config_ciudad[0]['valor'], "", $this -> conn);
							if ($ciudad["numcampos"]) {
								$cadena = html_entity_decode($ciudad[0]['nombre']);
							}
							$cadena .= fecha($datos_doc[0]["fecha"]);
							$templateProcessor -> setValue('ciudad_fecha', $cadena);
							break;
						case 'nombre_formato' :
							$templateProcessor -> setValue('nombre_formato', $datos_for[0]['etiqueta']);
							break;
						case 'espacio_firma' :
							$ruta = busca_filtro_tabla("tipo_origen,origen,idruta", "ruta", "obligatorio=1 AND condicion_transferencia='POR_APROBAR' AND tipo='ACTIVO' AND documento_iddocumento=" . $this -> iddocumento, "idruta asc", $this -> conn);
							$ruta_revisado = busca_filtro_tabla("tipo_origen,origen,idruta", "ruta", "obligatorio=2 AND condicion_transferencia='POR_APROBAR' AND tipo='ACTIVO' AND documento_iddocumento=" . $this -> iddocumento, "idruta asc", $this -> conn);
							if (!$ruta['numcampos'] && !$ruta_revisado['numcampos']) {
								$ninguno_firma = busca_filtro_tabla("", "ruta", "obligatorio=0 AND condicion_transferencia='POR_APROBAR' AND tipo='ACTIVO' AND documento_iddocumento=" . $this -> iddocumento, "", $this -> conn);
								if (!$ninguno_firma['numcampos']) {
									$ruta = busca_filtro_tabla("destino as origen, tipo_destino as tipo_origen, ruta_idruta as idruta", "buzon_entrada", "nombre='POR_APROBAR' AND archivo_idarchivo=" . $this -> iddocumento, "", $this -> conn);
								}
							}
							if ($ruta['numcampos']) {
								$izq = 1;
								$der = 1;
								$filas = 0;
								if ($ruta['numcampos'] % 2 == 0) {//CALCULO FILAS FIRMAN
									$filas = $ruta['numcampos'] / 2;
								} else {
									$filas = ($ruta['numcampos'] + 1) / 2;
								}

								if ($espacio_firma == 0) {
									$templateProcessor -> cloneRow('espacio_firma', $filas);
								} else if (in_array('nombre_funcionario', $campos_word)) {
									$templateProcessor -> cloneRow('nombre_funcionario', $filas);
								}
								for ($j = 0; $j < $ruta['numcampos']; $j++) {
									$firma = '';
									$nombre = '';
									$cargo = '';

									if ($ruta[$j]['tipo_origen'] != 1) {
										$info_funcionario = busca_filtro_tabla("funcionario_codigo,firma,nombres,apellidos,cargo,dependencia", "vfuncionario_dc", "iddependencia_cargo=" . $ruta[$j]['origen'], "", $this -> conn);
									} else {
										$info_funcionario = busca_filtro_tabla("funcionario_codigo,firma,nombres,apellidos,cargo,dependencia", "vfuncionario_dc", "estado_dc=1 and funcionario_codigo=" . $ruta[$j]['origen'], "", $this -> conn);
									}
									$funcionario_codigo = $info_funcionario[0]['funcionario_codigo'];
									$funcionario_codigo_encriptado = substr(encrypt_md5($funcionario_codigo), 0, 10);

									$bzn_salida = busca_filtro_tabla("archivo_idarchivo", "buzon_entrada", "ruta_idruta='" . $ruta[$j]['idruta'] . "' AND archivo_idarchivo=" . $this -> iddocumento . " AND activo=0", "", $this -> conn);
									if ($bzn_salida['numcampos']) {//YA FIRMO
										if (MOTOR == "Oracle") {
											$img = ($info_funcionario[0]["firma"]);
										} elseif (MOTOR == "MySql") {
											$img = $info_funcionario[0]["firma"];
										} else {
											$img = stripslashes(base64_decode($info_funcionario[0]["firma"]));
										}

										$imagen_firma = $this -> ruta_imagen . 'firma_' . $funcionario_codigo . '.jpg';
										if (file_exists($imagen_firma)) {
											unlink($imagen_firma);
										}
										$im = imagecreatefromstring($img);
										imagejpeg($im, $imagen_firma);

										$src = $imagen_firma;
										$img2 = array( array(
												'img' => htmlspecialchars($src),
												'size' => array(
													170,
													100
												)
											));

										$buscar_nombre = 'n_' . $funcionario_codigo_encriptado;
										$nombre = codifica_encabezado(html_entity_decode(strtolower($info_funcionario[0]['nombres'] . ' ' . $info_funcionario[0]['apellidos'])));
										$nombre = ucwords(strtolower($nombre));
										$buscar_cargo = 'c_' . $funcionario_codigo_encriptado;
										$cargo = codifica_encabezado(html_entity_decode($info_funcionario[0]['cargo']));
										$cargo = ucwords(strtolower($cargo));
										$buscar_dependencia = 'd_' . $funcionario_codigo_encriptado;
										$dependencia = codifica_encabezado(html_entity_decode($info_funcionario[0]['dependencia']));

										if ($j % 2 == 0 || $j == 0) {//columna 1
											if ($espacio_firma == 0) {
												$templateProcessor -> setImg('espacio_firma#' . $izq, $img2);
											}
											$templateProcessor -> setValue('nombre_funcionario#' . $izq, htmlspecialchars($nombre));
											$templateProcessor -> setValue('cargo#' . $izq, htmlspecialchars($cargo));
											$templateProcessor -> setValue('nombre_dependencia#' . $izq, htmlspecialchars($dependencia));
											$izq++;
										} else {//columna 2
											if ($espacio_firma == 0) {
												$templateProcessor -> setValue('espacio_firma1#' . $der, htmlspecialchars($firma));
											}
											$templateProcessor -> setValue('nombre_funcionario1#' . $der, htmlspecialchars($nombre));
											$templateProcessor -> setValue('cargo1#' . $der, htmlspecialchars($cargo));
											$templateProcessor -> setValue('nombre_dependencia1#' . $der, htmlspecialchars($dependencia));
											$der++;
										}
										imagedestroy($im);
									} else {
										if ($espacio_firma == 0) {
											$firma = '${f_' . $funcionario_codigo_encriptado . '}';
										}
										$nombre = '${n_' . $funcionario_codigo_encriptado . '}';
										$cargo = '${c_' . $funcionario_codigo_encriptado . '}';
										$dependencia = '${d_' . $funcionario_codigo_encriptado . '}';

										if ($j % 2 == 0 || $j == 0) {//columna 1
											if ($espacio_firma == 0) {
												$templateProcessor -> setValue('espacio_firma#' . $izq, htmlspecialchars($firma));
											}
											$templateProcessor -> setValue('nombre_funcionario#' . $izq, htmlspecialchars($nombre));
											$templateProcessor -> setValue('cargo#' . $izq, htmlspecialchars($cargo));
											$templateProcessor -> setValue('nombre_dependencia#' . $izq, htmlspecialchars($dependencia));
											$izq++;
										} else {//columna 2
											if ($espacio_firma == 0) {
												$templateProcessor -> setValue('espacio_firma1#' . $der, htmlspecialchars($firma));
											}
											$templateProcessor -> setValue('nombre_funcionario1#' . $der, htmlspecialchars($nombre));
											$templateProcessor -> setValue('cargo1#' . $der, htmlspecialchars($cargo));
											$templateProcessor -> setValue('nombre_dependencia1#' . $der, htmlspecialchars($dependencia));
											$der++;
										}
									}

									if (($j + 1) == $ruta['numcampos']) {
										if ($j % 2 == 0) {
											if ($espacio_firma == 0) {
												$templateProcessor -> setValue('espacio_firma1#' . $der, '');
											}
											$templateProcessor -> setValue('nombre_funcionario1#' . $der, '');
											$templateProcessor -> setValue('cargo1#' . $der, '');
											$templateProcessor -> setValue('nombre_dependencia1#' . $der, '');
											$der++;
										}
									}
								}
							} else {
								if ($espacio_firma == 0) {
									$templateProcessor -> setValue('espacio_firma', '');
									$templateProcessor -> setValue('espacio_firma1', '');
								}

								$templateProcessor -> setValue('nombre_funcionario', '');
								$templateProcessor -> setValue('nombre_funcionario1', '');
								$templateProcessor -> setValue('cargo', '');
								$templateProcessor -> setValue('cargo1', '');
								$templateProcessor -> setValue('nombre_dependencia', '');
								$templateProcessor -> setValue('nombre_dependencia1', '');
							}
							//DESAROLLO REVISADO
							if ($ruta_revisado['numcampos']) {
								$revisado = "Revisó: ";
								for ($j = 0; $j < $ruta_revisado['numcampos']; $j++) {
									if ($ruta[$j]['tipo_origen'] != 1) {
										$info_funcionario = busca_filtro_tabla("funcionario_codigo,firma,nombres,apellidos,cargo,dependencia", "vfuncionario_dc", "iddependencia_cargo=" . $ruta_revisado[$j]['origen'], "", $this -> conn);
									} else {
										$info_funcionario = busca_filtro_tabla("funcionario_codigo,firma,nombres,apellidos,cargo,dependencia", "vfuncionario_dc", "estado_dc=1 and funcionario_codigo=" . $ruta_revisado[$j]['origen'], "", $this -> conn);
									}
									$funcionario_codigo = $info_funcionario[0]['funcionario_codigo'];
									$funcionario_codigo_encriptado = substr(encrypt_md5($funcionario_codigo), 0, 10);
									$bzn_salida = busca_filtro_tabla("archivo_idarchivo", "buzon_entrada", "ruta_idruta='" . $ruta_revisado[$j]['idruta'] . "' AND archivo_idarchivo=" . $this -> iddocumento . " AND activo=0", "", $this -> conn);
									if (!$bzn_salida['numcampos']) {
										if (($j + 1) == $ruta_revisado['numcampos']) {
											$revisado .= '${r_' . $funcionario_codigo_encriptado . '}';
										} else {
											$revisado .= '${r_' . $funcionario_codigo_encriptado . '}, ';
										}
									} else {
										$nombre = codifica_encabezado(html_entity_decode($info_funcionario[0]['nombres'] . ' ' . $info_funcionario[0]['apellidos']));
										$nombre = ucwords(strtolower($nombre));
										if (($j + 1) == $ruta_revisado['numcampos']) {
											$revisado .= $nombre;
										} else {
											$revisado .= $nombre . ", ";
										}
									}
								}
								$templateProcessor -> setValue('nombre_revisado', htmlspecialchars($revisado));
							} else {
								$templateProcessor -> setValue('nombre_revisado', '');
							}
							break;
						case 'formato_numero' :
							if (in_array($datos_doc[0]["estado"], $estados_aprob) && $datos_doc[0]['numero']) {
								$templateProcessor -> setValue('formato_numero', $datos_doc[0]['numero']);
							}
							break;
						case 'codigo_qr' :
							if (in_array($datos_doc[0]["estado"], $estados_aprob) && $datos_doc[0]['numero']) {
								$src_qr = $this -> obtener_codigo_qr($this -> idformato, $this -> iddocumento);
								$arr_alm_qr = StorageUtils::resolver_ruta($src_qr);
								$alm_qr = $arr_alm_qr["clase"];
								$archivo_qr = $alm_qr -> get_filesystem() -> get($arr_alm_qr["ruta"]);

								$ext_qr = "." . pathinfo($arr_alm_qr["ruta"], PATHINFO_EXTENSION);
								$src = StorageUtils::obtener_archivo_temporal("qr_");
								file_put_contents($src, $archivo_qr -> getContent());
								rename($src, $src . $ext_qr);
								$src .= $ext_qr;

								$img2 = array( array(
										'img' => htmlspecialchars($src),
										'size' => array(
											100,
											100
										)
									));
								$templateProcessor -> setImg("codigo_qr", $img2);
							}
							break;
					}
				}
			}

			if (in_array($datos_doc[0]["estado"], $estado_marca_agua)) {
				$templateProcessor -> setTextWatermark($datos_doc[0]["estado"]);
			}

			$directorio_out = $this -> ruta_docx;
			$archivo_out = 'documento_word2';
			$extension_doc = '.docx';
			$templateProcessor -> saveAs($directorio_out . $archivo_out . $extension_doc);
			$word_temp = StorageUtils::obtener_archivo_temporal($archivo_out, $_SESSION["ruta_temp_funcionario"]);

			if (copy($directorio_out . $archivo_out . $extension_doc, $word_temp . $extension_doc)) {
				if (file_exists($word_temp . $extension_doc)) {
					$comando = 'export HOME=/tmp && libreoffice5.1 --headless --norestore --invisible --convert-to pdf:writer_pdf_Export --outdir ' . dirname($word_temp) . ' ' . $word_temp . $extension_doc;
					$var = shell_exec($comando);
					$pdf_name = "documento_word2";
					$dir_name = rtrim(dirname($this -> ruta_plantilla), "anexos") . "docx/";
					$pdf = $dir_name . $pdf_name . '.pdf';

					$this -> alm_plantilla -> copiar_contenido_externo($word_temp . ".pdf", $pdf);
					$arr_ruta_pdf = array(
						"servidor" => $this -> alm_servidor,
						"ruta" => $pdf
					);

					$update = "UPDATE documento SET pdf='" . json_encode($arr_ruta_pdf) . "' WHERE iddocumento=" . $this -> iddocumento;
					phpmkr_query($update) or die("Error al actualizar ruta del PDF");

					if ($this -> combinar) {
						$this -> ruta_procesar = $directorio_out . $archivo_out . $extension_doc;
						$this -> combinar_documento();
					}
					$this -> retorno["exito"] = 1;
				} else {
					$this -> retorno["msn"] = "El archivo procesado NO existe";
				}
			} else {
				$this -> retorno["msn"] = "No se pudo copiar el archivo a la temporal";
			}
		} else {
			$this -> retorno["msn"] = "No se encuentra el archivo a procesar";
		}
	}

	private function obtener_codigo_qr() {
		include_once ($this -> ruta_db_superior . "pantallas/qr/librerias.php");
		$ruta = generar_codigo_qr($this -> idformato, $this -> iddocumento);
		if ($ruta["exito"]) {
			return ($ruta["ruta_qr"]);
		} else {
			die("Error al retornar la ruta del QR");
		}
	}

	protected function combinar_documento() {
		$haystack = array(
			"xls",
			"xlsx"
		);
		if (in_array($this -> extension, $haystack)) {
			$datos = $this -> cargar_excel($this -> archivo_combinar);
		} else {
			$datos = $this -> cargar_csv($this -> archivo_combinar);
		}

		$archivo_original = $this -> ruta_procesar;
		$extension_doc = '.docx';

		$i = 0;
		foreach ($datos as $registro) {
			$archivo_out = "documento_word_" . ($i + 1);
			$archivo_copia = $this -> ruta_combinar . "/" . $archivo_out . $extension_doc;
			if (file_exists($archivo_copia)) {
				unlink($archivo_copia);
			}
			if (copy($archivo_original, $archivo_copia)) {
				$templateProcessor = new SaiaTemplateProcessor($archivo_copia);
				$campos_word = $templateProcessor -> getVariables();
				foreach ($registro as $campo => $valor) {
					if (in_array($campo, $campos_word)) {
						$templateProcessor -> setValue($campo, $valor);
					}
				}
				$templateProcessor -> saveAs($archivo_copia);
				$templateProcessor = null;
			}
			$i++;
		}

		if (is_dir($this -> ruta_combinar)) {
			$comando1 = 'export HOME=/tmp && libreoffice5.1 --headless -print-to-file --outdir ' . $this -> ruta_combinar . ' ' . $this -> ruta_combinar . "/*" . $extension_doc;
			$var1 = shell_exec($comando1);
			if (file_exists($this -> ruta_combinar . "/documento_word2.pdf")) {
				unlink($this -> ruta_combinar . "/documento_word2.pdf");
			}
			$entrada_ps = $this -> ruta_combinar . "/*.ps";
			$salida_ps = $this -> ruta_combinar . "/documento_word2.pdf";
			$comando2 = "gs -sDEVICE=pdfwrite -dNOPAUSE -dBATCH -dSAFER -sOutputFile=" . $salida_ps . " " . $entrada_ps;
			$var2 = shell_exec($comando2);

			$dir_name = rtrim(dirname($this -> ruta_plantilla), "anexos");
			$dir_name .= "docx/";
			$this -> alm_plantilla -> copiar_contenido_externo($salida_ps, $dir_name . "documento_word2.pdf");
			return true;
		}
	}

	private function cargar_csv($inputFileName) {
		$resp = array();
		$fila = 1;
		$header = array();
		$head_size = -1;
		if (($gestor = fopen($inputFileName, "r")) !== FALSE) {
			while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
				if ($fila == 1) {
					$header = $datos;
					$head_size = count($datos);
					$fila++;
					continue;
				}
				$numero = count($datos);
				if ($numero > $head_size) {
					$mensaje = "CSV: Cantidad de datos excede el n&uacute;mero de campos (" . $numero . " > " . $head_size . ") en la línea " . $fila;
					die($mensaje);
				}
				$fila++;
				$campos_fila = array();
				for ($c = 0; $c < $numero; $c++) {
					$campos_fila[$header[$c]] = $datos[$c];
				}
				$resp[] = $campos_fila;
			}
			fclose($gestor);
		}
		return $resp;
	}

	private function cargar_excel($inputFileName) {
		include_once ($this -> ruta_db_superior . "pantallas/busquedas/PHPExcel/funciones_excelphp.php");
		$array = Excelphp::leer_archivo_excel($inputFileName, array(3));
		unset($array[1]);
		return $array;
	}

}
?>