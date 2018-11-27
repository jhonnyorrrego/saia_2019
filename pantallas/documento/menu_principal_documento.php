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
include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";

echo jquery();
echo bootstrap();
echo icons();
echo theme();
echo topModal();

$documento = array();
$funcionario = 0;

function menu_principal_documento($iddocumento, $tipo_visualizacion = "", $modulo_adicional = ""){
    global $conn, $ruta_db_superior, $documento;

    $documento = consulta_documento($iddocumento);          
    $datos_admin = botones_administrativos_menu($iddocumento);
    $identificador_arbol = identificador_arbol($documento);

    if ($_REQUEST["tipo"] !== 5 && !$_REQUEST["output"] && !$_REQUEST["imprimir"]) {
        $acciones = permisos_modulo_menu_intermedio($iddocumento, "acciones_menu_intermedio", array("tipo" => 2));
        $seguimiento = permisos_modulo_menu_intermedio($iddocumento, "informacion_menu_intermedio", array("tipo" => 2));
        $otros = permisos_modulo_menu_intermedio($iddocumento, "otros_menu_intermedio", array("tipo" => 2));
    }
    ?>    
    <div class="col-12 px-0 mx-0" style="font-size:12px">
        <div class="row pb-2 mx-0">
            <div class="col text-center p-0" id="container_go_back">
                <span>
                    <i style="cursor:pointer;" class="fa fa-chevron-left" id="go_back"></i>
                </span>
            </div>
            <div class="col p-0 m-0 text-center">
                <span>
                    <i class="fa fa-sitemap"></i>
                    <i style="cursor:pointer;" class="fa fa-angle-double-down" id="show_tree"></i>
                </span>
            </div>
            <div class="col text-center p-0">
                <span style="cursor:pointer;">
                    <i class="fa fa-mail-reply"></i><label class="d-none d-sm-inline">&nbsp;Responder</label>
                </span>
            </div>
            <div class="col-auto text-center px-0">
                <span style="cursor:pointer;">
                    <i class="fa fa-mail-reply-all"></i><label class="d-none d-sm-inline">&nbsp;Responder a todos</label>
                </span>
            </div>
            <div class="col text-center p-0">
                <span style="cursor:pointer;">
                    <i class="fa fa-share"></i><label class="d-none d-sm-inline">&nbsp;Reenviar</label>
                </span>
            </div>
            <div class="col-auto p-0">
                <span style="cursor:pointer;">
                    <div class="pr-1">
                        <div class="dropdown pull-right d-xs-block">
                            <span data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor:pointer">
                                <i class="fa fa-angle-double-left"></i>
                                &nbsp;Opciones
                            </span>
                            <div class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end">
                                <?php foreach ($acciones as $key => $item): ?>
                                    <a class="dropdown-item menu_options text-truncate" href="<?=$item['route']?>" class="text-body">
                                        <i class="<?=$item['icon']?>"></i> <?=$item['label']?>
                                    </a>
                                <?php endforeach;?>
                                <?php foreach ($seguimiento as $key => $item): ?>
                                    <a class="dropdown-item menu_options text-truncate" href="<?=$item['route']?>" class="text-body">
                                        <i class="<?=$item['icon']?>"></i> <?=$item['label']?>
                                    </a>
                                <?php endforeach;?>
                                <?php foreach ($otros as $key => $item): ?>
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
        <div class="row px-0 mx-0">
            <div class="col-1 px-0 mx-0">
                <span class="thumbnail-wrapper circular inline">
                    <img id="profile_image" src="../../temporal/temporal_andres.mendoza/2108097194r.png" style="width:3rem;height:3rem;">
                </span>
            </div>
            <div class="col-2">
                <div class="row">
                    <div class="col-12">
                        <span class="bold">Angélica Gómez</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <span>Hace 5 minutos</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <span class="px-1" style="cursor:pointer;"><i class="fa fa-flag"></i></span>
                <span class="px-1" style="cursor:pointer;"><i class="fa fa-paperclip"></i></span>
                <span class="px-1" style="cursor:pointer;"><i class="fa fa-comments"></i></span>
                <span class="px-1" style="cursor:pointer;"><i class="fa fa-calendar"></i></span>
                <span class="px-1" style="cursor:pointer;"><i class="fa fa-road"></i></span>
            </div>
            <div class="col-auto">
                vence: <label class="label label-danger" style="cursor:pointer;">Hoy</label>
            </div>
        </div>
        <div class="row mx-0 px-1">
            <div class="col-1 px-0 mx-0 text-center">
                <span class="bold">PQRS</span>
            </div>
            <div class="col">
                <p style="line-height:1;font-size:12px;" class="bold">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, iusto fuga. Ea eaque quasi voluptates voluptate eligendi aperiam quidem ab facere nobis, incidunt fugit delectus. Eius odio non modi at.</p>
            </div>
        </div>
        <div class="row mx-0 px-1">
            <div class="col-12 px-0 mx-0">
                <p style="line-height:1;font-size:12px;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Harum nemo culpa, laborum optio animi fugiat qui, consequuntur rem quia consectetur exercitationem vel iste similique eum quas incidunt eveniet fuga in.</p>
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
            var iddocumento = '<?= $iddocumento ?>';
            var breakpoint = localStorage.getItem('breakpoint');

            if($.inArray(breakpoint, ['xs', 'sm', 'md']) != -1){
                $('#container_go_back').show();
                $("#go_back").on('click', function(){
                    var leftPanel = $("#mailbox", parent.document);
                    var rightPanel = $("#right_workspace", parent.document);
                    let width = rightPanel.width();
        
                    rightPanel.animate({
                        left: width
                    },200,function(){
                        leftPanel.show().css('left', 0);
                        rightPanel.hide();
                        window.parent.window.resizeIframe();
                    });
                });
            }else{
                $('#container_go_back').hide();
            }

            /*$(".menu_options").on('click', function(e){
                let type = $(this).data('type');
                let options = {
                    html: true,
                    size: 'modal-sm',
                    buttons: {
                        cancel: {
                            label: 'Cerrar',
                            class: 'btn btn-danger'
                        }
                    }
                };

                switch (type) {
                    case 'acciones':
                        options.title = "Acciones";
                        options.content = $("#actions_content").html();
                        break;
                    case 'seguimiento':
                        options.title = "Seguimiento";
                        options.content = $("#trace_content").html();
                        break;
                    case 'otros':
                        options.title = "Otros";
                        options.content = $("#others_content").html();
                        break;
                }
                
                topModal(options);
            });

            $(".menu_item").on('click', function(){
                let options = {
                    url: baseUrl + $(this).data('url'),
                    params: {
                        iddocumento: iddocumento
                    },
                    title: $(this).text(),
                    size: 'modal-lg'
                };
                topModal(options);
            });*/

            $("#show_tree").on('click', function(){
                let options = {
                    url: `${baseUrl}views/arbol/proceso_formato.php`,
                    params: {
                        iddocumento: iddocumento
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
            })

            <?php if(in_array(true, array_values($datos_admin))) :?>
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
                        <?php if ($datos_admin["confirmar"]): ?>
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
                                            var iddoc_padre = match_iddoc[2];
                                        }else{
                                            var iddoc_padre = 0;
                                        }
                                    }else{
                                        var iddoc_padre = <?= $iddocumento ?>
                                    }
                                    
                                    var ruta = "<?= $ruta_db_superior ?>class_transferencia.php?iddoc=<?= $iddocumento ?>&funcion=aprobar&anterior=" + iddoc_padre;
                                    window.open(ruta, "_self");
                                }
                            },
                        <?php endif; ?>
                        <?php if ($datos_admin["editar"]): ?>
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
                                    window.open("<?php echo $ruta_db_superior . FORMATOS_CLIENTE . $documento[0]["nombre"] .'/'. $documento[0]["ruta_editar"] ?>?iddoc=<?= ($iddocumento); ?>&idformato=<?= $documento[0]["idformato"] ?>","_self");
                                }
                            },
                        <?php endif; ?>
                        <?php if ($datos_admin["ver_responsables"]): ?>
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
                                    window.open("<?= $ruta_db_superior ?>mostrar_ruta.php?doc=<?= $iddocumento ?>", "_self");
                                }
                            },
                        <?php endif; ?>
                        <?php if ($datos_admin["devolucion"]) : ?>
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
                                    window.open("<?= $ruta_db_superior ?>class_transferencia.php?iddoc=<?= $iddocumento ?>&funcion=formato_devolucion","_self");
                                }
                            }
                        <?php endif; ?>
                    ]
                });
            <?php endif; ?>
        });
    </script>
    <?php
}

