$(document).ready(function () {
    var params = $("#scriptCompartirExp").data("params");

    var loadTable = function () {
        $.ajax({
            type: 'POST',
            url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
            data: { 
                nameInstance: 'ExpedienteController',
                methodInstance: 'getPermisoExpedienteCont', 
                idexpediente: params.idexpediente
            },
            dataType: 'json',
            success: function (response) {
                if (response.exito) {
                    $("#data-table").empty();
                    if (response.data.length) {
                        $.each(response.data, function (index, row) {
                        let tr = `<tr id="tr_${row.idpermiso}">
                        <td>${row.funcionario}</td>
                        <td>${row.nombreExpediente}</td>
                        <td><button class="btn btn-danger" data-id="${row.idpermiso}"><i class="fa fa-trash"></i></button></td>
                        </tr>`;
                        $("#data-table").append(tr);
                        });

                    } else {
                        $("#data-table").append('<tr id="row-0"><td colspan="3">SIN FUNCIONARIOS</td></tr>')
                    }
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
    loadTable();

    $(document).on("click", ".btn-danger", function () {
        var idpermisoExpediente = $(this).data("id");
        top.confirm({
            type: 'error',
            title: 'Eliminando!',
            message: 'Está seguro de eliminar el permiso?',
            position: 'center',
            timeout: 0,
            buttons: [
                [
                    '<button><b>SI</b></button>',
                    function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                        $.ajax({
                            type: 'POST',
                            url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
                            data: {
                                nameInstance: 'ExpedienteController',
                                methodInstance: 'deletePemisoExpedienteCont',
                                idpermiso: idpermisoExpediente
                            },
                            dataType: 'json',
                            success: function (response) {
                                if (response.exito) {
                                    loadTable();
                                    top.notification({
                                        message: 'Permiso Eliminado!',
                                        type: "success",
                                        duration: 3000
                                    });
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
                    },
                    true
                ],
                [
                    '<button>NO</button>',
                    function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }
                ],
            ]
        });
    });

    $('#nombre').select2({
        multiple: true,
        minimumInputLength: 4,
        ajax: {
            url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
            dataType: 'json',
            quietMillis: 1000,
            data: function (params) {
                var query = {
                    search: params.term,
                    methodInstance: 'listFuncionarios',
                    nameInstance: 'ExpedienteController'
                }
                return query;
            },
            processResults: function (data, params) {
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

    $("#formularioExp").validate({
        rules: {
            nombre: {
                required: true
            },
            idexpediente: {
                required: true
            }
        },
        submitHandler: function (form) {
            $("#guardarPermiso").attr('disabled', true);
            let idexpediente = $("#idexpediente").val();
            let funcionario = $("#nombre").val();
            $('#nombre').val(null).trigger('change');
            $.ajax({
                type: 'POST',
                url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
                data: {
                    nameInstance: 'ExpedienteController',
                    methodInstance: 'insertPemisoExpedienteCont',
                    idsExp: idexpediente,
                    idfuncionario: funcionario
                },
                dataType: 'json',
                success: function (response) {
                    if (response.exito) {
                        loadTable();
                        let typeMessage = "success";
                        if (response.exito == 2) {
                            typeMessage = "warning";
                        }
                        top.notification({
                            message: response.message,
                            type: typeMessage,
                            duration: 3000
                        });
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