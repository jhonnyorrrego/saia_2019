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
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo estilo_bootstrap();
usuario_actual("id");

if (isset($_REQUEST["ok"])) {
	global $conn, $dep_vinc, $perm_dep, $perm_car;
	include_once ($ruta_db_superior . "pantallas/busquedas/PHPExcel/funciones_excelphp.php");
	$error = 0;
	$html_error = "";
	$tvd = ($_REQUEST["tvd"] == 1) ? 1 : 0;
	$omitir = ($_REQUEST["omitir_fila"] == 1) ? 2 : 0;
	$dep_vinc = ($_REQUEST["dep_vinculada"] == "codigo") ? "codigo" : "iddependencia";
	$perm_dep = ($_REQUEST["permiso_dependencia"] == "codigo") ? "codigo" : "iddependencia";
	$perm_car = ($_REQUEST["permiso_cargo"] == "codigo_cargo") ? "codigo_cargo" : "idcargo";
	$equivalencia_campos = array(
		0 => "codigo",
		1 => "nombre",
		2 => "codigo_dependencia",
		3 => "tipo",
		4 => "codigo_serie_padre",
		5 => "dias_entrega",
		6 => "retencion_gestion",
		7 => "retencion_central",
		8 => "conservacion",
		9 => "digitalizacion",
		10 => "seleccion",
		11 => "eliminacion",
		12 => "procedimiento",
		13 => "copia",
		14 => "codigos_permiso_cargo",
		15 => "codigos_permiso_dependencia"
	);

	if (is_uploaded_file($_FILES["anexo"]["tmp_name"])) {
		$sql_delete = "uploads/serie_delete_" . date("YmdHis") . ".sql";

		$extension = pathinfo($_FILES["anexo"]["name"], PATHINFO_EXTENSION);
		$name = "excel." . $extension;
		$val = move_uploaded_file($_FILES["anexo"]["tmp_name"], "uploads/" . $name);
		if ($val) {
			$array = Excelphp::leer_archivo_excel("uploads/" . $name, array(4), $equivalencia_campos);
			$cant_reg = count($array);
			if ($cant_reg) {
				$columnas = count($array[1]);
				if (count($array[1]) == 16) {
					if ($_REQUEST["vaciar"] == 1) {
						$truncar = "TRUNCATE TABLE serie";
						$conn -> Ejecutar_Sql($truncar);
						$truncar = "TRUNCATE TABLE entidad_serie";
						$conn -> Ejecutar_Sql($truncar);
						$truncar = "TRUNCATE TABLE permiso_serie";
						$conn -> Ejecutar_Sql($truncar);
					} else {
						$maxidserie = busca_filtro_tabla("max(idserie) as maxidserie", "serie", "", "", $conn);
						$maxidentidad_serie = busca_filtro_tabla("max(identidad_serie) as maxentidad_serie", "entidad_serie", "", "", $conn);
						$maxidpermiso_serie = busca_filtro_tabla("max(idpermiso_serie) as maxpermiso_serie", "permiso_serie", "", "", $conn);
					}
					$handle = fopen($sql_delete, "a+");
					for ($i = $omitir; $i < $cant_reg; $i++) {
						fwrite($handle, "Registro # " . $i . ":" . "\r");
						$resp = validar_campos($array[$i], $i);
						if ($resp["exito"]) {
							$campos_serie = $resp["data"];
							$campos_serie["tvd"] = $tvd;
							$insert = "INSERT INTO serie (" . implode(",", array_keys($campos_serie)) . ") VALUES (" . implode(",", array_values($campos_serie)) . ")";
							phpmkr_query($insert) or die("Error al insertar " . $insert);
							$idserie = phpmkr_insert_id();
							fwrite($handle, $insert . ";" . "\r");
							fwrite($handle, "DELETE FROM serie WHERE idserie=" . $idserie . ";" . "\r");

							$campos_entidad_serie = $resp["entidad_serie"];
							$cant_entidad_serie = count($campos_entidad_serie);
							for ($j = 0; $j < $cant_entidad_serie; $j++) {
								$campos_entidad_serie[$j]["serie_idserie"] = $idserie;
								$insert_entidad_serie = "INSERT INTO entidad_serie (" . implode(",", array_keys($campos_entidad_serie[$j])) . ") VALUES (" . implode(",", array_values($campos_entidad_serie[$j])) . ")";
								phpmkr_query($insert_entidad_serie) or die("Error al insertar " . $insert_entidad_serie);
								$identidad_serie = phpmkr_insert_id();
								fwrite($handle, $insert_entidad_serie . ";" . "\r");
								fwrite($handle, "DELETE FROM entidad_serie WHERE identidad_serie=" . $identidad_serie . ";" . "\r");
							}

							$campos_permiso_serie = $resp["permiso_serie"];
							$cant_permiso_serie = count($campos_permiso_serie);
							for ($j = 0; $j < $cant_permiso_serie; $j++) {
								$campos_permiso_serie[$j]["serie_idserie"] = $idserie;
								$insert_permiso_serie = "INSERT INTO permiso_serie (" . implode(",", array_keys($campos_permiso_serie[$j])) . ") VALUES (" . implode(",", array_values($campos_permiso_serie[$j])) . ")";
								phpmkr_query($insert_permiso_serie) or die("Error al insertar " . $insert_permiso_serie);
								$idpermiso_serie = phpmkr_insert_id();
								fwrite($handle, $insert_permiso_serie . ";" . "\r");
								fwrite($handle, "DELETE FROM entidad_serie WHERE identidad_serie=" . $idpermiso_serie . ";" . "\r");
							}

						} else {
							$error = 1;
							$html_error .= $resp["msn"];
							if ($_REQUEST["vaciar"] == 1) {
								$truncar = "TRUNCATE TABLE serie";
								$conn -> Ejecutar_Sql($truncar);
								$truncar = "TRUNCATE TABLE entidad_serie";
								$conn -> Ejecutar_Sql($truncar);
								$truncar = "TRUNCATE TABLE permiso_serie";
								$conn -> Ejecutar_Sql($truncar);
							} else {
								$delete = "DELETE FROM serie WHERE idserie>" . $maxidserie[0]["maxidserie"];
								$conn -> Ejecutar_Sql($delete);
								$delete = "DELETE FROM entidad_serie WHERE identidad_serie>" . $maxidentidad_serie[0]["maxentidad_serie"];
								$conn -> Ejecutar_Sql($delete);
								$delete = "DELETE FROM permiso_serie WHERE idpermiso_serie>" . $maxidpermiso_serie[0]["maxpermiso_serie"];
								$conn -> Ejecutar_Sql($delete);
							}
							break;
						}
						fwrite($handle, "Termina # " . $i . ":" . "\r\r");
					}
					fclose($handle);
				} else {
					$error = 1;
					$html_error .= "<li>Deben ser 16 columnas y actualmente hay " . $columnas . "</li>";
				}
			} else {
				$error = 1;
				$html_error .= "<li>El excel no tiene registros</li>";
			}
		} else {
			$error = 1;
			$html_error .= "<li>No se pudo mover el excel a la ruta especificada</li>";
		}
	} else {
		$error = 1;
		$html_error .= "<li>No se encontro el Excel</li>";
	}
	if ($error) {
		$html = '<span style="color:red">Se encontraron los siguientes errores:</span><ul>' . $html_error . '</ul>';
	} else {
		$html = '<span style="color:green">Se cargaron todas las series sin ningun problema</span>';
	}
	echo $html;
}

