$(function () {
    let params = $('script[data-format-params]').data('formatParams');
    let baseUrl = params.baseUrl;
    console.log(params);
    $(document).off("click", "#addmessage").on("click", "#addmessage", function () {
        top.topModal({
            url: baseUrl + "formatos/funcionarios_ruta/adicionar_funcionarios_ruta.php",
            params: {
                pantalla: 'padre',
                idpadre: params.documentId,
                padre: params.fk
            },
            size: 'modal-lg',
            title: 'Adicionar mensajeros a la Ruta',
            buttons: {},
            onSuccess: function (data) {
                $.ajax({
                    type: 'POST',
                    url: baseUrl + "formatos/ruta_distribucion/funciones_item.php",
                    dataType: "html",
                    data: {
                        funcionariosDistribucion: 1,
                        idItem: data.id
                    },
                    success: function (dataItem) {
                        $("#funcionarioRuta").append(dataItem);
                    }
                });
            }
        });
    });

    $(document).off("click", "#adddependence").on("click", "#adddependence", function () {
        top.topModal({
            url: baseUrl + "formatos/dependencias_ruta/adicionar_dependencias_ruta.php",
            params: {
                pantalla: 'padre',
                idpadre: params.documentId,
                padre: params.fk
            },
            size: 'modal-lg',
            title: 'Adicionar Dependencias a la Ruta',
            buttons: {},
            onSuccess: function (data) { 
                $.ajax({
                    type:'POST',
                    url: baseUrl + "formatos/ruta_distribucion/funciones_item.php",
                    dataType: "html",
                    data: {
                        dependenciaDistribucion: 1,
                        idItem: data.id
                    },
                    success: function (dataItem) {
                        $("#dependenciaDistribucion").removeClass("hide");
                        $("#dependenciaDistribucion").append(dataItem);
                    }
                });                
            }
        });
    });
}); 