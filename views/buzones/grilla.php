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

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";
include_once $ruta_db_superior . "pantallas/documento/librerias.php";

$componentId = $_REQUEST["idbusqueda_componente"];
$sql = <<<SQL
    SELECT 
        *
    FROM 
        busqueda A,
        busqueda_componente B
    WHERE
        A.idbusqueda=B.busqueda_idbusqueda AND
        B.idbusqueda_componente= {$componentId}

SQL;
$datos_busqueda = StaticSql::search($sql);

$phpLibraries = explode(",", $datos_busqueda[0]["ruta_libreria"]);
$jsLibraries = explode(",", $datos_busqueda[0]["ruta_libreria_pantalla"]);
$libraries = array_merge($phpLibraries, $jsLibraries);

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

$btn_search = $btn_add = $actions = '';

if ($datos_busqueda[0]["busqueda_avanzada"]) {
    $datos_busqueda[0]["busqueda_avanzada"] .= '?idbusqueda_componente=' . $componentId;
    $btn_search = "<button class='btn btn-secondary' title='Buscar' id='btn_search' data-url='{$datos_busqueda[0]["busqueda_avanzada"]}'>
        <i class='fa fa-search'></i>
    </button>";
}

if ($datos_busqueda[0]["enlace_adicionar"]) {
    if(strpos($datos_busqueda[0]["enlace_adicionar"], '?') === false){
        $datos_busqueda[0]["enlace_adicionar"] .= '?idbusqueda_componente=' . $componentId;
    }else{
        $datos_busqueda[0]["enlace_adicionar"] .= '&idbusqueda_componente=' . $componentId;
    }  
    $btn_add = "<button class='btn btn-secondary' title='Adicionar' id='btn_add' data-url='{$datos_busqueda[0]["enlace_adicionar"]}'>
        <i class='fa fa-plus'></i>
        <span class='d-none d-sm-inline'>Adicionar</span>
    </button>";
}

