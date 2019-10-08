<?php

$max_salida = 6;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "pantallas/documento/librerias_flujo.php";
include_once $ruta_db_superior . "pantallas/lib/librerias_fechas.php";
include_once $ruta_db_superior . "workflow/libreria_paso.php";

function origen_documento($doc, $numero, $origen = "", $tipo_radicado = "", $estado = "", $serie = "", $tipo_ejecutor = "")
{


    $ruta = "";
    $numero = intval($numero);
    $pre_texto = '';
    if (in_array($estado, array("APROBADO", "GESTION", "CENTRAL", "HISTORICO", "ACTIVO")) !== false) {
        $docu = busca_filtro_tabla("lower(plantilla) as plantilla, nombre_tabla,cod_padre,idformato", "documento A, formato B", "A.iddocumento=" . $doc . " AND lower(plantilla)=lower(B.nombre)", "");
        if ($docu[0]["plantilla"] == 'radicacion_entrada' || $docu[0]["plantilla"] == 'radicacion_salida') {
            $remitente = busca_filtro_tabla("", $docu[0]["nombre_tabla"] . " A, datos_ejecutor B, ejecutor C", "persona_natural=B.iddatos_ejecutor AND ejecutor_idejecutor=idejecutor AND A.documento_iddocumento=" . $doc, "");
            $texto = ucwords(strtolower($remitente[0]["nombre"]));
        } else {
            $remitente = busca_filtro_tabla("B.nombres, B.apellidos", "documento A,funcionario B", "A.ejecutor=B.funcionario_codigo AND A.iddocumento=" . $doc, "");
            $texto = $remitente[0]["nombres"] . " " . $remitente[0]["apellidos"];
        }
        if ($remitente["numcampos"]) {
            $ruta = $texto . "-" . serie_documento($serie);
        }
    } else {
        $remitente = busca_filtro_tabla("B.nombres, B.apellidos", "documento A,funcionario B", "A.ejecutor=B.funcionario_codigo AND A.iddocumento=" . $doc, "");
        $texto = $remitente[0]["nombres"] . " " . $remitente[0]["apellidos"];
        if ($remitente["numcampos"]) {
            $ruta = $remitente[0]["nombres"] . " " . $remitente[0]["apellidos"] . "-" . serie_documento($serie);
        }
    }

    if (!$ruta) {
        if ($tipo_ejecutor == 1 && $tipo_radicado == 1) {
            $datos_ejecutor = busca_filtro_tabla("A.plantilla,B.ejecutor_idejecutor", "documento A,datos_ejecutor B", "A.ejecutor=B.iddatos_ejecutor and A.iddocumento=" . $doc, "");
            $ejecutor = busca_filtro_tabla("nombre", "ejecutor", "idejecutor=" . $datos_ejecutor[0]["ejecutor_idejecutor"], "");
        } elseif ($tipo_radicado == 2) {
            $datos_ejecutor = busca_filtro_tabla("A.ejecutor", "documento A", "A.iddocumento=" . $doc, "");
            $ejecutor = busca_filtro_tabla("CONCAT(nombres, CONCAT(' ', apellidos)) as nombre", "funcionario", "funcionario_codigo=" . $datos_ejecutor[0]["ejecutor"], "");
        }

        if ($ejecutor["numcampos"] && $datos_ejecutor[0]["plantilla"] == "") {
            $ruta = $ejecutor[0]["nombre"] . "-" . serie_documento($serie);
        } else {
            $ruta = "Error al buscar remitente-" . $datos_ejecutor['numcampos'] . serie_documento($serie);
        }
    }
    $ver_estado = '';
    if ($estado == 'ANULADO') {
        $ver_estado = '<font color="red">-(ANULADO)</font>';
    }
    $pre_texto = "<div class='link kenlace_saia pull-left' style='cursor: pointer;' enlace='ordenar.php?key=" . $doc . "&accion=mostrar&mostrar_formato=1' conector='iframe' titulo='Documento No." . $numero . "'><b>" . $numero . "-" . $ruta . $ver_estado . "</b></div>";

    return ($pre_texto);
}

function serie_documento($idserie)
{


    if ($idserie == 'serie') {
        return ("Sin Serie Asignada");
    }
    $serie = busca_filtro_tabla("nombre", "serie", "idserie=" . $idserie, "");
    if ($serie["numcampos"]) {
        return (ucwords(strtolower($serie[0]["nombre"])));
    }
    return ("Sin Serie Asignada");
}

