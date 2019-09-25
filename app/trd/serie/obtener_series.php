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

use \Doctrine\DBAL\Types\Type;

$Response = (object) [
    'data' => [],
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$table = $_REQUEST['tableName']) {
        throw new Exception("Error Processing Request", 1);
    }

    if (!$tipo = $_REQUEST['type']) {
        throw new Exception("Error Processing Request", 1);
    }

    if ($tipo == 1) {

        $Response->data = Model::getQueryBuilder()
            ->select('idserie,codigo,nombre')
            ->from($table)
            ->where('estado=1 and cod_padre=0')
            ->orderBy('nombre', 'ASC')
            ->execute()->fetchAll();
    } else {
        /* SE DEBE PERMITIR LISTAR TODAS LAS RELACIONES SIN IMPORTAR EL ESTADO
        DE LA LLAVE (serie_dependencia) */
        $tableDep = $tabla == 'serie' ? 'serie_dependencia' : 'serie_dependencia_temp';

        $Response->data = Model::getQueryBuilder()
            ->select('s.idserie,s.codigo,s.nombre,d.iddependencia,
            d.nombre as nombre_dep,d.codigo as codigo_dep,
            idserie_dependencia as id,sd.estado')
            ->from($table, 's')
            ->innerJoin('s', $tableDep, 'sd', 's.idserie=sd.fk_serie')
            ->innerJoin('sd', 'dependencia', 'd', 'sd.fk_dependencia=d.iddependencia')
            ->where('s.estado=1 and s.cod_padre=:cod_padre')
            ->orderBy('s.nombre', 'ASC')
            ->setParameter(':cod_padre', $_REQUEST['idserie'], Type::INTEGER)
            ->execute()->fetchAll();
    }

    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);
