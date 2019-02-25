
$(document).ready(function () {
    var params = $("#scriptEditCaja").data("params");

    if (params.countExpediente) {
        $("#divTipo").remove();
        $("#divTipoDisabled").show();
    }

    var options = {
        url: `${params.baseUrl}views/caja/informacion.php`,
        params: {
            idcaja: $("#idcaja").val()
        },
        size: "modal-lg",
        title: "",
        centerAlign: false,
        buttons: {}
    };

    $("#cancelarCaja").click(function () {
        top.topModal(options);
    });

    $("#formularioCaja").validate({
        rules: {
            codigo: {
                required: true
            }
        },
        submitHandler: function (form) {
            $("#acualizarCaja").attr('disabled', true);
            
            $.ajax({
                type: 'POST',
                async: false,
                url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
                data: $("#formularioCaja").serialize(),
                dataType: 'json',
                success: function (objeto) {
                    if (objeto.exito) {
                        top.notification({
                            message: objeto.message,
                            type: "success",
                            duration: 3000
                        });
                        top.topModal(options);
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
                        message: "Error al procesar la solicitud (actualizar caja)",
                        type: "error",
                        duration: 3000
                    });
                }
            });
            return false;
        }
    });
});