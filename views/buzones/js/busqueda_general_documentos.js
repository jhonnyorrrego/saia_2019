$(function() {
    let baseUrl = $("script[data-baseurl]").data("baseurl");

    (function init() {
        findComponent();
    })();

    $("#find_documents_form").on("submit", function(e) {
        e.preventDefault();

        top.notification({
            type: "info",
            message: "Esto puede tardar un momento"
        });

        let route = `${baseUrl}views/buzones/index.php?`;
        route += $("#find_documents_form").serialize();
        $("#iframe_workspace").attr("src", route);

        $("#dinamic_modal").modal("hide");
    });

    function findComponent() {
        $.post(
            `${baseUrl}app/busquedas/consulta_componente.php`,
            {
                key: localStorage.getItem("key"),
                name: "busqueda_general_documentos"
            },
            function(response) {
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
});
