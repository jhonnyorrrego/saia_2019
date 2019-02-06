$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    let params = $('script[data-fileparams]').data('fileparams');
    $('#files_table').bootstrapTable({
        url: `${baseUrl}app/documento/anexos.php`,
        sidePagination: 'server',
        queryParamsType: 'other',
        queryParams: function (queryParams) {
            queryParams.documentId = params.documentId;
            queryParams.key = localStorage.getItem('key');
            return queryParams;
        },
        pagination: true,
        pageSize: 15,
        classes: 'table table-sm table-hover mt-0',
        theadClasses: 'thead-light',
        columns: [
            {
                field: 'icono',
                title: ''
            },
            {
                field: 'nombre',
                title: 'nombre'
            },
            {
                field: 'version',
                title: 'version'
            },
            {
                field: 'clase',
                title: 'clase'
            },
            {
                field: 'responsable',
                title: 'responsable'
            },
            {
                field: 'incluido',
                title: 'incluido'
            },
            {
                field: 'tamaño',
                title: 'tamaño'
            },
            {
                field: 'tipo',
                title: 'tipo'
            }, {
                field: 'options',
                title: '',
                align: 'center',
                formatter: operateFormatter
            }
        ]
    });

    function operateFormatter(value, row, index) {
        return `<div class="dropdown" id="file_actions">
            <span class="fa fa-chevron-circle-down cursor f-20" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></span>
            <div class="dropdown-menu dropdown-menu-left bg-white" role="menu">
                <a href="#" class="dropdown-item edit">
                    <i class="fa fa-edit"></i> Editar datos del anexo
                </a>
                <a href="#" class="dropdown-item version">
                    <i class="fa fa-cloud-upload"></i> Cargar nueva versión
                </a>
                <a href="#" class="dropdown-item delete">
                    <i class="fa fa-trash"></i> Eliminar
                </a>
                <a href="#" class="dropdown-item access">
                    <i class="fa fa-lock"></i> Permisos
                </a>                        
            </div>
        </div>`;
    }

    $('#show_pages').on('click', function () {
        $('#pages_container').load(`${baseUrl}views/pagina/pagina.php`, {
            documentId: params.documentId
        });
    });
    
    $(document).off('click', '#file_actions .edit');
    $(document).on('click', '#file_actions .edit', function () {
        alert('edit');
    });
    
    $(document).off('click', '#file_actions .version');
    $(document).on('click', '#file_actions .version', function () {
        alert('version');
    });
    
    $(document).off('click', '#file_actions .delete');
    $(document).on('click', '#file_actions .delete', function () {
        alert('delete');
    });
    
    $(document).off('click', '#file_actions .access');
    $(document).on('click', '#file_actions .access', function () {
        alert('access');
    });
});