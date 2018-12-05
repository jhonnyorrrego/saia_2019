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

include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "pantallas/documento/librerias.php";
include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";

echo jquery();
echo bootstrap();
echo icons();
echo theme();
echo toastr();
echo topModal();

$document = array();
$userId = 0;

/**
 *  pinta en el encabezado con la 
 *  informaciobndel documento
 * 
 * @param int $documentId  identificador del documento
 * @param int $idtransferencia identificador de la
 *      transferencia en caso de venir de un buzon
 * 
 * @return html del encabezado
 */
function menu_principal_documento($documentId, $transferId = 0){
    global $conn, $ruta_db_superior, $document;

    $document = findDocument($documentId);    
    $documentActions = findActions($documentId);
    $Transfer = getTransfer($transferId);
    $temporality = $Transfer->fecha ? temporality($Transfer->fecha) : '';

    if ($_REQUEST["tipo"] !== 5 && !$_REQUEST["output"] && !$_REQUEST["imprimir"]) {
        $actionModules = moduleAccess($documentId, "acciones_menu_intermedio", array("tipo" => 2));
        $traceModules = moduleAccess($documentId, "informacion_menu_intermedio", array("tipo" => 2));
        $otherModules = moduleAccess($documentId, "otros_menu_intermedio", array("tipo" => 2));
    }
    ?>
    <style>
    a.fa-paperclip {
      position: relative;
      cursor: pointer;
      text-decoration: none;
    }
    span.badge-important {
      position: absolute;
      font-size: 0.5em;
      top: -9px;
      left: 1px;
    }
    </style>    
    <div class="col-12 px-0 mx-0">
        <div class="row m-0">
            <div class="col-auto px-1">
                <span class="h6">
                    <i style="display:none" class="fa fa-chevron-left px-3 cursor" id="go_back"></i>
                </span>
                <span id="show_tree" class="h6">
                    <i class="fa fa-sitemap cursor"></i>
                    <i class="cursor fa fa-angle-double-down"></i>
                </span>
            </div>
            <div class="col text-center">
                <span class="cursor p-1 h6">
                    <i class="fa fa-mail-reply"></i><label style="font-size:13px;" class="d-none d-sm-inline">&nbsp;Responder</label>
                </span>
                <span class="cursor p-1 h6">
                    <i class="fa fa-mail-reply-all"></i><label style="font-size:13px;" class="d-none d-sm-inline">&nbsp;Responder a todos</label>
                </span>
                <span class="cursor p-1 h6">
                    <i class="fa fa-share"></i><label style="font-size:13px;" class="d-none d-sm-inline">&nbsp;Reenviar</label>
                </span>
            </div>
            <div class="col-auto">
                <span class="cursor">
                    <div class="pr-1">
                        <div class="dropdown pull-right d-xs-block">
                            <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-angle-double-left"></i> Opciones
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end">
                                <?php foreach ($actionModules as $key => $item): ?>
                                    <a class="dropdown-item menu_options text-truncate" href="<?=$item['route']?>" class="text-body">
                                        <i class="<?=$item['icon']?>"></i> <?=$item['label']?>
                                    </a>
                                <?php endforeach;?>
                                <?php foreach ($traceModules as $key => $item): ?>
                                    <a class="dropdown-item menu_options text-truncate" href="<?=$item['route']?>" class="text-body">
                                        <i class="<?=$item['icon']?>"></i> <?=$item['label']?>
                                    </a>
                                <?php endforeach;?>
                                <?php foreach ($otherModules as $key => $item): ?>
                                    <a class="dropdown-item menu_options text-truncate" href="<?=$item['route']?>" class="text-body">
                                        <i class="<?=$item['icon']?>"></i> <?=$item['label']?>
                                    </a>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </span>
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
                                <span class="bold"><?= $Transfer->user->getName() ?></span>
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
            <div class="col-auto col-md">
                <?= priority($documentId) ?>
                <?= has_files($documentId) ?>
                <span class="px-1 h6 cursor"><i class="fa fa-comments"></i></span>
                <span class="px-1 h6 cursor"><i class="fa fa-calendar"></i></span>
                <span class="px-1 h6 cursor"><i class="fa fa-road"></i></span>
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
    <link rel="stylesheet" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/fabjs/fab.css">
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/fabjs/fab.js"></script>
    <script type="text/javascript">
        $(function(){
            var baseUrl = '<?= $ruta_db_superior ?>';
            var documentId = '<?= $documentId ?>';
            toggleGoBack();
            showFlag();        
            
            $("#go_back").on('click', function(){                                
                $("#mailbox,#right_workspace", parent.document).toggleClass('d-none');                
            });

            $("#show_tree").on('click', function(){
                let options = {
                    url: `${baseUrl}views/arbol/proceso_formato.php`,
                    params: {
                        iddocumento: documentId
                    },
                    title: 'Proceso',
                    size: 'modal-sm',
                    buttons: {
                        cancel: {
                            label: 'Cerrar',
                            class: 'btn btn-danger'
                        }
                    }
                };
                topModal(options);
            });
            
            $(".priority_flag").on('click', function(){
                var flagParent = $(`.priority[data-key='${documentId}']`, window.parent.document),
                    flag = $(this).find('.priority');
                    priority = flag.hasClass('text-danger') ? 0 : 1,
                    key = localStorage.getItem('key');

                $.post(`${baseUrl}app/documento/asignar_prioridad.php`,{
                    priority: priority,
                    selections: documentId,
                    key: key
                }, function(response){
                    if(response.success){
                        toastr.success(response.message);

                        if(priority){
                            flag.addClass('text-danger');
                            flagParent.show();
                        }else{
                            flag.removeClass('text-danger');
                            flagParent.hide();
                        }
                    }else{
                        toastr.error(response.message);
                    }
                }, 'json')
            });

            <?php if(in_array(true, array_values($documentActions))) :?>
                var fab = new Fab({
                    selector: "#fab",
                    button: {
                        style: "large blue",
                        html: ""
                    },
                    icon:{
                        style: "fa fa-chevron-up",
                        html: ""
                    },
                    // "top-left" || "top-right" || "bottom-left" || "bottom-right"
                    position: "bottom-right",
                    // "horizontal" || "vertical"
                    direction: "vertical",
                    buttons:[
                        <?php if ($documentActions["confirmar"]): ?>
                            {
                                button: {
                                    style: "small yellow",
                                    html: ""
                                },
                                icon:{
                                    style: "fa fa-check",
                                    html: ""
                                },
                                onClick: function(){
                                    if(window.parent.frames["arbol_formato"] !== undefined){
                                        match_iddoc = window.parent.frames["arbol_formato"].location.href.match(/(iddoc)=([\d]+)/);
                                        if(match_iddoc){
                                            var parentDocumentId = match_iddoc[2];
                                        }else{
                                            var parentDocumentId = 0;
                                        }
                                    }else{
                                        var parentDocumentId = documentId;
                                    }
                                    
                                    var route = `${baseUrl}class_transferencia.php?iddoc=${documentId}&funcion=aprobar&anterior=${parentDocumentId}`;
                                    window.open(route, "_self");
                                }
                            },
                        <?php endif; ?>
                        <?php if ($documentActions["editar"]): ?>
                            {
                                button: {
                                    style: "small yellow",
                                    html: ""
                                },
                                icon:{
                                    style: "fa fa-edit",
                                    html: ""
                                },
                                onClick: function(){
                                    window.open("<?php echo $ruta_db_superior . FORMATOS_CLIENTE . $document[0]["nombre"] .'/'. $document[0]["ruta_editar"] ?>?iddoc=<?= $documentId ?>&idformato=<?= $document[0]["idformato"] ?>","_self");
                                }
                            },
                        <?php endif; ?>
                        <?php if ($documentActions["ver_responsables"]): ?>
                            {
                                button: {
                                    style: "small yellow",
                                    html: ""
                                },
                                icon:{
                                    style: "fa fa-users",
                                    html: ""
                                },
                                onClick: function(){
                                    window.open(`${baseUrl}mostrar_ruta.php?doc=${documentId}`, "_self");
                                }
                            },
                        <?php endif; ?>
                        <?php if ($documentActions["devolucion"]) : ?>
                            {
                                button: {
                                    style: "small yellow",
                                    html: ""
                                },
                                icon:{
                                    style: "fa fa-backward",
                                    html: ""
                                },
                                onClick: function(){
                                    window.open(`${baseUrl}class_transferencia.php?iddoc=${documentId}&funcion=formato_devolucion`,"_self");
                                }
                            }
                        <?php endif; ?>
                    ]
                });
            <?php endif; ?>

            window.addEventListener("orientationchange", function () {
                setTimeout(() => {
                    toggleGoBack();
                }, 500);
            }, false);

            $(window).resize(function() {
                toggleGoBack();
            });

            function toggleGoBack(){                
                if($("#mailbox", parent.document).is(':hidden')){
                    $("#go_back").show();
                }else{
                    $("#go_back").hide();
                }
            }

            function showFlag(){                
                if($(".priority").is(':hidden')){
                    $(".priority")
                        .removeClass('text-danger')
                        .show();
                }
            }
        });
    </script>
    <?php
}

