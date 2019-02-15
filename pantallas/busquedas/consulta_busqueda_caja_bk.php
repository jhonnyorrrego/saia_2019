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
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
usuario_actual("login");

if (@$_REQUEST["idbusqueda_componente"]) {
    $idbusqueda_componente = $_REQUEST["idbusqueda_componente"];
}
$datos_busqueda = busca_filtro_tabla("", "busqueda A,busqueda_componente B", "A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=" . $idbusqueda_componente, "", $conn);
if ($datos_busqueda[0]["ruta_libreria"]) {
    $librerias = array_unique(explode(",", $datos_busqueda[0]["ruta_libreria"]));
    array_walk($librerias, "incluir_librerias_busqueda");
}
function incluir_librerias_busqueda($elemento, $indice) {
    global $ruta_db_superior;
    include_once ($ruta_db_superior . $elemento);
}

if ($datos_busqueda[0]["busqueda_avanzada"] != '') {
    if (strpos($datos_busqueda[0]["busqueda_avanzada"], "?")) {
        $datos_busqueda[0]["busqueda_avanzada"] .= "&";
    } else {
        $datos_busqueda[0]["busqueda_avanzada"] .= "?";
    }
    $datos_busqueda[0]["busqueda_avanzada"] .= 'idbusqueda_componente=' . $datos_busqueda[0]["idbusqueda_componente"];
}

echo(librerias_html5());
echo(librerias_jquery("1.7"));
echo(estilo_bootstrap());
?>
<meta http-equiv="X-UA-Compatible" content="IE=9">
<link rel="stylesheet" type="text/css" media="screen" href="<?=$ruta_db_superior;?>pantallas/lib/librerias_css.css" />
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
    .alert {
        margin-bottom: 3px;
        padding: 10px;
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
    .texto-azul {
        color: #3176c8
    }

    #panel_body {
        margin-top: 0px;
        overflow: auto; <?= ($_SESSION["tipo_dispositivo"] == 'movil') ? "width:0%; -webkit-overflow-scrolling:touch;" : "width:50%;"; ?>
    }
    #panel_detalle {
        margin-top: 0px;
        border: 0px;
        overflow: auto; <?= ($_SESSION["tipo_dispositivo"] == 'movil') ? "width:0%; -webkit-overflow-scrolling:touch;" : "width:50%;"; ?>
    }
</style>
<div class="navbar navbar-fixed-top" id="menu_buscador">
    <div class="navbar-inner">
        <ul class="nav pull-left">
            <li>
                <div class="btn-group">
                    <button class="btn btn-mini kenlace_saia" titulo="B&uacute;squeda <?php echo($datos_busqueda[0]['etiqueta']);?>" title="B&uacute;squeda <?php echo($datos_busqueda[0]['etiqueta']);?>" conector="iframe" enlace="<?php echo($datos_busqueda[0]['busqueda_avanzada']);?>">B&uacute;squeda &nbsp;</button>
                </div>
            </li>

            <?php if($datos_busqueda[0]["acciones_seleccionados"]!=''):?>
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
                                echo($acciones[$i]());
                            }
                        ?>
                    </ul>
                </div>
            </li>
            <?php
            endif;
            if(@$datos_busqueda[0]["menu_busqueda_superior"]){
                $funcion_menu=explode("@",$datos_busqueda[0]["menu_busqueda_superior"]);
                echo($funcion_menu[0](@$funcion_menu[1]));
            }
            ?>
            <li class="divider-vertical"></li>
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
    <div id="resultado_busqueda_principal<?=$idbusqueda_componente; ?>" class="panel_hidden">
        <div id="resultado_busqueda<?=$idbusqueda_componente; ?>"></div>
        
        <input type="hidden" id="seleccionados" value="" name="seleccionados">
        
        <!-- Registros por pagina -->
        <input type="hidden" value="<?=$datos_busqueda[0]['cantidad_registros']; ?>" name="cantxpage" id="cantxpage">
        <!-- Pagina actual-->
        <input type="hidden" value="1" name="actualpage" id="actualpage">
        <!-- Total Paginas-->
        <input type="hidden" value="1" name="totalpage" id="totalpage">
        <!-- Registro actual -->
        <input type="hidden" value="0" name="actualrow" id="actualrow">
        <!-- Cantidad de registros totales -->
        <input type="hidden" value="0" name="cantidad_total" id="cantidad_total">
        <!-- idbusqueda_componente -->
        <input type="hidden" value="<?=$idbusqueda_componente; ?>" name="idcomponente_caja" id="idcomponente_caja">
        
        <!-- Forma de carga -->
        <input type="hidden" value=<?=(!empty($datos_busqueda[0]["cargar"]) ? $datos_busqueda[0]["cargar"] : 0); ?>" name="forma_carga" id="forma_carga">

        <!-- Variable busqueda -->
        <input type="hidden" value="<?=$_REQUEST["variable_busqueda"]; ?>" name="variable_busqueda" id="variable_busqueda">
        <!-- idbusqueda_filtro_temp -->
        <input type="hidden" value="<?=$_REQUEST["idbusqueda_filtro_temp"]; ?>" name="idbusqueda_filtro_temp" id="idbusqueda_filtro_temp">
        <!-- idbusqueda_filtro -->
        <input type="hidden" value="<?=$_REQUEST["idbusqueda_filtro"]; ?>" name="idbusqueda_filtro" id="idbusqueda_filtro">
        <!-- idbusqueda_temporal -->
        <input type="hidden" value="<?=$_REQUEST["idbusqueda_temporal"]; ?>" name="idbusqueda_temporal" id="idbusqueda_temporal">
        <!-- idcaja -->
        <input type="hidden" value="<?=$_REQUEST["idcaja"]; ?>" name="idcaja" id="idcaja">
    </div>
