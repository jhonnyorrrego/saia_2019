$(function () {
    let params = $('#correspondencia').data('params');
    let baseUrl = params.baseUrl;

    $(document).off("click", ".finalizar_item_usuario_actual").on("click", ".finalizar_item_usuario_actual", function () {

        let iddistribucion=$(this).attr("id");
        top.confirm({
            id: 'question',
            type: 'warning',
            message: 'Está seguro/a de finalizar la distribución?',
            position: 'center',
            timeout: 0,
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
                            url: baseUrl + "distribucion/ejecutar_acciones_distribucion.php",
                            data: {
                                iddistribucion: iddistribucion,
                                ejecutar_accion: "finalizar_distribucion",
                                finaliza_manual: 1
                            },
                            success: function(data){
                                $("#estado_item_" + iddistribucion).html(data.estado);
                                top.notification({
                                    message: "Distribución Finalizada Satisfactoriamente!",
                                    type: "success",
                                    duration: "3500"
                                });
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
}); 