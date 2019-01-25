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

/** AQUI TERMINA LAS FUNCIONES DE LAS CONDICIONES */


/** AQUI EMPIEZA LAS FUNCIONES DEL INFO */

function enlace_expediente($idexpediente)
{
    $html = '';
    $Expediente = new Expediente($idexpediente);
    $GLOBALS['Expediente'] = $Expediente;

    $data = [
        "idbusqueda_componente" => $_REQUEST["idbusqueda_componente"],
        "idexpediente" => $idexpediente
    ];
    $params = http_build_query($data);

    if ($Expediente->agrupador == 1) {
        $icon = 'icon-briefcase';
    } else if ($Expediente->agrupador == 2) {
        $icon = 'icon-qrcode';
    }else if($Expediente->agrupador == 3){

    }else {
        if ($Expediente->estado_cierre == 1) {
            $icon = 'icon-folder-open';
        } else {
            $icon = 'icon-folder-close';
        }
    }

    if ($Expediente->nucleo) {
        $html .= <<<FINHTML
        <div class="link kenlace_saia" enlace="pantallas/busquedas/consulta_busqueda_expediente.php?{$params}" conector="iframe" titulo="{$Expediente->nombre}">
            <table>
                <tr>
                    <td style="font-size:12px;">
                        <i class='{$icon} pull-left'></i>&nbsp;<strong>{$Expediente->nombre}</strong>
                    </td>
                </tr>
            </table>
        </div>
FINHTML;
    } else {

    }

    return $html;

/*
    $expediente_actual = busca_filtro_tabla("tomo_padre,tomo_no,serie_idserie,propietario,agrupador,cod_arbol", "expediente", "idexpediente=" . $idexpediente, "", $conn);
    $cadena_tomos = "";
    $icono_expediente = "icon-folder-open";
    if (!$expediente_actual[0]['agrupador']) {
        $tomo_padre = $idexpediente;
        if ($expediente_actual[0]['tomo_padre']) {
            $tomo_padre = $expediente_actual[0]['tomo_padre'];
        }
        $ccantidad_tomos = busca_filtro_tabla("idexpediente", "expediente", "tomo_padre=" . $tomo_padre, "", $conn);
        $cantidad_tomos = $ccantidad_tomos['numcampos'] + 1;
        // tomos + el padre
        $cadena_tomos = ("&nbsp;&nbsp;&nbsp;<i><b style='font-size:10px;'>Tomo: </b></i><i style='font-size:10px;'>" . $expediente_actual[0]['tomo_no'] . " de " . $cantidad_tomos . "</i>");
    } else {
        $icono_expediente = "icon-bookmark";
    }


    $estilo_expediente = "";
    $permiso_modulo = new Permiso();
    $ok = $permiso_modulo->acceso_modulo_perfil('expediente_admin');
    $ok=1;
    if (!$ok) {
        $permiso = new PermisosExpediente($conn, $idexpediente);
        $permisos = $permiso->obtener_permisos();

        $l = in_array(PermisosExpediente::PERMISO_EXP_LEER, $permisos);
        $m = in_array(PermisosExpediente::PERMISO_EXP_MODIFICAR, $permisos);
        if (empty($permisos)) {
            $estilo_expediente = ' style="opacity: 0.40;"';
            if (!$expediente_actual[0]['agrupador']) {
                $icono_expediente = "icon-folder-close";
            }
        }
    } else {
        $l = 1;
        $m = 1;
    }

    $a_html = array();
    if ($l || $m) {
        $a_html[] = '<div class="link kenlace_saia" enlace="pantallas/busquedas/consulta_busqueda_expediente.php?' . $req_parms . '" conector="iframe" titulo="' . $Expediente->nombre . '">';
        $a_html[] = '<table><tr><td style="font-size:12px;">';
        $a_html[] = "<i class='$icon pull-left' $estilo_expediente></i>&nbsp;";
        $a_html[] = "<b>$nombre</b>&nbsp$cadena_tomos</td></tr></table></div>";
    } else {
        $a_html[] = "<div><table><tr><td style='font-size:12px;'>";
        $a_html[] = "<i class='$icon pull-left' $estilo_expediente></i>&nbsp;";
        $a_html[] = "<b>$nombre</b>&nbsp;" . $cadena_tomos;
        $a_html[] = "</td></tr></table></div>";
    }

    return implode("", $a_html);*/
}

function mostrar_informacion_adicional_expediente($idexpediente)
{
    global $conn;
    $cadena = '';
    // EXPEDIENTE
    $expediente_actual = busca_filtro_tabla("serie_idserie,agrupador", "expediente", "idexpediente=" . $idexpediente, "", $conn);
    // NOMBRE DE LA SERIE
    $serie = busca_filtro_tabla("nombre", "serie", "idserie=" . $expediente_actual[0]['serie_idserie'], "", $conn);

    if ($serie['numcampos'] && !$expediente_actual[0]["agrupador"]) {
        $cadena .= $serie[0]['nombre'];
    }
    $cadena .= '<br>';
    return ($cadena);
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
            'idexpediente' => $idexpediente,
            'div_actualiza' => 'resultado_busqueda' . $_REQUEST["idbusqueda_componente"],
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
    if ($Expediente->getAccessUser('a')) {
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