<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "formatos/librerias/funciones_generales.php";

function findDocumentChilds($documentId){
    global $conn;

    $document = busca_filtro_tabla('iddocumento,descripcion', 'documento', 'iddocumento='. $documentId, '', $conn);

    $ouput = array(
        'title' => substr($document[0]['descripcion'], 0, 50),
        'key' => $documentId,
        'active' => $documentId == $_REQUEST['iddocumento']
    );

    $documentChilds = busca_filtro_tabla('d.iddocumento', 'documento a, formato b, formato c, documento d', 'lower(a.plantilla) = lower(b.nombre) and c.cod_padre = b.idformato and lower(d.plantilla) = lower(c.nombre) and a.iddocumento = ' . $documentId, '', $conn);

    if($documentChilds['numcampos']){
        for($i = 0; $i < $documentChilds['numcampos']; $i++){
            $ouput['children'][] = findDocumentChilds($documentChilds[$i]['iddocumento']);
        }
    }
    
    return $ouput;
}

$parentId = buscar_papa_primero($_REQUEST['iddocumento']);
$ouput = findDocumentChilds($parentId);
header('Content-Type: application/json');
echo json_encode(array($ouput));