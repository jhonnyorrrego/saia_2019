$(function () {
    let params = $('#loadTrd_script').data('params');
    $('#loadTrd_script').removeAttr('data-params');

    (function init() {
        createFileInput();
        getVersion();
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
            url: `${params.baseUrl}app/serie/obtener_version.php`,
            data: {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            },
            dataType: 'json',
            success: function (response) {
                if (response.success) {
                    if (response.data.version) {
                        $("#version").val(response.data.version).attr("readonly", true);
                    } else {
                        $("#version").val(1);
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
        let params = $('#loadTrd_script').data('params');
        let data = $('#loadTRDForm').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            });

        let optionsDefaults = {
            url: `${params.baseUrl}views/serie/progress.php`,
            size: 'modal-lg',
            buttons: {},
            title: 'Cargando .....',
            beforeShow: function () {
                $('#modal_title', parent.document)
                    .next()
                    .hide();
            },
            afterHide: function () {
                $('#modal_title', parent.document)
                    .next()
                    .show();
            }
        };

        $.ajax({
            type: 'POST',
            url: `${params.baseUrl}app/serie/nueva_trd.php`,
            data,
            dataType: 'json',
            beforeSend: function () {
                top.topModal(optionsDefaults);
            },
            success: function (response) {
                if (response.success) {
                    top.closeTopModal();

                    top.notification({
                        message: response.message,
                        type: 'success'
                    });
                    window.location.reload();
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
