<form method="post" action="#">
	<table>
		<tr>
			<td>
			<input type="hidden" value="1" name="evaluar">
			Ruta Inicio relativa al script </td>

			<td>
			<input type="text" name="ruta_defecto" value=".">
			</td>
		</tr>
		<tr>
			<td> Contenido a Buscar </td>
			<td>			<textarea name="contenido"><?php echo @$_REQUEST["contenido"]; ?></textarea></td>
		</tr>

		<!--tr>
		<td>
		Reemplazar el contenido?
		</td>
		<td>
		<input name="reemplazar" type="radio" value="1">SI <input name="reemplazar" type="radio" value="0" checked="true">NO
		</td>
		</tr>
		<tr>
		<td>
		Contenido a Reemplazar
		</td>
		<td>
		<textarea name="contenido_reemplazo"></textarea>
		</td>
		</tr-->
		<tr>
			<td colspan="2">
			<input type="submit">
			</td>
		</tr>
	</table>
</form>

<?php

$cont = 0;

if (@$_REQUEST["evaluar"] && @$_REQUEST["contenido"] != '' && @$_REQUEST["ruta_defecto"] != '') {

	buscar($_REQUEST["ruta_defecto"]);

	echo("Archivos evaluados " . $cont);

}

function buscar($dir) {
	global $cont;
	if (!$dh = @opendir($dir)) {
		return;
	}

	while (false !== ($obj = readdir($dh))) {
		if ($obj == '.' || $obj == '..') {
			continue;
		}
		$cont++;
		if ($obj <> "busca_infecciones.php" && filesize($dir . '/' . $obj)) {
			$ar = fopen($dir . '/' . $obj, "r");
			$contenido = fread($ar, filesize($dir . '/' . $obj));
			fclose($ar);
			if (strpos($contenido, $_REQUEST["contenido"]) !== false) {
				echo "<span style='color:red;'>" . $dir . '/' . $obj . " ENCONTRADO</span><hr>";
				if (@$_REQUEST["reemplazar"]) {
					$contenido = str_replace($_REQUEST["contenido"], @$_REQUEST["contenido_reemplazo"], $contenido);
					$ar = fopen($dir . '/' . $obj, "w");
					$evaluado = fwrite($ar, $contenido);
					fclose($ar);
					if (strpos($contenido, $_REQUEST["contenido"]) === false && $evaluado) {
						echo "<span style='color:green;'>" . $dir . '/' . $obj . " REEMPLAZADO</span><hr>";
					}
				}
			}
		}
		buscar($dir . '/' . $obj);
	}
	closedir($dh);
	return;
}
?>