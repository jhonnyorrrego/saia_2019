<?php
use function GuzzleHttp\json_encode;

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
	$texto = '<div class="btn-group barra_superior">
        <button type="button" class="btn btn-mini btn-primary kenlace_saia tooltip_saia" titulo="Editar" enlace="pantallas/admin_cf/pantalla_cf_editar.php?key=' . $idcf . '&tabla=' . $tabla . '&campos=' . $campos . '" conector="iframe">
            <i class="fa fa-edit"></i>
        </button> 
    </div>';
	return ($texto);
}

function editar_cf($id,$table){
	global $ruta_db_superior;
	$enlace = StaticSql::search("select enlace_adicionar from busqueda_componente where idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"]);
	$datos = '<div><button class="btn btn-cf" type="button" aria-haspopup="true" aria-expanded="false" enlace="' . $ruta_db_superior . $enlace[0]["enlace_adicionar"] . '" table="' . $table . '" editar_id="' . $id  . '">
				<i class="fa fa-edit"></i>
			</button></div>';
	return $datos;
}

?>