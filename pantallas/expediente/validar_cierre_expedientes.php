<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once ($ruta_db_superior . "db.php");

$idexpedientes = trim(@$_REQUEST['idexpedientes']);
$response = array(
    'exito' => 0,
    'msn' => "Seleccione los expedientes"
);

if ($idexpedientes) {
    $expedientesSeleccionados = busca_filtro_tabla("nombre,cod_padre,idexpediente", "expediente", "idexpediente in (" . $idexpedientes . ")", "", $conn);
    if ($expedientesSeleccionados['numcampos']) {
        $response['exito'] = 1;
        for ($i = 0; $i < $expedientesSeleccionados['numcampos']; $i++) {
            if ($expedientesSeleccionados[$i]['cod_padre']) {
                $transferir = validarPadresExpedientes($expedientesSeleccionados[$i]['cod_padre']);
                if (!$transferir) {
                    $response['exito'] = 0;
                    $response['msn'] = 'El expediente ' . $expedientesSeleccionados[$i]['nombre'] . ' no es un expediente principal';
                    break;
                }
            }
        }

        if ($response['exito'] == 1) {
            for ($j = 0; $j < $expedientesSeleccionados['numcampos']; $j++) {
                $hijosExpedienteActivos = busca_filtro_tabla("cod_arbol,nombre", "expediente", "estado_cierre=1 AND (cod_arbol LIKE '" . $expedientesSeleccionados[$j]['idexpediente'] . ".%' OR cod_arbol LIKE '" . $expedientesSeleccionados[$j]['idexpediente'] . "' OR cod_arbol LIKE '%." . $expedientesSeleccionados[$j]['idexpediente'] . ".%' OR cod_arbol LIKE '%." . $expedientesSeleccionados[$j]['idexpediente'] . "')", "", $conn);
                if ($hijosExpedienteActivos['numcampos']) {
                    $arbolExpediente = explode('.', $hijosExpedienteActivos[0]['cod_arbol']);
                    $cadenaExpediente = '';
                    for ($k = 0; $k < count($arbolExpediente); $k++) {
                        if ($k > 0) {
                            $cadenaExpediente .= ' - ';
                        }
                        $nombreExpedientes = busca_filtro_tabla("nombre", "expediente", "idexpediente=" . $arbolExpediente[$k], "", $conn);
                        $cadenaExpediente .= $nombreExpedientes[0]['nombre'];
                    }

                    $response['exito'] = 0;
                    $response['msn'] = 'El expediente ' . $cadenaExpediente . ' se encuentra abierto';
                    break;
                }
            }
        }
    } else {
        $response['msn'] = "No fue posible encontrar los expedientes seleccionados.";
    }

    echo json_encode($response);
    die();
}

function validarPadresExpedientes($idexpediente) {
    $datosExpediente = busca_filtro_tabla("cod_padre,agrupador", "expediente", "idexpediente=" . $idexpediente, "", $conn);

    $retorno = true;
    if ($datosExpediente[0]['agrupador'] != 1) {
        $retorno = false;
    }
    if ($retorno && $datosExpediente[0]['cod_padre']) {
        $retorno = validarPadresExpedientes($datosExpediente[0]['cod_padre']);
    }
    return $retorno;
}

echo json_encode($response);
?>