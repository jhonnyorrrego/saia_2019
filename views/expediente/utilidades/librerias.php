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

function conditions()
{
    $where='';
    $idexp = $_REQUEST['idexpediente'];
    if (empty($idexp)) {
        $where .= " AND v.cod_padre=0";
    } else {
        $where .= " AND v.cod_padre={$idexp}";
    }

    $where .= " AND (v.agrupador =1 OR fk_funcionario={$_SESSION['idfuncionario']})";

    return $where;
}

function conditions_exp_documents()
{
    $idexp = $_REQUEST['idexpediente'];
    $where = '';
    if (empty($idexp)) {
        $where = 0;
    } else {
        $where = $idexp;
    }
    return $where;
}

/** AQUI TERMINA LAS FUNCIONES DE LAS CONDICIONES */


/** AQUI EMPIEZA LAS FUNCIONES DEL INFO */

function info_expediente($idexpediente)
{
    $html = '';
    $ExpedienteInfo = new Expediente($idexpediente);
    $idcomp = $_REQUEST["idbusqueda_componente"];

    $data = [
        "idbusqueda_componente" => $idcomp,
        "idexpediente" => $idexpediente
    ];
    $params = http_build_query($data);

    $btn='';
    if(!$ExpedienteInfo->nucleo){
        if ($ExpedienteInfo->isResponsable()) {
            if (!$ExpedienteInfo->agrupador) {
                $btn .= '<button class="btn btn-info mx-1 tomoExp" data-id="' . $idexpediente . '" data-componente="' . $idcomp . '" title="Crear Tomo"><i class="fa fa-copy"></i></button>';
            }
            $btn .= '<button class="btn btn-info mx-1 delExp" data-id="' . $idexpediente . '" data-componente="' . $idcomp . '" title="Mover a la papelera"><i class="fa fa-recycle"></i></button>';
        }
    }
    $btn .= '<button class="btn btn-info mx-1 directExp" data-id="' . $idexpediente . '" data-componente="' . $idcomp . '" title="Acceso Directo"><i class="fa fa-star-o"></i></button>';

    $link='class="col-3"';
    $checkbox='';
    $nombre=$ExpedienteInfo->nombre;
    if ($ExpedienteInfo->nucleo) {
        $creador='GENERADO POR EL SISTEMA';
        $link = "class ='col-3 cursor kenlace_saia' enlace='views/expediente/index.php?{$params}' conector='iframe' titulo='{$ExpedienteInfo->nombre}'";
    }else{
        $data = [
            "idbusqueda_componente" => $idcomp,
            "idexpediente" => $idexpediente
        ];

        if($ExpedienteInfo->getAccessUser('c')){
            $record = BusquedaComponente::findColumn(
                'idbusqueda_componente',
                [
                    'nombre' => 'expediente_documento'
                ]
            );
            if($record){
                $data['idsComponente']= [$record[0]];
            }
        }
        $params = http_build_query($data);

        $creador=$ExpedienteInfo->getPropietario();
        if ($ExpedienteInfo->getAccessUser('c') || $ExpedienteInfo->getAccessUser('v')) {
            $link = 'class ="col-3 cursor kenlace_saia" conector = "iframe" enlace = "views/expediente/index.php?' . $params . '" titulo = "' . $ExpedienteInfo->nombre . '"';
        }
        if (!$ExpedienteInfo->agrupador) {
            $nombre.= "<i style='font-size:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;
            <strong>Tomo:</strong> {$ExpedienteInfo->tomo_no} de {$ExpedienteInfo->countTomos()}</i>";
        }
        $checkbox='';
        /*$checkbox= '<input type="hidden" class="identificator" value="'.$idexpediente. '" />
        <div class="float-left" id="checkbox_location"></div>';*/
    }

    $html .= <<<FINHTML
    <div class ="row mx-0 my-0">
        <div class="col-1">
            {$checkbox}
            <i class='float-right {$ExpedienteInfo->getIcon()}'></i>
        </div>

        <div {$link}>
            {$nombre}
        </div>

        <div class="col-3">
            {$creador}
        </div>

        <div class="col-2">
            {$ExpedienteInfo->fecha}
        </div>

        <div class="float-right col-3">
            <button class="btn btn-info mx-1 infoExp" data-id="{$idexpediente}" data-componente="{$idcomp}" title="Información del expediente"><i class="fa fa-info-circle"></i></button>{$btn}
        </div>
    </div> 
FINHTML;
    return $html;
}

function info_expediente_doc($iddocExp){
    $ExpedienteDoc=new ExpedienteDoc($iddocExp);
    $Documento=$ExpedienteDoc->getRelationFk('Documento');
    
    if($ExpedienteDoc->tipo==1){
        $btn = '<button class="btn mx-1 btn-info" title="Vincular con otro expediente"><i class="fa fa-link"></i></button>
        <button class="btn mx-1 btn-info" title="Mover"><i class="fa fa-share-square-o"></i></button>
        <button class="btn mx-1 btn-info" title="Quitar documento de este expediente"><i class="fa fa-sign-out"></i></button>';
    }else{
        $btn.= '<button class="btn mx-1 btn-info delDoc" data-id="'.$iddocExp.'" title="Eliminar"><i class="fa fa-trash"></i></button>';
    }

    $html = <<<FINHTML
    <div class ="row mx-0 my-0">
        <div class="col-1">
            <i class='float-right fa fa-file'></i>
        </div>

        <div class="col-3">
            {$Documento->numero}
        </div>

        <div class="col-3">
            {$Documento-> getCreador()}
        </div>

        <div class="col-2">
            {$Documento->fecha}
        </div>

        <div class="float-right col-3">
            <button class="btn mx-1 btn-info cursor kenlace_saia" title="Información del documento" conector = "iframe" enlace = "views/documento/index_acordeon.php?documentId={$Documento->getPK()}" titulo="Rad. {$Documento->numero}"><i class="fa fa-info-circle"></i></button>{$btn}
        </div>
    </div> 
FINHTML;
    return $html;
}


