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
include_once  ($ruta_db_superior."core/autoload.php");
include_once($ruta_db_superior . "distribucion/funciones_distribucion.php");

function cambiar_mensajero_distribucion()
{
    global $conn;
    $retorno = array(
        'exito' => 0,
        'msn' => "Error al actualizar el mensajero"
    );

    $iddistribucion = @$_REQUEST['iddistribucion'];

    if ($iddistribucion) {

        $vector_mensajero_nuevo = explode('-', @$_REQUEST['mensajero']);
        $distribucion = busca_filtro_tabla("tipo_origen,estado_recogida,tipo_destino", "distribucion", "iddistribucion in(" . $iddistribucion . ")", "", $conn);

        //$retorno = validar_oriden_destino_distribucion($iddistribucion); Valida que todos los items sean internos o externos
        $retorno['exito']=1;
        if ($retorno['exito'] == 1) {
            for ($i = 0; $i < $distribucion['numcampos']; $i++) {
                $diligencia = mostrar_diligencia_distribucion($distribucion[$i]['tipo_origen'], $distribucion[$i]['estado_recogida']);

                switch ($diligencia) {
                    case 'RECOGIDA' :
                        if($vector_mensajero_nuevo[1] == 'e'){
                            $retorno = array('exito' => 0, 'msn' => "No es posible asignar un mensajero externo o transportadora para la recogida");
                        }else {
                            $upm = " UPDATE  distribucion SET mensajero_origen=" . $vector_mensajero_nuevo[0] . " WHERE iddistribucion in(" . $iddistribucion . ")";
                            $retorno = array('exito' => 1, 'sql' . $i => $upm);
                            phpmkr_query($upm) or die(json_encode($retorno));
                        }
                        break;
                    case 'ENTREGA' :
                        $update_adicional = ',mensajero_empresad=0';
                        if ($distribucion[0]['tipo_destino'] == 2 && $vector_mensajero_nuevo[1] == 'e') {
                            $retorno["msn"] = "No es posible asignar un mensajero externo";
                            $retorno["exito"] = 0;
                        } elseif ($distribucion[0]['tipo_destino'] == 1 && $vector_mensajero_nuevo[1] == 'e') { //si es una empresa_transportadora es decir mensajero_empresad
                            $update_adicional = ',mensajero_empresad=1';
                            $upm = " UPDATE  distribucion SET mensajero_destino=" . $vector_mensajero_nuevo[0] . $update_adicional . ",mensajero_empresad=1 WHERE iddistribucion in(" . $iddistribucion . ")";
                            $retorno = array('exito' => 1, 'sql' . $i => $upm);
                            phpmkr_query($upm) or die(json_encode($retorno));
                        } elseif ($distribucion[0]['tipo_destino'] == 2 && $vector_mensajero_nuevo[1] == 'i'){
                            $upm = "UPDATE  distribucion SET mensajero_destino=" . $vector_mensajero_nuevo[0] . ",mensajero_empresad=0 WHERE iddistribucion in(" . $iddistribucion . ")";
                            $retorno = array('exito' => 1, 'sql' . $i => $upm);
                            phpmkr_query($upm) or die(json_encode($retorno));
                        }
                        break;
                }
            }
        }
    } else {
        $retorno["msn"] = "No se encontro el identificador de la distribucion";
    }
    return ($retorno);
}

function validar_oriden_destino_distribucion($distribucion)
{
    global $conn;
    $cantidad = count(explode(",", $distribucion));
    $retorno = array(
        'exito' => 0,
        'msn' => "",
        'tipo_origen' => 0,
        'tipo_destino' => 0,
    );
    $tipo_origen_externo = busca_filtro_tabla("count(tipo_origen) as cantidad", "distribucion", "tipo_origen =1 and iddistribucion in(" . $distribucion . ")", "", $conn);
    $tipo_origen_interno = busca_filtro_tabla("count(tipo_origen) as cantidad", "distribucion", "tipo_origen =2 and iddistribucion in(" . $distribucion . ")", "", $conn);

    if ($tipo_origen_externo[0]['cantidad'] == $cantidad || $tipo_origen_interno[0]['cantidad'] == $cantidad) {
        if ($tipo_origen_externo[0]['cantidad'] == $cantidad) {
            $retorno['tipo_origen'] = 1;
        } else {
            $retorno['tipo_origen'] = 1;
        }
        $tipo_destino_externo = busca_filtro_tabla("count(tipo_destino) as cantidad", "distribucion", "tipo_origen =1 and iddistribucion in(" . $distribucion . ")", "", $conn);
        $tipo_destino_interno = busca_filtro_tabla("count(tipo_destino) as cantidad", "distribucion", "tipo_origen =2 and iddistribucion in(" . $distribucion . ")", "", $conn);

        if ($tipo_destino_externo[0]['cantidad'] == $cantidad || $tipo_destino_interno[0]['cantidad'] == $cantidad) {
            if ($tipo_destino_externo[0]['cantidad'] == $cantidad) {
                $retorno['tipo_destino'] = 1;
            } else {
                $retorno['tipo_destino'] = 1;
            }
            $retorno['exito'] = 1;
        } else {
            $retorno["msn"] = "Todas las distribuciones deben ser de destino externo o interno.";
        }
    } else {
        $retorno["msn"] = "Todas las distribuciones deben ser de origen externo o interno.";
    }
    return $retorno;
}

