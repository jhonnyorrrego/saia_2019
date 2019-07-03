$(function() {
    let baseUrl = $("#file_edit_script").data("baseurl");
    let params = $("#file_edit_script").data("fileparams");

    $("#tag_input").val(params.tag);
    $("#description_area").val(params.description);

    $("#btn_success").on("click", function() {
        $.post(
            `${baseUrl}app/anexos/modificar.php`,
            {
                key: localStorage.getItem("key"),
                type: params.type,
                fileId: params.file,
                fields: {
                    etiqueta: $("#tag_input").val(),
                    descripcion: $("#description_area").val()
                }
            },
            function(response) {
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
});
