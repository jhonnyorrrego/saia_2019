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

function editar_cf($id, $table)
{
    global $ruta_db_superior;
    $enlace = Model::getQueryBuilder()
        ->select('enlace_adicionar')
        ->from('busqueda_componente')
        ->where('idbusqueda_componente=' . $_REQUEST["idbusqueda_componente"])->execute()->fetchAll();

    $datos = '<div><button class="btn btn-cf" type="button" aria-haspopup="true" aria-expanded="false" enlace="' . $ruta_db_superior . $enlace[0]["enlace_adicionar"] . '" table="' . $table . '" editar_id="' . $id  . '">
				<i class="fa fa-edit"></i>
			</button></div>';
    return $datos;
}
