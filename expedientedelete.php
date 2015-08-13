<?php session_start(); ?>
<?php ob_start(); ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
$ewCurSec = 0; // Initialise
// Initialize common variables
$x_idexpediente = Null;
$x_nombre = Null;
$x_documento_iddocumento = Null;
$x_fecha = Null;
// Load Key Parameters
$sKey = @$_REQUEST["key"];
include_once ("db.php");
if(@$_REQUEST["cod_padre"]){
  $padre=$_REQUEST["cod_padre"];
}
else{ 
  $dato_padre=busca_filtro_tabla("","expediente","idexpediente=".$sKey,"",$conn);
  if($dato_padre["numcampos"]){
    $padre=$dato_padre[0]["cod_padre"];
  }
  else $padre=0;
}
include_once ("phpmkrfn.php");
if(isset($_GET["idexpediente"]) && ($_GET["idexpediente"]<>""))
{
 $sql_delete = "DELETE FROM expediente_doc where idexpediente_doc=".$_GET["idexpediente"];
 phpmkr_query($sql_delete,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sql_delete);
 if(@$_REQUEST["pantalla"]=="listar")
  redirecciona("expediente_detalles.php?key=$sKey");
 else
  redirecciona("expedienteedit.php?key=$sKey");
}

if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_POST["key_d"];
}
$sDbWhere = "";
$arRecKey = split(",",$sKey);

// Single delete record
if (($sKey == "") || (($sKey == NULL))) {
	redirecciona("expediente_detalles.php?key=".$padre);
}
	$sKey = (get_magic_quotes_gpc()) ? $sKey : addslashes($sKey);
$sDbWhere .= "idexpediente=" . trim($sKey) . "";

// Get action
$sAction = @$_POST["a_delete"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}
include_once("class.funcionarios.php");
$arreglo=array();
$arreglo["listado"]=array();
$funcionarios=array();
$idfunc=usuario_actual("idfuncionario");
/*$datos_prop=busca_datos_administrativos_funcionario($idfunc);
$cargo_compartido=busca_filtro_tabla("","dependencia_cargo A,cargo B","A.cargo_idcargo=B.idcargo AND A.cargo_idcargo IN(".implode(",",$datos_prop["cargos"]).")","",$conn);
$dependencia_compartido=busca_filtro_tabla("","dependencia_cargo A,dependencia B","A.dependencia_iddependencia=B.iddependencia AND funcionario_idfuncionario IN(".implode(",",$datos_prop["dependencias"]).")","",$conn);
$cargos=extrae_campo($cargo_compartido,"funcionario_idfuncionario","U");
$dependencias=extrae_campo($dependencia_compartido,"funcionario_idfuncionario","U");
$funcionarios=array_unique(array_merge((array)$cargos,(array)$dependencias));
sort($funcionarios);   */
listado_hijos_expediente($sKey);
array_push($arreglo["listado"],$sKey);  
$borrables=busca_filtro_tabla("idexpediente,nombre,fecha,ver_todos,editar_todos,nombres,apellidos","expediente,funcionario","propietario=funcionario_codigo and idexpediente IN(".implode(',',$arreglo["listado"]).") and propietario=".usuario_actual("funcionario_codigo"),"",$conn);