function nombre_plantilla($plantilla, $iddoc = null)
{

    $tablas = "formato f";
    $where = "lower(f.nombre)='" . strtolower($plantilla) . "'";
    if (!empty($iddoc) && (empty($plantilla) || $plantilla == 'plantilla')) {
        $tablas .= ", documento d";
        $where = "d.iddocumento = $iddoc and lower(f.nombre)=lower(d.plantilla)";
    }
    $formato = busca_filtro_tabla("f.etiqueta", $tablas, $where, "");
    if ($formato["numcampos"]) {
        return (ucfirst(codifica_encabezado(strtolower($formato[0]["etiqueta"]))));
    } else {
        if ($iddoc) {
            $tipo = busca_filtro_tabla("", "documento a", "a.iddocumento=" . $iddoc, "");
            if ($tipo[0]["tipo_radicado"] == 1)
                return "Entrada";
            if ($tipo[0]["tipo_radicado"] == 2)
                return "Salida";
        } else {
            return "Entrada";
        }
    }
}

function filtro_funcionario($funcionario)
{
    if ($funcionario == 'funcionario') {
        $retorno = " AND B.llave_entidad='" . SessionController::getValue('usuario_actual') . "'";
    } else {
        $retorno = " AND B.llave_entidad='" . $funcionario . "'";
    }
    if (@$_REQUEST["variable_busqueda"]) {
        $retorno = " AND B.llave_entidad='" . $_REQUEST["variable_busqueda"] . "'";
    }
    return ($retorno);
}

function obtener_pantilla_documento($plantilla)
{
    return nombre_plantilla($plantilla);
}

/**
 * delimita la descripcion del documento
 * a 150 caracteres en caso de ser extensa
 *
 * @param string $descripcion
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-10-08
 */
function obtener_descripcion($descripcion)
{
    if (strlen($descripcion) > 150) {
        $descripcion = substr($descripcion, 0, 147) . '...';
    }

    return $descripcion;
}

function obtener_iddocumento()
{
    return ($_REQUEST['iddocumento']);
}

function filtro_despacho()
{
    if ($_REQUEST['variable_busqueda'] && $_REQUEST['variable_busqueda'] != '') {
        $docs = busca_filtro_tabla("", "documento,ft_despacho_ingresados", "documento_iddocumento=iddocumento and estado not in ('ELIMINADO','ANULADO') and numero=" . $_REQUEST['variable_busqueda'], "");
        if ($docs['numcampos']) {
            $where = " and iddocumento in(" . $docs[0]['docs_seleccionados'] . ")";
        } else {
            $where = " and iddocumento in(0)";
        }
        return ($where);
    }
}

function iddoc_distribuidos()
{

    $distribuidos = busca_filtro_tabla("docs_seleccionados", "ft_despacho_ingresados", "", "");
    $iddoc = array();

    if ($distribuidos['numcampos']) {
        for ($i = 0; $i < $distribuidos['numcampos']; $i++) {
            $tmp = explode(",", $distribuidos[$i]['docs_seleccionados']);
            $iddoc = array_merge($iddoc, $tmp);
        }
    }

    $iddoc = array_unique($iddoc);
    $iddoc = array_values($iddoc);
    $cantidad = count($iddoc);
    $where = '';
    $where .= "(";
    for ($i = 0; $i < $cantidad; $i++) {
        if ($i == 0) {
            $where .= "(iddocumento like '" . $iddoc[$i] . "')";
        } else {
            $where .= " OR (iddocumento like '" . $iddoc[$i] . "')";
        }
    }
    $where .= ")";
    return ($where);
}

function iddoc_no_distribuidos()
{

    $distribuidos = busca_filtro_tabla("docs_seleccionados", "ft_despacho_ingresados", "", "");

    $iddoc = array();

    if ($distribuidos['numcampos']) {
        for ($i = 0; $i < $distribuidos['numcampos']; $i++) {
            $tmp = explode(",", $distribuidos[$i]['docs_seleccionados']);
            $iddoc = array_merge($iddoc, $tmp);
        }
    }

    $iddoc = array_unique($iddoc);
    $iddoc = array_values($iddoc);
    $cantidad = count($iddoc);
    $where = '';
    $where .= "(";
    for ($i = 0; $i < $cantidad; $i++) {
        if ($i == 0) {
            $where .= "(iddocumento <>'" . $iddoc[$i] . "')";
        } else {
            $where .= " AND (iddocumento <> '" . $iddoc[$i] . "')";
        }
    }
    $where .= ")";
    return ($where);
}

