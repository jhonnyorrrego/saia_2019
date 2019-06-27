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

// pagina actual inicia en 1
$page = (int)$_REQUEST['page'] ? $_REQUEST["page"] : 1;
// registros por listado de datos
$limit = (int)$_REQUEST['rows'] ? $_REQUEST["rows"] : 30;
$aux_limit = $_REQUEST['rows'];

// Campo por el que se debe ordenar
$sidx = @$_REQUEST['sidx'];
// Orden de la consulta
$sord = @$_REQUEST['sord'];

$actual_row = (int)$_REQUEST['actual_row'];
$start = $actual_row;

$sql = <<<SQL
    SELECT * 
    FROM 
        busqueda A JOIN
        busqueda_componente B
            ON A.idbusqueda=B.busqueda_idbusqueda
    WHERE
        B.idbusqueda_componente={$_REQUEST["idbusqueda_componente"]}
SQL;
$record = StaticSql::search($sql, 0, 1);

if ($record) {
    $busqueda = $record[0];
} else {
    throw new Exception("Componente invalido", 1);
}

if ($busqueda["ruta_libreria"]) {
    $librerias = array_unique(explode(",", $busqueda["ruta_libreria"]));
    array_walk($librerias, "incluir_librerias_busqueda");
}

$select = $ordenar = $agrupar = $sumar = [];
$condicion = "";

if ($busqueda["tablas"]) {
    $tablas = explode(",", $busqueda["tablas"]);
} else {
    $tablas = [];
}

if ($busqueda["tablas_adicionales"]) {
    $tablas = array_merge($tablas, explode(",", $busqueda["tablas_adicionales"]));
}

array_push($select, $busqueda["llave"], $busqueda["campos"], $busqueda["campos_adicionales"]);
$select = array_filter($select);
$campos_string = implode(",", $select);

if (strpos($campos_string, 'distinct') !== false) {
    $campos_string = str_replace('distinct', '', $campos_string);
    $campos_string = 'distinct ' . $campos_string;
}

$campos = explode(",", $campos_string);

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

if (!$sidx && $busqueda["ordenado_por"]) {
    $sidx = $busqueda["ordenado_por"];
    $sord = $busqueda["direccion"] ? $busqueda["direccion"] : ' DESC ';
}

if (!empty($_REQUEST["idbusqueda_filtro_temp"])) {
    $filtro_temp = busca_filtro_tabla("", "busqueda_filtro_temp", "idbusqueda_filtro_temp IN(" . $_REQUEST["idbusqueda_filtro_temp"] . ")", "", $conn);
    if ($filtro_temp["numcampos"]) {
        $cadena = '';
        for ($i = 0; $i < $filtro_temp["numcampos"]; $i++) {
            $cadena .= UtilitiesController::convertTemporalFilter($filtro_temp[$i]["detalle"]);
            if (isset($filtro_temp[$i + 1]["detalle"])) {
                $cadena .= ' AND ';
            }
        }
        $condicion .= " AND (" . stripslashes($cadena) . ")";
    }
}
$condicion = str_replace(" AND  and  ", " and ", $condicion); //:'(

foreach ($campos as $valor) {
    $as = strpos(strtolower($valor), " as ");
    if ($as !== false) {
        $agrupacion[] = substr($valor, 0, ($as));
    } else {
        $agrupacion[] = $valor;
    }
}

$lcampos = $campos;
$campos_consulta = implode(",", $lcampos);
$tablas_consulta = implode(",", $tablas);

$funciones_tablas = parsear_datos_plantilla_visual($tablas_consulta);
foreach ($funciones_tablas as $key => $valor) {
    unset($valor_variables);
    $valor_variables = array();
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
    $tablas_consulta = str_replace("{*" . $valor . "*}", $resultado, $tablas_consulta);
}

$ordenar_consulta = "";
$ordenar_consulta2 = "";
$agrupar_consulta = $busqueda["agrupado_por"];

if ($agrupar_consulta != "") {
    $ordenar_consulta .= " GROUP BY " . $agrupar_consulta;
    $ordenar_consulta2 .= " GROUP BY " . $agrupar_consulta;
    $ordenar_consulta_aux = " GROUP BY " . implode(",", $agrupacion);
}

