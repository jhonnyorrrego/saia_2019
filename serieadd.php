<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."pantallas/expediente/librerias.php");
// Initialize common variables
$x_idserie = Null;
$x_nombre = Null;
$x_cod_padre = Null;
$x_dias_entrega = Null;
$x_codigo = Null;
$x_retencion_gestion = Null;
$x_retencion_central = Null;
$x_conservacion = Null;
$x_seleccion = Null;
$x_otro = Null;
$x_procedimiento = Null;
$x_digitalizacion = Null;
$x_copia = Null;
$x_categoria = Null;
$x_tipo = Null;
//$x_formato =  Null;
?>
<?php include ("phpmkrfn.php") ?>
<?php

// Get action
$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey <> "") {
		$sAction = "C"; // Copy record
	}
	else
	{
		$sAction = "I"; // Display blank record
	}
}
else
{

	// Get fields from form
	$x_idserie = @$_POST["x_idserie"];
	$x_nombre = @$_POST["x_nombre"];
	$x_cod_padre = @$_POST["x_cod_padre"];
	$x_dias_entrega = @$_POST["x_dias_entrega"];
	$x_codigo = @$_POST["x_codigo"];
	$x_retencion_gestion = @$_POST["x_retencion_gestion"];
	$x_retencion_central = @$_POST["x_retencion_central"];
	$x_conservacion = @$_POST["x_conservacion"];
	$x_seleccion = @$_POST["x_seleccion"];
	$x_otro = @$_POST["x_otro"];
	$x_procedimiento = @$_POST["x_procedimiento"];
	$x_digitalizacion = @$_POST["x_digitalizacion"];
	$x_copia = @$_POST["x_copia"];
  $x_categoria = @$_POST["x_categoria"];
	$x_tipo = @$_POST["x_tipo"];
  //$x_formato= @$_POST["x_formato"];
}
switch ($sAction)
{
	case "C": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "Registro " . $sKey." No encontrado";		
			ob_end_clean();
			echo "<script>parent.location='serielist.php';</script>";
			exit();
		}
		break;
	case "A": // Add
		$ok=AddData($conn);
        if($ok){ // Add New Record
        	abrir_url("arbolserie.php","arbol");
					abrir_url("serieview.php?key=".$ok,"_self");
					exit();
				}
				break;
}
?>
<?php include ("header.php") ?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_nombre && !EW_hasValue(EW_this.x_nombre, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor ingrese el campo requerido - Nombre"))
		return false;
}
if (EW_this.x_tipo && !EW_hasValue(EW_this.x_tipo, "RADIO" )) {
	if (!EW_onError(EW_this, EW_this.x_tipo, "RADIO", "Por favor llenar campo requerido - tipo"))
		return false; 
}
if (EW_this.x_cod_padre && !EW_checkinteger(EW_this.x_cod_padre.value)) {
	if (!EW_onError(EW_this, EW_this.x_cod_padre, "TEXT", "Por favor ingrese el campo requerido - cod padre"))
		return false; 
}

if (EW_this.x_dias_entrega && !EW_hasValue(EW_this.x_dias_entrega, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_dias_entrega, "TEXT", "Por favor ingrese el campo requerido - D&iacute;as entrega"))
		return false;
}
if (EW_this.x_dias_entrega && !EW_checkinteger(EW_this.x_dias_entrega.value)) {
	if (!EW_onError(EW_this, EW_this.x_dias_entrega, "TEXT", "Por favor ingrese el campo requerido - D&iacute;as entrega"))
		return false; 
}
if (EW_this.x_retencion_gestion && !EW_checkinteger(EW_this.x_retencion_gestion.value)) {
	if (!EW_onError(EW_this, EW_this.x_retencion_gestion, "TEXT", "Por favor ingrese el campo requerido - Retenci&oacute;n gesti&oacute;n"))
		return false; 
}
if (EW_this.x_retencion_central && !EW_checkinteger(EW_this.x_retencion_central.value)) {
	if (!EW_onError(EW_this, EW_this.x_retencion_central, "TEXT", "Por favor ingrese el campo requerido - Retenci&oacute;n central"))
		return false; 
}
if (EW_this.x_seleccion && !EW_checkinteger(EW_this.x_seleccion.value)) {
	if (!EW_onError(EW_this, EW_this.x_seleccion, "TEXT", "Por favor ingrese el campo requerido - Selecci&oacute;n"))
		return false; 
}
return true;
}

