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
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ($ruta_db_superior . "formatos/informe_contraloria/funciones.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo librerias_jquery("1.7");
?>
<script type="text/javascript" src="<?php echo $ruta_db_superior;?>pantallas/lib/acciones_kaiten.js"></script>

<?php

$config = busca_filtro_tabla("valor", "configuracion", "nombre='color_encabezado'", "", $conn);
$style = "";
if ($config["numcampos"]) {
	$style = "
<style type=\"text/css\">
	.phpmaker{
	font-family: Verdana,Tahoma,arial;
	color:#000000;
	}
	.encabezado{
	background-color:" . $config[0]["valor"] . ";
	color:white ;
	padding:10px;
	text-align: left;
	}
	.encabezado_list{
	background-color:" . $config[0]["valor"] . ";
	color:white ;
	vertical-align:middle;
	text-align: center;
	font-weight: bold;
	}
</style>";
}
echo $style;
echo reporte();
function reporte() {
	global $conn, $ruta_db_superior;
	
	$iddoc = $_REQUEST["iddoc"];
	$idformato = $_REQUEST["idformato"];
	$format_hallazgo = busca_filtro_tabla("", "formato a", "a.nombre='hallazgo'", "", $conn);
	$plan_mejoramiento = busca_filtro_tabla("", "ft_plan_mejoramiento a, documento b", "a.documento_iddocumento=b.iddocumento AND a.documento_iddocumento=" . $iddoc, "", $conn);

	$porcentaje = porcentaje_plan('', '', '', $plan_mejoramiento[0]["idft_plan_mejoramiento"]);
	$hallazgos = busca_filtro_tabla(fecha_db_obtener('tiempo_cumplimiento', 'Y-m-d') . " as fecha_cumpl, a.*, b.*", "ft_hallazgo a, documento b", "a.ft_plan_mejoramiento=" . $plan_mejoramiento[0]["idft_plan_mejoramiento"] . " and a.documento_iddocumento=b.iddocumento and b.estado not in('ELIMINADO', 'ANULADO')", "idft_hallazgo asc", $conn);

	if ($_REQUEST["idformato"] != '' & $_REQUEST["tipo"] != 5) {
		$tabla .= '<a href="' . $ruta_db_superior . 'class_impresion.php?url=formatos/plan_mejoramiento/reporte_hallazgos_cumplimiento.php?tipo=5|iddoc=' . $iddoc . '|idformato=' . $idformato . '&horizontal=1&tipo=5&landscape=horizontal&orientacion=L" target="_blank"><img src="' . PROTOCOLO_CONEXION . RUTA_PDF . '/enlaces/imprimir.gif"></a>';
	}

	$tabla .= '<center>
				<b><h3 style="text-align: center;">Reporte de Avance Plan de Mejoramiento</h3></b><br />
				<table style="border-collapse: collapse; width: 100%; attr-margin-left: -33px; font-size:7pt;" border="1">
					<tbody>
					<tr>
						<td style="width:20%; text-align: center;"><b>Plan de mejoramiento No.</b><br />' . $plan_mejoramiento[0]['numero'] . '</td>
						<td style="width:20%; text-align: center;"><b>Fecha</b><br />' . date('Y-m-d') . '</td>
						<td style="width:40%; text-align: center;"><b>Descripci&oacute;n del plan</b>' . $plan_mejoramiento[0]['descripcion_plan'] . '</td>						
						<td style="width:20%; text-align: center;"><b>Cumplimiento del <br />Plan de mejoramiento</b><center><br />' . $porcentaje . '%</td>
					</tr>
					</tbody>
				</table>
			</center><br /><br />';

	$tabla .= '<table style="font-size:7pt;border-collapse:collapse; font-family:verdana;" border="1px">';
	if ($hallazgos["numcampos"]) {
		$tabla .= '<tr class="encabezado_list">';
		if ($_REQUEST["idformato"] != '') {
			$tabla .= '<td style="width:3%"></td>';
		}
		$tabla .= '<td style="width:8%">Consecutivo hallazgo</td>';
		$tabla .= '<td style="width:26%">Deficiencia</td>';
		$tabla .= '<td style="width:18%">Acci&oacute;n de mejoramiento</td>';
		$tabla .= '<td style="width:10%">Responsables de mejoramiento</td>';
		$tabla .= '<td style="width:8%">Tiempo programado para cumpliemiento</td>';
		$tabla .= '<td style="width:12%">Logros alcanzados</td>';
		$tabla .= '<td style="width:9%">Observaciones</td>';
		$tabla .= '<td style="width:6%">Avances</td>';
		$tabla .= '</tr>';
		for ($i = 0; $i < $hallazgos["numcampos"]; $i++) {
			$tabla .= '<tr>';
			if ($_REQUEST["idformato"] != '') {
				if ($_REQUEST['tipo'] == 5) {
					$tabla .= '<td><a href="' . PROTOCOLO_CONEXION . RUTA_PDF . '/class_impresion.php?idformato=' . $format_hallazgo[0]["idformato"] . '&iddoc=' . $hallazgos[$i]["documento_iddocumento"] . '" target="_self">Ver</a></td>';
				} else {
					$tabla .= '<td><a class="kenlace_saia" conector="iframe" titulo="Radicado No. '.$hallazgos[$i]["numero"].'" enlace="ordenar.php?mostrar_formato=1&key=' . $hallazgos[$i]["documento_iddocumento"] . '">Ver</a></td>';
				}
			}
			$tabla .= '<td style="text-align:center">' . $hallazgos[$i]["consecutivo_hallazgo"] . '</td>';
			$tabla .= '<td>' . (codifica_encabezado(html_entity_decode($hallazgos[$i]["deficiencia"]))) . '</td>';
			$tabla .= '<td>' . codifica_encabezado(html_entity_decode($hallazgos[$i]["accion_mejoramiento"])) . '</td>';
			$tabla .= '<td>' . convertir($hallazgos[$i]["responsables"], 'responsables', $hallazgos[$i]["iddocumento"], $format_hallazgo[0]["idformato"]) . '</td>';
			$tabla .= '<td style="text-align:center">' . $hallazgos[$i]["fecha_cumpl"] . '</td>';

			$seguimiento_plan_mejoramiento = busca_filtro_tabla("logros_alcanzados, observaciones", "ft_seguimiento", "ft_hallazgo=" . $hallazgos[$i]['idft_hallazgo'], "", $conn);
			if ($seguimiento_plan_mejoramiento['numcampos']) {
				$logros_alcanzados = array_filter(extrae_campo($seguimiento_plan_mejoramiento, "logros_alcanzados", "z"));

				if ($logros_alcanzados) {
					$logros = "<ul>";
					foreach ($logros_alcanzados as $value) {
						$logros .= "<li>" . $value . "</li>";
					}
					$logros .= "</ul>";
				} else {
					$logros .= "&nbsp;";
				}
				$observaciones = array_filter(extrae_campo($seguimiento_plan_mejoramiento, "observaciones", "z"));
				if ($observaciones) {
					$observacion = "<ul>";
					foreach ($observaciones as $value) {
						$observacion .= "<li>" . $value . "</li>";
					}
					$observacion .= "</ul>";
				} else {
					$observacion = "&nbsp";
				}
				$tabla .= '<td>' . codifica_encabezado(html_entity_decode($logros)) . '</td>';

				$tabla .= '<td>' . codifica_encabezado(html_entity_decode($observacion)) . '</td>';
			} else {
				$tabla .= '<td>&nbsp;</td>';
				$tabla .= '<td>&nbsp;</td>';
			}
			$tabla .= '<td>' . avances($hallazgos[$i]["idft_hallazgo"]) . '</td>';
			$tabla .= '</tr>';

		}
		$tabla .= '</table>';
	} else {

	}
	return $tabla;
}

function convertir($valor, $campo, $iddoc = null, $idformato = null) {
	global $conn;
	switch($campo) {
		case 'clase_observacion' :
			if ($valor == 1)
				$retorno = 'Hallazgo Administrativo';
			if ($valor == 2)
				$retorno = 'No conformidades';
			if ($valor == 3)
				$retorno = 'Observaciones';
			break;
		case 'responsables' :
			$retorno = ucwords(strtolower(mostrar_valor_campo($campo, $idformato, $iddoc, 1)));
			break;
	}
	return $retorno;
}

function avances($idpapa) {
	global $conn;
	$porcentajes = busca_filtro_tabla_limit("a.idft_seguimiento,a.porcentaje", "ft_seguimiento a, ft_hallazgo b, documento c", "a.documento_iddocumento=c.iddocumento and lower(c.estado) not in('eliminado','anulado') and b.idft_hallazgo =a.ft_hallazgo and b.idft_hallazgo=" . $idpapa, " order by a.idft_seguimiento desc", intval(0), intval(1), $conn);
	$avance[0] = $porcentajes[0]["porcentaje"];
	if ($avance[0] >= 100) {
		$texto = "<span style='color:green'>" . $avance[0] . "%</span>";
	} else {
		$texto = "<span style='color:red'>" . $avance[0] . "%</span>";
	}
	return $texto;
}
?>