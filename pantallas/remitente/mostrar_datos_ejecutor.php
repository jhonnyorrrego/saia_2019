<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_bootstrap());
$sKey = @$_GET["idejecutor"];
$remitente=busca_filtro_tabla("nombre,identificacion,".fecha_db_obtener('fecha_ingreso','Y-m-d')." AS fecha_ingreso","ejecutor","idejecutor=".$sKey,"",$conn);
?>
	<table class="table table-bordered" style="width:50%;margin: 20px">
		<tr>
			<td class="prettyprint" style="width:20%"><b>Identificaci&oacute;n:</b></td>
			<td style="width:30%"><?php echo $remitente[0]["identificacion"]; ?></td>
		</tr>
		<tr>
			<td class="prettyprint"><b>Empresa:</b></td>
			<td><?php echo $remitente[0]["nombre"];; ?></td>
		</tr>
		<tr>
			<td class="prettyprint"><b>Fecha ingreso:</b></td>
			<td><?php echo $remitente[0]["fecha_ingreso"]; ?></td>
		</tr>
	</table>

	<table class="table table-bordered" style="width:95%;margin: 20px">
	<?php if($remitente["numcampos"]){
		?>
		<tr><td colspan="8"><a class="link" href="adicionar_datos_ejecutor.php?idejecutor=<?php echo(@$_REQUEST["idejecutor"]); ?>" target="_self">ADICIONAR DATOS</a></td></tr>
		<?php
	}?>
	<tr>
    <td class="prettyprint"><b>T&iacute;tulo</b></td>
    <td class="prettyprint"><b>Cargo</b></td>
    <td class="prettyprint"><b>Contacto</b></td>
    <td class="prettyprint"><b>Tel&eacute;fono</b></td>
		<td class="prettyprint"><b>Direcci&oacute;n</b></td>
		<td class="prettyprint"><b>Email</b></td>
		<td class="prettyprint"><b>Ciudad</b></td>
		<td class="prettyprint"><b>Fecha del cambio</b></td>
	</tr>
	<?php
	$datos = busca_filtro_tabla("datos_ejecutor.*," . fecha_db_obtener('fecha', 'Y-m-d') . " as fecha", "datos_ejecutor", "ejecutor_idejecutor=".$sKey, "iddatos_ejecutor desc", $conn);
	for ($i = 0; $i < $datos["numcampos"]; $i++) {
		if ($datos[$i]["ciudad"]) {
			$ciudad = busca_filtro_tabla("nombre", "municipio", "idmunicipio=" . $datos[$i]["ciudad"], "", $conn);
			if ($ciudad["numcampos"]){
				$datos[$i]["ciudad"] = $ciudad[0]["nombre"];
			}
		}
		$color="";
		if($i==0){
			$color='style="background-color: #BCF5A9"';
		}
		echo '<tr>
			<td '.$color.'>' . $datos[$i]["titulo"] . '&nbsp;</td>
			<td '.$color.'>' . $datos[$i]["cargo"] . '&nbsp;</td>
			<td '.$color.'>' . $datos[$i]["empresa"] . '&nbsp;</td>
		  <td '.$color.'>' . $datos[$i]["telefono"] . '&nbsp;</td>
			<td '.$color.'>' . $datos[$i]["direccion"] . '&nbsp;</td>
		  <td '.$color.'>' . $datos[$i]["email"] . '&nbsp;</td>
			<td '.$color.'>' . $datos[$i]["ciudad"] . '&nbsp;</td>
			<td '.$color.'>' . $datos[$i]["fecha"] . '&nbsp;</td>
	  </tr>';
	}
	?>	
</table>