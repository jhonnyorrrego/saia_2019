<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}

include_once ($ruta_db_superior . "db.php");

ini_set("display_errors", 1);
// sort($paths);

header('Content-Type: application/json');

$valor = @$_REQUEST["valor"];
$resp = llena_funcionarios($valor);

echo json_encode($resp);

function llena_funcionarios($valor = null) {
    $ingreso = 0;

    $func = "";
    // GROUP BY funcionario_codigo
    $campo_valor = "concat(f.nombres, ' ', f.apellidos)";
    if (empty($valor)) {
        $where_usuarios = "f.estado=1";
    } else {
        $where_usuarios = "$campo_valor like '%$valor%'";
    }
    // Tipo de LLenado =1 es para los funcionarios
    $usuarios = busca_filtro_tabla("$campo_valor as nombre, f.idfuncionario as id", "funcionario f", $where_usuarios, "", $conn);

    //print_r($usuarios); die();
    $tipo_id = "funcionario_codigo";
    $resp = array();
    if ($tipo_arbol == 'rol')
        $tipo_id = "iddependencia_cargo";
    for ($j = 0; $j < $usuarios["numcampos"]; $j++) {
        $sistema = "";
        if ($usuarios[$j]["sistema"] == 0)
            $sistema = "(Sin SAIA)";
        $valor = in_array($usuarios[$j][$tipo_id], $seleccionados);
        // alerta($valor);

        $node_id = array();

        $userdata = array(
            'ruta' => ""
        );

        $node_id = array(
            "value" => $usuarios[$j]["id"],
            "text" => ucwords(codifica_encabezado(html_entity_decode(strtolower($usuarios[$j]["nombre"]))))
        );
        // $node_id["data"] = $userdata;
        $resp[] = $node_id;
    }
    return $resp;
}

?>