/**
 * retorna el funcionario codigo del usuario logueado
 * usado para los reportes
 *
 * @return integer
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019
 */
function code_logged_user()
{
    return SessionController::getValue('usuario_actual');
}

/**
 * retorna el valor de variable busqueda
 * usado para los reportes
 *
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019
 */
function variable_busqueda()
{
    return $_REQUEST['variable_busqueda'];
}

/**
 * genera la parte superior de los buzones
 * recibidos y enviados
 *
 * @param int $documentId
 * @param int $userCode
 * @param int $number
 * @param string $date
 * @param int $transferId
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 */
function origin_pending_document($documentId, $userCode, $number, $date, $transferId)
{
    $number = is_numeric($number) ? $number : 0;
    $Funcionario = Funcionario::findByAttributes(['funcionario_codigo' => $userCode]);
    $roundedImage = roundedImage($Funcionario->getImage('foto_recorte'));
    $temporality = strtotime($date) ? temporality($date) : '';
    $documentRoute = 'views/documento/acordeon.php?';
    $documentRoute .= http_build_query([
        'documentId' => $documentId,
        'transferId' => $transferId
    ]);

    $html = '<div class="col-1 px-0 text-center action">
        <input type="hidden" data-transfer="' . $transferId . '" value="' . $documentId . '" class="identificator">'
        . $roundedImage .
        '</div>
    <div class="col show_document cursor principal_action" data-url="' . $documentRoute . '" titulo="Documento No.' . $number . '">
        <span class="mt-1 hint-text">' . $number . " - " . $Funcionario->getName() . '</span>
    </div>
    <div class="col-auto pr-0">
        <span class="mt-1 hint-text">' . $temporality . '</span>
    </div>';

    return $html;
}

/**
 * retorna el html de una imagen redondeada
 * @param string $route ruta de la imagen
 * @return string html de la imagen
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 */
function roundedImage($route)
{
    global $ruta_db_superior;

    $routeImage = $ruta_db_superior . $route;
    return '<span class="thumbnail-wrapper circular inline rounded_image cursor" style="float:none" style="width:36px;height:36px">
        <img src="' . $routeImage . '" style="width:36px;height:36px">
    </span>';
}

/**
 * retorna la clase bold cuando el documento
 * no se ha leido, usado para los buzones
 *
 * @param int $documentId
 * @param string $date
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 */
function unread($documentId, $date)
{
    $userCode = SessionController::getValue('usuario_actual');
    $date = new DateTime($date);

    $QueryBuilder = Model::getQueryBuilder();
    $data = $QueryBuilder->select('count(*) AS total')
        ->from('buzon_salida')
        ->where('archivo_idarchivo = :documentId')
        ->andWhere('origen = :userCode')
        ->andWhere('fecha >= :date')
        ->andWhere("nombre='LEIDO' OR nombre='BORRADOR'")
        ->setParameter(':documentId', $documentId, 'integer')
        ->setParameter(':userCode', $userCode, 'integer')
        ->setParameter(':date', $date, 'datetime')
        ->execute()->fetch();

    return !$data['total'] ? 'bold' : '';
}

/**
 * determina si un documento contiene anexos
 *
 * @param int $documentId
 * @param boolean $showCounter
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 */
function has_files($documentId, $showCounter = false)
{
    if ($documentId) {
        $files = Anexos::countRecords([
            'documento_iddocumento' => $documentId,
            'eliminado' => 0
        ]);
        $pages = Pagina::countRecords(['id_documento' => $documentId]);

        if ($files || $pages) {
            if ($showCounter) {
                $total = $files + $pages;

                $response = '<span id="show_files" class="px-1 cursor fa fa-paperclip notification f-20" data-toggle="tooltip" data-placement="bottom" title="Anexos">
                    <span class="badge badge-important counter">' . $total . '</span>
                </span>';
            } else {
                $response = '<span class="my-0 text-center cursor fa fa-paperclip f-20"></span>';
            }
        } else if ($showCounter) {
            $response = '<span id="show_files" class="d-none"></span>';
        }
    }
    return $response;
}

/**
 * muestra la prioridad del documento
 *
 * @param int $documentId
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 */
function priority($documentId, $priority)
{
    $class = !(int) $priority ? 'd-none' : '';
    return "<span class='my-0 text-center cursor f-20 px-1 priority_flag {$class}' data-key='{$documentId}'>
        <i class='fa fa-flag text-danger'></i>
    </span>";
}

