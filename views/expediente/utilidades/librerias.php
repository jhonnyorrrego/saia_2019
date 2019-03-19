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

    $html .= <<<FINHTML
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
            {$btn}<button class="btn btn-info infoExp" data-id="{$idexpediente}" data-componente="{$idcomp}" title="Información del expediente"><i class="fa fa-info-circle"></i></button>
        </div>
    </div> 
FINHTML;
    return $html;
}

function info_restaurar($id, $idtabla, $tipo)
{

    if (strtolower($tipo) == 'expediente') {
        $Expediente = new Expediente($idtabla);

        $html .= <<<FINHTML
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

        $html .= <<<FINHTML
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
    $record = BusquedaComponente::findColumn('idbusqueda_componente', ['nombre' => $comp[$ExpedienteInfo->estado_archivo]]);
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
                <button class="btn btn-info infoExp" data-id="{$idexpediente}" data-componente="{$idcomp}" title="Información del expediente"><i class="fa fa-info-circle"></i></button>
            </div>
        </div> 
FINHTML;
    }else{
        $html="NO se encuentra el componente";
    }
    return $html;
}

/** TERMINA LAS FUNCIONES DEL INFO */








/** EMPIEZA LAS FUNCIONES DE CONSULTA BUSQUEDA */
function adicionar_expediente()
{
    global $Expediente;

    $idcomp = $_REQUEST["idbusqueda_componente"];
    $idexpediente = $_REQUEST["idexpediente"];
    if (!$Expediente) {
        $Expediente = new Expediente($idexpediente);
        $GLOBALS['Expediente'] = $Expediente;
    }
    if ($Expediente->estado_cierre == 1) {
        if ($Expediente->getAccessUser('a')) {
            $html = <<<FINHTML
        <li>
            <a href="#" id="addExpediente" data-id="{$idexpediente}" data-componente="{$idcomp}">Adicionar Expediente/Separador</a>
        </li>
        <li>
            <a href="#" id="addDocumentExp" data-id="{$idexpediente}" data-componente="{$idcomp}">Adicionar Documento</a>
        </li>
FINHTML;
        }
    }

    echo $html;
}


function compartir_expediente()
{
    $idcomp = $_REQUEST["idbusqueda_componente"];
    $html = '<li><a href="#" id="shareExp" data-componente="' . $idcomp . '">Compartir Expediente</a></li>';
    echo $html;
}

function transferencia_documental()
{
    global $Expediente;
    $html='';
    $idexpediente = $_REQUEST["idexpediente"];
    if (!$Expediente) {
        $Expediente = new Expediente($idexpediente);
        $GLOBALS['Expediente'] = $Expediente;
    }
    if($Expediente->estado_archivo!=3){
        $html = '<li><a href="#" id="transDocument">Transferir a Archivo</a></li>';
    }
    echo $html;
}

function barra_superior_busqueda()
{
    global $Expediente;

    $idcomp = $_REQUEST["idbusqueda_componente"];
    $idexpediente = $_REQUEST["idexpediente"];
    if (!$Expediente) {
        $Expediente = new Expediente($idexpediente);
        $GLOBALS['Expediente'] = $Expediente;
    }

    $reporte_inventario = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente", "nombre='reporte_expediente_grid_exp'", "", $conn);
    if ($reporte_inventario['numcampos']) {
        $inventario = $reporte_inventario[0]['idbusqueda_componente'];
    }

    $reporte_indice = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente", "nombre='reporte_docs_expediente_grid_exp'", "", $conn);
    if ($reporte_indice['numcampos']) {
        $indice = $reporte_indice[0]['idbusqueda_componente'];
    }

    $tipo_reporte_exp = busca_filtro_tabla("nombre", "busqueda_componente", "idbusqueda_componente=" . $_REQUEST['idbusqueda_componente'], "", $conn);
    $tipo = '';
    switch ($tipo_reporte_exp[0]['nombre']) {
        case 'expediente':
            $tipo = '1';
            break;
        case 'documento_central':
            $tipo = '2';
            break;
        case 'documento_historico':
            $tipo = '3';
            break;
    }

    $registros_concatenados = "cod_arbol|" . @$_REQUEST["cod_arbol"] . "|-|tipo_expediente|" . $tipo;

    $html = '<li>
        <div class="btn-group">
            <button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">Listar &nbsp;
                <span class="caret"></span>&nbsp;
            </button>
            <ul class="dropdown-menu" id="acciones_expedientes">
                <li></li>
                <li>
                    <a class="kenlace_saia" conector="iframe" idbusqueda_componente="' . $inventario . '" titulo="Inventario Documental" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?variable_busqueda=' . $registros_concatenados . '&idbusqueda_componente=' . $inventario . '">Inventario Documental</a>
                </li>
                <li></li>
                <li>
                    <a class="kenlace_saia" conector="iframe"  idbusqueda_componente="' . $indice . '" titulo="indice de Expediente" enlace="pantallas/busquedas/consulta_busqueda_reporte.php?variable_busqueda=' . @$_REQUEST["idexpediente"] . '&idbusqueda_componente=' . $indice . '">Indice de Expediente</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="divider-vertical"></li>';

    return $html;
}
/** TERMINA LAS FUNCIONES DE CONSULTA BUSQUEDA */