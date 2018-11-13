<?php session_start(); ?>
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
$x_identidad_serie = Null;
$x_entidad_identidad = Null;
$x_serie_idserie = Null;
$x_llave_entidad = Null;
$x_estado = Null;
$x_tipo = Null;
$x_fecha = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php

// Load Key Parameters
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_POST["key_d"];
}
$sDbWhere = "";
$arRecKey = explode(",",$sKey);

// Single delete record
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	alerta("Serie Asignada no encontrado");
	abrir_url("funcionariolist.php","_parent");
	exit(); 
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "identidad_serie=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}
$x_llave_entidad=@$_REQUEST["x_llave_entidad"];
switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount($sDbWhere,$conn) <= 0) {
			phpmkr_db_close($conn);
			//ob_end_clean();
			abrir_url("funcionario.php?key=".@$x_llave_entidad,"_parent");
			exit();
		}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			alerta("Borrado Exitoso");
			phpmkr_db_close($conn);
			//ob_end_clean();
			abrir_url("funcionario.php?key=".@$x_llave_entidad,"_parent");
			exit();
		}
		break;
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/serie.gif" border="0">Borrar series Asignadas<br><br><!--a href="entidad_serielist.php">Regresar al listado</a--></span></p>
<form action="entidad_seriedelete.php" method="post">
<p>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">identidad serie</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Entidad Asociada</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Serie</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Llave de la Entidad</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Estado</span></td>
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
<?php echo $x_identidad_serie; ?>
</span></td>
		<td><span class="phpmaker">
<?php
if ((!is_null($x_entidad_identidad)) && ($x_entidad_identidad <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM entidad";
	$sTmp = $x_entidad_identidad;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (identidad = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_entidad_identidad = $x_entidad_identidad; // Backup Original Value
$x_entidad_identidad = $sTmp;
?>
<?php echo $x_entidad_identidad; ?>
<?php $x_entidad_identidad = $ox_entidad_identidad; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php
if ((!is_null($x_serie_idserie)) && ($x_serie_idserie <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM serie";
	$sTmp = $x_serie_idserie;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (idserie = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
		$sTmp .= ValueSeparator(0) . $rowwrk["codigo"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_serie_idserie = $x_serie_idserie; // Backup Original Value
$x_serie_idserie = $sTmp;
?>
<?php echo $x_serie_idserie; ?>
<?php $x_serie_idserie = $ox_serie_idserie; // Restore Original Value ?>
</span></td>
		<td><span class="phpmaker">
<?php 
echo $x_llave_entidad; ?>
<input type="hidden" name="x_llave_entidad" value="<?php echo  $x_llave_entidad; ?>">

</span></td>
		<td><span class="phpmaker">
<?php echo $x_estado; ?>
</span></td>
	</tr>
<?php
	}
}
?>
</table>
<p>
<input type="submit" name="Action" value="Confirmar Borrado">
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
function LoadData($sKey,$conn)
{
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM entidad_serie";
	$sSql .= " WHERE identidad_serie = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_identidad_serie"] = $row["identidad_serie"];
		$GLOBALS["x_entidad_identidad"] = $row["entidad_identidad"];
		$GLOBALS["x_serie_idserie"] = $row["serie_idserie"];
		$GLOBALS["x_llave_entidad"] = $row["llave_entidad"];
		$GLOBALS["x_estado"] = $row["estado"];
		$GLOBALS["x_tipo"] = $row["tipo"];
		$GLOBALS["x_fecha"] = $row["fecha"];
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
	$sSql = "SELECT * FROM entidad_serie";
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
	$rs = phpmkr_query($sSql,$conn) or die("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	return phpmkr_num_rows($rs);
	phpmkr_free_result($rs);
}
?>
<?php

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey
function eliminar_permiso($id)
{global $conn;
 phpmkr_query("DELETE from entidad_serie where identidad_serie=$id",$conn);
}

function buscar_padres($idserie)
{global $conn;
 $lista=array();
 $padre=busca_filtro_tabla("cod_padre","serie","cod_padre is not null and idserie=$idserie","",$conn);
 if($padre["numcampos"])
   {$lista[0]=$padre[0][0]; 
    $lista=array_merge($lista,buscar_padres($padre[0][0]));
   }  
 return($lista);  
}

function DeleteData($sqlKey,$conn)
{global $conn;
//eliminar el permiso para la serie seleccionada

 //busco a quien pertenece el permiso
 $serie=busca_filtro_tabla("","entidad_serie",$sqlKey,"",$conn);
 //busco si tiene hijos para borrarlos
 $resultado=busca_filtro_tabla("identidad_serie","entidad_serie,serie","serie_idserie=idserie and cod_padre=".$serie[0]["serie_idserie"]." and entidad_identidad=".$serie[0]["entidad_identidad"]." and  entidad_serie.llave_entidad=".$serie[0]["llave_entidad"],"",$conn);

   if($resultado["numcampos"])
     {for($j=0;$j<$resultado["numcampos"];$j++)
         eliminar_permiso($resultado[$j][0]);
     }
 //quito el permiso a la serie    
 $id=str_replace("identidad_serie=","",$sqlKey);

 eliminar_permiso($serie[0]["identidad_serie"]);
 //busco si los padres ya no tiene mas hijos y de ser asi los elimino
 $padres=buscar_padres($serie[0]["serie_idserie"]);
 for($i=0;$i<count($padres);$i++)
   {$resultado=busca_filtro_tabla("count(identidad_serie)","entidad_serie,serie","serie_idserie=idserie and cod_padre=".$padres[$i]." and entidad_identidad=".$serie[0]["entidad_identidad"]." and entidad_serie.llave_entidad=".$serie[0]["llave_entidad"].")","",$conn);
   if(!$resultado[0][0])
      {phpmkr_query("DELETE from entidad_serie where serie_idserie=".$padres[$i]." and entidad_identidad=".$serie[0]["entidad_identidad"]." and entidad_serie.llave_entidad=".$serie[0]["llave_entidad"],$conn);
      }
   } 

	return true;
}
?>
