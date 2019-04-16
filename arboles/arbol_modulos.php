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
include_once $ruta_db_superior . 'controllers/autoload.php';

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
	$sql = <<<SQL
		SELECT * 
		FROM modulo
		WHERE
			cod_padre = {$id} AND
			nombre NOT LIKE 'crear_%'
		ORDER BY 
			etiqueta ASC
SQL;
	$modules = StaticSql::search($sql);

	foreach ($modules as $key => $module) {
		$data[] = [
			"title" => $module['etiqueta'],
			"key" => $module['idmodulo'],
			"checkbox" => $_REQUEST['checkbox'] ? $_REQUEST['checkbox'] : null,
			"expanded" => $_REQUEST['expanded'] ?? false,
			"selected" => in_array($module['idmodulo'], $checkedOptions),
			"children" => buscar_modulos($module['idmodulo'], $checkedOptions)
		];
	}

	return $data;
}
