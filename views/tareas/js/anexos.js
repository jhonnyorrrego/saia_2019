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
            save: function (description, files) {
                $.post(`${baseUrl}app/tareas/almacenar_anexos.php`, {
                    key: localStorage.getItem('key'),
                    routes: files,
                    description: description,
                    task: params.id,
                    dir: 'tarea'
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
});