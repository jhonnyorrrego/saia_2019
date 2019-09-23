$(function () {
    let params = $('#scriptCargarTrd').data('params');
    $('#scriptCargarTrd').removeAttr('data-params');

    (function init() {
        getVersion();
        createFileInput();
    })();

    function createFileInput() {
        $('#file_trd,#file_anexos').addClass('dropzone');
        createDropZone('file_trd', 'trd', '.xls,.xlsx');
        createDropZone('file_anexos', 'anex');
    }

    function createDropZone(selector, directorio, typeFiles = null) {
        myDropzone = new Dropzone('#' + selector, {
            url: `${params.baseUrl}app/temporal/cargar_anexos.php`,
            dictDefaultMessage:
                'Haga clic para elegir un archivo o Arrastre acá el archivo.',
            addRemoveLinks: true,
            dictRemoveFile: 'Eliminar anexo',
            maxFilesize: 3,
            maxFiles: 1,
            dictFileTooBig: 'Tamaño máximo {{maxFilesize}} MB',
            dictMaxFilesExceeded: 'Máximo 1 archivo',
            acceptedFiles: typeFiles,
            dictInvalidFileType: 'Tipo de archivo no permitido',
            params: {
                token: localStorage.getItem('token'),
                key: localStorage.getItem('key'),
                dir: directorio
            },
            paramName: 'file',
            init: function () {
                this.on('success', function (file, response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        $('[name="' + selector + '"]').val(response.data[0]);
                    } else {
                        top.notification({
                            type: 'error',
                            message: response.message
                        });
                    }
                });

                this.on('maxfilesexceeded', function (file, response) {
                    top.notification({
                        type: 'error',
                        message: 'Máximo ' + this.options.maxFiles + ' archivo'
                    });
                    this.removeAllFiles();
                });
            },
            removedfile: function (file) {
                file.previewElement.remove();
                $('[name="' + selector + '"]').val('');
            }
        });

        return myDropzone;
    }

    function getVersion() {
        $.ajax({
            type: 'POST',
            url: `${params.baseUrl}app/trd/serie_version/obtener_version.php`,
            data: {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    if (response.success == 2) {
                        top.notification({
                            message: 'Ya existe una TRD en borrador',
                            type: 'error'
                        });
                        top.$("[data-name='versiones_trd']").click();
                    } else {
                        if (response.data.version) {
                            $("#version").val(response.data.version).attr("readonly", true);
                        } else {
                            $("#version").val(1);
                        }
                    }

                } else {
                    top.notification({
                        message: response.message,
                        type: 'error'
                    });
                }
            }
        });
    }

    $("[name='tipo']").change(function () {
        $("[name='file_trd']").rules('add', { required: $(this).val() == 1 });

        if ($(this).val() == 1) {
            $('#divTrd').show();
        } else {
            $('#divTrd').hide();
        }
    });
    $("[name='tipo']:checked").trigger('change');
});

$('#loadTRDForm').validate({
    ignore: '',
    rules: {
        version: {
            required: true,
            digits: true
        },
        tipo: {
            required: true
        },
        nombre: {
            required: true
        }
    },
    submitHandler: function () {
        let params = $('#scriptCargarTrd').data('params');
        let data = $('#loadTRDForm').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            });

        let optionsDefaults = {
<<<<<<< HEAD:views/trd/serie_version/js/cargar_trd.js
            url: `${params.baseUrl}views/trd/serie_version/progress.php`,
=======
            url: `views/serie_version/progress.php`,
>>>>>>> 42363a8ff886fcd53274440435165a8503b8c422:views/serie_version/js/cargar_trd.js
            size: 'modal-lg',
            buttons: {},
            backdrop: 'static',
            keyboard: false,
            title: 'Cargando .....'
        };
        /*console.log(optionsDefaults)
        return false;*/

        $.ajax({
            type: 'POST',
            url: `${params.baseUrl}app/trd/serie_version/nueva_trd.php`,
            data,
            dataType: 'json',
            beforeSend: function () {
                top.topModal(optionsDefaults);
            },
            success: function (response) {
                if (response.success) {
                    top.closeTopModal();
                    top.$("[data-name='versiones_trd']").click();

                    top.notification({
                        message: response.message,
                        type: 'success'
                    });
                } else {
                    options = {
                        params: {
                            message: response.message
                        },
                        title: 'Error!'
                    };
                    var options = $.extend({}, optionsDefaults, options);
                    top.topModal(options);
                }
            }
        });
    }
});
