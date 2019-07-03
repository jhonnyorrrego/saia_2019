$(document).ready(function () {
    var params = $("#scriptResponsableExp").data("params");
    
    $('#newResponsable').select2({
        minimumInputLength: 4,
        ajax: {
            url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
            dataType: 'json',
            quietMillis: 1000,
            data: function (paramsSelect2) {
                var query = {
                    search: paramsSelect2.term,
                    methodInstance: 'listFuncionarios',
                    nameInstance: 'ExpedienteController',
                    where: ` and idfuncionario<>${params.responsable}`
                }
                return query;
            },
            processResults: function (data, paramsSelect2) {
                return {
                    results: data.results,
                    pagination: {
                        more: false
                    }
                };
            },
            cache: true
        }
    });

    $('#newResponsable').on("select2:selecting", function (e) {
        $('#newResponsable').val('').trigger('change');
    });

    $("#formularioExp").validate({
        rules: {
            newResponsable: {
                required: true
            },
            idexpediente: {
                required: true
            }
        },
        submitHandler: function (form) {
            let idexpediente = $("#idexpediente").val();
            let funcionario = $("#newResponsable").val();

            $.ajax({
                type: 'POST',
                url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
                data: { 
                    nameInstance: 'ExpedienteController', 
                    methodInstance: 'updateResponsableExpedienteCont', 
                    idexpediente: idexpediente, 
                    responsable: funcionario
                },
                dataType: 'json',
                success: function (response) {
                    if (response.exito) {
                        top.notification({
                            message: response.message,
                            type: 'success',
                            duration: 3000
                        });
                        $('.ExpTab').trigger('shown.bs.tab');
                    } else {
                        top.notification({
                            message: response.message,
                            type: "error",
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