//-->
</script>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/serie.png" border="0">&nbsp;&nbsp;ADICIONAR SERIES DOCUMENTALES<br><br><!--a href="serielistdep.php">Regresar al listado</a--></span></p>
<form name="serieadd" id="serieadd" action="serieadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado" title="Nombre de la serie o subserie"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE *</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Nombre de la serie a la cual pertenece"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$x_cod_padreList = "<select name=\"x_cod_padre\">";
$x_cod_padreList .= "<option value=''>Por favor seleccionar</option>";
$sSqlWrk = "SELECT A.idserie, A.codigo, A.nombre FROM serie A where estado=1" . " ORDER BY A.nombre Asc";
$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
if ($rswrk) {
	$rowcntwrk = 0;
	while ($datawrk = phpmkr_fetch_array($rswrk)) {
		$x_cod_padreList .= "<option value=\"" . htmlspecialchars($datawrk[0]) . "\"";
		if ($datawrk["idserie"] == @$x_cod_padre) {
			$x_cod_padreList .= "' selected";
		}
		$x_cod_padreList .= ">".$datawrk["nombre"].ValueSeparator($rowcntwrk).$datawrk["codigo"]."</option>";
		$rowcntwrk++;
	}
}
@phpmkr_free_result($rswrk);
$x_cod_padreList .= "</select>";
echo $x_cod_padreList;
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Cantidad de d&iacute;as para dar tr&aacute;mite y respuesta al documento"><span class="phpmaker" style="color: #FFFFFF;">TIEMPO DE RESPUESTA (D&Iacute;AS)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_dias_entrega)) || ($x_dias_entrega == "")) { $x_dias_entrega = 8;} // Set default value ?>
<input type="text" name="x_dias_entrega" id="x_dias_entrega" size="30" value="<?php echo htmlspecialchars(@$x_dias_entrega) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="C&oacute;digo de la serie o subserie"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo" id="x_codigo" size="30" maxlength="20" value="<?php echo htmlspecialchars(@$x_codigo) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Cantidad de a&ntilde;os que permanece la subserie en el archivo de gesti&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO GESTI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_retencion_gestion)) || ($x_retencion_gestion == "")) { $x_retencion_gestion = 3;} // Set default value ?>
<input type="text" name="x_retencion_gestion" id="x_retencion_gestion" size="30" value="<?php echo htmlspecialchars(@$x_retencion_gestion) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="Cantidad de a&ntilde;os que permanece la subserie en el archivo central"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO CENTRAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php if (!(!is_null($x_retencion_central)) || ($x_retencion_central == "")) { $x_retencion_central = 5;} // Set default value ?>
<input type="text" name="x_retencion_central" id="x_retencion_central" size="30" value="<?php echo htmlspecialchars(@$x_retencion_central) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado" title="�El documento al pasarse al archivo central ser&aacute; conservado o eliminado?"><span class="phpmaker" style="color: #FFFFFF;">CONSERVACI&Oacute;N / ELIMINACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_conservacion"<?php if (@$x_conservacion == "TOTAL") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("TOTAL"); ?>">
<?php echo "Conservaci&oacute;n total"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_conservacion"<?php if (@$x_conservacion == "ELIMINACION") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("ELIMINACION"); ?>">
<?php echo "Eliminaci&oacute;n"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	<tr>
	<td class="encabezado" title="�El documento al pasarse al archivo central se le har&aacute; una selecci&oacute;n?"><span class="phpmaker" style="color: #FFFFFF;">SELECCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_seleccion"<?php if (@$x_seleccion == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "SI"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_seleccion"<?php if (@$x_seleccion == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "NO"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
		<tr>
		<td class="encabezado" title="�El documento al pasarse al archivo central ser&aacute digitalizado?"><span class="phpmaker" style="color: #FFFFFF;">DIGITALIZACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="radio" name="x_digitalizacion"<?php if (@$x_digitalizacion == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "Si"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_digitalizacion"<?php if (@$x_digitalizacion == "0") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "No"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"  title="Si va a hacerse algo diferente a Conservar, Eliminar o Seleccionar el documento"><span class="phpmaker" style="color: #FFFFFF;">OTRO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_otro" id="x_otro" size="30" maxlength="255" value="<?php echo htmlspecialchars(@$x_otro) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"  title="Describir el procedimiento de conservaci&oacute;n"><span class="phpmaker" style="color: #FFFFFF;">PROCEDIMIENTO CONSERVACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea cols="35" rows="4" id="x_procedimiento" name="x_procedimiento"><?php echo @$x_procedimiento; ?></textarea>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"  title="Decidir si se permite copias de los documentos de este tipo serial"><span class="phpmaker" style="color: #FFFFFF;">PERMITIR COPIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="radio" name="x_copia"<?php if (@$x_copia == "1") { ?> checked<?php } ?> value="<?php echo htmlspecialchars("1"); ?>">
<?php echo "SI"; ?>
<?php echo EditOptionSeparator(0); ?>
<input type="radio" name="x_copia" checked value="<?php echo htmlspecialchars("0"); ?>">
<?php echo "NO"; ?>
<?php echo EditOptionSeparator(1); ?>
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado" title="Definir el tipo de serie que se esta creando" style="text-align: left; background-color:#57B0DE; color: #ffffff;">TIPO *</td>
		<td bgcolor="#F5F5F5">
			<input type="radio" name="x_tipo" value="1">Serie<br>
			<input type="radio" name="x_tipo" value="2">Subserie<br>
			<input type="radio" name="x_tipo" value="3">Tipo documental<br>
		</td>
	</tr>
	
	<tr>
		<td class="encabezado"  title="Categoria a la cual pertenece" >CATEGORIA
		</td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type='radio' name='x_categoria' value='1' id='cat1'  >
    <label for='cat1'>Comunicaciones oficiales</label>
    <input type='radio' name='x_categoria' value='2' id='cat2' checked>
    <label for='cat2'>Produccion Documental</label>
    <input type='radio' name='x_categoria' value='3' id='cat3' >
    <label for='cat3'>Otras categorias</label>
  </span>
    </td>
	</tr>
</table>
<p>
<input type="submit" name="Action" value="Adicionar">
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM serie A";
	$sSql .= " WHERE A.idserie = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idserie"] = $row["idserie"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_cod_padre"] = $row["cod_padre"];
		//$GLOBALS["x_formato"] = $row["formato"];
		$GLOBALS["x_dias_entrega"] = $row["dias_entrega"];
		$GLOBALS["x_codigo"] = $row["codigo"];
		$GLOBALS["x_retencion_gestion"] = $row["retencion_gestion"];
		$GLOBALS["x_retencion_central"] = $row["retencion_central"];
		$GLOBALS["x_conservacion"] = $row["conservacion"];
		$GLOBALS["x_seleccion"] = $row["seleccion"];
		$GLOBALS["x_otro"] = $row["otro"];
		$GLOBALS["x_procedimiento"] = $row["procedimiento"];
		$GLOBALS["x_digitalizacion"] = $row["digitalizacion"];  
		$GLOBALS["x_tipo"] = $row["tipo"];
    //$GLOBALS["x_categoria"] = $row["categoria"];
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

	// Add New Record
	$sSql = "SELECT * FROM serie A";
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

	// Field nombre
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombre"]) : $GLOBALS["x_nombre"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre"] = $theValue;

	// Field cod_padre
	$theValue = ($GLOBALS["x_cod_padre"] != "") ? intval($GLOBALS["x_cod_padre"]) : "NULL";
	$fieldList["cod_padre"] = $theValue;
	
	// Field formato
	// Field conservacion

	// Field dias_entrega
	$theValue = ($GLOBALS["x_dias_entrega"] != "") ? intval($GLOBALS["x_dias_entrega"]) : "NULL";
	$fieldList["dias_entrega"] = $theValue;

	// Field codigo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_codigo"]) : $GLOBALS["x_codigo"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["codigo"] = $theValue;

	// Field retencion_gestion
	$theValue = ($GLOBALS["x_retencion_gestion"] != "") ? intval($GLOBALS["x_retencion_gestion"]) : "NULL";
	$fieldList["retencion_gestion"] = $theValue;

	// Field retencion_central
	$theValue = ($GLOBALS["x_retencion_central"] != "") ? intval($GLOBALS["x_retencion_central"]) : "NULL";
	$fieldList["retencion_central"] = $theValue;

	// Field conservacion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_conservacion"]) : $GLOBALS["x_conservacion"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["conservacion"] = $theValue;

	// Field seleccion
	$theValue = ($GLOBALS["x_seleccion"] != "") ? intval($GLOBALS["x_seleccion"]) : "NULL";
	$fieldList["seleccion"] = $theValue;

	// Field otro
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_otro"]) : $GLOBALS["x_otro"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["otro"] = $theValue;

	// Field procedimiento
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_procedimiento"]) : $GLOBALS["x_procedimiento"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["procedimiento"] = $theValue;

	// Field digitalizacion
	$theValue = ($GLOBALS["x_digitalizacion"] != "") ? intval($GLOBALS["x_digitalizacion"]) : "NULL";
	$fieldList["digitalizacion"] = $theValue;
	
	// Field digitalizacion
	$theValue = ($GLOBALS["x_copia"] != "") ? intval($GLOBALS["x_copia"]) : "NULL";
	$fieldList["copia"] = $theValue;
  $fieldList["categoria"] = $GLOBALS["x_categoria"];
	
	// tipo
	$fieldList["tipo"]="'".$GLOBALS["x_tipo"]."'";
	// insert into database
	$strsql = "INSERT INTO serie (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";

	phpmkr_query($strsql, $conn);
	$id=phpmkr_insert_id();
	insertar_expediente_automatico($id);
	return $id;
}
?>
