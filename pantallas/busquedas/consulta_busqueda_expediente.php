<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "librerias_saia.php");
include_once $ruta_db_superior . 'assets/librerias.php';
usuario_actual("login");

if (@$_REQUEST["idbusqueda_componente"]) {
    $idbusqueda_componente = $_REQUEST["idbusqueda_componente"];
}
$datos_busqueda = busca_filtro_tabla("", "busqueda A,busqueda_componente B", "A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=" . $idbusqueda_componente, "", $conn);
$busqueda_documento_expediente = busca_filtro_tabla("", "busqueda_componente A", "A.nombre LIKE 'expediente_documento'", "", $conn);
$busq_docu = busca_filtro_tabla("idbusqueda_componente", "busqueda_componente A", "A.nombre LIKE 'listado_documentos_avanzado'", "", $conn);

if ($datos_busqueda[0]["ruta_libreria"]) {
    $librerias = array_unique(explode(",", $datos_busqueda[0]["ruta_libreria"]));
    array_walk($librerias, "incluir_librerias_busqueda");
}
function incluir_librerias_busqueda($elemento, $indice)
{
    global $ruta_db_superior;
    include_once($ruta_db_superior . $elemento);
}

$okAddAcciones = 0;
$okPermisoAcciones = false;
$idexpediente = '';
if ($_REQUEST["idexpediente"]) {
    $idexpediente = $_REQUEST["idexpediente"];
}

if (!empty($idexpediente)) {
    $Expediente = new Expediente($idexpediente);
    $GLOBALS['Expediente'] = $Expediente;

    $okPermisoAcciones = $Expediente->getAccessUser('a');
    if ($Expediente->nucleo) {
        if ($Expediente->fk_serie) {
            $instance = $Expediente->getSerieFk();
            $Serie = $instance[0];
            if ($Serie->tipo == 2) {
                $okAddAcciones = 1;
            } elseif ($Serie->tipo == 1) {
                $cant = $Serie->getChildren(false, 1, 2);
                if (!count($cant)) {
                    $okAddAcciones = 1;
                }
            }
        }
    } else {
        $okAddAcciones = 1;
    }
}

if ($datos_busqueda[0]["busqueda_avanzada"] != '') {
    if (strpos($datos_busqueda[0]["busqueda_avanzada"], "?")) {
        $datos_busqueda[0]["busqueda_avanzada"] .= "&";
    } else {
        $datos_busqueda[0]["busqueda_avanzada"] .= "?";
    }
    $datos_busqueda[0]["busqueda_avanzada"] .= 'idbusqueda_componente=' . $datos_busqueda[0]["idbusqueda_componente"];
}

echo (librerias_html5());
//echo(librerias_jquery("1.7"));
echo jquery();
echo (estilo_bootstrap());
?>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<link rel="stylesheet" type="text/css" media="screen" href="<?= $ruta_db_superior; ?>pantallas/lib/librerias_css.css" />
<style>
    .row-fluid [class*="span"] {
        min-height: 20px;
    }
    .row-fluid {
        min-height: 20px;
    }
    .well {
        margin-bottom: 3px;
        min-height: 11px;
        padding: 4px;
    }
    body {
        font-size: 12px;
        line-height: 100%;
        margin-top: 35px;
        padding: 0px;
    }
    .navbar-fixed-top, .navbar-fixed-bottom {
        position: fixed;
    }
    .navbar-fixed-top, .navbar-fixed-bottom, .navbar-static-top {
        margin-right: 0px;
        margin-left: 0px;
    }

    #panel_body {
        margin-top: 0px;
        overflow: auto;
        width: 50%;
    }
    #panel_detalle {
        margin-top: 0px;
        border: 0px;
        overflow: auto; 
        width: 50%;
    }
