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
    'data' => new stdClass(),
    'message' => '',
    'success' => 0
];

try {
    JwtController::check($_REQUEST['token'], $_REQUEST['key']);

    if (!$_REQUEST['fieldId']) {
        throw new Exception('No se encuentra el id del campo', 1);
    }

    set_pantalla_campos($_REQUEST['fieldId'], 1);
    $Response->success = 1;
} catch (Throwable $th) {
    $Response->message = $th->getMessage();
}

echo json_encode($Response);

function set_pantalla_campos($idpantalla_campos, $tipo_retorno = 1)
{
    $CamposFormato = new CamposFormato($idpantalla_campos);
    $datos = kma_valor_campo($_REQUEST, $CamposFormato->etiqueta_html);
    $sql_update = array();
    $valorArbol = '';
    $camposModificados = array();

    foreach ($datos as $key => $value) {
        if (preg_match("/^fs_/", $key)) {

            switch ($key) {
                case 'fs_acciones':
                    $value = ($value == 'true') ? "a,e,p" : "a,e";
                    break;
                case "fs_etiqueta":
                    $retorno["etiqueta"] = $value;
                    break;
                case "fs_placeholder":
                    $retorno["placeholder"] = $value;
                    break;
                case "fs_predeterminado":
                    $retorno["fs_predeterminado"] = $value;
                    break;
                case "fs_opciones":
                    $opcionesGuardadas = json_decode($CamposFormato->opciones, true);
                    $elementosGuardados = [];
                    foreach ($opcionesGuardadas as $fila) {
                        $elementosGuardados[] = $fila['llave'];
                    }
                    $cantidadElementos = count($elementosGuardados);
                    $nuevasPosiciones = $elementosGuardados;

                    foreach ($value as $valor) {
                        if (in_array($valor["llave"], $elementosGuardados)) {
                            continue;
                        }
                        $cantidadElementos = asignarValor($cantidadElementos, $nuevasPosiciones);
                        $nuevasPosiciones[] = $cantidadElementos;
                        $valor["llave"] = $cantidadElementos;
                    }

                    $value = json_encode($value, JSON_UNESCAPED_UNICODE);
                    break;
                case "fs_estilo":
                    if (is_array($value)) {
                        if ($value['con_decimales'] === 'false') {
                            unset($value['con_decimales']);
                        }
                        $value = json_encode($value, JSON_UNESCAPED_UNICODE);
                    }
                    $retorno[$key] = $value;
                    break;
                case "fs_obligatoriedad":
                    if ($value == "true") {
                        $value = 1;
                        $retorno["obligatoriedad"] = $value;
                    } else {
                        $value = 0;
                        $retorno["obligatoriedad"] = 0;
                    }
                    break;
            }

            array_push($sql_update, preg_replace('/^fs_/', '', $key) . "='" . $value . "'");
            array_push($camposModificados, $key);
        }
    }
    $camposVacios = obtenerCamposVacios($camposModificados, $idpantalla_campos);

    if (count($sql_update)) {
        $sql2 = "UPDATE campos_formato SET " . implode(", ", $sql_update) . $camposVacios . " WHERE idcampos_formato=" . $idpantalla_campos;

        if ($valorArbol) {
            $sqlArboles = "UPDATE campos_formato SET valor = '{$valorArbol}' WHERE idcampos_formato={$idpantalla_campos}";
            phpmkr_query($sqlArboles) or die($sqlArboles);
        }
        //$retorno["sql"] = $sql2; // Solo para depurar3
        phpmkr_query($sql2) or die($sql2);
        $retorno["exito"] = 1;
        //$cadena = load_pantalla_campos($idpantalla_campos, 0);
        $cadena = "";
        $retorno["codigo_html"] = $cadena["codigo_html"];
    }


    if ($tipo_retorno == 1) {
        return (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function obtenerCamposVacios($camposModificados, $idpantalla_campos)
{
    $CamposFormato = new CamposFormato($idpantalla_campos);
    $schema = ComponentFormGeneratorController::getSchemaFromField($CamposFormato->etiqueta_html);
    ///////////////////////////// Campos que se encuentran en el esquema segun su  componente  y que deben ser modificados ////////////////////////////////
    $campos = array();
    foreach ($schema['schema']['properties'] as $key => $i) {
        array_push($campos, $key);
    }
    ///////////////////////////// Campos que fueron modificados  ////////////////////////////////
    $camposUpdate = array();
    foreach ($camposModificados as $key => $i) {
        array_push($camposUpdate, $i);
    }
    ////////////////////////////// Campos que tienen que modificarsen vacios //////////////////////////
    $camposVacios = "";
    foreach ($campos as $key => $nombreCampo) {
        if (!in_array($nombreCampo, $camposModificados)) {
            $camposVacios .= ',' . preg_replace('/^fs_/', '', $nombreCampo) . '=""';
        }
    }
    return $camposVacios;
}

function asignarValor($x, $a)
{
    for (; in_array($x, $a); $x++);
    return $x;
}
function kma_valor_campo($datos, $tiqueta_html)
{
    switch ($tiqueta_html) {
        case "radio":
        case "checkbox":
        case "select":
            CampoOpciones::executeUpdate([
                'estado' => 0
            ], [
                'fk_campos_formato' => $datos['fieldId']
            ]);

            foreach ($datos["fs_opciones"] as $item) {
                $CampoOpciones = new CampoOpciones($item['idcampo_opciones'] ?? null);
                $CampoOpciones->setAttributes([
                    'llave' => $item['llave'],
                    'valor' => $item['valor'],
                    'estado' => 1,
                    'fk_campos_formato' => $datos['fieldId']
                ]);
                $CampoOpciones->save();
            }

            Model::getQueryBuilder()
                ->update('campo_opciones')
                ->set('llave', 'idcampo_opciones')
                ->where('llave is null')
                ->execute();

            unset($datos["fs_opciones"]);
            break;
        case "spin":
        case "moneda":
            // viene en fs_opciones y tiene con_decimales(boolean) decimales(int), criterio donde criterio puede ser "max_lt", "max", "min_gt", "min", "between", "not_between"
            // Si viene criterio = "between" o "not_between" => se toman valor_1 y valor_2, sino solo valor_1
            // Debe quedar 0@1000@1@0 => Valor inicial: valor mínimo permitido
            // Valor final: valor máximo permitido
            // Incremento: incremento entre cada opcion
            // Bloquear entrada por teclado: 1 o 0
            if (is_array($datos["fs_opciones"]) && !empty($datos["fs_opciones"])) {
                $ini = 0;
                $fin = 1000;
                $decimales = 0;
                $incremento = 1;
                if (isset($datos["fs_opciones"]["con_decimales"]) && isset($datos["fs_opciones"]["decimales"])) {
                    $decimales = $datos["fs_opciones"]["decimales"];
                }
                if (isset($datos["fs_opciones"]["criterio"])) {
                    $criterio = $datos["fs_opciones"]["criterio"];
                    switch ($criterio) {
                        case "max_lt":
                            $fin = $datos["fs_opciones"]["valor_1"] - 1;
                            break;
                        case "max":
                            $fin = $datos["fs_opciones"]["valor_1"];
                            break;
                        case "min":
                            $ini = $datos["fs_opciones"]["valor_1"];
                            break;
                        case "min_gt":
                            $ini = $datos["fs_opciones"]["valor_1"] + 1;
                            break;
                        case "between":
                            $ini = $datos["fs_opciones"]["valor_1"];
                            $fin = $datos["fs_opciones"]["valor_2"];
                            if (empty($fin)) {
                                $fin = 1000;
                            }
                            if ($fin <= $ini) {
                                $fin = $ini + 1;
                            }
                            break;
                        case "not_between":
                            break;
                    }
                    if ($decimales) {
                        $incremento = pow(10, -$decimales);
                    }
                    $datos["fs_valor"] = $ini . "@" . "$fin" . "@" . $incremento . "@0";
                }
            }
            break;
        case "fecha":
            //viene en fs_opciones y tiene tipo(date, datetime), criterio donde criterio puede ser  "max_lt", "max", "min_gt", "min", "between", "not_between"
            // Si viene criterio = "between" o "not_between" => se toman fecha_1 y fecha_2, sino solo fecha_1
            break;
        case "archivo":
            //viene en fs_opciones.tipos es una lista separada por comas de los tipos pdf, doc, docx, jpg, jpeg, gif, png, bmp, xls, xlsx, ppt,
            // fs_opciones.longitud define el tam max t fs_opciones.cantidad define si es unico o multiple
            // se debe convertir a: csv|CSV|xls|XLS|xlsx|XLSX@unico
            if (is_array($datos["fs_opciones"]) && !empty($datos["fs_opciones"])) {
                $file_arr = array_map('trim', explode(',', $datos["fs_opciones"]["tipos"]));
                $varios = "unico";
                $cantidad = $datos["fs_opciones"]["cantidad"];
                if ($cantidad > 1) {
                    $varios = "multiple";
                }
                $datos["fs_valor"] = implode("|", $file_arr) . "@" . $varios;
            }
            break;
        case "etiqueta_parrafo":
        case "etiqueta_titulo":
            //viene en fs_opciones.texto
            if (is_array($datos["fs_opciones"]) && !empty($datos["fs_opciones"])) {
                print_r($datos['fs_opciones']);
                $datos["fs_valor"] = $datos["fs_opciones"]["texto"];
            }
            break;
        case "arbol_fancytree":
            //Viene en fs_opciones
            //{"url":"","checkbox":"radio","buscador":"0","funcion_select":"","funcion_click":"","funcion_dobleclick":""}
            $texto_opc = [];
            $texto_opc["funcionario"] = "app/arbol/arbol_funcionario.php?idcampofun=1";
            $texto_opc["dependencia"] = "app/arbol/arbol_dependencia.php";
            $texto_opc["cargo"] = "app/arbol/arbol_cargo.php";
            $texto_opc["rol"] = "app/arbol/arbol_funcionario.php";

            if (is_array($datos["fs_opciones"]) && !empty($datos["fs_opciones"])) {
                $datos_ft = $datos["fs_opciones"];
                $idx = $datos_ft["url"];
                $url_ft = $texto_opc[$idx];
                $datos_ft["url"] = $url_ft;
                $datos["fs_valor"] = json_encode($datos_ft, JSON_NUMERIC_CHECK);
            }
            break;
        case "ejecutor":
            //Viene en fs_opciones: tipo: "multiple" o "unico"
            // fs_opciones.adicional : Informacion adicional "cargo,empresa,direccion,telefono,email,titulo,ciudad"
            // Siempre va "nombre,identificacion"

            if (is_array($datos["fs_opciones"]) && !empty($datos["fs_opciones"])) {
                $tipo = $datos["fs_opciones"]["tipo"];
                $adicional = "direccion,telefono,email";
                if (isset($datos["fs_opciones"]["adicional"])) {
                    $adicional = $datos["fs_opciones"]["adicional"];
                }
                $url_ft = $texto_opc[$idx];
                $datos_ft["url"] = $url_ft;
                $datos["fs_valor"] = $tipo . "@nombre,identificacion@" . $adicional;
            }
            break;
    }
    return $datos;
}
