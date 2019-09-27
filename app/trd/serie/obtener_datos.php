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
    'data' => [],
    'message' => '',
    'success' => 0
];

try {

    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!($class = $_REQUEST['className']) || !isset($_REQUEST['onlyType'])) {
        throw new Exception("Error Processing Request", 1);
    }

    if (!$idserie = $_REQUEST['idserie']) {
        throw new Exception('Serie invalida', 1);
    }

    if (!$iddep = $_REQUEST['iddependencia']) {
        throw new Exception('Dependencia invalida', 1);
    }

    $Serie = new $class($idserie);
    $data = [
        'idserie' => (int) $idserie,
        'tipo' => (int) $Serie->tipo,
        'iddependencia' => (int) $iddep
    ];

    switch ($Serie->tipo) {
        case 1:
            $data['nombre'] = $Serie->nombre;
            $data['codigo'] = $Serie->codigo;
            $childrenSub = $Serie->hasChild(2);

            if ($childrenSub && $_REQUEST['onlyType'] == 1) {
                throw new Exception("Error al consultar la información", 1);
                //Los datos de la TRD json NO coninciden con los almacenados en la DB
            }

            if (!$childrenSub) {

                if ($idSerieDep = $Serie->classSerieDependencia::findByAttributes([
                    'fk_serie' => $idserie,
                    'fk_dependencia' => $iddep
                ])) {
                    $data['idserie_dependencia'] = $idSerieDep->getPK();
                } else {
                    throw new Exception("Error al consultar la dependencia vinculada", 1);
                }

                $data['tipo'] = 4;
                $data['gestion'] = $Serie->retencion_gestion;
                $data['central'] = $Serie->retencion_central;
                $data['procedimiento'] = $Serie->procedimiento;
                $data['disp_e'] = $Serie->dis_eliminacion ? 'checked' : '';
                $data['disp_ct'] = $Serie->dis_conservacion ? 'checked' : '';
                $data['disp_s'] = $Serie->dis_seleccion ? 'checked' : '';
                $data['dis_micro'] = $Serie->dis_microfilma ? 'checked' : '';
            }
            break;

        case 2:
            if ($idSerieDep = $Serie->classSerieDependencia::findByAttributes([
                'fk_serie' => $idserie,
                'fk_dependencia' => $iddep
            ])) {
                $data['idserie_dependencia'] = $idSerieDep->getPK();
            } else {
                throw new Exception("Error al consultar la dependencia vinculada", 1);
            }

            $data['nombre'] = $Serie->nombre;
            $data['codigo'] = $Serie->codigo;
            $data['gestion'] = $Serie->retencion_gestion;
            $data['central'] = $Serie->retencion_central;
            $data['procedimiento'] = $Serie->procedimiento;
            $data['disp_e'] = $Serie->dis_eliminacion ? 'checked' : '';
            $data['disp_ct'] = $Serie->dis_conservacion ? 'checked' : '';
            $data['disp_s'] = $Serie->dis_seleccion ? 'checked' : '';
            $data['dis_micro'] = $Serie->dis_microfilma ? 'checked' : '';
            break;

        case 3:
            $data['nombre'] = $Serie->nombre;
            $data['dias_respuesta'] = $Serie->dias_respuesta ?? 0;
            $data['sop_p'] = $Serie->sop_papel ? 'checked' : '';
            $data['sop_el'] = $Serie->sop_electronico ? 'checked' : '';
            break;
    }

    $Response->data = $data;

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
