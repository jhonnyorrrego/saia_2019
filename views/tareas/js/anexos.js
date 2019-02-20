$(function () {
    let baseUrl = Session.getBaseUrl();
    let params = JSON.parse($('script[data-params]').attr('data-params'));

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
            selector: '#task_files',
            dropzone: {
                url: `${baseUrl}app/temporal/cargar_anexos.php`,
                params: {
                    key: localStorage.getItem('key'),
                    dir: 'tarea'
                }
            },
            bootstrapTable: {
                url: `${baseUrl}app/tareas/consulta_anexos.php`,
                queryParams: function (queryParams) {
                    queryParams.sortOrder = 'desc';
                    queryParams.task = params.id;
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
                    $.post(`${baseUrl}app/anexos/modificar.php`, data, function (response) {
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
                    url: `${baseUrl}app/tareas/almacenar_anexos.php`,
                    async: false,
                    data: {
                        key: localStorage.getItem('key'),
                        routes: files,
                        description: description,
                        task: params.id,
                        dir: 'tarea',
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
                        fileId: key
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
                    url: `${baseUrl}app/tareas/consulta_anexos.php`
                }
            },
        };

        return new Files(options);
    }
});