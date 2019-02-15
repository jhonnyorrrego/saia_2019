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

function conditions_caja_expediente()
{
    if (!empty($_REQUEST['idcaja'])) {
        $where = "e.agrupador=0 AND e.estado=1 AND e.fk_caja={$_REQUEST['idcaja']} AND EXISTS (SELECT null FROM expediente e2 WHERE e2.idexpediente=e.cod_padre and e2.fk_caja<>{$_REQUEST['idcaja']})";
    } else {
        $where = '1=0';
    }
    return $where;
}

/** AQUI TERMINA LAS FUNCIONES DE LAS CONDICIONES */


/** AQUI EMPIEZA LAS FUNCIONES DEL INFO */

function info_caja($idcaja)
{
    global $idcompCajaExp;
    $html = '';
    $Caja = new Caja($idcaja);
    $idcomp = $_REQUEST["idbusqueda_componente"];

    if (empty($idcompCajaExp)) {
        $record = BusquedaComponente::findColumn('idbusqueda_componente', ['nombre' => 'caja_expediente']);
        if ($record) {
            $GLOBALS['idcompCajaExp'] = $record[0];
        } else {
            $html = 'NO se encuentra el componente';
        }
    }
    $data = [
        "idbusqueda_componente" => $idcompCajaExp,
        "idcaja" => $idcaja
    ];
    $params = http_build_query($data);

    if ($idcompCajaExp) {
        if ($Caja->isResponsable()) {
            $btn .= '<div class="btn btn-mini vinCaja" data-id="' . $idcaja . '" data-componente="' . $idcomp . '" title="Vincular"><i class="icon-wrench"></i></div>';
            $btn .= '<div class="btn btn-mini editCaja" data-id="' . $idcaja . '" data-componente="' . $idcomp . '" title="Editar"><i class="icon-pencil"></i></div>';
            $btn .= '<div class="btn btn-mini delCaja" data-id="' . $idcaja . '" data-componente="' . $idcomp . '" title="Eliminar"><i class="icon-remove"></i></div>';
        }
        $btn .= '<div class="btn btn-mini infoCaja" data-id="' . $idcaja . '" data-componente="' . $idcomp . '" title="' . $Caja->codigo . '"><i class="icon-info-sign"></i></div>';

        $link = 'class ="link kenlace_saia" conector = "iframe" enlace = "pantallas/busquedas/consulta_busqueda_caja.php?' . $params . '" titulo = "' . $Caja->codigo . '"';
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
    }
    return $html;
}


function info_caja_expediente($idexpediente)
{
    global $idcompExp;
    $html = '';
    $ExpedienteInfo = new Expediente($idexpediente);
    $idcomp = $_REQUEST["idbusqueda_componente"];

    if (empty($idcompExp)) {
        $comp = [
            1 => 'expediente_gestion',
            2 => 'expediente_central',
            3 => 'expediente_historico'
        ];
        $record = BusquedaComponente::findColumn('idbusqueda_componente', ['nombre' => $comp[$ExpedienteInfo->estado_archivo]]);
        if ($record) {
            $GLOBALS['idcompExp'] = $record[0];
        } else {
            $html = 'NO se encuentra el componente';
        }
    }

    $data = [
        "idbusqueda_componente" => $idcompExp,
        "idexpediente" => $idexpediente
    ];
    $params = http_build_query($data);

    if ($idcompExp) {
        $icon = 'icon-folder-close';
        if ($ExpedienteInfo->estado_cierre == 1) {
            $icon = 'icon-folder-open';
        }

        $link = 'class ="link kenlace_saia" conector = "iframe" enlace = "pantallas/busquedas/consulta_busqueda_expediente.php?' . $params . '" titulo = "' . $ExpedienteInfo->nombre . '"';

        $html .= <<<FINHTML
        <table style="font-size:12px;width:100%;">
            <tr {$link}>
                <td>
                    <i class='{$icon}'></i>&nbsp;<strong>{$ExpedienteInfo->nombre}</strong>
                    <i style='font-size:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tomo:</strong> {$ExpedienteInfo->tomo_no} de {$ExpedienteInfo->countTomos()}</i>
                </td>
            </tr>

            <tr>
                <td align="right">
                    <div class="btn btn-mini infoExp" data-id="{$idexpediente}" data-componente="{$idcomp}" title="{$ExpedienteInfo->nombre}"><i class="icon-info-sign"></i></div>
                </td>
            </tr>
            <tr>
                <td>{$ExpedienteInfo->getRelationFk('Serie')->nombre}</td>
            </tr>
        </table>        
FINHTML;
    }
    return $html;
}

/** AQUI TERMINA LAS FUNCIONES DEL INFO */