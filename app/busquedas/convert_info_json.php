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

$QueryBuilder = Model::getQueryBuilder()
    ->select('*')
    ->from('busqueda_componente')
    ->where("info like '%|-|%'");
$records = BusquedaComponente::findByQueryBuilder($QueryBuilder);

foreach ($records as $BusquedaComponente) {
    $data = [];
    $columns = explode('|-|', $BusquedaComponente['info']);
    foreach ($columns as $key => $column) {
        $pieces = explode('|', $column);
        $data[$key]['title'] = $pieces[0];
        $data[$key]['field'] = $pieces[1];
        $data[$key]['align'] = $pieces[2];
    }
    $data = json_encode($data);
    $BusquedaComponente->info = $data;
    $BusquedaComponente->save();
}
