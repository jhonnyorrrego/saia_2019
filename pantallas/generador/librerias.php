<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'librerias_saia.php';
include_once $ruta_db_superior . 'pantallas/lib/librerias_xml.php';
include_once $ruta_db_superior . 'pantallas/lib/librerias_componentes.php';

function adicionar_pantalla_campos($idpantalla, $idpantalla_componente, $tipo_retorno = 1)
{
    global $conn, $ruta_db_superior;
    $retorno = ["exito" => 0];
    $dato = busca_filtro_tabla("", "pantalla_componente", "idpantalla_componente=" . $idpantalla_componente, "", $conn);

    if ($dato["numcampos"]) {
        $sql_campos = array();
        $sql_valores = array();
        $default_campo = json_decode($dato[0]["opciones"], true);
        $consultaCampos = busca_filtro_tabla("orden", "campos_formato", "formato_idformato={$idpantalla} and orden <> 0", "orden DESC ", $conn);
        if ($consultaCampos['numcampos']) {
            $default_campo['orden'] = $consultaCampos[0]['orden'] + 1;
        }

        if (isset($default_campo["valor"]) && is_array($default_campo["valor"])) {
            $default_campo["valor"] = json_encode($default_campo["valor"]);
        }
        $texto = $dato[0]["componente"];

        foreach ($default_campo as $key => $value) {

            array_push($sql_campos, $key);
            if ($key == "nombre") {
                $valor = strval($value) . "_" . rand();
            } else {
                $valor = strval($value);
            }
            array_push($sql_valores, $valor);
        }

        if (in_array("formato_idformato", $sql_campos) === false) {
            array_push($sql_campos, 'formato_idformato');
            array_push($sql_valores, $idpantalla);
        }
        if (count($sql_campos) && count($sql_valores)) {

            $sql2 = "INSERT INTO campos_formato(" . implode(",", $sql_campos) . ") VALUES('" . implode("','", $sql_valores) . "')";
            $retorno["sql"] = $sql2;
            phpmkr_query($sql2) or die($sql2);
            $idcampo = phpmkr_insert_id();
            $retorno["sql"] = $sql2;
            if ($idcampo) {
                $cadena = load_pantalla_campos($idcampo, 0);
                $retorno["exito"] = 1;
                $retorno["idpantalla_campos"] = $idcampo;
                $retorno["codigo_html"] = $cadena["codigo_html"];
                $retorno["funciones"] = $archivos_php;
            }
        }
    }
    if ($tipo_retorno == 1)
        echo json_encode($retorno);
    else {
        return $retorno;
    }
}

