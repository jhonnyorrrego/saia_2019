<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
include_once($ruta_db_superior."calendario/calendario.php");

$x_idfolder=Null;
$x_caja_idcaja=Null;
$x_unidad_admin=Null;
$x_subseccion_i=Null;
$x_subseccion_ii=Null;
$x_numero_orden=Null;
$x_nombre_expediente=Null;
$x_no_tomo=Null;
$x_codigo_numero=Null;
$x_fondo=Null;
$x_serie_idserie = Null;
$x_fecha_extrema_i=Null;
$x_fecha_extrema_f=Null;
$x_no_unidad_conservacion=Null;
$x_no_folios=Null;
$x_no_carpeta=Null;
$x_soporte=Null;
$x_frecuencia_consulta=Null;
$x_ubicacion=Null;

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
	$x_caja_idcaja = @$_POST["x_caja_idcaja"];
	$x_unidad_admin=@$_POST["x_unidad_admin"];
	$x_subseccion_i=@$_POST["x_subseccion_i"];
	$x_subseccion_ii=@$_POST["x_subseccion_ii"];
	$x_numero_orden=@$_POST["x_numero_orden"];
	$x_nombre_expediente=@$_POST["x_nombre_expediente"];
	$x_no_tomo=@$_POST["x_no_tomo"];
	$x_codigo_numero=@$_POST["x_codigo_numero"];
	$x_fondo=@$_POST["x_fondo"];
	$x_serie_idserie = @$_POST["x_serie_idserie"];
	$x_fecha_extrema_i=@$_POST["x_fecha_extrema_i"];
	$x_fecha_extrema_f=@$_POST["x_fecha_extrema_f"];
	$x_no_unidad_conservacion=@$_POST["x_no_unidad_conservacion"];
	$x_no_folios=@$_POST["x_no_folios"];
	$x_no_carpeta=@$_POST["x_no_carpeta"];
	$x_soporte=@$_POST["x_soporte"];
	$x_frecuencia_consulta=@$_POST["x_frecuencia_consulta"];
	$x_ubicacion=@$_POST["x_ubicacion"];
}
switch ($sAction)
{
	case "C": // Get a record to display
		break;
	case "A": // Add
		$id=AddData($conn);
		if ($id) { // Add New Record
			abrir_url($ruta_db_superior."pantallas/almacenamiento/arbol_cajas.php?idcaja=".$_REQUEST["x_caja_idcaja"]."&idcarpeta=".$id,"filtro1");
			die();
		}
		break;
}
?>
<script type="text/javascript" src="ew.js"></script>
<script type="text/javascript">
<!--
EW_dateSep = "/"; // set date separator	

//-->
</script>
<script type="text/javascript">
<!--
function EW_checkMyForm(EW_this) {
if (EW_this.x_unidad_admin.value==''){
	alert("Por favor ingrese los campos requeridos - unidad administrativa");
	return false;
}

if (EW_this.x_numero_orden.value==''){
	alert("Por favor ingrese los campos requeridos - numero de orden");
	return false;
}

if (EW_this.x_nombre_expediente.value==''){
	alert("Por favor ingrese los campos requeridos - nombre de expediente");
	return false;
}

if (EW_this.x_no_tomo.value==''){
	alert("Por favor ingrese los campos requeridos - numero de tomo");
	return false;
}

if (EW_this.x_codigo_numero.value==''){
	alert("Por favor ingrese los campos requeridos - codigo numero");
	return false;
}

if (EW_this.x_fondo.value==''){
	alert("Por favor ingrese los campos requeridos - fondo");
	return false;
}

if (EW_this.x_serie_idserie.value==''){
	alert("Por favor ingrese los campos requeridos - serie");
	return false;
}

if (EW_this.x_fecha_extrema_i.value==''){
	alert("Por favor ingrese los campos requeridos - fecha extrema inicial");
	return false;
}

if (EW_this.x_fecha_extrema_f.value==''){
	alert("Por favor ingrese los campos requeridos - fecha extrema final");
	return false;
}

if (EW_this.x_no_unidad_conservacion.value==''){
	alert("Por favor ingrese los campos requeridos - numero de unidad de conservacion");
	return false;
}

if (EW_this.x_no_folios.value==''){
	alert("Por favor ingrese los campos requeridos - numero de folios");
	return false;
}

return true;
}