/**
 * retorna los datos del documento
 * @param int $documentId identificador del documento
 * @return busca_filtro_tabla 
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
function moduleAccess($documentId, $parentModule){
    global $ruta_db_superior, $document, $userId, $conn;

    $links = array();
    $Permiso = new PERMISO();

    if ($document[0]['estado'] == 'ANULADO') {
        switch (strtolower($parentModule)) {
            case 'otros_menu_intermedio':
                $moduleNames = array('Almacenamiento');
                break;
            case 'acciones_menu_intermedio':
                $moduleNames = array(
                    'devolucion',
                    'transferir',
                    'expediente_menu',
                    'enviar_documento_correo',
                );
                break;
            case 'rapidos_menu_intermedio':
                $moduleNames = array(
                    'transferir',
                    'seguimiento_rastro',
                    'devolucion',
                    'vista_previa',
                );
                break;
            default:
                break;
        }

        $findModules = busca_filtro_tabla("*", "modulo", "nombre IN ('" . implode("','", $moduleNames) . "')", "orden", $conn);
    } else {
        $findModules = busca_filtro_tabla('a.*', 'modulo a, modulo b', 'a.cod_padre = b.idmodulo and b.nombre = "' . $parentModule . '"', 'a.orden', $conn);
    }

    for ($i = 0; $i < $findModules["numcampos"]; $i++) {
        $access = $Permiso->acceso_modulo_perfil($findModules[$i]["nombre"], 1);
        if ($access) {
            $search = array(
                '@key@',
                '@iddoc@',
                '@iddocumento@',
                '@rand@',
            );
            $replace = array(
                $documentId,
                $documentId,
                $documentId,
                rand(0, 1000),
            );
            $findModules[$i]["enlace"] = str_replace($search, $replace, $findModules[$i]["enlace"]);

            if ($findModules[$i]["nombre"] == 'vista_previa' && @$_REQUEST["vista"]) {
                $findModules[$i]["enlace"] .= "&vista=" . $_REQUEST["vista"];
            }

            if ($findModules[$i]["nombre"] == 'ver_notas_posit') {                
                $findModules[$i]["enlace"] = FORMATOS_CLIENTE . $document[0]["nombre"] . "/" . $document[0]["ruta_mostrar"] . "?iddoc=" . $document[0]["iddocumento"] . "&idformato=" . $document[0]["idformato"] . "&ver_notas=1";
            }

            if ($findModules[$i]["nombre"] == "eliminar_borrador" && 
                ($document[0]["estado"] != "ACTIVO" || $document[0]["ejecutor"] != $userId)) {
                continue;
            }

            $links[] = array(
                'id' => $findModules[$i]["nombre"],
                'route' => $ruta_db_superior . $findModules[$i]["enlace"],
                'icon' => $findModules[$i]["imagen"],
                'label' => $findModules[$i]["etiqueta"]
            );
        }
    }
    return $links;
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

    include_once $ruta_db_superior . "class_transferencia.php";

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
    global $conn, $ruta_db_superior, $userId;
    include_once $ruta_db_superior . 'models/funcionario.php';

    if(!$transferId)
        $transferId = $_SESSION['transferId'];

    if($transferId){
        $_SESSION['transferId'] = $transferId;

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

if (@$_REQUEST["mostrar_menu"]) {
    if ($_REQUEST["iddocumento"]) {
        menu_principal_documento($_REQUEST["iddocumento"]);
    }
}
?>