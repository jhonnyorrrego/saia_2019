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
        createAutocomplete();
    })();

    $('#select_responsable').on('select2:select', function (e) {
        let values = $('#select_responsable').val();
        $('#user_list').val(values.join(','));
    });

    $('[name="private"]').on('click', function () {
        $('#user_container,#edit_container').hide();
        $('#select_responsable').val(null).trigger('change');
        $('[name="edit"]').prop('checked', false);

        if ($(this).val() == 3) {
            $('#user_container,#edit_container').show();
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
});
