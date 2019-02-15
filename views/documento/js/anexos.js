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
                },
                onEditableSave: function (field, row) {
                    let data = {
                        key: localStorage.getItem('key'),
                        fileId: row.id,
                        fields: {}
                    };
                    data.fields[field] = row[field];
                    $.post(`${baseUrl}app/anexos_documento/modificar.php`, data, function (response) {
                        if (response.success) {
                            top.notification({
                                type: 'success',
                                message: response.message,
                            });
                        } else {
                            top.notification({
                                type: 'error',
                                message: response.message,
                            });
                        }
                    }, 'json');
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
                    url: `${baseUrl}app/anexos_documento/eliminar.php`,
                    async: false,
                    data: {
                        key: localStorage.getItem('key'),
                        fileId: key
                    },
                    success: function (response) {
                        if (response.success) {
                            success = true;
                        }
                    }
                });

                return success;
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