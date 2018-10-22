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
echo librerias_arboles();

$documento = array();
$funcionario = 0;

function menu_principal_documento($iddocumento, $tipo_visualizacion = "", $modulo_adicional = ""){
    global $conn, $ruta_db_superior, $documento, $funcionario;

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

    $ft = busca_filtro_tabla("id" . $documento[0]["nombre_tabla"] . " AS idft", $documento[0]["nombre_tabla"], "documento_iddocumento=" . $iddocumento, '', $conn);
    $identificador_arbol = $documento[0]["idformato"] . "-" . $ft[0]["idft"] . "-id" . $documento[0]["nombre_tabla"];

    if ($_REQUEST["tipo"] !== 5 && !$_REQUEST["output"] && !$_REQUEST["imprimir"]) {
        $acciones = permisos_modulo_menu_intermedio($iddocumento, "acciones_menu_intermedio", array("tipo" => 2));
        $seguimiento = permisos_modulo_menu_intermedio($iddocumento, "informacion_menu_intermedio", array("tipo" => 2));
        $otros = permisos_modulo_menu_intermedio($iddocumento, "otros_menu_intermedio", array("tipo" => 2));
    }

    $datos_admin = botones_administrativos_menu($iddocumento);
    ?>
    <link rel="stylesheet" href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/fabjs/fab.css">
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/fabjs/fab.js"></script>

    <div class="text-right">
        <div class="fixed-top mt-1">
            <div class="pr-1">
                <button class="btn btn-sm" onClick="js: $('#actions').toggle()"><i class="fa fa-eye"></i></button>
            </div>
            <div class="btn btn-sm btn-group-vertical pr-1" role="group" aria-label="Button group with nested dropdown" id="actions" style="display:none">
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-edit"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                        <?php foreach ($acciones as $key => $accion): ?>
                            <a class="dropdown-item" href="<?=$accion['ruta']?>" target="<?=$accion['target']?>" id="<?=$accion['id']?>"><i class="<?=$accion['icono']?>"></i><?=$accion['etiqueta']?></a>
                        <?php endforeach;?>
                    </div>
                </div>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop2" type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-share"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                        <?php foreach ($seguimiento as $key => $accion): ?>
                            <a class="dropdown-item" href="<?=$accion['ruta']?>" target="<?=$accion['target']?>" id="<?=$accion['id']?>"><i class="<?=$accion['icono']?>"></i><?=$accion['etiqueta']?></a>
                        <?php endforeach;?>
                    </div>
                </div>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop3" type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="pg pg-bag"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop3">
                        <?php foreach ($otros as $key => $accion): ?>
                            <a class="dropdown-item" href="<?=$accion['ruta']?>" target="<?=$accion['target']?>" id="<?=$accion['id']?>"><i class="<?=$accion['icono']?>"></i><?=$accion['etiqueta']?></a>
                        <?php endforeach;?>
                    </div>
                </div>
                <div class="btn-group" role="group">
                    <button type="button" class="btn" data-toggle="modal" data-target=".bd-example-modal-sm">
                        <i class="fa fa-sitemap"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="fixed-bottom">
            <div id="fab"></div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close btn btn-sm" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="esperando_arbol">
                        <img src="<?= $ruta_db_superior ?>imagenes/cargando.gif">
                    </div>
                    <div id="tree_box" class="arbol_saia"></div>
                </div>
            </div>
        </div>
    </div>     
    <script type="text/javascript">
        $(function(){
            var ruta = "<?= $ruta_db_superior ?>formatos/arboles/test_formatos_documento.php?id=<?= $identificador_arbol ?>";
            tree2 = new dhtmlXTreeObject("tree_box","100%","<?= $alto_inicial ?>",0);
            tree2.enableAutoTooltips(1);
            tree2.enableTreeImages("false");
            tree2.enableTreeLines("true");
            tree2.enableTextSigns("true");
            tree2.setOnLoadingStart(cargando);
            tree2.setOnLoadingEnd(fin_cargando);
            tree2.setOnClickHandler(onNodeSelect);
            tree2.loadXML(ruta);
            
            function onNodeSelect(nodeId){
                var llave = tree2.getParentId(nodeId);
                var datos = nodeId.split("-");
                
                if(datos[2][0] == "r"){
                    seleccion_accion('adicionar');
                }else{
                    documento_saia = datos[3];
                    var conexion = "<?=$ruta_db_superior ?>formatos/arboles/parsear_accion_arbol.php?id="+nodeId+"&accion=mostrar&llave="+llave+"&enlace_adicionar_formato=1";
                    window.parent.open(conexion,"detalles");
                }
            }
            function seleccion_accion(accion,id){
                var nodeId = tree2.getSelectedItemId();
                
                if(!nodeId){
                    alert("Por Favor seleccione un documento del arbol");
                    return;
                }

                var llave = tree2.getParentId(nodeId);
                tree2.closeAllItems(tree2.getParentId(nodeId));
                tree2.openItem(nodeId);
                tree2.openItem(tree2.getParentId(nodeId));
                
                var conexion = "<?= $ruta_db_superior ?>formatos/arboles/parsear_accion_arbol.php?id="+nodeId+"&accion="+accion+"&llave="+llave;
                window.parent.open(conexion, "detalles");
            }

            function fin_cargando(){
                $("#esperando_arbol").hide();

                tree2.openAllItems(0); //esta linea permite que los arboles carguen abiertos totalmente
                <?php  if ($_REQUEST['click_mostrar']): ?>
                    var nodeId = tree2.getSelectedItemId();
                    var llave = tree2.getParentId(nodeId);
                    onNodeSelect(nodeId);
                <?php endif; ?>
            }

            function cargando() {
                $("#esperando_arbol").show();
            }
            function actualizar_papa(nodeId){
                var papa = tree2.getParentId(nodeId);
                tree2.closeItem(papa);
                tree2.deleteItem(nodeId,true);
                tree2.findItem(papa);
            }
            
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
        });
    </script>
    <?php
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
                'ruta' => $ruta_db_superior . $modulos[$i]["enlace"],
                'icono' => $modulos[$i]["imagen"],
                'target' => $target,
                'etiqueta' => $modulos[$i]["etiqueta"],
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