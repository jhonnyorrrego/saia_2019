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

include_once $ruta_db_superior . 'controllers/autoload.php';

$Response = (object)array(
    'data' => [],
    'message' => "",
    'success' => 1,
);

if (isset($_SESSION['idfuncionario']) && $_SESSION['idfuncionario'] == $_REQUEST['key']) {
    $data = TareaFuncionario::findUsersByType(
        $_REQUEST['task'],
        TareaFuncionario::TIPO_SEGUIDOR
    );

    foreach ($data as $key => $Funcionario) {
        $data[$key] = [
            'image' => $Funcionario->getImage('foto_recorte'),
            'label' => $Funcionario->getName() . ' - ' . $Funcionario->getLogin(),
            'user'  => $Funcionario->getPK()
        ];
    }

    $Response->data = $data;
} else {
    $Response->message = "Debe iniciar sesion";
    $Response->success = 0;
}

echo json_encode($Response);
