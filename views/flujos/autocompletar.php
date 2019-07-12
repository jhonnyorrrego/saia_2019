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

include_once($ruta_db_superior . "db.php");

header('Content-Type: application/json');

$consulta64 = @$_REQUEST["consulta"];
if (empty($consulta64)) {
    die("No especificó los parámetros de consulta");
}

//Es un string json
$consulta = base64_decode($consulta64);

$valor = @$_REQUEST["valor"];
$resp = consultar($consulta, $valor);

echo json_encode($resp);

function consultar($consulta, $valor)
{
    global $conn;
    /*
     $consulta = array(
     "campoid" => $parametros->campoid,
     "campotexto" => $parametros->campotexto,
     "tablas" => $parametros->tablas,
     "condicion" => $parametros->condicion,
     "orden" => $parametros->orden
     );*/

    $arr_consulta = json_decode($consulta, true);

    $campos_nombre = $arr_consulta["campotexto"];
    if (is_array($arr_consulta["campotexto"])) {
        $campos = array();
        $total_campos = count($arr_consulta["campotexto"]);
        for ($i = 0; $i < $total_campos; $i++) {
            $campos[] = $arr_consulta["campotexto"][$i];
            $campos[] = "' '";
        }
        $campos_nombre = concatenar_cadena_sql($campos);
    }

    $campo_id = $arr_consulta["campoid"];
    $tablas = $arr_consulta["tablas"];
    if (is_array($arr_consulta["campotexto"])) {
        $tablas = implode(", ", $arr_consulta["tablas"]);
    }
    $condicion = $arr_consulta["condicion"];
    $orden = $arr_consulta["orden"];

    $where_final = $condicion . " AND lower($campos_nombre) like '%$valor%'";
    // Tipo de LLenado =1 es para los funcionarios
    $usuarios = busca_filtro_tabla("$campos_nombre as nombre, $campo_id as id", $tablas, $where_final, $orden, $conn);

    $tipo_id = "funcionario_codigo";
    $resp = array();
    for ($j = 0; $j < $usuarios["numcampos"]; $j++) {
        $sistema = "";
        if ($usuarios[$j]["sistema"] == 0)
            $sistema = "(Sin SAIA)";
        $valor = in_array($usuarios[$j][$tipo_id], $seleccionados);

        $node_id = array(
            "value" => $usuarios[$j]["id"],
            "text" => ucwords(codifica_encabezado(html_entity_decode(strtolower($usuarios[$j]["nombre"]))))
        );
        $resp[] = $node_id;
    }
    return $resp;
}