//-->
</script>
<link rel="STYLESHEET" type="text/css" href="<?php echo $ruta_db_superior; ?>css/dhtmlXTree.css">
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/dhtmlXCommon.js"></script>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>js/dhtmlXTree.js"></script>
<?php include_once($ruta_db_superior."formatos/librerias/header_formato.php"); ?>
<form name="folderadd" id="folderadd" action="folderadd.php" method="post" onSubmit="return EW_checkMyForm(this);">
<p>
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CAJA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php 
    if(@$_REQUEST["caja_idcaja"]){  
    ?>
  		<input type="hidden" name="x_caja_idcaja" id="x_caja_idcaja" value="<?php echo $_REQUEST["caja_idcaja"]; ?>">
  		<?php
      $datoscaja = busca_filtro_tabla("A.fondo","caja A", "A.idcaja=".$_REQUEST["caja_idcaja"], "", $conn);
      if($datoscaja["numcampos"]){
        echo $datoscaja[0]["fondo"];        
      }  
    }
    else{   
    ?>
		<select id="x_caja_idcaja" name="x_caja_idcaja"><option value="0">Seleccione la caja...</option>
		<?php
      $cajas = busca_filtro_tabla("A.fondo, A.idcaja","caja A", "", "", $conn);
      for($i=0; $i<$cajas["numcampos"]; $i++)
        echo "<option value=".$cajas[$i]["idcaja"].">".$cajas[$i]["fondo"]."</option>";
    ?>
    </select>
    <?php } ?>
</span></td>
	</tr>
      
      <tr> 	
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">UNIDAD ADMINISTRATIVA<br>/ SECCION*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php generar_arbol('x_unidad_admin','test_serie.php?tabla=dependencia&estado=1'); ?>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SUBSECCION I</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_subseccion_i" id="x_subseccion_i" size="30" value="<?php echo (@$x_subseccion_i); ?>">
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SUBSECCION II</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_subseccion_ii" id="x_subseccion_ii" size="30" value="<?php echo (@$x_subseccion_ii); ?>">
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NUMERO DE ORDEN*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_numero_orden" id="x_numero_orden" size="30" value="<?php echo (@$x_numero_orden); ?>">
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE EXPEDIENTE*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_nombre_expediente" id="x_nombre_expediente" size="30" value="<?php echo (@$x_nombre_expediente); ?>">
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No DE TOMO*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_no_tomo" id="x_no_tomo" size="30" value="<?php echo (@$x_no_tomo); ?>">
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CODIGO NUMERO*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_codigo_numero" id="x_codigo_numero" size="30" value="<?php echo (@$x_codigo_numero); ?>">
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FONDO*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fondo" id="x_fondo" size="30" value="<?php echo (@$x_fondo); ?>">
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SERIE*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php generar_arbol('x_serie_idserie'); ?>
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA EXTREMA INICIAL*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fecha_extrema_i" id="x_fecha_extrema_i" size="25" maxlength="255" value="" readonly>
</span><?php selector_fecha("x_fecha_extrema_i","folderadd","Y-m-d H:i",date("m"),date("Y"),"default.css",$ruta_db_superior,""); ?></td>
	</tr>	
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA EXTREMA FINAL*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_fecha_extrema_f" id="x_fecha_extrema_f" size="25" maxlength="255" value="" readonly>
</span><?php selector_fecha("x_fecha_extrema_f","folderadd","Y-m-d H:i",date("m"),date("Y"),"default.css",$ruta_db_superior,""); ?></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No UNIDAD CONSERVACION*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_no_unidad_conservacion" id="x_no_unidad_conservacion" size="30" value="<?php echo (@$x_unidad_conversacion); ?>">
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No FOLIOS*</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_no_folios" id="x_no_folios" size="30" value="<?php echo (@$x_no_folios); ?>">
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No CARPETA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="text" name="x_no_carpeta" id="x_no_carpeta" size="30" value="<?php echo (@$x_no_carpeta); ?>">
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SOPORTE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<select name="x_soporte" id="x_soporte">
<option value="">Por favor seleccione...</option>
<option value="1">CD-ROM</option>
<option value="2">DISKETE</option>
<option value="3">DVD</option>
<option value="4">DOCUMENTO</option>
<option value="5">FAX</option>
<option value="6">REVISTA O LIBRO</option>
<option value="7">VIDEO</option>
<option value="8">OTROS ANEXOS</option>
</select>
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FRECUENCIA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<select name="x_frecuencia_consulta" id="x_frecuencia_consulta">
<option value="">Por favor seleccione...</option>
<option value="1">Alta</option>
<option value="2">Media</option>
<option value="3">Baja</option>
</select>
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">UBICACION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<select name="x_ubicacion" id="x_ubicacion">
<option value="">Por favor seleccione...</option>
<option value="1">Central</option>
<option value="2">Gestion</option>
<option value="3">Historico</option>
</select>
</span></td>
	</tr>
	
