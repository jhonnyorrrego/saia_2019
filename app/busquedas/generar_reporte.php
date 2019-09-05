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
    //die("invalid access");
}

$page = (int) $_REQUEST['pageNumber'] ?? 1;
$end = (int) $_REQUEST['pageSize'] ?? 30;
$start = ($page - 1) * $end;

$busqueda = Model::getQueryBuilder()
    ->select('*')
    ->from('busqueda', 'a')
    ->innerJoin('a', 'busqueda_componente', 'b', 'a.idbusqueda = b.busqueda_idbusqueda')
    ->where('b.idbusqueda_componente= :component')
    ->setParameter(':component', $_REQUEST['idbusqueda_componente'], 'integer')
    ->execute()->fetch();

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
$join = implode(",", array_filter($temporal));

if (strpos($join, 'distinct') !== false) {
    $join = str_replace('distinct', '', $join);
    $join = 'distinct ' . $join;
}

$campos = explode(",", $join);

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
    $records = Model::getQueryBuilder()
        ->select('detalle')
        ->from(BusquedaFiltroTemp::getTableName())
        ->where('idbusqueda_filtro_temp in (:identificators)')
        ->setParameter(
            ':identificators',
            $_REQUEST["idbusqueda_filtro_temp"],
            \Doctrine\DBAL\Connection::PARAM_INT_ARRAY
        )->execute()->fetchAll();

    $condition = [];
    foreach ($records as $key => $filtro_temp) {
        $condition[] = $filtro_temp['detalle'];
    }
    $cadena = implode(' AND ', $condition);
    $cadena = UtilitiesController::convertTemporalFilter($cadena);
    $condicion .= " AND (" . stripslashes($cadena) . ")";
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

if (!empty($_REQUEST["idbusqueda_temporal"])) {
    $datos = Model::getQueryBuilder()
        ->select('tabla_adicional', 'where_adicional')
        ->from('busqueda_filtro')
        ->where('idbusqueda_filtro = :identificator')
        ->setParameter(
            ':identificator',
            $_REQUEST["idbusqueda_temporal"],
            'integer'
        )->execute()->fetch();

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

$QueryBuilder = Model::getQueryBuilder()
    ->select($campos)
    ->from($tablas)
    ->where($condicion);


$ordenar_consulta = "";

if ($busqueda["agrupado_por"]) {
    $QueryBuilder->groupBy($busqueda["agrupado_por"]);
}

if ($busqueda["ordenado_por"]) {
    $sord = $busqueda["direccion"] ? $busqueda["direccion"] : ' DESC ';
    $QueryBuilder->orderBy($busqueda["ordenado_por"], $sord);
}

if (!$_REQUEST["total"]) {
    $sql = $QueryBuilder->getSQL();

    $data = Model::getQueryBuilder()
        ->select('COUNT(*) AS cant')
        ->from("({$sql}) as temp")
        ->execute()
        ->fetchAll();
    $rows = count($data);
    $total = $rows > 1 ? $rows : $data[0]["cant"];
} else {
    $total = $_REQUEST["total"];
}

$response = (object) [
    'total' => $total,
    'rows' => []
];

if ($response->total) {
    $result = $QueryBuilder
        ->setFirstResult($start)
        ->setMaxResults($end)
        ->execute()->fetchAll();

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
                    array_push($valor_variables, $row[$variable] ?? $variable);
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
    $data = Model::getQueryBuilder()
        ->select('codigo_where')
        ->from('busqueda_condicion')
        ->where('fk_busqueda_componente = :component')
        ->orWhere('busqueda_idbusqueda = :search')
        ->setParameter(':component', $idcomponente, 'integer')
        ->setParameter(':search', $idbusqueda, 'integer')
        ->execute()->fetch();

    $condicion = $data['codigo_where'];

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
    if (preg_match_all('({\*([a-zA-Z_0-9.@,])+\*})', $cadena, $resultado)) {
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