function validar_campos($datos, $fila) {
	global $conn, $dep_vinc, $perm_dep, $perm_car;
	$retorno = array(
		"exito" => 1,
		"msn" => "",
	);
	$default = array(
		"dias_entrega" => 8,
		"retencion_gestion" => 3,
		"retencion_central" => 5,
	);
	$arrayTipo = array(
		"SERIE" => 1,
		"SUBSERIE" => 2,
		"TIPO" => 3
	);

	$campos_serie = array();
	$serie = busca_filtro_tabla("idserie", "serie", "codigo=" . trim($datos["codigo"]), "", $conn);
	if (!$serie["numcampos"]) {
		$campos_serie["nombre"] = "'" . str_replace("'", "''", trim($datos["nombre"])) . "'";
		$campos_serie["codigo"] = "'" . trim($datos["codigo"]) . "'";

		if (trim($datos["conservacion"]) != "" && trim($datos["eliminacion"]) != "") {
			$retorno["exito"] = 0;
			$retorno["msn"] .= "<li>Registro # " . $fila . ": Solo debe seleccionar uno de los dos conservacion/eliminacion</li>";
		} elseif (trim($datos["conservacion"])) {
			$campos_serie["conservacion"] = "'TOTAL'";
		} elseif (trim($datos["eliminacion"])) {
			$campos_serie["conservacion"] = "'ELIMINACION'";
		} else {
			$campos_serie["conservacion"] = "NULL";
		}

		$tipo_cod_padre = 0;
		if ($datos["codigo_serie_padre"] === 0) {
			$campos_serie["cod_padre"] = 0;
		} else if ($datos["codigo_serie_padre"]) {
			$cod_padre = busca_filtro_tabla("idserie,tipo", "serie", "codigo='" . trim($datos["codigo_serie_padre"]) . "'", "", $conn);
			if ($cod_padre["numcampos"]) {
				if ($cod_padre["numcampos"] == 1) {
					$campos_serie["cod_padre"] = $cod_padre[0]["idserie"];
					$tipo_cod_padre = $cod_padre[0]["tipo"];
				} else {
					$retorno["exito"] = 0;
					$retorno["msn"] .= "<li>Registro # " . $fila . ": El codigo " . $datos["codigo_serie_padre"] . " se encuentra " . $cod_padre["numcampos"] . " veces en la DB</li>";
				}
			} else {
				$retorno["exito"] = 0;
				$retorno["msn"] .= "<li>Registro # " . $fila . ": No se encuentra el codigo " . $datos["codigo_serie_padre"] . "</li>";
			}
		} else {
			$campos_serie["cod_padre"] = 0;
		}
		$dias_entrega = intval($datos["dias_entrega"]);
		if ($dias_entrega) {
			$campos_serie["dias_entrega"] = $dias_entrega;
		} else {
			$campos_serie["dias_entrega"] = $default["dias_entrega"];
		}

		$ret_gest = intval($datos["retencion_gestion"]);
		if ($ret_gest) {
			$campos_serie["retencion_gestion"] = $ret_gest;
		} else {
			$campos_serie["retencion_gestion"] = $default["retencion_gestion"];
		}

		$ret_cent = intval($datos["retencion_central"]);
		if ($ret_cent) {
			$campos_serie["retencion_central"] = $ret_cent;
		} else {
			$campos_serie["retencion_central"] = $default["retencion_central"];
		}

		if (trim($datos["digitalizacion"])) {
			$campos_serie["digitalizacion"] = 1;
		} else {
			$campos_serie["digitalizacion"] = 0;
		}

		if (trim($datos["seleccion"])) {
			$campos_serie["seleccion"] = 1;
		} else {
			$campos_serie["seleccion"] = 0;
		}

		if (trim($datos["procedimiento"])) {
			$campos_serie["procedimiento"] = "'" . str_replace("'", "''", trim($datos["procedimiento"])) . "'";
		} else {
			$campos_serie["procedimiento"] = 'NULL';
		}

		if (trim($datos["copia"])) {
			$campos_serie["copia"] = 1;
		} else {
			$campos_serie["copia"] = 0;
		}

		$tipo = strtoupper(trim($datos["tipo"]));
		if ($tipo) {
			if (in_array($tipo, array_keys($arrayTipo))) {
				$campos_serie["tipo"] = $arrayTipo[$tipo];

				if ($campos_serie["tipo"] == 1 && $campos_serie["cod_padre"] != 0) {
					$retorno["exito"] = 0;
					$retorno["msn"] .= "<li>Registro # " . $fila . ": El registro es clase (SERIE) y NO puede estar vinculado a un registro padre</li>";
				} else if ($campos_serie["tipo"] == 2) {
					if ($campos_serie["cod_padre"] == 0 || $tipo_cod_padre != 1) {
						$retorno["exito"] = 0;
						$retorno["msn"] .= "<li>Registro # " . $fila . ": El registro es clase (SUBSERIE) y debe estar vinculado a una clase (SERIE)</li>";
					}
				} elseif ($campos_serie["tipo"] == 3) {
					if ($campos_serie["cod_padre"] == 0 || $tipo_cod_padre == 3) {
						$retorno["exito"] = 0;
						$retorno["msn"] .= "<li>Registro # " . $fila . ": El registro es clase (TIPO) y debe estar vinculado a un registro padre, el padre debe ser clase (SERIE-SUBSERIE)</li>";
					}
				}

			} else {
				$retorno["exito"] = 0;
				$retorno["msn"] .= "<li>Registro # " . $fila . ": Debe registrar la clase (Serie,subserie,tipo), la registrada no aplica (" . $tipo . ")</li>";
			}
		} else {
			$retorno["exito"] = 0;
			$retorno["msn"] .= "<li>Registro # " . $fila . ": Debe registrar la clase (Serie,subserie,tipo)</li>";
		}
		$campos_serie["estado"] = 1;
		$campos_serie["categoria"] = 2;

		if ($retorno["exito"]) {
			$dependencias_vinc = array_filter(explode(",", $datos["codigo_dependencia"]), "strlen");
			if (count($dependencias_vinc)) {
				$entidad_serie = array();
				$i = 0;
				foreach ($dependencias_vinc as $id) {
					if ($dep_vinc == "codigo") {
						$iddep = busca_filtro_tabla("iddependencia", "dependencia", "codigo='" . trim($id) . "'", "", $conn);
						if ($iddep["numcampos"]) {
							if ($iddep["numcampos"] == 1) {
								$iddependencia = $iddep[0]["iddependencia"];
							} else {
								$retorno["exito"] = 0;
								$retorno["msn"] .= "<li>Registro # " . $fila . ": La dependencia con codigo " . trim($id) . " esta registrada " . $iddep["numcampos"] . " veces</li>";
								break;
							}
						} else {
							$retorno["exito"] = 0;
							$retorno["msn"] .= "<li>Registro # " . $fila . ": No se encontro la dependencia con codigo " . trim($id) . "</li>";
							break;
						}
					} else {
						$iddependencia = $id;
					}
					$entidad_serie[$i]["entidad_identidad"] = 2;
					$entidad_serie[$i]["llave_entidad"] = $iddependencia;
					$entidad_serie[$i]["estado"] = 1;
					$entidad_serie[$i]["tipo"] = 0;
					$i++;
				}
				$retorno["entidad_serie"] = $entidad_serie;
			} else {
				$retorno["exito"] = 0;
				$retorno["msn"] .= "<li>Registro # " . $fila . ": Debe ingresar los codigos para vincular el registro a la dependencia</li>";
			}

			if ($retorno["exito"]) {
				$permiso_serie = array();
				$i = 0;
				$cod_perm_dep = array_filter(explode(",", $datos["codigos_permiso_dependencia"]), "strlen");
				if (count($cod_perm_dep)) {
					foreach ($cod_perm_dep as $id) {
						if ($perm_dep == "codigo") {
							$iddep = busca_filtro_tabla("iddependencia", "dependencia", "codigo='" . trim($id) . "'", "", $conn);
							if ($iddep["numcampos"]) {
								if ($iddep["numcampos"] == 1) {
									$iddependencia = $iddep[0]["iddependencia"];
								} else {
									$retorno["exito"] = 0;
									$retorno["msn"] .= "<li>Registro # " . $fila . ": La dependencia con codigo " . trim($id) . " esta registrada " . $iddep["numcampos"] . " veces</li>";
									break;
								}
							} else {
								$retorno["exito"] = 0;
								$retorno["msn"] .= "<li>Registro # " . $fila . ": No se encontro la dependencia con codigo " . trim($id) . "</li>";
								break;
							}
						} else {
							$iddependencia = $id;
						}
						$permiso_serie[$i]["entidad_identidad"] = 2;
						$permiso_serie[$i]["llave_entidad"] = $iddependencia;
						$permiso_serie[$i]["estado"] = 1;
						$i++;
					}
				}

				if ($retorno["exito"]) {
					$cod_perm_cargo = array_filter(explode(",", $datos["codigos_permiso_cargo"]), "strlen");
					if (count($cod_perm_cargo)) {
						foreach ($cod_perm_cargo as $id) {
							if ($perm_car == "codigo_cargo") {
								$idcar = busca_filtro_tabla("idcargo", "cargo", "codigo_cargo='" . trim($id) . "'", "", $conn);
								if ($idcar["numcampos"]) {
									if ($idcar["numcampos"] == 1) {
										$idcargo = $idcar[0]["idcargo"];
									} else {
										$retorno["exito"] = 0;
										$retorno["msn"] .= "<li>Registro # " . $fila . ": El cargo con codigo " . trim($id) . " esta registrada " . $idcar["numcampos"] . " veces</li>";
										break;
									}
								} else {
									$retorno["exito"] = 0;
									$retorno["msn"] .= "<li>Registro # " . $fila . ": No se encontro el cargo con codigo " . trim($id) . "</li>";
									break;
								}
							} else {
								$idcargo = $id;
							}
							$permiso_serie[$i]["entidad_identidad"] = 4;
							$permiso_serie[$i]["llave_entidad"] = $idcargo;
							$permiso_serie[$i]["estado"] = 1;
							$i++;
						}
						$retorno["permiso_serie"] = $permiso_serie;
					}
				}
			}
		}

	} else {
		$retorno["exito"] = 0;
		$retorno["msn"] .= "<li>Registro # " . $fila . ": El codigo de la serie ya existe, por favor validar la DB</li>";
	}
	$retorno["data"] = $campos_serie;
	return ($retorno);
}

