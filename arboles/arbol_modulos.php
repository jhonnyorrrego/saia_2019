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
include_once $ruta_db_superior . 'core/autoload.php';

if ($_REQUEST['profile']) {
	$modules = PermisoPerfil::findColumn('modulo_idmodulo', [
		'perfil_idperfil' => $_REQUEST['profile']
	]);

	$checkedOptions = array_unique($modules);
} else {
	$checkedOptions = [];
}

$id = $_REQUEST['id'] ?? 0;
$json = buscar_modulos($id, $checkedOptions);
echo json_encode($json);

function buscar_modulos($id, $checkedOptions = [])
{
	$data = [];
	$modules = Modulo::findAllByAttributes([
		'cod_padre' => $id
	], null, 'etiqueta ASC');

	foreach ($modules as $Modulo) {
		$moduleId = $Modulo->getPK();

		$data[] = [
			"title" => $Modulo->etiqueta,
			"key" => $moduleId,
			"checkbox" => $_REQUEST['checkbox'] ? $_REQUEST['checkbox'] : null,
			"expanded" => $_REQUEST['expanded'] ?? false,
			"selected" => in_array($moduleId, $checkedOptions),
			"children" => buscar_modulos($moduleId, $checkedOptions)
		];
	}

	return $data;
}
