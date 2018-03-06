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
include_once ($ruta_db_superior . "db.php");

function barra_superior_funcionario($idfuncionario, $nombres, $apellidos) {
	$texto = '<div class="btn-group barra_superior">
<button type="button" class="adicionar_seleccionados btn btn-mini tooltip_saia" title="Seleccionar Funcionario" idregistro="' . $idfuncionario . '"><i class="icon-uncheck"></i></button>
</div>';
	return ($texto);
}

function firma_digital_funcion($firma) {
	$texto = '<span style="color:#347BB8">Posee firma</span>';
	if ($firma == 'firma') {
		$texto = '<span style="color:#EF414D">No posee firma</span>';
	}
	return ($texto);
}

function seleccionar_perfil($idperfil, $idfuncionario) {
	return ($idperfil . " AND idfuncionario=" . $idfuncionario);
}

function nombre_perfil($perfil) {
	$nombre_perfil = busca_filtro_tabla("", "perfil", "idperfil in(" . $perfil . ")", "", $conn);
	$perfiles = extrae_campo($nombre_perfil, "nombre");
	$cadena .= implode(", ", $perfiles);
	return addslashes($cadena);
}

function estado_funcionario($estado) {
	$texto = "";
	if ($estado == 1) {
		$texto = "Activo";
	} else if ($estado == 0) {
		$texto = "Inactivo";
	} else if ($estado == 2) {
		$texto = "Temporalmente inactivo";
	}
	return ($texto);
}

function fotografia_funcionario($idfuncionario) {
	global $conn, $ruta_db_superior;

	$href = 'pantallas/funcionario/fotografia/foto.php?idfuncionario=' . $idfuncionario;
	$id_contenedor = 'id="foto_funcionario_' . $idfuncionario . '"';
	$foto_recorte = busca_filtro_tabla("foto_recorte", "funcionario", "idfuncionario=" . $idfuncionario, "", $conn);
	if ($foto_recorte[0]['foto_recorte'] != '') {
		if (file_exists($ruta_db_superior . $foto_recorte[0]['foto_recorte'])) {
			$imagen = '<img src="' . $ruta_db_superior . $foto_recorte[0]['foto_recorte'] . '"	width="60" height="60" ' . $id_contenedor . ' />';
			$href .= '&recortar=1';
		} else {
			$imagen = '<img src="' . $ruta_db_superior . 'imagenes/funcionario_sin_foto.jpg"	width="60" height="60" ' . $id_contenedor . ' />';
		}
	} else {
		$imagen = '<img src="' . $ruta_db_superior . 'imagenes/funcionario_sin_foto.jpg"	width="60" height="60" ' . $id_contenedor . ' />';
	}

	$html = '<a class="open_highslide" id="highslide_funcionario_' . $idfuncionario . '" style="cursor:pointer;" enlace="' . $href . '" identificador="' . $idfuncionario . '">' . $imagen . '</a>';
	return ($html);

}

function where_funcionario() {
	global $configuracion;
	$configuracion = busca_filtro_tabla("A.valor", "configuracion A", "A.tipo='usuario' AND A.nombre='login_administrador'", "", $conn);
	 $html = " and login<>'" . $configuracion[0]["valor"] . "'";
	 if ($configuracion["numcampos"] && trim($configuracion[0]["valor"]) == trim($_SESSION["LOGIN" . LLAVE_SAIA])) {
	 	$html = "";
	 }
	 return $html;
}
?>
