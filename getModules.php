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
    global $conn;

    $modules = busca_filtro_tabla('*', 'modulo', 'cod_padre = 0', 'orden asc', $conn);

    if ($modules['numcampos']) {
        $permiso = new PERMISO();
        $data = array();

        for ($i = 0; $i < $modules['numcampos']; $i++) {
            $access = $permiso->acceso_modulo_perfil($modules[$i]['nombre']);

            if ($access) {
                $module_childs = busca_filtro_tabla('*', 'modulo', 'cod_padre = ' . $modules[$i]['idmodulo'], 'orden asc', $conn);

                if ($module_childs['numcampos']) {
                    $childs = array();
                    for ($j = 0; $j < $module_childs['numcampos']; $j++) {
                        $access = $permiso->acceso_modulo_perfil($module_childs[$j]['nombre']);

                        if ($access) {
                            $childs[] = array(
                                'idmodule' => $module_childs[$j]['idmodulo'],
                                'name' => html_entity_decode( $module_childs[$j]['etiqueta']),
                                'url' => $module_childs[$j]['enlace'],
                                'icon' => $module_childs[$j]['imagen'],
                            );

                        }
                    }

                }

                $data[] = array(
                    'idmodule' => $modules[$i]['idmodulo'],
                    'name' => html_entity_decode( $modules[$i]['etiqueta']),
                    'url' => $modules[$i]['enlace'],
                    'icon' => $modules[$i]['imagen'],
                    'childs' => $childs
                );

            }
        }

    }

    $Response->data = $data;
    /*$Response->data = array(
array(
'idmodule' => uniqid(),
'name' => 'nombre modulo 1',
'url' => 'html_pruebas.html',
'icon' => 'fa fa-lock'
),
array(
'idmodule' => uniqid(),
'name' => 'nombre modulo 2',
'url' => 'html_pruebas.html',
'icon' => 'fa fa-lock',
'childs' => array(
array(
'idmodule' => uniqid(),
'name' => 'nombre hijo 1',
'url' => 'html_pruebas.html',
'icon' => 'fa fa-lock',
)
)
),
array(
'idmodule' => uniqid(),
'name' => 'nombre modulo 2',
'url' => 'html_pruebas.html',
'icon' => 'fa fa-lock',
),
array(
'idmodule' => uniqid(),
'name' => 'nombre modulo 2',
'url' => 'html_pruebas.html',
'icon' => 'fa fa-lock',
'childs' => array(
array(
'idmodule' => uniqid(),
'name' => 'nombre hijo 1',
'url' => 'html_pruebas.html',
'icon' => 'fa fa-lock',
'childs' => array(
array(
'idmodule' => uniqid(),
'name' => 'nombre nieto 1',
'url' => 'html_pruebas.html',
'icon' => 'fa fa-lock'
),
array(
'idmodule' => uniqid(),
'name' =>  'nombre nieto 2',
'url' => 'html_pruebas.html',
'icon' => 'fa fa-lock'
)
)
)
)
),
);*/

} else {
    $Response->message = "Usuario inválido";
    $Response->success = 0;
}

echo json_encode($Response);
