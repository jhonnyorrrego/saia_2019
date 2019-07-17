<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "formatos/librerias/estilo_formulario.php");
?>
<?php
$ewCurSec = 0;
?>
<?php

// Initialize common variables
$x_idcaja = Null;
$x_fondo = Null;
$x_subseccion = Null;
$x_division = Null;
$x_codigo = Null;
$x_serie_idserie = Null;
$x_no_carpetas = Null;
$x_no_cajas = Null;
$x_no_consecutivo = Null;
$x_no_correlativo = Null;
$x_fecha_extrema_i = Null;
$x_fecha_extrema_f = Null;
$x_estanteria = Null;
$x_panel = Null;
$x_material = Null;
$x_seguridad = Null;

?>

<?php

$sKey = @$_GET["key"];
if (($sKey == "") || ((is_null($sKey)))) {
	$sKey = @$_GET["key"];
}
if (($sKey == "") || ((is_null($sKey)))) { }

// Get action
$sAction = @$_POST["a_view"];
if (($sAction == "") || ((is_null($sAction)))) {
	$sAction = "I";	// Display with input box
}

switch ($sAction) {
	case "I": // Get a record to display
		if (!LoadData($sKey, $conn)) { // Load Record based on key
		}
}
?>
<?php
echo '<a href="cajaedit.php?key=' . urlencode($sKey) . '">EDITAR</a>&nbsp;&nbsp;';
echo '<a href="../carpeta/folderadd.php?caja_idcaja=' . $sKey . '">ADICIONAR CARPETA</a>&nbsp;&nbsp;';
echo '<a href="../rotulo.php?idcaja=' . $sKey . '">ROTULO</a>&nbsp;&nbsp;';
echo '<a style="color:blue;cursor:pointer" id="ver_carpetas"><u>VER CARPETAS</u></a>&nbsp;&nbsp;';
echo '<a href="' . $ruta_db_superior . 'pantallas/almacenamiento/almacenamientolist.php" target="centro">IR AL LISTADO</a>';
?>
<script src="<?php echo $ruta_db_superior; ?>js/jquery.js"></script>
<script>
	$("#ver_carpetas").click(function() {
		<
		?
		php ? >
			var enlace = 'pantallas/busquedas/consulta_busqueda.php?idbusqueda_componente=<?php
																							$busqueda_componente = busca_filtro_tabla("", "busqueda_componente a", "a.nombre='carpetas'", "", $conn);
																							?>';
		var titulo = 'Carpetas';
		var conector = 'iframe';
		var ancho_columna = '100%';
		var eliminar_hijos = 0;
		var datos_pantalla = {
			kConnector: conector,
			url: enlace,
			kTitle: titulo,
			kWidth: ancho_columna
		};
		if (typeof(parent.parent.crear_pantalla_busqueda) == "function") {
			parent.parent.crear_pantalla_busqueda(datos_pantalla, eliminar_hijos);
		} else if (typeof(parent.crear_pantalla_busqueda) == "function") {
			parent.crear_pantalla_busqueda(datos_pantalla, eliminar_hijos);
		} else if (typeof(crear_pantalla_busqueda) == "function") {
			crear_pantalla_busqueda(datos_pantalla, eliminar_hijos);
		} else
			window.open("<?php echo $busqueda_componente[0]["idbusqueda_componente"]; ?>pantallas/buscador_principal.php?idbusqueda_componente=<?php echo $ruta_db_superior; ?>", "centro");
	});
</script>
<form>
	<table border="0" cellspacing="1" cellpadding="4" bgcolor="#CCCCCC">
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FONDO</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $busqueda_componente[0]["idbusqueda_componente"]; ?>
				</span></td>

			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SUBSECCION</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_fondo; ?>
				</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">DIVISION</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_subseccion; ?>
				</span></td>

			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">CODIGO</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_division; ?>
				</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SERIE</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_codigo; ?>
				</span></td>

			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No CARPETAS</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php
					$serie = busca_filtro_tabla("", "serie", "idserie=" . $x_serie_idserie, "", $conn);
					echo ucfirst(strtolower($serie[0]["nombre"])); ?>
				</span></td>
		</tr>
		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No CAJAS</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_no_carpetas; ?>
				</span></td>

			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No CONSECUTIVO</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_no_cajas; ?>
				</span></td>
		</tr>

		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">No CORRELATIVO</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_no_consecutivo; ?>
				</span></td>

			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA EXTRAMA INICIAL</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_no_correlativo; ?>
				</span></td>
		</tr>

		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">FECHA EXTRAMA FINAL</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_fecha_extrema_i; ?>
				</span></td>

			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">ESTANTERIA</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_fecha_extrema_f; ?>
				</span></td>
		</tr>

		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">PANEL</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_estanteria; ?>
				</span></td>

			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">MATERIAL</span></td>
			<td bgcolor="#F5F5F5"><span class="phpmaker">
					<?php echo $x_panel; ?>
				</span></td>
		</tr>

		<tr>
			<td class="encabezado"><span class="phpmaker" style="color: #FFFFFF;">SEGURIDAD</span></td>
			<td bgcolor="#F5F5F5" colspan="3"><span class="phpmaker">
					<?php echo $x_material; ?>
				</span></td>
		</tr>

	</table>
</form>
<?php
if ($x_seguridad == 1) echo "Confidencial";
if ($x_seguridad == 2) echo "Publica";
if ($x_seguridad == 3) echo "Rutinario";
?>