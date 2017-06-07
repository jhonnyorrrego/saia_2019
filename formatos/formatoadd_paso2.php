<?php
include ("db.php");
include ("librerias/header_formato.php");
include_once ("librerias/funciones.php");
$x_encabezado = Null;
$x_cuerpo = Null;
$x_pie_pagina = Null;
$x_nombre_pie = "Ninguno";
$x_nombre_encabezado = "Ninguno";

$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");
$validar_enteros=array("formato","key");
include_once($ruta_db_superior."librerias_saia.php");
$validar_enteros=array("key");
desencriptar_sqli('form_info');
echo(librerias_jquery());

$sAction = @$_POST["a_add"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sKey = @$_GET["key"];
	$sKey = (get_magic_quotes_gpc()) ? stripslashes($sKey) : $sKey;
	if ($sKey != "") {
		$sAction = "C"; // Copy record
	} else {
		$sAction = "I"; // Display blank record
	}
} else {
	// Get fields from form
	$x_encabezado = @$_POST["x_encabezado"];
	$x_cuerpo = @$_POST["x_cuerpo"];
	$x_pie_pagina = @$_POST["x_pie_pagina"];
}

switch ($sAction) {
	case "C" : // Get a record to display
		if (!LoadData($sKey, $conn)) { // Load Record based on key
			$_SESSION["ewmsg"] = "No Record Found for Key = " . $sKey;
			// //phpmkr_db_close($conn);
			ob_end_clean();
			header("Location: formatoview.php?key=" . $sKey);
			exit();
		}
		break;
	case "A" : // Add
		if (AddData($conn)) { // Add New Record
		                      // alerta("Pantalla adicionada");
			ob_end_clean();
			if (usuario_actual('login') == 'cerok') {
				header("Location: " . $ruta_db_superior . "formatos/generar_formato.php?pantalla=tiny&genera=formato&idformato=" . $_REQUEST["formato"]);
			} else {
				header("Location: " . $ruta_db_superior . "formatos/llamado_formatos.php?acciones_formato=formato,adicionar,buscar,editar,mostrar,tabla&accion=generar&condicion=idformato@" . $_REQUEST["formato"]);
			}
			exit();
		}
		break;
}

include ("header.php");
include_once($ruta_db_superior."db.php");
$formato=busca_filtro_tabla("","formato A","A.idformato=".$_REQUEST["key"],"",$conn);
?>
<script language=javascript>
var idformato='<?php echo $_REQUEST["key"]; ?>';
function ventanaSecundaria (URL){
   window.open(URL,"ventana1","width=700,height=500,scrollbars=YES,Resizable=yes");
}
</script>
<script type="text/javascript" src="<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
    hs.graphicsDir = '<?php echo $ruta_db_superior; ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
</script>
<p><span class="phpmaker"><br>
<a href="<?php echo $ruta_db_superior; ?>formatos/formatoedit.php?key=<?php echo $_REQUEST["key"];?>">Editar</a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/campos_formatolist.php?idformato=<?php echo $_REQUEST["key"];?>">Listado de campos</a>&nbsp;&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/funciones_formatolist.php?idformato=<?php echo $_REQUEST["key"];?>">Funciones del Formato</a>&nbsp;&nbsp;
<a href="<?php echo $ruta_db_superior; ?>formatos/llamado_formatos.php?acciones_formato=formato,adicionar,buscar,editar,mostrar,tabla&accion=generar&condicion=idformato@<?php echo $_REQUEST["key"];?>">Generar el Formato</a>
</span></p>
<form name="formatoadd" id="formatoadd" action="formatoadd_paso2.php" method="post">
<p>
<input type="hidden" name="casilla" id="casilla" value="">
<input type="hidden" name="formato" id="formato" value="<?php echo $_REQUEST["key"]; ?>">
<input type="hidden" name="a_add" value="A">
<table border="0" cellspacing="1" cellpadding="4" width=100% bgcolor="#CCCCCC">
<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Encabezado</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<input type="hidden" name="x_encabezado" id="x_encabezado" value="<?php echo @$x_encabezado; ?>">
    <label id="x_encabezado_mostrar"><?php echo @$x_nombre_encabezado; ?></label>&nbsp;&nbsp;
