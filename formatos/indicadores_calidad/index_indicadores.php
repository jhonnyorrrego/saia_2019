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

$indicadores=contadores_colores();


$componente_total = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='listar_indicadores_calidad'", "", $conn);
$componente_rojo = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='numero_indicadores_rojo'", "", $conn);
$componente_amarillo = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='numero_indicadores_amarillo'", "", $conn);
$componente_verde = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre='numero_indicadores_verde'", "", $conn);

include_once ($ruta_db_superior . "librerias_saia.php");
echo(librerias_jquery("1.7"));
echo(librerias_acciones_kaiten());
?>

<table class="table table-bordered" style="width:100%;" border="0" align="center">
	<tr>
		<td style="width:50%"><br /><br /></td>
		<td style="width:50%;text-align:right;">
			<a class="link kenlace_saia" style="text-decoration:underline" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_total[0]["idbusqueda_componente"]); ?>" titulo="Todos los Indicadores">Total Indicadores: <?php echo $indicadores["total_indicadores"]; ?></a></td>
	</tr>
	<tr>
		<td rowspan="3" style="text-align:center"><img src="semaforo.jpg" style="width:90px;height:180px"></td>
		<td><a class="link kenlace_saia" style="color:red;text-decoration:underline" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_rojo[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php echo implode(",", $indicadores["rojo"]["idft_indicadores_calidad"]); ?>" titulo="ROJO"><?php echo $indicadores["rojo"]["cantidad"]; ?> INDICADORES EN ZONA ROJA</a></td>
	</tr>
	<tr>
		<td><a class="link kenlace_saia" style="color:#D4AA00;text-decoration:underline" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_amarillo[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php echo implode(",",$indicadores["amarillo"]["idft_indicadores_calidad"]); ?>" titulo="AMARILLO"><?php echo $indicadores["amarillo"]["cantidad"]; ?> INDICADORES EN ZONA AMARILLA</a></td>
	</tr>
	<tr>
		<td><a class="link kenlace_saia" style="color:green;text-decoration:underline" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?idbusqueda_componente=<?php echo($componente_verde[0]["idbusqueda_componente"]); ?>&variable_busqueda=<?php	echo implode(",",$indicadores["verde"]["idft_indicadores_calidad"]); ?>" titulo="VERDE"><?php echo $indicadores["verde"]["cantidad"]; ?> INDICADORES EN ZONA VERDE</a></td>
	</tr>
</table>
