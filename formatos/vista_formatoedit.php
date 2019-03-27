<?php session_start(); ?>
<?php ob_start(); ?>
<?php


// Initialize common variables
$x_idvista_formato = Null;
$x_nombre = Null;
$x_etiqueta = Null;
$x_ruta_mostrar = Null;
$x_librerias = Null;
$x_encabezado = Null;
$x_cuerpo = Null;
$x_pie_pagina = Null;
$x_margenes = Null;
$x_orientacion = Null;
$x_papel = Null;
$x_exportar = Null;
$x_formato_padre = Null;
$x_banderas = Null;
$x_font_size = Null;
?>
<?php include ("db.php") ?>
<?php include ("phpmkrfn.php") ?>
<?php include ("librerias/header_formato.php") ?>
<script language=javascript>
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=700,height=500,scrollbars=YES,Resizable=yes");
}
</script> 
<?php
$sKey = @$_GET["key"];
if (($sKey == "") || (is_null($sKey))) { $sKey = @$_POST["key"]; }
if (!empty($sKey)) $sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;

// Get action
$sAction = @$_POST["a_edit"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
} else {
	// Get fields from form
	$x_idvista_formato = @$_POST["x_idvista_formato"];
	$x_nombre = @$_POST["x_nombre"];
	$x_etiqueta = @$_POST["x_etiqueta"];
	$x_ruta_mostrar = @$_POST["x_ruta_mostrar"];
	$x_librerias = @$_POST["x_librerias"];
	$x_encabezado = @$_POST["x_encabezado"];
	$x_cuerpo = @$_POST["x_cuerpo"];
	$x_pie_pagina = @$_POST["x_pie_pagina"];
	$x_margenes = @$_POST["x_mizq"].",".@$_POST["x_mder"].",".@$_POST["x_msup"].",".@$_POST["x_minf"];
	$x_orientacion = @$_POST["x_orientacion"];
	$x_papel = @$_POST["x_papel"];
	$x_exportar = @$_POST["x_exportar"];
  $x_font_size = @$_POST["x_font_size"];
	$x_formato_padre= @$_POST["x_formato_padre"];
	$x_banderas = @$_POST["x_banderas"];
}
if (($sKey == "") || ((is_null($sKey)))) {
	ob_end_clean();
	header("Location: vista_formatolist.php");
	exit();
}
//$conn = phpmkr_db_connect();
$editar=@$_REQUEST["editar"];
if($editar!=""){
  $ledicion=explode(",",$editar);
  $sKey=array_shift($editar);
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
//			//phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: vista_formatolist.php");
			exit();
		}
		break;
	case "U": // Update
		if ($idvista=EditData($sKey,$conn)) { // Update Record based on key
			header("Location: vista_formatoedit.php?key=".$idvista);
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
	if (!EW_onError(EW_this, EW_this.x_nombre, "TEXT", "Por favor Seleccione un Nombre para el Formato"))
		return false;
}
if (EW_this.x_etiqueta && !EW_hasValue(EW_this.x_etiqueta, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_etiqueta, "TEXT", "Por favor seleccione una etiqueta para los Formatos"))
		return false;
}
if (EW_this.x_ruta_mostrar && !EW_hasValue(EW_this.x_ruta_mostrar, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_ruta_mostrar, "TEXT", "Please enter required field - Ruta (Mostrar)"))
		return false;
}
if (EW_this.x_margenes && !EW_hasValue(EW_this.x_margenes, "TEXT" )) {
	if (!EW_onError(EW_this, EW_this.x_margenes, "TEXT", "Por favor seleccione las Margenes (Izquierda,Derecha,Superior,Inferior)"))
		return false;
}
return true;
}

//-->
</script>
<p><span class="phpmaker">Editar Vistas del Formatos<br><br><a href="generar_formato.php?genera=vista&idformato=<?php echo($_REQUEST["key"]); ?>">Generar</a></span></p>
<form name="vista_formatoedit" id="vista_formatoedit" action="vista_formatoedit.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_edit" value="U">
<input type="hidden" name="casilla" id="casilla" value="">
<input type="hidden" name="key" value="<?php echo htmlspecialchars($sKey); ?>">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">idvista_formato</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idvista_formato; ?><input type="hidden" name="x_idvista_formato" value="<?php echo $x_idvista_formato; ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Nombre</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre" id="x_nombre" value="<?php echo htmlspecialchars(@$x_nombre) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Etiqueta</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_etiqueta" id="x_etiqueta" value="<?php echo htmlspecialchars(@$x_etiqueta) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Formato Padre</span></td>
		<td bgcolor="#F5F5F5">
      <span class="phpmaker">
        <?php
          $formatos=busca_filtro_tabla("idformato,nombre,etiqueta","formato A","1=1","nombre DESC",$conn);
          if($formatos["numcampos"]){
            $inicio='<SELECT name="x_formato_padre"><OPTION value="0">PERTENECE A LA RAIZ</OPTION>';
            $fin='</SELECT>';
          }
          for($i=0;$i<$formatos["numcampos"];$i++){
            $check="";
            if($formatos[$i]["idformato"]==$x_formato_padre){
              $check="SELECTED";
            }
            $inicio.='<OPTION value="'.$formatos[$i]["idformato"].'" '.$check.' >'.$formatos[$i]["etiqueta"].'</OPTION>';
          }
          echo($inicio.$fin);
        ?>
      </span>
    </td>
	</tr>	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tipo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
      <input type="checkbox" name="x_banderas[]" id="x_banderas" value="m" <?php if(in_array("m",$x_banderas)) echo("checked");?> >Mostrar
      </span>
    </td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Ruta (Mostrar)</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_ruta_mostrar" id="x_ruta_mostrar" value="<?php echo htmlspecialchars(@$x_ruta_mostrar) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">librerias</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_librerias" id="x_librerias" value="<?php echo htmlspecialchars(@$x_librerias) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Encabezado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php
    $nombre=busca_filtro_tabla("etiqueta","encabezado_formato","idencabezado_formato='".$x_encabezado."'","",$conn);
    if($nombre["numcampos"])
      $mostrar=$nombre[0][0];
    else
      $mostrar="Ninguno";  
    ?>