if ($sidx && $sord) {
    $ordenar_consulta2 .= "{$sidx} {$sord}";
}

$condicion = str_replace("%y-%m-%d", "%Y-%m-%d", $condicion);

if (@$_REQUEST["idbusqueda_temporal"]) {
    $datos = busca_filtro_tabla("tabla_adicional,where_adicional", "busqueda_filtro", "idbusqueda_filtro=" . $_REQUEST["idbusqueda_temporal"], "", $conn);
    if ($datos["numcampos"]) {
        $dat = explode(",", $datos[0]["tabla_adicional"]);
        $cantidad = count($dat);
        for ($i = 0; $i < $cantidad; $i++) {
            $fin = strpos($dat[$i], " ");
            if ($fin) {
                $tabla2 = substr($dat[$i], 0, $fin);
            } else {
                $tabla2 = $dat[$i];
            }
            if (strpos(@$tablas_consulta, @$tabla2) === false) {
                $nuevas_tablas[] = $dat[$i];
            }
        }
        $cantidad = count($nuevas_tablas);
        if ($cantidad) {
            $tablas_consulta .= "," . implode(",", $nuevas_tablas);
            $condicion .= $datos[0]["where_adicional"];
        }
    }
}

if (!$_REQUEST["cantidad_total"]) {
    if (MOTOR == 'SqlServer' || MOTOR == 'MSSql') {
        $consulta_conteo = "WITH conteo AS (SELECT " . $campos_consulta . " FROM " . $tablas_consulta . " WHERE " . $condicion . $ordenar_consulta . ") SELECT COUNT(*) as cant FROM conteo";
        $conteo_filas = $conn->Ejecutar_sql($consulta_conteo);
        $result = phpmkr_fetch_array($conteo_filas);
        $result[0] = array();
        $result[0]['cant'] = $result['cant'];
        $result["numcampos"] = $result['cant'];
    } else {
        $select = '(SELECT ' . $campos_consulta . ' FROM ' . $tablas_consulta . ' WHERE' . $condicion . $ordenar_consulta . ') AS temp';
        $consulta_conteo = "SELECT COUNT(1) AS cant FROM " . $select;
        $result = ejecuta_filtro_tabla($consulta_conteo, $conn);
    }

    if ($result["numcampos"] > 1) {
        $_REQUEST["cantidad_total"] = $result["numcampos"];
        $result[0]["cant"] = $result["numcampos"];
    } else {
        $_REQUEST["cantidad_total"] = $result[0]["cant"];
    }
} else {
    $result["numcampos"] = @$_REQUEST["cantidad_total"];
    $result[0]['cant'] = @$_REQUEST["cantidad_total"];
}

$response = [
    'exito' => 0,
    'mensaje' => 'Error inesperado'
];

$count = $result[0]['cant'];
$response['records'] = $count;

