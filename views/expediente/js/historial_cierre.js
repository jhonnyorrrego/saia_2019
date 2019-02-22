$(document).ready(function () {
    var params = JSON.parse($('script[data-params]').attr('data-params'));

    $("#guardarHistorial").click(function () {
        if ($(this).attr("disable") != "disabled") {
            $("#formCierre").submit();
        }
    });

    $("#formCierre").validate({
        rules: {
            observacion: {
                required: true
            }
        },
        submitHandler: function (form) {
            $("#guardarHistorial").attr('disabled', true);
            $.ajax({
                type: 'POST',
                url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
                data: {
                    nameInstance: 'ExpedienteController',
                    methodInstance: 'aperturaCierreExpedienteCont',
                    idexpediente: params.idexpediente,
                    observacion: $("#observacion").val()
                },
                dataType: 'json',
                success: function (response) {
                    if (response.exito) {
                        top.notification({
                            message: "Expediente actualizado!",
                            type: "success",
                            duration: 3000
                        });
                        $('.ExpTab').trigger('shown.bs.tab');
                    } else {
                        top.notification({
                            message: response.message,
                            type: "warning",
                            duration: 3000
                        });
                    }
                },
                error: function () {
                    top.notification({
                        message: "Error al procesar la solicitud",
                        type: "error",
                        duration: 3000
                    });
                }
            });
        }
    });
});