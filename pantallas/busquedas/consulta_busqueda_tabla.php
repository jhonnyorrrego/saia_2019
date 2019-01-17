<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once($ruta_db_superior . "db.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Consulta de informaci&oacute;n</title>
        <?php
        include_once ($ruta_db_superior . "librerias_saia.php");
        include_once ($ruta_db_superior . "pantallas/documento/librerias.php");
        include_once($ruta_db_superior . "assets/librerias.php");
        echo (librerias_html5());
        echo jquery();
        echo bootstrap();
        echo theme();
        echo librerias_notificaciones();
        echo estilo_tabla_bootstrap("1.13");

        $funciones = array();
        $datos_componente = $_REQUEST["idbusqueda_componente"];
        $datos_busqueda = busca_filtro_tabla("", "busqueda A,busqueda_componente B", "A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=" . $datos_componente, "", $conn);
        


        if ($datos_busqueda[0]["ruta_libreria"]) {
            $librerias = array_unique(explode(",", $datos_busqueda[0]["ruta_libreria"]));
            array_walk($librerias, "incluir_librerias_busqueda");
        }

        function incluir_librerias_busqueda($elemento, $indice) {
            global $ruta_db_superior;
            include_once ($ruta_db_superior . $elemento);
        }

        $exportar = !empty($datos_busqueda[0]["exportar"]);

        echo librerias_tabla_bootstrap("1.13", false, false);
        ?>
        <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
        <style>
            #barra_exportar_ppal{ margin-right:50px;}
            .progress{margin-bottom: 0px;}

            .pagination-detail {
                font-size: 10px;
            }

            .page-size {
                font-size: 10px;
            }
            .pagination{font-size: 10px;}
            .dropdown-submenu {
                position: relative;
            }

            .dropdown-submenu .dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -1px;
            }
            select.btn{ 
                border:2px lightgray solid;
            }
            .table thead tr th {
                color: darkslategray;
            }
            .page-item.active .page-link{
                background-color: #48b0f7;
                border-color: #48b0f7;
            }
        </style>
    </head>
    <body>
        <div class="container" style="width:auto;">
            <div class="row">
                <form class="formulario_busqueda" accept-charset="UTF-8" action="" id="kformulario_saia" name="kformulario_saia" method="post" style="padding:0px;margin:0px;">
                    <input type="hidden" value="<?php echo($datos_busqueda[0]['cantidad_registros']); ?>" name="busqueda_total_registros" id="busqueda_registros">
                    <input type="hidden" name="sord" id="sord" value="desc">
                    <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?php echo(@$_REQUEST["idbusqueda_componente"]); ?>">
                    <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
                    <input type="hidden" name="idbusqueda_filtro_temp" id="idbusqueda_filtro_temp" value="<?php echo(@$_REQUEST["idbusqueda_filtro_temp"]); ?>">
                    <input type="hidden" name="busqueda_total_paginas" id="busqueda_total_paginas" value="">
                    <input type="hidden" value="<?php echo(@$_REQUEST["variable_busqueda"]); ?>" name="variable_busqueda" id="variable_busqueda">
                    <input type="hidden" name="rows" id="rows" value="20">
                </form>
            </div>
            <div id="div_resultados">
                <div class="btn-group" id="menu_buscador">
