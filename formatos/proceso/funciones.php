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
include_once ($ruta_db_superior . "assets/librerias.php");

/*POSTERIOR ADICIONAR-EDITAR*/
function post_add_edit_ruta_proceso($idformato, $iddoc) {
	global $conn, $ruta_db_superior;
	$datos = busca_filtro_tabla("revisado_por,aprobado_por", "ft_proceso", "documento_iddocumento=" . $iddoc, "");
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
		$funcionario = $_SESSION["usuario_actual"];
		$responsable = busca_filtro_tabla("", "documento A, ft_proceso B", "(A.iddocumento=B.documento_iddocumento AND iddocumento=" . $iddoc . ") AND (A.ejecutor=" . $funcionario . " OR permisos_acceso like '%,$funcionario' or permisos_acceso like '$funcionario' or permisos_acceso like '%,$funcionario,%' or permisos_acceso like '$funcionario,%' OR lider_proceso like '%,$funcionario' or lider_proceso like '$funcionario' or lider_proceso like '%,$funcionario,%' or lider_proceso like '$funcionario,%' OR B.responsable like '%,$funcionario' or B.responsable like '$funcionario' or B.responsable like '%,$funcionario,%' or B.responsable like '$funcionario,%')", "");

		if ($responsable["numcampos"] > 0 || $_SESSION["LOGIN" . LLAVE_SAIA] == "cerok") {
			$nombre_proceso = busca_filtro_tabla("nombre", "ft_proceso A", "A.documento_iddocumento=" . $iddoc, "");
			echo "<a class='kenlace_saia' conector='iframe' title='" . $nombre_proceso[0]["nombre"] . "' titulo='" . $nombre_proceso[0]["nombre"] . "' enlace='ordenar.php?accion=mostrar&mostrar_formato=1&key=" . $iddoc . "' style='cursor:pointer'><img border=0 src='../../botones/comentarios/detalles.png' /></a>";
		}
	}
}

function link_cuadro_mando($idformato, $iddoc) {
	
	if ($_REQUEST["tipo"] != 5) {
		$radicador = new PERMISO();
		$permiso = $radicador -> acceso_modulo_perfil("cuadro_control_indicadores");
		if ($permiso) {
			echo "<a target='_self' href='cuadro_mando_indicadores.php?proceso=" . $iddoc . "'>Cuadro de mando Indicadores</a>";
		}
	}
}

function listar_politicas_proceso($idformato, $iddoc) {
	
	$proceso = busca_filtro_tabla("idft_proceso", "ft_proceso", "documento_iddocumento=" . $iddoc, "");
	if ($proceso["numcampos"]) {
		$campos = array("nombre", "soporte");
		$texto = listar_formato_hijo($campos, "ft_politicas_proceso", "ft_proceso", $proceso[0]["idft_proceso"], "idft_politicas_proceso ASC", 'left');
	}
	if ($texto == "") {
		$texto = "No existen politicas para este Proceso";
	}
	echo($texto);
}


/*POSTERIOR APROBAR*/
function post_aprob_pant_calidad($idformato, $iddoc){
	global $conn,$ruta_db_superior;
	if($_REQUEST["pantalla"]=="calidad"){
		$info_formato = busca_filtro_tabla("nombre,ruta_mostrar", "formato", "idformato=" . $idformato, "");
		if($info_formato["numcampos"]){
			$url=$ruta_db_superior."formatos/".$info_formato[0]["nombre"]."/".$info_formato[0]["ruta_mostrar"]."?iddoc=".$iddoc."&idformato=".$idformato."&pantalla=calidad";
			abrir_url($url,"_self");
			die();
		}
	}
}

?>