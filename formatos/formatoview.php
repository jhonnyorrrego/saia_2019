<?php session_start(); ?>
<?php ob_start(); ?>
<?php

// Initialize common variables
$x_idformato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_contador_idcontador = Null;
$x_ruta_mostrar = Null;
$x_ruta_editar = Null;
$x_ruta_adicionar = Null;
$x_librerias = Null;
$x_encabezado = Null;
$x_cuerpo = Null;
$x_pie_pagina = Null;
$x_margenes = Null;
$x_orientacion = Null;
$x_papel = Null;
$x_exportar = Null;
$_pertenece_nucleo = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean(); 
	header("Location:formatolist.php"); 
	exit();
}
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

// Open connection to the database

switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
		//	phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: formatolist.php");
			exit();
		}
}
?>
<?php include ("header.php") ?>
<p><br /><a href="<?php echo "formatoedit.php?key=" . urlencode($sKey); ?>">Editar</a>&nbsp;   
<a href="<?php echo $ruta_db_superior; ?>formatos/<?php echo "formatoadd_paso2.php?key=" . urlencode($sKey); ?>">Editar cuerpo</a>&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/campos_formatolist.php?idformato=<?php echo $_REQUEST["key"];?>">Campos del Formato</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/funciones_formatolist.php?idformato=<?php echo $_REQUEST["key"];?>">Funciones del Formato</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/llamado_formatos.php?acciones_formato=formato,adicionar,buscar,editar,mostrar,tabla&accion=generar&condicion=idformato@<?php echo $_REQUEST["key"];?>">Generar el Formato</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/formatoadd.php?x_cod_padre=<?php echo $_REQUEST["key"];?>">Adicionar hijo</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/transferencias_automaticas.php?idformato=<?php echo $_REQUEST["key"];?>">Transferencias automaticas</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/rutas_automaticas.php?idformato=<?php echo $_REQUEST["key"];?>">Rutas</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/formatoexport.php?key=<?php echo $_REQUEST["key"];?>">Exportar Formato</a>
&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>webservice_saia/exportar_importar_formato/exportar_formato/exportar_formato.php?pre_exportar_formato=1&idformato=<?php echo $_REQUEST["key"];?>">Pasar a productivo</a>
</span></p>
</span></p>
<p>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC" width="100%">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Idformato</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idformato; ?>
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
<?php echo(codifica_encabezado(html_entity_decode($x_etiqueta))); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Contador</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if ((!is_null($x_contador_idcontador)) && ($x_contador_idcontador <> "")) {
	$sSqlWrk = "SELECT DISTINCT *  FROM contador";
	$sTmp = $x_contador_idcontador;
	$sTmp = addslashes($sTmp);
	$sSqlWrk .= " WHERE (idcontador = " . $sTmp . ")";
	$rswrk = phpmkr_query($sSqlWrk,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSqlWrk);
	if ($rswrk && $rowwrk = phpmkr_fetch_array($rswrk)) {
		$sTmp = $rowwrk["nombre"];
	}
	@phpmkr_free_result($rswrk);
} else {
	$sTmp = "";
}
$ox_contador_idcontador = $x_contador_idcontador; // Backup Original Value
$x_contador_idcontador = $sTmp;
?>
<?php echo $x_contador_idcontador; ?>
<?php $x_contador_idcontador = $ox_contador_idcontador; // Restore Original Value ?>
</span></td>
	</tr>
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ruta (Mostrar)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_ruta_mostrar; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ruta (Editar)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_ruta_editar; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ruta (Adicionar)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_ruta_adicionar; ?>
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">librerias</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_librerias; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Encabezado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
if($x_encabezado){
  $encab=busca_filtro_tabla("","encabezado_formato","idencabezado_formato=".$x_encabezado,"",$conn);
  if($encab["numcampos"])
    echo($encab[0]["contenido"]);
  else{
    echo("Encabezado no encontrado");
  }  
} 
else{
  echo("Encabezado no asignado");
}
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Cuerpo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo @$x_cuerpo; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Pie de P&aacute;gina</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php
			if($x_pie_pagina){
			  $pie=busca_filtro_tabla("","encabezado_formato","idencabezado_formato=".$x_pie_pagina,"",$conn);
			  if($pie["numcampos"])
			    echo($pie[0]["contenido"]);
			  else{
			    echo("Pie de p&aacute;gina no encontrado");
			  }  
			} 
			else{
			  echo("Pie de p&aacute;gina no asignado");
			}
			?>			
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Margenes(Izq, Der, Sup, Inf)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_margenes; ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Orientaci&oacute;n</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php 
	if($x_orientacion==0){
		echo("Horizontal");
	} 
	else {
		echo("Vertical");
	}
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tama&ntilde;o del Papel</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php 
if(@$x_papel=="A4"){
	echo('A4');
}
if(@$x_papel=="A5"){
	echo('Media carta');
}
if(@$x_papel=="letter"){
	echo('Carta');
}
if(@$x_papel=="legal"){
	echo('Oficio');
}
?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M&eacute;todo Exportar</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php
$ar_x_exportar = explode(",", @$x_exportar);
$sTmp = "";
$rowcntwrk = 0;
foreach($ar_x_exportar as $cnt_x_exportar) {
	switch (trim($cnt_x_exportar)) {
		case "pdf":
			$sTmp .= "PDF";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "xls":
			$sTmp .= "Excel";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
		case "word":
			$sTmp .= "Word (RTF)";
			$sTmp1 = ViewOptionSeparator($rowcntwrk);
			$sTmp .= $sTmp1;
			break;
	}
	$rowcntwrk++;
}
if (strlen($sTmp) > 0) { $sTmp = substr($sTmp, 0, strlen($sTmp)-strlen($sTmp1)); }
$ox_exportar = $x_exportar; // Backup Original Value
$x_exportar = $sTmp;
?>
<?php echo $x_exportar; ?>
<?php $x_exportar = $ox_exportar; // Restore Original Value ?>
</span></td>
	</tr>
	<tr>
    <td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Formato pertenece al n&uacute;cleo</span></td>
    <td bgcolor="#F5F5F5"><span class="phpmaker">
    <?php 
    if(intval($x_pertenece_nucleo)){
      echo("Si");
    }
    else{
      echo('No');
    }
?>
</span></td>
  </tr>
</table>
</form>
<p>
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
	$sSql = "SELECT * FROM formato";
	$sSql .= " WHERE idformato = " . $sKeyWrk;
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
		$GLOBALS["x_idformato"] = $row["idformato"];
		$GLOBALS["x_nombre"] = $row["nombre"];
		$GLOBALS["x_etiqueta"] = $row["etiqueta"];
		$GLOBALS["x_contador_idcontador"] = $row["contador_idcontador"];
		$GLOBALS["x_ruta_mostrar"] = $row["ruta_mostrar"];
		$GLOBALS["x_ruta_editar"] = $row["ruta_editar"];
		$GLOBALS["x_ruta_adicionar"] = $row["ruta_adicionar"];
		$GLOBALS["x_librerias"] = $row["librerias"];
		$GLOBALS["x_encabezado"] = $row["encabezado"];
		$GLOBALS["x_cuerpo"] = $row["cuerpo"];
		$GLOBALS["x_pie_pagina"] = $row["pie_pagina"];
		$GLOBALS["x_margenes"] = $row["margenes"];
		$GLOBALS["x_orientacion"] = $row["orientacion"];
		$GLOBALS["x_papel"] = $row["papel"];
		$GLOBALS["x_exportar"] = $row["exportar"];
		$GLOBALS["x_pertenece_nucleo"] = $row["pertenece_nucleo"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
