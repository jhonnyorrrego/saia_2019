<?php
$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while($max_salida > 0) {
	if(is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
		// Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

error_reporting(E_ALL | E_STRICT);

require $ruta_db_superior . 'core/autoload.php';

$datos = [];
if(!empty($_REQUEST["idflujo"])) {
	$idflujo = $_REQUEST["idflujo"];
	$notificacion = Notificacion::conFkFlujo($idflujo);
	$datos = $notificacion->findByFlujo(true);
	if(count($datos)) {
		foreach($datos as &$fila) {
			$evento = new EventoNotificacion($fila["fk_evento_notificacion"]);
			$fila["nombre_evento"] = $evento->evento;
			$correos = consultarDestinatarios($fila["idnotificacion"]);
			$fila["email"] = implode(", ", $correos);
		}
	}
}

$resp = [
		"rows" => $datos,
		"total" => count($datos)
];

echo json_encode($resp);

function consultarDestinatarios($idNotificacion) {
    
    $listado = busca_filtro_tabla("email", "vwf_dest_notificacion", "fk_notificacion = $idNotificacion", "");
    $resp = [];
    if($listado["numcampos"]) {
        for($i=0; $i < $listado["numcampos"]; $i++) {
            $resp[] = $listado[$i]["email"];
        }
    }
    return $resp;
}