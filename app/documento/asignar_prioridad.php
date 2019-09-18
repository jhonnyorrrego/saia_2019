<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => [],
    'message' => "",
    'success' => 0
];

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    if ($_REQUEST['selections']) {
        $priority = $_REQUEST['priority'];

        $update = Model::getQueryBuilder()
            ->update('documento')
            ->set('prioridad', ':priority')
            ->where('iddocumento in (:documentList)')
            ->setParameter(':priority', $priority, \Doctrine\DBAL\Types\Type::INTEGER)
            ->setParameter(':documentList', $_REQUEST['selections'], \Doctrine\DBAL\Connection::PARAM_INT_ARRAY)
            ->execute();

        if ($update) {
            $Response->success = 1;
            $Response->message = $priority ?
                "Prioridad asignada" : "Prioridad eliminada";
        } else {
            $Response->message = "Error al asignar prioridad";
        }
    } else {
        $Response->message = "invalid data";
    }
} else {
    $Response->message = "Debe iniciar sesion";
}

echo json_encode($Response);
