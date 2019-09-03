$(function () {
    let params = $('script[data-format-params]').data('formatParams');
    let baseUrl = params.baseUrl;
    let iddoc = params.documentId;

    $(document).off("click", ".finalizar_item_usuario_actual").on("click", ".finalizar_item_usuario_actual", function () {
        
        let iddistribucion=$(this).attr("id");
        top.confirm({
            id: 'question',
            type: 'warning',
            message: 'Está seguro/a de finalizar la distribución?',
            position: 'center',
            timeout: 0,
            overlay: true,
            overlayClose: true,
            closeOnEscape: true,
            closeOnClick: true,
            buttons: [
                [
                    '<button><b>Si</b></button>',
                    function(instance, toast) {
                        instance.hide(
                            { transitionOut: 'fadeOut' },
                            toast,
                            'button'
                        );
                        $.ajax({
                            type:"POST",
                            dataType: "json",
                            url: baseUrl + "app/distribucion/ejecutar_acciones_distribucion.php",
                            data: {
                                iddistribucion: iddistribucion,
                                ejecutar_accion: "finalizar_distribucion",
                                finaliza_manual: 1
                            },
                            success: function(data){
                                $("#"+iddistribucion).hide();
                                if($("#pag-0").attr("id")){
                                    $("#estado_item_" + iddistribucion).html(data.estado);
                                    top.notification({
                                        message: "Distribución Finalizada Satisfactoriamente!",
                                        type: "success",
                                        duration: "3500"
                                    });
                                }else{
                                    var route = $('#acordeon_container').attr('data-location');
                                    route += '&actualizar_pdf=1';
                                    $('#view_document').load(baseUrl + route);
                                }
                            }
                        });
                    },
                    true
                ],
                [
                    '<button>NO</button>',
                    function(instance, toast) {
                        instance.hide(
                            { transitionOut: 'fadeOut' },
                            toast,
                            'button'
                        );
                    }
                ]
            ]
        });			
    });


    $(document).off("click", "#editarRadicacion").on("click", "#editarRadicacion", function () {
        key = localStorage.getItem('key');
        token = localStorage.getItem('token');
        window.open(baseUrl + "formatos/radicacion_entrada/editar_radicacion_entrada.php?iddoc=" + iddoc + "&key=" + key + "&token=" + token, '_self');
    });    


}); 