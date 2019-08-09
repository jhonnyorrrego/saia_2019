$(function() {
    let params = $('#trd_report_script').data('params');

    (function init() {
        $('#trd_table').bootstrapTable({
            url: `${params.baseUrl}app/serie/reporte_trd.php`,
            queryParams: function(queryParams) {
                queryParams = $.extend(queryParams, {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    id: params.id
                });
                return queryParams;
            },
            queryParamsType: 'other',
            pagination: true,
            paginationSuccessivelySize: 1,
            paginationPagesBySide: 1,
            columns: [
                {
                    field: 'info',
                    title: ''
                }
            ]
        });
    })();
});
