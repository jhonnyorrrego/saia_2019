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
$x_idcampos_formato = Null;
$x_formato_idformato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_tipo_dato = Null;
$x_longitud = Null;
$x_obligatoriedad = Null;
$x_acciones = Null;
$x_etiqueta_html = Null;
$x_valor = Null;
$x_predeterminado = Null;
$x_ayuda = Null;
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

		// Field idcampos_formato
		$x_idcampos_formato = @$_POST["x_idcampos_formato"];
		$z_idcampos_formato = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_idcampos_formato"][0]) : @$_POST["z_idcampos_formato"][0];
		if ($x_idcampos_formato <> "") {
			$sSrchFld = $x_idcampos_formato;
			$sSrchWrk = "x_idcampos_formato=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_idcampos_formato=" . urlencode($z_idcampos_formato);
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

		// Field formato_idformato
		$x_formato_idformato = @$_POST["x_formato_idformato"];
		$z_formato_idformato = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_formato_idformato"][0]) : @$_POST["z_formato_idformato"][0];
		if ($x_formato_idformato <> "") {
			$sSrchFld = $x_formato_idformato;
			$sSrchWrk = "x_formato_idformato=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_formato_idformato=" . urlencode($z_formato_idformato);
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

		// Field tipo_dato
		$x_tipo_dato = @$_POST["x_tipo_dato"];
		$z_tipo_dato = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_tipo_dato"][0]) : @$_POST["z_tipo_dato"][0];
		if ($x_tipo_dato <> "") {
			$sSrchFld = $x_tipo_dato;
			$sSrchWrk = "x_tipo_dato=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_tipo_dato=" . urlencode($z_tipo_dato);
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

		// Field longitud
		$x_longitud = @$_POST["x_longitud"];
		$z_longitud = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_longitud"][0]) : @$_POST["z_longitud"][0];
		if ($x_longitud <> "") {
			$sSrchFld = $x_longitud;
			$sSrchWrk = "x_longitud=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_longitud=" . urlencode($z_longitud);
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

		// Field obligatoriedad
		$x_obligatoriedad = @$_POST["x_obligatoriedad"];
		$z_obligatoriedad = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_obligatoriedad"][0]) : @$_POST["z_obligatoriedad"][0];
		if ($x_obligatoriedad <> "") {
			$sSrchFld = $x_obligatoriedad;
			$sSrchWrk = "x_obligatoriedad=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_obligatoriedad=" . urlencode($z_obligatoriedad);
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

		// Field acciones
		$x_acciones = @$_POST["x_acciones"];
		$z_acciones = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_acciones"][0]) : @$_POST["z_acciones"][0];
		if ($x_acciones <> "") {
			$sSrchFld = $x_acciones;
			$sSrchWrk = "x_acciones=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_acciones=" . urlencode($z_acciones);
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

		// Field etiqueta_html
		$x_etiqueta_html = @$_POST["x_etiqueta_html"];
		$z_etiqueta_html = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_etiqueta_html"][0]) : @$_POST["z_etiqueta_html"][0];
		if ($x_etiqueta_html <> "") {
			$sSrchFld = $x_etiqueta_html;
			$sSrchWrk = "x_etiqueta_html=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_etiqueta_html=" . urlencode($z_etiqueta_html);
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

		// Field valor
		$x_valor = @$_POST["x_valor"];
		$z_valor = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_valor"][0]) : @$_POST["z_valor"][0];
		if ($x_valor <> "") {
			$sSrchFld = $x_valor;
			$sSrchWrk = "x_valor=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_valor=" . urlencode($z_valor);
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

		// Field predeterminado
		$x_predeterminado = @$_POST["x_predeterminado"];
		$z_predeterminado = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_predeterminado"][0]) : @$_POST["z_predeterminado"][0];
		if ($x_predeterminado <> "") {
			$sSrchFld = $x_predeterminado;
			$sSrchWrk = "x_predeterminado=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_predeterminado=" . urlencode($z_predeterminado);
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

		// Field ayuda
		$x_ayuda = @$_POST["x_ayuda"];
		$z_ayuda = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_ayuda"][0]) : @$_POST["z_ayuda"][0];
		if ($x_ayuda <> "") {
			$sSrchFld = $x_ayuda;
			$sSrchWrk = "x_ayuda=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_ayuda=" . urlencode($z_ayuda);
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
			header("Location: campos_formatolist.php" . "?" . $sSrchStr);
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
			if (EW_this.x_idcampos_formato && !EW_checkinteger(EW_this.x_idcampos_formato.value)) {
				if (!EW_onError(EW_this, EW_this.x_idcampos_formato, "NO", "Incorrect integer - idcampos formato"))
					return false;
			}
			return true;
		}

		//
		-->
	</script>
	<p><span class="phpmaker">Search Campos del Formato<br><br><a href="campos_formatolist.php">Back to List</a></span></p>
	<form name="campos_formatosearch" id="campos_formatosearch" action="campos_formatosrch.php" method="post" onSubmit="return EW_checkMyForm(this);">
		<p>
			<input type="hidden" name="a_search" value="S">
			<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">idcampos formato</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_idcampos_formato[]" value="=,,"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_idcampos_formato" value="<?php echo @$x_idcampos_formato; ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Formato</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_formato_idformato[]" value="=,,"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php
							$x_formato_idformatoList = "<select name=\"x_formato_idformato\">";
							$x_formato_idformatoList .= "<option value=''>Please Select</option>";
							$sSqlWrk = "SELECT DISTINCT idformato, nombre, etiqueta FROM formato" . " ORDER BY etiqueta Asc";
							$rswrk = phpmkr_query($sSqlWrk, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
							if ($rswrk) {
								$rowcntwrk = 0;
								while ($datawrk = phpmkr_fetch_array($rswrk)) {
									$x_formato_idformatoList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
									if ($datawrk["idformato"] == @$x_formato_idformato) {
										$x_formato_idformatoList .= "' selected";
									}
									$x_formato_idformatoList .= ">" . $datawrk["nombre"] . ValueSeparator($rowcntwrk) . $datawrk["etiqueta"] . "</option>";
									$rowcntwrk++;
								}
							}
							@phpmkr_free_result($rswrk);
							$x_formato_idformatoList .= "</select>";
							echo $x_formato_idformatoList;
							?>
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
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tipo de Dato</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_tipo_dato[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="radio" name="x_tipo_dato" value="<?php echo htmlspecialchars("INT"); ?>">
							<?php echo "Entero"; ?>
							<?php echo EditOptionSeparator(0); ?>
							<input type="radio" name="x_tipo_dato" value="<?php echo htmlspecialchars("NUMBER"); ?>">
							<?php echo "N&uacute;mero"; ?>
							<?php echo EditOptionSeparator(1); ?>
							<input type="radio" name="x_tipo_dato" value="<?php echo htmlspecialchars("DOUBLE"); ?>">
							<?php echo "Doble"; ?>
							<?php echo EditOptionSeparator(2); ?>
							<input type="radio" name="x_tipo_dato" value="<?php echo htmlspecialchars("CHAR"); ?>">
							<?php echo "Caracter"; ?>
							<?php echo EditOptionSeparator(3); ?>
							<input type="radio" name="x_tipo_dato" value="<?php echo htmlspecialchars("VARCHAR"); ?>">
							<?php echo "Caracter Variable"; ?>
							<?php echo EditOptionSeparator(4); ?>
							<input type="radio" name="x_tipo_dato" value="<?php echo htmlspecialchars("TEXT"); ?>">
							<?php echo "Texto"; ?>
							<?php echo EditOptionSeparator(5); ?>
							<input type="radio" name="x_tipo_dato" value="<?php echo htmlspecialchars("DATE"); ?>">
							<?php echo "Fecha"; ?>
							<?php echo EditOptionSeparator(6); ?>
							<input type="radio" name="x_tipo_dato" value="<?php echo htmlspecialchars("TIME"); ?>">
							<?php echo "Hora"; ?>
							<?php echo EditOptionSeparator(7); ?>
							<input type="radio" name="x_tipo_dato" value="<?php echo htmlspecialchars("DATETIME"); ?>">
							<?php echo "Fecha y Hora"; ?>
							<?php echo EditOptionSeparator(8); ?>
							<input type="radio" name="x_tipo_dato" value="<?php echo htmlspecialchars("BLOB"); ?>">
							<?php echo "Binario"; ?>
							<?php echo EditOptionSeparator(9); ?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Longitud</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_longitud[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_longitud" id="x_longitud" value="<?php echo htmlspecialchars(@$x_longitud) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Obligatoriedad</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_obligatoriedad[]" value="=,,"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="radio" name="x_obligatoriedad" value="<?php echo htmlspecialchars("NULL"); ?>">
							<?php echo "Nulo"; ?>
							<?php echo EditOptionSeparator(0); ?>
							<input type="radio" name="x_obligatoriedad" value="<?php echo htmlspecialchars("NOT NULL"); ?>">
							<?php echo "Obligatorio"; ?>
							<?php echo EditOptionSeparator(1); ?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Acciones o Formularios</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_acciones[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php
							$ar_x_acciones = explode(",", @$x_acciones);
							$x_accionesChk = "";
							$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("a") . "\"";
							foreach ($ar_x_acciones as $cnt_x_acciones) {
								if (trim($cnt_x_acciones) == "a") {
									$x_accionesChk .= " checked";
									break;
								}
							}
							$x_accionesChk .= ">" . "Adicionar" . EditOptionSeparator(0);
							$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("e") . "\"";
							foreach ($ar_x_acciones as $cnt_x_acciones) {
								if (trim($cnt_x_acciones) == "e") {
									$x_accionesChk .= " checked";
									break;
								}
							}
							$x_accionesChk .= ">" . "Editar" . EditOptionSeparator(1);
							echo $x_accionesChk;
							?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta html</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_etiqueta_html[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="radio" name="x_etiqueta_html" value="<?php echo htmlspecialchars("text"); ?>">
							<?php echo "Cuadro de Texto"; ?>
							<?php echo EditOptionSeparator(0); ?>
							<input type="radio" name="x_etiqueta_html" value="<?php echo htmlspecialchars("password"); ?>">
							<?php echo "Contrase&ntilde;a"; ?>
							<?php echo EditOptionSeparator(1); ?>
							<input type="radio" name="x_etiqueta_html" value="<?php echo htmlspecialchars("textarea"); ?>">
							<?php echo "Area de Texto"; ?>
							<?php echo EditOptionSeparator(2); ?>
							<input type="radio" name="x_etiqueta_html" value="<?php echo htmlspecialchars("radio"); ?>">
							<?php echo "Boton de Selecci&oacute;n"; ?>
							<?php echo EditOptionSeparator(3); ?>
							<input type="radio" name="x_etiqueta_html" value="<?php echo htmlspecialchars("checkbox"); ?>">
							<?php echo "Cuadro de Chequeo"; ?>
							<?php echo EditOptionSeparator(4); ?>
							<input type="radio" name="x_etiqueta_html" value="<?php echo htmlspecialchars("select"); ?>">
							<?php echo "Lista Deplegable"; ?>
							<?php echo EditOptionSeparator(5); ?>
							<input type="radio" name="x_etiqueta_html" value="<?php echo htmlspecialchars("dependientes"); ?>">
							<?php echo "Listado Dependiente"; ?>
							<?php echo EditOptionSeparator(6); ?>
							<input type="radio" name="x_etiqueta_html" value="<?php echo htmlspecialchars("file"); ?>">
							<?php echo "Archivo"; ?>
							<?php echo EditOptionSeparator(7); ?>
							<input type="radio" name="x_etiqueta_html" value="<?php echo htmlspecialchars("hidden"); ?>">
							<?php echo "Oculto"; ?>
							<?php echo EditOptionSeparator(8); ?>
							<input type="radio" name="x_etiqueta_html" value="<?php echo htmlspecialchars("autocompletar"); ?>">
							<?php echo "Autocompletar"; ?>
							<?php echo EditOptionSeparator(9); ?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Valor Llenado</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_valor[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<textarea cols="35" rows="4" id="x_valor" name="x_valor"><?php echo @$x_valor; ?></textarea>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Valor Predeterminado</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_predeterminado[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_predeterminado" id="x_predeterminado" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_predeterminado) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Mensaje de Ayuda</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_ayuda[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<textarea cols="35" rows="4" id="x_ayuda" name="x_ayuda"><?php echo @$x_ayuda; ?></textarea>
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