<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "formatos/librerias/funciones_generales.php");
include_once ($ruta_db_superior . "librerias_saia.php");

/*POSTERIOR ADICIONAR-EDITAR*/
function post_add_edit_ruta_proceso($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$datos = busca_filtro_tabla("revisado_por,aprobado_por", "ft_proceso", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($datos["numcampos"]) {
		$ruta = array();
		if ($datos[0]["revisado_por"] != "") {
			array_push($ruta, array("funcionario" => $datos[0]["revisado_por"], "tipo_firma" => 1, "tipo" => 5));
		}
		if ($datos[0]["aprobado_por"] != "") {
			array_push($ruta, array("funcionario" => $datos[0]["aprobado_por"], "tipo_firma" => 1, "tipo" => 5));
		}
		if (count($ruta)) {
			insertar_ruta($ruta, $iddoc, 1);
		}
	}
}

/*MOSTRAR*/
function icono_detalles($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	if ($_REQUEST["tipo"] != 5) {
		$funcionario = usuario_actual("funcionario_codigo");
		$responsable = busca_filtro_tabla("", "documento A, ft_proceso B", "(A.iddocumento=B.documento_iddocumento AND iddocumento=" . $iddoc . ") AND (A.ejecutor=" . $funcionario . " OR permisos_acceso like '%,$funcionario' or permisos_acceso like '$funcionario' or permisos_acceso like '%,$funcionario,%' or permisos_acceso like '$funcionario,%' OR lider_proceso like '%,$funcionario' or lider_proceso like '$funcionario' or lider_proceso like '%,$funcionario,%' or lider_proceso like '$funcionario,%' OR B.responsable like '%,$funcionario' or B.responsable like '$funcionario' or B.responsable like '%,$funcionario,%' or B.responsable like '$funcionario,%')", "", $conn);

		if ($responsable["numcampos"] > 0 || $_SESSION["LOGIN" . LLAVE_SAIA] == "cerok") {
			$nombre_proceso = busca_filtro_tabla("nombre", "ft_proceso A", "A.documento_iddocumento=" . $iddoc, "", $conn);
			echo "<a class='kenlace_saia' conector='iframe' title='" . $nombre_proceso[0]["nombre"] . "' titulo='" . $nombre_proceso[0]["nombre"] . "' enlace='ordenar.php?accion=mostrar&mostrar_formato=1&key=" . $iddoc . "' style='cursor:pointer'><img border=0 src='../../botones/comentarios/detalles.png' /></a>";
		}
	}
}

function link_cuadro_mando($idformato, $iddoc) {
	global $conn;
	if ($_REQUEST["tipo"] != 5) {
		$radicador = new PERMISO();
		$permiso = $radicador -> acceso_modulo_perfil("cuadro_control_indicadores");
		if ($permiso) {
			echo "<a target='_self' href='cuadro_mando_indicadores.php?proceso=" . $iddoc . "'>Cuadro de mando Indicadores</a>";
		}
	}
}

function listar_politicas_proceso($idformato, $iddoc) {
	global $conn;
	$proceso = busca_filtro_tabla("idft_proceso", "ft_proceso", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($proceso["numcampos"]) {
		$campos = array("nombre", "soporte");
		$texto = listar_formato_hijo($campos, "ft_politicas_proceso", "ft_proceso", $proceso[0]["idft_proceso"], "idft_politicas_proceso ASC", 'left');
	}
	if ($texto == "") {
		$texto = "No existen politicas para este Proceso";
	}
	echo($texto);
}

function mostrar_anexos_anexos_proceso($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$anexos = busca_filtro_tabla("", "anexos", "documento_iddocumento=" . $iddoc, "", $conn);
	if ($anexos['numcampos']) {
		$extension = array("jpg", "png", "pdf");
		$tabla = '<ul>';
		for ($j = 0; $j < $anexos['numcampos']; $j++) {
			$tabla .= "<li>";
			if ($_REQUEST["tipo"] != 5) {
				if (in_array(strtolower($anexos[$j]['tipo']), $extension)) {
					$tabla .= "<a href='" . $ruta_db_superior . $anexos[$j]['ruta'] . "'>" . html_entity_decode($anexos[$j]['etiqueta']) . "</a>";
				} else {
					$tabla .= '<a title="Descargar" href="' . $ruta_db_superior . 'anexosdigitales/parsea_accion_archivo.php?idanexo=' . $anexos[$j]['idanexos'] . '&amp;accion=descargar" border="0px">' . html_entity_decode($anexos[$j]['etiqueta']) . '</a>';
				}
			}else{
				$tabla .= html_entity_decode($anexos[$j]['etiqueta']);
			}

			$tabla .= "</li>";
		}
		$tabla .= '</ul>';
		echo($tabla);
	}
}

/*POSTERIOR APROBAR*/
function post_aprob_pant_calidad($idformato, $iddoc){
	global $conn,$ruta_db_superior;
	if($_REQUEST["pantalla"]=="calidad"){
		$info_formato = busca_filtro_tabla("nombre,ruta_mostrar", "formato", "idformato=" . $idformato, "", $conn);
		if($info_formato["numcampos"]){
			$url=$ruta_db_superior."formatos/".$info_formato[0]["nombre"]."/".$info_formato[0]["ruta_mostrar"]."?iddoc=".$iddoc."&idformato=".$idformato."&pantalla=calidad";
			abrir_url($url,"_self");
			die();
		}
	}
}

?>