</style>
<div class="navbar navbar-fixed-top" id="menu_buscador">
    <div class="navbar-inner">
        <ul class="nav pull-left">
            <li>
                <div class="btn-group">
                    <button type="button" class="btn btn-mini">
                        Busqueda
                    </button>
                    <button type="button" class="btn dropdown-toggle btn-mini" data-toggle="dropdown">
                        <span class="caret"> </span>&nbsp;
                    </button>
                    <ul class="dropdown-menu" id='lista_busqueda'>
                        <li class="nav-header">
                            Busqueda de:
                        </li>
                        <li>
                            <a href="#" class="kenlace_saia" title="B&uacute;squeda <?= $datos_busqueda[0]['etiqueta']; ?>" conector="iframe" enlace="<?php echo ($datos_busqueda[0]['busqueda_avanzada']); ?>" titulo="Formulario B&uacute;queda">Expedientes</a>
                        </li>
                        <li>
                            <a href="#" class="kenlace_saia" title="B&uacute;squeda Documentos en el Expediente" conector="iframe" enlace="pantallas/documento/busqueda_avanzada_documento.php?idbusqueda_componente=<?= $busq_docu[0]["idbusqueda_componente"]; ?>&idexpediente=<?= $idexpediente; ?>" titulo="Formulario B&uacute;queda">Documentos</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="divider-vertical"></li>
            <?php if ($datos_busqueda[0]["acciones_seleccionados"] != '' && $okAddAcciones && $okPermisoAcciones) : ?>
            <li>
                <div class="btn-group">
                    <button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">
                        Acciones &nbsp; <span class="caret"> </span>&nbsp;
                    </button>
                    <ul class="dropdown-menu" id='listado_seleccionados'>
                        <?php
                        $acciones = explode(",", $datos_busqueda[0]["acciones_seleccionados"]);
                        $cantidad = count($acciones);
                        for ($i = 0; $i < $cantidad; $i++) {
                            echo ($acciones[$i]());
                        }
                        ?>
                    </ul>
                </div>
            </li>
            <li class="divider-vertical"></li>
            <?php
            endif;
            if (@$datos_busqueda[0]["menu_busqueda_superior"]) {
                $funcion_menu = explode("@", $datos_busqueda[0]["menu_busqueda_superior"]);
                echo ($funcion_menu[0](@$funcion_menu[1]));
            }
            ?>
            <li>
                <div class="btn-group">
                    <button type="button" class="btn btn-mini " id="loadmoreajaxloader">
                        Cargando ...
                    </button>
                    <button type="button" class="btn dropdown-toggle btn-mini" data-toggle="dropdown">
                        <span class="caret"> </span>&nbsp;
                    </button>
                    <ul class="dropdown-menu" id='listado_resultados'>
                        <li class="nav-header">
                            Resulta do por P&aacute;gina
                        </li>
                        <li>
                            <a href="#" id="resultado_20" data-cant="20" >Mostrar 20 resultados</a>
                        </li>
                        <li>
                            <a href="#" id="resultado_50" data-cant="50">Mostrar 50 resultados</a>
                        </li>
                        <li>
                            <a href="#" id="resultado_100" data-cant="100">Mostrar 100 resultados</a>
                        </li>
                    </ul>
                </div>
        </ul>
    </div>
</div>

