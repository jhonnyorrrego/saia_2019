$(function() {
    var params = $('#script_grid').data('params');
    var baseUrl = params.baseUrl;
    var sessionVars = {
        key: localStorage.getItem('key'),
        token: localStorage.getItem('token'),
        idbusqueda_componente: params.idbusqueda_componente
    };

    $('#table').bootstrapTable({
        url: baseUrl + 'app/busquedas/datosBootstrapTable.php',
        queryParams: function(queryParams) {
            queryParams = $.extend(queryParams, sessionVars);
            return queryParams;
        },
        classes: 'table table-hover mt-0',
        theadClasses: 'thead-light',
        sidePagination: 'server',
        queryParamsType: 'other',
        pagination: true,
        maintainSelected: true,
        pageSize: params.pageSize,
        paginationSuccessivelySize: 1,
        paginationPagesBySide: 1,
        columns: getColumns(),
        filterControl: true,
        showExport: true,
        exportTypes: ['csv', 'txt', 'excel', 'pdf'],
        exportDataType: 'all'
    });

    function getColumns() {
        let data = JSON.parse(params.columns);
        data = data.map(c => {
            c.field = c.field.replace(/[{**}]/g, '').split('@')[0];
            return c;
        });
        return data;
    }
});
