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
    $where = '';
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


/** AQUI EMPIEZA LAS FUNCIONES DEL INFO EXPEDIENTE */
function icon_exp($idexpediente)
{
    $ExpInfo=new Expediente($idexpediente);
    $GLOBALS['ExpInfo']=$ExpInfo;

    return "<i class='{$ExpInfo->getIcon()}'></i>";
 }

function nombre_exp($idexpediente)
{
    global $ExpInfo;

    $data = [
        "idbusqueda_componente" => $_REQUEST["idbusqueda_componente"],
        "idexpediente" => $idexpediente,
        "showDocuments" => 0
    ];
    $params = http_build_query($data);

    $nombre = $ExpInfo->nombre;
    if ($ExpInfo->nucleo) {        
        $link = "class ='cursor kenlace_saia' enlace='views/expediente/index.php?{$params}' conector='iframe' titulo='{$ExpInfo->nombre}'";
    } else {
        if ($ExpInfo->getAccessUser('c')) {
            $data['showDocuments'] = 1;
        }
        $params = http_build_query($data);

        if ($ExpInfo->getAccessUser('c') || $ExpInfo->getAccessUser('v')) {
            $link = 'class ="cursor kenlace_saia" conector = "iframe" enlace = "views/expediente/index.php?' . $params . '" titulo = "' . $ExpInfo->nombre . '"';
        }
        if (!$ExpInfo->agrupador) {
            $nombre .= "<i style='font-size:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;
            <strong>Tomo:</strong> {$ExpInfo->tomo_no} de {$ExpInfo->countTomos()}</i>";
        }
    }
    return "<div {$link}>{$nombre}</div>";
}

function propietario_exp()
{ 
    global $ExpInfo;
    return $ExpInfo->getPropietario();
}

function fecha_creacion_exp()
{
    global $ExpInfo;
    return $ExpInfo->fecha;
}

function accion_exp($idexpediente)
{
    global $ExpInfo;
    $idcomp = $_REQUEST["idbusqueda_componente"];

    $btn='<button class="btn btn-info mx-1 infoExp" data-id="'. $idexpediente.'" data-componente="'.$idcomp.'" title="Información del expediente"><i class="fa fa-info-circle"></i></button>';
    if (!$ExpInfo->nucleo) {
        if ($ExpInfo->isResponsable()) {
            if (!$ExpInfo->agrupador) {
                $btn .= '<button class="btn btn-info mx-1 tomoExp" data-id="' . $idexpediente . '" data-componente="' . $idcomp . '" title="Crear Tomo"><i class="fa fa-copy"></i></button>';
            }
            $btn .= '<button class="btn btn-info mx-1 delExp" data-id="' . $idexpediente . '" data-componente="' . $idcomp . '" title="Mover a la papelera"><i class="fa fa-recycle"></i></button>';
        }
    }
    $btn .= '<button class="btn btn-info mx-1 directExp" data-id="' . $idexpediente . '" data-componente="' . $idcomp . '" title="Acceso Directo"><i class="fa fa-star-o"></i></button>';
    return $btn;
}
/** TERMINA LAS FUNCIONES DEL INFO EXPEDIENTE */

/** AQUI EMPIEZA LAS FUNCIONES DEL INFO RESTAURAR */
function icon_exp_caj($id, $idtabla, $tipo)
{
    if (strtolower($tipo) == 'expediente') {
        $Instance = new Expediente($idtabla);
    }else{
        $Instance = new Caja($idtabla);
    }
    $GLOBALS['Instance']= $Instance;

    return "<i class='{$Instance->getIcon()}'></i>";
}

function nombre_exp_caj($id, $idtabla, $tipo){
    global $Instance;
    if (strtolower($tipo) == 'expediente') {
        $name=$Instance->nombre;
    }else{
        $name=$Instance->codigo;
    }
    return $name;
}

function propietario_exp_caja(){
    global $Instance;
    return $Instance->getPropietario();
}

