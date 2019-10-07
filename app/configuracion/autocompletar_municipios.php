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

include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object) [
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['term']) {
        throw new Exception("Debe indicar el término de búsqueda", 1);
    }

    $results = Model::getQueryBuilder()
        ->select("
            CONCAT(a.nombre,
                CONCAT(
                    ' - ',
                    CONCAT(
                        b.nombre,
                        CONCAT(
                            ' - ',
                            c.nombre   
                        )
                    )
                )
            ) AS text
        ", "a.idmunicipio as id")
        ->from('municipio', 'a')
        ->join('a', 'departamento', 'b', 'a.departamento_iddepartamento = b.iddepartamento')
        ->join('b', 'pais', 'c', 'b.pais_idpais = c.idpais')
        ->where("CONCAT(a.nombre,CONCAT(' ',b.nombre)) like :query")
        ->andWhere('a.estado = 1 AND b.estado = 1 AND c.estado = 1')
        ->setParameter('query', "%{$_REQUEST['term']}%")
        ->execute()->fetchAll();

    $Response->data = $results;
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
