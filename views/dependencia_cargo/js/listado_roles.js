$(function() {
    let params = $('#role_script').data('params');
    $('#role_script').removeAttr('data-params');

    $(document)
        .off('click', '.edit_role, #add_role')
        .on('click', '.edit_role, #add_role', function() {
            showRoleForm($(this).data('id'));
        });

    (function init() {
        createRoleTable();
    })();

    function createRoleTable() {
        $('#role_table').bootstrapTable({
            url: `${params.baseUrl}app/dependencia_cargo/listado_roles.php`,
            sidePagination: 'server',
            queryParamsType: 'other',
            pagination: true,
            pageSize: 10,
            queryParams: function(queryParams) {
                return $.extend({}, queryParams, {
                    userId: params.userId,
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token')
                });
            },
            classes: 'table table-hover mt-0',
            theadClasses: 'thead-light',
            columns: [
                { field: 'name', title: 'Nombre' },
                { field: 'initial_date', title: 'Fecha inicial' },
                { field: 'final_date', title: 'Fecha final' },
                { field: 'state', title: 'Estado' },
                {
                    field: 'options',
                    title: '',
                    align: 'center',
                    formatter: function(value, row, index, field) {
                        return `<span class="cursor f-20 edit_role" data-id="${
                            row.id
                        }" title="Editar">
                            <i class="fa fa-edit"></i>
                        </span>`;
                    }
                }
            ]
        });
    }

    function showRoleForm(roleId = 0) {
        top.topModal({
            url: `${params.baseUrl}views/dependencia_cargo/adicionar_rol.php`,
            params: {
                userId: params.userId,
                roleId: roleId
            },
            size: 'modal-xl',
            title: roleId ? 'Modificar rol' : 'Adicionar rol'
        });
    }
});