function set_pantalla_campos($idpantalla_campos, $tipo_retorno = 1)
{
    global $conn, $ruta_db_superior;
    $retorno = [
        "exito" => 0,
        "idpantalla_campos" => $idpantalla_campos
    ];

    print_r($_REQUEST);

    $pantalla_campos = busca_filtro_tabla("idcampos_formato,nombre,etiqueta_html,formato_idformato", "campos_formato", "idcampos_formato=" . $idpantalla_campos, "", $conn);
    $acciones = array("a", "e", "b");
    if ($pantalla_campos["numcampos"]) {
        $datos = $_REQUEST;

        $consultarNombre = busca_filtro_tabla("", "campos_formato", "formato_idformato = {$pantalla_campos[0]['formato_idformato']} and nombre = '{$datos['fs_nombre']}' and idcampos_formato <> {$idpantalla_campos}", "", $conn);
        if (!$consultarNombre['numcampos']) {
            $retorno["nombre_campo"] = $pantalla_campos[0]["nombre"];
            $retorno["etiqueta_html"] = $pantalla_campos[0]["etiqueta_html"];

            $datos = kma_valor_campo($datos, $pantalla_campos[0]["etiqueta_html"]);

            $sql_update = array();
            $valorArbol = '';
            foreach ($datos as $key => $value) {
                if (preg_match("/^fs_/", $key)) {

                    switch ($key) {
                        case 'fs_acciones':
                            if ($value == 'true') {
                                array_push($acciones, "p");
                            }
                            $value = implode(",", $acciones);
                            break;
                        case "fs_etiqueta":
                            $retorno["etiqueta"] = $value;
                            break;
                        case "fs_arbol":

                            if ($datos['fs_opciones']['url'] == 'cargo' && $datos['fs_opciones']['checkbox'] == 'radio') {
                                $valorArbol = '../../pantallas/lib/arbol_funcionarios.php?rol=1;2;1;1;1;1;5';
                            } else if ($datos['fs_opciones']['url'] == 'cargo' && $datos['fs_opciones']['checkbox'] == 'checkbox') {
                                $valorArbol = '../../pantallas/lib/arbol_funcionarios.php?rol=1;1;1;1;1;1;5';
                            } else if ($datos['fs_opciones']['url'] == 'funcionario' && $datos['fs_opciones']['checkbox'] == 'radio') {
                                $valorArbol = '../../pantallas/lib/arbol_funcionarios.php;2;0;1;1;0;0';
                            } else if ($datos['fs_opciones']['url'] == 'funcionario' && $datos['fs_opciones']['checkbox'] == 'checkbox') {
                                $valorArbol = '../../pantallas/lib/arbol_funcionarios.php;1;0;1;1;0;0';
                            } else if ($datos['fs_opciones']['url'] == 'dependencia' && $datos['fs_opciones']['checkbox'] == 'radio') {
                                $valorArbol = '../../test_serie.php?tabla=dependencia&estado=1;2;0;1;1;0;2';
                            } else if ($datos['fs_opciones']['url'] == 'dependencia' && $datos['fs_opciones']['checkbox'] == 'checkbox') {
                                $valorArbol = '../../test_serie.php?tabla=dependencia&estado=1;1;0;1;1;0;2';
                            } else if ($datos['fs_opciones']['url'] == 'serie' && $datos['fs_opciones']['checkbox'] == 'radio') { } else if ($datos['fs_opciones']['url'] == 'serie' && $datos['fs_opciones']['checkbox'] == 'checkbox') { }

                            break;
                        case "fs_placeholder":
                            $retorno["placeholder"] = $value;
                            break;
                        case "fs_predeterminado":
                            $retorno["fs_predeterminado"] = $value;
                            break;
                        case "fs_opciones":
                            $consultarValores = busca_filtro_tabla("opciones", "campos_formato", "formato_idformato = {$pantalla_campos[0]['formato_idformato']} and idcampos_formato = {$idpantalla_campos}", "", $conn);
                            if ($consultarValores[0]['opciones']) {
                                $opcionesGuardadas = json_decode($consultarValores[0]['opciones'], true);
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
                                    $cantidadElementos = asginarValor($cantidadElementos, $nuevasPosiciones);
                                    $nuevasPosiciones[] = $cantidadElementos;
                                    $valor["llave"] = $cantidadElementos;
                                }
                            } else {
                                $cantidadElementos = count($value);
                                $nuevasPosiciones = $value;
                                $i = 0;
                                foreach ($value as &$valor) {
                                    $valor["llave"] = $i + 1;
                                    $i++;
                                }
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
                }
            }

            if (count($sql_update)) {
                $sql2 = "UPDATE campos_formato SET " . implode(", ", $sql_update) . " WHERE idcampos_formato=" . $idpantalla_campos;

                if ($valorArbol) {
                    $sqlArboles = "UPDATE campos_formato SET valor = '{$valorArbol}' WHERE idcampos_formato={$idpantalla_campos}";
                    phpmkr_query($sqlArboles) or die($sqlArboles);
                }
                //$retorno["sql"] = $sql2; // Solo para depurar3
                phpmkr_query($sql2) or die($sql2);
                $retorno["exito"] = 1;
                $cadena = load_pantalla_campos($idpantalla_campos, 0);
                $retorno["codigo_html"] = $cadena["codigo_html"];
            }
        } else {
            $retorno["exito"] = 0;
        }
    }
    if ($tipo_retorno == 1) {
        echo (json_encode($retorno));
    } else {
        return ($retorno);
    }
}

function asginarValor($x, $a)
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
            //viene en fs_opciones y es un array con las opciones. Toca convertirlos a 1,1;2,2;
            if (is_array($datos["fs_opciones"]) && !empty($datos["fs_opciones"])) {
                $num_items = count($datos["fs_opciones"]);
                $valor_i = array();
                for ($i = 0; $i < $num_items; $i++) {
                    $valor_i[] = $i + 1 . "," . $datos["fs_opciones"][$i];
                }
                if (!empty($valor_i)) {
                    $datos["fs_valor"] = implode(";", $valor_i);
                }
            }
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
                $datos["fs_valor"] = $datos["fs_opciones"]["texto"];
            }
            break;
        case "arbol_fancytree":
            //Viene en fs_opciones
            //{"url":"","checkbox":"radio","buscador":"0","funcion_select":"","funcion_click":"","funcion_dobleclick":""}
            $texto_opc = [];
            $texto_opc["funcionario"] = "arboles/arbol_funcionario.php?idcampofun=1";
            $texto_opc["dependencia"] = "arboles/arbol_dependencia.php";
            $texto_opc["cargo"] = "arboles/arbol_cargo.php";
            $texto_opc["rol"] = "arboles/arbol_funcionario.php";
            $texto_opc["serie"] = "arboles/arbol_serie.php";

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
        default:;
            break;
    }
    return $datos;
}