<?php
if ($datos_busqueda[0]["busqueda_avanzada"] != '') {
    if (strpos($datos_busqueda[0]["busqueda_avanzada"], "?")) {
        $datos_busqueda[0]["busqueda_avanzada"] .= "&";
    } else {
        $datos_busqueda[0]["busqueda_avanzada"] .= "?";
    }
    $datos_busqueda[0]["busqueda_avanzada"] .= 'idbusqueda_componente=' . $datos_busqueda[0]["idbusqueda_componente"];
    ?>
                        <button class="pull-left btn btn-xs btn-complete kenlace_saia" titulo="B&uacute;squeda <?php echo($datos_busqueda[0]['etiqueta']); ?>" title="B&uacute;squeda <?php echo($datos_busqueda[0]['etiqueta']); ?>" conector="iframe" enlace="<?php echo($datos_busqueda[0]['busqueda_avanzada']); ?>">B&uacute;squeda &nbsp;</button>
                        <?php
                    }
                    $tiene_acciones = !empty($datos_busqueda[0]["acciones_seleccionados"]);
                    if ($tiene_acciones) {
                        $acciones_selecionados = '';
                        if ($datos_busqueda[0]["acciones_seleccionados"] != '') {
                            $datos_reporte = array();
                            $datos_reporte['idbusqueda_componente'] = $datos_busqueda[0]["idbusqueda_componente"];
                            $datos_reporte['variable_busqueda'] = @$_REQUEST["variable_busqueda"];
                            $acciones = explode(",", $datos_busqueda[0]["acciones_seleccionados"]);
                            $cantidad = count($acciones);
                            for ($i = 0; $i < $cantidad; $i++) {
                                echo $acciones[$i]($datos_reporte);
                            }
                        }
                        ?>
                        <?php
                    }
                    if (@$datos_busqueda[0]["enlace_adicionar"]) {
                        ?>
                        <button class="btn btn-xs kenlace_saia" conector="iframe" id="adicionar_pantalla" destino="_self" title="Adicionar <?php echo($datos_busqueda[0]["etiqueta"]); ?>" titulo="Adicionar <?php echo($datos_busqueda[0]["etiqueta"]); ?>" enlace="<?php echo($datos_busqueda[0]["enlace_adicionar"]); ?>">Adicionar</button></div></li>
                        <?php
                    }/* if(@$datos_busqueda[0]["menu_busqueda_superior"]){
                      $funcion_menu=explode("@",$datos_busqueda[0]["menu_busqueda_superior"]);
                      echo($funcion_menu[0](@$funcion_menu[1]));
                      } */
                    if (@$datos_busqueda[0]["menu_busqueda_superior"]) {
                        $funcion_menu = explode("@", $datos_busqueda[0]["menu_busqueda_superior"]);
                        echo($funcion_menu[0](@$funcion_menu[1]));
                    }
                    ?>
                <button class="btn btn-xs btn-complete exportar_reporte_saia" enlace="pantallas/documento/busqueda_avanzada_documento.php" title="Exportar reporte" id="boton_exportar_excel" style="">Exportar</button>
                <div class="pull-right" valign="middle"><iframe name="iframe_exportar_saia" id="iframe_exportar_saia" allowtransparency="1" frameborder="0" framespacing="2px" scrolling="no" width="100%" src=""  hspace="0" vspace="0" height="32px"></iframe></div>
                <?php
                $llave = null;
                preg_match("/(\w*)\.(\w*)/", $datos_busqueda[0]["llave"], $valor_campos);
                if (!empty($valor_campos)) {
                    $llave = $valor_campos[2];
                } else {
                    $llave = trim($datos_busqueda[0]["llave"]);
                }
                if (empty($llave)) {
                    $campos = explode(",", $datos_busqueda[0]["campos"]);
                    $llave = trim($campos[0]);
                }
                ?>
            </div>
            <table id="tabla_resultados"
                   data-height=""
                   data-pagination="true"
                   data-toolbar="#menu_buscador"
                   data-show-refresh="true"
                   data-maintain-selected="true"
                   >
                <thead style="font-size: 12px;">
                    <tr>
                        <th data-field="state" data-checkbox="true"></th>
