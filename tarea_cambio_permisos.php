<?php

// copiar lo que haya en la carpeta especificada
function cambiar_permisos_carpeta($origen) {
	echo ($origen . "<br />");
	chmod($origen, 0777);
	if (!$dh = @opendir($origen)) {
		return;
	}
	while(false !== ($obj = readdir($dh))) {
		if ($obj == '.' || $obj == '..') {
			continue;
		}
		// echo($origen.'/'.$obj."<br />");
		if (is_dir($origen . '/' . $obj) && $obj != '.' && $obj != '..') {
			chmod($origen . '/' . $obj, 0777);
			cambiar_permisos_carpeta($origen . '/' . $obj);
		} else {
			echo ($origen . '/' . $obj . "<br />");
			chmod($origen . '/' . $obj, 0777);
		}
	}

	closedir($dh);
	return;
}
if (!defined("FORMATOS_CLIENTE")) {
	$carpeta = 'formatos_cliente/';
} else {
	$carpeta = FORMATOS_CLIENTE;
}
cambiar_permisos_carpeta($carpeta);
echo ("Termine");
?>