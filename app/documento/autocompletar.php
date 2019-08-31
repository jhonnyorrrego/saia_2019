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
include_once $ruta_db_superior . 'core/autoload.php';

$Response = (object)[
    'data' => [],
    'message' => '',
    'success' => 0,
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['all']) {
        $userId = SessionController::getValue('idfuncionario');

        $condition = "(
            origen = {$userId} or
            destino = {$userId}
        )";
    } else {
        $condition = "(1=1)";
    }

    $s = htmlentities(strtolower(trim($_REQUEST['query'])));
    $concat = StaticSql::concat([
        "numero",
        "' '",
        "LOWER(a.descripcion)",
        "' '",
        StaticSql::getDateFormat('b.fecha', 'Y-m-d')
    ]);

    $sql = <<<SQL
        SELECT
            a.iddocumento,
            a.numero,
            a.descripcion,
            MAX(b.fecha) AS fecha
        FROM
            documento a JOIN
            buzon_salida b 
            ON
                b.archivo_idarchivo = a.iddocumento
        WHERE            
            {$concat} LIKE '%{$s}%'
        group by iddocumento,numero,descripcion
SQL;
    $documents = Documento::findByQueryBuilder($sql, true, 0, 10);

    if ($documents) {
        $data = [];

        foreach ($documents as $Documento) {
            $label = $Documento->numero . ' - ';
            $label .= $Documento->fecha . ' - ';
            $label .= html_entity_decode(strip_tags($Documento->descripcion));

            $data[] = [
                'id' => $Documento->getPK(),
                'text' => $label
            ];
        }

        $Response->data = $data;
        $Response->success = 1;
    } else {
        $Response->message = "No se encontraron registros";
    }

    $Response->success = 1;
} catch (\Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
