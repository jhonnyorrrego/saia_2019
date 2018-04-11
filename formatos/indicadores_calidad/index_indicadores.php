<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}

include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "formatos/indicadores_calidad/librerias.php");

$indicadores = contadores_colores();

$componente_total = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='listar_indicadores_calidad'", "", $conn);
$componente_rojo = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='numero_indicadores_rojo'", "", $conn);
$componente_amarillo = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='numero_indicadores_amarillo'", "", $conn);
$componente_verde = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='numero_indicadores_verde'", "", $conn);

include_once ($ruta_db_superior . "librerias_saia.php");
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());
echo(librerias_acciones_kaiten());
?>
<div style="text-align: center">
	<h4>RESUMEN INDICADORES</h4>
	<center><img src="gauge.jpg" width="512" height="319" border="0" usemap="#map" />
	</center>

	<map name="map">
		<area shape="poly" coords="239,238,113,60,52,123,22,194,16,267,205,265,226,257,226,254" alt="<?php echo $indicadores["verde"]["cantidad"]; ?>" class="link kenlace_saia" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_verde[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php	echo implode(",", $indicadores["verde"]["idft_proceso"]); ?>" titulo="VERDE" />
		<area shape="poly" coords="240,238,251,225,275,235,399,61,355,35,280,14,191,22,111,59,110,60,113,60" alt="<?php echo $indicadores["amarillo"]["cantidad"]; ?>" class="link kenlace_saia" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_amarillo[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php echo implode(",", $indicadores["amarillo"]["idft_proceso"]); ?>" titulo="AMARILLO" />
		<area shape="poly" coords="276,237,285,249,286,261,501,254,490,186,451,110,402,60" alt="<?php echo $indicadores["rojo"]["cantidad"]; ?>" class="link kenlace_saia" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_rojo[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php echo implode(",", $indicadores["rojo"]["idft_proceso"]); ?>" titulo="ROJO" />
	</map>

	<span class="btn btn-mini btn-success kenlace_saia" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_verde[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php	echo implode(",", $indicadores["verde"]["idft_proceso"]); ?>" titulo="VERDE" ><?php echo $indicadores["verde"]["cantidad"]; ?>
		Indicador(es)</span>
	<span class="btn btn-mini btn-warning kenlace_saia" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_amarillo[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php echo implode(",", $indicadores["amarillo"]["idft_proceso"]); ?>" titulo="AMARILLO" ><?php echo $indicadores["amarillo"]["cantidad"]; ?>
		Indicador(es)</span>
	<span class="btn btn-mini btn-danger kenlace_saia"  conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_rojo[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php echo implode(",", $indicadores["rojo"]["idft_proceso"]); ?>" titulo="ROJO"><?php echo $indicadores["rojo"]["cantidad"]; ?>
		Indicador(es)</span>
	<span class="btn btn-mini btn-primary kenlace_saia"  conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_total[0]["idbusqueda_componente"]); ?>" titulo="Todos los Indicadores">Total: <?php echo $indicadores["total_indicadores"]; ?> Indicador(es)</span>
</div>