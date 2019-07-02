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

require_once $ruta_db_superior . "core/autoload.php";

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
        'idbusqueda_componente' => $idcompCajaExp,
        'idcaja' => $idcaja
    ];
    $params = http_build_query($data);

    $btn='';
    if ($idcompCajaExp) {
        if ($Caja->isResponsable()) {
            $btn .= '<button class="btn btn-info mx-1 delCaja" data-id="' . $idcaja . '" title="Mover a la papelera"><i class="fa fa-recycle"></i></button>';
        }
    $html .= <<<FINHTML
    <div class ="row mx-0 my-0">
        <div class="col-1">
            <i class='{$Caja->getIcon()}'></i>
        </div>

        <div class ="col-3 cursor kenlace_saia" conector = "iframe" enlace = "views/caja/index.php?{$params}" titulo = "{$Caja->codigo}">
            {$Caja->codigo}
        </div>

        <div class="col-3">
            {$Caja->getPropietario()}
        </div>

        <div class="col-2">
            {$Caja->fecha_creacion}
        </div>

        <div class="float-right col-3">
            {$btn}<button class="btn btn-info mx-1 infoCaja" data-id="{$idcaja}" title="Información de la caja"><i class="fa fa-info-circle"></i></button>
        </div>
    </div> 
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
        $html .= <<<FINHTML
        <div class ="row mx-0 my-0">
            <div class="col-1">
                <i class='{$ExpedienteInfo->getIcon()}'></i>
            </div>

            <div class="col-3 cursor kenlace_saia" conector = "iframe" enlace = "views/expediente/index.php?{$params}" titulo = "{$ExpedienteInfo->nombre}">
                {$ExpedienteInfo->nombre}
            </div>

            <div class="col-3">
                {$ExpedienteInfo->getPropietario()}
            </div>

            <div class="col-2">
                {$ExpedienteInfo->fecha}
            </div>

            <div class="float-right col-3">
                <button class="btn btn-info infoExp" data-id="{$idexpediente}" title="Información del expediente"><i class="fa fa-info-circle"></i></button>
            </div>
        </div> 
FINHTML;
    }
    return $html;
}

/** AQUI TERMINA LAS FUNCIONES DEL INFO */