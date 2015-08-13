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
$x_idalmacenamiento = Null;
$x_documento_iddocumento = Null;
$x_folder_idfolder = Null;
$x_soporte = Null;
$x_num_folios = Null;
$x_anexos = Null;
$x_deterioro = Null;
$x_responsable = Null;
$x_registro_entrada = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || (($sKey == NULL))) {
	ob_end_clean(); 
	header("Location:almacenamientolist.php");
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}

// Open connection to the database
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
		  ob_end_clean();
			header("Location:almacenamientolist.php");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<p><span class="phpmaker">Ver almacenamiento<br><br>
<a href="almacenamientograf.php?folder=<?php echo(@$_REQUEST["folder"]);?>">Regresar al listado</a>&nbsp;
<a href="<?php echo "almacenamientoedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<!--a href="<?php echo  "almacenamientoadd.php?key=" . urlencode($sKey); ?>">Copy</a-->&nbsp;
<!--a href="<?php echo "almacenamientodelete.php?key=" . urlencode($sKey); ?>">Delete</a-->&nbsp;
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">id</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idalmacenamiento; ?>
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">documento</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php $descripdoc = busca_filtro_tabla("A.numero, A.descripcion,A.serie","documento A", "A.iddocumento=".$x_documento_iddocumento, "", $conn);
if($descripdoc["numcampos"]){
?>
<label ><?php echo $descripdoc[0]["numero"]." - ".$descripdoc[0]["descripcion"]; ?></label>
<?php }
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">folder</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$idfolder=$x_folder_idfolder;
$datosfol = busca_filtro_tabla("caja_idcaja, serie_idserie, etiqueta","folder", "idfolder=".$idfolder, "", $conn);
$datoscaja = busca_filtro_tabla("A.numero, A.ubicacion, A.estanteria, A.nivel, A.panel, A.material","caja A", "A.idcaja=".$datosfol[0]["caja_idcaja"], "", $conn);
$datos_serie=busca_filtro_tabla("","serie","idserie=".$datosfol[0]["serie_idserie"],"",$conn);
?>
<table border=0 >
<tr>
  <td class="encabezado">
    ETIQUETA:
  </td>
  <td colspan="3">
    <?php echo(strtoupper($datosfol[0]["etiqueta"]));?>
  </td>
  <td class="encabezado">
    SERIE
  </td>
  <td>
    <?php echo($datos_serie[0]["nombre"]); ?>
  </td>
</tr>
<tr>
<td class="encabezado">CAJA NUMERO:</td><td bgcolor="#F5F5F5"> <?php echo $datoscaja[0]["numero"]; ?></td>
<td class="encabezado">UBICACION:</td><td bgcolor="#F5F5F5"> <?php echo $datoscaja[0]["ubicacion"]; ?></td>
<td class="encabezado">ESTANTERIA:</td><td bgcolor="#F5F5F5"> <?php echo $datoscaja[0]["estanteria"]; ?></td></tr>
<tr><td class="encabezado">NIVEL:</td><td bgcolor="#F5F5F5"> <?php echo $datoscaja[0]["nivel"]; ?></td>
<td class="encabezado">PANEL:</td><td bgcolor="#F5F5F5"> <?php echo $datoscaja[0]["panel"]; ?></td>
<td class="encabezado">MATERIAL:</td><td bgcolor="#F5F5F5"> <?php echo $datoscaja[0]["material"]; ?></td></tr>
</table>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">soporte</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo str_replace(chr(10), "<br>", @$x_soporte); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">no. folios</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_num_folios; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">anexos</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo str_replace(chr(10), "<br>", @$x_anexos); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">deterioro</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<table border="2" style="empty-cells: show; border-collapse:collapse; " >
<tr>
<td class="encabezado">FISICO:</td>
<?php
$opciones=array("RASGADO","MUTILADO","PERFORADO","FALTANTES");
$seleccionado=explode(",",$x_deterioro);

for($j=0;$j<count($opciones);$j++)
  {
   if(in_array(strtolower($opciones[$j]),$seleccionado)){
    echo '<td>';
    echo strtoupper($opciones[$j])."</td>";
   }
  }
?>
</tr><tr>
<td class="encabezado">QUIMICO:</td>
<?php
$opciones=array("OXIDACION","TINTA","SOPORTE DEBIL");

for($j=0;$j<count($opciones);$j++)
  {
   if(in_array(strtolower($opciones[$j]),$seleccionado)){
    echo '<td>';
    echo strtoupper($opciones[$j])."</td>";
   }
  }
?>
</tr><tr><td class="encabezado">BIOLOGICO:</td>
<?php
$opciones=array("HONGOS","INSECTOS","ROEDORES");

for($j=0;$j<count($opciones);$j++)
  {
   if(in_array(strtolower($opciones[$j]),$seleccionado)){
    echo '<td>';
    echo strtoupper($opciones[$j])."</td>";
   }
  }
?>
</tr>
</table>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">responsable</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_responsable; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">registro entrada</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo FormatDateTime($x_registro_entrada,5); ?>
</span></td>
	</tr>
</table>
</form>
<p>
<?php include ("footer.php") ?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
	global $_SESSION;
  $LoadData=busca_filtro_tabla("","almacenamiento","idalmacenamiento=".$sKey,"",$conn);
	if (!$LoadData["numcampos"]) {
		return(false);
	}else{
		$row = $LoadData[0];
		// Get the field contents
		$GLOBALS["x_idalmacenamiento"] = $row["idalmacenamiento"];
		$GLOBALS["x_documento_iddocumento"] = $row["documento_iddocumento"];
		$GLOBALS["x_folder_idfolder"] = $row["folder_idfolder"];
		$GLOBALS["x_soporte"] = $row["soporte"];
		$GLOBALS["x_num_folios"] = $row["num_folios"];
		$GLOBALS["x_anexos"] = $row["anexos"];
		$GLOBALS["x_deterioro"] = $row["deterioro"];
		$GLOBALS["x_responsable"] = $row["responsable"];
		$GLOBALS["x_registro_entrada"] = $row["registro_entrada"];
    return true;
  }
	return false;
}
?>
