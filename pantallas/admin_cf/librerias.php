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
include_once $ruta_db_superior . "core/autoload.php";

function barra_superior_cf($idcf, $tabla, $campos="") {
	global $ruta_db_superior;

	$texto = '<div class="btn-group barra_superior">
        <button type="button" class="btn btn-mini btn-primary kenlace_saia tooltip_saia" titulo="Editar" enlace="pantallas/admin_cf/pantalla_cf_editar.php?key=' . $idcf . '&tabla=' . $tabla . '&campos=' . $campos . '" conector="iframe">
            <i class="icon-wrench"></i>
        </button> 
    </div>';
	return ($texto);
}
?>