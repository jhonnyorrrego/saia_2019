$(function () {
    let baseUrl = "../../";
    let idflujo = $('script[data-params]').data('idflujo');

    if (typeof Files == 'undefined') {
        $.getScript(`${baseUrl}assets/theme/assets/js/cerok_libraries/files/files.js`, function () {
            files = init(idflujo);
        });
    } else {
        files = init(idflujo);
    }

    function init(id) {
        let options = {
            baseUrl: baseUrl,
            selector: '#anexos_flujo',
            dropzone: {
                url: `${baseUrl}app/temporal/cargar_anexos.php`,
                params: {
                    key: localStorage.getItem('key'),
                    dir: 'tarea'
                }
            },
            bootstrapTable: {
                url: `${baseUrl}app/flujo/consulta_anexos.php`,
                queryParams: function (queryParams) {
                    queryParams.sortOrder = 'desc';
                    queryParams.modelName = "Flujo";
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
                    task: id,
                    dir: 'flujo'
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