<?php

function fecha_actual_saia($idpantalla_campos)
{ }

function obtener_ruta_db_superior($idpantalla_campos)
{
	global $ruta_db_superior;
	return $ruta_db_superior;
}

function clase_eliminar_pantalla_componente($idpantalla_campos)
{
	return '<div class="close" idpantalla_campos="' . $idpantalla_campos . '"><i class="fa fa-trash"></i></div>';
}

function cargar_default_arbol_funcionarios($campo, $seleccionado)
{
	$texto = '';
	$roles = busca_filtro_tabla("", "vfuncionario_dc", "iddependencia_cargo IN(" . $seleccionado . ")", "", $conn);
	if ($roles["numcampos"]) {
		$texto .= 'Seleccionados: <select name="temporal_mostrar">';
		for ($i = 0; $i < $roles["numcampos"]; $i++) {
			$texto .= '<option value="' . $roles[$i]["iddependencia_cargo"] . '">' . $roles[$i]["nombres"] . ' ' . $roles[$i]["apellidos"] . '</option>';
		}
		$texto .= '</select><br /><br />';
	}
	return $texto;
}

function generar_llave_md5_saia()
{
	$md5 = md5(date("Y-m-d H:i:s"));
	return $md5;
}
