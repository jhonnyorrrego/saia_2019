<?php include ("db.php") ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false); 
header("Pragma: no-cache"); // HTTP/1.0 
?>
<?php
$ewCurSec = 0; // Initialise
?>
<?php

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
$x_estado =Null;  
$x_categoria =Null;
$x_tipo=Null;

?>

<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_REQUEST["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_REQUEST["key"]; 
}

if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean(); 
	abrir_url("serielist.php","centro"); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// REQUEST action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

// Open connection to the database
switch ($sAction)
{
	case "I": // REQUEST a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$id=explode("-",$sKey);
			if($id[1]=="categoria")
			  {include ("header.php");
			   echo '<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/serie.png" border="0">&nbsp;&nbsp;VER TIPOS/SERIES DOCUMENTALES<br><br>CATEGORIA: '.$id[2].'<br><br><a href="asignarserie_entidad.php?filtrar_categoria='.$id[0].'">Asignar / Quitar Series</a>'; 
			   include ("footer.php");
        }
			exit();
		}
}
?>
<?php include ("header.php") ?>
<p><span class="internos"><img class="imagen_internos" src="botones/configuracion/serie.png" border="0">&nbsp;&nbsp;VER TIPOS/SERIES DOCUMENTALES<br><br>

<?php 
    if($x_categoria==2 && $x_tipo!=3){
        <a href="serieadd.php?key_padre=<?php echo(urlencode($sKey)); ?>">Adicionar</a>&nbsp;
    }
?>



<a href="<?php echo "serieedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;
<a href="<?php echo "seriedelete.php?key=" . urlencode($sKey); ?>">Desactivar</a>&nbsp;

<?php 
    if($x_categoria==2 && ($x_tipo!=2 && $x_tipo!=3)){
        ?>
        <a href="<?php echo "asignarserie_entidad.php?filtrar_serie=" . urlencode($sKey); ?>">Asignar / Quitar Series</a>&nbsp;&nbsp;
        <?php
    }
?>



</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">IDENTIFICACI&Oacute;N DE LA SERIE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idserie; ?>
</span></td>
	</tr>
	<tr>
	<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_nombre; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE PADRE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if ((!is_null($x_cod_padre)) && ($x_cod_padre <> "")) {
	$sSqlWrk = "SELECT *  FROM serie";
	$sTmp = $x_cod_padre;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (idserie = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["codigo"];
		$sTmp .= ValueSeparator(0) . $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_cod_padre = $x_cod_padre; // Backup Original Value
$x_cod_padre = $sTmp;
?>
<?php echo $x_cod_padre; ?>
<?php $x_cod_padre = $ox_cod_padre; // Restore Original Value ?>
</span></td>
</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">D&Iacute;AS DE ENTREGA BASE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_dias_entrega; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">C&Oacute;DIGO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_codigo; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO GESTI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_retencion_gestion; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">A&Ntilde;OS ARCHIVO CENTRAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_retencion_central; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CONSERVACI&Oacute;N / ELIMINACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
switch ($x_conservacion) {
	case "TOTAL":
		$sTmp = "Conservacion Total";
		break;
	case "ELIMINACION":
		$sTmp = "Eliminacion";
		break;
	default:
		$sTmp = "";
}
$ox_conservacion = $x_conservacion; // Backup Original Value
$x_conservacion = $sTmp;
?>
<?php echo $x_conservacion; ?>
<?php $x_conservacion = $ox_conservacion; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DIGITALIZACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
switch ($x_digitalizacion) {
	case "1":
		$sTmp = "Si";
		break;
	case "0":
		$sTmp = "No";
		break;
	default:
		$sTmp = "";
}
$ox_digitalizacion = $x_digitalizacion; // Backup Original Value
$x_digitalizacion = $sTmp;
?>
<?php echo $x_digitalizacion; ?>
<?php $x_digitalizacion = $ox_digitalizacion; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SELECCI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
switch ($x_seleccion) {
	case "1":
		$sTmp = "SI";
		break;
	case "0":
		$sTmp = "NO";
		break;
	default:
		$sTmp = "";
}
$ox_seleccion = $x_seleccion; // Backup Original Value
$x_seleccion = $sTmp;
?>
<?php echo $x_seleccion; ?>
<?php $x_seleccion = $ox_seleccion; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">OTRO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_otro; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PROCEDIMIENTO CONSERVACI&Oacute;N</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo str_replace(chr(10), "<br>", @$x_procedimiento); ?>
</span></td>
	</tr>	
	
	<tr>
					<td class="encabezado" style="text-align: left; background-color:#57B0DE; color: #ffffff;">TIPO</td>
					<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php
					if($x_tipo==1){
						echo "Serie";
					}
					else if($x_tipo==2){
						echo "Subserie";
					}
					else if($x_tipo==3){
						echo "Tipo documental";
					}
					else echo "No se ha definido";
			?>
					</td>
				</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PERMITIR COPIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php
switch ($x_copia) {
	case "1":
		$sTmp = "SI";
		break;
	case "0":
		$sTmp = "NO";
		break;
	default:
		$sTmp = "";
}
$ox_copia = $x_copia; // Backup Original Value
$x_copia = $sTmp;
?>
<?php echo $x_copia; ?>
<?php $x_copia = $ox_copia; // Restore Original Value ?>
</span></td>
	</tr>	
  <tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTADO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
 if($x_estado==1)
   echo "Activo";
 else
  echo "Inactivo";  
 ?> 
</span></td>
	</tr>
  <tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CATEGORIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
 if($x_categoria==1)
   echo "Comunicaciones oficiales";
 elseif($x_categoria==2)
  echo "Produccion Documental"; 
 elseif($x_categoria==3)
  echo "Otras categorias";  
 ?> 
</span></td>
	</tr>	
</table>
</form>
<p>
<?php include ("footer.php") ?>
<?php if (@$sExport == "") { ?>
	</td>
</tr>
</table>
<?php } ?>

</body>
</html>
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
	$rs = phpmkr_query($sSql,$conn);// or error("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	$row = phpmkr_fetch_array($rs);
	if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;
	
		// REQUEST the field contents
		$GLOBALS["x_idserie"] = $row["idserie"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_cod_padre"] = $row["cod_padre"];
		$GLOBALS["x_dias_entrega"] = $row["dias_entrega"];
		$GLOBALS["x_codigo"] = $row["codigo"];
		$GLOBALS["x_retencion_gestion"] = $row["retencion_gestion"];
		$GLOBALS["x_retencion_central"] = $row["retencion_central"];
		$GLOBALS["x_conservacion"] = $row["conservacion"];
		$GLOBALS["x_seleccion"] = $row["seleccion"];
		$GLOBALS["x_otro"] = $row["otro"];
		$GLOBALS["x_procedimiento"] = $row["procedimiento"];
		$GLOBALS["x_digitalizacion"] = $row["digitalizacion"];
		$GLOBALS["x_copia"] = $row["copia"];
		$GLOBALS["x_estado"] = $row["estado"];
    $GLOBALS["x_categoria"] = $row["categoria"];		
		$GLOBALS["x_tipo"] = $row["tipo"];
    //$GLOBALS["x_formato"] = $row["formato"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