<?php
$lcampos1 = $datos_busqueda[0]["campos"];
if ($datos_busqueda[0]["campos_adicionales"]) {
    $lcampos1 .= ',' . $datos_busqueda[0]["campos_adicionales"];
}
$lcampos2 = explode(",", $lcampos1);
$lcampos = array();
foreach ($lcampos2 as $key => $valor) {
    if (strpos($valor, ".")) {
        $valor_campos = explode(".", $valor);
        array_push($lcampos, trim($valor_campos[count($valor_campos) - 1]));
    } else {
        array_push($lcampos, trim($valor));
    }
}
$info = explode("|-|", $datos_busqueda[0]["info"]);
$can_info = count($info);
for ($i = 0; $i < $can_info; $i++) {
    $ordenable = "";
    $detalle_info = explode("|", $info[$i]);
    $dato_campo = str_replace(array(
        "{*",
        "*}"
            ), "", $detalle_info[1]);
    if (!in_array($dato_campo, $lcampos)) {
        $funcion = explode("@", $dato_campo);
        $dato_campo = $funcion[0];
    } else {
        $ordenable = 'data-sortable="true"';
    }
    echo ('<th data-field="' . $dato_campo . '" data-align="' . $detalle_info[2] . '" ' . $ordenable . '>' . $detalle_info[0] . '</th>');
}
?>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="cargando"></div>
    </body>
</html>

<?php if ($_SESSION["tipo_dispositivo"] == "movil") { ?>
    <script>//Utilizado por que el menu del dropdown aparece y se oculta y no deja seleccionar
        $(document).ready(function ($) {
            $("#acciones_sel").click(function (e) {
                //$(this).next('ul.dropdown-menu').css("display", "block");
            });
        });
    </script>
<?php } ?>

<script>
    var $table = $('#tabla_resultados');
    var llave = "<?php echo($llave); ?>";