</table>
<p>
<input type="submit" name="Action" value="Adicionar">
</form>
<?php

//-------------------------------------------------------------------------------
// Function AddData
// - Add Data
// - Variables used: field variables

function AddData($conn)
{
	// Add New Record
	$sSql = "SELECT * FROM folder";
	$sSql .= " WHERE 0 = 1";
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

	// Field caja
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_caja_idcaja"]) : $GLOBALS["x_caja_idcaja"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["caja_idcaja"] = $theValue;
	
	// Field unidad admin
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_unidad_admin"]) : $GLOBALS["x_unidad_admin"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["unidad_admin"] = $theValue;
	
	// Field unidad subseccion I
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_subseccion_i"]) : $GLOBALS["x_subseccion_i"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["subseccion_i"] = $theValue;
	
	// Field unidad subseccion II
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_subseccion_ii"]) : $GLOBALS["x_subseccion_ii"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["subseccion_ii"] = $theValue;

	// Field unidad subseccion II
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_subseccion_ii"]) : $GLOBALS["x_subseccion_ii"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["subseccion_ii"] = $theValue;
	
	// Field numero orden
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_numero_orden"]) : $GLOBALS["x_numero_orden"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["numero_orden"] = $theValue;
	
	// Field nombre expediente
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_nombre_expediente"]) : $GLOBALS["x_nombre_expediente"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["nombre_expediente"] = $theValue;
	
	// Field numero tomo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_no_tomo"]) : $GLOBALS["x_no_tomo"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["no_tomo"] = $theValue;
	
	// Field codigo numero
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_codigo_numero"]) : $GLOBALS["x_codigo_numero"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["codigo_numero"] = $theValue;
	
	// Field fondo
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_fondo"]) : $GLOBALS["x_fondo"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["fondo"] = $theValue;
	
	// Field serie
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_serie_idserie"]) : $GLOBALS["x_serie_idserie"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["serie_idserie"] = $theValue;
	
	// Field fecha extrema inicial
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_fecha_extrema_i"]) : $GLOBALS["x_fecha_extrema_i"]; 
	$theValue = ($theValue != "") ? $theValue : "NULL";
	$fieldList["fecha_extrema_i"] = fecha_db_almacenar($theValue,'Y-m-d H:i');
	
	// Field fecha extrema final
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_fecha_extrema_f"]) : $GLOBALS["x_fecha_extrema_f"]; 
	$theValue = ($theValue != "") ? $theValue : "NULL";
	$fieldList["fecha_extrema_f"] = fecha_db_almacenar($theValue,'Y-m-d H:i');
	
	// Field unidad conversacion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_no_unidad_conservacion"]) : $GLOBALS["x_no_unidad_conservacion"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["no_unidad_conservacion"] = $theValue;
	
	// Field numero de folios
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_no_folios"]) : $GLOBALS["x_no_folios"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["no_folios"] = $theValue;
	
	// Field numero carpeta
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_no_carpeta"]) : $GLOBALS["x_no_carpeta"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["no_carpeta"] = $theValue;
	
	// Field soporte
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_soporte"]) : $GLOBALS["x_soporte"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["soporte"] = $theValue;
	
	// Field frecuencia
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_frecuencia_consulta"]) : $GLOBALS["x_frecuencia_consulta"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["frecuencia_consulta"] = $theValue;
	
	// Field ubicacion
	$theValue = (!get_magic_quotes_gpc()) ? addslashes($GLOBALS["x_ubicacion"]) : $GLOBALS["x_ubicacion"]; 
	$theValue = ($theValue != "") ? " '" . $theValue . "'" : "NULL";
	$fieldList["ubicacion"] = $theValue;
	
	$fieldList["funcionario_idfuncionario"] = usuario_actual("idfuncionario");
  
  // insert into database
	$strsql = "INSERT INTO folder (";
	$strsql .= implode(",", array_keys($fieldList));
	$strsql .= ") VALUES (";
	$strsql .= implode(",", array_values($fieldList));
	$strsql .= ")";	
	//die($strsql);
	phpmkr_query($strsql) or error("Fall� la b�squeda" . phpmkr_error() . ' SQL:' . $sSql);
	$idcarpeta=phpmkr_insert_id();
	return $idcarpeta;
}
function generar_arbol($campo,$ruta_xml='test_serie_funcionario.php'){
	global $ruta_db_superior;
	?>
    <br />  Buscar: <input type="text" id="stext_<?php echo $campo; ?>" width="200px" size="25"><br><a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value),0,1)"> Buscar</a>  |
    <a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value))"> Siguiente</a>  |
    <a href="javascript:void(0)" onclick="tree_<?php echo $campo; ?>.findItem((document.getElementById('stext_<?php echo $campo; ?>').value),1)"> Anterior</a><br /><div id="esperando_<?php echo $campo; ?>"><img src="<?php echo $ruta_db_superior; ?>imagenes/cargando.gif"></div>
    <div id="treeboxbox_tree_<?php echo $campo; ?>"></div>
	<script type="text/javascript">
  <!--
      var browserType;
      if (document.layers) {browserType = "nn4"}
      if (document.all) {browserType = "ie"}
      if (window.navigator.userAgent.toLowerCase().match("gecko")) {
         browserType= "gecko"
      }
			tree_<?php echo $campo; ?>=new dhtmlXTreeObject("treeboxbox_tree_<?php echo $campo; ?>","100%","100%",0);
			tree_<?php echo $campo; ?>.setImagePath("<?php echo $ruta_db_superior; ?>imgs/");
			tree_<?php echo $campo; ?>.enableIEImageFix(true);
			tree_<?php echo $campo; ?>.enableCheckBoxes(1);
			tree_<?php echo $campo; ?>.enableRadioButtons(true);
			tree_<?php echo $campo; ?>.setOnLoadingStart(cargando_<?php echo $campo; ?>);
      tree_<?php echo $campo; ?>.setOnLoadingEnd(fin_cargando_<?php echo $campo; ?>);
			tree_<?php echo $campo; ?>.enableThreeStateCheckboxes(true);
			tree_<?php echo $campo; ?>.loadXML("<?php echo $ruta_db_superior.$ruta_xml; ?>");
			tree_<?php echo $campo; ?>.setOnCheckHandler(onNodeSelect_<?php echo $campo; ?>);
      function fin_cargando_<?php echo $campo; ?>() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
        else
           document.poppedLayer =
              eval('document.layers["esperando_<?php echo $campo; ?>"]');
        document.poppedLayer.style.visibility = "hidden";
      }

      function cargando_<?php echo $campo; ?>() {
        if (browserType == "gecko" )
           document.poppedLayer =
               eval('document.getElementById("esperando_<?php echo $campo; ?>")');
        else if (browserType == "ie")
           document.poppedLayer =
              eval('document.getElementById("esperando_<?php echo $campo; ?>")');
        else
           document.poppedLayer =
               eval('document.layers["esperando_<?php echo $campo; ?>"]');
        document.poppedLayer.style.visibility = "visible";
      }
      function onNodeSelect_<?php echo $campo; ?>(nodeId)
      {valor_destino=document.getElementById("<?php echo $campo; ?>");

       if(tree_<?php echo $campo; ?>.isItemChecked(nodeId))
         {if(valor_destino.value!=="")
          tree_<?php echo $campo; ?>.setCheck(valor_destino.value,false);
          if(nodeId.indexOf("_")!=-1)
             nodeId=nodeId.substr(0,nodeId.indexOf("_"));
          valor_destino.value=nodeId;
         }
       else
         {valor_destino.value="";
         }
      }
	--> 		
	</script>
	<input type="hidden" name="<?php echo $campo; ?>" id="<?php echo $campo; ?>">
	<?php
}
?>
