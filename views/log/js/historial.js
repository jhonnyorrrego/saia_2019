$(function() {
    let params = $('#history_script').data('params');
    $('#history_script').removeAttr('data-params');

    (function init() {
        createHistoryTable();
    })();

    function createHistoryTable() {
        $('#history_table').bootstrapTable({
            url: `${params.baseUrl}app/log/historial.php`,
            sidePagination: 'server',
            queryParamsType: 'other',
            pagination: true,
            pageSize: 10,
            queryParams: function(queryParams) {
                return $.extend({}, queryParams, {
                    model: params.model,
                    item: params.item,
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    sortOrder: 'desc'
                });
            },
            classes: 'table table-hover mt-0',
            theadClasses: 'thead-light',
            columns: [
                { field: 'date', title: 'Fecha' },
                { field: 'user', title: 'Funcionario' },
                { field: 'action', title: 'Acción' },
                {
                    field: 'description',
                    title: 'Descripción',
                    align: 'center',
                    formatter: function(value, row, index, field) {
                        let response = '<table class="table">';
                        value.forEach(element => {
                            response += `
                                <tr>
                                    <td>${element.field}</td>
                                    <td>
                                        Anterior: ${element.old}<br>
                                        Actual: ${element.new}
                                    </td>
                                </tr>
                            `;
                        });

                        response += '</table>';

                        return response;
                    }
                }
            ]
        });
    }
});
