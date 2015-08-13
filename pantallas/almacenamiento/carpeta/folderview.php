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
include_once ($ruta_db_superior."db.php");
include_once ($ruta_db_superior."formatos/librerias/estilo_formulario.php");

// Initialize common variables
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

$sKey = @$_GET["key"];
if (($sKey == "") || (($sKey == NULL))) {
	$sKey = @$_GET["key"]; 
}
if (($sKey == "") || (($sKey == NULL))) {
}

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || (($sAction == NULL))) {
	$sAction = "I";	// Display with input box
}
switch ($sAction)
{
	case "I": // Get a record to display
		if (!LoadData($sKey,$conn)) { // Load Record based on key
		}
}

echo '<a href="folderedit.php?key='. urlencode($sKey).'">EDITAR</a>&nbsp;&nbsp;';
echo '<a href="../rotulo.php?idcarpeta='.$sKey.'">ROTULO</a>&nbsp;&nbsp;';
echo '<a style="color:blue;cursor:pointer" id="ver_documentos"><u>VER DOCUMENTOS</u></a>&nbsp;&nbsp;';
echo '<a href="'.$ruta_db_superior.'pantallas/almacenamiento/almacenamientolist.php" target="centro">IR AL LISTADO</a>';

?>
	<script src="<?php echo $ruta_db_superior; ?>js/jquery.js"></script>
	<script>
	$("#ver_documentos").click(function(){
		<?php
		$busqueda_componente=busca_filtro_tabla("","busqueda_componente a","a.nombre='vinculados_carpetas'","",$conn);
		?>
	  var enlace = 'pantallas/busquedas/consulta_busqueda.php?idbusqueda_componente=<?php echo $busqueda_componente[0]["idbusqueda_componente"];?>&variable_busqueda=<?php echo $sKey; ?>';
	  var titulo = 'Documentos vinculados';
	  var conector = 'iframe';
	  var ancho_columna ='100%';    
	  var eliminar_hijos=0;
	  var datos_pantalla = { kConnector:conector, url:enlace, kTitle:titulo, kWidth:ancho_columna} ;
	  if(typeof(parent.parent.crear_pantalla_busqueda)=="function"){
	    parent.parent.crear_pantalla_busqueda(datos_pantalla,eliminar_hijos);
	  }
	  else if(typeof(parent.crear_pantalla_busqueda)=="function"){
	    parent.crear_pantalla_busqueda(datos_pantalla,eliminar_hijos);
	  }
	  else if(typeof(crear_pantalla_busqueda)=="function"){   
	    crear_pantalla_busqueda(datos_pantalla,eliminar_hijos);
	  }
	  else
	  	window.open("<?php echo $ruta_db_superior; ?>pantallas/buscador_principal.php?idbusqueda_componente=<?php echo $busqueda_componente[0]["idbusqueda_componente"];?>&variable_busqueda=<?php echo $sKey; ?>","centro");
  });
	</script>
<form>
<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
	<!--tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">id</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
<?php echo $x_idfolder; ?>
</span></td>
	</tr-->
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CAJA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php
    $datoscaja = busca_filtro_tabla("A.fondo","caja A", "A.idcaja=".$x_caja_idcaja, "", $conn);
    echo ucfirst(strtolower($datoscaja[0]["fondo"])); 
    ?>
</span></td>
	
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">UNIDAD ADMINISTRATIVA<br>/SECCION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php 
		$datosdep = busca_filtro_tabla("A.nombre","dependencia A", "A.iddependencia=".$x_unidad_admin, "", $conn);
		echo ucfirst(strtolower($datosdep[0]["nombre"])); 
		?>
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SUBSECCION I</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_subseccion_i; ?>
			</span></td>
	
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SUBSECCION II</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_subseccion_ii; ?>
			</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NUMERO DE ORDEN</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_numero_orden; ?>
			</span></td>
	
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">NOMBRE EXPEDIENTE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_nombre_expediente; ?>
			</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No DE TOMO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_no_tomo; ?>
			</span></td>
	
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CODIGO NUMERO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_codigo_numero; ?>
			</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FONDO</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_fondo; ?>
			</span></td>
	
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SERIE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
		<?php
    $datosserie = busca_filtro_tabla("A.nombre","serie A", "A.idserie in(".$x_serie_idserie.")", "lower(nombre)", $conn);
      echo ucfirst(strtolower($datosserie[0]["nombre"]));
    ?>
</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA EXTRAMA INICIAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_fecha_extrema_i; ?>
			</span></td>
	
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA EXTRAMA FINAL</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_fecha_extrema_f; ?>
			</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No UNIDAD CONSERVACION</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_no_unidad_conservacion; ?>
			</span></td>
	
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No FOLIOS</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_no_folios; ?>
			</span></td>
	</tr>
	
	<tr>
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No CARPETA</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_no_carpeta; ?>
			</span></td>
	
		<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SOPORTE</span></td>
		<td bgcolor="#F5F5F5"><span class="phpmaker">
			<?php echo $x_soporte; ?>
			</span></td>
	</tr>

</table>
</form>
<p>
<?php

//-------------------------------------------------------------------------------
// Function LoadData
// - Load Data based on Key Value sKey
// - Variables setup: field variables

function LoadData($sKey,$conn)
{
global $x_idfolder;
global $x_caja_idcaja;
global $x_unidad_admin;
global $x_subseccion_i;
global $x_subseccion_ii;
global $x_numero_orden;
global $x_nombre_expediente;
global $x_no_tomo;
global $x_codigo_numero;
global $x_fondo;
global $x_serie_idserie;
global $x_fecha_extrema_i;
global $x_fecha_extrema_f;
global $x_no_unidad_conservacion;
global $x_no_folios;
global $x_no_carpeta;
global $x_soporte;
global $x_frecuencia_consulta;
global $x_ubicacion;
	$sKeyWrk = "" . addslashes($sKey) . "";
	$sSql = "SELECT ".fecha_db_obtener('A.fecha_extrema_i','Y-m-d H:i')." as fecha_i, ".fecha_db_obtener('A.fecha_extrema_f','Y-m-d H:i')." as fecha_f, A.* FROM folder A";
	$sSql .= " WHERE A.idfolder = " . $sKeyWrk;
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
	$row = phpmkr_fetch_array($rs);
  if (!$row) {
		$LoadData = false;
	}else{
		$LoadData = true;

		// Get the field contents
		$x_idfolder = $row["idfolder"];
		$x_caja_idcaja = $row["caja_idcaja"];
		$x_unidad_admin=$row["unidad_admin"];
		$x_subseccion_i=$row["subseccion_i"];
		$x_subseccion_ii=$row["subseccion_ii"];
		$x_numero_orden=$row["numero_orden"];
		$x_nombre_expediente=$row["nombre_expediente"];
		$x_no_tomo=$row["no_tomo"];
		$x_codigo_numero=$row["codigo_numero"];
		$x_fondo=$row["fondo"];
		$x_serie_idserie=$row["serie_idserie"];
		$x_fecha_extrema_i=$row["fecha_i"];
		$x_fecha_extrema_f=$row["fecha_f"];
		$x_no_unidad_conservacion=$row["no_unidad_conservacion"];
		$x_no_folios=$row["no_folios"];
		$x_no_carpeta=$row["no_carpeta"];
		$x_soporte=$row["soporte"];
		$x_frecuencia_consulta=$row["frecuencia_consulta"];
		$x_ubicacion=$row["ubicacion"];
	}
	phpmkr_free_result($rs);
	return $LoadData;
}
?>
