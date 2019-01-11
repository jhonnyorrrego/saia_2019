<?php
//borrar lo que haya en la carpeta especificada
function borrar_archivos_carpeta($dir, $deleteRootToo) {
	if (!$dh = @opendir($dir)) {
		return;
	}
	while (false !== ($obj = readdir($dh))) {
		if ($obj == '.' || $obj == '..') {
			continue;
		}
		if (!@unlink($dir . '/' . $obj)) {
			borrar_archivos_carpeta($dir . '/' . $obj, true);
		}
	}
	closedir($dh);
	//para borrar la carpeta raiz tambien
	if ($deleteRootToo) {
		@rmdir($dir);
	}
	return;
}
?>