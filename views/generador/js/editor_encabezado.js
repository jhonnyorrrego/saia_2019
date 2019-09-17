$(function() {
    let params = $('#script_edit_header').data('params');
    $('#script_edit_header').removeAttr('data-params');

    (function init() {
        CKEDITOR.replace('content');
        findData();
    })();

    $(document)
        .off('click', '#btn_success')
        .on('click', '#btn_success', function(e) {
            $('#form_header').validate({
                ignore: [],
                debug: false,
                rules: {
                    name: {
                        required: true,
                        minlength: 1
                    },
                    content: {
                        required: function() {
                            CKEDITOR.instances.content.updateElement();
                        },
                        minlength: 1
                    }
                }
            });
            if ($('#form_header').valid()) {
                var content = CKEDITOR.instances['content'].getData();

                $.post(
                    `${params.baseUrl}app/generador/actualizar_contenido_encabezado.php`,
                    {
                        key: localStorage.getItem('key'),
                        token: localStorage.getItem('token'),
                        identificator: $('#identificator').val(),
                        name: $('#name').val(),
                        content: content
                    },
                    function(response) {
                        if (response.success) {
                            top.notification({
                                type: 'success',
                                message: 'Encabezado modificado'
                            });
                            top.successModalEvent();
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
        });

    function findData() {
        if (params.identificator) {
            $.post(
                `${params.baseUrl}app/generador/obtener_contenido_encabezado.php`,
                {
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    identificator: params.identificator
                },
                function(response) {
                    if (response.success) {
                        $('#identificator').val(params.identificator);
                        $('#name').val(response.data.name);

                        //la respuesta es mas rapida que la instancia de ckeditor
                        setTimeout(() => {
                            CKEDITOR.instances['content'].setData(
                                response.data.content
                            );
                        }, 500);
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
    }
});
