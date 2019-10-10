$(function() {
    let baseUrl = $('script[data-baseurl]').data('baseurl');

    $(document)
        .off('click', '#add_function')
        .on('click', '#add_function', function() {
            showFunctionForm();
        });

    $(document)
        .off('click', '.new_action')
        .on('click', '.new_action', function() {
            let type = $(this).data('type');
            let functionId = $(this).data('id');

            switch (type) {
                case 'edit':
                    showFunctionForm(functionId);
                    break;
                case 'history':
                    showHistory(functionId);
                    break;
            }
        });

    (function init() {
        createFunctionTable();
    })();

    function createFunctionTable() {
        $('#function_table').bootstrapTable({
            url: `${baseUrl}app/funciones/grilla.php`,
            sidePagination: 'server',
            queryParamsType: 'other',
            pagination: true,
            pageSize: 10,
            queryParams: function(queryParams) {
                return $.extend({}, queryParams, {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token')
                });
            },
            classes: 'table table-hover mt-0',
            theadClasses: 'thead-light',
            columns: [
                { field: 'name', title: 'Nombre' },
                { field: 'state', title: 'Estado' },
                {
                    field: 'options',
                    title: '',
                    align: 'center',
                    formatter: function(value, row, index, field) {
                        return `<div class="dropdown">
                            <button class="btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                                <a href="#" class="dropdown-item new_action" data-type="edit" data-id="${row.id}">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                                <a href="#" class="dropdown-item new_action" data-type="history" data-id="${row.id}">
                                    <i class="fa fa-history"></i> Ver historial
                                </a>
                            </div>
                        </div>`;
                    }
                }
            ]
        });
    }

    function showFunctionForm(functionId = 0) {
        top.topModal({
            url: `views/funciones/adicionar.php`,
            params: {
                functionId: functionId
            },
            size: 'modal-xl',
            title: functionId ? 'Modificar función' : 'Adicionar función',
            onSuccess: function() {
                $('#function_table').bootstrapTable('refresh');
            }
        });
    }

    function showHistory(item) {
        top.topModal({
            url: `views/log/historial.php`,
            params: {
                model: 'Funcion',
                item: item
            },
            size: 'modal-xl',
            title: 'Historial'
        });
    }
});
