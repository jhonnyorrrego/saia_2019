$(function() {
    var baseUrl = Session.getBaseUrl();
    var userId = localStorage.getItem("key");
    var params = {
        key: userId,
        number: 0,
        string: "",
        date: ""
    };

    $("#document_finder").autocomplete({
        serviceUrl: `${baseUrl}app/documento/buscador.php`,
        lookupLimit: 10,
        width: 500,
        minChars: 4,
        noCache: true,
        type: "POST",
        params: params,
        onSelect: function(suggestion) {
            alert("You selected: " + suggestion.value + ", " + suggestion.data);
        }
    });

    $("#document_finder").on("keyup", function() {
        if (Number($(this).val())) {
            $("#document_finder").autocomplete("setOptions", { minChars: 1 });
            $(this).trigger("focus");
        } else {
            $("#document_finder").autocomplete("setOptions", { minChars: 4 });
        }
    });

    $("#clean_finder").on("click", function() {
        $("#document_finder").val("");
    });

    $(".finder_option").on("click", function() {
        $("#document_finder").trigger("blur");

        switch ($(this).data("type")) {
            case "folder":
                var file = "busqueda_general_expedientes.php";
                break;
            case "task":
                var file = "busqueda_general_tareas.php";
                break;
            case "file":
                var file = "busqueda_general_anexos.php";
                break;
            case "document":
            default:
                var file = "busqueda_general_documentos.php";
                break;
        }

        let options = {
            url: `${baseUrl}views/buzones/${file}`,
            size: "modal-lg",
            title: "Búsqueda avanzada",
            centerAlign: false,
            buttons: {}
        };

        topModal(options);
    });

    window.fillAutocompleteParams = function() {
        $("#form_filters input").each(function(i, e) {
            params[$(e).attr("name")] = $(e).val();
        });

        $("#document_finder").trigger("keyup");
        $("#document_finder").focus();
    };
});
