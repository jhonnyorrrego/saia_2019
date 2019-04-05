$(document).ready(function () {
    var params = $("#scriptAddExp").data("params");

    $("[name='agrupador']").change(function () {
        if ($(this).val() == 3) {
            $(".ocultar").hide();
        } else {
            $(".ocultar").show();
        }
    });

    $("#iconInfAdicional").click(function (e) {
        let icon = $(this).hasClass("fa-plus-square");
        if (icon) {
            $(this).removeClass("fa-plus-square").addClass("fa-minus-square");
            $("#informacionAdicional").show();
        } else {
            $(this).removeClass("fa-minus-square").addClass("fa-plus-square");
            $("#informacionAdicional").hide();
        }
    });
    $("#iconInfAdicional").trigger("click");

    $("#fk_caja").change(function () {
        let actual = $(this).val();
        let padre = $("#cajaAnt").val();
        if (padre != 0 && actual != 0) {
            if (actual != padre) {
                top.notification({
                    message: "Esta ingresando una caja diferente a la caja del expediente superior",
                    type: "warning",
                    duration: 8000
                });
            }

        }
    });

    $("#cancelExp").click(function (e) {
        $("#dinamic_modal").modal('hide');
    });

    $("#formularioExp").validate({
        rules: {
            agrupador: {
                required: true
            },
            nombre: {
                required: true
            },
            cod_padre: {
                required: true
            }
        },
        submitHandler: function (form) {
            $("#guardarExp").attr('disabled', true);
            let iframeWindow = $("#iframe_workspace")[0].contentWindow;
            $.ajax({
                type: 'POST',
                url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
                data: $("#formularioExp").serialize(),
                dataType: 'json',
                success: function (objeto) {
                    if (objeto.exito) {
                        $("#dinamic_modal").modal('hide');
                        if(params.panelId!=-1){
                            iframeWindow.refresKaitenDashboard(params.panelId);
                        }
                        top.notification({
                            message: objeto.message,
                            type: "success",
                            duration: 3000
                        });
                    } else {
                        top.notification({
                            message: objeto.message,
                            type: "error",
                            duration: 3000
                        });
                    }
                },
                error: function () {
                    top.notification({
                        message: "Error al procesar la solicitud (guardar expediente)",
                        type: "error",
                        duration: 3000
                    });
                }
            });

            return false;
        }
    });
});