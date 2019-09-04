<?php ob_start(); ?>
<?php


// Initialize common variables
$x_idvista_formato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_librerias = Null;
$x_encabezado = Null;
$x_cuerpo = Null;
$x_pie_pagina = Null;
$x_margenes = Null;
$x_orientacion = Null;
$x_papel = Null;
$x_exportar = Null;
$x_formato_padre = Null;
$x_item = Null;
$x_ruta_mostrar = Null;
$x_tipo_edicion = Null;
$x_serie_idserie = Null;
$x_banderas = Null;
$x_font_size = Null;
?>
<?php include("db.php") ?>
<?php include("phpmkrfn.php") ?>
<?php include("librerias/header_formato.php") ?>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.validate.js"></script>
<script type="text/javascript" src="../js/cmxforms.js"></script>
<script type="text/javascript">
	<!--
	EW_dateSep = "/"; // set date separator	

	//
	-->
</script>
<script type="text/javascript">
	$().ready(function() {
		// validar los campos del formato
		$('#vista_formatoadd').validate();

	});
	//-->
</script>
<script language=javascript>
	function ventanaSecundaria(URL) {
		window.open(URL, "ventana1", "width=700,height=500,scrollbars=YES,Resizable=yes");
	}
</script>
<?php

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "C"; // Copy record
	} else {
		$sAction = "I"; // Display blank record
	}
} else {

	// Get fields from form
	$x_idvista_formato = @$_POST["x_idvista_formato"];
	$x_nombre = @$_POST["x_nombre"];
	$x_etiqueta = @$_POST["x_etiqueta"];
	$x_librerias = @$_POST["x_librerias"];
	$x_encabezado = @$_POST["x_encabezado"];
	$x_cuerpo = @$_POST["x_cuerpo"];
	$x_ruta_mostrar = @$_POST["x_ruta_mostrar"];
	$x_pie_pagina = @$_POST["x_pie_pagina"];
	$x_margenes = @$_POST["x_mizq"] . "," . @$_POST["x_mder"] . "," . @$_POST["x_msup"] . "," . @$_POST["x_minf"];
	$x_orientacion = @$_POST["x_orientacion"];
	$x_papel = @$_POST["x_papel"];
	$x_exportar = @$_POST["x_exportar"];
	$x_formato_padre = @$_POST["x_formato_padre"];
	$x_serie_banderas = @$_POST["x_banderas"];
	$x_font_size = @$_POST["x_font_size"];
}