<br/>
<div class="panel_body pull-left" id="panel_body">
    <div id="resultado_busqueda_principal<?= $idbusqueda_componente; ?>" class="panel_hidden">
        <div id="resultado_busqueda<?= $idbusqueda_componente; ?>"></div>
        <div id="resultado_busqueda<?= $busqueda_documento_expediente[0]["idbusqueda_componente"]; ?>"></div>

        <input type="hidden" id="seleccionados" value="" name="seleccionados">
        <input type="hidden" id="seleccionados_expediente" value="" name="seleccionados_expediente">

        <!-- Registros por pagina -->
        <input type="hidden" value="<?= $datos_busqueda[0]['cantidad_registros']; ?>" name="cantxpage" id="cantxpage">
        <!-- Pagina actual-->
        <input type="hidden" value="1" name="actualpage" id="actualpage">
        <!-- Total Paginas-->
        <input type="hidden" value="1" name="totalpage" id="totalpage">
        <!-- Registro actual -->
        <input type="hidden" value="0" name="actualrow" id="actualrow">
        <!-- Cantidad de registros totales -->
        <input type="hidden" value="0" name="cantidad_total" id="cantidad_total">
        <!-- idbusqueda_componente -->
        <input type="hidden" value="<?= $idbusqueda_componente; ?>" name="idcomponente_exp" id="idcomponente_exp">
        <input type="hidden" value="<?= $busqueda_documento_expediente[0]['idbusqueda_componente']; ?>" name="idcomponente_exp_doc" id="idcomponente_exp_doc">
        <!-- Forma de carga -->
        <input type="hidden" value=<?= (!empty($datos_busqueda[0]["cargar"]) ? $datos_busqueda[0]["cargar"] : 0); ?>" name="forma_carga" id="forma_carga">

        <!-- idexpediente -->
        <input type="hidden" value="<?= $idexpediente; ?>" name="idexpediente" id="idexpediente">

        <!-- Variable busqueda -->
        <input type="hidden" value="<?= $_REQUEST["variable_busqueda"]; ?>" name="variable_busqueda" id="variable_busqueda">

        <?php
        /*
        <!-- idbusqueda_filtro_temp -->
        <input type="hidden" value="<?=$_REQUEST["idbusqueda_filtro_temp"]; ?>" name="idbusqueda_filtro_temp" id="idbusqueda_filtro_temp">
        <!-- idbusqueda_filtro -->
        <input type="hidden" value="<?=$_REQUEST["idbusqueda_filtro"]; ?>" name="idbusqueda_filtro" id="idbusqueda_filtro">
        <!-- idbusqueda_temporal -->
        <input type="hidden" value="<?=$_REQUEST["idbusqueda_temporal"]; ?>" name="idbusqueda_temporal" id="idbusqueda_temporal">
        
        <!-- idcaja -->
        <input type="hidden" value="<?=$_REQUEST["idcaja"]; ?>" name="idcaja" id="idcaja">*/
        ?>
    </div>
</div>
<div class="pull-left" id="panel_detalle">
    <iframe id="iframe_detalle" name="iframe_detalle" style="width: 100%; height:100%" frameborder="no"></iframe>
</div>

