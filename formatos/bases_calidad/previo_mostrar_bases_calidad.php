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
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap());

if (@$_REQUEST['iddoc']) {
	$iddoc = $_REQUEST['iddoc'];
	$condicion = "";
	if ($iddoc != 'todos') {
		$condicion = " AND a.documento_iddocumento=" . $iddoc;
	}
	$style = '<style>
    .table{
        margin:10px;
        width:97%;
        border-radius:5px;
    }
    .table tr th{
        text-align:center;
        font-size:12pt;
        border-top-right-radius: 5px;
        border-top-left-radius: 5px;
    }
    .version_estado .pull-left span{
        font-weight:bold;
    }
    .version_estado .pull-right span{
        font-weight:bold;
    }            
    .version_estado .pull-left,.pull-right{
        font-size:7pt;
    }
  </style>';
	$datos = busca_filtro_tabla("", "ft_bases_calidad a, documento b", "b.iddocumento=a.documento_iddocumento AND b.estado NOT IN ('ELIMINADO','ANULADO','ACTIVO')" . $condicion, "", $conn);
	if ($datos["numcampos"]) {
		$tabla = $style;

		for ($i = 0; $i < $datos['numcampos']; $i++) {
			$serie_seleccionada = busca_filtro_tabla("nombre", "serie", "estado=1 and idserie=" . $datos[$i]['tipo_base_calidad'], "", $conn);
			$tabla .= '<hr/><table class="table table-bordered">';

			$tabla .= '<tr>
	      <th class="encabezado_list">' . ucwords(strtolower(codifica_encabezado($serie_seleccionada[0]['nombre']))) . '</th>
	  </tr>';
			$tabla .= '<tr><td colspan="2" style="text-align:center;">';

			$iddoc_mapa_proceso = busca_filtro_tabla("a.descripcion_base,a.documento_iddocumento,a.tipo_base_calidad", "ft_bases_calidad a, serie b,documento c", "a.documento_iddocumento=c.iddocumento and a.documento_iddocumento = " . $_REQUEST['iddoc'] . " AND a.tipo_base_calidad=b.idserie", "", $conn);
			$consulta_serie_proceso = busca_filtro_tabla("nombre", "serie", "idserie=" . $iddoc_mapa_proceso[0]['tipo_base_calidad'], "", $conn);
			$mapa_proceso = busca_filtro_tabla("", "anexos", "documento_iddocumento=" . $iddoc_mapa_proceso[0]['documento_iddocumento'], "", $conn);

			if (trim(strtolower($consulta_serie_proceso[0]['nombre'])) == 'mapa de procesos') {
				$tabla .= '<img src=' . $ruta_db_superior . $mapa_proceso[0]["ruta"] . ' id="cropbox" border="0" usemap="#Map" />';
			}
			$tabla .= '<tr>
        <td>' . $datos[$i]['descripcion_base'] . '</td>
    </tr> 
    <tr>
        <td class="version_estado"><span class="pull-left"><span>Version:</span> &nbsp; ' . $datos[$i]['version_base_calidad'] . '</span></td>
    </tr>';
			$tabla .= '</table><hr/>';
		}
		echo($tabla);
	}
}
?>