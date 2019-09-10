<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "formatos/librerias/funciones_generales.php";

function listado_hijos_formato($idformato, $iddoc)
{
    global $conn;
    if ($idformato) {
        $formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);

        if ($formato["numcampos"]) {
            $campos = busca_filtro_tabla("", "campos_formato", "formato_idformato=" . $idformato . " AND etiqueta_html NOT IN('detalle','hidden')", "", $conn);
            //$datos_hijo=busca_filtro_tabla("",$formato[0]["nombre_tabla"],$_REQUEST["llave"]."=".$iddoc,"",$conn);
            /* campos:arreglo con datos a mostrar
              tabla: Tabla a mostrar
              campo: campo que sirve de enlace entre padre e hijo
              llave: llave que sirve de enlace id del padre
              orden: campo por el que se debe ordenar
             */
            $lcampos = extrae_campo($campos, "nombre", "U");
            $tabla = $formato[0]["nombre_tabla"];

            $formato_padre = busca_filtro_tabla("", "formato", "idformato=" . $formato[0]["cod_padre"], "", $conn);
            $id_padre = busca_filtro_tabla("id" . $formato_padre[0]["nombre_tabla"] . " as id", $formato_padre[0]["nombre_tabla"], "documento_iddocumento=" . $iddoc, "", $conn);

            $campo_enlace = $formato_padre[0]["nombre_tabla"];
            $id = $id_padre[0]["id"];
            $enlace_adicionar = "";
            array_push($lcampos, "id" . $tabla);

            if (@$_REQUEST["iddoc"]) {
                agrega_boton("texto", "../../botones/formatos/adicionar.gif", "../../responder.php?idformato=" . $idformato . "&iddoc=" . $_REQUEST["padre"], "", "Adicionar " . $formato[0]["etiqueta"], $formato[0]["nombre_tabla"], "", "", 0);
                $enlace_adicionar .= "<br /><br />";
            }
            $texto .= $enlace_adicionar . listar_formato_hijo2($lcampos, $tabla, $campo_enlace, $id, $orden);
            echo ($texto);
        }
    }
}

function listar_formato_hijo2($campos, $tabla, $campo_enlace, $llave, $orden)
{
    global $conn, $idformato;
    $where = "";
    $condicion = " AND B.estado<>'ELIMINADO'";
    if (in_array("estado", $campos) && !@$_REQUEST["enlace_adicionar_formato"]) {
        $condicion .= " AND A.estado<>'INACTIVO'";
    }

    if (count($campos)) {
        $where .= " AND A.nombre IN('" . implode("','", $campos) . "')";
    }
    $lcampos = busca_filtro_tabla("A.*,B.idformato,B.nombre AS nombre_formato,B.ruta_mostrar", "campos_formato A,formato B", "B.nombre_tabla LIKE '" . $tabla . "' AND A.formato_idformato=B.idformato" . $where, "A.orden", $conn);

    $hijo = busca_filtro_tabla("", $tabla . " A, documento B", "A.documento_iddocumento=B.iddocumento AND A." . $campo_enlace . "=" . $llave . $condicion, $orden, $conn);

    if ($hijo["numcampos"] && $lcampos["numcampos"]) {
        $texto .= '<div style="overflow:auto; border:1px solid; width:100%; height:94$;"><table border="1px" style="border-collapse:collapse;width:60%" ><thead><tr class="encabezado_list">';
        for ($j = 0; $j < $lcampos["numcampos"]; $j++) {
            if ($lcampos[$j]["nombre"] == "id" . $tabla) {
                $texto .= '<td>&nbsp;</td>';
            } else
                $texto .= '<td>' . $lcampos[$j]["etiqueta"] . "</td>";
        }
        $texto .= '</tr></thead><tbody style="overflow:auto; ">';
        for ($i = 0; $i < $hijo["numcampos"]; $i++) {
            $texto .= '<tr class="celda_transparente">';
            for ($j = 0; $j < $lcampos["numcampos"]; $j++) {
                $avance = '';
                if ($lcampos[$j]["nombre"] == 'avance')
                    $avance = '%&nbsp;';
                if ($lcampos[$j]["nombre"] == "id" . $tabla) {
                    $texto .= '<td><a href="../' . $lcampos[0]["nombre_formato"] . '/' . $lcampos[0]["ruta_mostrar"] . '?idformato=' . $lcampos[0]["idformato"] . '&iddoc=' . $hijo[$i]["documento_iddocumento"] . '">Ver</a></td>';
                } else
                    $texto .= '<td align="center">' . mostrar_valor_campo($lcampos[$j]["nombre"], $lcampos[$j]["formato_idformato"], $hijo[$i]["documento_iddocumento"], 1) . "&nbsp;" . $avance . "</td>";
            }
            $texto .= '</tr>';
        }
        $texto .= '</tbody></table></div>';
    }
    return ($texto);
}

