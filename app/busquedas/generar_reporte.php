<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);
} catch (\Throwable $th) {
    die("invalid access");
}

$page = (int) $_REQUEST['pageNumber'] ?? 1;
$end = (int) $_REQUEST['pageSize'] ?? 30;
$start = ($page - 1) * $end;

$sql = <<<SQL
    SELECT * 
    FROM 
        busqueda A JOIN
        busqueda_componente B
            ON A.idbusqueda=B.busqueda_idbusqueda
    WHERE
        B.idbusqueda_componente={$_REQUEST["idbusqueda_componente"]}
SQL;
$busqueda = StaticSql::search($sql, 0, 1)[0];

if (!$busqueda) {
    throw new Exception("Componente invalido", 1);
}

if ($busqueda["ruta_libreria"]) {
    $libraries = array_unique(explode(",", $busqueda["ruta_libreria"]));
    foreach ($libraries as $library) {
        include_once $ruta_db_superior . $library;
    }
}

/**
 * obtengo las tablas para el sql
 */
$temporal = [];
array_push($temporal, $busqueda["tablas"], $busqueda["tablas_adicionales"]);
$tablas = implode(",", array_filter($temporal));

/**
 * obtengo los campos para el sql
 */
$temporal = [];
array_push($temporal, $busqueda["llave"], $busqueda["campos"], $busqueda["campos_adicionales"]);
$select = implode(",", array_filter($temporal));

if (strpos($select, 'distinct') !== false) {
    $select = str_replace('distinct', '', $select);
    $select = 'distinct ' . $select;
}

$campos = explode(",", $select);

if (!$busqueda["llave"]) {
    $busqueda["llave"] = $campos[0];
}

$pos = strpos($busqueda["llave"], ".");
if ($pos !== false) {
    $llave = substr($busqueda["llave"], ($pos + 1), strlen($busqueda["llave"]));
} else {
    $llave = $busqueda["llave"];
}

$condicion = crear_condicion_sql($busqueda["idbusqueda"], $busqueda["idbusqueda_componente"]);
$funciones_condicion = parsear_datos_plantilla_visual($condicion);

if ($funciones_condicion && !empty($_REQUEST["variable_busqueda"])) {
    $variables_final = array();
    $variables1 = explode(",", $_REQUEST["variable_busqueda"]);
    foreach ($variables1 as $key => $valor) {
        $variable2 = explode("=", $valor);
        $variables_final[$variable2[0]] = $variable2[1];
    }
}

foreach ($funciones_condicion as $key => $valor) {
    $valor_variables = array();
    $funcion = explode("@", $valor);
    $variables = explode(",", $funcion[1]);
    $cant_variables = count($variables);
    for ($h = 0; $h < $cant_variables; $h++) {
        if (isset($variables_final[$variables[$h]]))
            array_push($valor_variables, $variables_final[$variables[$h]]);
        else
            array_push($valor_variables, $variables[$h]);
    }
    $resultado = call_user_func_array($funcion[0], $valor_variables);
    $condicion = str_replace("{*" . $valor . "*}", $resultado, $condicion);
}

if (!empty($_REQUEST["idbusqueda_filtro_temp"])) {
    $filtro_temp = busca_filtro_tabla("", "busqueda_filtro_temp", "", "", $conn);
    $sql = <<<SQL
        SELECT detalle
        FROM busqueda_filtro_temp
        WHERE
            idbusqueda_filtro_temp IN({$_REQUEST["idbusqueda_filtro_temp"]})
SQL;
    $records = StaticSql::search($sql);

    $condition = [];
    foreach ($records as $key => $filtro_temp) {
        $condition[] = $filtro_temp['detalle'];
    }
    $cadena = implode(' AND ', $condition);
    $cadena = UtilitiesController::convertTemporalFilter($cadena);
    $condicion .= " AND (" . stripslashes($cadena) . ")";
}

foreach ($campos as $valor) {
    $as = strpos(strtolower($valor), " as ");
    if ($as !== false) {
        $agrupacion[] = substr($valor, 0, ($as));
    } else {
        $agrupacion[] = $valor;
    }
}

$funciones_tablas = parsear_datos_plantilla_visual($tablas);

foreach ($funciones_tablas as $key => $valor) {
    $valor_variables = [];
    $funcion = explode("@", $valor);
    $variables = explode(",", $funcion[1]);
    $cant_variables = count($variables);
    for ($h = 0; $h < $cant_variables; $h++) {
        if (@$variables_final[$variables[$h]])
            array_push($valor_variables, $variables_final[$variables[$h]]);
        else
            array_push($valor_variables, $variables[$h]);
    }
    $resultado = call_user_func_array($funcion[0], $valor_variables);
    $tablas = str_replace("{*" . $valor . "*}", $resultado, $tablas);
}

$ordenar_consulta = "";
$agrupar_consulta = $busqueda["agrupado_por"];

if ($agrupar_consulta) {
    $ordenar_consulta .= "group by {$agrupar_consulta} ";
}

if ($busqueda["ordenado_por"]) {
    $sord = $busqueda["direccion"] ? $busqueda["direccion"] : ' DESC ';
    $ordenar_consulta .= "order by {$busqueda["ordenado_por"]} {$sord}";
}

$condicion = str_replace("%y-%m-%d", "%Y-%m-%d", $condicion);

