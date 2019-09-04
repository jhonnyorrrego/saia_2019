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
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Locationcampos_formatolist.php");
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

// Open connection to the database

switch ($sAction) {
	case "I": // Get a record to display
		if (!LoadData($sKey, $conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location campos_formatolist.php");
			exit();
		}
}
?>
	<?php include("header.php") ?>
	<p><span class="phpmaker">Ver Campos del Formato<br><br>
			<a href="<?php echo "campos_formatoedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
			<a href="<?php echo  "campos_formatoadd.php?key=" . urlencode($sKey); ?>">Copiar</a>&nbsp;
			<a href="<?php echo "campos_formatodelete.php?key=" . urlencode($sKey); ?>">Borrar</a>&nbsp;
		</span></p>
	<p>
		<form>
			<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Formato</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php
							if ((!is_null($x_formato_idformato)) && ($x_formato_idformato <> "")) {
								$sSqlWrk = "SELECT DISTINCT *  FROM formato";
								$sTmp = $x_formato_idformato;
								$sTmp = addslashes($sTmp);
								$sSqlWrk .= " WHERE (idformato = " . $sTmp . ")";
								$rswrk = phpmkr_query($sSqlWrk, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
								if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
									$sTmp = $rowwrk["nombre"];
									$sTmp .= ValueSeparator(0) . $rowwrk["etiqueta"];
								}
								@phpmkr_free_result($rswrk);
							} else {
								$sTmp = "";
							}
							$ox_formato_idformato = $x_formato_idformato; // Backup Original Value
							$x_formato_idformato = $sTmp;
							?>
							<?php echo $x_formato_idformato; ?>
							<?php $x_formato_idformato = $ox_formato_idformato; // Restore Original Value 
							?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php echo $x_nombre; ?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php echo $x_etiqueta; ?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tipo de Dato</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php
							switch ($x_tipo_dato) {
								case "INT":
									$sTmp = "Entero";
									break;
								case "NUMBER":
									$sTmp = "N&uacute;mero";
									break;
								case "DOUBLE":
									$sTmp = "Doble";
									break;
								case "CHAR":
									$sTmp = "Caracter";
									break;
								case "VARCHAR":
									$sTmp = "Caracter Variable";
									break;
								case "TEXT":
									$sTmp = "Texto";
									break;
								case "DATE":
									$sTmp = "Fecha";
									break;
								case "TIME":
									$sTmp = "Hora";
									break;
								case "DATETIME":
									$sTmp = "Fecha y Hora";
									break;
								case "BLOB":
									$sTmp = "Binario";
									break;
								default:
									$sTmp = "";
							}
							$ox_tipo_dato = $x_tipo_dato; // Backup Original Value
							$x_tipo_dato = $sTmp;
							?>
								<?php echo $x_tipo_dato; ?>
								<?php $x_tipo_dato = $ox_tipo_dato; // Restore Original Value 
								?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Longitud</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php echo $x_longitud; ?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Obligatoriedad</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php
							switch ($x_obligatoriedad) {
								case "NULL":
									$sTmp = "Nulo";
									break;
								case "NOT NULL":
									$sTmp = "Obligatorio";
									break;
								default:
									$sTmp = "";
							}
							$ox_obligatoriedad = $x_obligatoriedad; // Backup Original Value
							$x_obligatoriedad = $sTmp;
							?>
								<?php echo $x_obligatoriedad; ?>
								<?php $x_obligatoriedad = $ox_obligatoriedad; // Restore Original Value 
								?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Acciones o Formularios</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php
							$ar_x_acciones = explode(",", @$x_acciones);
							$sTmp = "";
							$rowcntwrk = 0;
							foreach ($ar_x_acciones as $cnt_x_acciones) {
								switch (trim($cnt_x_acciones)) {
									case "a":
										$sTmp .= "Adicionar";
										$sTmp1 = ViewOptionSeparator($rowcntwrk);
										$sTmp .= $sTmp1;
										break;
									case "e":
										$sTmp .= "Editar";
										$sTmp1 = ViewOptionSeparator($rowcntwrk);
										$sTmp .= $sTmp1;
										break;
								}
								$rowcntwrk++;
							}
							if (strlen($sTmp) > 0) {
								$sTmp = substr($sTmp, 0, strlen($sTmp) - strlen($sTmp1));
							}
							$ox_acciones = $x_acciones; // Backup Original Value
							$x_acciones = $sTmp;
							?>
								<?php echo $x_acciones; ?>
								<?php $x_acciones = $ox_acciones; // Restore Original Value 
								?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta html</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php
							switch ($x_etiqueta_html) {
								case "text":
									$sTmp = "Cuadro de Texto";
									break;
								case "password":
									$sTmp = "Contrase&ntilde;a";
									break;
								case "textarea":
									$sTmp = "Area de Texto";
									break;
								case "radio":
									$sTmp = "Boton de Selecci&oacute;n";
									break;
								case "checkbox":
									$sTmp = "Cuadro de Chequeo";
									break;
								case "select":
									$sTmp = "Lista Deplegable";
									break;
								case "dependientes":
									$sTmp = "Listado Dependiente";
									break;
								case "file":
									$sTmp = "Archivo";
									break;
								case "hidden":
									$sTmp = "Oculto";
									break;
								case "autocompletar":
									$sTmp = "Autocompletar";
									break;
								case "ejecutor":
									$sTmp = "Remitente";
									break;
								default:
									$sTmp = "";
							}
							$ox_etiqueta_html = $x_etiqueta_html; // Backup Original Value
							$x_etiqueta_html = $sTmp;
							?>
								<?php echo $x_etiqueta_html; ?>
								<?php $x_etiqueta_html = $ox_etiqueta_html; // Restore Original Value 
								?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Valor Llenado</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php echo str_replace(chr(10), "<br>", @$x_valor); ?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Valor Predeterminado</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php echo $x_predeterminado; ?>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Mensaje de Ayuda</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php echo str_replace(chr(10), "<br>", @$x_ayuda); ?>
						</span></td>
				</tr>
			</table>
		</form>
		<p>
			<?php include("footer.php") ?>
			<?php
			//phpmkr_db_close($conn);
			?>
			<?php

			//-------------------------------------------------------------------------------
			// Function LoadData
			// - Load Data based on Key Value sKey
			// - Variables setup: field variables

			function LoadData($sKey, $conn)
			{
				$sKeyWrk = "" . addslashes($sKey) . "";
				$sSql = "SELECT * FROM campos_formato";
				$sSql .= " WHERE idcampos_formato = " . $sKeyWrk;
				$sGroupBy = "";
				$sHaving = "";
				$sOrderBy = "";
				if ($sGroupBy <> "") {
					$sSql .= " GROUP BY " . $sGroupBy;
				}
				if ($sHaving <> "") {
					$sSql .= " HAVING " . $sHaving;
				}
				if ($sOrderBy <> "") {
					$sSql .= " ORDER BY " . $sOrderBy;
				}
				$rs = phpmkr_query($sSql, $conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
				if (phpmkr_num_rows($rs) == 0) {
					$LoadData = false;
				} else {
					$LoadData = true;
					$row = phpmkr_fetch_array($rs);

					// Get the field contents
					$GLOBALS["x_idcampos_formato"] = $row["idcampos_formato"];
					$GLOBALS["x_formato_idformato"] = $row["formato_idformato"];
					$GLOBALS["x_nombre"] = $row["nombre"];
					$GLOBALS["x_etiqueta"] = $row["etiqueta"];
					$GLOBALS["x_tipo_dato"] = $row["tipo_dato"];
					$GLOBALS["x_longitud"] = $row["longitud"];
					$GLOBALS["x_obligatoriedad"] = $row["obligatoriedad"];
					$GLOBALS["x_acciones"] = $row["acciones"];
					$GLOBALS["x_etiqueta_html"] = $row["etiqueta_html"];
					$GLOBALS["x_valor"] = $row["valor"];
					$GLOBALS["x_predeterminado"] = $row["predeterminado"];
					$GLOBALS["x_ayuda"] = $row["ayuda"];
				}
				phpmkr_free_result($rs);
				return $LoadData;
			}
			?>