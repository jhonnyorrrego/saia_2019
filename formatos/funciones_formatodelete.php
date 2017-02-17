<?php session_start(); ?>
<?php ob_start(); ?>
<?php

$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0)
{
if(is_file($ruta."db.php"))
{
$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
}
$ruta.="../";
$max_salida--;
}

// Initialize common variables
$x_idfuncion_formato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_descripcion = Null;
$x_ruta = Null;
$x_formato = Null;
$x_acciones = Null;
?>
<?php include ("db.php");
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
include_once($ruta_db_superior."librerias_saia.php");
desencriptar_sqli('form_info');
echo(librerias_jquery());

?>
<?php
include ("phpmkrfn.php");
include_once("librerias/funciones.php");
?>
<?php

// Load Key Parameters
$sKey = @$_GET["key"];
$idformato=@$_REQUEST["idformato"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_POST["key_d"];
}
$sDbWhere = "";
$arRecKey = split(",",$sKey);

// Single delete record
if (($sKey == "") || ((is_null($sKey)))) {
    if($idformato)
      redirecciona("funciones_formatolist.php?idformato=".$idformato);
    redirecciona("funciones_formatolist.php");
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idfunciones_formato=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount($sDbWhere,$conn) <= 0) {
			phpmkr_db_close($conn);
    if($idformato)
      redirecciona("funciones_formatolist.php?idformato=".$idformato);
    redirecciona("funciones_formatolist.php");
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			$_SESSION["ewmsg"] = "Delete Successful For Key = " . stripslashes($sKey);
			phpmkr_db_close($conn);
    if($idformato)
      redirecciona("funciones_formatolist.php?idformato=".$idformato);
    redirecciona("funciones_formatolist.php");
		}
		break;
}
?>
<?php include ("header.php") ?>
<p><span class="phpmaker">Borrar Funci&oacute;n Formato<br><br><a href="funciones_formatolist.php<?php if($idformato)echo("?idformato=".$idformato);?>">Ir al Listado</a></span></p>
<form id="funciones_formatodelete" name="funciones_formatodelete" action="funciones_formatodelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<input type="hidden" name="idformato" value="<?php echo($idformato);?>">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr  class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">acciones</span></td>
	</tr>
<?php
$nRecCount = 0;
foreach ($arRecKey as $sRecKey) {
	$sRecKey = trim($sRecKey);
	$sRecKey = (get_magic_quotes_gpc()) ? stripslashes($sRecKey) : $sRecKey;
	$nRecCount = $nRecCount + 1;

	// Set row color
	$sItemRowClass = " bgcolor=\"#FFFFFF\"";

	// Display alternate color for rows
	if ($nRecCount % 2 <> 0) {
		$sItemRowClass = " bgcolor=\"#F5F5F5\"";
	}
	if (LoadData($sRecKey,$conn)) {
?>
	<tr<?php echo $sItemRowClass;?>>
		<td><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
		<td><span class="phpmaker">
<?php echo $x_etiqueta; ?>
</span></td>
		<td><span class="phpmaker">
<?php
$ar_x_acciones = explode(",", @$x_acciones);
$sTmp = "";
$rowcntwrk = 0;
foreach($ar_x_acciones as $cnt_x_acciones) {
	switch (trim($cnt_x_acciones)) {
		case "a":
			$sTmp .= "Adicionar";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "m":
			$sTmp .= "Mostrar";
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
if (strlen($sTmp) > 0) { $sTmp = substr($sTmp, 0, strlen($sTmp)-strlen($sTmp1)); }
$ox_acciones = $x_acciones; // Backup Original Value
$x_acciones = $sTmp;
?>
<?php echo $x_acciones; ?>
<?php $x_acciones = $ox_acciones; // Restore Original Value ?>
</span></td>
	</tr>
<?php
	}
}
?>
</table>
<p>
<input type="submit" name="Action" value="CONFIRMAR BORRADO">
</form>
<?php include ("footer.php") ?>
<?php
phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables
encriptar_sqli("funciones_formatodelete",1,"form_info",$ruta_db_superior);
function LoadData($sKey,$conn)
{
	global $x_idfuncion_formato, $x_nombre,	$x_etiqueta, $x_descripcion, $x_ruta, $x_formato, $x_acciones;
  $sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM funciones_formato";
	$sSql .= " WHERE idfunciones_formato = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$x_idfuncion_formato = $row["idfunciones_formato"];
		$x_nombre = $row["nombre"];
		$x_etiqueta = $row["etiqueta"];
		$x_descripcion = $row["descripcion"];
		$x_ruta = $row["ruta"];
		$x_formato = $row["formato"];
		$x_acciones = $row["acciones"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadRecordCount
// - Load Record Count based on input sql criteria sqlKey

function LoadRecordCount($sqlKey,$conn)
{
	$temp=busca_filtro_tabla("count(*)", "funciones_formato","1=1","",$conn);
	if($temp["numcampos"])
    return($temp[0][0]);
  return(0);
}
?>
<?php

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($sqlKey,$conn)
{
	$sSql = "Delete FROM funciones_formato";
	$sSql .= " WHERE " . $sqlKey;
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
	$sql1=$sSql;
	$formato=busca_filtro_tabla("","formato A","A.idformato=".$_REQUEST["idformato"],"",$conn);
	guardar_traza($sql1,$formato[0]["nombre_tabla"]);
	phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	return true;
}
?>