/**
 * crea la nueva ruta de radicacion para un documento
 *
 * @param array $ruta2 [
 *    [
 *        funcionario: funcionario_codigo, iddependencia_cargo
 *        tipo_firma: 1 => firma , 0 => no firma
 *        tipo => 1 => funcionario_codigo, 5 => iddependencia_cargo
 *    ]
 * ]
 * @param integer $iddoc iddocumento
 * @param integer $firma1
 * @return void
 * @date 2019
 */
function insertar_ruta($ruta2, $iddoc, $firma1 = 1)
{
    global $conn;

    if ($ruta2) {
        if ($ruta2[0]['tipo'] == 5) {
            $VfuncionarioDc = VfuncionarioDc::findByRole($ruta2[0]['funcionario']);
            $userId = $VfuncionarioDc->funcionario_codigo;
        } else {
            $userId = $ruta2[0]['funcionario'];
        }
    }

    if (!$ruta2 || $userId != SessionController::getValue('usuario_actual')) {
        $ruta = [];
        array_push($ruta, [
            "funcionario" => SessionController::getValue('usuario_actual'),
            "tipo_firma" => $firma1,
            "tipo" => 1
        ]);
        $ruta = array_merge($ruta, $ruta2);
    } else {
        $ruta = $ruta2; // :'(
    }

    RutaDocumento::inactiveByType($iddoc, RutaDocumento::TIPO_RADICACION);

    //nueva relacion de ruta con el documento
    $fk_ruta_documento = RutaDocumento::newRecord([
        'fk_documento' => $iddoc,
        'tipo' => RutaDocumento::TIPO_RADICACION,
        'estado' => 1,
        'tipo_flujo' => RutaDocumento::FLUJO_SERIE
    ]);

    $radicador = busca_filtro_tabla("f.funcionario_codigo", "configuracion c,funcionario f", "c.nombre='radicador_salida' and f.login=c.valor", "", $conn);
    array_push($ruta, array(
        "funcionario" => $radicador[0]["funcionario_codigo"],
        "tipo_firma" => 0,
        "tipo" => 1
    ));
    phpmkr_query("UPDATE buzon_entrada SET activo=0, nombre=" . concatenar_cadena_sql(array(
        "'ELIMINA_'",
        "nombre"
    )) . " where archivo_idarchivo='" . $iddoc . "' and (nombre='POR_APROBAR' OR nombre='REVISADO' OR nombre='APROBADO' OR nombre='VERIFICACION')");
    phpmkr_query("UPDATE buzon_salida SET nombre=" . concatenar_cadena_sql(array(
        "'ELIMINA_'",
        "nombre"
    )) . " WHERE archivo_idarchivo='" . $iddoc . "' and nombre IN('POR_APROBAR','LEIDO','COPIA','BLOQUEADO','RECHAZADO','REVISADO','APROBADO','DEVOLUCION','TRANSFERIDO','TERMINADO')", $conn);

    for ($i = 0; $i < count($ruta) - 1; $i++) {
        if (!isset($ruta[$i]["tipo_firma"])) {
            $ruta[$i]["tipo_firma"] = 1;
        }
        if (!isset($ruta[$i]["tipo"])) {
            $ruta[$i]["tipo"] = 1;
        }
        if (!isset($ruta[$i + 1]["tipo"])) {
            $ruta[$i + 1]["tipo"] = 1;
        }

        if ($ruta[$i]["tipo"] == 5) {
            $func_codigo1 = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "iddependencia_cargo=" . $ruta[$i]["funcionario"], "", $conn);
            $funcionario1 = $func_codigo1[0]['funcionario_codigo'];
        } else {
            $funcionario1 = $ruta[$i]["funcionario"];
        }

        $retorno1 = obtener_reemplazo($funcionario1, 1);
        if ($retorno1['exito']) {
            $funcionario1 = $retorno1['funcionario_codigo'][0];
            if ($ruta[$i]["tipo"] == 5) {
                $equiv = busca_filtro_tabla("llave_entidad_destino", "reemplazo_equivalencia", "fk_idreemplazo_saia=" . $retorno1['idreemplazo'][0] . " and entidad_identidad=5 and llave_entidad_origen=" . $ruta[$i]["funcionario"], "", $conn);
                if ($equiv["numcampos"]) {
                    $ruta[$i]["funcionario"] = $equiv[0]["llave_entidad_destino"];
                } else {
                    $ruta[$i]["tipo"] = 1;
                    $ruta[$i]["funcionario"] = $funcionario1;
                }
            }
        }

        if ($ruta[$i + 1]["tipo"] == 5) {
            $func_codigo2 = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "iddependencia_cargo=" . $ruta[$i + 1]["funcionario"], "", $conn);
            $funcionario2 = $func_codigo2[0]['funcionario_codigo'];
        } else {
            $funcionario2 = $ruta[$i + 1]["funcionario"];
        }

        $retorno2 = obtener_reemplazo($funcionario2, 1);
        if ($retorno2['exito']) {
            $funcionario2 = $retorno2['funcionario_codigo'][0];
            if ($ruta[$i + 1]["tipo"] == 5) {
                $equiv = busca_filtro_tabla("llave_entidad_destino", "reemplazo_equivalencia", "fk_idreemplazo_saia=" . $retorno2['idreemplazo'][0] . " and entidad_identidad=5 and llave_entidad_origen=" . $ruta[$i + 1]["funcionario"], "", $conn);
                if ($equiv["numcampos"]) {
                    $ruta[$i + 1]["funcionario"] = $equiv[0]["llave_entidad_destino"];
                } else {
                    $ruta[$i + 1]["tipo"] = 1;
                    $ruta[$i + 1]["funcionario"] = $funcionario2;
                }
            }
        }

        $sql = "insert into ruta(destino,origen,documento_iddocumento,condicion_transferencia,tipo_origen,tipo_destino,orden,obligatorio,idenlace_nodo,fk_ruta_documento) values('" . $ruta[$i + 1]["funcionario"] . "','" . $ruta[$i]["funcionario"] . "','$iddoc','POR_APROBAR'," . $ruta[$i]["tipo"] . "," . $ruta[$i + 1]["tipo"] . ",$i," . $ruta[$i]["tipo_firma"] . ",'" . @$ruta[$i]["paso_actividad"] . "',{$fk_ruta_documento})";
        phpmkr_query($sql);
        $idruta = phpmkr_insert_id();
        $fecha = fecha_db_almacenar(date("Y-m-d H:i:s"), 'Y-m-d H:i:s');

        $sql = "insert into buzon_entrada(origen,destino,archivo_idarchivo,activo,tipo_origen,tipo_destino,ruta_idruta,nombre,fecha) values('" . $funcionario2 . "','" . $funcionario1 . "','$iddoc',1," . $ruta[$i + 1]["tipo"] . "," . $ruta[$i]["tipo"] . ",$idruta,'POR_APROBAR'," . $fecha . ")";
        phpmkr_query($sql);
    }
}

