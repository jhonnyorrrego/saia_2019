<?php
$max_salida = 6;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'controllers/autoload.php';
include_once $ruta_db_superior . 'pantallas/documento/librerias.php';

$document = array();
$userId = 0;

/**
 * retorna los datos del documento
 * @param int $documentId identificador del documento
 * @return array busca_filtro_tabla 
 */
function findDocument($documentId){
    global $conn, $userId;

    if (!$documentId) {
        if ($_REQUEST['iddocumento']) {
            $documentId = $_REQUEST['iddocumento'];
        } else if ($_REQUEST['key']) {
            $documentId = $_REQUEST['key'];
        } else {
            die('No existe un documento valido');
        }
    }
    
    $document = busca_filtro_tabla("*", "formato a,documento b", "lower(b.plantilla)=lower(a.nombre) and b.iddocumento=" . $documentId, "", $conn);
    $formatName = $document[0]["nombre"];
    $userId = $_SESSION["usuario_actual"];

    if ($document[0]['mostrar_pdf'] == 1) {
        $_SESSION["tipo_pagina"] = "pantallas/documento/visor_documento.php?iddoc=" . $documentId . "&rnd=" . rand(0, 1000);
    } elseif ($document[0]['mostrar_pdf'] == 2) {
        $_SESSION["tipo_pagina"] = "pantallas/documento/visor_documento.php?pdf_word=1&iddoc=" . $documentId . "&rand=" . rand(0, 1000);
    } else {
        $_SESSION["tipo_pagina"] = FORMATOS_CLIENTE . $formatName . "/mostrar_" . $formatName . ".php?iddoc=" . $documentId . "&rand=" . rand(0, 1000);
    }

    return $document;
}

/**
 * retorna los permisos sobre modulos
 * hijos de un determinado modulo
 * 
 * @param int $documentId identificador del documento
 * @param int $parentModule
 * 
 * @return array de array [] = array(
        'id' => int,
        'route' => string,
        'icon' => string,
        'label' => string
    )
 */
function moduleActions($parentModule){
    global $conn;

    $findModules = busca_filtro_tabla('a.nombre,a.enlace,a.imagen,a.etiqueta', 'modulo a, modulo b', 'a.cod_padre = b.idmodulo and b.nombre = "' . $parentModule . '"', 'a.orden', $conn);
    unset($findModules['tabla'],$findModules['numcampos'],$findModules['sql']);
    
    return $findModules;
}

/**
 * busca las acciones permitidas sobre 
 * el documento por el funcionario
 * 
 * @param int $documentId identificador del documento
 * @return array 
        "ver_responsables" => boolean,
        "editar" => boolean,
        "devolucion" => boolean,
        "confirmar" => boolean
 */
