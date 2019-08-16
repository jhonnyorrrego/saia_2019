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

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . 'assets/librerias.php';

$params = (!empty($_REQUEST)) ? $_REQUEST : [];
$sql = "select a.cantidad_registros,a.ruta_libreria_pantalla,b.encabezado_componente from busqueda a,busqueda_componente b where a.idbusqueda = b.busqueda_idbusqueda and b.idbusqueda_componente={$_REQUEST['idbusqueda_componente']}";
$component = StaticSql::search($sql);
?>
<?= bootstrapTable() ?>
<div class="container px-0">
    <div class="row sticky-top bg-master-lightest mx-0" style="height:36px" id="header_list"></div>
    <div class="row mx-0" id="content">
        <table id="table" data-selections=""></table>
    </div>
</div>
<script>
    $(function() {
        var baseUrl = $("script[data-baseurl]").data('baseurl');
        var params = <?= json_encode($params); ?>;
        var encabezado = '<?= $component[0]["encabezado_componente"] ?>';
        var table = $('#table');
        var sessionVars = {
            key: localStorage.getItem('key'),
            token: localStorage.getItem('token')
        };

        table.bootstrapTable({
            url: baseUrl + 'app/busquedas/generar_reporte.php',
            queryParams: function(queryParams) {
                queryParams = $.extend(queryParams, params, sessionVars);
                return queryParams;
            },
            sidePagination: 'server',
            queryParamsType: 'other',
            cardView: true,
            pagination: true,
            maintainSelected: true,
            pageSize: '<?= $component[0]['cantidad_registros'] ?>',
            paginationSuccessivelySize: 1,
            paginationPagesBySide: 1,
            columns: [{
                field: 'info',
                title: ''
            }],
            responseHandler: function(response) {
                params.total = response.total;
                for (let index = 0; index < response.rows.length; index++) {
                    let node = $(response.rows[index].info);
                    let identificador = node.find('.identificator').val();
                    if (identificador) {
                        node.find('#checkbox_location').html($('<input>', {
                            'data-index': index,
                            'data-id': identificador,
                            'name': 'btSelectItem',
                            'type': 'checkbox'
                        }));
                        response.rows[index].info = node.prop('outerHTML');
                    }
                }
                return response;
            },
            onPostBody: function() {
                beautyTable();

                var selections = table.data('selections').split(',').map(Number).filter(n => n > 0);
                selections.forEach(s => {
                    $(`:checkbox[data-id=${s}]`).prop('checked', true);
                });

                paintSelected();
            },
            onClickRow: function(row, element, field) {
                paintSelected();
                element.addClass('selected');
            }
        });

        table.on('check.bs.table uncheck.bs.table', function(row, data) {
            var selections = $(this).data('selections').split(',').map(Number).filter(n => n > 0);
            let index = $(data.info).find(':checkbox').data('index');
            let checkbox = $(`:checkbox[data-index=${index}]`);
            let checked = checkbox.is(':checked');

            $(`:checkbox[data-id=${checkbox.data('id')}]`).prop('checked', checked);

            $('[name="btSelectItem"]').each(function(i, element) {
                let id = $(element).data('id');

                if (element.checked && $.inArray(id, selections) == -1) {
                    selections.push(id);
                } else if (!element.checked) {
                    selections = selections.filter(n => n != id);
                }
            });

            $(this).data('selections', selections.join(','))
            paintSelected();
        });

        function paintSelected() {
            var selections = table.data('selections').split(',').map(Number).filter(n => n > 0);
            $("#selected_rows").text(selections.length);
            $('tr[data-index]').removeClass('selected');

            if (selections.length) {
                $('[name="btSelectItem"]:checked').each(function(i, e) {
                    $(e).parents('tr[data-index]').addClass('selected');
                });
            }
        }

        function beautyTable() {
            table.parents('.bootstrap-table').addClass('w-100');
            table.find('tr[data-index] td').addClass('p-2');
            table.find('.card-view-value').addClass('w-100');
            $('.card-view-title').remove();
            $('.pagination-detail .page-list').remove();

            if (window.resizeIframe) {
                window.resizeIframe();
            }
        }

        if (encabezado) {
            $("#header_list").load(baseUrl + encabezado, params, function() {
                $('[data-toggle="tooltip"]').tooltip();
            });
        }
    });
</script>
<?php
if ($component[0]['ruta_libreria_pantalla']) {
    $libraries = explode(',', $component[0]['ruta_libreria_pantalla']);

    foreach ($libraries as $library) {
        include_once $ruta_db_superior . $library;
    }
}
?>