//var selections = [];
    var selections = [[0, -1]];
    var paginaActual = 1;

    $body = $("body");

    $(document).on({
        ajaxStart: function () {
            $body.addClass("loading");
        },
        ajaxStop: function () {
            $body.removeClass("loading");
        }
    });
    function jsonConcat(o1, o2) {
        for (var key in o2) {
            o1[key] = o2[key];
        }
        return o1;
    }
    $.fn.serializeObject = function () {
        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };

    $(document).ready(function () {
        //var alto=$(window).height()-80;
        $(".select_mensajeros_ditribucion").select2();
        $table.bootstrapTable({
            method: 'get',
            cache: false,
            height: getHeight(),
            striped: true,
            pagination: true,
            minimumCountColumns: 1,
            clickToSelect: true,
            sidePagination: 'server',
            pageSize: $("#rows").val(),
            search: false,
            cardView: false,
            pageList: [5, 10, 25, 50, 100],
            paginationVAlign: 'top',
            showColumns: true,
            maintainSelected: true,
            idField: llave,
            sortable: true,
            responseHandler: "responseHandler",
            icons: {
                refresh: 'fa-refresh',
                toggle: 'fa-cogs',
                columns: 'fa-th-list',
                advancedSearchIcon: 'fa-search'
            },
            rowStyle: function rowStyle(row, index) {
                return {
                    classes: 'text-nowrap another-class',
                    css: {"font-size": "10px"}
                };
            },

        });

        $table.on('check.bs.table uncheck.bs.table ' +
                'check-all.bs.table uncheck-all.bs.table', function () {

                    // save your data, here just save the current page
                    selections[paginaActual] = getIdSelections();
                    // push or splice the selections if you want to save all data selections
                });
    });

    function responseHandler(res) {
        var options = $table.bootstrapTable('getOptions');

        //Get the page number
        paginaActual = options.pageNumber;

        var total = res.records;
        res.total = total;
        if (res.rows) {
            $.each(res.rows, function (i, row) {
                row.state = $.inArray(row[llave], selections[paginaActual]) !== -1;
            });
        }
        return res;
    }

    function getIdSelections() {
        return $.map($table.bootstrapTable('getSelections'), function (row) {
            return row[llave];
        });
    }

    function procesamiento_buscar(externo) {
        var data = $('#kformulario_saia').serializeObject();
        $('#tabla_resultados').bootstrapTable('refreshOptions', {
            url: 'servidor_busqueda.php',
            queryParams: function (params) {
                var pagina = 1;
                var filas = params.limit;
                if (filas > 0) {
                    pagina = (params.offset / $("#rows").val()) + 1
                }
                var q = {
                    "rows": filas,
                    "numfilas": filas,
                    "actual_row": params.offset,
                    "pagina": pagina,
                    "search": params.search,
                    "sort": params.sort,
                    "order": params.order,
                    "cantidad_total": $("#busqueda_total_paginas").val(),
                    "sidx": params.sort,
                    "sord": params.order
                };
                $.extend(data, q);
                return data;
            },
            onLoadSuccess: function (data) {
                $("#busqueda_total_paginas").val(data.total);
            }
        });
        return false;
    }

    function getHeight() {
        return $(window).height() - $('h1').outerHeight(true);
    }

    $(document).keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            $("#ksubmit_saia").click();
        }
    });

    $(document).ready(function () {
        $("#filtrar_seleccionados").click(function () {
            alert('getSelections: ' + JSON.stringify($("#tabla_resultados").bootstrapTable('getSelections')));
        });
        procesamiento_buscar();
        $("#kformulario_saia").submit(function () {
            procesamiento_buscar();
            return true;
        });

        $(".exportar_reporte_saia").click(function (obj) {
            isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
            // Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
            isFirefox = typeof InstallTrigger !== 'undefined';   // Firefox 1.0+
            isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
            // At least Safari 3+: "[object HTMLElementConstructor]"
            isChrome = !!window.chrome && !isOpera;              // Chrome 1+
            isIE = /*@cc_on!@*/false || !!document.documentMode;   // At least IE6
            if (isChrome || isIE) {
                var busqueda_total = $("#busqueda_total_paginas").val();
                if (parseInt(busqueda_total) != 0) {
                    notificacion_saia('Espere un momento por favor, hasta que se habilite el enlace de descarga', 'success', '', 9500);
                }
            }
            exportar_funcion_excel_reporte();
        });

        function exportar_funcion_excel_reporte() {
            var busqueda_total = $("#busqueda_total_paginas").val();
            if (parseInt(busqueda_total) != 0) {
<?php
$ruta_temporal = $_SESSION["ruta_temp_funcionario"];
?>
                var ruta_file = "<?php echo($ruta_temporal); ?>/reporte_<?php echo($datos_busqueda[0]["nombre"] . '_' . date('Ymd') . '.xls'); ?>";
                                var url = "exportar_saia.php?tipo_reporte=1&idbusqueda_componente=<?php echo $datos_busqueda[0]["idbusqueda_componente"]; ?>&page=1&exportar_saia=excel&ruta_exportar_saia=" + ruta_file + "&rows=" + $("#busqueda_registros").val() * 4 + "&actual_row=0&variable_busqueda=" + $("#variable_busqueda").val() + "&idbusqueda_filtro_temp=<?php echo(@$_REQUEST['idbusqueda_filtro_temp']); ?>&idbusqueda_filtro=<?php echo(@$_REQUEST['idbusqueda_filtro']); ?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']); ?>";
                                window.open(url, "iframe_exportar_saia");
                            } else {
                                notificacion_saia('<b>ATENCI&Oacute;N</b><br>No hay registros para exportar', 'warning', '', 2000);
                            }
                        }
                    });

</script>
<?php
echo(librerias_tooltips());
echo(librerias_acciones_kaiten());

if ($datos_busqueda[0]["ruta_libreria_pantalla"]) {
    $librerias = explode(",", $datos_busqueda[0]["ruta_libreria_pantalla"]);
    foreach ($librerias AS $key => $valor) {
        include_once($ruta_db_superior . $valor);
    }
}
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior . "pantallas/lib/main.js"); ?>"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior . "pantallas/lib/librerias_ventana_modal.js"); ?>"></script>
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
