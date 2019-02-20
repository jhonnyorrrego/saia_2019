<?php
session_start();

$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 0
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $params = json_decode($_REQUEST['params']);

    if (!$params->ruta) {
        $Response->message = "No se encuentra el PDF";
    } else {
        $ruta_string = base64_decode($params->ruta);
        $ruta_json = json_decode($ruta_string);

        if (is_object($ruta_json)) {
		    //$params->tipo=> 1=documento; 2=anexos; 3=anexos_transferencia
            $iddoc = intval($params->iddocumento);
            $tipo_visor = intval($params->tipo_visor);

            switch ($tipo_visor) {
                case 1:
                    $id = $iddoc;
                    break;
                case 2:
                    $id = intval($params->idanexo);
                    break;
                case 3:
                    $id = intval($params->idanexos_transferencia);
                    break;
            }

            $ruta_archivo = strtolower($_SESSION["ruta_temp_funcionario"] . basename($ruta_json->ruta));
            $temporal = $ruta_db_superior . $ruta_archivo;

            if (!is_file($temporal) || $params->actualizar_pdf) {
                $arr_almacen = StorageUtils::get_file_content($ruta_string);
                file_put_contents($temporal, $arr_almacen);
                
                if (!is_file($temporal)) {
                    $Response->message = "Error al intentar cargar el PDF";
                }
            }

            if(is_file($temporal)){
                $annotateRoute = 'views/visor/pdfAnnotate/index.php?';
                $annotateRoute .= http_build_query([
                    'ruta' => $params->ruta,
                    'iddoc' => $iddoc,
                    'file' => $ruta_archivo,
                    'tipo' => $tipo_visor,
                    'idtipo' => $id
                ]);
                
                $Response->data->annotate = $annotateRoute;
                $Response->data->temporal = $ruta_archivo;
                $Response->success = 1;
            }
        } else {
            $Response->message = "Error al resolver la ruta del pdf";
        }
    }
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);