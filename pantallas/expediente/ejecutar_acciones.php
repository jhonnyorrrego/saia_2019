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

require_once $ruta_db_superior . "controllers/autoload.php";

$setNull= $_REQUEST['setNull'] ?? 0 ;
$data = UtilitiesController::cleanForm($_REQUEST,$setNull);

$accionExp = $data['methodExp'] ?? 0;
$response = [
    'data' => [],
    'exito' => 0,
    'message' => 'Faltan datos obligatorios'
];

if ($accionExp) {
    $instance = new ExpedienteController();
    $response = $instance->$accionExp($data);
}
echo json_encode($response);


/*


function vincular_expediente_documento()
{
    global $conn;
    $retorno = new stdClass;
    $retorno->exito = 0;
    $retorno->mensaje = "Error al vincular el expediente al documento";
    $exito = 1;
    if (!@$_REQUEST["expedientes"]) {
        $retorno->exito = 0;
        $retorno->mensaje = "Debe seleccionar al menos 1 expediente";
    } elseif (!@$_REQUEST["iddoc"]) {
        $retorno->exito = 0;
        $retorno->mensaje = "Debe seleccionar al menos 1 documento";
    } else {
        $lexpedientes = explode(",", $_REQUEST["expedientes"]);
        $cant_expedientes = count($lexpedientes);
        for ($i = 0; $i < $cant_expedientes; $i++) {
            $expediente = busca_filtro_tabla("", "expediente_doc", "expediente_idexpediente=" . $lexpedientes[$i] . " AND documento_iddocumento=" . $_REQUEST["iddoc"], "", $conn);
            if (!$expediente["numcampos"]) {
                $sql2 = "INSERT INTO expediente_doc(expediente_idexpediente,documento_iddocumento,fecha) VALUES(" . $lexpedientes[$i] . "," . $_REQUEST["iddoc"] . "," . fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s") . ")";
                phpmkr_query($sql2);
                if (!phpmkr_insert_id()) {
                    $exito = 0;
                }
            }
        }
        if ($exito) {
            $retorno->exito = 1;
            $retorno->mensaje = "Todos los expedientes han sido vinculados";
        } else {
            $retorno->exito = 1;
            $retorno->mensaje = "Algunos expedientes han sido vinculados";
        }
    }
    return ($retorno);
}

function asignar_permiso_expediente()
{
    global $conn;
    $retorno = new stdClass;
    $retorno->exito = 0;
    $retorno->mensaje = "Error al asignar el expediente";
    $_REQUEST["tipo_entidad"] = 1;

    if (@$_REQUEST["idexpediente"] && @$_REQUEST["tipo_entidad"] && $_REQUEST["idfuncionario"] && $_REQUEST["propietario"] != "") {
        $vector_expedientes = array_filter(explode(',', $_REQUEST["expediente"]));
        $vector_expedientes[] = $_REQUEST['idexpediente'];

        $sql1 = "DELETE FROM entidad_expediente WHERE expediente_idexpediente IN(" . implode(',', $vector_expedientes) . ") AND entidad_identidad=1 AND llave_entidad NOT IN(" . implode(",", $_REQUEST["idfuncionario"]) . ")";
        phpmkr_query($sql1) or die($sql1);

        foreach ($_REQUEST["idfuncionario"] as $idfunc) {
            $permiso = "";
            if (isset($_REQUEST["permisos_" . $idfunc])) {
                $permiso = implode(",", $_REQUEST["permisos_" . $idfunc]);
            }
            for ($j = 0; $j < count($vector_expedientes); $j++) {
                asignar_expediente($vector_expedientes[$j], $_REQUEST["tipo_entidad"], $idfunc, $permiso);
            }
        }
        $exito = 1;
        if ($exito) {
            $retorno->exito = 1;
            $retorno->mensaje = "Asignaciones al expediente realizadas con &eacute;xito";
        } else if ($exito == 0) {
            $retorno->exito = 0;
            $retorno->mensaje = "No se realizan asignaciones al expediente";
        } else {
            $retorno->exito = 0;
            $retorno->mensaje = "Se realizan algunas asignaciones al expediente se presentan errores";
        }
    } else if (!$_REQUEST["idfuncionario"] && @$_REQUEST["idexpediente"] && @$_REQUEST['propietario']) {

        $sql1 = "DELETE FROM entidad_expediente WHERE expediente_idexpediente IN(" . $_REQUEST["idexpediente"] . ") AND entidad_identidad=1 AND llave_entidad NOT IN(" . $_REQUEST["propietario"] . ")";
        phpmkr_query($sql1) or die($retorno);

        $retorno->exito = 1;
        $retorno->mensaje = "Des-Asignaciones al expediente realizadas con &eacute;xito";
    }
    return ($retorno);
}

function delete_documento_expediente()
{
    global $conn;
    $retorno = new stdClass;
    $retorno->exito = 0;
    $retorno->mensaje = "Error al eliminar";
    $exito = 0;

    $sql3 = "DELETE FROM expediente_doc WHERE documento_iddocumento=" . $_REQUEST["iddocumento"] . " AND expediente_idexpediente=" . $_REQUEST["idexpediente"];
    phpmkr_query($sql3);
    $idexpediente = $_REQUEST["idexpediente"];
    $retorno->sql = $sql3;
    if ($idexpediente) {
        $exito = 1;
    }
    if ($exito) {
        $retorno->idexpediente = $idexpediente;
        $retorno->exito = 1;
        $retorno->mensaje = "Documento eliminado de este expediente con exito";
    }
    return ($retorno);
}

function abrir_cerrar_expediente()
{
    global $conn;

    $retorno = new stdClass;
    $retorno->exito = 0;
    $retorno->mensaje = "Error al realizar la accion";

    $idexpediente = @$_REQUEST["idexpediente"];
    $accion = @$_REQUEST["accion"];
    $update_adicional = '';
    if (intval($accion) == 1) {//si abren expedidiente se retira de proxima transferencia documental
        $update_adicional = "prox_estado_archivo=0, ";
    }

    $sql1 = "update expediente set " . $update_adicional . "estado_cierre='" . $accion . "', fecha_cierre=" . fecha_db_almacenar(date('Y-m-d'), 'Y-m-d') . ", funcionario_cierre='" . usuario_actual('idfuncionario') . "' where idexpediente=" . $idexpediente;
    phpmkr_query($sql1);

    $sql2 = "INSERT INTO expediente_abce (expediente_idexpediente,estado_cierre,fecha_cierre,funcionario_cierre,observaciones) VALUES (" . $idexpediente . "," . $accion . "," . fecha_db_almacenar(date('Y-m-d'), 'Y-m-d') . "," . usuario_actual('idfuncionario') . ",'" . @$_REQUEST['observaciones'] . "')";
    phpmkr_query($sql2);

    $retorno->idexpediente = $idexpediente;
    $retorno->exito = 1;
    $retorno->mensaje = "Accion realizada";

    return ($retorno);
}

function obtener_rastro_documento_expediente()
{
    global $conn;

    $funcionario_radicador = busca_filtro_tabla("funcionario_codigo", "funcionario", "login='radicador_salida'", "", $conn);
    $estados_validar = array(
        "'borrador'",
        "'transferido'",
        "'revisado'",
        "'aprobado'"
    );
    $consulta = busca_filtro_tabla("destino", "buzon_salida", "archivo_idarchivo=" . @$_REQUEST['iddoc'] . " AND tipo_destino=1 AND lower(nombre) IN(" . implode(',', $estados_validar) . ") AND destino NOT IN(" . $funcionario_radicador[0]['funcionario_codigo'] . ")", "", $conn);

    $funs = busca_filtro_tabla("CONCAT(nombres,' ', apellidos)as nombre_funcionario", "funcionario", "funcionario_codigo IN(" . implode(',', extrae_campo($consulta, 'destino')) . ")", "", $conn);

    $vector_nombres = extrae_campo($funs, 'nombre_funcionario');
    $vector_nombres = array_map('strtolower', $vector_nombres);
    $vector_nombres = array_map('html_entity_decode', $vector_nombres);
    $vector_nombres = array_map('ucwords', $vector_nombres);
    $cadena_nombres = implode(', ', $vector_nombres);

    $retorno = new stdClass;
    $retorno->exito = 1;
    $retorno->msn = $cadena_nombres;
    return ($retorno);

}

function cambiar_responsable_expediente()
{
    global $conn;
    $retorno = new stdClass;
    $funcionario_codigo = $_REQUEST['funcionario_codigo'];
    $idexpediente = $_REQUEST['idexpediente'];
    if (@$_REQUEST['tomos_asociados'] != '') {
        $idexpediente .= ',' . $_REQUEST['tomos_asociados'];
    }
    $exp_res_actual = busca_filtro_tabla("propietario", "expediente", "idexpediente=" . $_REQUEST['idexpediente'], "", $conn);
    $idfuncionario_antiguo = busca_filtro_tabla("idfuncionario", "funcionario", "funcionario_codigo=" . $exp_res_actual[0]['propietario'], "", $conn);
    $idfuncionario_nuevo = busca_filtro_tabla("idfuncionario", "funcionario", "funcionario_codigo=" . $funcionario_codigo, "", $conn);

    $permisos_expedientes_antiguo = busca_filtro_tabla("identidad_expediente", "entidad_expediente", "estado=1 AND entidad_identidad=1 AND llave_entidad=" . $idfuncionario_antiguo[0]['idfuncionario'] . " AND expediente_idexpediente IN(" . $idexpediente . ")", "", $conn);
    $identidad_expediente = implode(",", extrae_campo($permisos_expedientes_antiguo, 'identidad_expediente'));

    $sql = "UPDATE expediente SET propietario='" . $funcionario_codigo . "' WHERE idexpediente IN(" . $idexpediente . ")";
    phpmkr_query($sql);

    $sql4 = "UPDATE entidad_expediente SET llave_entidad=" . $idfuncionario_nuevo[0]['idfuncionario'] . " WHERE identidad_expediente IN(" . $identidad_expediente . ")";
    phpmkr_query($sql4);

    $retorno->exito = 1;
    return ($retorno);
}*/