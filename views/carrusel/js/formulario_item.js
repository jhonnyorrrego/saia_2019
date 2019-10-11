$(function() {
    let params = $('#item_script').data('params');
    let baseUrl = params.baseUrl;
    let myDropzone = null;

    (function init() {
        createPicker();
        createFileInput();

        if (params.itemId) {
            find(params.itemId);
        }
    })();

    $('#btn_success').on('click', function() {
        $('#item_form').trigger('submit');
    });

    function createPicker() {
        $('#fecha_inicial,#fecha_final').datetimepicker({
            locale: 'es',
            format: 'YYYY-MM-DD'
        });
    }

    function createFileInput() {
        $('#file').addClass('dropzone');
        myDropzone = new Dropzone('#file', {
            url: `${baseUrl}app/temporal/cargar_anexos.php`,
            dictDefaultMessage:
                'Haga clic para elegir un archivo o Arrastre acá el archivo.',
            addRemoveLinks: true,
            dictRemoveFile: 'Eliminar anexo',
            maxFilesize: 3,
            maxFiles: 1,
            dictFileTooBig: 'Tamaño máximo {{maxFilesize}} MB',
            dictMaxFilesExceeded: 'Máximo 1 archivo',
            params: {
                token: localStorage.getItem('token'),
                key: localStorage.getItem('key'),
                dir: 'carrusel_item'
            },
            paramName: 'file',
            init: function() {
                this.on('success', function(file, response) {
                    response = JSON.parse(response);

                    if (response.success) {
                        $('[name="image"]').val(response.data[0]);
                    } else {
                        top.notification({
                            type: 'error',
                            message: response.message
                        });
                    }
                });
            }
        });
    }

    function find(itemId) {
        $.post(
            `${baseUrl}app/carrusel/consulta_item.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                itemId: itemId
            },
            function(response) {
                if (response.success) {
                    fillForm(response.data);
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

    function fillForm(data) {
        for (let name in data) {
            switch (name) {
                case 'image':
                    setImage(data[name]);
                    break;
                case 'estado':
                    $(`[name="estado"][value="${data[name]}"]`).attr(
                        'checked',
                        true
                    );
                    break;
                default:
                    $(`[name="${name}"]`).val(data[name]);
                    break;
            }
        }
    }

    function setImage(mockFile) {
        myDropzone.removeAllFiles();
        myDropzone.emit('addedfile', mockFile);
        myDropzone.emit('thumbnail', mockFile, baseUrl + mockFile.route);
        myDropzone.emit('complete', mockFile);
        $(`[name="image"]`).val(mockFile.route);
    }
});

$('#item_form').validate({
    ignore: '',
    rules: {
        nombre: {
            required: true
        },
        descripcion: {
            required: true
        },
        image: {
            required: true
        },
        fecha_inicial: {
            required: true
        },
        fecha_final: {
            required: true
        }
    },
    messages: {
        nombre: {
            required: 'Campo requerido'
        },
        descripcion: {
            required: 'Campo requerido'
        },
        image: {
            required: 'Campo requerido'
        },
        fecha_inicial: {
            required: 'Campo requerido'
        },
        fecha_final: {
            required: 'Campo requerido'
        }
    },
    submitHandler: function(form) {
        let params = $('#item_script').data('params');
        let data = $('#item_form').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                itemId: params.itemId
            });

        $.post(
            `${params.baseUrl}app/carrusel/guardar_item.php`,
            data,
            function(response) {
                if (response.success) {
                    top.notification({
                        message: response.message,
                        type: 'success'
                    });
                    top.successModalEvent(response.data);
                } else {
                    top.notification({
                        message: response.message,
                        type: 'error',
                        title: 'Error!'
                    });
                }
            },
            'json'
        );
    }
});
