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

include_once $ruta_db_superior . 'core/autoload.php';

///////////////////////////      Comprueba los checkbox activos en permisos   ///////////////////////////////////
function checkPermisos($idPerfil, $modulo)
{
    $resultado = "";
    $PermisoPerfil = PermisoPerfil::findAllByAttributes(['perfil_idperfil' => $idPerfil, 'modulo_idmodulo' => $modulo]);
    if ($PermisoPerfil) {
        $resultado = "checked";
    }
    return $resultado;
}

///////////////////////////////// Comprueba la serie del formato para el select /////////////////////////////////

function checkSerie($formatId, $serie)
{
    $Formato = new Formato($formatId);
    $serieFormato = $Formato->serie_idserie;
    $resultado = "";
    if ($serieFormato == $serie) {
        $resultado = "selected";
    }
    return $resultado;
}