<script>
    $(document).ready(function() {
        window.parent.$(".block-iframe").attr("style", "margin-top:0px; width: 100%; border:0px solid; overflow:auto; -webkit-overflow-scrolling:touch;");

        var idbusqueda_componente = $("#idcomponente_exp").val();
        var idbusqueda_componente_doc = $("#idcomponente_exp_doc").val();
        var forma_cargar = $("#forma_carga").val();
        var espacio_menu = $("#menu_buscador").height() + 18;

        var alto_inicial = ($(window).height() - espacio_menu);
        var carga_final_exp = false;
        var carga_final_doc = false;

        $("#panel_body").height(alto_inicial);
        $("#panel_detalle").height(alto_inicial);
        $("#iframe_detalle").height(alto_inicial);

        cargar_datos_scroll();

        $("#panel_body").scroll(function() {
            if (($("#panel_body").scrollTop() >= $("#resultado_busqueda_principal" + idbusqueda_componente).height() - $("#panel_body").height())) {
                if (!carga_final_exp || !carga_final_doc) {
                    cargar_datos_scroll();
                }
            }
        });

        $('#loadmoreajaxloader').click(function() {
            cargar_datos_scroll();
        });

        $("#resultado_20,#resultado_50,#resultado_100").click(function() {
            $("#cantxpage").val($(this).data("cant"));
            cargar_datos_scroll();
        });

        function cargar_datos_scroll() {
            if (!carga_final_exp) {
                $.ajax({
                    type : 'POST',
                    url : "servidor_busqueda_exp.php",
                    data : {
                        idbusqueda_componente : $("#idcomponente_exp").val(),
                        page : $("#actualpage").val(),
                        rows : $("#cantxpage").val(),
                        actual_row : $("#actualrow").val(),
                        cantidad_total : $("#cantidad_total").val(),
                        variable_busqueda : $("#variable_busqueda").val(),
                        idexpediente : $("#idexpediente").val()
                    },
                    dataType : 'json',
                    async : false, // Si se quita al bajar el scroll llama dos veces o mas la peticion
                    success : function(objeto) {
                        if (objeto.exito) {
                            let scroll = 1;
                            if (objeto.exito == 1) {
                                $("#actualpage").val(objeto.page);
                                $("#totalpage").val(objeto.total_pages);
                                $("#actualrow").val(objeto.actual_row);
                                $("#cantidad_total").val(objeto.records);

                                $.each(objeto.rows, function(index, item) {
                                    if (objeto.page == 1 && index === 0) {
                                        $("#iframe_detalle").attr({
                                            'src':'<?= $ruta_db_superior; ?>pantallas/expediente/detalles_expediente.php?idexpediente='+item.idexpediente+"&idbusqueda_componente="+idbusqueda_componente+"&rand=<?= rand(); ?>"
                                        });
                                    }
                                    if (forma_cargar == 1) {
                                        $("#resultado_busqueda" + idbusqueda_componente).prepend(item.info);
                                    } else {
                                        $("#resultado_busqueda" + idbusqueda_componente).append(item.info);
                                    }
                                });
                                if (parseInt(objeto.actual_row) < parseInt(objeto.records)) {
                                    scroll = 0;
                                }
                            }
                            if (scroll) {
                                carga_final_exp = true;
                                $("#actualpage").val("1");
                                $("#totalpage").val("1");
                                $("#actualrow").val("0");
                                $("#cantidad_total").val("0");
                                cargar_datos_scroll2();
                            } else {
                                $('#loadmoreajaxloader').html("M&aacute;s Resultados");
                            }
                        } else {
                            top.notification({
                                message : objeto.mensaje,
                                type : "error",
                                duration : 3000
                            });
                        }
                    },
                    error : function() {
                        top.notification({
                            message : "Error al procesar la solicitud",
                            type : "error",
                            duration : 3000
                        });
                    }
                });
            }
        }

        function cargar_datos_scroll2() {
            if (!carga_final_doc) {
                $.ajax({
                    type : 'POST',
                    url : "servidor_busqueda_exp.php",
                    data : {
                        idbusqueda_componente : $("#idcomponente_exp_doc").val(),
                        page : $("#actualpage").val(),
                        rows : $("#cantxpage").val(),
                        actual_row : $("#actualrow").val(),
                        cantidad_total : $("#cantidad_total").val(),
                        variable_busqueda : $("#variable_busqueda").val(),
                        idexpediente : $("#idexpediente").val()
                    },
                    dataType : 'json',
                    async : false, // Si se quita al bajar el scroll llama dos veces o mas la peticion
                    success : function(objeto) {
                        if (objeto.exito) {
                            let scroll = 1;
                            if (objeto.exito == 1) {
                                $("#actualpage").val(objeto.page);
                                $("#totalpage").val(objeto.total_pages);
                                $("#actualrow").val(objeto.actual_row);
                                $("#cantidad_total").val(objeto.records);

                                $.each(objeto.rows, function(index, item) {
                                    if (forma_cargar == 1) {
                                        $("#resultado_busqueda" + idbusqueda_componente_doc).prepend(item.info);
                                    } else {
                                        $("#resultado_busqueda" + idbusqueda_componente_doc).append(item.info);
                                    }
                                });
                                if (parseInt(objeto.actual_row) < parseInt(objeto.records)) {
                                    scroll = 0;
                                }
                            }

                            if (scroll) {
                                carga_final_doc = true;
                                $('#loadmoreajaxloader').html("Finalizado");
                                $('#loadmoreajaxloader').attr("disabled", true);
                            } else {
                                $('#loadmoreajaxloader').html("M&aacute;s Resultados");
                            }
                        } else {
                            top.notification({
                                message : objeto.mensaje,
                                type : "error",
                                duration : 3000
                            });
                        }
                    },
                    error : function() {
                        top.notification({
                            message : "Error al procesar la solicitud documento",
                            type : "error",
                            duration : 3000
                        });
                    }
                });

            }
        }

    }); 
</script>

<?php

echo (librerias_bootstrap());
//echo (librerias_tooltips());
echo (librerias_acciones_kaiten());

if ($datos_busqueda[0]["ruta_libreria_pantalla"]) {
    $librerias = explode(",", $datos_busqueda[0]["ruta_libreria_pantalla"]);
    foreach ($librerias as $key => $valor) {
        include_once($ruta_db_superior . $valor);
    }
}
?>