function load_pantalla_campos($idpantalla_campos, $tipo_retorno = 1, $count, $generar_archivo = "", $accion = '', $campos_pantalla = '')
{
    global $conn, $ruta_db_superior;
    $retorno = array(
        "exito" => 0
    );
    $pantalla_campos = get_pantalla_campos($idpantalla_campos, 0);

    if ($pantalla_campos["numcampos"] && (strpos($pantalla_campos[0]["acciones"], substr($accion, 0, 1)) !== false || $accion == '' || $accion == 'retorno_campo')) {
        $pantalla_componente = busca_filtro_tabla("clase,nombre", "pantalla_componente", "idpantalla_componente={$pantalla_campos[0]['idpantalla_componente']}", "", $conn);
        $retorno["codigo_html"] = "<li class='agregado' idpantalla_campo='" . $pantalla_campos[0]['idpantalla_campos'] . "' idpantalla_componente='" . $pantalla_campos[0]['idpantalla_componente'] . "' data-position='" . $count . "' ><i class='fa {$pantalla_componente[0]["clase"]} mr-3'></i><div class='d-inline-block' id='c_" . $pantalla_campos[0]["idpantalla_campos"] . "'> " . $pantalla_campos[0]["etiqueta"] . "</div> <div class='eliminar' style='position:absolute;right:24px;top:20px;font-size:150%;cursor:pointer;' title='Eliminar componente'><i class='fa fa-trash eliminar'></i></div></li>";
    }
    if ($tipo_retorno == 1) {
        echo json_encode($retorno);
    } else {
        return $retorno;
    }
}

function get_pantalla_campos($idpantalla_campos, $tipo_retorno = 1)
{
    $pantalla_campos = busca_filtro_tabla("A.*,B.nombre AS nombre_componente,B.etiqueta AS etiqueta_componente,B.componente,B.opciones,B.categoria,B.procesar,B.estado AS componente_estado,B.idpantalla_componente, B.eliminar, B.opciones_propias, C.nombre AS pantalla,A.idcampos_formato AS idpantalla_campos,B.etiqueta_html AS etiqueta_html_componente", "campos_formato A,pantalla_componente B, formato C", "A.formato_idformato=C.idformato AND A.idcampos_formato=" . $idpantalla_campos . " AND A.etiqueta_html=B.etiqueta_html", "", $conn);

    $pantalla_campos["exito"] = 0;
    if ($pantalla_campos["numcampos"]) {
        $pantalla_campos["exito"] = 1;
    }
    if ($tipo_retorno == 1) {
        echo (json_encode($pantalla_campos));
    } else {
        return ($pantalla_campos);
    }
}

function incluir_librerias_pantalla($idpantalla, $tipo_retorno = 1, $ruta = '', $lugar_incluir = 'footer', $tipo_libreria = 2, $acciones = "")
{
    $retorno = ["exito" => 0];
    $ruta = $ruta ?? $_REQUEST["ruta"];
    $tipo_libreria = $_REQUEST["tipo_libreria"] ?? $tipo_libreria;
    $ruta = str_replace(['../', './'], "", $ruta);
    $ruta_include = busca_filtro_tabla("", "formato_libreria", "ruta='" . $ruta . "'", "", $conn);

    if ($ruta_include["numcampos"]) {
        $idlibreria = $ruta_include[0]["idpantalla_libreria"];
    } else {
        $sql2 = "INSERT INTO formato_libreria(ruta,funcionario_idfuncionario,fecha) VALUE('" . $ruta . "'," . usuario_actual("idfuncionario") . "," . fecha_db_almacenar(date("Y-m-d h:i:s"), "Y-m-d h:i:s") . ")";
        phpmkr_query($sql2);
        $idlibreria = phpmkr_insert_id();
    }

    if ($idlibreria) {
        $retorno["exito"] = 1;
        $retorno["mensaje"] = "La librer&iacute;a se vincula con &eacute;xito";
    } else {
        $retorno["mensaje"] = "Existe un error al insertar la librer&iacute;a ";
    }

    if ($tipo_retorno == 1) {
        echo json_encode($retorno);
    } else {
        return $retorno;
    }
}

