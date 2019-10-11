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
    "total" => 0,
    "rows" => []
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['model']) {
        throw new Exception('Debe indicar el modelo', 1);
    }

    if (!$_REQUEST['item']) {
        throw new Exception('Debe indicar el item', 1);
    }

    $modelName = $_REQUEST['model'];
    $Instance = new $modelName();
    $relationalModelName = $Instance->getModelToLogRelation();

    $offset = ($_REQUEST["pageNumber"] - 1)  * $_REQUEST["pageSize"];
    $limit = $_REQUEST["pageSize"];

    $query = Model::getQueryBuilder()
        ->select('count(*) as total')
        ->from('log', 'a')
        ->join('a', $relationalModelName::getTableName(), 'b', 'a.idlog = b.fk_log')
        ->join('a', 'funcionario', 'c', 'c.idfuncionario = a.fk_funcionario')
        ->where("b.{$relationalModelName::getParentRelationName()} = :item")
        ->setParameter('item', $_REQUEST['item'])
        ->execute()->fetch();

    $Response->total = $query['total'];

    $records = Model::getQueryBuilder()
        ->select('a.*', 'c.nombres', 'c.apellidos', 'c.login')
        ->from('log', 'a')
        ->join('a', $relationalModelName::getTableName(), 'b', 'a.idlog = b.fk_log')
        ->join('a', 'funcionario', 'c', 'c.idfuncionario = a.fk_funcionario')
        ->where("b.{$relationalModelName::getParentRelationName()} = :item")
        ->orderBy("b.{$relationalModelName::getPrimaryLabel()}", $_REQUEST["sortOrder"])
        ->setParameter('item', $_REQUEST['item'])
        ->setFirstResult($offset)
        ->setMaxResults($limit)
        ->execute()->fetchAll();

    $Funcionario = new Funcionario();
    foreach ($records as $row) {
        $Funcionario->setAttributes([
            'nombres' => $row['nombres'],
            'apellidos' => $row['apellidos'],
        ]);

        $Response->rows[] = [
            "id" => $row['idlog'],
            "user" => "{$Funcionario->getName()} ({$row['login']})",
            "date" => DateController::convertDate($row['fecha']),
            "action" => LogAccion::getActionName($row['fk_log_accion']),
            "description" => LogHistorial::findHistoryByLog($row['idlog'], $Instance)
        ];
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
