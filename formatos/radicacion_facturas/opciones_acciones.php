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
if ($_REQUEST['opcion']) {
	switch ($_REQUEST['opcion']) {
		case 'tesoreria' :
			$tipo = 'Para aprobaci%n de tesoreria';
			break;
		case 'juridica' :
			$tipo = 'Para aprobaci%n de jur%dica';
			break;
		case 'contabilidad' :
			$tipo = 'Para aprobaci%n de contabilidad';
			break;
		case 'presupuesto' :
			$tipo = 'Para aprobaci%n de presupuesto';
			break;
		case 'aprobacion_compras' :
			$tipo = 'Para aprobaci%n de Compras';
			break;
	}
	$opciones = busca_filtro_tabla("b.nombre", "cf_acciones a,cf_acciones b", "b.estado=1 and a.idcf_acciones=b.cod_padre and a.nombre like '" . $tipo . "'", "", $conn);

	if ($opciones['numcampos']) {
		$html = '';
		for ($i = 0; $i < $opciones['numcampos']; $i++) {
			$html .= '<tr>
				<td><input type="radio" name="seleccion" class="seleccion" value="' . $opciones[$i]['nombre'] . '">' . $opciones[$i]['nombre'] . '</td>
    		</tr>';
		}
		echo $html;
	}
}
?>