function consulta_documento($iddocumento){
    global $conn, $funcionario;

    if (!$iddocumento) {
        if ($_REQUEST['iddocumento']) {
            $iddocumento = $_REQUEST['iddocumento'];
        } else if ($_REQUEST['key']) {
            $iddocumento = $_REQUEST['key'];
        } else {
            die('No existe un documento valido');
        }
    }
    
    $documento = busca_filtro_tabla("", "formato a,documento b", "lower(b.plantilla)=lower(a.nombre) and b.iddocumento=" . $iddocumento, "", $conn);
    $nombre_formato = $documento[0]["nombre"];
    $funcionario = $_SESSION["usuario_actual"];

    if ($documento[0]['mostrar_pdf'] == 1) {
        $_SESSION["tipo_pagina"] = "pantallas/documento/visor_documento.php?iddoc=" . $iddocumento . "&rnd=" . rand(0, 1000);
    } elseif ($documento[0]['mostrar_pdf'] == 2) {
        $_SESSION["tipo_pagina"] = "pantallas/documento/visor_documento.php?pdf_word=1&iddoc=" . $iddocumento . "&rand=" . rand(0, 1000);
    } else {
        $_SESSION["tipo_pagina"] = FORMATOS_CLIENTE . $nombre_formato . "/mostrar_" . $nombre_formato . ".php?iddoc=" . $iddocumento . "&rand=" . rand(0, 1000);
    }

    return $documento;
}