function finalizar_distribucion()
{
    global $conn;
    $retorno = array('exito' => 0);
    if (@$_REQUEST['iddistribucion']) {

        $vector_iddistribucion = explode(',', $_REQUEST['iddistribucion']);

        for ($i = 0; $i < count($vector_iddistribucion); $i++) {
            $iddistribucion = $vector_iddistribucion[$i];

            $distribucion = busca_filtro_tabla("tipo_origen,estado_recogida", "distribucion", "iddistribucion=" . $iddistribucion, "", $conn);
            $diligencia = mostrar_diligencia_distribucion($distribucion[0]['tipo_origen'], $distribucion[0]['estado_recogida']);
            $upd = '';
            switch ($diligencia) {
                case 'RECOGIDA' :
                    $estado_distribucion = 1;
                    if (@$_REQUEST['finaliza_manual']) {
                        $estado_distribucion = 0;
                    }
                    $upd = " UPDATE distribucion SET estado_recogida=1,estado_distribucion=" . $estado_distribucion . " WHERE iddistribucion=" . $iddistribucion;
                    break;
                case 'ENTREGA' :
                    $upd = " UPDATE distribucion SET estado_distribucion=3 WHERE iddistribucion=" . $iddistribucion;
                    break;
            }//fin switch

            if ($upd != '') {
                phpmkr_query($upd);
            }
        }//fin for $vector_iddistribucion
        $retorno['exito'] = 1;
    }//fin if $_REQUEST['iddistribucion']
    return ($retorno);
}

//fin function finalizar_distribucion()

function confirmar_recepcion_distribucion()
{
    global $conn;
    $retorno = array('exito' => 0);
    if (@$_REQUEST['iddistribucion']) {
        $vector_iddistribucion = explode(',', $_REQUEST['iddistribucion']);
        for ($i = 0; $i < count($vector_iddistribucion); $i++) {
            $iddistribucion = $vector_iddistribucion[$i];
            $upd = " UPDATE distribucion SET estado_recogida=1,estado_distribucion=1 WHERE iddistribucion=" . $iddistribucion;
            phpmkr_query($upd);
        }
        $retorno['exito'] = 1;
    }
    return ($retorno);
}

//fin function confirmar_recepcion_distribucion()
function confirmar_recepcion_item_planilla()
{
global $conn;
    $retorno = array('exito' => 0);
    if (@$_REQUEST['ft_item_despacho_ingres']) {
        $vector_planilla = explode(',', $_REQUEST['ft_item_despacho_ingres']);
        for ($i = 0; $i < count($vector_planilla); $i++) {
            $ft_item_despacho_ingres = $vector_planilla[$i];
            $upd = " UPDATE dt_recep_despacho SET recepcion=1,idfuncionario=".SessionController::getValue('idfuncionario')." WHERE ft_item_despacho_ingres=" . $ft_item_despacho_ingres;

            phpmkr_query($upd);
            /*$iddistribucion=busca_filtro_tabla("iddistribucion","dt_recep_despacho","ft_item_despacho_ingres=". $ft_item_despacho_ingres,"",$conn);
            $actualiza_por_disitrbuir="UPDATE disitrbucion SET estado_disitrbucion=1 WHERE iddistribucion=".$iddistribucion['iddistribucion'];
            phpmkr_query($actualiza_por_disitrbuir);*/
        }
        $retorno['exito'] = 1;
    }
    return ($retorno);
}
function finalizar_entrega_personal()
{
    global $conn;
    $retorno = array('exito' => 0);
    if (@$_REQUEST['iddistribucion']) {
        $vector_iddistribucion = explode(',', $_REQUEST['iddistribucion']);
        $finaliza_rol = busca_filtro_tabla("iddependencia_cargo", "vfuncionario_dc", "estado_dc=1 AND idfuncionario=" . usuario_actual('idfuncionario'), "", $conn);
        $finaliza_fecha = fecha_db_almacenar(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');

        for ($i = 0; $i < count($vector_iddistribucion); $i++) {
            $iddistribucion = $vector_iddistribucion[$i];
            $upd = " UPDATE distribucion SET estado_distribucion=3,finaliza_rol=" . $finaliza_rol[0]['iddependencia_cargo'] . ",finaliza_fecha=" . $finaliza_fecha . " WHERE iddistribucion=" . $iddistribucion;
            phpmkr_query($upd);
        }
        $retorno['exito'] = 1;
    }
    return ($retorno);
}

if (@$_REQUEST['ejecutar_accion']) {
    $retorno = $_REQUEST['ejecutar_accion']();
    echo(json_encode($retorno));
}
?>