switch ($sAction)
{
	case "I": // Display
		if (LoadRecordCount($sDbWhere,$conn) <= 0) {
      alerta("Accion Dudosa " . stripslashes($sKey));
			abrir_url("expediente_principal.php","centro");
			die();
			}
		break;
	case "D": // Delete
		if (DeleteData($sDbWhere,$conn)) {
			alerta("Eliminación Exitosa" . stripslashes($sKey));
			abrir_url("expediente_principal.php","centro");
			die();
		}
		break;
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/expediente.png" border="0">&nbsp;&nbsp;ELIMINAR EXPEDIENTE<br><br><a href="expediente_detalles.php?key=<?php echo($sKey);?>">Regresar al listado</a></span></p>
<?php alerta("Está a punto de eliminar éste expediente y todos los expedientes que se encuentran anidados en él, para usted y todos los que tengan acceso, de igual forma desvinculará todos los documentos de todos los funcionarios almacenados en estos expedientes. ¿Está seguro de realizar este procedimento?");?>
<div style="font-weight:bold; color:red; font-size:13px;font-family:verdana;">Está a punto de eliminar este listado de expedientes borrando el que se encuentra marcado con (*), para usted y todos los que tengan acceso, de igual forma desvinculará todos los documentos que todos los funcionarios tienen almacenados en estos expedientes. ¿Está seguro de realizar este procedimento?</div>
<form action="expedientedelete.php" method="post">
<?php 
if(isset($_REQUEST["pantalla"]))
  echo '<input type="hidden" name="pantalla" value="listar">';
?>
<input type="hidden" name="a_delete" value="D">
<?php $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey; ?>
<input type="hidden" name="key_d" value="<?php echo  htmlspecialchars($sKey); ?>">
<input type="hidden" name="cod_padre" value="<?php echo  htmlspecialchars($padre); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr class="encabezado_list">
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Fecha</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Permisos Dependencia</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Permisos Cargo</span></td>
		<td valign="top"><span class="phpmaker" style="color: #FFFFFF;">Permisos Total</span></td>
	</tr>
<?php
/*
<link rel="STYLESHEET" type="text/css" href="css/dhtmlXTree.css">
<script type="text/javascript" src="js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="js/dhtmlXTree.js"></script>
<br><br>
<div id="treeboxbox_tree2"></div>
<script type="text/javascript">
<!--
		tree2=new dhtmlXTreeObject("treeboxbox_tree2","100%","100%",0);
		tree2.setImagePath("imgs/");
		tree2.enableIEImageFix(true);
    tree2.enableSmartXMLParsing(true);
		tree2.loadXML("test_expediente.php?inicia=<?php echo($sKey); ? >");
		tree2.openItemsDynamic(0);
-->
</script><br><br>

*/
for($i=0;$i<$borrables["numcampos"];$i++){
	// Set row color
	$color = " bgcolor=\"#FFFFFF\"";
  $principal="";
	// Display alternate color for rows
	if ($i % 2 <> 0) {
		$color = " bgcolor=\"#F5F5F5\"";
	}
  if($borrables[$i]["idexpediente"]==$sKey){
    $principal="(*)";
  }
  $asignado=array("No","Si");
  /*$permisosd=mostrar_permiso($borrables[$i]["caracteristica_dependencia"]);
  $permisosc=mostrar_permiso($borrables[$i]["caracteristica_cargo"]);
  $permisost=mostrar_permiso($borrables[$i]["caracteristica_total"]);  */
  $texto.="<tr".$color." align='center'>";
  $texto.="<td class='phpmaker' align='left'>".$borrables[$i]["nombre"].$principal."</td>";
  $texto.="<td class='phpmaker' align='left'>".$borrables[$i]["fecha"]."</td>";
  $texto.="<td class='phpmaker'>".$borrables[$i]["nombres"]." ".$borrables[$i]["apellidos"]."</td>";
  $texto.="<td class='phpmaker'>".$asignado[$borrables[$i]["ver_todos"]]."</td>";
  $texto.="<td class='phpmaker'>".$asignado[$borrables[$i]["editar_todos"]]."</td>";
  $texto.="</tr>";
}
echo($texto);
/*function mostrar_permiso($permiso){
for($i=0;$i<strlen($permiso);$i++){
  switch($permiso[$i]){
    case "l":
      $objeto.='<img border="0px" src="botones/anexos/application.png" alt="Ver">';
    break;
    case "e":
      $objeto.='<img border="0px" src="botones/anexos/application_delete.png" alt="Eliminar">';
    break;
    case "m":
      $objeto.='<img border="0px" src="botones/anexos/application_edit.png" alt="">';
    break;
  }
}
return($objeto);
}   */
?>
</td>
</tr>
<tr>
<td colspan="5" align="center">
<input type="submit" name="Action" value="Confirmar Borrado">
</td>
</tr>
</table>
</form>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT * FROM expediente";
	$sSql .= " WHERE idexpediente = " . $sKeyWrk;
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
	$rs = phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);

		// Get the field contents
		$GLOBALS["x_idexpediente"] = $row["idexpediente"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_documento_iddocumento"] = $row["documento_iddocumento"];
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
	global $_SESSION;
	$sSql = "SELECT * FROM expediente";
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
	$rs = phpmkr_query($sSql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sSql);
	return phpmkr_num_rows($rs);
	phpmkr_free_result($rs);
}
?>
<?php

//-------------------------------------------------------------------------------
// Function DeleteData
// - Delete Records based on input sql criteria sqlKey

function DeleteData($sqlKey,$conn)
{
	global $_SESSION,$arreglo,$sKey,$idfunc,$borrables;
	$listado=extrae_campo($borrables,"idexpediente","");
	$listado_borrables=implode(",",$listado);
	/*Elimina Los Permisos que esten vinculados con ese expediente*/
	$sql="DELETE FROM permiso_expediente_func WHERE expediente_idexpediente IN(".$listado_borrables.")";
	phpmkr_query($sql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sql);
	/*Elimina Los Documentos que esten vinculados con ese expediente*/
	$sql="DELETE FROM expediente_doc WHERE expediente_idexpediente IN(".$listado_borrables.")";
	phpmkr_query($sql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sql);
	/*Elimina Los Expedientes*/
	$sql="DELETE FROM expediente WHERE idexpediente IN(".$listado_borrables.")";
	phpmkr_query($sql,$conn) or die("Falló la búsqueda" . phpmkr_error() . ' SQL:' . $sql);
	$excluidas=busca_filtro_tabla("","expediente","idexpediente IN(".implode(",",$arreglo["listado"]).") AND idexpediente NOT IN(".$listado_borrables.")","",$conn);
	$listado=extrae_campo($excluidas,"idexpediente","");
	$listad_excluidas=implode(",",$listado);
	$sql="UPDATE expediente SET cod_padre=0 WHERE idexpediente IN(".$listado_excluidas.")";
	return true;
}

function  listado_hijos_expediente($padre){
  global $conn,$funcionarios,$arreglo;

  if($padre==0){
    $cond="(cod_padre IS NULL OR cod_padre=0) ";
  }
  else {
    $cond="(cod_padre=".$padre.") ";
  }
    $listado=busca_filtro_tabla("","expediente A",$cond,"nombre ASC",$conn);
  if(!in_array($padre,$arreglo["listado"]) && $listado["numcampos"]){
    $arreglo[$padre]=array();
  }
  for($i=0;$i<$listado["numcampos"];$i++){
    listado_hijos_expediente($listado[$i]["idexpediente"]);
    array_push($arreglo["listado"],$listado[$i]["idexpediente"]);
    array_push($arreglo[$padre],$listado[$i]["idexpediente"]);
  }
  return;
}
?>
