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

$userCode = $_SESSION["usuario_actual"]; //funcionario_codigo

function getTransfer($transferId)
{
    global $conn, $userCode;

    if ($transferId) {
        $findTransfer = busca_filtro_tabla('*', 'buzon_salida', 'idtransferencia =' . $transferId, '', $conn);
        if ($findTransfer[0]['origen'] == $userCode) {
            $ReferenceUser = new Funcionario($findTransfer[0]['destino']);
        } else {
            $ReferenceUser = new Funcionario($findTransfer[0]['origen']);
        }

        $Response = (object)$findTransfer[0];
        $Response->user = $ReferenceUser;
    } else {
        $Response = new stdclass();
        $Response->user = new Funcionario($userCode);
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
function plantilla($documentId, $transferId = 0)
{
    global $ruta_db_superior;

    $Documento = new Documento($documentId);
    $Transfer = getTransfer($transferId);
    $temporality = $Transfer->fecha ? temporality($Transfer->fecha) : '';
    $totalComments = ComentarioDocumento::getTotalByDocument($documentId);
    $totalTasks = DocumentoTarea::getTotalByDocument($documentId);

    $userInfo = [
        'user' => $Transfer->user->getPK(),
        'name' => $Transfer->user->getName()
    ];
    
    $priorityClass = $Documento->prioridad ? 'text-danger' : '';
    ?>
<link rel="stylesheet" href="<?= $ruta_db_superior ?>views/documento/css/encabezado.css">
<link rel="stylesheet" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/fabjs/fab.css">
<div class="col-12 p-0 m-0" id="document_information">
    <div class="row m-0 bg-info text-white px-1" style="font-size:20px;height:36px">
        <div class="col px-1 my-auto">
            <span style="display:none" class="fa fa-arrow-left pr-3 cursor" id="go_back"></span>
            <span class="fa fa-sitemap cursor"></span>
            <span class="cursor fa fa-angle-double-down" id="show_tree"></span>
        </div>
        <div class="col-auto text-center my-auto pr-2">
            <span class="fa fa-mail-reply px-1 cursor" id="reply">
                <label class="d-none d-sm-inline f-12 font-heading cursor">&nbsp;Responder</label>
            </span>
            <span class="fa fa-share px-1 d-none d-md-inline cursor" id="resend">
                <label class="d-none d-sm-inline f-12 font-heading cursor">&nbsp;Reenviar</label>
            </span>
            <div class="dropdown d-inline px-0">
                <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="cursor">
                    &nbsp;<i class="fa fa-flash"></i>
                    <label class="d-none d-sm-inline f-12 font-heading cursor">&nbsp;Dar trámite</label>
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
                <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" id="module_items"></div>
            </div>
        </div>
    </div>
    <div class="row px-0 mx-0 py-2">
        <div class="col col-md-auto px-0 mx-0">
            <div class="row px-0 mx-0">
                <div class="col-auto text-center p-1">
                    <input type="hidden" id="userInfo" data-info='<?= json_encode($userInfo) ?>'>
                    <?= roundedImage($Transfer->user->getImage('foto_recorte')) ?>
                </div>
                <div class="col px-1">
                    <div class="row" style="line-height:1.5">
                        <div class="col-12">
                            <span class="bold">
                                <?= $Documento->numero ?> - <?= $userInfo['name'] ?>
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
            <span id="priority_flag" class='my-0 text-center cursor f-20 px-1' data-key='<?= $documentId ?>'>
                <i class='fa fa-flag  <?= $priorityClass ?>'></i>
            </span>
            <?= has_files($documentId, true) ?>
            <span class="px-1 cursor fa fa-comments notification f-20" id="show_comments" data-toggle="tooltip" data-placement="bottom" title="Comentarios">
                <span class="badge badge-important counter"><?= $totalComments ?></span>
            </span>
            <span class="px-1 cursor fa fa-calendar notification f-20" id="show_task" data-toggle="tooltip" data-placement="bottom" title="Tareas">
                <span class="badge badge-important counter"><?= $totalTasks ?></span>
            </span>
            <span class="px-1 cursor fa fa-road f-20" id="show_history" data-toggle="tooltip" data-placement="bottom" title="Trazabilidad"></span>
        </div>
        <div class="col-auto d-none d-md-block">
            <?= expiration($Documento->fecha_limite) ?>
        </div>
    </div>
    <div class="row mx-0 px-1">
        <div class="col px-0">
            <span class="m-0">
                <?= $Documento->descripcion ?>
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
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/fabjs/fab.js"></script>
<script src="<?= $ruta_db_superior ?>views/documento/js/encabezado.js" data-baseurl="<?= $ruta_db_superior ?>" data-documentid="<?= $documentId ?>"></script>
<?php

}

if (isset($_REQUEST['documentId'])) {
    plantilla($_REQUEST['documentId'], $_REQUEST['transferId']);
}
?> 