<input type="hidden" name="x_encabezado" id="x_encabezado" value="<?php if($nombre["numcampos"]) echo $x_encabezado; else echo ""; ?>">
    <label id="x_encabezado_mostrar"><?php echo $mostrar; ?></label>&nbsp;&nbsp;
<a href="javascript:vista_formatoedit.casilla.value='x_encabezado';ventanaSecundaria('encabezadoadd.php?listar=1')">ELEGIR</a>&nbsp;&nbsp;
<label onclick="vista_formatoedit.x_encabezado.value='';document.getElementById('x_encabezado_mostrar').innerHTML='Ninguno'" style="color:blue; text-decoration:underline; cursor:pointer">SIN ENCABEZADO</label>
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
		<?php
    $nombre=busca_filtro_tabla("etiqueta","encabezado_formato","idencabezado_formato='".$x_pie_pagina."'","",$conn);

    if($nombre["numcampos"])
      $mostrar=$nombre[0][0];
    else
      $mostrar="Ninguno";  
    ?>
    <input type="hidden" name="x_pie_pagina" id="x_pie_pagina" value="<?php if($nombre["numcampos"]) echo $x_pie_pagina; else echo ""; ?>">
    <label id="x_pie_pagina_mostrar"><?php echo $mostrar; ?></label>&nbsp;&nbsp;
<a href="javascript:vista_formatoedit.casilla.value='x_pie_pagina';ventanaSecundaria('encabezadoadd.php?listar=1')">ELEGIR</a>
&nbsp;&nbsp;<label onclick="vista_formatoedit.x_pie_pagina='';document.getElementById('x_pie_pagina_mostrar').innerHTML='Ninguno'" style="color:blue; text-decoration:underline; cursor:pointer">SIN PIE DE PAGINA</label>
</span></td>
	</tr>
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tama&ntilde;o de letra</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_font_size" id="x_font_size" size="30" maxlength="150" value="<?php echo htmlspecialchars(@$x_font_size); ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Margenes</span></td>
		<?php
		function combo($valor)
      {$combo_margenes=array('0','5','10','15','20','25','30','35','40','45','50');
       $seleccionado=0;
       
       for($i=0;$i<count($combo_margenes);$i++)
         {echo "<option value='".$combo_margenes[$i]."'";
          if($combo_margenes[$i]==$valor)
            {echo " selected ";
             $seleccionado=1;
            }
          echo ">".$combo_margenes[$i]."</option>";
         }
       if($seleccionado==0)  
         echo "<option value='".$valor."' selected >".$valor."</option>";
      }
    
    $margenes=explode(",",$x_margenes);
    ?>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		Izquierda <select name="x_mizq">
		<?php combo($margenes["0"]); ?>
    </select> 
    Derecha <select name="x_mder">
		<?php combo($margenes["1"]); ?>    </select>
    Superior <select name="x_msup">
		<?php combo($margenes["2"]); ?>    </select>
    Inferior <select name="x_minf">
		<?php combo($margenes["3"]); ?>    </select>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Orientaci&oacute;n</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_orientacion" id="x_orientacion" size="30" maxlength="150" value="<?php echo htmlspecialchars(@$x_orientacion) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Tama&ntilde;o del Papel</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_papel" id="x_papel" size="30" maxlength="150" value="<?php echo htmlspecialchars(@$x_papel) ?>">
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">M&eacute;todo Exportar</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php 
$ar_x_exportar = explode(",",@$x_exportar);
$x_exportarChk = "";
$x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("pdf"). "\"";
foreach ($ar_x_exportar as $cnt_x_exportar) {
	if (trim($cnt_x_exportar) == "pdf") {
		$x_exportarChk .= " checked";
		break;
	}
}
	$x_exportarChk .= ">" . "PDF" . EditOptionSeparator(0);
