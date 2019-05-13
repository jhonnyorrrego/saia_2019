$(function () {
    let baseUrl = $('script[data-baseurl]').data('baseurl');
    let params = $('script[data-fileparams]').data('fileparams');

    if (typeof Files == 'undefined') {
        $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/files/files.js`, function () {
            files = init();
        });
    } else {
        files = init();
    }

    function init() {
        let options = {
            baseUrl: baseUrl,
            selector: '#files_table',
            sourceReference: 'TIPO_ANEXOS',
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
                    queryParams.sortOrder = 'desc';
                    queryParams.documentId = params.documentId;
                    queryParams.key = localStorage.getItem('key');
                    return queryParams;
                }
            },
            save: function (description, files, fileId) {
                let success = false;
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: `${baseUrl}app/documento/almacenar_anexos.php`,
                    async: false,
                    data: {
                        key: localStorage.getItem('key'),
                        routes: files,
                        description: description,
                        documentId: params.documentId,
                        dir: 'documento',
                        fileId: fileId
                    },
                    success: function (response) {
                        if (response.success) {
                            top.notification({
                                type: 'success',
                                message: response.message,
                            });
                            success = true;
                        }
                    }
                });

                return success;
            },
            delete: function (key) {
                let success = false;
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: `${baseUrl}app/anexos/eliminar.php`,
                    async: false,
                    data: {
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token'),
                        fileId: key,
                        type: this.sourceReference
                    },
                    success: function (response) {
                        if (response.success) {
                            success = true;
                        }
                    }
                });

                return success;
            },
            expandBootstrapTable: function (row) {
                return {
                    url: `${baseUrl}app/documento/consulta_anexos.php`
                }
            }
        };

        return new Files(options);
    }

    $('#show_pages').on('click', function () {
        let route = `${baseUrl}views/visor/viewer_annotate_image.php?`;
        route += $.param({
            typeId: params.documentId,
            type: 'TIPO_PAGINA'
        });

        $('#pages_iframe').attr('src', route);
    });
});