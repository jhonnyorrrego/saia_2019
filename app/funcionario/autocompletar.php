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

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)[
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $identificator = !empty($_REQUEST['identificator']) ? $_REQUEST['identificator'] : 'idfuncionario';
    if (isset($_REQUEST['term'])) {
        $roles = $_REQUEST['roles'] ?? 0;

        if ($roles) {
            $users = VfuncionarioDc::findAllByTerm($_REQUEST['term'], $identificator);
        } else {
            $users = Funcionario::findAllByTerm($_REQUEST['term'], $identificator);
        }
    } else if (!empty($_REQUEST['defaultUser'])) {
        $users[] = new Funcionario($_REQUEST['defaultUser']);
    } else if (!empty($_REQUEST['documentId'])) {
        $users = Funcionario::findByDocumentTransfer($_REQUEST['documentId']);
    }

    if ($users) {
        $data = [];

        foreach ($users as $Funcionario) {
            $id = !empty($_REQUEST['identificator']) ?
                $Funcionario->__get($identificator) : $Funcionario->getPK();

            $data[] = [
                'id' => $id,
                'text' => $Funcionario->getName()
            ];
        }

        $Response->data = $data;
        $Response->success = 1;
    } else {
        $Response->message = "No se encontraron registros";
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