switch ($sAction) {
	case "C": // Get a record to display
		if (!LoadData($sKey, $conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
			//		//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: vista_formatolist.php");
			exit();
		}
		break;
	case "A": // Add
		if ($idvista = AddData($conn)) {
			header("Location: vista_formatoedit.php?key=" . $idvista);
			exit();
		}
		break;
}
?>
	<?php include("header.php") ?>
	<script type="text/javascript" src="ew.js"></script>
	<script type="text/javascript">
		<!--
		EW_dateSep = "/"; // set date separator	

		//
		-->
	</script>
	<p><span class="phpmaker">Crear Vista Formatos<br><br></span></p>
	<form name="vista_formatoadd" id="vista_formatoadd" action="vista_formatoadd.php" method="post">
		<p>
			<input type="hidden" name="a_add" value="A">
			<input type="hidden" name="casilla" id="casilla" value="">
			<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre*</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" class="required" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta*</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" class="required" name="x_etiqueta" id="x_etiqueta" value="<?php echo htmlspecialchars(@$x_etiqueta) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Formato Padre*</span></td>
					<td bgcolor="#F5F5F5">
						<span class="phpmaker">
							<?php
							$formatos = busca_filtro_tabla("idformato,nombre,etiqueta", "formato A", "1=1", "nombre DESC", $conn);
							$inicio = '<SELECT name="x_formato_padre"  class="required" >';
							if (!@$_REQUEST["formato_padre"]) {
								$inicio .= '<OPTION value="0">PERTENECE A LA RAIZ</OPTION>';
							}
							$fin = '</SELECT>';
							for ($i = 0; $i < $formatos["numcampos"]; $i++) {
								$inicio .= '<OPTION value="' . $formatos[$i]["idformato"] . '"';
								if (@$_REQUEST["formato_padre"] == $formatos[$i]["idformato"]) {
									$inicio .= ' SELECTED ';
								}
								$inicio .= '>' . $formatos[$i]["etiqueta"] . '</OPTION>';
							}
							echo ($inicio . $fin);
							?>
						</span>
					</td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">librer&iacute;as</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_librerias" id="x_librerias" value="<?php echo htmlspecialchars(@$x_librerias) ?>">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tipo</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="checkbox" name="x_banderas[]" id="x_banderas" value="m" checked>Mostrar
						</span>
					</td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Encabezado</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="hidden" name="x_encabezado" id="x_encabezado" value="">
							<label id="x_encabezado_mostrar">Ninguno</label>&nbsp;&nbsp;
							<a href="javascript:vista_formatoadd.casilla.value='x_encabezado';ventanaSecundaria('encabezadoadd.php?listar=1')">ELEGIR</a>
							<label onclick="vista_formatoadd.x_encabezado.value='';document.getElementById('x_encabezado_mostrar').innerHTML='Ninguno'" style="color:blue; text-decoration:underline; cursor:pointer">SIN ENCABEZADO</label>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Cuerpo</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<textarea cols="35" rows="4" id="x_cuerpo" name="x_cuerpo" class="tiny_avanzado"><?php echo @$x_cuerpo; ?></textarea>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Pie de P&aacute;gina</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="hidden" name="x_pie_pagina" id="x_pie_pagina" value="">
							<label id="x_pie_pagina_mostrar">Ninguno</label>&nbsp;&nbsp;
							<a href="javascript:vista_formatoadd.casilla.value='x_pie_pagina';ventanaSecundaria('encabezadoadd.php?listar=1')">ELEGIR</a>
							&nbsp;&nbsp;<label onclick="vista_formatoadd.x_pie_pagina='';document.getElementById('x_pie_pagina_mostrar').innerHTML='Ninguno'" style="color:blue; text-decoration:underline; cursor:pointer">SIN PIE DE PAGINA</label>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tama&ntilde;o de letra</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="text" name="x_font_size" id="x_font_size" size="30" maxlength="150" value="12">
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Margenes(Izq, Der, Sup, Inf)</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php
							function combo($seleccionado)
							{
								$combo_margenes = array('0', '5', '10', '15', '20', '25', '30', '35', '40', '45', '50');
								for ($i = 0; $i < count($combo_margenes); $i++) {
									echo "<option value='" . $combo_margenes[$i] . "'";
									if ($combo_margenes[$i] == $seleccionado)
										echo " selected ";
									echo ">" . $combo_margenes[$i] . "</option>";
								}
							}
							?>
							Izquierda <select name="x_mizq">
								<?php combo("15"); ?>
							</select>
							Derecha <select name="x_mder">
								<?php combo("20"); ?> </select>
							Superior <select name="x_msup">
								<?php combo("30"); ?> </select>
							Inferior <select name="x_minf">
								<?php combo("20"); ?> </select>
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Orientaci&oacute;n</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<input type="radio" name="x_orientacion" id="x_orientacion" value="0" checked="true">Vertical
							<input type="radio" name="x_orientacion" id="x_orientacion" value="1">Horizontal

						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tama&ntilde;o del Papel</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php if (!(!is_null($x_papel)) || ($x_papel == "")) {
								$x_papel = "Letter";
							} // Set default value 
							?>
							<input type="radio" name="x_papel" id="x_papel" value="Letter" checked="true">Carta
							<input type="radio" name="x_papel" id="x_papel" value="Legal">Oficio
							<input type="radio" name="x_papel" id="x_papel" value="A4">A4
						</span></td>
				</tr>
				<tr>
					<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M&eacute;todo Exportar</span></td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
							<?php if (!(!is_null($x_exportar)) || ($x_exportar == "")) {
								$x_exportar = "pdf";
							} // Set default value 
							?>
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
				<input type="submit" name="Action" value="ADICIONAR">
	</form>
	<?php include("footer.php") ?>
	<?php
	////phpmkr_db_close($conn);
	?>
	<?php

	//-------------------------------------------------------------------------------
	// Function LoadData
	// - Load Data based on Key Value sKey
	// - Variables setup: field variables

	function LoadData($sKey, $conn)
	{
		$sKeyWrk = "" . addslashes($sKey) . "";
		$sSql = "SELECT * FROM vista_formato";
		$sSql .= " WHERE idvista_formato = " . $sKeyWrk;
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
			global $x_item, $x_idvista_formato, $x_nombre, $x_etiqueta, $x_librerias, $x_encabezado,	$x_cuerpo, $x_pie_pagina, $x_margenes, $x_orientacion, $x_papel, $x_exportar, $x_formato_padre, $x_tipo_edicion, $x_banderas, $x_font_size, $x_ruta_mostrar;

			// Get the field contents
			$x_idvista_formato = $row["idvista_formato"];
			$x_nombre = $row["nombre"];
			$x_etiqueta = $row["etiqueta"];
			$x_librerias = $row["librerias"];
			$x_encabezado = $row["encabezado"];
			$x_cuerpo = $row["cuerpo"];
			$x_pie_pagina = $row["pie_pagina"];
			$x_margenes = $row["margenes"];
			$x_orientacion = $row["orientacion"];
			$x_papel = $row["papel"];
			$x_exportar = $row["exportar"];
			$x_formato_padre = $row["formato_padre"];
			$x_banderas = explode(",", $row["banderas"]);
			$x_font_size = $row["font_size"];
			$x_ruta_mostrar = $row["ruta_mostrar"];
		}
		phpmkr_free_result($rs);
		return $LoadData;
	}
	?>
	<?php

	//-------------------------------------------------------------------------------
	// Function AddData
	// - Add Data
	// - Variables used: field variables

	function AddData($conn)
	{
		global $x_item, $x_idvista_formato, $x_nombre, $x_etiqueta, $x_contador_idcontador, $x_ruta_mostrar, $x_librerias, $x_encabezado,	$x_cuerpo, $x_pie_pagina, $x_margenes, $x_orientacion, $x_papel, $x_exportar, $x_tabla, $x_detalle, $x_formato_padre, $x_serie_isdserie, $x_banderas, $x_font_size;


		// Field Banderas
		if (is_array($x_banderas))
			$fieldList["banderas"] = "'" . implode(",", $x_banderas) . "'";

		// Field nombre
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;

		// Field etiqueta
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta) : $x_etiqueta;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["etiqueta"] = $theValue;

		// Field librerias
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_librerias) : $x_librerias;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["librerias"] = $theValue;

		// Field encabezado
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_encabezado) : $x_encabezado;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["encabezado"] = $theValue;

		// Field cuerpo
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_cuerpo) : $x_cuerpo;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["cuerpo"] = $theValue;

		// Field pie_pagina
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_pie_pagina) : $x_pie_pagina;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["pie_pagina"] = $theValue;

		// Field margenes
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_margenes) : $x_margenes;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["margenes"] = $theValue;
		// font_size
		$fieldList["font_size"] = $x_font_size;

		// Field orientacion
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_orientacion) : $x_orientacion;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["orientacion"] = $theValue;

		// Field papel
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_papel) : $x_papel;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["papel"] = $theValue;

		// Field exportar
		$theValue = implode(",", $x_exportar);
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["exportar"] = $theValue;
		if (!is_dir($x_nombre)) {
			mkdir($x_nombre, 0777);
		}

		// Field formato_padre
		$theValue = ($x_formato_padre != 0) ? intval($x_formato_padre) : 0;
		$fieldList["formato_padre"] = $theValue;


		$fieldList["ruta_mostrar"] = "'" . "mostrar_" . $x_nombre . ".php'";
		$fieldList["funcionario_idfuncionario"] = usuario_actual("funcionario_codigo");

		// insert into database
		$strsql = "INSERT INTO vista_formato (";
		$strsql .= implode(",", array_keys($fieldList));
		$strsql .= ") VALUES (";
		$strsql .= implode(",", array_values($fieldList));
		$strsql .= ")";
		phpmkr_query($strsql, $conn) or die("Falla al ejecutar la busqueda " . phpmkr_error() . ' SQL:' . $strsql);
		$idvista_formato = phpmkr_insert_id();
		if ($fieldList["formato_padre"] && $idvista_formato) {
			$formato_padre = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $fieldList["formato_padre"], "", $conn);
		}
		return $idvista_formato;
	}
	?>