echo librerias_jquery("1.8");
echo librerias_validar_formulario("11");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
	</head>
	<body>
		<div id="container" class="container">
			<form id="formulario" name="formulario" method="post" enctype="multipart/form-data">
				<table class="table table-bordered" style="margin-top: 10px">
					<thead>
						<tr>
							<th colspan="2" style="text-align: center">CARGAR DE TRD</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><strong>Excel</strong>&nbsp;<a class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 600, height: 600,preserveContent:false} )" href="ayuda.php">ayuda</a></td>
							<td>
							<input type="file" id="anexo" name="anexo" class="form-control-file" >
							</td>
						</tr>
						<tr>
							<td><strong>Omitir primera fila</strong></td>
							<td>
							<input type="radio" name="omitir_fila" value="1" checked="true">
							SI
							<input type="radio" name="omitir_fila" value="0">
							NO</td>
						</tr>
						<tr>
							<td><strong>Tipo</strong></td>
							<td>
							<input type="radio" name="tvd" value="0" checked="true">
							TRD
							<input type="radio" name="tvd" value="1">
							TVD</td>
						</tr>
						<?php
						if(usuario_actual("login")=="cerok"){
							?>
							<tr>
								<td><strong>Vaciar la tabla serie, entidad_serie, permiso_serie?</strong></td>
								<td>
								<input type="radio" name="vaciar" value="0" checked="true">
								NO
								<input type="radio" name="vaciar" value="1">
								SI</td>
							</tr>
							<?php
						}
						?>
						<tr>
							<td><strong>Campo "C&Oacute;DIGO DEPENDENCIA ASOCIADA"</strong></td>
							<td>
							<input type="radio" name="dep_vinculada" value="codigo" checked="true">
							Codigo
							<input type="radio" name="dep_vinculada" value="iddependencia">
							Iddependencia</td>
						</tr>
						<tr>
							<td><strong>Campo "PERMISOS POR CARGO"</strong></td>
							<td>
							<input type="radio" name="permiso_cargo" value="codigo_cargo" checked="true">
							Codigo Cargo
							<input type="radio" name="permiso_cargo" value="idcargo">
							idcargo</td>
						</tr>

						<tr>
							<td><strong>Campo "PERMISOS POR DEPENDENCIA"</strong></td>
							<td>
							<input type="radio" name="permiso_dependencia" value="codigo" checked="true">
							Codigo
							<input type="radio" name="permiso_dependencia" value="iddependencia">
							Iddependencia</td>
						</tr>

						<tr>
							<td colspan="2">Si existe el cod_arbol o cod_tabla deben actualizarlo, este script NO carga dicha informaci&oacute;n</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align: center">
							<input type="hidden" name="ok" value="1" />
							<input type="submit" id="guardar" value="Guardar" class="btn btn-mini btn-primary">
							</td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
		<script type='text/javascript'>
			hs.graphicsDir = '<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
			hs.outlineType = 'rounded-white';
		</script>
		<script src="<?php echo $ruta_db_superior; ?>js/additional-methods.min.js"></script>
		<script>
			$(document).ready(function() {
				$("#formulario").validate({
					rules : {
						anexo : {
							required : true,
							extension : "xls,xlsx"
						}
					},
					messages : {
						anexo : {
							required : "Por favor ingrese el Excel",
							extension : "Extensi&oacute;n no valida (xls,xls)"
						}
					},
					submitHandler : function(form) {
						$("#guardar").attr("disabled", true);
						form.submit();
					}
				});
			});
		</script>
	</body>
</html>
