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

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . 'pantallas/documento/librerias.php';

function getTransfer($transferId)
{
    $userCode = SessionController::getValue('usuario_actual');

    if ($transferId) {
        $findTransfer = StaticSql::search("select * from buzon_salida where idtransferencia = {$transferId}");

        $code = $findTransfer[0]['origen'] != $userCode ?
            $findTransfer[0]['origen'] : $findTransfer[0]['destino'];
        $Funcionario = Funcionario::findByAttributes([
            'funcionario_codigo' => $code
        ]);

        $Response = (object) $findTransfer[0];
        $Response->user = $Funcionario;
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
    $Formato = $Documento->getFormat();
    $Transfer = getTransfer($transferId);
    $temporality = $Transfer->fecha ? temporality($Transfer->fecha) : '';

    $userInfo = [
        'user' => $Transfer->user->getPK(),
        'name' => $Transfer->user->getName()
    ];

    $params = json_encode([
        'baseUrl' => $ruta_db_superior,
        'documentId' => $documentId,
        'number' => $Documento->numero
    ]);

    $priorityClass = $Documento->prioridad ? 'text-danger' : '';
    ?>
    <link rel="stylesheet" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/fabjs/fab.css">
    <div class="row mx-0 px-1">
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
                    <span id="priority_flag" class='my-0 text-center cursor f-20 px-1' data-key='<?= $documentId ?>' data-toggle="tooltip" data-placement="bottom" title="Prioridad">
                        <i class='fa fa-flag  <?= $priorityClass ?>'></i>
                    </span>
                    <?= has_files($documentId, true) ?>
                    <span class="px-1 cursor fa fa-comments notification f-20" id="show_comments" data-toggle="tooltip" data-placement="bottom" title="Comentarios">
                        <span class="badge badge-important counter" id="comments_counter"></span>
                    </span>
                    <span class="px-1 cursor fa fa-calendar notification f-20" id="show_task" data-toggle="tooltip" data-placement="bottom" title="Tareas">
                        <span class="badge badge-important counter" id="tasks_counter"></span>
                    </span>
                    <span class="px-1 cursor fa fa-chain notification f-20" id="show_documents" data-toggle="tooltip" data-placement="bottom" title="Documentos vinculados">
                        <span class="badge badge-important counter" id="documents_counter"></span>
                    </span>
                    <span class="px-1 cursor fa fa-road f-20" id="show_history" data-toggle="tooltip" data-placement="bottom" title="Trazabilidad"></span>
                </div>
                <div class="col-auto d-none d-md-block">
                    <?= expiration($Documento->fecha_limite, $documentId) ?>
                </div>
            </div>
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
            <div id="fab"></div>

        </div>
    </div>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/fabjs/fab.js"></script>
    <script src="<?= $ruta_db_superior ?>views/documento/js/encabezado.js" data-headerparams='<?= $params ?>'></script>
    <script src='<?= $ruta_db_superior . "formatos/{$Formato->nombre}/funciones.js" ?>' data-format-params='<?= $params ?>'></script>
<?php

}

if (isset($_REQUEST['documentId'])) {
    plantilla($_REQUEST['documentId'], $_REQUEST['transferId']);
}
?>