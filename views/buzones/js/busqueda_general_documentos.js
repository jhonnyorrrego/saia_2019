$(function () {
    let baseUrl = $("script[data-baseurl]").data("baseurl");

    $("#find_documents_form").on("submit", function (e) {
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
});
