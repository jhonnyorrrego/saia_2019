$(function () {
    let params = $('#correspondencia').data('params');
    let baseUrl = params.baseUrl;

    $(document).off("click", ".finalizar_item_usuario_actual").on("click", ".finalizar_item_usuario_actual", function () {
        if(confirm("Esta seguro/a de finalizar la distribución?")){
            var iddistribucion=$(this).attr("id");

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
                    console.log(data);
                    top.notification({
                        message: "distribución finalizada satisfactoriamente!",
                        type: "success",
                        duration: "3500"
                    });
                }
            });
        } 					
    });
}); 