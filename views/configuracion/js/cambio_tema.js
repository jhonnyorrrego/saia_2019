$(function() {
    let baseUrl = $("script[data-baseurl]").data("baseurl");

    $(".color_container").on("click", function() {
        $(":radio").attr("checked", false);
        $(this)
            .find("input:radio")
            .attr("checked", true);
    });

    $(".color_container").hover(function() {
        $(this).css("cursor", "pointer");
    });

    $("#saveColor").on("click", function() {
        var color = $("[name='theme']:checked").val();

        if (color) {
            $.post(
                baseUrl + "app/configuracion/actualizar_color.php",
                {
                    key: localStorage.getItem('key'),
                    color: color
                },
                function(response) {
                    if (response.success) {
                        top.notification({
                            message: response.message,
                            type: "success"
                        });

                        let style = `
                              .bg-institutional{background: ${color} !important;color: #ffff !important}
                              .text-institutional{color: ${color} !important;}
                            `;
                        $("#instition_style", window.top.document).text(style);
                        window.top.localStorage.setItem("color", color);
                    } else {
                        top.notification({
                            message: response.message,
                            type: "error",
                            title: "Error!"
                        });
                    }
                },
                "json"
            );
        } else {
            top.notification({
                message: "Debe Seleccionar un color",
                type: "error",
                title: "Error!"
            });
        }
    });
});