</div>
<div class="pull-left" id="panel_detalle">
    <iframe id="iframe_detalle" name="iframe_detalle" style="width: 100%;" frameborder="no"></iframe>
</div>

<script type="text/javascript" src="<?php echo($ruta_db_superior."pantallas/lib/main.js");?>"></script>
<script>
    $(document).ready(function() {
        window.parent.$(".block-iframe").attr("style", "margin-top:0px; width: 100%; border:0px solid; overflow:auto; -webkit-overflow-scrolling:touch;");

        var idbusqueda_componente = $("#idcomponente_caja").val();
        var forma_cargar = $("#forma_carga").val();
        var espacio_menu = $("#menu_buscador").height() + 18;

        var alto_inicial = ($(window).height() - espacio_menu);
        var carga_final_caja = false;

        $("#panel_body").height(alto_inicial);
        $("#panel_detalle").height(alto_inicial);
        $("#iframe_detalle").height(alto_inicial);

        cargar_datos_scroll();

        $("#panel_body").scroll(function() {
            if (($("#panel_body").scrollTop() >= $("#resultado_busqueda_principal" + idbusqueda_componente).height() - $("#panel_body").height())) {
                if (!carga_final_caja) {
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

        $(".well").live("mouseenter", function() {
            $(this).addClass("muted");
        });
        $(".well").live("mouseleave", function() {
            $(this).removeClass("muted");
        });

        function cargar_datos_scroll() {
            if (!carga_final_caja) {
                $.ajax({
                    type : 'POST',
                    url : "servidor_busqueda_exp.php",
                    data : {
                        idbusqueda_componente : $("#idcomponente_caja").val(),
                        page : $("#actualpage").val(),
                        rows : $("#cantxpage").val(),
                        actual_row : $("#actualrow").val(),
                        cantidad_total : $("#cantidad_total").val(),
                        variable_busqueda : $("#variable_busqueda").val(),
                        idbusqueda_filtro_temp : $("#idbusqueda_filtro_temp").val(),
                        idbusqueda_filtro : $("#idbusqueda_filtro").val(),
                        idbusqueda_temporal : $("#idbusqueda_temporal").val(),
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
                                    if (objeto.page == 1 && index === 0) {
                                        $("#iframe_detalle").attr({
                                            'src':'<?=$ruta_db_superior;?>pantallas/caja/detalles_caja.php?idcaja='+item.idcaja+"&idbusqueda_componente="+idbusqueda_componente+"&rand=<?=rand();?>",
                                            'height' : ($("#panel_body").height())
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
                                carga_final_caja = true;
                                $('#loadmoreajaxloader').html("Finalizado");
                                $('#loadmoreajaxloader').attr("disabled", true);
                            } else {
                                $('#loadmoreajaxloader').html("M&aacute;s Resultados");
                            }
                        } else {
                            top.noty({
                                text : objeto.mensaje,
                                type : 'error',
                                layout : 'topCenter',
                                timeout : 5000
                            });
                        }
                    },
                    error : function() {
                        top.noty({
                            text : "Error al procesar la solicitud",
                            type : 'error',
                            layout : 'topCenter',
                            timeout : 5000
                        });
                    }
                });
            }
        }

    }); 
</script>

<?php
echo(librerias_bootstrap());
echo(librerias_tooltips());
echo(librerias_acciones_kaiten());

if ($datos_busqueda[0]["ruta_libreria_pantalla"]) {
    $librerias = explode(",", $datos_busqueda[0]["ruta_libreria_pantalla"]);
    foreach ($librerias AS $key => $valor) {
        include_once ($ruta_db_superior . $valor);
    }
}
?>