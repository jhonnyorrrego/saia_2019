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
        $('#filtro_usuario').select2();
        createPicker();
        createAutocomplete();
        findComponent();
    })();

    $("#find_tasks_form").on("submit", function (e) {
        e.preventDefault();

        top.notification({
            type: "info",
            message: "Esto puede tardar un momento"
        });

        $.post(
            `${baseUrl}pantallas/busquedas/procesa_filtro_busqueda.php`,
            $("#find_tasks_form").serialize(),
            function (response) {
                if (response.exito) {
                    let route = baseUrl + response.url;
                    $("#iframe_workspace").attr("src", route);
                } else {
                    top.notification({
                        type: "error",
                        message: response.message
                    });
                }
            },
            "json"
        );

        $("#dinamic_modal").modal("hide");
    });

    function createPicker() {
        $('#fecha_inicial,#fecha_final').datetimepicker({
            widgetPositioning: {
                horizontal: 'auto',
                vertical: 'bottom'
            },
            widgetParent: $('#find_tasks_form'),
            locale: 'es',
            format: "YYYY-MM-DD hh:mm:ss"
        });
    }

    function findComponent() {
        $.post(
            `${baseUrl}app/busquedas/consulta_componente.php`,
            {
                key: localStorage.getItem("key"),
                name: "busqueda_general_tareas"
            },
            function (response) {
                if (response.success) {
                    $("#component").val(response.data);
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

    function createAutocomplete() {
        $("#user_autocomplete").select2({
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
                    return response.success ? {results: response.data} : {};
                }
            }
        });
    }
});
