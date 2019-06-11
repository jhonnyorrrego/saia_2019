$(function() {
    let params = $('#position_function_script').data('params');
    $('#position_function_script').removeAttr('data-params');

    $(document)
        .off('click', '#add_function')
        .on('click', '#add_function', function() {
            showForm();
        });

    $(document)
        .off('click', '#function_table :radio')
        .on('click', '#function_table :radio', function() {
            changeState($(this).data('id'), $(this).val());
        });

    (function init() {
        createFunctionTable();
    })();

    function createFunctionTable() {
        $('#function_table').bootstrapTable({
            url: `${params.baseUrl}app/funciones/listado_cargo.php`,
            sidePagination: 'server',
            queryParamsType: 'other',
            pagination: true,
            pageSize: 10,
            queryParams: function(queryParams) {
                return $.extend({}, queryParams, {
                    position: params.position,
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token')
                });
            },
            classes: 'table table-hover mt-0',
            theadClasses: 'thead-light',
            columns: [
                { field: 'name', title: 'Nombre' },
                {
                    field: 'options',
                    title: 'Estado',
                    align: 'center',
                    formatter: function(value, row, index, field) {
                        return `<div class="radio radio-success mt-0 mb-2">
                            <input id="active${index}" type="radio" name="name${index}" value="1" 
                                data-id="${row.id}" ${
                            row.state == 1 ? 'checked' : ''
                        }>
                            <label for="active${index}">Activo</label>
                            <input id="inactive${index}" type="radio" name="name${index}" value="0" 
                                data-id="${row.id}" ${
                            row.state == 0 ? 'checked' : ''
                        }>
                            <label for="inactive${index}">Inactivo</label>
                        </div>`;
                    }
                },
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
                                <a href="#" class="dropdown-item new_action" data-type="add_role"
                                    data-id="${row.id}">
                                    <i class="fa fa-history"></i> Ver historial
                                </a>
                            </div>
                        </div>`;
                    }
                }
            ]
        });
    }

    function showForm() {
        top.topModal({
            url: `${params.baseUrl}views/funciones/vincular_cargo.php`,
            params: {
                position: params.position
            },
            size: 'modal-xl',
            title: 'Vincular función',
            onSuccess: function() {
                $('#function_table').bootstrapTable('refresh');
            }
        });
    }

    function changeState(relation, state) {
        $.post(
            `${params.baseUrl}app/funciones/desvincular_cargo.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                relation: relation,
                state: state
            },
            function(response) {
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                    $('#function_table').bootstrapTable('refresh');
                }
            },
            'json'
        );
    }
});