if (!empty($_REQUEST["idbusqueda_temporal"])) {
    $sql = <<<SQL
        SELECT tabla_adicional,where_adicional
        FROM busqueda_filtro
        WHERE
            idbusqueda_filtro={$_REQUEST["idbusqueda_temporal"]}
SQL;
    $datos = StaticSql::search($sql, 0, 1)[0];

    if ($datos) {
        $nuevas_tablas = [];
        $tablasAdicionales = explode(",", $datos["tabla_adicional"]);

        foreach ($tablasAdicionales as $tabla) {
            $fin = strpos($tabla, " ");
            $nombre = $fin ? substr($tabla, 0, $fin) : $tabla;

            if (strpos($tablas, $nombre) === false) {
                $nuevas_tablas[] = $tabla;
            }
        }

        if ($nuevas_tablas) {
            $tablas .= "," . implode(",", $nuevas_tablas);
            $condicion .= $datos["where_adicional"];
        }
    }
}

$sql = "SELECT {$select} FROM {$tablas} WHERE {$condicion} {$ordenar_consulta}";
print_r($sql);

if (!$_REQUEST["total"]) {
    if (MOTOR == 'SqlServer' || MOTOR == 'MSSql') {
        $consulta_conteo = "WITH conteo AS ({$sql}) SELECT COUNT(*) as cant FROM conteo";
        throw new Exception("pendiente consulta para server", 1);
    } else {
        $consulta_conteo = "SELECT COUNT(1) AS cant FROM ({$sql}) as temp";
        $result = StaticSql::search($consulta_conteo);
    }
    $total = count($result) > 1 ? count($result) : $result[0]["cant"];
} else {
    $total = $_REQUEST["total"];
}

$response = (object) [
    'total' => $total,
    'rows' => []
];

if ($response->total) {
    $result = StaticSql::search($sql, $start, $end);

    if ($result) {
        $info = str_replace('"', "'", $busqueda["info"]);

        foreach ($campos as $key => $campo) {
            $as = strpos(strtolower($campo), " as ");
            if ($as !== false) {
                $campos[$key] = substr($campo, ($as + 4), strlen($campo));
                continue;
            }
            $pos = strpos($campo, ".");
            if ($pos !== false) {
                $campos[$key] = substr($campo, ($pos + 1), strlen($campo));
            }
        }

        $listado_funciones = parsear_datos_plantilla_visual($info, implode(",", $campos));

        foreach ($result as $row) {
            $data = [
                'id' => $row[$llave]
            ];
            foreach ($campos as $key => $campo) {
                if (is_object($row[$campo])) { // para mssql y sqlserver
                    $row[$campo] = $row[$campo]->date;
                }

                if ($busqueda["tipo_busqueda"] == 2) { //grilla
                    $data[$campo] = str_replace(['"', "\\"], "", $row[$campo]);
                } else {
                    $info = str_replace("{*{$campo}*}", addslashes($row[$campo]), $info);
                }
            }

            foreach ($listado_funciones as $key => $valor) {
                $valor_variables = [];
                $funcion = explode("@", $valor);
                $variables = explode(",", $funcion[1]);

                foreach ($variables as $variable) {
                    if (isset($row[$variable])) {
                        array_push($valor_variables, $row[$variable]);
                    } else {
                        array_push($valor_variables, null);
                    }
                }

                if (function_exists($funcion[0])) {
                    $valor_funcion = call_user_func_array($funcion[0], $valor_variables);
                    if ($busqueda["tipo_busqueda"] == 2) { //grilla
                        $data[$funcion[0]] = $valor_funcion;
                    } else { //listado
                        $info = str_replace("{*" . $valor . "*}", $valor_funcion, $info);
                    }
                }
            }

            if ($busqueda["tipo_busqueda"] == 1) {
                $data['info'] = str_replace("\n", "", str_replace("\r", "", $info));
            }

            array_push($response->rows, $data);
        }
    }
}

echo json_encode($response, JSON_PARTIAL_OUTPUT_ON_ERROR);

/**
 * obtiene la condicion del sql
 *
 * @param integer $idbusqueda
 * @param integer $idcomponente
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-08-16
 */
function crear_condicion_sql($idbusqueda, $idcomponente)
{
    $sql = <<<SQL
        SELECT codigo_where
        FROM busqueda_condicion
        WHERE
            fk_busqueda_componente = {$idcomponente} OR
            busqueda_idbusqueda = {$idbusqueda}
SQL;
    $condicion = StaticSql::search($sql, 0, 1)[0]['codigo_where'];

    if (!$condicion) {
        $condicion = (!empty($_REQUEST["condicion_adicional"])) ?
            $_REQUEST["condicion_adicional"] : ' 1=1 ';
    } else if (!empty($_REQUEST["condicion_adicional"])) {
        $condicion .= $_REQUEST["condicion_adicional"];
    }

    return '(' . $condicion . ')';
}

/**
 * obtiene las funciones delimitadas por llave
 * y asterisco de un string
 *
 * @param string $cadena
 * @param array $campos
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-08-16
 */
function parsear_datos_plantilla_visual($cadena, $campos = array())
{
    if (preg_match_all('({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*[,]*[@]*)+\*})', $cadena, $resultado)) {
        $patrones = str_replace(["{*", "*}"], "", $resultado[0]);
        if ($campos) {
            $listado_campos = array_unique(explode(",", $campos));
            $listado_funciones = array_diff($patrones, $listado_campos);
        } else {
            $listado_funciones = $patrones;
        }
    }
    return $listado_funciones;
}
