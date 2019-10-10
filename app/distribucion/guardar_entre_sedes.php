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

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['registros']) {
        throw new Exception('No hay registros para ejecutar acción entre sedes', 1);
    }

    /**
     * Con este php llamado desde el ajax se guarda la configuracion entre sedes de las distribuciones seleccionadas 
     * 
     * @param $_REQUEST[''] En el request llegan los id de los items que pasan a distribuirsen entre sedes     
     * @return string en formato json para notificar si se guarda exitosamente.
     * @author Julian Otalvaro Osorio <julian.otalvaro@cerok.com>
     * @date 2019-09-27
     */

    $registros = explode(',', $_REQUEST['registros']);

    foreach ($registros as $idDistribucion) {
        // Guardando los cambios del modo entre sedes de cada distribucion
        $Distribucion = new Distribucion($idDistribucion);
        if ($Distribucion->entre_sedes == 0) {
            $Distribucion->entre_sedes = $idDistribucion;
        }
        $Distribucion->sede_destino = $_REQUEST['sede'];
        $Distribucion->mensajero_destino = $_REQUEST['mensajero'];
        $Distribucion->save();
    }

    $Response->data = "";
    $Response->success = 1;
    $Response->message = 'Se ha guardado correctamente';
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