<a href="javascript:formatoadd.casilla.value='x_encabezado';ventanaSecundaria('encabezadoadd.php?listar=1')">ELEGIR</a>
<label onclick="formatoadd.x_encabezado.value='';document.getElementById('x_encabezado_mostrar').innerHTML='Ninguno'" style="color:blue; text-decoration:underline; cursor:pointer">SIN ENCABEZADO</label>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Cuerpo</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<textarea cols="35" rows="4" id="x_cuerpo" name="x_cuerpo" class="tiny_formatos"><?php echo @$x_cuerpo; ?></textarea>
</span></td>
	</tr>
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">Pie de P&aacute;gina</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
    <input type="hidden" name="x_pie_pagina" id="x_pie_pagina" value="<?php echo @$x_pie_pagina; ?>">
    <label id="x_pie_pagina_mostrar"><?php echo @$x_nombre_pie; ?></label>&nbsp;&nbsp;
<a href="javascript:formatoadd.casilla.value='x_pie_pagina';ventanaSecundaria('encabezadoadd.php?listar=1')">ELEGIR</a>
&nbsp;&nbsp;<label onclick="document.getElementById('x_pie_pagina').value='';document.getElementById('x_pie_pagina_mostrar').innerHTML='Ninguno'" style="color:blue; text-decoration:underline; cursor:pointer">SIN PIE DE PAGINA</label>
</span></td>
	</tr>
	</table>
	<input type="submit" name="Action" value="CONTINUAR">
	</form>
<?php
encriptar_sqli("formatoadd",1,"form_info",$ruta_db_superior);	
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
	if (phpmkr_num_rows($rs)==0) {
		$LoadData = false;
	}else{
		$LoadData = true;
		$row = phpmkr_fetch_array($rs);
    global $x_nombre_encabezado,$x_nombre_pie,$x_item,$x_idformato, $x_nombre, $x_etiqueta, $x_contador_idcontador, $x_ruta_mostrar, $x_ruta_editar,	$x_ruta_adicionar, $x_librerias, $x_encabezado,	$x_cuerpo, $x_pie_pagina, $x_margenes, $x_orientacion, $x_papel, $x_exportar, $x_tabla, $x_detalle, $x_cod_padre, $x_tipo_edicion,$x_serie_idserie,$x_banderas,$x_font_size;

		// Get the field contents
		$x_encabezado = $row["encabezado"];
		$x_cuerpo = $row["cuerpo"];
		$x_pie_pagina = $row["pie_pagina"];
		if($x_encabezado){
    $encabezado=busca_filtro_tabla("etiqueta","encabezado_formato","idencabezado_formato=$x_encabezado","",$conn);
		$x_nombre_encabezado=$encabezado[0][0];
		}
		if($x_pie_pagina){
		$pie=busca_filtro_tabla("etiqueta","encabezado_formato","idencabezado_formato=$x_pie_pagina","",$conn);
		$x_nombre_pie=$pie[0][0];
		}
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
  global $x_encabezado,	$x_cuerpo, $x_pie_pagina,$ruta_db_superior;
  $formato=busca_filtro_tabla("","formato","idformato=".$_REQUEST["formato"],"",$conn);
	// Field encabezado
	$fieldList["encabezado"] =limpia_tabla($x_encabezado);

	// Field cuerpo
	$fieldList["cuerpo"] = ($x_cuerpo);

	// Field pie_pagina
	$fieldList["pie_pagina"] = limpia_tabla($x_pie_pagina);

	// insert into database
	$strsql = "update formato set encabezado='".$fieldList["encabezado"]."', pie_pagina='".$fieldList["pie_pagina"]."', cuerpo='".$fieldList["cuerpo"]."' where idformato=".$_REQUEST["formato"];
	guardar_traza($strsql,$formato[0]["nombre_tabla"]);
	phpmkr_query($strsql, $conn) or die("Falla al ejecutar la busqueda " . phpmkr_error() . ' SQL:' . $strsql);
  return true;
}
include_once("footer.php");
?>