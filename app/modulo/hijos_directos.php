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
    'message' => '',
    'success' => 1,
);

if ($_SESSION['idfuncionario'] == $_REQUEST['iduser']) {
    global $conn;

    $parent = $_REQUEST['parent'] ? $_REQUEST['parent'] : 0;

    $modules = busca_filtro_tabla('*', 'modulo', 'cod_padre=' . $parent, 'orden asc', $conn);

    if ($modules['numcampos']) {
        $permiso = new PERMISO();
        $data = array();

        for ($i = 0; $i < $modules['numcampos']; $i++) {
            $module = $modules[$i];
            $access = $permiso->acceso_modulo_perfil($module['nombre']);

            if ($access) {
                if($module['tipo'] != 'agrupador'){
                    $countChilds = busca_filtro_tabla('count(*) as total', 'modulo', 'cod_padre = ' . $module['idmodulo'], '', $conn);
                    $isParent = $countChilds[0]['total'] ? 1 : 0;
                }else{
                    $isParent = 1;
                }

                $data[] = array(
                    'idmodule' => $module['idmodulo'],
                    'isParent' => $isParent,
                    'name' => html_entity_decode($module['etiqueta']),
                    'icon' => $module['imagen'],
                    'type' => $module['tipo'],
                    'url' => $module['enlace']
                );

            }
        }

    }

    $Response->data = $data;
} else {
    $Response->message = 'Usuario inválido';
    $Response->success = 0;
}

echo json_encode($Response);