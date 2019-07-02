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
include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "librerias_saia.php";
include_once $ruta_db_superior . 'assets/librerias.php';
usuario_actual("login");

if (@$_REQUEST["idbusqueda_componente"]) {
    $idbusqueda_componente = $_REQUEST["idbusqueda_componente"];
}
$datos_busqueda = busca_filtro_tabla("", "busqueda A,busqueda_componente B", "A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=" . $idbusqueda_componente, "", $conn);

if ($datos_busqueda[0]["ruta_libreria"]) {
    $librerias = array_unique(explode(",", $datos_busqueda[0]["ruta_libreria"]));
    array_walk($librerias, "incluir_librerias_busqueda");
}
function incluir_librerias_busqueda($elemento, $indice)
{
    global $ruta_db_superior;
    include_once $ruta_db_superior . $elemento;
}

if ($datos_busqueda[0]["busqueda_avanzada"] != '') {
    if (strpos($datos_busqueda[0]["busqueda_avanzada"], "?")) {
        $datos_busqueda[0]["busqueda_avanzada"] .= "&";
    } else {
        $datos_busqueda[0]["busqueda_avanzada"] .= "?";
    }
    $datos_busqueda[0]["busqueda_avanzada"] .= 'idbusqueda_componente=' . $datos_busqueda[0]["idbusqueda_componente"];
}

echo librerias_html5();
echo jquery();
echo estilo_bootstrap();
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
            <?php if($datos_busqueda[0]['busqueda_avanzada']):?>
                <li>
                    <div class="btn-group">
                        <button class="btn btn-mini kenlace_saia" titulo="B&uacute;squeda <?= $datos_busqueda[0]['etiqueta']?>" title="B&uacute;squeda <?=$datos_busqueda[0]['etiqueta']?>" conector="iframe" enlace="<?=$datos_busqueda[0]['busqueda_avanzada']?>">B&uacute;squeda &nbsp;</button>
                    </div>
                </li>
                <li class="divider-vertical"></li>
            <?php
            endif;
            if ($datos_busqueda[0]["acciones_seleccionados"] != '') : ?>
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
                            echo $acciones[$i]();
                        }
                        ?>
                    </ul>
                </div>
            </li>
            <li class="divider-vertical"></li>
            <?php
            endif;
            if ($datos_busqueda[0]["menu_busqueda_superior"]) {
                $funcion_menu = explode("@", $datos_busqueda[0]["menu_busqueda_superior"]);
                echo ($funcion_menu[0](@$funcion_menu[1]));
            }

            if($datos_busqueda[0]["enlace_adicionar"]):?>
                <li>
                    <div class="btn-group">                    
                        <a class="btn btn-mini" href="<?=$ruta_db_superior.$datos_busqueda[0]["enlace_adicionar"]?>" target="iframe_detalle">Adicionar</a>
                    </div>
                </li>
                <li class="divider-vertical"></li>
            <?php endif;?>

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
        <input type="hidden" value="<?= $idbusqueda_componente; ?>" name="idbusqueda_componente" id="idbusqueda_componente">
        <!-- Forma de carga -->
        <input type="hidden" value=<?= !empty($datos_busqueda[0]["cargar"]) ? $datos_busqueda[0]["cargar"] : 0; ?>" name="forma_carga" id="forma_carga">
        <!-- Registro actual -->
        <input type="hidden" value="<?=$_REQUEST['idcaja']?>" name="idcaja" id="idcaja">
        <!-- Cantidad de registros totales -->
    </div>
</div>
<div class="pull-left" id="panel_detalle">
    <iframe id="iframe_detalle" name="iframe_detalle" style="width: 100%; height:100%" frameborder="no"></iframe>
</div>

<script>
    $(document).ready(function() {
        window.parent.$(".block-iframe").attr("style", "margin-top:0px; width: 100%; border:0px solid; overflow:auto; -webkit-overflow-scrolling:touch;");

        var idbusqueda_componente = $("#idbusqueda_componente").val();
        var forma_cargar = $("#forma_carga").val();
        var espacio_menu = $("#menu_buscador").height() + 18;

        var alto_inicial = ($(window).height() - espacio_menu);
        var carga_final = false;
        
        $("#panel_body").height(alto_inicial);
        $("#panel_detalle").height(alto_inicial);
        $("#iframe_detalle").height(alto_inicial);

        cargar_datos_scroll();

        $("#panel_body").scroll(function() {
            if (($("#panel_body").scrollTop() >= $("#resultado_busqueda_principal" + idbusqueda_componente).height() - $("#panel_body").height())) {
                if (!carga_final) {
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
            if (!carga_final) {
                $.ajax({
                    type : 'POST',
                    url : "servidor_busqueda_exp.php",
                    data : {
                        idbusqueda_componente : $("#idbusqueda_componente").val(),
                        page : $("#actualpage").val(),
                        rows : $("#cantxpage").val(),
                        actual_row : $("#actualrow").val(),
                        cantidad_total : $("#cantidad_total").val(),
                        idcaja : $("#idcaja").val()
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
                                        $("#resultado_busqueda" + idbusqueda_componente).prepend(item.info);
                                    } else {
                                        $("#resultado_busqueda" + idbusqueda_componente).append(item.info);
                                    }
                                    if (objeto.page == 1 && index === 0) {
                                        if(item.idcaja){
                                            $('#resultado_pantalla_'+item.idcaja).addClass("alert-warning");
                                            $("#iframe_detalle").attr({
                                                'src':'<?= $ruta_db_superior; ?>pantallas/caja/detalles_caja.php?idcaja='+item.idcaja+"&idbusqueda_componente="+idbusqueda_componente+"&rand=<?= rand(); ?>"
                                            });
                                        }else if(item.idexpediente){
                                            $('#resultado_pantalla_'+item.idexpediente).addClass("alert-warning");
                                            $("#iframe_detalle").attr({
                                                'src':'<?= $ruta_db_superior; ?>pantallas/expediente/detalles_expediente.php?idexpediente='+item.idexpediente+"&idbusqueda_componente="+idbusqueda_componente+"&rand=<?= rand(); ?>"
                                            });
                                        }
                                    }
                                });
                                if (parseInt(objeto.actual_row) < parseInt(objeto.records)) {
                                    scroll = 0;
                                }
                            }

                            if (scroll) {
                                carga_final = true;
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
                            message : "Error al procesar la solicitud",
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
echo (librerias_acciones_kaiten());

if ($datos_busqueda[0]["ruta_libreria_pantalla"]) {
    $librerias = explode(",", $datos_busqueda[0]["ruta_libreria_pantalla"]);
    foreach ($librerias as $key => $valor) {
        include_once($ruta_db_superior . $valor);
    }
}
?>