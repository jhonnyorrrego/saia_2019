$(function() {
    var params = $('#script_grid').data('params');
    var baseUrl = params.baseUrl;
    var $table = $('#table');
    var selections = [];
    var request = {
        key: localStorage.getItem('key'),
        token: localStorage.getItem('token'),
        idbusqueda_componente: params.idbusqueda_componente,
        idbusqueda_filtro_temp: null
    };

    $table.bootstrapTable({
        url: baseUrl + 'app/busquedas/generar_reporte.php',
        queryParams: function(queryParams) {
            queryParams = $.extend(queryParams, request);
            return queryParams;
        },
        responseHandler: function(response) {
            request.total = response.total;

            $.each(response.rows, function(i, row) {
                row.state = $.inArray(row.id, selections) !== -1;
            });
            return response;
        },
        toolbar: '#toolbar',
        classes: 'table table-hover mt-0',
        theadClasses: 'thead-light',
        sidePagination: 'server',
        queryParamsType: 'other',
        columns: getColumns(),
        pagination: true,
        maintainSelected: true,
        pageSize: params.pageSize,
        paginationSuccessivelySize: 1,
        paginationPagesBySide: 1,
        showExport: true,
        exportTypes: ['csv', 'txt', 'excel', 'pdf'],
        exportDataType: 'all'
    });

    $table.on(
        'check.bs.table check-all.bs.table uncheck.bs.table uncheck-all.bs.table',
        function(e, rowsAfter, rowsBefore) {
            var rows = rowsAfter;

            if (e.type == 'uncheck-all') {
                rows = rowsBefore;
            }

            var ids = $.map(!$.isArray(rows) ? [rows] : rows, function(row) {
                return row.id;
            });

            var func =
                $.inArray(e.type, ['check', 'check-all']) > -1
                    ? 'union'
                    : 'difference';
            selections = window._[func](selections, ids);
        }
    );

    $('#btn_search').on('click', function() {
        top.topModal({
            url: baseUrl + $(this).data('url'),
            size: 'modal-xl',
            title: 'Búsqueda',
            buttons: {
                success: {
                    label: 'Buscar',
                    class: 'btn btn-complete'
                },
                cancel: {
                    label: 'Cerrar',
                    class: 'btn btn-danger'
                }
            },
            onSuccess: function(data) {
                let params = getParams(data.url);
                request.idbusqueda_filtro_temp = params.idbusqueda_filtro_temp;
                $table.bootstrapTable('refresh');
                top.closeTopModal();
            }
        });
    });

    $('#btn_add').on('click', function() {
        top.topModal({
            url: baseUrl + $(this).data('url'),
            size: 'modal-xl',
            title: 'Crear',
            onSuccess: function() {
                top.closeTopModal();
                $table.bootstrapTable('refresh');
            },
            buttons: {
                success: {
                    label: 'Guardar',
                    class: 'btn btn-complete'
                },
                cancel: {
                    label: 'Cancelar',
                    class: 'btn btn-danger'
                }
            }
        });
    });

    function getColumns() {
        let data = JSON.parse(params.columns);
        data = data.map(c => {
            c.field = c.field.replace(/[{**}]/g, '').split('@')[0];
            return c;
        });
        if (params.showCheckbox) {
            data.unshift({ checkbox: true, field: 'state' });
        }

        return data;
    }

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
});