if (!$_REQUEST['onlyCount']) {
    if ($aux_limit == "todos") {
        $limit = $count;
    }
    if ($count > 0) {
        $total_pages = ceil($count / $limit);
        $response['total_pages'] = $total_pages;

        if ($start) {
            $response['page'] = $page + 1;
        } else {
            $response['page'] = 1;
        }

        if ($response['page'] > $response['total_pages']) {
            $response['exito'] = 2;
            $response['mensaje'] = "Fin del listado";
        } else {

            $result = busca_filtro_tabla_limit($campos_consulta, $tablas_consulta, $condicion, $ordenar_consulta2, (int)$start, (int)$limit, $conn);
            $response['sql'] = $result["sql"];

            if ($result["numcampos"]) {
                $response['exito'] = 1;
                $response['mensaje'] = "Registros encontrados";

                $cant_campos = count($lcampos);
                $info_base = str_replace('"', "'", $busqueda["info"]);
                for ($j = 0; $j < $cant_campos; $j++) {
                    $as = strpos(strtolower($lcampos[$j]), " as ");
                    if ($as !== false) {
                        $lcampos[$j] = substr($lcampos[$j], ($as + 4), strlen($lcampos[$j]));
                        continue;
                    }
                    $pos = strpos($lcampos[$j], ".");
                    if ($pos !== false) {
                        $lcampos[$j] = substr($lcampos[$j], ($pos + 1), strlen($lcampos[$j]));
                    }
                }
                $listado_funciones = parsear_datos_plantilla_visual($info_base, implode(",", $lcampos));

                for ($i = 0; $i < $result["numcampos"]; $i++) {
                    $response['rows'][$i] = [];
                    $response['rows'][$i]['llave'] = $result[$i][$llave];

                    unset($listado_campos);
                    $listado_campos = array();

                    $info = $info_base;
                    for ($j = 0; $j < $cant_campos; $j++) {
                        $caden = ' \ ';
                        if (is_object($result[$i][$lcampos[$j]])) { // para mssql y sqlserver
                            $result[$i][$lcampos[$j]] = $result[$i][$lcampos[$j]]->date;
                        }
                        $response['rows'][$i][$lcampos[$j]] = str_replace('"', "", str_replace(trim($caden), "", $result[$i][$lcampos[$j]]));
                        $info = str_replace("{*" . $lcampos[$j] . "*}", addslashes($result[$i][$lcampos[$j]]), $info);
                    }

                    foreach ($listado_funciones as $key => $valor) {
                        unset($valor_variables);
                        $valor_variables = array();
                        $funcion = explode("@", $valor);
                        $variables = explode(",", $funcion[1]);
                        $cant_variables = count($variables);
                        for ($h = 0; $h < $cant_variables; $h++) {
                            if (@$result[$i][$variables[$h]])
                                array_push($valor_variables, $result[$i][$variables[$h]]);
                            else
                                array_push($valor_variables, $variables[$h]);
                        }
                        if (function_exists($funcion[0])) {
                            $valor_funcion = call_user_func_array($funcion[0], $valor_variables);
                            $info = str_replace("{*" . $valor . "*}", $valor_funcion, $info);
                            if ($busqueda["tipo_busqueda"] == 2) {
                                $response["rows"][$i][$funcion[0]] = $valor_funcion;
                            }
                        }
                    }

                    if ($busqueda["tipo_busqueda"] == 1) {
                        $response['rows'][$i]['info'] = "<div id='resultado_pantalla_" . $result[$i][$llave] . "' class='well'></div>";
                        $response['rows'][$i]['info'] = str_replace("\n", "", str_replace("\r", "", $info));
                    }
                }
            }
            $response['actual_row'] = $actual_row + $result["numcampos"];
            if ($response['actual_row'] > $response['records']) {
                $response['actual_row'] = $response['records'];
            }
        }
    } else {
        $response['exito'] = 3;
        $response['mensaje'] = "No existen registros";
    }
} else {
    $response['exito'] = 1;
}

echo json_encode($response, JSON_PARTIAL_OUTPUT_ON_ERROR);

function crear_condicion_sql($idbusqueda, $idcomponente)
{
    $datos_condicion = busca_filtro_tabla("", "busqueda_condicion B", "B.fk_busqueda_componente=" . $idcomponente . " or B.busqueda_idbusqueda=" . $idbusqueda, "");
    $condicion = $datos_condicion[0]["codigo_where"];

    if (!$condicion) {
        if (!empty($_REQUEST["condicion_adicional"])) {
            $condicion = $_REQUEST["condicion_adicional"];
        } else {
            $condicion = ' 1=1 ';
        }
    } else if (!empty($_REQUEST["condicion_adicional"])) {
        $condicion .= $_REQUEST["condicion_adicional"];
    }

    return '(' . $condicion . ')';
}

function parsear_datos_plantilla_visual($cadena, $campos = array())
{
    $result = preg_match_all('({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*[,]*[@]*)+\*})', $cadena, $resultado);
    if ($result !== false) {
        $patrones = str_replace(array(
            "{*",
            "*}"
        ), "", $resultado[0]);
        if ($campos) {
            $listado_campos = array_unique(explode(",", $campos));
            $listado_funciones = array_diff($patrones, $listado_campos);
        } else {
            $listado_funciones = $patrones;
        }
    }
    return ($listado_funciones);
}

function incluir_librerias_busqueda($elemento, $indice)
{
    global $ruta_db_superior;
    include_once $ruta_db_superior . $elemento;
}
