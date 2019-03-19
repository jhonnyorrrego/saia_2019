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
    'data' => [],
    'message' => "",
    'success' => 0,
);

if ($_SESSION['idfuncionario'] == $_REQUEST['iduser']) {
    $notes = NotaFuncionario::findAllByAttributes([
        'estado' => 1,
        'fk_funcionario' => $_REQUEST['iduser']
    ]);

    if ($notes) {
        foreach ($notes as $key => $NotaFuncionario) {
            $Response->data[] = [
                'id' => $NotaFuncionario->getPK(),
                'date' => $NotaFuncionario->getDateAttribute('fecha', 'd-m-Y'),
                'contenido' => $NotaFuncionario->contenido
            ];
        }
    } else {
        $Response->message = "Actualmente no tiene notas";
    }

    $Response->success = 1;
} else {
    $Response->message = "Usuario inválido";
}

echo json_encode($Response);

