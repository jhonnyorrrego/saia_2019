$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    let params = $('script[data-fileparams]').data('fileparams');

    if(typeof Files == 'undefined'){
        $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/files/files.js`, function(){
            files = init();
        });
    }else{
        files = init();
    }

    function init() {
        let options = {
            baseUrl: baseUrl,
            selector: '#files_table',
            dropzone: {
                url: `${baseUrl}app/temporal/cargar_anexos.php`,
                params: {
                    key: localStorage.getItem('key'),
                    dir: 'documento'
                }
            },
            bootstrapTable: {
                url: `${baseUrl}app/documento/consulta_anexos.php`,
                queryParams: function (queryParams) {
                    queryParams.documentId = params.documentId;
                    queryParams.key = localStorage.getItem('key');
                    return queryParams;
                },
                columns: [
                    { field: 'icon', title: '' },
                    { field: 'name', title: 'nombre' },
                    { field: 'version', title: 'version' },
                    { field: 'class', title: 'clase' },
                    { field: 'user', title: 'responsable' },
                    { field: 'date', title: 'incluido' },
                    { field: 'size', title: 'tamaño' },
                    { field: 'type', title: 'Tipo'},
                    {
                        field: 'options',
                        title: '',
                        align: 'center',
                        formatter: Files.OptionButttons
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

    $('#show_pages').on('click', function () {
        $('#pages_container').load(`${baseUrl}views/pagina/pagina.php`, {
            documentId: params.documentId
        });
    });
});