function delete_pantalla_campos($idpantalla_campos, $tipo_retorno = 1)
{
    global $ruta_db_superior;
    $retorno = ["exito" => 0, "mostrarTexto" => 0];
    $pantalla_campos = get_pantalla_campos($idpantalla_campos, 0);
    if ($pantalla_campos["numcampos"]) {
        if ($pantalla_campos[0]["eliminar"]) {
            $libreria = $ruta_db_superior . "pantallas/generador/" . $pantalla_campos[0]["nombre_componente"] . "/procesar_componente.php";
            if (file_exists($libreria)) {
                include_once($libreria);
                $pantalla_campos[0]["eliminar"]($pantalla_campos);
            }
        }
        $consultarTabla = busca_filtro_tabla("f.nombre_tabla,cf.nombre,cf.tipo_dato,cf.longitud", "formato f, campos_formato cf", "f.idformato=cf.formato_idformato and f.idformato={$_REQUEST['idformato']} and cf.idcampos_formato={$idpantalla_campos}", "", $conn);

        if ($consultarTabla['numcampos']) {
            if ($consultarTabla[0]['tipo_dato'] == 'text') {
                $longitud = 4000;
            } else if ($consultarTabla[0]['tipo_dato'] == 'datetime') {
                $longitud = 0;
            } else {
                $longitud = $consultarTabla[0]['longitud'];
            }

            $consultaCampo = Sql::getInstance()->Busca_tabla("{$consultarTabla[0]['nombre_tabla']}", "{$consultarTabla[0]['nombre']}");
            if ($consultaCampo['numcampos']) {
                $quitarObligatoriedad = "ALTER TABLE {$consultarTabla[0]['nombre_tabla']} modify {$consultarTabla[0]['nombre']} {$consultarTabla[0]['tipo_dato']}({$longitud}) null";
                phpmkr_query($quitarObligatoriedad);
            }
        }
        $sql_delete = 'DELETE FROM campos_formato WHERE idcampos_formato=' . $idpantalla_campos;
        $retorno["exito"] = 1;
        $retorno["sql"] = $sql_delete;
        $eliminarCampo = phpmkr_query($sql_delete);
        if ($eliminarCampo) {
            $camposNucleo = " and A.nombre not in('" . implode("', '", camposNucleo($_REQUEST['idformato'])) . "')";
            $camposFormato = busca_filtro_tabla("", "campos_formato A", "A.formato_idformato=" . $_REQUEST['idformato'] . " and etiqueta_html<>'campo_heredado' " . $camposNucleo . "", "A.orden", $conn);
            if ($camposFormato['numcampos']) {
                $retorno['mostrarTexto'] = 1;
            }
        }
    }
    if ($tipo_retorno == 1) {
        echo json_encode($retorno);
    } else {
        return $retorno;
    }
}

