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
require_once $ruta_db_superior . "controllers/autoload.php";

$response = [
    'exito' => 0,
    'type' => 'error',
    'message' => 'Faltan datos obligatorios'
];

if ($_POST['accion'] == 1) {
    if (!empty($_POST['identidad_serie']) && !empty($_POST['fk_entidad']) && !empty($_POST['id'])) {

        $new = 1;
        $conditions = [
            'fk_entidad_serie' => $_POST['identidad_serie'],
            'fk_entidad' => $_POST['fk_entidad'],
            'llave_entidad' => $_POST['id']
        ];
        $response = PermisoSerie::findAllByAttributes($conditions);
        if ($response) {
            $cant = count($response);
            if ($cant > 1) {
                for ($i = 1; $i < $cant; $i++) {
                    $response[$i]->deletePermisoSerie();
                }
            }
            $PermisoSerie = $response[0];
            $new = 0;
        }

        if ($_POST['selected']) {
            if ($new) {
                $PermisoSerie = new PermisoSerie();
                $attributes = [
                    'fk_entidad' => $_POST['fk_entidad'],
                    'llave_entidad' => $_POST['id'],
                    'fk_entidad_serie' => $_POST['identidad_serie'],
                    'permiso' => 'l'
                ];
                $PermisoSerie->SetAttributes($attributes);
                $info = $PermisoSerie->createPermisoSerie();
                if ($info['exito']) {
                    $id = $info['data']['id'];
                } else {
                    $id = 0;
                }
            } else {
                $PermisoSerie->permiso = 'l';
                if ($PermisoSerie->updatePermisoSerie()) {
                    $id = $PermisoSerie->getPK();
                } else {
                    $id = 0;
                }
            }

            if ($id) {
                $response['exito'] = 1;
                $response['type'] = 'success';
                $response['message'] = 'Permiso Adicionado! (Lectura)';
                $response['data']['id'] = $id;
            } else {
                $response['message'] = 'Error al guardar el permiso';
            }
        } else {
            $okDel = 1;
            if (!$new) {
                $okDel = $PermisoSerie->deletePermisoSerie();
            }

            if ($okDel) {
                $response['exito'] = 1;
                $response['type'] = 'success';
                $response['message'] = 'Permiso Eliminado!';
            } else {
                $response['message'] = 'No se pudo eliminar el permiso';
            }
        }
    }
} else if ($_POST['accion'] == 2 && !empty($_POST['idpermiso_serie']) && !empty($_POST['permiso'])) {
    $permisoSerie = new PermisoSerie($_POST['idpermiso_serie']);
    $permisoAnt = $permisoSerie->permiso;
    $response['exito'] = 1;
    $response['type'] = 'success';
    $response['message'] = 'Permiso actualizado!';
    if ($permisoAnt != $_POST["permiso"]) {
        $permisoSerie->permiso = $_POST["permiso"];
        if (!$permisoSerie->updatePermisoSerie()) {
            $response['exito'] = 0;
            $response['type'] = 'error';
            $response['message'] = 'Error al actualizar el permiso!';
        }
    }

}

echo json_encode($response);