if (!empty($datos_busqueda[0]["acciones_seleccionados"])) {
    $datos_reporte = [
        'idbusqueda_componente' => $componentId,
        'variable_busqueda' => @$_REQUEST["variable_busqueda"]
    ];

    $acciones = explode(",", $datos_busqueda[0]["acciones_seleccionados"]);
    foreach ($acciones as $key => $value) {
        $actions = $value($datos_reporte);
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Consulta de información</title>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= theme() ?>

    <link rel="stylesheet" href="<?= $ruta_db_superior ?>views/buzones/css/grilla.css">

    <?php

    foreach ($libraries as $key => $ruta) {
        include_once $ruta_db_superior . $ruta;
    }

    ?>
</head>

<body>
    <div class="container-fluid mw-100 px-3" style="overflow-y:auto;height:100%">
        <div class="row">
            <div class="col-12">
                <form class="formulario_busqueda" accept-charset="UTF-8" action="" id="kformulario_saia" name="kformulario_saia" method="post" style="padding:0px;margin:0px;">
                    <input type="hidden" value="<?= $datos_busqueda[0]['cantidad_registros'] ?>" name="busqueda_total_registros" id="busqueda_registros">
                    <input type="hidden" name="sord" id="sord" value="desc">
                    <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?= $componentId ?>">
                    <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
                    <input type="hidden" name="idbusqueda_filtro_temp" id="idbusqueda_filtro_temp" value="<?= $_REQUEST["idbusqueda_filtro_temp"] ?>">
                    <input type="hidden" name="idbusqueda_temporal" id="idbusqueda_temporal">
                    <input type="hidden" name="busqueda_total_paginas" id="busqueda_total_paginas" value="">
                    <input type="hidden" value="<?= $_REQUEST["variable_busqueda"] ?>" name="variable_busqueda" id="variable_busqueda">
                    <input type="hidden" name="rows" id="rows" value="20">
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="div_resultados">
                <div id="menu_buscador">
                    <?= $btn_search ?>
                    <?= $actions ?>
                    <?= $btn_add ?>

                    <button class="btn btn-secondary" title="Descargar" id="boton_exportar_excel">
                        <i class="fa fa-download"></i>
                    </button>
                    <div class="pull-right d-none" valign="middle">
                        <iframe name="iframe_exportar_saia" id="iframe_exportar_saia" allowtransparency="1" frameborder="0" framespacing="2px" scrolling="no" width="10%" src="" hspace="0" vspace="0" height="40px"></iframe>
                    </div>
                </div>
                <table id="tabla_resultados" data-pagination="true" data-toolbar="#menu_buscador" data-show-refresh="true" data-maintain-selected="true">
                    <thead>
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

                                echo '<th data-field="' . $dato_campo . '" data-align="' . $detalle_info[2] . '" ' . $ordenable . '>' . $detalle_info[0] . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="cargando"></div>
            </div>
        </div>
    </div>

    <?= bootstrapTable() ?>
    <?= icons() ?>
    <?= select2() ?>
    <script data-baseurl="<?= $ruta_db_superior ?>">
        $.fn.serializeObject = function() {
            var o = {};
            var a = this.serializeArray();
            $.each(a, function() {
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

        var baseUrl = "<?= $ruta_db_superior ?>";
        var $table = $('#tabla_resultados');
        var $body = $("body");
        var llave = "<?= $llave ?>";
        var selections = [
            [0, -1]
        ];
        var paginaActual = 1;

        function responseHandler(res) {
            var options = $table.bootstrapTable('getOptions');
            paginaActual = options.pageNumber;

            res.total = res.records;
            if (res.rows) {
                $.each(res.rows, function(i, row) {
                    row.state = $.inArray(row[llave], selections[paginaActual]) !== -1;
                });
            } else {
                res.rows = [];
            }

            return res;
        }

        $(document).ready(function() {
            $table.bootstrapTable({
                method: 'get',
                classes: "table table-hover table-bordered mt-0",
                theadClasses: "thead-light",
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
                paginationVAlign: 'bottom',
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
                rowStyle: () => {
                    return {
                        classes: 'text-nowrap',
                        css: {
                            "font-size": "11px"
                        }
                    };
                },
            });

            $table.on('check.bs.table uncheck.bs.table check-all.bs.table uncheck-all.bs.table', () => {
                selections[paginaActual] = getIdSelections();
            });

            procesamiento_buscar();
            $("#kformulario_saia").on('submit', function() {
                procesamiento_buscar();
            });

            $("#btn_search").on('click', function() {
                top.topModal({
                    url: baseUrl + $(this).data('url'),
                    size: 'modal-xl',
                    title: 'Búsqueda',
                    buttons: {
                        success: {
                            label: "Buscar",
                            class: "btn btn-complete"
                        },
                        cancel: {
                            label: "Cerrar",
                            class: "btn btn-danger"
                        }
                    },
                    onSuccess: function(data) {
                        let params = getParams(data.url);
                        $('#idbusqueda_componente').val(params.idbusqueda_componente || '');
                        $('#idbusqueda_filtro_temp').val(params.idbusqueda_filtro_temp || '');
                        $('#idbusqueda_temporal').val(params.idbusqueda_temporal || '');
                        $('#busqueda_total_paginas').val(null);

                        procesamiento_buscar();
                        top.closeTopModal();
                    }
                });
            });

            $("#btn_add").on('click', function() {
                top.topModal({
                    url: baseUrl + $(this).data('url'),
                    size: 'modal-xl',
                    title: 'Crear',
                    onSuccess: function() {
                        top.closeTopModal();
                        $table.bootstrapTable("refresh");
                    },
                    buttons: {
                        success: {
                            label: "Guardar",
                            class: "btn btn-complete"
                        },
                        cancel: {
                            label: "Cancelar",
                            class: "btn btn-danger"
                        }
                    }
                });
            });

            $("#boton_exportar_excel").click(function(obj) {
                isOpera = !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;
                // Opera 8.0+ (UA detection to detect Blink/v8-powered Opera)
                isFirefox = typeof InstallTrigger !== 'undefined'; // Firefox 1.0+
                isSafari = Object.prototype.toString.call(window.HTMLElement).indexOf('Constructor') > 0;
                // At least Safari 3+: "[object HTMLElementConstructor]"
                isChrome = !!window.chrome && !isOpera; // Chrome 1+
                isIE = /*@cc_on!@*/ false || !!document.documentMode; // At least IE6
                if (isChrome || isIE) {
                    var busqueda_total = $("#busqueda_total_paginas").val();
                    if (parseInt(busqueda_total) != 0) {
                        top.notification({
                            message: 'Espere un momento por favor, hasta que se habilite el boton de descarga <i class="fa fa-download></i>',
                            type: 'success'
                        });
                    }
                }
                exportar_funcion_excel_reporte();
            });

            $(document).keypress(function(event) {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    $("#ksubmit_saia").click();
                }
            });

            $(document).on({
                ajaxStart: function() {
                    $body.addClass("loading");
                },
                ajaxStop: function() {
                    $body.removeClass("loading");
                }
            });

            function getParams(url) {
                let queryString = url.split('?')[1];
                let portions = queryString.split('&');
                let params = new Object();

                portions.forEach(p => {
                    let param = p.split('=');
                    params[param[0]] = param[1];
                });

                return params;
            }
            
            function getIdSelections() {
                return $.map($table.bootstrapTable('getSelections'), function(row) {
                    return row[llave];
                });
            }

            function procesamiento_buscar(externo) {
                var data = $('#kformulario_saia').serializeObject();
                $('#tabla_resultados').bootstrapTable('refreshOptions', {
                    url: `${baseUrl}pantallas/busquedas/servidor_busqueda_exp.php`,
                    queryParams: function(params) {
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
                            "sord": params.order,
                            "key": localStorage.getItem("key"),
                            "token": localStorage.getItem("token")
                        };
                        $.extend(data, q);
                        return data;
                    },
                    onLoadSuccess: function(data) {
                        $("#busqueda_total_paginas").val(data.total);
                    }
                });
                return false;
            }

            function getHeight() {
                return $(window).height() - $('h1').outerHeight(true);
            }

            function exportar_funcion_excel_reporte() {
                var busqueda_total = $("#busqueda_total_paginas").val();
                if (parseInt(busqueda_total) != 0) {
                    var ruta_file = "<?= SessionController::getTemporalDir() ?>/reporte_<?= $datos_busqueda[0]["nombre"] . '_' . date('Ymd') . '.xls' ?>";
                    var url = "<?= $ruta_db_superior ?>pantallas/busquedas/exportar_saia.php?tipo_reporte=1&idbusqueda_componente=<?= $componentId ?>&page=1&exportar_saia=excel&ruta_exportar_saia=" + ruta_file + "&rows=" + $("#busqueda_registros").val() * 4 + "&actual_row=0&variable_busqueda=" + $("#variable_busqueda").val() + "&idbusqueda_filtro_temp=<?php echo (@$_REQUEST['idbusqueda_filtro_temp']); ?>&idbusqueda_filtro=<?php echo (@$_REQUEST['idbusqueda_filtro']); ?>&idbusqueda_temporal=<?php echo (@$_REQUEST['idbusqueda_temporal']); ?>";
                    window.open(url, "iframe_exportar_saia");
                    $('#iframe_exportar_saia').parent().removeClass('d-none');
                } else {
                    top.notification({
                        message: 'ATENCIÓN! No hay registros para exportar',
                        type: 'warning'
                    });
                }
            }
        });
    </script>
</body>

</html>