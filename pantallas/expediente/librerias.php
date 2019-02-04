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

function conditions_gestion()
{
    $idexp = $_REQUEST['idexpediente'];

    $where = 'v.estado_archivo=1';
    if (empty($idexp)) {
        $where .= ' and v.cod_padre=0';
    } else {
        $where .= " and v.cod_padre={$idexp}";
    }
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
    $idcomp= $_REQUEST["idbusqueda_componente"];

    $data = [
        "idbusqueda_componente" => $idcomp,
        "idexpediente" => $idexpediente
    ];
    $params = http_build_query($data);
    $icon = [
        0 => 'icon-folder-close',
        1 => 'icon-briefcase',
        2 => 'icon-qrcode',
        3 => 'icon-book',
    ];
    if ($ExpedienteInfo->estado_cierre == 1) {
        $icon[0] = 'icon-folder-open';
    }
            
    if ($ExpedienteInfo->nucleo) {
        $btn = '<div class="btn btn-mini infoExp" data-id="' . $idexpediente . '" data-componente="'. $idcomp .'" title="' . $ExpedienteInfo->nombre . '"><i class="icon-info-sign"></i></div>';

        $html .= <<<FINHTML
        <table style="font-size:12px;width:100%;">
            <tr class="link kenlace_saia" enlace="pantallas/busquedas/consulta_busqueda_expediente.php?{$params}" conector="iframe" titulo="{$ExpedienteInfo->nombre}">
                <td>
                    <i class='{$icon[$ExpedienteInfo->agrupador]}'></i>&nbsp;<strong>{$ExpedienteInfo->nombre}</strong>
                </td>
            </tr>
            <tr>
                <td align="right">
                    {$btn}
                </td>
            </tr>
        </table>        
FINHTML;

    } else {
        $btn .= '<div class="btn btn-mini selExp" data-id="' . $idexpediente . '" data-componente="' . $idcomp . '" title="Seleccionar"><i class="icon-uncheck"></i></div>';

        if(!$ExpedienteInfo->agrupador){
            $btn .= '<div class="btn btn-mini rotExp" data-id="' . $idexpediente . '" data-componente="' . $idcomp . '" title="Imprimir rotulo" conector="iframe" enlace="pantallas/caja/rotulo.php?idexpediente=' . $idexpediente . '"><i class="icon-print"></i></div>';
        }
        
        if($ExpedienteInfo->isResponsable()){
            if(!$ExpedienteInfo->agrupador){
                $btn .= '<div class="btn btn-mini tomoExp" data-id="' . $idexpediente . '" data-componente="' . $idcomp . '" title="Crear Tomo"><i class="icon-th-list"></i></div>';
            }
            $btn .= '<div class="btn btn-mini shareExp" data-id="' . $idexpediente . '" data-componente="' . $idcomp . '" title="Compartir" conector="iframe" enlace="pantallas/expediente/asignar_expediente.php?idexpediente=' . $idexpediente . '"><i class="icon-share"></i></div>';
            $btn .= '<div class="btn btn-mini editExp" data-id="' . $idexpediente . '" data-componente="'. $idcomp .'" title="Editar"><i class="icon-pencil"></i></div>';
            $btn .= '<div class="btn btn-mini delExp" data-id="' . $idexpediente . '" data-componente="'. $idcomp .'" title="Eliminar"><i class="icon-remove"></i></div>';

        }

        $btn .= '<div class="btn btn-mini infoExp" data-id="' . $idexpediente . '" data-componente="'. $idcomp .'" title="' . $ExpedienteInfo->nombre . '"><i class="icon-info-sign"></i></div>';

        if ($ExpedienteInfo->agrupador == 3) {
            $html .= <<<FINHTML
            <table style="font-size:12px;width:100%;">
                <tr class="link kenlace_saia" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_expediente.php?{$params}" titulo="{$ExpedienteInfo->nombre}">
                    <td>
                        <i class='{$icon[$ExpedienteInfo->agrupador]}'></i>&nbsp;<strong>{$ExpedienteInfo->nombre}</strong>
                    </td>
                </tr>

                <tr>
                    <td align="right">
                        {$btn}
                    </td>
                </tr>
            </table>        
FINHTML;
        } else {
            $cadenaTomo = "<i style='font-size:10px;'>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Tomo:</strong> {$ExpedienteInfo->tomo_no} de {$ExpedienteInfo->countTomos()}</i>";
            $html .= <<<FINHTML
            <table style="font-size:12px;width:100%;">
                <tr class="link kenlace_saia" conector="iframe" enlace="pantallas/busquedas/consulta_busqueda_expediente.php?{$params}" titulo="{$ExpedienteInfo->nombre}">
                    <td>
                        <i class='{$icon[$ExpedienteInfo->agrupador]}'></i>&nbsp;<strong>{$ExpedienteInfo->nombre}</strong>{$cadenaTomo}
                    </td>
                </tr>

                <tr>
                    <td align="right">
                        {$btn}
                    </td>
                </tr>
                <tr>
                    <td>{$ExpedienteInfo->getSerieFk()[0]->nombre}</td>
                </tr>
            </table>        
FINHTML;
        }
    }

    return $html;
}


/** AQUI TERMINA LAS FUNCIONES DEL INFO */


/** AQUI EMPIEZA LAS FUNCIONES DE CONSULTA BUSQUEDA */
function adicionar_expediente()
{
    global $Expediente;

    $idexpediente = $_REQUEST["idexpediente"];
    if (!$Expediente) {
        $Expediente = new Expediente($idexpediente);
        $GLOBALS['Expediente'] = $Expediente;
    }

    if ($Expediente->getAccessUser('a')) {
        $data = [
            'idbusqueda_componente' => $_REQUEST['idbusqueda_componente'],
            'idexpediente' => $idexpediente
        ];
        $params = http_build_query($data);
        $rutaFormato = FORMATOS_CLIENTE;

        $html = <<<FINHTML
        <li></li>
        <li>
            <a href="#" id="addExpediente" enlace="pantallas/expediente/adicionar_expediente.php?{$params}">Adicionar Expediente/Separador</a>
        </li>
        <li>
            <a href="#" id="addDocumentExp" enlace="{$rutaFormato}vincular_doc_expedie/adicionar_vincular_doc_expedie.php?idexpediente={$idexpediente}">Adicionar Documento</a>
        </li>
FINHTML;
    }
    echo $html;
}


function compartir_expediente()
{
    global $Expediente;

    $idexpediente = $_REQUEST["idexpediente"];
    if (!$Expediente) {
        $Expediente = new Expediente($idexpediente);
        $GLOBALS['Expediente'] = $Expediente;
    }
    if ($Expediente->getAccessUser('c')) {
        $html = <<<FINHTML
		<li></li>
		<li>
		    <a href="#" id="shareExp" enlace="pantallas/expediente/asignar_expediente.php">Compartir Expediente</a>
        </li>
FINHTML;
    }
    echo $html;
}

function transferencia_documental()
{
    $cadena = '<li><a href="#" id="transDocument">Transferir a Archivo</a></li>';
    echo $cadena;
}

function prestamo_documento()
{
    $cadena = '<li><a href="#" id="prestDocument">Solicitar pr&eacute;stamo</a></li>';
    echo $cadena;
}


function barra_superior_busqueda()
{
    //TODO: PENDIENTE POR REVISAR
    $permiso = new Permiso();
    $ok2 = $permiso->acceso_modulo_perfil('transferencia_doc');

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
/** AQUI TERMINA LAS FUNCIONES DE CONSULTA BUSQUEDA */