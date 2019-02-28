$(document).ready(function (){
    var params = $("#scriptAsignarEntSe").data("params");

    var loadTable=function(){
            $.ajax({
            type : 'POST',
            url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
            data: {
                nameInstance:'CajaController',
                methodInstance:'getCajaEntidadSerieCont',
                idcaja:params.idcaja
            },
            dataType: 'json',
            success: function(response){
                if(response.exito){
                    $("#data-table").empty();
                    if(response.data.length){
                        $.each(response.data, function( index, row ) {
                            let tr=`<tr id="tr_${row.idcaja_entidadserie}">
                                <td>${row.nombreDependencia}</td>
                                <td>${row.nombreSerie}</td>
                                <td>${row.fechaCreacion}</td>
                                <td><button class="btn btn-danger" data-id="${row.idcaja_entidadserie}"><i class="fa fa-trash"></i></button></td>
                            </tr>`;
                            $("#data-table").append(tr);
                        });
                    }else{
                        $("#data-table").append('<tr id="row-0"><td colspan="3">SIN VINCULACIONES</td></tr>')
                    }
                }else{
                    top.notification({
                        message : response.message,
                        type : "error",
                        duration : 3000
                    });
                }
            },
            error : function() {
                top.notification({
                    message : "Error al procesar la solicitud",
                    type : "error",
                    duration : 3000
                });
            }
        });
    }
    loadTable();

    $(document).off("click", ".btn-danger");
    $(document).on("click",".btn-danger",function(){
        var idvinculo = $(this).data("id");

        top.confirm({
            type: 'error',
            message: 'Está seguro de desvincular la Dependencia/serie?',
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
                                nameInstance: 'CajaController',
                                methodInstance: 'deleteVinCajaEntidadSerieCont',
                                idcaja_entidadserie: idvinculo
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
        multiple:true,
        minimumInputLength: 4,
        ajax: {
        url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
        dataType: 'json',
        quietMillis: 1000,
        data: function (paramsSelec2) {
            var query = {
                search: paramsSelec2.term,
                idcaja: params.idcaja,
                methodInstance: 'listEntidadSerie',
                nameInstance: 'CajaController'
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
        cache:true
        }
    });

    $("#formulario").validate({
        rules : {
            nombre : {
                required : true
            },
            idcaja : {
                required : true
            }
        },
        submitHandler : function(form) {
            $("#vincularSerie").attr('disabled',true);
            let idcaja=$("#idcaja").val();
            let idfk_entidadSerie=$("#nombre").val();
            $('#nombre').val(null).trigger('change');

            $.ajax({
                type : 'POST',
                url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
                data: {
                    nameInstance:'CajaController',
                    methodInstance:'insertCajaEntidadSerieCont',
                    idcaja:idcaja,
                    ids:idfk_entidadSerie
                },
                dataType: 'json',
                success: function(response){
                    if(response.exito){
                        loadTable();
                        let typeMessage="success";
                        if(response.exito==2){
                            typeMessage="warning";
                        }
                        top.notification({
                            message : response.message,
                            type : typeMessage,
                            duration : 3000
                        });
                    }else{
                        top.notification({
                            message : response.message,
                            type : "error",
                            duration : 3000
                        });
                    }
                },
                error : function() {
                    top.notification({
                        message : "Error al procesar la solicitud",
                        type : "error",
                        duration : 3000
                    });
                }
            });
        }
    });

});
    