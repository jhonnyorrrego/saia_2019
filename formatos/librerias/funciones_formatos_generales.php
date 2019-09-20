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

    $radicador = busca_filtro_tabla("f.funcionario_codigo", "configuracion c,funcionario f", "c.nombre='radicador_salida' and f.login=c.valor", "");
    array_push($ruta, array(
        "funcionario" => $radicador[0]["funcionario_codigo"],
        "tipo_firma" => 0,
        "tipo" => 1
    ));
    phpmkr_query("UPDATE buzon_entrada SET activo=0, nombre=CONCAT('ELIMINA_',nombre) where archivo_idarchivo='" . $iddoc . "' and (nombre='POR_APROBAR' OR nombre='REVISADO' OR nombre='APROBADO' OR nombre='VERIFICACION')");
    phpmkr_query("UPDATE buzon_salida SET nombre=CONCAT('ELIMINA_',nombre) WHERE archivo_idarchivo='" . $iddoc . "' and nombre IN('POR_APROBAR','LEIDO','COPIA','BLOQUEADO','RECHAZADO','REVISADO','APROBADO','DEVOLUCION','TRANSFERIDO','TERMINADO')");

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
            $func_codigo1 = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "iddependencia_cargo=" . $ruta[$i]["funcionario"], "");
            $funcionario1 = $func_codigo1[0]['funcionario_codigo'];
        } else {
            $funcionario1 = $ruta[$i]["funcionario"];
        }

        $retorno1 = obtener_reemplazo($funcionario1, 1);
        if ($retorno1['exito']) {
            $funcionario1 = $retorno1['funcionario_codigo'][0];
            if ($ruta[$i]["tipo"] == 5) {
                $equiv = busca_filtro_tabla("llave_entidad_destino", "reemplazo_equivalencia", "fk_idreemplazo_saia=" . $retorno1['idreemplazo'][0] . " and entidad_identidad=5 and llave_entidad_origen=" . $ruta[$i]["funcionario"], "");
                if ($equiv["numcampos"]) {
                    $ruta[$i]["funcionario"] = $equiv[0]["llave_entidad_destino"];
                } else {
                    $ruta[$i]["tipo"] = 1;
                    $ruta[$i]["funcionario"] = $funcionario1;
                }
            }
        }

        if ($ruta[$i + 1]["tipo"] == 5) {
            $func_codigo2 = busca_filtro_tabla("funcionario_codigo", "vfuncionario_dc", "iddependencia_cargo=" . $ruta[$i + 1]["funcionario"], "");
            $funcionario2 = $func_codigo2[0]['funcionario_codigo'];
        } else {
            $funcionario2 = $ruta[$i + 1]["funcionario"];
        }

        $retorno2 = obtener_reemplazo($funcionario2, 1);
        if ($retorno2['exito']) {
            $funcionario2 = $retorno2['funcionario_codigo'][0];
            if ($ruta[$i + 1]["tipo"] == 5) {
                $equiv = busca_filtro_tabla("llave_entidad_destino", "reemplazo_equivalencia", "fk_idreemplazo_saia=" . $retorno2['idreemplazo'][0] . " and entidad_identidad=5 and llave_entidad_origen=" . $ruta[$i + 1]["funcionario"], "");
                if ($equiv["numcampos"]) {
                    $ruta[$i + 1]["funcionario"] = $equiv[0]["llave_entidad_destino"];
                } else {
                    $ruta[$i + 1]["tipo"] = 1;
                    $ruta[$i + 1]["funcionario"] = $funcionario2;
                }
            }
        }

        $idruta = Ruta::newRecord([
            'destino' => $ruta[$i + 1]["funcionario"],
            'origen' =>  $ruta[$i]["funcionario"],
            'documento_iddocumento' => $iddoc,
            'condicion_transferencia' => 'POR_APROBAR',
            'tipo_origen' =>  $ruta[$i]["tipo"],
            'tipo_destino' =>  $ruta[$i + 1]["tipo"],
            'orden' => $i,
            'obligatorio' => $ruta[$i]["tipo_firma"],
            'idenlace_nodo' =>  $ruta[$i]["paso_actividad"] ?? null,
            'fk_ruta_documento' => $fk_ruta_documento
        ]);

        BuzonEntrada::newRecord([
            'origen' =>  $funcionario2,
            'destino' => $funcionario1,
            'archivo_idarchivo' => $iddoc,
            'activo' => 1,
            'tipo_origen' => $ruta[$i + 1]["tipo"],
            'tipo_destino' =>  $ruta[$i]["tipo"],
            'ruta_idruta' => $idruta,
            'nombre' => 'POR_APROBAR',
            'fecha' => date("Y-m-d H:i:s"),
        ]);
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