/**
 * muestra el tipo documental del documento
 *
 * @param int $documentId
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 */
function documental_type($documentId)
{
    $Documento = new Documento($documentId);

    if ($Documento) {
        return '<span class="hint-text">' . $Documento->getSerie()->nombre . '</span>';
    } else {
        return '';
    }
}

/**
 * calcula el vencimiento de un documento
 *
 * @param string $date fecha limite del documento
 * @param integer $documentId
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-03-21
 */
function expiration($date, $documentId)
{
    if (strtotime($date)) {
        $taskInfo = DocumentoTarea::getLastStateByTask($documentId);

        if ($taskInfo['valor'] == TareaEstado::REALIZADA) {
            $html = '<span class="label label-success btn_expiration action cursor">' . $date . '</span>';
        } else if ($taskInfo[0][0]) {
            $Limit = new DateTime($date);
            $Today = new DateTime();

            $diference = dias_habiles_entre_fechas($Today, $Limit);

            if ($diference < 2) {
                if ($diference == 0) {
                    $html = '<span class="hint-text">Vence:</span> <span class="label label-danger btn_expiration action cursor">Hoy</span>';
                } elseif ($diference == 1) {
                    $html = '<span class="hint-text">Vence:</span> <span class="label label-danger btn_expiration action cursor">Mañana</span>';
                } else {
                    $html = '<span class="hint-text">Venció:</span> <span class="label label-danger btn_expiration action cursor">Hace ' . abs($diference) . ' días</span>';
                }
            } elseif ($diference >= 2 && $diference <= 8) {
                $html = '<span class="hint-text">Vence en:</span> <span class="label label-warning btn_expiration action cursor">' . $diference . ' días</span>';
            } else {
                $html = '<span class="hint-text">Vence en:</span> <span class="label label-info btn_expiration action cursor">' . $diference . ' días</span>';
            }
        } else {
            $html = '';
        }

        return $html;
    }
}

/**
 * calcula la temporalidad de un documento
 *
 * @param string $date
 * @return string
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 */
function temporality($date)
{
    $date = DateController::convertDate($date, 'Y-m-d H:i:s');
    $date = new DateTime($date);
    $timeFromDate = strtotime($date->format('Y-m-d H:i:s'));
    $diference = strtotime("now") - $timeFromDate;

    if ($diference < 900) { //under 15 minutes 15 * 60
        if ($diference < 300) { //5 minutes 5 * 60
            return 'Hace un momento';
        } else { //15 minutes
            $minutes = round($diference / 60); //convert to minutes
            return 'Hace ' . $minutes . ' Minutos';
        }
    }

    if (strtotime(date('Y-m-d')) < $timeFromDate) { // today
        return $date->format('H:i:s a');
    }

    $yesterday = (new DateTime())->sub(new DateInterval('P1D'))->format('Y-m-d');
    if (strtotime($yesterday) < $timeFromDate) { // yesterday
        return 'Ayer';
    }

    $beforeYesterday = (new DateTime())->sub(new DateInterval('P2D'))->format('Y-m-d');
    if (strtotime($beforeYesterday) < $timeFromDate) { // yesterday
        return 'Anteayer';
    } else {
        return $date->format('d-m-Y');
    }
}

/**
 * genera un enlace para el kaiten 
 * que redirige al mostrar de un documento
 *
 * @param int $numero
 * @param int $iddoc
 * @return string
 */
function mostrar_numero_enlace($number, $documentId)
{
    if ((int) $number) {
        $titulo = "No. " . $number;
    } else {
        $number = "Ver";
        $titulo = nombre_plantilla(null, $documentId);
    }

    $response = "<div titulo='{$titulo}'>
        <button onclick='js:abrir_kaiten(\"views/documento/index_acordeon.php?documentId={$documentId}\", \"{$titulo}\", 1)' class='btn btn-complete'>{$number}</button>
    </div>";

    return $response;
}

/**
 * convierte una fecha con formato 
 * Y-m-d H:i:s al formato predefinido del sistema
 *
 * @param string $date
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-03-15
 */
function date_formatted($date)
{
    return DateController::convertDate($date);
}

/**
 * indica si filtra por mis transferencias
 *
 * @return void
 * @author jhon sebastian valencia <jhon.valencia@cerok.com>
 * @date 2019-07-16
 */
function transfers()
{
    if (!$_REQUEST['variable_busqueda']) {
        $funcionario = SessionController::getValue('usuario_actual');
        $texto = "(a.origen={$funcionario} OR a.destino={$funcionario})";
    } else {
        $texto = '1=1';
    }
    return $texto;
}
