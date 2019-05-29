$(function() {
    let baseUrl = Session.getBaseUrl();
    let params = $('script[data-params]').data('params');
    let loadedFiles = [];

    let myDropzone = new Dropzone('#dropzone', {
        url: `${baseUrl}app/temporal/cargar_anexos.php`,
        dictDefaultMessage:
            'Haga clic para elegir un archivo o Arrastre acá el archivo.',
        maxFilesize: 3,
        maxFiles: 3,
        dictFileTooBig: 'Tamaño máximo {{maxFilesize}} MB',
        dictMaxFilesExceeded: 'Máximo 3 archivos',
        params: {
            key: localStorage.getItem('key'),
            dir: 'documento'
        },
        paramName: 'task_file',
        init: function() {
            this.on('success', function(file, response) {
                response = jQuery.parseJSON(response);

                if (response.success) {
                    response.data.forEach(e => {
                        loadedFiles.push(e);
                    });
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            });
        }
    });

    $('#users_tree').fancytree({
        checkbox: true,
        selectMode: 3,
        source: {
            url: `${baseUrl}arboles/arbol_funcionario.php?checkbox=1&idcampofun=funcionario_codigo`
        }
    });

    $('#select_users').select2({
        minimumInputLength: 3,
        language: 'es',
        ajax: {
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            dataType: 'json',
            data: function(params) {
                return {
                    term: params.term,
                    key: localStorage.getItem('key'),
                    token: localStorage.getItem('token'),
                    identificator: 'funcionario_codigo'
                };
            },
            processResults: function(response) {
                return response.success ? { results: response.data } : {};
            }
        }
    });

    $("[name='change_type']").on('click', function() {
        if ($(this).val() == 'input') {
            $('#input').show();
            $('#tree').hide();
        } else {
            $('#input').hide();
            $('#tree').show();
        }
    });

    $('#btn_success').on('click', function() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: `${baseUrl}app/documento/transferir.php`,
            data: {
                key: localStorage.getItem('key'),
                documentId: params.documentId,
                destination: getUsers(),
                message: $('#message').val(),
                files: loadedFiles,
                dir: 'documento'
            },
            beforeSend: function() {
                $('#btn_success,#spiner')
                    .parent()
                    .toggle();
            },
            success: function(response) {
                $('#btn_success,#spiner')
                    .parent()
                    .toggle();
                if (response.success) {
                    top.notification({
                        type: 'success',
                        message: response.message
                    });
                    top.closeTopModal();
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    });
                }
            }
        });
    });

    function getUsers() {
        let users = $('#select_users').val() || [];
        let nodes = $('#users_tree')
            .fancytree('getTree')
            .getSelectedNodes();

        nodes.forEach(n => {
            users.push(n.key);
        });

        return users;
    }

    (function defaultUsers(params) {
        if (parseInt(params.type) == 2) {
            var data = {
                defaultUser: params.userInfo.user,
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            };
        } else if (parseInt(params.type) == 3) {
            var data = {
                documentId: params.documentId,
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            };
        } else {
            return;
        }

        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            data: data,
            success: function(response) {
                response.data.forEach(u => {
                    var option = new Option(u.text, u.id, true, true);
                    $('#select_users')
                        .append(option)
                        .trigger('change');
                });
            }
        });
    })(params);
});
