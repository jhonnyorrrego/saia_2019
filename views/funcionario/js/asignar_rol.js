$(function () {
    let params = $("#user_script").data('params');
    $("#user_script").removeAttr('data-params');

    (function init() {
        createRoleTable();
    })();

    function createRoleTable() {
        $('#role_table').bootstrapTable({
            url: `${params.baseUrl}app/funcionario/listado_roles.php`,
            sidePagination: "server",
            queryParamsType: "other",
            pagination: true,
            pageSize: 10,
            queryParams: function (queryParams) {
                return $.extend({}, queryParams, {
                    userId: params.userId,
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token')
                });
            },
            classes: "table table-hover mt-0",
            theadClasses: "thead-light",
            columns: [
                { field: "name", title: "Nombre" },
                { field: "initial_date", title: "Fecha inicial" },
                { field: "final_date", title: "Fecha final" },
                { field: "state", title: "Estado" },
                {
                    field: "options",
                    title: "",
                    align: "center",
                    formatter: function (value, row, index, field) {
                        return `<span class="cursor f-20" data-id="${row.id}">
                            <i class="fa fa-edit"></i>
                        </span>`;
                    }
                }
            ]
        });
    }
});