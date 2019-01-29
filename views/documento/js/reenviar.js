$(function () {
    let baseUrl = Session.getBaseUrl();
    let loadedFiles = [];
    let treeUsers = [];
    let language = {
        errorLoading: function () {
            return "La carga falló"
        },
        inputTooLong: function (e) {
            var t = e.input.length - e.maximum,
                n = "Por favor,elimine " + t + " car";
            return t == 1 ? n += "ácter" : n += "acteres";
        },
        inputTooShort: function (e) {
            var t = e.minimum - e.input.length,
                n = "Por favor,introduzca " + t + " car";
            return t == 1 ? n += "ácter" : n += "acteres";
        },
        loadingMore: function () {
            return "Cargando más resultados…"
        },
        maximumSelected: function (e) {
            var t = "Sólo puede seleccionar " + e.maximum + " elemento";
            return e.maximum != 1 && (t += "s");
        },
        noResults: function () {
            return "No se encontraron resultados"
        },
        searching: function () {
            return "Buscando…"
        }
    };

    let myDropzone = new Dropzone("#dropzone", {
        url: `${baseUrl}app/temporal/cargar_anexos.php`,
        dictDefaultMessage: 'Haga clic para elegir un archivo o Arrastre acá el archivo.',
        params: {
            key: localStorage.getItem('key')
        },
        paramName: 'task_file',
        init: function () {
            this.on("success", function (file, response) {
                response = jQuery.parseJSON(response)

                if (response.success) {
                    response.data.forEach(e => {
                        loadedFiles.push(e);
                    });
                } else {
                    top.notification({
                        type: 'error',
                        message: response.message
                    })
                }
            })
        }
    });

    $('#users_tree').fancytree({
        checkbox: true,
        selectMode: 3,
        source: {
            url: `${baseUrl}arboles/arbol_funcionario.php?checkbox=1&idcampofun=idfuncionario`
        }
    });

    $("#select_users").select2({
        minimumInputLength: 3,
        language: language,
        ajax: {
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            dataType: 'json',
            data: function (params) {
                return {
                    term: params.term,
                    key: localStorage.getItem('key')
                }
            },
            processResults: function (response) {
                return response.success ? { results: response.data } : {};
            }
        }
    });

    $("[name='change_type']").on('click', function () {
        if ($(this).val() == 'input') {
            $('#input').show();
            $('#tree').hide();
        } else {
            $('#input').hide();
            $('#tree').show();
        }
    });

    $('#btn_success').on('click', function () {
        $.post(`${baseUrl}app/documento/transferir.php`, {
            key: localStorage.getItem('key'),
            destination: getUsers(),
            message: $('#message').val(),
            files: loadedFiles
        }, function (response) {
            console.log(response);
        }, 'json');
    });

    function getUsers() {
        let users = $('#select_users').val() || [];
        let nodes = $("#users_tree").fancytree('getTree').getSelectedNodes();

        nodes.forEach(n => {
            users.push(n.key);
        })

        return users;
    }
});