function fecha_creacion_exp_caj($id, $idtabla, $tipo)
{
    global $Instance;
    if (strtolower($tipo) == 'expediente') {
        $fecha=$Instance->fecha;
    }else{
        $fecha=$Instance->fecha_creacion;
    }
    return $fecha;
}

function accion_exp_caja($id, $idtabla, $tipo)
{
    $tipo=strtolower($tipo);

    $html= '<button class="btn btn-info restore" data-id="' . $idtabla . '" data-key="' . $id . '" data-tabla="' . $tipo . '" title="Restaurar"><i class="fa fa-history"></i></button>
    <button class="btn btn-info delDef" data-id="' . $idtabla . '" data-key="' . $id . '" data-tabla="' . $tipo . '" title="Eliminar definitivamente"><i class="fa fa-trash"></i></button>';

    return $html;
}

/** AQUI TERMINA LAS FUNCIONES DEL INFO RESTAURAR */

/** AQUI EMPIEZA LAS FUNCIONES DEL INFO ACCESO DIRECTOS */
function nombre_exp_dir($idexpediente)
{
    global $ExpInfo;
    
    $comp = [
        1 => 'expediente_gestion',
        2 => 'expediente_central',
        3 => 'expediente_historico'
    ];
    $record = BusquedaComponente::findColumn(
        'idbusqueda_componente',
        ['nombre' => $comp[$ExpInfo->estado_archivo]]
    );

    if ($record) {
        $data = [
            "idbusqueda_componente" => $record[0],
            "idexpediente" => $idexpediente
        ];
        $params = http_build_query($data);

        $link = '';
        $nombre = $ExpInfo->nombre;
        if ($ExpInfo->nucleo) {
            $link = "class ='cursor kenlace_saia' enlace='views/expediente/index.php?{$params}' conector='iframe' titulo='{$ExpInfo->nombre}'";
        } else {
            if ($ExpInfo->getAccessUser('c') || $ExpInfo->getAccessUser('v')) {
                $link = 'class ="cursor kenlace_saia" conector = "iframe" enlace = "views/expediente/index.php?' . $params . '" titulo = "' . $ExpInfo->nombre . '"';
            }
            if (!$ExpInfo->agrupador) {
                $nombre .= "<i style='font-size:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;
            <strong>Tomo:</strong> {$ExpInfo->tomo_no} de {$ExpInfo->countTomos()}</i>";
            }
        }
        $html="<div {$link}>{$nombre}</div>";
    } else {
        $html = "NO se encuentra el componente";
    }
    return $html;
}

function accion_exp_dir( $idexpediente)
{
    $html = '<button class="btn btn-info infoExp" data-id="'.  $idexpediente. '"  title="Información del expediente"><i class="fa fa-info-circle"></i></button>
    <button class="btn btn-info mx-1 delDirectoExp" data-id="'.  $idexpediente. ' " title="Eliminar acceso directo"><i class="fa fa-trash"></i></button>';
    return $html;
}
/** AQUI TERMINA LAS FUNCIONES DEL INFO ACCESO DIRECTOS */

function info_expediente_doc($iddocExp)
{
    $ExpedienteDoc = new ExpedienteDoc($iddocExp);
    $Documento = $ExpedienteDoc->getRelationFk('Documento');

    if ($ExpedienteDoc->tipo == 1) {
        $btn = '<button class="btn mx-1 btn-info" title="Vincular con otro expediente"><i class="fa fa-link"></i></button>
        <button class="btn mx-1 btn-info" title="Mover"><i class="fa fa-share-square-o"></i></button>
        <button class="btn mx-1 btn-info" title="Quitar documento de este expediente"><i class="fa fa-sign-out"></i></button>';
    } else {
        $btn .= '<button class="btn mx-1 btn-info delDoc" data-id="' . $iddocExp . '" title="Eliminar"><i class="fa fa-trash"></i></button>';
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
            {$Documento->getCreador()}
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



/** TERMINA LAS FUNCIONES DEL INFO */
 