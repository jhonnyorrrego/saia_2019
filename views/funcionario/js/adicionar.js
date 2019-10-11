$(function() {
    let params = $('#user_script').data('params');
    let baseUrl = params.baseUrl;
    let myDropzone = null;

    $('#user_script').removeAttr('data-params');

    (function init() {
        createFileInput();
        findProfileOptions();
        findWindowRadicationOptions();

        if (params.userId) {
            find(params.userId);
        }
        changeModalTitle();
    })();

    $('#btn_success').on('click', function() {
        $('#user_form').trigger('submit');
    });

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
                dir: 'firma_funcionario'
            },
            paramName: 'file',
            init: function() {
                this.on('success', function(file, response) {
                    response = JSON.parse(response);

                    if (response.success) {
                        $('[name="firma"]').val(response.data[0]);
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

    function findProfileOptions() {
        $.post(
            `${baseUrl}app/funcionario/consulta_perfiles.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            },
            function(response) {
                if (response.success) {
                    response.data.forEach(element => {
                        $('#profile').append(
                            $('<option>', {
                                value: element.idperfil,
                                text: element.nombre
                            })
                        );
                    });
                    $('#profile').select2();
                }
            },
            'json'
        );
    }

    function findWindowRadicationOptions() {
        $.post(
            `${baseUrl}app/funcionario/consulta_ventanillas.php`,
            {
                key: localStorage.getItem('key')
            },
            function(response) {
                if (response.success) {
                    response.data.forEach(element => {
                        $('#window_radication').append(
                            $('<option>', {
                                value: element.idcf_ventanilla,
                                text: element.nombre
                            })
                        );
                    });
                    $('#window_radication').select2();
                }
            },
            'json'
        );
    }

    $('#password').keyup(function() {
        checkStrength('#password_validation', $(this).val());
    });

    function find(userId) {
        $.post(
            `${baseUrl}app/funcionario/consulta_funcionario.php`,
            {
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                type: 'edit',
                userId: userId
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
                case 'perfil':
                    setTimeout(() => {
                        $(`[name="perfil[]"]`)
                            .val(data[name].split(','))
                            .change();
                    }, 500);
                    break;
                case 'ventanilla_radicacion':
                    setTimeout(() => {
                        $(`[name="ventanilla_radicacion"]`)
                            .val(data[name].split(','))
                            .change();
                    }, 500);
                    break;
                case 'firma':
                    setImage(data[name]);
                    break;
                case 'estado':
                    $(`[name="estado"][value="${data[name]}"]`).attr(
                        'checked',
                        true
                    );
                    break;
                default:
                    let e = $(`[name="${name}"]`);

                    if (e.length) {
                        e.val(data[name]).trigger('change');
                    }
                    break;
            }
        }
    }

    function setImage(mockFile) {
        myDropzone.removeAllFiles();
        myDropzone.emit('addedfile', mockFile);
        myDropzone.emit('thumbnail', mockFile, baseUrl + mockFile.route);
        myDropzone.emit('complete', mockFile);
    }

    function checkStrength(selector, password) {
        var strength = 0;

        if (password.length < 9) {
            $(selector)[0].className = 'label label-danger';
            $(selector).html('Demasiado Corta');
            return true;
        }

        if (password.length > 7) strength += 1;
        // If password contains both lower and uppercase characters, increase strength value.
        if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)) strength += 1;
        // If it has numbers and characters, increase strength value.
        if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))
            strength += 1;
        // If it has one special character, increase strength value.
        if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1;
        // If it has two special characters, increase strength value.
        if (
            password.match(
                /(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/
            )
        )
            strength += 1;
        // Calculated strength value, we can return messages

        if (strength < 2) {
            $(selector)[0].className = 'label label-warning';
            $(selector).html('Débil');
            return true;
        } else if (strength == 2) {
            $(selector)[0].className = 'label label-info';
            $(selector).html('Buena');
            return true;
        } else {
            $(selector)[0].className = 'label label-success';
            $(selector).html('Optima');
            return true;
        }
    }

    function changeModalTitle() {
        $('#modal_title').text('Crear usuario');
    }
});

$('#user_form').validate({
    rules: {
        nit: {
            required: true
        },
        nombres: {
            required: true
        },
        apellidos: {
            required: true
        },
        clave: {
            required: true,
            minlength: 8
        },
        'perfil[]': {
            required: true
        },
        ventanilla_radicacion: {
            required: true
        },
        login: {
            required: true
        }
    },
    messages: {
        nit: {
            required: 'Campo requerido'
        },
        nombres: {
            required: 'Campo requerido'
        },
        apellidos: {
            required: 'Campo requerido'
        },
        clave: {
            required: 'Campo requerido',
            minlength: 'Ingrese minimo 8 caracteres'
        },
        'perfil[]': {
            required: 'Campo requerido'
        },
        ventanilla_radicacion: {
            required: 'Campo requerido'
        },
        login: {
            required: 'Debe indicar un nombre de usuario'
        }
    },
    errorPlacement: function(error, element) {
        let node = element[0];

        if (
            node.tagName == 'SELECT' &&
            node.className.indexOf('select2') !== false
        ) {
            error.addClass('pl-3');
            element.next().append(error);
        } else {
            error.insertAfter(element);
        }
    },
    submitHandler: function(form) {
        let params = $('#user_script').data('params');
        let data = $('#user_form').serialize();
        data =
            data +
            '&' +
            $.param({
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token'),
                userId: params.userId
            });

        if (params.userId) {
            var route = `${params.baseUrl}app/funcionario/editar.php`;
        } else {
            var route = `${params.baseUrl}app/funcionario/adicionar.php`;
        }

        $.post(
            route,
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