function listado_archivos_incluidos($idpantalla, $tipo_retorno, $heredado = 0)
{
    global $ruta_db_superior;
    $retorno = array(
        "exito" => 0
    );
    $pantalla = busca_filtro_tabla("", "formato A", "A.idformato=" . $idpantalla, "", $conn);
    $listado = busca_filtro_tabla("", "formato_libreria A", "A.formato_idformato=" . $idpantalla, "", $conn);
    $retorno["sql"] = $listado["sql"];
    $retorno["sql2"] = $pantalla["sql"];
    if ($listado["numcampos"]) {
        $retorno["codigo_html"] .= '<h5>Librerias ' . $pantalla[0]["etiqueta"] . ':</h5>';
        for ($i = 0; $i < $listado["numcampos"]; $i++) {
            $retorno["codigo_html"] .= '<div class="well" id="libreria' . $listado[$i]["idformato_libreria"] . '" title="' . $listado[$i]["ruta"] . '">' . $listado[$i]["ruta"];
            $retorno["codigo_html"] .= ' <div class="pull-right"><i id="eliminar_libreria2" class="icon-minus-sign eliminar_libreria" ruta_archivo="' . $listado[$i]["ruta"] . '" idformato_libreria="' . $listado[$i]["idformato_libreria"] . '" idformato="' . $idpantalla . '" heredado="' . $heredado . '"></i>';
            if ($listado[$i]['tipo_libreria'] == 1) {
                $heredado = 0;
            }
            $retorno["codigo_html"] .= '</div></div>';
        }
        $retorno["exito"] = 1;
    }
    if ($tipo_retorno == 1)
        echo (json_encode($retorno));
    else {
        return ($retorno);
    }
    return;
}

function eliminar_archivo_incluido($idpantalla_include, $tipo_retorno)
{
    $retorno = array(
        "exito" => 0,
        "exito_funciones" => 0,
        "mensaje" => "existe un error al desasociar la libreria"
    );
    $libreria = busca_filtro_tabla("", "formato_libreria", "idformato_libreria=" . $idpantalla_include, "", $conn);
    if ($libreria["numcampos"]) {
        $sql2 = "DELETE from formato_libreria WHERE idformato_libreria=" . $idpantalla_include;
        phpmkr_query($sql2);
        $retorno["exito"] = 1;
        $retorno["idformato"] = $idpantalla_include;
        $retorno["mensaje"] = "Librer&iacute;a  desasociada de forma exitosa de la pantalla";
        /**
         * TODO: Validar que se hace con las funciones de los formatos actualmente vinculados
		//ELIMINO FUNCIONES y PARAMETROS (SI TIENE)
		$funciones_asociadas=busca_filtro_tabla("","pantalla_funcion_exe a, pantalla_funcion b","b.fk_idpantalla_libreria=".$idpantalla_libreria." AND a.fk_idpantalla_funcion=b.idpantalla_funcion AND a.pantalla_idpantalla=".$pantalla_idpantalla,"",$conn);
		if($funciones_asociadas['numcampos']){
    		$ids_pantalla_funcion_exe=implode(',',extrae_campo($funciones_asociadas,'idpantalla_funcion_exe'));
    		$nombres_funciones=strtolower(implode(', ',extrae_campo($funciones_asociadas,'nombre')));

    		$sql3="DELETE FROM pantalla_funcion_exe WHERE idpantalla_funcion_exe IN(".$ids_pantalla_funcion_exe.")";
    		phpmkr_query($sql3);

    		$sql4="DELETE FROM pantalla_func_param WHERE fk_idpantalla_funcion_exe IN(".$ids_pantalla_funcion_exe.")";
    		phpmkr_query($sql4);


    		//BUSCO CAMPOS TIPO=acciones_pantalla para eliminarlos
    		$acciones_pantalla_asociadas=busca_filtro_tabla("idpantalla_campos","pantalla_campos a","valor IN(".$ids_pantalla_funcion_exe.") AND etiqueta_html='acciones_pantalla' AND a.pantalla_idpantalla=".$pantalla_idpantalla,"",$conn);
    		if($acciones_pantalla_asociadas['numcampos']){
    		    $idspantalla_campos=implode(',',extrae_campo($acciones_pantalla_asociadas,'idpantalla_campos'));
        		$sql5="DELETE FROM pantalla_campos WHERE idpantalla_campos IN(".$idspantalla_campos.")";
        		phpmkr_query($sql5);
    		}

    		$retorno["mensaje_funciones"] = "Las siguientes funciones se desvincularon satisfactoriamente: ".$nombres_funciones;
    		$retorno['exito_funciones']=1;
		}*/
    }
    if ($tipo_retorno == 1)
        echo (json_encode($retorno));
    else {
        return ($retorno);
    }
}

function get_pantalla_libreria($idpantalla_libreria, $tipo_retorno)
{
    $libreria = busca_filtro_tabla("", "pantalla_libreria A, pantalla_include B", "A.idpantalla_libreria=B.fk_idpantalla_libreria AND A.idpantalla_libreria=" . $idpantalla_libreria, "", $conn);
    $libreria["exito"] = 0;
    if ($libreria["numcampos"]) {
        $libreria["exito"] = 1;
    }
    if ($tipo_retorno == 1)
        echo (json_encode($libreria));
    else {
        return ($libreria);
    }
}

