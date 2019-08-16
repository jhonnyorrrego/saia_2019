$(function() {
    let baseUrl =
        $('script[data-baseurl]', parent.document).data('baseurl') || '../../';
    let idflujo = $('script[data-idflujo]').data('idflujo') || 0;
    //console.log("idflujo", idflujo);
    if (typeof Files == 'undefined') {
        $.getScript(
            `${baseUrl}assets/theme/assets/js/cerok_libraries/files/files.js`,
            function() {
                files = initAnexosFlujo(idflujo);
            }
        );
    } else {
        files = initAnexosFlujo(idflujo);
    }

    window.initAnexosFlujo = function(id) {
        //console.log("id", id);
        if (id == 0) {
            return false;
        }
        let options = {
            baseUrl: baseUrl,
            selector: '#anexos_flujo',
            dropzone: {
                url: `${baseUrl}app/temporal/cargar_anexos.php`,
                params: {
                    token: localStorage.getItem('token'),
                    key: localStorage.getItem('key'),
                    dir: 'flujo'
                }
            },
            bootstrapTable: {
                url: `${baseUrl}app/flujo/consulta_anexos.php`,
                queryParams: function(queryParams) {
                    queryParams.sortOrder = 'desc';
                    queryParams.modelName = 'Flujo';
                    queryParams.key = localStorage.getItem('key');
                    queryParams['id'] = id;
                    return queryParams;
                },
                onEditableSave: function(field, row) {
                    let data = {
                        key: localStorage.getItem('key'),
                        fileId: row.id,
                        fields: {}
                    };
                    data.fields[field] = row[field];
                    $.post(
                        `${baseUrl}app/anexos/modificar.php`,
                        data,
                        function(response) {
                            if (response.success) {
                                top.notification({
                                    type: 'success',
                                    message: response.message
                                });
                            } else {
                                top.notification({
                                    type: 'error',
                                    message: response.message
                                });
                            }
                        },
                        'json'
                    );
                }
            },
            save: function(description, files, fileId) {
                let success = false;
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: `${baseUrl}app/flujo/guardar_anexos.php`,
                    async: false,
                    data: {
                        key: localStorage.getItem('key'),
                        archivos: files,
                        descripcion: description,
                        id: id,
                        dir: 'flujo',
                        fileId: fileId,
                        fkName: 'fk_flujo',
                        modelName: 'AnexoFlujo'
                    },
                    success: function(response) {
                        if (response.success) {
                            top.notification({
                                type: 'success',
                                message: response.message
                            });
                            success = true;
                        }
                    }
                });

                return success;
            },
            delete: function(key) {
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
                    success: function(response) {
                        if (response.success) {
                            success = true;
                        }
                    }
                });

                return success;
            }
        };

        return new Files(options);
    };
});
