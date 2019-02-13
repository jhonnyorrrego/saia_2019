<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

require_once $ruta_db_superior . "controllers/autoload.php";

/** AQUI EMPIEZA LAS FUNCIONES DE LAS CONDICIONES */

function conditions_caja()
{
    return "1=1";
}

/** AQUI TERMINA LAS FUNCIONES DE LAS CONDICIONES */


/** AQUI EMPIEZA LAS FUNCIONES DEL INFO */

function info_caja($idcaja)
{
    $html = '';
    $Caja = new Caja($idcaja);
    $idcomp = $_REQUEST["idbusqueda_componente"];

    $data = [
        "idbusqueda_componente" => 371,
        "idcaja" => $idcaja
    ];
    $params = http_build_query($data);
    if($Caja->isResponsable()){
        $btn .= '<div class="btn btn-mini vinCaja" data-id="' . $idcaja . '" data-componente="' . $idcomp . '" title="Vincular"><i class="icon-wrench"></i></div>';
        $btn .= '<div class="btn btn-mini editCaja" data-id="' . $idcaja . '" data-componente="' . $idcomp . '" title="Editar"><i class="icon-pencil"></i></div>';
        $btn .= '<div class="btn btn-mini delCaja" data-id="' . $idcaja . '" data-componente="' . $idcomp . '" title="Eliminar"><i class="icon-remove"></i></div>';
    }
    $btn .= '<div class="btn btn-mini infoCaja" data-id="' . $idcaja . '" data-componente="' . $idcomp . '" title="' . $Caja->codigo . '"><i class="icon-info-sign"></i></div>';

    $link = 'class ="link kenlace_saia" conector = "iframe" enlace = "pantallas/busquedas/consulta_busqueda_expediente.php?' . $params . '" titulo = "' . $Caja->codigo . '"';
    $html .= <<<FINHTML
    <table style="font-size:12px;width:100%;">
        <tr {$link}>
            <td>
                <i class='icon-book'></i>&nbsp;<strong>{$Caja->codigo}</strong>
            </td>
        </tr>
        <tr>
            <td align="right">
                {$btn}
            </td>
        </tr>
        <tr>
            <td>
                <strong>Tipo:</strong> {$Caja->getEstadoArchivo()}
            </td>
        </tr>
        <tr>
            <td>
                <strong>Fondo:</strong> {$Caja->fondo}
            </td>
        </tr>
        <tr>
            <td>
                <strong>Sección:</strong> {$Caja->seccion}
            </td>
        </tr>
    </table>        
FINHTML;

    return $html;
}

/** AQUI TERMINA LAS FUNCIONES DEL INFO */