$x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("xls"). "\"";
foreach ($ar_x_exportar as $cnt_x_exportar) {
	if (trim($cnt_x_exportar) == "xls") {
		$x_exportarChk .= " checked";
		break;
	}
}
	$x_exportarChk .= ">" . "Excel" . EditOptionSeparator(1);
$x_exportarChk .= "<input type=\"checkbox\" name=\"x_exportar[]\" value=\"" . htmlspecialchars("word"). "\"";
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
<input type="submit" name="Action" value="EDIT">
</form>
<?php include ("footer.php") ?>
<?php
////phpmkr_db_close($conn);
?>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
    global $x_item,$x_idvista_formato, $x_nombre, $x_etiqueta,$x_ruta_mostrar,$x_librerias, $x_encabezado,	$x_cuerpo, $x_pie_pagina, $x_margenes, $x_orientacion, $x_papel, $x_exportar, $x_tabla, $x_detalle, $x_formato_padre,$x_banderas,$x_font_family, $x_font_size;
    $formato=busca_filtro_tabla("","vista_formato","idvista_formato=".$sKey,"",$conn);
    $LoadData=0;
    if($formato["numcampos"]){
      $row=$formato[0];
    	// Get the field contents
    	$x_idvista_formato = $row["idvista_formato"];
    	$x_nombre = $row["nombre"];
    	$x_etiqueta = $row["etiqueta"];
    	$x_ruta_mostrar = $row["ruta_mostrar"];
    	$x_librerias = $row["librerias"];
    	$x_encabezado = $row["encabezado"];
    	$x_cuerpo = $row["cuerpo"];
    	$x_pie_pagina = $row["pie_pagina"];
    	$x_margenes = $row["margenes"];
    	$x_orientacion = $row["orientacion"];
    	$x_papel = $row["papel"];
    	$x_exportar = $row["exportar"];
    	$x_formato_padre = $row["formato_padre"];
    	$x_font_size = $row["font_size"];
    	$x_banderas = explode(",",$row["banderas"]);
    	$LoadData=1;
	  }
	return $LoadData;
}
//-------------------------------------------------------------------------------
// Function EditData
// - Edit Data based on Key Value sKey
// - Variables used: field variables

function EditData($sKey,$conn)
{
  global $x_item,$x_idvista_formato, $x_nombre, $x_etiqueta, $x_ruta_mostrar, $x_librerias, $x_encabezado,	$x_cuerpo, $x_pie_pagina, $x_margenes, $x_orientacion, $x_papel, $x_exportar,$x_formato_padre, $x_banderas,$x_font_family,$x_font_size;
	// Open record
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT idvista_formato FROM vista_formato";
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
	$rs = phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
	if (phpmkr_num_rows($rs) == 0) {
		$EditData = false; // Update Failed
	}else{
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_nombre) : $x_nombre; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["nombre"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_etiqueta) : $x_etiqueta; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
  	if(is_array($x_banderas))
	   $fieldList["banderas"] = "'".implode(",",$x_banderas)."'";
	   
		$fieldList["etiqueta"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_ruta_mostrar) : $x_ruta_mostrar; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["ruta_mostrar"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_librerias) : $x_librerias; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["librerias"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_encabezado) : $x_encabezado; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["encabezado"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_cuerpo) : $x_cuerpo; 
		$theValue = ($theValue != "") ? " '" . ($theValue) . "'" : "NULL";
		$fieldList["cuerpo"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_pie_pagina) : $x_pie_pagina; 
		$theValue = ($theValue != "") ? " '" .$theValue . "'" : "NULL";
		$fieldList["pie_pagina"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_margenes) : $x_margenes; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["margenes"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_orientacion) : $x_orientacion; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["orientacion"] = $theValue;
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($x_papel) : $x_papel; 
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["papel"] = $theValue;
		$theValue = implode(",", $x_exportar);
		$theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;
		$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
		$fieldList["exportar"] = $theValue;
 	  $fieldList["font_size"] = $x_font_size;
    // Field formato_padre
	  $theValue = ($x_formato_padre != 0) ? intval($x_formato_padre) : 0;
	  $fieldList["formato_padre"] = $theValue;

		// update
		$sSql = "UPDATE vista_formato SET ";
		foreach ($fieldList as $key=>$temp) {
			$sSql .= "$key = $temp, ";
		}
		if (substr($sSql, -2) == ", ") {
			$sSql = substr($sSql, 0, strlen($sSql)-2);
		}
		$sSql .= " WHERE idvista_formato =". $sKeyWrk;

		phpmkr_query($sSql,$conn) or die("Failed to execute query" . phpmkr_error() . ' SQL:' . $sSql);
		$EditData = true; // Update Successful
  	$idvista_formato=$sKeyWrk;
  	//Se actualizan los campos padre
	}
	return $sKeyWrk;
}
?>