function findActions($documentId){
    global $conn, $ruta_db_superior, $userId, $document;

    $seePreviousManagers = false;
    $seeManagers = false;
    $editButton = false;
    $confirmButton = false;
    $returnButton = false;

    $permissions = array();
    $findPermissions = busca_filtro_tabla("", "permiso_documento", "funcionario='" . $userId . "' AND documento_iddocumento=" . $documentId, "", $conn);
    if ($findPermissions["numcampos"]) {
        $permissions = explode(",", $findPermissions[0]["permisos"]);
    }

    $findManager = busca_filtro_tabla("destino,estado,plantilla", "buzon_entrada,documento", "iddocumento=archivo_idarchivo and archivo_idarchivo=" . $documentId, "buzon_entrada.idtransferencia asc", $conn);

    if ($findManager["numcampos"]) {
        if ($findManager[0]["estado"] == "ACTIVO" || $document["numcampos"]) {
            if ($findManager[0]["estado"] == "ACTIVO") {
                $seePreviousManagers = true;
            }
            if (in_array("m", $permissions)) {
                if (!$_REQUEST["vista"]) {
                    $editButton = true;
                }
            }
        }

        $findCurrent = busca_filtro_tabla("A.idtransferencia as idtrans,A.destino,A.ruta_idruta", "buzon_entrada A", "A.activo=1 and A.archivo_idarchivo=" . $documentId . " and (A.nombre='POR_APROBAR') and A.destino='" . $userId . "'", "A.idtransferencia", $conn);
        if ($findCurrent["numcampos"] > 0) {
            $findPrevious = busca_filtro_tabla("A.idtransferencia,A.ruta_idruta", "buzon_entrada A", "A.idtransferencia <" . $findCurrent[0]["idtrans"] . " and A.nombre='POR_APROBAR' and A.activo=1 and A.archivo_idarchivo=" . $documentId . " and origen='" . $userId . "'", "", $conn);
        }
        if (!$_REQUEST["vista"]) {
            $confirmButton = true;
        }

        if ($findManager["numcampos"] > 0 && $findManager[0]["destino"] != $userId) {
            $returnButton = true;
        }

        if (@$findCurrent[0]["destino"] != $userId || @$findPrevious["numcampos"] > 0) {
            $seeManagers = false;
            if ($seePreviousManagers && in_array("r", $permissions)) {
                $seeManagers = true;
            }
            $confirmButton = false;
            $returnButton = false;
        }
        if ($seePreviousManagers && in_array("r", $permissions)) {
            if ($_REQUEST["vista"] == "") {
                $seeManagers = true;
            }
        }
    }

    return array(
        "ver_responsables" => $seeManagers,
        "editar" => $editButton,
        "devolucion" => $returnButton,
        "confirmar" => $confirmButton
    );
}

function getTransfer($transferId){
    global $conn, $userId;

    if($transferId){
        $findTransfer = busca_filtro_tabla('*', 'buzon_salida', 'idtransferencia ='. $transferId, '', $conn);
        if($findTransfer[0]['origen'] == $userId){
            $ReferenceUser = new Funcionario($findTransfer[0]['destino']);
        }else{
            $ReferenceUser = new Funcionario($findTransfer[0]['origen']);
        }

        $Response = (object) $findTransfer[0];
        $Response->user = $ReferenceUser;
    }else{
        $Response = new stdclass();
        $Response->user = new Funcionario($userId);
    }

    return $Response;
}


/**
 *  pinta en el encabezado con la 
 *  informaciobndel documento
 * 
 * @param int $documentId  identificador del documento
 * @param int $idtransferencia identificador de la
 *      transferencia en caso de venir de un buzon
 * 
 * @return string html del encabezado
 */
