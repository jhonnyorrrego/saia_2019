<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
	if (is_file($ruta . 'db.php')) {
		$ruta_db_superior = $ruta;
		break;
	}

	$ruta .= '../';
	$max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

if (SessionController::getLogin() != 'cerok') {
	throw new Exception("acceso solo a super administrador", 1);
}
?>

<a href="llamado_formatos.php?acciones_formato=tabla,formato,adicionar,buscar,editar,mostrar&accion=generar">Recrear Todos los Formatos</a>