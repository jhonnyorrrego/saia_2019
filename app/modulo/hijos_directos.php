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
    
    $data = array();
    $grouperParent = $_REQUEST['grouper'] ? $_REQUEST['grouper'] : 0;
    $parent = $_REQUEST['parent'] ? $_REQUEST['parent'] : 0;
    $modules = busca_filtro_tabla('*', 'modulo', 'cod_padre=' . $parent, 'orden asc', $conn);

    if($grouperParent == 1 && $parent){
        $dashboard = busca_filtro_tabla('*', 'modulo', "nombre='dashboard'", '', $conn);
        $data [] = addElement($dashboard[0], 0);
    }
    
    if ($modules['numcampos']) {     
        $permiso = new PERMISO();

        for ($i = 0; $i < $modules['numcampos']; $i++) {
            $module = $modules[$i];
            $access = $permiso->acceso_modulo_perfil($module['nombre']);

            if ($access) {
                if($grouperParent){
                    $countChilds = busca_filtro_tabla('count(*) as total', 'modulo', 'cod_padre = ' . $module['idmodulo'], '', $conn);
                    $isParent = $countChilds[0]['total'] ? 1 : 0;
                }

                $data[] = addElement($module, $isParent);
            }
        }
    }

    $Response->data = $data;
} else {
    $Response->message = 'Usuario inválido';
    $Response->success = 0;
}

echo json_encode($Response);

function addElement($data, $isParent){
    return array(
        'idmodule' => $data['idmodulo'],
        'isParent' => $isParent,
        'name' => html_entity_decode($data['etiqueta']),
        'icon' => $data['imagen'],
        'type' => $data['tipo'],
        'url' => $data['enlace']
    );
}