function plantilla($documentId, $transferId = 0){
    global $conn, $ruta_db_superior, $document;

    $document = findDocument($documentId);    
    $documentActions = findActions($documentId);
    $Transfer = getTransfer($transferId);
    $temporality = $Transfer->fecha ? temporality($Transfer->fecha) : '';
    $totalComments = ComentarioDocumento::getTotalByDocument($documentId);

    if($_REQUEST['tipo'] !== 5){
        $moduleActions = moduleActions('menu_documento');
    }
    ?>
    <!--<link rel="stylesheet" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/fabjs/fab.css">-->
    <style>.notification {position: relative;cursor: pointer;text-decoration: none;}.notification > .counter {position: absolute;font-size: 0.5em;top: -9px;left: 1px;}</style>
    <div class="col-12 p-0 m-0" id="document_information">
        <div class="row m-0 bg-info text-white px-1" style="font-size:20px;height:36px">
            <div class="col px-1 my-auto">
                <span style="display:none" class="fa fa-arrow-left pr-3 cursor" id="go_back"></span>
                <span class="fa fa-sitemap cursor"></span>
                <span class="cursor fa fa-angle-double-down" id="show_tree"></span>
            </div>
            <div class="col-auto text-center my-auto pr-2">
                <span class="fa fa-mail-reply px-1 cursor">
                   <label class="d-none d-sm-inline f-12 font-heading">&nbsp;Responder</label>
                </span>
                <span class="fa fa-share px-1 d-none d-md-inline cursor">
                   <label class="d-none d-sm-inline f-12 font-heading">&nbsp;Reenviar</label>
                </span>
                <div class="dropdown d-inline px-0">
                    <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="cursor">
                        &nbsp;<i class="fa fa-flash"></i>
                        <label class="d-none d-sm-inline f-12 font-heading">&nbsp;Dar trámite</label>
                    </span>
                    <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end">
                        <a href="#" class="dropdown-item new_add" data-type="comunication">
                            <i class="fa fa-file-text-o"></i> Gestionar con comunicación oficial
                        </a>
                        <a href="#" class="dropdown-item new_add" data-type="process">
                            <i class="fa fa-link"></i> Gestionar con otros formatos
                        </a>
                        <a href="#" class="dropdown-item new_add" data-type="approval">
                            <i class="fa fa-thumbs-o-up"></i> Solicitar aprobación
                        </a>
                        <a href="#" class="dropdown-item new_add" data-type="task">
                            <i class="fa fa-calendar-o"></i> Asignar tareas o recordatorios
                        </a>
                    </div>
                </div>
                <div class="dropdown d-inline px-1">
                    <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="cursor">
                        &nbsp;&nbsp;<i class="fa fa-ellipsis-v"></i>&nbsp;&nbsp;
                    </span>
                    <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end">
                        <?php foreach ($moduleActions as $key => $item): ?>
                            <span id="<?= $item['nombre'] ?>" class="dropdown-item menu_options text-truncate" data-url="<?= $ruta_db_superior . $item['enlace']?>" class="text-body" style="line-height:28px;">
                                <i class="<?= $item['imagen'] ?>"></i> <?= $item['etiqueta']?>
                            </span>
                            <?php if($key == 4 || $key == 11): ?>
                                <hr class="m-1">
                            <?php endif; ?>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-0 mx-0 py-2">
            <div class="col col-md-auto px-0 mx-0">
                <div class="row px-0 mx-0">
                    <div class="col-auto text-center p-1">
                        <?= roundedImage($Transfer->user->getImage('foto_recorte')) ?>
                    </div>
                    <div class="col px-1">
                        <div class="row" style="line-height:1.5">
                            <div class="col-12">
                                <span class="bold">
                                    <span class="badge"><?= $document[0]['numero']?></span>
                                    <?= $Transfer->user->getName() ?>
                                </span>
                            </div>
                        </div>
                        <div class="row" style="line-height:1.5;font-size:11px">
                            <div class="col-12">
                                <span><?= $temporality ?></span>
                            </div>
                        </div>
                        <div class="row" style="line-height:1.5">
                            <div class="col-auto d-none d-md-block" style="font-size:11px">
                                <span><?= documental_type($documentId) ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-auto col-md mt-2 pr-0">
                <?= priority($documentId) ?>
                <?= has_files($documentId, true) ?>
                <span class="px-1 cursor fa fa-comments notification f-20" id="show_comments">
                    <span class="badge badge-important counter"><?= $totalComments ?></span>
                </span>
                <span class="px-1 cursor fa fa-calendar f-20"></span>
                <span class="px-1 cursor fa fa-road f-20"></span>
            </div>
            <div class="col-auto d-none d-md-block">
                <?= expiration($document[0]['fecha_limite']) ?>
            </div>
        </div>
        <div class="row mx-0 px-1">            
            <div class="col px-0">
                <span class="m-0">
                    <?= $document[0]['descripcion'] ?>
                </span>
            </div>
        </div>
        <div class="row mx-0 px-1">
            <div class="col-12 px-0 mx-0">
                <p style="line-height:1;">
                    <?= $Transfer->notas ?>
                </p>
            </div>
        </div>
        <div class="row mx-0 px-1">
            <div id="fab"></div>
        </div>
    </div>
    <!--<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/fabjs/fab.js"></script>-->
    <script src="<?= $ruta_db_superior ?>views/documento/js/encabezado.js" data-baseurl="<?= $ruta_db_superior ?>" data-documentid="<?= $documentId ?>"></script>
    <?php
}

if(isset($_REQUEST['documentId'])){
    plantilla($_REQUEST['documentId'], $_REQUEST['transferId']);
}
?>