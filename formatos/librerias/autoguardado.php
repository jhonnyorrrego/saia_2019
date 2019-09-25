<?php
include_once("../../db.php");
$campos = explode(",", $_REQUEST["campos"]);
for ($i = 0; $i < count($campos); $i++) {
    $consulta = busca_filtro_tabla("", "autoguardado", "usuario='" . SessionController::getValue('usuario_actual') . "' and formato='" . $_REQUEST["formato"] . "' and campo='" . $campos[$i] . "'", "");

    if (!$consulta["numcampos"]) {
        $sql1 = "insert into autoguardado(usuario,formato,contenido,campo) values('" . SessionController::getValue('usuario_actual') . "','" . $_REQUEST["formato"] . "','" . $_REQUEST[$campos[$i]] . "','" . $campos[$i] . "')";
    } else {
        $sql1 = "update autoguardado set contenido='" . $_REQUEST[$campos[$i]] . "' where idautoguardado='" . $consulta[0]["idautoguardado"] . "'";
    }

    phpmkr_query($sql1);
}
