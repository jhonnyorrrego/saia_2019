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

include_once $ruta_db_superior . 'db.php';

$Response = (object) array(
    'data' => new stdClass(),
    'message' => "",
    'success' => 1,
);

if ($_SESSION['idfuncionario'] == $_REQUEST['iduser']) {
    $Response->data = array(
        'nombre modulo 1' => array(
            'url' => 'google.com',
            'icon' => 'fa fa-lock'
        ),
        'nombre modulo 2' => array(
            'url' => 'google.com',
            'icon' => 'fa fa-lock',
            'childs' => array(
                'nombre hijo 1' => array(
                    'url' => 'google.com',
                    'icon' => 'fa fa-lock',
                )
            )
        ),
        'nombre modulo 3' => array(
            'url' => 'google.com',
            'icon' => 'fa fa-lock',
        ),
        'nombre modulo 4' => array(
            'url' => 'google.com',
            'icon' => 'fa fa-lock',
            'childs' => array(
                'nombre hijo 1' => array(
                    'url' => 'google.com',
                    'icon' => 'fa fa-lock',
                    'childs' => array(
                        'nombre nieto 1' => array(
                            'url' => 'google.com',
                            'icon' => 'fa fa-lock'
                        ),
                        'nombre nieto 2' => array(
                            'url' => 'google.com',
                            'icon' => 'fa fa-lock'
                        )
                    )
                )
            )
        ),
    );

} else {
    $Response->message = "Usuario inválido";
    $Response->success = 0;
}

echo json_encode($Response);
