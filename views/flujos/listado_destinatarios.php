<?php

$max_salida = 10;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
        // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}

error_reporting(E_ALL | E_STRICT);

require $ruta_db_superior . 'core/autoload.php';

$datos = [];
if (!empty($_REQUEST["idnotificacion"])) {
    $idnotificacion = $_REQUEST["idnotificacion"];

    $listado1 = busca_filtro_tabla("d.iddestinatario, concat(f.nombres, concat(' ', f.apellidos)) nombre, f.email, d.fk_tipo_destinatario, 'Usuario de SAIA' nombre_tipo",
            "wf_dest_notificacion d join wf_destinatario_saia ds on d.iddestinatario = ds.iddestinatario "
            . "join funcionario f on ds.fk_funcionario = f.idfuncionario",
            "d.fk_notificacion = $idnotificacion", "", $conn);

    if ($listado1["numcampos"]) {
        $total = isset($listado1['numcampos']) ? $listado1['numcampos'] : count($listado1);

        for ($row = 0; $row < $total; $row++) {
            $fila = [];
            foreach ($listado1[$row] as $key => $value) {
                if (is_string($key)) {
                    $fila[$key] = $value;
                }
            }
            $datos[] = $fila;
        }
    }

    $listado2 = busca_filtro_tabla("d.iddestinatario, f.etiqueta nombre, cf.etiqueta email, d.fk_tipo_destinatario, 'Usuario desde formato' nombre_tipo",
            "wf_dest_notificacion d join wf_destinatario_formato df on d.iddestinatario = df.iddestinatario "
            . "join wf_formato_flujo ff on df.fk_formato_flujo = df.fk_formato_flujo "
            . "join formato f on ff.fk_formato = f.idformato "
            . "join campos_formato cf on df.fk_campo_formato = cf.idcampos_formato and f.idformato = cf.formato_idformato",
            "d.fk_notificacion = $idnotificacion", "", $conn);

    if ($listado2["numcampos"]) {
        $total = isset($listado2['numcampos']) ? $listado2['numcampos'] : count($listado2);

        for ($row = 0; $row < $total; $row++) {
            $fila = [];
            foreach ($listado2[$row] as $key => $value) {
                if (is_string($key)) {
                    $fila[$key] = $value;
                }
            }
            $datos[] = $fila;
        }
    }

    $listado3 = busca_filtro_tabla("d.iddestinatario, de.nombre, de.email, d.fk_tipo_destinatario, 'Usuario externo' nombre_tipo",
            "wf_dest_notificacion d join wf_destinatario_externo de on d.iddestinatario = de.iddestinatario",
            "d.fk_notificacion = $idnotificacion", "", $conn);

    if ($listado3["numcampos"]) {
        $total = isset($listado3['numcampos']) ? $listado3['numcampos'] : count($listado3);

        for ($row = 0; $row < $total; $row++) {
            $fila = [];
            foreach ($listado3[$row] as $key => $value) {
                if (is_string($key)) {
                    $fila[$key] = $value;
                }
            }
            $datos[] = $fila;
        }
    }
}

$resp = [
    "rows" => $datos,
    "total" => count($datos)
];

echo json_encode($resp);
