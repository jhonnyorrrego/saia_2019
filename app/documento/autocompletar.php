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

    if (strlen($s) && strpos($s, '-') !== false && strtotime($s)) {
        $_REQUEST['date'] = $s;
    } else if ((int)$s) {
        $_REQUEST['number'] = $s;
    } else {
        $_REQUEST['string'] = $s;
    }

    if ($_REQUEST['date']) {
        $condition .= " and date(b.fecha) = " . StaticSql::setDateFormat($_REQUEST['date'], 'Y-m-d');
    }

    if ($_REQUEST['number']) {
        $condition .= " and a.numero like '%" . $_REQUEST['number'] . "%'";
    }

    if ($_REQUEST['string']) {
        $condition .= " and lower(a.descripcion) like '%" . $_REQUEST['string'] . "%'";
    }

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
            {$condition}
        group by iddocumento,numero,descripcion

SQL;
    $documents = Documento::findBySql($sql, true, 0, 10);

    if ($documents) {
        $data = [];

        foreach ($documents as $Documento) {
            $label = $Documento->numero . ' - ';
            $label .= $Documento->fecha . ' - ';
            $label .= substr(html_entity_decode(strip_tags($Documento->descripcion)), 0, 30);

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
