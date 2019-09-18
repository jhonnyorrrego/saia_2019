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

$Response = (object) [
    'data' => [],
    'message' => '',
    'success' => 0,
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    $query = strtolower(trim($_REQUEST['query']));

    $QueryBuilder = Model::getQueryBuilder()
        ->select([
            'a.iddocumento',
            'a.numero',
            'a.descripcion',
            'MAX(b.fecha) AS fecha'
        ])
        ->from('documento', 'a')
        ->join('a', 'buzon_salida', 'b', 'b.archivo_idarchivo = a.iddocumento')
        ->where("
            CONCAT(
                a.numero,
                CONCAT(
                    ' ',
                    CONCAT(
                        LOWER(a.descripcion),
                        CONCAT(
                            ' ',
                            b.fecha
                        )
                    )
                )
            ) LIKE :query
        ")
        ->setParameter(':query', "%{$query}%")
        ->setFirstResult(0)
        ->setMaxResults(10)
        ->groupBy('iddocumento,numero,descripcion');

    if (!$_REQUEST['all']) {
        $userId = SessionController::getValue('idfuncionario');

        $QueryBuilder->andWhere("origen = :userId or destino = :userId");
        $QueryBuilder->setParameter(':userId', $userId, \Doctrine\DBAL\Types\Type::INTEGER);
    }

    $documents = Documento::findByQueryBuilder($QueryBuilder);

    if ($documents) {
        $data = [];

        foreach ($documents as $Documento) {
            $label = $Documento->numero . ' - ';
            $label .= $Documento->fecha . ' - ';
            $label .= strip_tags($Documento->descripcion);

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
