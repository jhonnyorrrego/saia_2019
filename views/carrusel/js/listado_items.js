$(function() {
    let params = $('#carousel_item_script').data('params');
    $('#carousel_item_script').removeAttr('data-params');

    $(document)
        .off('click', '#add_item')
        .on('click', '#add_item', function() {
            showForm();
        });

    $(document)
        .off('click', '.new_action')
        .on('click', '.new_action', function() {
            let type = $(this).data('type');
            let itemId = $(this).data('id');

            switch (type) {
                case 'edit':
                    showForm(itemId);
                    break;
            }
        });

    (function init() {
        createFunctionTable();
    })();

    function createFunctionTable() {
        $('#item_table').bootstrapTable({
            url: `${params.baseUrl}app/carrusel/listado_items.php`,
            sidePagination: 'server',
            queryParamsType: 'other',
            pagination: true,
            pageSize: 10,
            queryParams: function(queryParams) {
                return $.extend({}, queryParams, {
                    carouselId: params.carouselId,
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token')
                });
            },
            classes: 'table table-hover mt-0',
            theadClasses: 'thead-light',
            columns: [
                { field: 'name', title: 'Nombre' },
                { field: 'image', title: 'Imagen' },
                { field: 'state', title: 'EStado' },
                { field: 'initialDate', title: 'Fecha Inicial' },
                { field: 'finalDate', title: 'Fecha Final' },
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
                                <a href="#" class="dropdown-item new_action" data-type="edit"
                                    data-id="${row.id}">
                                    <i class="fa fa-edit"></i> Editar
                                </a>
                            </div>
                        </div>`;
                    }
                }
            ]
        });
    }

    function showForm(itemId) {
        top.topModal({
            url: `views/carrusel/formulario_item.php`,
            params: {
                itemId: itemId,
                carouselId: params.carouselId
            },
            size: 'modal-xl',
            title: 'Noticia',
            onSuccess: function() {
                $('#item_table').bootstrapTable('refresh');
                top.closeTopModal();
            }
        });
    }
});