function identificador_arbol($documento){
    global $conn;

    $ft = busca_filtro_tabla("id" . $documento[0]["nombre_tabla"] . " AS idft", $documento[0]["nombre_tabla"], "documento_iddocumento=" . $documento[0]['iddocumento'], '', $conn);
    return $documento[0]["idformato"] . "-" . $ft[0]["idft"] . "-id" . $documento[0]["nombre_tabla"];    
}
/*
$iddoc=iddocumento
$modulo_padre=nombre del modulo padre
$lista=arreglo con nombre: nombre del modulo y tipo=1 botones con enlace, tipo=2 listado, tipo= 0 clase
$target=destino donde se debe abrir el enlace
 */
function permisos_modulo_menu_intermedio($iddoc, $modulo_padre, $lista, $target = "_self"){
    global $ruta_db_superior, $documento, $funcionario, $conn;

    $enlaces = array();
    $permiso = new PERMISO();

    if ($documento[0]['estado'] == 'ANULADO') {
        switch (strtolower($modulo_padre)) {
            case 'otros_menu_intermedio':
                $datos_modulos = array('Almacenamiento');
                break;
            case 'acciones_menu_intermedio':
                $datos_modulos = array(
                    'devolucion',
                    'transferir',
                    'expediente_menu',
                    'enviar_documento_correo',
                );
                break;
            case 'rapidos_menu_intermedio':
                $datos_modulos = array(
                    'transferir',
                    'seguimiento_rastro',
                    'devolucion',
                    'vista_previa',
                );
                break;
            default:
                break;
        }

        $modulos = busca_filtro_tabla("*", "modulo", "nombre IN ('" . implode("','", $datos_modulos) . "')", "orden", $conn);
    } else {
        $modulos = busca_filtro_tabla('a.*', 'modulo a, modulo b', 'a.cod_padre = b.idmodulo and b.nombre = "' . $modulo_padre . '"', 'a.orden', $conn);
    }

    for ($i = 0; $i < $modulos["numcampos"]; $i++) {
        $acceso = $permiso->acceso_modulo_perfil($modulos[$i]["nombre"], 1);
        if ($acceso) {
            $search = array(
                '@key@',
                '@iddoc@',
                '@iddocumento@',
                '@rand@',
            );
            $replace = array(
                $iddoc,
                $iddoc,
                $iddoc,
                rand(0, 1000),
            );
            $modulos[$i]["enlace"] = str_replace($search, $replace, $modulos[$i]["enlace"]);

            if ($modulos[$i]["nombre"] == 'vista_previa' && @$_REQUEST["vista"]) {
                $modulos[$i]["enlace"] .= "&vista=" . $_REQUEST["vista"];
            }

            if ($modulos[$i]["nombre"] == 'ver_notas_posit') {
                $datos_documento = busca_filtro_tabla("B.nombre,B.ruta_mostrar,A.iddocumento,B.idformato", "documento A, formato B", "lower(A.plantilla)=lower(B.nombre) AND A.iddocumento=" . $iddoc, "", $conn);
                $modulos[$i]["enlace"] = FORMATOS_CLIENTE . $datos_documento[0]["nombre"] . "/" . $datos_documento[0]["ruta_mostrar"] . "?iddoc=" . $datos_documento[0]["iddocumento"] . "&idformato=" . $datos_documento[0]["idformato"] . "&ver_notas=1";
            }

            if ($modulos[$i]["nombre"] == "eliminar_borrador" && ($documento[0]["estado"] != "ACTIVO" || $documento[0]["ejecutor"] != $funcionario)) {
                continue;
            }

            if ($modulos[$i]["destino"] && $modulos[$i]["destino"] != "centro") {
                $target = $modulos[$i]["destino"];
            } else {
                $target = "_self";
            }

            $enlaces[] = array(
                'id' => $modulos[$i]["nombre"],
                'route' => $ruta_db_superior . $modulos[$i]["enlace"],
                'icon' => $modulos[$i]["imagen"],
                'label' => $modulos[$i]["etiqueta"]
            );
        }
    }
    return $enlaces;
}

