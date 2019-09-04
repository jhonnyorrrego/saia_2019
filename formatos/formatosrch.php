<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php
$ewCurSec = 0; // Initialise

// User levels
define("ewAllowAdd", 1, true);
define("ewAllowDelete", 2, true);
define("ewAllowEdit", 4, true);
define("ewAllowView", 8, true);
define("ewAllowList", 8, true);
define("ewAllowReport", 8, true);
define("ewAllowSearch", 8, true);
define("ewAllowAdmin", 16, true);
?>
<?php

// Initialize common variables
$x_idformato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_contador_idcontador = Null;
$x_ruta_mostrar = Null;
$x_ruta_editar = Null;
$x_ruta_adicionar = Null;
$x_librerias = Null;
$x_encabezado = Null;
$x_cuerpo = Null;
$x_pie_pagina = Null;
$x_margenes = Null;
$x_orientacion = Null;
$x_papel = Null;
$x_exportar = Null;
?>
<?php include("db.php") ?>
<?php include("phpmkrfn.php") ?>
<?php

// Get action
$sAction = @$_POST["a_search"];
switch ($sAction) {
	case "S": // Get Search Criteria

		// Build search string for advanced search, remove blank field
		$sSrchStr = "";

		// Field idformato
		$x_idformato = @$_POST["x_idformato"];
		$z_idformato = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_idformato"][0]) : @$_POST["z_idformato"][0];
		if ($x_idformato <> "") {
			$sSrchFld = $x_idformato;
			$sSrchWrk = "x_idformato=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_idformato=" . urlencode($z_idformato);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field nombre
		$x_nombre = @$_POST["x_nombre"];
		$z_nombre = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_nombre"][0]) : @$_POST["z_nombre"][0];
		if ($x_nombre <> "") {
			$sSrchFld = $x_nombre;
			$sSrchWrk = "x_nombre=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_nombre=" . urlencode($z_nombre);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field etiqueta
		$x_etiqueta = @$_POST["x_etiqueta"];
		$z_etiqueta = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_etiqueta"][0]) : @$_POST["z_etiqueta"][0];
		if ($x_etiqueta <> "") {
			$sSrchFld = $x_etiqueta;
			$sSrchWrk = "x_etiqueta=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_etiqueta=" . urlencode($z_etiqueta);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field contador_idcontador
		$x_contador_idcontador = @$_POST["x_contador_idcontador"];
		$z_contador_idcontador = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_contador_idcontador"][0]) : @$_POST["z_contador_idcontador"][0];
		if ($x_contador_idcontador <> "") {
			$sSrchFld = $x_contador_idcontador;
			$sSrchWrk = "x_contador_idcontador=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_contador_idcontador=" . urlencode($z_contador_idcontador);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field ruta_mostrar
		$x_ruta_mostrar = @$_POST["x_ruta_mostrar"];
		$z_ruta_mostrar = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_ruta_mostrar"][0]) : @$_POST["z_ruta_mostrar"][0];
		if ($x_ruta_mostrar <> "") {
			$sSrchFld = $x_ruta_mostrar;
			$sSrchWrk = "x_ruta_mostrar=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_ruta_mostrar=" . urlencode($z_ruta_mostrar);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field ruta_editar
		$x_ruta_editar = @$_POST["x_ruta_editar"];
		$z_ruta_editar = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_ruta_editar"][0]) : @$_POST["z_ruta_editar"][0];
		if ($x_ruta_editar <> "") {
			$sSrchFld = $x_ruta_editar;
			$sSrchWrk = "x_ruta_editar=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_ruta_editar=" . urlencode($z_ruta_editar);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field ruta_adicionar
		$x_ruta_adicionar = @$_POST["x_ruta_adicionar"];
		$z_ruta_adicionar = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_ruta_adicionar"][0]) : @$_POST["z_ruta_adicionar"][0];
		if ($x_ruta_adicionar <> "") {
			$sSrchFld = $x_ruta_adicionar;
			$sSrchWrk = "x_ruta_adicionar=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_ruta_adicionar=" . urlencode($z_ruta_adicionar);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field librerias
		$x_librerias = @$_POST["x_librerias"];
		$z_librerias = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_librerias"][0]) : @$_POST["z_librerias"][0];
		if ($x_librerias <> "") {
			$sSrchFld = $x_librerias;
			$sSrchWrk = "x_librerias=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_librerias=" . urlencode($z_librerias);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field encabezado
		$x_encabezado = @$_POST["x_encabezado"];
		$z_encabezado = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_encabezado"][0]) : @$_POST["z_encabezado"][0];
		if ($x_encabezado <> "") {
			$sSrchFld = $x_encabezado;
			$sSrchWrk = "x_encabezado=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_encabezado=" . urlencode($z_encabezado);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field cuerpo
		$x_cuerpo = @$_POST["x_cuerpo"];
		$z_cuerpo = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_cuerpo"][0]) : @$_POST["z_cuerpo"][0];
		if ($x_cuerpo <> "") {
			$sSrchFld = $x_cuerpo;
			$sSrchWrk = "x_cuerpo=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_cuerpo=" . urlencode($z_cuerpo);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field pie_pagina
		$x_pie_pagina = @$_POST["x_pie_pagina"];
		$z_pie_pagina = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_pie_pagina"][0]) : @$_POST["z_pie_pagina"][0];
		if ($x_pie_pagina <> "") {
			$sSrchFld = $x_pie_pagina;
			$sSrchWrk = "x_pie_pagina=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_pie_pagina=" . urlencode($z_pie_pagina);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field margenes
		$x_margenes = @$_POST["x_margenes"];
		$z_margenes = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_margenes"][0]) : @$_POST["z_margenes"][0];
		if ($x_margenes <> "") {
			$sSrchFld = $x_margenes;
			$sSrchWrk = "x_margenes=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_margenes=" . urlencode($z_margenes);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field orientacion
		$x_orientacion = @$_POST["x_orientacion"];
		$z_orientacion = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_orientacion"][0]) : @$_POST["z_orientacion"][0];
		if ($x_orientacion <> "") {
			$sSrchFld = $x_orientacion;
			$sSrchWrk = "x_orientacion=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_orientacion=" . urlencode($z_orientacion);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field papel
		$x_papel = @$_POST["x_papel"];
		$z_papel = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_papel"][0]) : @$_POST["z_papel"][0];
		if ($x_papel <> "") {
			$sSrchFld = $x_papel;
			$sSrchWrk = "x_papel=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_papel=" . urlencode($z_papel);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}

		// Field exportar
		$x_exportar = @$_POST["x_exportar"];
		$z_exportar = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_exportar"][0]) : @$_POST["z_exportar"][0];
		if ($x_exportar <> "") {
			$sSrchFld = $x_exportar;
			$sSrchWrk = "x_exportar=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_exportar=" . urlencode($z_exportar);
		} else {
			$sSrchWrk = "";
		}
		if ($sSrchWrk <> "") {
			if ($sSrchStr == "") {
				$sSrchStr = $sSrchWrk;
			} else {
				$sSrchStr .= "&" . $sSrchWrk;
			}
		}
		if ($sSrchStr <> "") {
			ob_end_clean();
			header("Location: formatolist.php" . "?" . $sSrchStr);
			exit();
		}
}

// Open connection to the database

?>
	<?php include("header.php") ?>
	<script type="text/javascript" src="ew.js"></script>
	<script type="text/javascript">
		<!--
		EW_dateSep = "/"; // set date separator	

		//
		-->
	</script>
	<script type="text/javascript">
		<!--
		function EW_checkMyForm(EW_this) {
			if (EW_this.x_idformato && !EW_checkinteger(EW_this.x_idformato.value)) {
				if (!EW_onError(EW_this, EW_this.x_idformato, "NO", "Incorrect integer - idformato"))
					return false;
			}
			return true;
		}

		//
		-->
	</script>
	<p><span class="phpmaker">Buscar Formatos<br><br><a href="formatolist.php">Ir al Listado</a></span></p>
	<form name="formatosearch" id="formatosearch" action="formatosrch.php" method="post" onSubmit="return EW_checkMyForm(this);">
		<p>
			<input type="hidden" name="a_search" value="S">
			<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">idformato</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_idformato[]" value="=,,"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_idformato" value="<?php echo @$x_idformato; ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_nombre[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_etiqueta[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_etiqueta" id="x_etiqueta" value="<?php echo htmlspecialchars(@$x_etiqueta) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Contador</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_contador_idcontador[]" value="=,,"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php
							$x_contador_idcontadorList = "<select name=\"x_contador_idcontador\">";
							$x_contador_idcontadorList .= "<option value=''>Please Select</option>";
							$sSqlWrk = "SELECT DISTINCT idcontador, nombre FROM contador" . " ORDER BY nombre Asc";
							$rswrk = phpmkr_query($sSqlWrk, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
							if ($rswrk) {
								$rowcntwrk = 0;
								while ($datawrk = phpmkr_fetch_array($rswrk)) {
									$x_contador_idcontadorList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
									if ($datawrk["idcontador"] == @$x_contador_idcontador) {
										$x_contador_idcontadorList .= "' selected";
									}
									$x_contador_idcontadorList .= ">" . $datawrk["nombre"] . "</option>";
									$rowcntwrk++;
								}
							}
							@phpmkr_free_result($rswrk);
							$x_contador_idcontadorList .= "</select>";
							echo $x_contador_idcontadorList;
							?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ruta (Mostrar)</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_ruta_mostrar[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_ruta_mostrar" id="x_ruta_mostrar" value="<?php echo htmlspecialchars(@$x_ruta_mostrar) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ruta (Editar)</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_ruta_editar[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_ruta_editar" id="x_ruta_editar" value="<?php echo htmlspecialchars(@$x_ruta_editar) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ruta (Adicionar)</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_ruta_adicionar[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_ruta_adicionar" id="x_ruta_adicionar" value="<?php echo htmlspecialchars(@$x_ruta_adicionar) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">librerias</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_librerias[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_librerias" id="x_librerias" value="<?php echo htmlspecialchars(@$x_librerias) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Encabezado</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_encabezado[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<textarea cols="35" rows="4" id="x_encabezado" name="x_encabezado"><?php echo @$x_encabezado; ?></textarea>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Cuerpo</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_cuerpo[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<textarea cols="35" rows="4" id="x_cuerpo" name="x_cuerpo"><?php echo @$x_cuerpo; ?></textarea>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Pie de P�gina</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_pie_pagina[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<textarea cols="35" rows="4" id="x_pie_pagina" name="x_pie_pagina"><?php echo @$x_pie_pagina; ?></textarea>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Margenes(Izq, Der, Sup, Inf)</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_margenes[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_margenes" id="x_margenes" size="30" maxlength="150" value="<?php echo htmlspecialchars(@$x_margenes) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Orientaci�n</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_orientacion[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_orientacion" id="x_orientacion" size="30" maxlength="150" value="<?php echo htmlspecialchars(@$x_orientacion) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tama�o del Papel</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_papel[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_papel" id="x_papel" size="30" maxlength="150" value="<?php echo htmlspecialchars(@$x_papel) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M�todo Exportar</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_exportar[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php
							$ar_x_exportar = explode(",", @$x_exportar);
							$x_exportarChk = "";
							$x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("pdf") . "\"";
							foreach ($ar_x_exportar as $cnt_x_exportar) {
								if (trim($cnt_x_exportar) == "pdf") {
									$x_exportarChk .= " checked";
									break;
								}
							}
							$x_exportarChk .= ">" . "PDF" . EditOptionSeparator(0);
							$x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("xls") . "\"";
							foreach ($ar_x_exportar as $cnt_x_exportar) {
								if (trim($cnt_x_exportar) == "xls") {
									$x_exportarChk .= " checked";
									break;
								}
							}
							$x_exportarChk .= ">" . "Excel" . EditOptionSeparator(1);
							$x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("word") . "\"";
							foreach ($ar_x_exportar as $cnt_x_exportar) {
								if (trim($cnt_x_exportar) == "word") {
									$x_exportarChk .= " checked";
									break;
								}
							}
							$x_exportarChk .= ">" . "Word (RTF)" . EditOptionSeparator(2);
							echo $x_exportarChk;
							?>
						</span></td>
				</tr>
			</table>
			<p>
				<input type="submit" name="Action" value="Search">
	</form>
	<?php include("footer.php") ?>
	<?php
	//phpmkr_db_close($conn);
	?>