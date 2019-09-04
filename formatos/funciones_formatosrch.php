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
if (@$_SESSION["project1_status"] <> "login") {
	header("Location:  login.php");
	exit();
}
?>
<?php

// Initialize common variables
$x_idfuncion_formato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_descripcion = Null;
$x_ruta = Null;
$x_formato = Null;
$x_acciones = Null;
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

		// Field idfuncion_formato
		$x_idfuncion_formato = @$_POST["x_idfuncion_formato"];
		$z_idfuncion_formato = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_idfuncion_formato"][0]) : @$_POST["z_idfuncion_formato"][0];
		if ($x_idfuncion_formato <> "") {
			$sSrchFld = $x_idfuncion_formato;
			$sSrchWrk = "x_idfuncion_formato=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_idfuncion_formato=" . urlencode($z_idfuncion_formato);
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

		// Field descripcion
		$x_descripcion = @$_POST["x_descripcion"];
		$z_descripcion = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_descripcion"][0]) : @$_POST["z_descripcion"][0];
		if ($x_descripcion <> "") {
			$sSrchFld = $x_descripcion;
			$sSrchWrk = "x_descripcion=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_descripcion=" . urlencode($z_descripcion);
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

		// Field ruta
		$x_ruta = @$_POST["x_ruta"];
		$z_ruta = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_ruta"][0]) : @$_POST["z_ruta"][0];
		if ($x_ruta <> "") {
			$sSrchFld = $x_ruta;
			$sSrchWrk = "x_ruta=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_ruta=" . urlencode($z_ruta);
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

		// Field formato
		$x_formato = @$_POST["x_formato"];
		$z_formato = (get_magic_quotes_gpc()) ? stripslashes(@$_POST["z_formato"][0]) : @$_POST["z_formato"][0];
		if ($x_formato <> "") {
			$sSrchFld = $x_formato;
			$sSrchWrk = "x_formato=" . urlencode($sSrchFld);
			$sSrchWrk .= "&z_formato=" . urlencode($z_formato);
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
		if ($sSrchStr <> "") {
			ob_end_clean();
			header("Location: funciones_formatolist.php" . "?" . $sSrchStr);
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
			if (EW_this.x_idfuncion_formato && !EW_checkinteger(EW_this.x_idfuncion_formato.value)) {
				if (!EW_onError(EW_this, EW_this.x_idfuncion_formato, "NO", "Incorrect integer - idfuncion formato"))
					return false;
			}
			return true;
		}

		//
		-->
	</script>
	<p><span class="phpmaker">Buscar Funciones del Formato<br><br><a href="funciones_formatolist.php">Ir al Listado</a></span></p>
	<form name="funciones_formatosearch" id="funciones_formatosearch" action="funciones_formatosrch.php" method="post" onSubmit="return EW_checkMyForm(this);">
		<p>
			<input type="hidden" name="a_search" value="S">
			<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">idfuncion formato</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">=<input type="hidden" name="z_idfuncion_formato[]" value="=,,"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_idfuncion_formato" value="<?php echo @$x_idfuncion_formato; ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre de la funci&oacute;</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_nombre[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre a mostrar</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_etiqueta[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_etiqueta" id="x_etiqueta" value="<?php echo htmlspecialchars(@$x_etiqueta) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Descripci&oacute;n</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_descripcion[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_descripcion" id="x_descripcion" value="<?php echo htmlspecialchars(@$x_descripcion) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ubicada en Archivo</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_ruta[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_ruta" id="x_ruta" value="<?php echo htmlspecialchars(@$x_ruta) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Listado de Formatos a los que pertenece la Funcion</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">LIKE<input type="hidden" name="z_formato[]" value="LIKE,'%,%'"></span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php
							$x_formatoList = "<select name=\"x_formato[]\" multiple>";
							$sSqlWrk = "SELECT DISTINCT idformato, etiqueta FROM formato";
							$rswrk = phpmkr_query($sSqlWrk, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
							if ($rswrk) {
								$rowcntwrk = 0;
								while ($datawrk = phpmkr_fetch_array($rswrk)) {
									$ar_x_formato = explode(",", @$x_formato);
									$x_formatoList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
									foreach ($ar_x_formato as $cnt_x_formato) {
										if ($datawrk["idformato"] == trim($cnt_x_formato)) {
											$x_formatoList .= "' selected";
											break;
										}
									}
									$x_formatoList .= ">" . $datawrk["etiqueta"] . "</option>";
									$rowcntwrk++;
								}
							}
							@phpmkr_free_result($rswrk);
							$x_formatoList .= "</select>";
							echo $x_formatoList;
							?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">acciones</span></td>
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
							$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("m") . "\"";
							foreach ($ar_x_acciones as $cnt_x_acciones) {
								if (trim($cnt_x_acciones) == "m") {
									$x_accionesChk .= " checked";
									break;
								}
							}
							$x_accionesChk .= ">" . "Mostrar" . EditOptionSeparator(1);
							$x_accionesChk .= "<input type=\"checkbox\" name=\"x_acciones[]\" value=\"" . htmlspecialchars("e") . "\"";
							foreach ($ar_x_acciones as $cnt_x_acciones) {
								if (trim($cnt_x_acciones) == "e") {
									$x_accionesChk .= " checked";
									break;
								}
							}
							$x_accionesChk .= ">" . "Editar" . EditOptionSeparator(2);
							echo $x_accionesChk;
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