function info_restaurar($id, $idtabla, $tipo)
{
    if (strtolower($tipo) == 'expediente') {
        $Expediente = new Expediente($idtabla);

        $html = <<<FINHTML
        <div class ="row mx-0 my-0">
            <div class="col-1">
                <i class='{$Expediente->getIcon()}'></i>
            </div>

            <div class="col-3">
                {$Expediente->nombre}
            </div>

            <div class="col-3">
                {$Expediente->getPropietario()}
            </div>

            <div class="col-2">
                {$Expediente->fecha}
            </div>

            <div class="float-right col-3">
                <button class="btn btn-info restore" data-id="{$idtabla}" data-key="{$id}" data-tabla="expediente" title="Restaurar el expediente"><i class="fa fa-history"></i></button>
                <button class="btn btn-info delDef" data-id="{$idtabla}" data-key="{$id}" data-tabla="expediente" title="Eliminar definitivamente"><i class="fa fa-trash"></i></button>
            </div>
        </div> 
FINHTML;

    } else {
        $Caja = new Caja($idtabla);

        $html = <<<FINHTML
        <div class ="row mx-0 my-0">
            <div class="col-1">
                <i class='{$Caja->getIcon()}'></i>
            </div>

            <div class="col-3">
                {$Caja->codigo}
            </div>

            <div class="col-3">
                {$Caja->getPropietario()}
            </div>

            <div class="col-2">
                {$Caja->fecha_creacion}
            </div>

            <div class="float-right col-3">
                <button class="btn btn-info restore" data-id="{$idtabla}" data-key="{$id}" data-tabla="caja" title="Restaurar la caja"><i class="fa fa-history"></i></button>
                <button class="btn btn-info delDef" data-id="{$idtabla}" data-key="{$id}" data-tabla="caja" title="Eliminar definitivamente"><i class="fa fa-trash"></i></button>
            </div>
        </div> 
FINHTML;
    }
    return $html;
}

function info_expediente_directo($idexpediente)
{
    $ExpedienteInfo = new Expediente($idexpediente);
    $idcomp = $_REQUEST["idbusqueda_componente"];

    $comp = [
        1 => 'expediente_gestion',
        2 => 'expediente_central',
        3 => 'expediente_historico'
    ];
    $record = BusquedaComponente::findColumn(
        'idbusqueda_componente', [
            'nombre' => $comp[$ExpedienteInfo->estado_archivo]
        ]
    );
    if($record){
        $data = [
            "idbusqueda_componente" => $record[0],
            "idexpediente" => $idexpediente
        ];
        $params = http_build_query($data);

        $link='class="col-3"';
        $nombre=$ExpedienteInfo->nombre;
        if ($ExpedienteInfo->nucleo) {
            $creador='GENERADO POR EL SISTEMA';
            $link = "class ='col-3 cursor kenlace_saia' enlace='views/expediente/index.php?{$params}' conector='iframe' titulo='{$ExpedienteInfo->nombre}'";
        }else{
            $creador=$ExpedienteInfo->getPropietario();
            if ($ExpedienteInfo->getAccessUser('c') || $ExpedienteInfo->getAccessUser('v')) {
                $link = 'class ="col-3 cursor kenlace_saia" conector = "iframe" enlace = "views/expediente/index.php?' . $params . '" titulo = "' . $ExpedienteInfo->nombre . '"';
            }
            if (!$ExpedienteInfo->agrupador) {
                $nombre.= "<i style='font-size:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tomo:</strong> {$ExpedienteInfo->tomo_no} de {$ExpedienteInfo->countTomos()}</i>";
            }
        }
        
        $html = <<<FINHTML
        <div class ="row mx-0 my-0">
            <div class="col-1">
                <i class='{$ExpedienteInfo->getIcon()}'></i>
            </div>

            <div {$link}>
                {$nombre}
            </div>

            <div class="col-3">
                {$creador}
            </div>

            <div class="col-2">
                {$ExpedienteInfo->fecha}
            </div>

            <div class="float-right col-3">
                <button class="btn btn-info mx-1 delDirectoExp" data-id="{$idexpediente}" data-componente="{$idcomp}" title="Eliminar acceso directo"><i class="fa fa-trash"></i></button>
                <button class="btn btn-info infoExp" data-id="{$idexpediente}" title="Información del expediente"><i class="fa fa-info-circle"></i></button>
            </div>
        </div> 
FINHTML;
    }else{
        $html="NO se encuentra el componente";
    }
    return $html;
}

/** TERMINA LAS FUNCIONES DEL INFO */