function botones_administrativos_menu($iddocumento){
    global $conn, $ruta_db_superior, $funcionario, $documento;

    include_once $ruta_db_superior . "class_transferencia.php";

    $ver_responsables_previo = false;
    $ver_responsables = false;
    $boton_editar = false;
    $boton_confirmar = false;
    $boton_devolucion = false;

    $v_permisos = array();
    $permisos = busca_filtro_tabla("", "permiso_documento", "funcionario='" . $funcionario . "' AND documento_iddocumento=" . $iddocumento, "", $conn);
    if ($permisos["numcampos"]) {
        $v_permisos = explode(",", $permisos[0]["permisos"]);
    }

    $responsable = busca_filtro_tabla("destino,estado,plantilla", "buzon_entrada,documento", "iddocumento=archivo_idarchivo and archivo_idarchivo=" . $iddocumento, "buzon_entrada.idtransferencia asc", $conn);

    if ($responsable["numcampos"]) {
        if ($responsable[0]["estado"] == "ACTIVO" || $documento["numcampos"]) {
            if ($responsable[0]["estado"] == "ACTIVO") {
                $ver_responsables_previo = true;
            }
            if (in_array("m", $v_permisos)) {
                if (!$_REQUEST["vista"]) {
                    $boton_editar = true;
                }
            }
        }

        $actual = busca_filtro_tabla("A.idtransferencia as idtrans,A.destino,A.ruta_idruta", "buzon_entrada A", "A.activo=1 and A.archivo_idarchivo=" . $iddocumento . " and (A.nombre='POR_APROBAR') and A.destino='" . $funcionario . "'", "A.idtransferencia", $conn);
        if ($actual["numcampos"] > 0) {
            $anterior = busca_filtro_tabla("A.idtransferencia,A.ruta_idruta", "buzon_entrada A", "A.idtransferencia <" . $actual[0]["idtrans"] . " and A.nombre='POR_APROBAR' and A.activo=1 and A.archivo_idarchivo=" . $iddocumento . " and origen='" . $funcionario . "'", "", $conn);
        }
        if (!$_REQUEST["vista"]) {
            $boton_confirmar = true;
        }

        if ($responsable["numcampos"] > 0 && $responsable[0]["destino"] != $funcionario) {
            $boton_devolucion = true;
        }

        if (@$actual[0]["destino"] != $funcionario || @$anterior["numcampos"] > 0) {
            $ver_responsables = false;
            if ($ver_responsables_previo && in_array("r", $v_permisos)) {
                $ver_responsables = true;
            }
            $boton_confirmar = false;
            $boton_devolucion = false;
        }
        if ($ver_responsables_previo && in_array("r", $v_permisos)) {
            if ($_REQUEST["vista"] == "") {
                $ver_responsables = true;
            }
        }
    }
    return (array(
        "ver_responsables" => $ver_responsables,
        "editar" => $boton_editar,
        "devolucion" => $boton_devolucion,
        "confirmar" => $boton_confirmar
    ));
}

if (@$_REQUEST["mostrar_menu"]) {
    if ($_REQUEST["iddocumento"]) {
        menu_principal_documento($_REQUEST["iddocumento"]);
    }
}
?>