function guardar_configurar_pantalla_libreria($idpantalla, $tipo_retorno)
{
    $retorno = array(
        "mensaje" => "error vinculando las funciones de la librer&iacute;a",
        "exito" => 0
    );
    $nombre = $_REQUEST["funcion"];
    $ruta = @$_REQUEST["ruta"];
    $tipo_archivo = explode(".", $ruta);
    $cant_punto = count($tipo_archivo);
    $extension = $tipo_archivo[($cant_punto - 1)];
    $idpantalla = @$_REQUEST["pantalla_idpantalla"];
    $parametros_funcion = @$_REQUEST["parametros"];
    if (@$_REQUEST["idpantalla_libreria"]) {
        $idpantalla_libreria = $_REQUEST["idpantalla_libreria"];
    } else if (@$ruta && @$idpantalla) {
        $libreria = busca_filtro_tabla("", "pantalla_libreria A", "A.ruta LIKE '" . $ruta . "'", "", $conn);
        if ($libreria["numcampos"]) {
            $idpantalla_libreria = $libreria[0]["idpantalla_libreria"];
        } else {
            $sql2 = "INSERT INTO pantalla_libreria(ruta,funcionario_idfuncionario,fecha,tipo_archivo,tipo_libreria) VALUES('" . trim($ruta) . "'," . usuario_actual("funcionario_codigo") . "," . fecha_db_almacenar(date("Y-m-d H:i:s")) . ",'" . $extension . "','1')";
            phpmkr_query($sql2);
            $idpantalla_libreria = phpmkr_insert_id();
        }
    } else {
        $retorno["mensaje"] .= "No se ha podido vincular la librer&iacute;a a la pantalla<br />";
    }
    if ($idpantalla_libreria && $idpantalla) {
        $include = busca_filtro_tabla("", "pantalla_include A", "A.fk_idpantalla_libreria =" . $idpantalla_libreria . " AND A.pantalla_idpantalla=" . $idpantalla, "", $conn);
        if (!$include["numcampos"]) {
            if (@$_REQUEST["lugar_incluir"]) {
                $lugar = $_REQUEST["lugar_incluir"];
            } else {
                $lugar = "footer";
            }
            $sql2 = "INSERT INTO pantalla_include(fk_idpantalla_libreria,pantalla_idpantalla,lugar_incluir) VALUES(" . $idpantalla_libreria . "," . $idpantalla . ",'" . $lugar . "')";
            phpmkr_query($sql2);
            if (!phpmkr_insert_id()) {
                $retorno["Mensaje"] .= 'No se ha podido incluir la librer&iacute;a en la pantalla<br />';
            }
        }
    }
    $funcion = busca_filtro_tabla("", "pantalla_funcion A", "A.nombre LIKE '" . $nombre . "'  AND fk_idpantalla_libreria=" . $idpantalla_libreria, "", $conn);
    if ($funcion["numcampos"]) {
        $idfuncion = $funcion[0]["idpantalla_funcion"];
        if (@$_REQUEST["lugar_incluir"]) {
            $lugar = $_REQUEST["lugar_incluir"];
        } else {
            $lugar = "footer";
        }
        $sql2 = "UPDATE pantalla_funcion SET parametros='" . $parametros_funcion . "',tipo_funcion='" . $extension . "',lugar_incluir='" . $lugar_incluir . "' WHERE idpantalla_funcion=" . $idfuncion;
        phpmkr_query($sql2);
    } else {
        $sql2 = "INSERT INTO pantalla_funcion(nombre,parametros,fk_idpantalla_libreria,tipo_funcion) VALUES('" . $nombre . "','" . $parametros_funcion . "'," . $idpantalla_libreria . ",'" . $extension . "')";
        phpmkr_query($sql2);
        $idfuncion = phpmkr_insert_id();
    }
    if ($idfuncion) {
        $where = '';
        if (@$_REQUEST["idpantalla_funcion_exe"]) {
            $where = " idpantalla_funcion_exe=" . $_REQUEST["idpantalla_funcion_exe"] . " AND A.pantalla_idpantalla=" . $idpantalla;
        } else {
            $where = "A.fk_idpantalla_funcion=" . $idfuncion . " AND A.pantalla_idpantalla=" . $idpantalla;
        }
        $funcion_exe = busca_filtro_tabla("", "pantalla_funcion_exe A", $where, "", $conn);

        $vistas = '';
        if (@$_REQUEST["vistas"]) {
            $vistas = implode($_REQUEST["vistas"]);
        } else {
            $vistas = 'v,l';
        }
        if (@$_REQUEST["momento"] == '') {
            $_REQUEST["momento"] = 1;
        }
        // (@$_REQUEST["tipo_funcion_exe"]=="modificar" && @$_REQUEST["accion"]=='mostrar'||
        if ($funcion_exe["numcampos"] && @$_REQUEST["idpantalla_funcion_exe"]) {
            $idfuncion_exe = $funcion_exe[0]["idpantalla_funcion_exe"];
            $sql2 = "UPDATE pantalla_funcion_exe SET momento='" . $_REQUEST["momento"] . "', accion='" . @$_REQUEST["accion"] . "', vistas='" . $vistas . "', fk_idpantalla_funcion=" . $idfuncion . " WHERE idpantalla_funcion_exe=" . $idfuncion_exe;
            phpmkr_query($sql2);
            $retorno["update_funcion_exe"] = $sql2;
        } else {
            $sql2 = "INSERT INTO pantalla_funcion_exe(momento,accion,vistas, fk_idpantalla_funcion,pantalla_idpantalla) VALUES('" . $_REQUEST["momento"] . "','" . @$_REQUEST["accion"] . "','" . $vistas . "'," . $idfuncion . "," . $idpantalla . ")";
            phpmkr_query($sql2);
            $idfuncion_exe = phpmkr_insert_id();
        }
        if ($idfuncion_exe) {
            $retorno["idfuncion_exe"] = $idfuncion_exe;
            $retorno["update_pfp"] = '';
            $sql2 = "DELETE FROM pantalla_func_param WHERE fk_idpantalla_funcion_exe=" . $idfuncion_exe;
            phpmkr_query($sql2);
            $param = str_replace("$", "", $parametros_funcion);
            $param_temp = explode(",", $param);
            $cant_param = count($param_temp);
            for ($i = 0; $i < $cant_param; $i++) {
                $tipo_param = '';
                $valor_param = '';
                if (@$_REQUEST["div_" . $param_temp[$i]]) {
                    $tipo_param = $_REQUEST["div_" . $param_temp[$i]];
                }
                if (@$_REQUEST[$param_temp[$i] . "_dato"]) {
                    $valor_param = $_REQUEST[$param_temp[$i] . "_dato"];
                }
                $sql2 = "INSERT INTO pantalla_func_param(nombre,valor,tipo,fk_idpantalla_funcion_exe) VALUES('" . $param_temp[$i] . "', '" . $valor_param . "'," . $tipo_param . "," . $idfuncion_exe . ")";
                phpmkr_query($sql2);
            }
        }
    } else {
        $retorno["mensaje"] .= "No se ha podido vincular la funci&oacute;n a la pantalla";
    }
    if ($idfuncion_exe) {
        $retorno["idpantalla_funcion_exe"] = $idfuncion_exe;
        $retorno["mensaje"] = "Funci&oacute;n vinculada con &eacute;xito.";
        $retorno["exito"] = 1;
        $cantidad = busca_filtro_tabla("", "pantalla_funcion_exe", "fk_idpantalla_funcion=" . $idfuncion . " AND pantalla_idpantalla=" . $idpantalla, "", $conn);
        $retorno["cantidad"] = $cantidad["numcampos"];
    }
    if ($tipo_retorno == 1)
        echo (json_encode($retorno));
    else {
        return ($retorno);
    }
}