/* <Clase>
  <Nombre>validar_digitalizacion_formato_radicacion</Nombre>
  <Parametros>$_REQUEST["digitalizacion"]:Debe aparecer la opcion desea digitalizar Si/No en el formato con el nombre digitalizacion;  $idformto:Llave del formato que se vincula ;$iddoc=documento que  debe vincular con la accion</Parametros>
  <Responsabilidades>Redirecciona a la pantalla de adicionar pagina<Responsabilidades>
  <Notas></Notas>
  <Excepciones></Excepciones>
  <Salida></Salida>
  <Pre-condiciones><Pre-condiciones>
  <Post-condiciones><Post-condiciones>
  </Clase> */

function validar_digitalizacion_formato($idformato, $iddoc)
{
    global $conn, $ruta_db_superior;
    if ($_REQUEST["digitalizacion"] == 1) {
        redirecciona($ruta_db_superior . "views/documento/paginaadd.php?&key=" . $iddoc . "&x_enlace=mostrar");
    }
}

/* <Clase>
  <Nombre>digitalizacion_formato_radicacion</Nombre>
  <Parametros>$_REQUEST["digitalizacion"]:Debe aparecer la opcion desea digitalizar Si/No en el formato con el nombre digitalizacion;  $idformto:Llave del formato que se vincula ;$iddoc=documento que  debe vincular con la accion</Parametros>
  <Responsabilidades>Redirecciona a la pantalla de adicionar pagina<Responsabilidades>
  <Notas></Notas>
  <Excepciones></Excepciones>
  <Salida></Salida>
  <Pre-condiciones><Pre-condiciones>
  <Post-condiciones><Post-condiciones>
  </Clase> */

function digitalizar_formato($idformato, $iddoc)
{
    global $conn;
    echo '<div class="form-group" id="tr_digitalizacion">
            <label class = "etiqueta_campo" title = "">DESEA DIGITALIZAR?</label>
            <div class = "row">
                <div class = "col-3 px-1">
                    <div class = "radio radio-success">
                        <input  class = "form-check-input" name="digitalizacion" type="radio" id="digitaliza_si" value="1" checked>
                        <label class = "etiqueta_selector" for = "digitaliza_si">Si</label>
                        <input class = "form-check-input" id="digitaliza_no" name="digitalizacion" type="radio" value="0" >
                        <label class = "etiqueta_selector" for = "digitaliza_no">No</label>
                    </div>
                </div>
            </div>
        </div>';
}

/* * ** */

function diferenciaEntreFechas2($fecha_principal, $fecha_secundaria, $obtener = 'SEGUNDOS', $redondear = false)
{
    $f0 = strtotime($fecha_principal);
    $f1 = strtotime($fecha_secundaria);
    //if ($f0 < $f1) { $tmp = $f1; $f1 = $f0; $f0 = $tmp; }
    $resultado = ($f0 - $f1);
    switch ($obtener) {
        default:
            break;
        case "MINUTOS":
            $resultado = $resultado / 60;
            break;
        case "HORAS":
            $resultado = $resultado / 60 / 60;
            break;
        case "DIAS":
            $resultado = $resultado / 60 / 60 / 24;
            break;
        case "SEMANAS":
            $resultado = $resultado / 60 / 60 / 24 / 7;
            break;
    }
    if ($redondear)
        $resultado = round($resultado);
    return $resultado;
}
