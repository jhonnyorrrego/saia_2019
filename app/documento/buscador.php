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
global $conn;
include_once $ruta_db_superior . 'db.php';

$userId = $_REQUEST['key'];
if($_SESSION['idfuncionario'] == $userId){    
    $condition = "";
    $s = htmlentities(strtolower(trim($_REQUEST['query'])));

    if(strlen($s) && strpos($s, '-') !== false && strtotime($s)){
        $_REQUEST['date'] = $s;
    }else if((int) $s){
        $_REQUEST['number'] = $s;
    }else{
        $_REQUEST['string'] = $s;
    }

    if($_REQUEST['date']){
        $condition .= " and date(b.fecha) = ".fecha_db_almacenar($_REQUEST['date'], 'Y-m-d');
    }

    if($_REQUEST['number']){
        $condition .= " and a.numero like '%".$_REQUEST['number']."%'";
    }

    if($_REQUEST['string']){
        $condition .= " and lower(a.descripcion) like '%".$_REQUEST['string']."%'";
    }

    $findDocuments = busca_filtro_tabla('a.iddocumento,a.numero,a.descripcion,MAX(b.fecha) as fecha', 'documento a, buzon_salida b', "b.archivo_idarchivo = a.iddocumento and (origen = ".$userId." or destino = ".$userId.") ".$condition." group by iddocumento,numero,descripcion limit 10", '', $conn);

    $Response = new stdclass();
    $Response->suggestions = [];
    
    for($i = 0; $i < $findDocuments['numcampos']; $i++){
        $value = $findDocuments[$i]['numero'];
        $value.= ' - ' . html_entity_decode(strip_tags($findDocuments[$i]['descripcion']));
        $value.= ' - ' . (new DateTime($findDocuments[$i]['fecha']))->format('d/m/Y');

        $Response->suggestions[] = [
            'data' => $findDocuments[$i]['iddocumento'],
            'value' => $value
        ];
    }
    
    unset($findDocuments['sql'], $findDocuments['numcampos'], $findDocuments['tabla']);

    echo json_encode($Response);
}