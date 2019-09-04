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

$records = StaticSql::search("select * from busqueda_componente where info like '%|-|%'");

foreach ($records as $row) {
    $data = [];
    $columns = explode('|-|', $row['info']);
    foreach ($columns as $key => $column) {
        $pieces = explode('|', $column);
        $data[$key]['title'] = $pieces[0];
        $data[$key]['field'] = $pieces[1];
        $data[$key]['align'] = $pieces[2];
    }
    $data = json_encode($data);
    $sql = <<<SQL
        UPDATE
            busqueda_componente 
        SET 
            info='{$data}'
        WHERE 
            idbusqueda_componente= {$row['idbusqueda_componente']}
SQL;
    StaticSql::query($sql);
}
