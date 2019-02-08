$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    let params = $('script[data-fileparams]').data('fileparams');
    let files = null;

    if(typeof Files == 'undefined'){
        $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/files/files.js`, function(){
            files = init();
        });
    }else{
        files = init();
    }

    function init() {
        let options = {
            selector: '#files_table',
            dropzone: {
                url: `${baseUrl}app/temporal/cargar_anexos.php`,
                dictDefaultMessage: 'Haga clic para elegir un archivo o Arrastre acá el archivo.',
                maxFilesize: 3,
                maxFiles: 3,
                dictFileTooBig: 'Tamaño máximo {{maxFilesize}} MB',
                dictMaxFilesExceeded: 'Máximo 3 archivos',
                params: {
                    key: localStorage.getItem('key'),
                    dir: 'documento'
                },
                paramName: 'task_file'                
            },
            bootstrapTable: {
                url: `${baseUrl}app/documento/consulta_anexos.php`,
                sidePagination: 'server',
                queryParamsType: 'other',
                queryParams: function (queryParams) {
                    queryParams.documentId = params.documentId;
                    queryParams.key = localStorage.getItem('key');
                    return queryParams;
                },
                pagination: true,
                pageSize: 5,
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
            },
            save: function (description, files) {
                $.post(`${baseUrl}app/documento/almacenar_anexos.php`, {
                    key: localStorage.getItem('key'),
                    routes: files,
                    description: description,
                    documentId: params.documentId
                }, function (response) {
                    if (response.success) {
                        top.notification({
                            type: 'success',
                            message: response.message,
                        });
                    }
                }, 'json');
            }
        };
    
        return new Files(options);
    }


    function operateFormatter() {
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
        let table = files.getTable();
        let dropzone = files.getDropzone();

        console.log(table, dropzone);
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