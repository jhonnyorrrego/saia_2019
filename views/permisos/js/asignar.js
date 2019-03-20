$(function () {
    let baseUrl = $("script[data-baseurl]").data("baseurl");
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

    (function init() {        
        findData();
        createAutocomplete();
    })();

    $('#go_back').on('click', function () {
        top.closeTopModal();
    })

    $('#select_responsable').on('change', function (e) {
        let values = $('#select_responsable').val();
        $('#user_list').val(values.join(','));
    });

    $('[name="private"]').on('click', function () {
        $('#user_container,#edit_container').hide();
        $('#select_responsable').val(null).trigger('change');
        $('[name="edit"]').prop('checked', false);

        if ($(this).val() == 3) {
            $('#user_container').show();
            
            if ($("[name='type']").val() != 'TIPO_DOCUMENTO') {
                $('#edit_container').show();
            }
        }
    });

    $("#permissions").on("submit", function (e) {
        e.preventDefault();

        $('[name="key"]').val(localStorage.getItem('key'));
        $.post(
            `${baseUrl}app/permisos/asignar.php`,
            $("#permissions").serialize(),
            function (response) {
                if (response.success) {
                    top.notification({
                        type: "success",
                        message: response.message
                    });
                    top.closeTopModal();
                } else {
                    top.notification({
                        type: "error",
                        message: response.message
                    });
                }
            },
            "json"
        );
    });

    function createAutocomplete() {
        $("#select_responsable").select2({
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
    }

    function findData() {
        $('[name="key"]').val(localStorage.getItem('key'));
        $.post(
            `${baseUrl}app/permisos/consulta_datos_asignar.php`,
            $("#permissions").serialize(),
            function (response) {
                if (response.success) {
                    $(`[name="private"][value=${response.data.type}]`).trigger('click');

                    if (response.data.type == 3) {
                        response.data.users.forEach(userId => {
                            defaultUsers(userId);
                        });

                        if (response.data.edit) {
                            $(':checkbox[name="edit"]').prop('checked', true);
                        }
                    }
                } else {
                    top.notification({
                        type: "error",
                        message: response.message
                    });
                }
            },
            "json"
        );
    }

    function defaultUsers(userId) {
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: `${baseUrl}app/funcionario/autocompletar.php`,
            data: {
                defaultUser: userId,
                key: localStorage.getItem('key')
            },
            success: function (response) {
                response.data.forEach(u => {
                    var option = new Option(u.text, u.id, true, true);
                    $('#select_responsable').append(option).trigger('change');
                });

                $('#select_responsable').trigger({type: 'select2:select'});
            }
        });
    }
});