function camposNucleo($idformato)
{
    global $conn;
    $consultaFt = busca_filtro_tabla("nombre_tabla,cod_padre", "formato", "idformato=" . $idformato, "", $conn);
    $primaryPadre = '';
    if ($consultaFt[0]['cod_padre']) {
        $consultaFtPadre = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $consultaFt[0]['cod_padre'], "", $conn);
        if ($consultaFtPadre['numcampos']) {
            $primaryPadre = "{$consultaFtPadre[0]['nombre_tabla']}";
        }
    }

    $primaryKey = "id{$consultaFt[0]['nombre_tabla']}";
    $campos_excluir = [
        "dependencia",
        "documento_iddocumento",
        "estado_documento",
        "firma",
        "serie_idserie",
        "encabezado",
        $primaryKey,
        $primaryPadre
    ];

    return array_filter($campos_excluir);
}

function validarCamposObligatorios($idformato)
{
    global $conn;
    $retorno = ["exito" => 1, "mensaje" => ''];
    if (@$_REQUEST["idformato"]) {
        $formato = busca_filtro_tabla("*", "formato A", "A.idformato=" . $idformato, "", $conn);
        $consulta_campos_lectura = busca_filtro_tabla("valor", "configuracion", "nombre='campos_solo_lectura'", "", $conn);

        if ($consulta_campos_lectura['numcampos']) {
            $campos_lectura = json_decode($consulta_campos_lectura[0]['valor'], true);
            $campos_lectura = implode(",", $campos_lectura);
            $campos_lectura = str_replace(",", "','", $campos_lectura);
            $busca_idft = strpos($campos_lectura, "idft_");
            if ($busca_idft !== false) {
                $consulta_ft = busca_filtro_tabla("nombre_tabla", "formato", "idformato=" . $idformato, "", $conn);
                $campos_lectura = str_replace("idft_", "id" . $formato[0]['nombre_tabla'], $campos_lectura);
                $campos_excluir[] = $campos_lectura;
            }
        }
        include_once($ruta_db_superior . "pantallas/generador/librerias.php");
        $camposNucleo = " and A.nombre not in('" . implode("', '", camposNucleo($idformato)) . "')";
        $condicion_adicional = " and A.nombre not in('" . implode("', '", $campos_excluir) . "')";
        $campos = busca_filtro_tabla("", "campos_formato A", "A.formato_idformato=" . $idformato . " and etiqueta_html<>'campo_heredado' " . $condicion_adicional . " " . $camposNucleo . "", "A.orden", $conn);

        if ($campos['numcampos']) {
            $consultaFormato = "SELECT acciones FROM campos_formato WHERE formato_idformato = {$idformato} and (acciones like 'p' or acciones like '%,p,%' or acciones like '%,p')";
            $camposFormato = StaticSql::search($consultaFormato);
            if (!$camposFormato) {
                $retorno['mensaje'] = 'Debe seleccionar alguno de los campos para incluirse en la descripción de los documentos';
                $retorno['exito'] = 0;
            } else {
                $consultaFormato = "SELECT valor,etiqueta,opciones FROM campos_formato WHERE formato_idformato = {$idformato} and etiqueta_html in ('arbol_fancytree','radio','checkbox','select','archivo','arbol')";
                $camposFormato = StaticSql::search($consultaFormato);
                if ($camposFormato) {
                    $campos = '';
                    for ($i = 0; $i < count($camposFormato); $i++) {
                        $opciones = json_decode($camposFormato[$i]['opciones'], true);
                        if (!$opciones) {
                            $campos .= $camposFormato[$i]['etiqueta'] . ",";
                            $retorno['exito'] = 0;
                            $retorno['mensaje'] = "Es necesario configurar los campos antes de seguir: " . substr(trim($campos), 0, -1) . " ";
                        }
                    }
                }
            }
        } else {
            $retorno['mensaje'] = 'Recuerde que se deben crear campos del formato';
            $retorno['exito'] = 0;
        }
    }
    echo json_encode($retorno, JSON_UNESCAPED_UNICODE);
}

if (@$_REQUEST["ejecutar_pantalla_campo"]) {
    if (!@$_REQUEST["tipo_retorno"]) {
        $_REQUEST["tipo_retorno"] = 1;
    }
    $_REQUEST["ejecutar_pantalla_campo"]($_REQUEST["idformato"], $_REQUEST["tipo_retorno"]);
}
if (@$_REQUEST["ejecutar_campos_formato"]) {
    if (!@$_REQUEST["tipo_retorno"]) {
        $_REQUEST["tipo_retorno"] = 1;
    }
    $_REQUEST["ejecutar_campos_formato"]($_REQUEST["idpantalla_campos"], $_REQUEST["tipo_retorno"]);
}

if ($_REQUEST['ejecutarLibreria']) {
    validarCamposObligatorios($_REQUEST['idformato']);
}
