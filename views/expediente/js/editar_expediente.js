$(document).ready(function (){
    var params = JSON.parse($('script[data-params]').attr('data-params'));
    if(!params.agrupador){
        if(params.countDocuments || params.countTomos>1){
            $("#AgAgr").remove();
            $('label[for="AgAgr"]').remove();
            $("#notaAgr").text("Este expediente tiene documentos/tomos vinculados");
        }
    }

    $("[name='agrupador']").change(function (){
        if($(this).val()==3){
            $(".ocultar").hide();
        }else{
            $(".ocultar").show();
        }
    });
    $("[name='agrupador']:checked").trigger("change");


    $("#fk_caja").change(function (){
        let actual=$(this).val();
        let padre=$("#cajaAnt").val();
        if(padre!=0 && actual!=0){
            if(actual!=padre){
                top.notification({                                
                    message : "Esta ingresando una caja diferente a la caja del expediente superior",
                    type : "warning",
                    duration : 8000
                });
            }

        }
    });

    $("#iconInfAdicional").click(function (e) { 
        let icon=$(this).hasClass("fa-plus-square");
        if(icon){
            $(this).removeClass("fa-plus-square").addClass("fa-minus-square");
            $("#informacionAdicional").show();
        }else{
            $(this).removeClass("fa-minus-square").addClass("fa-plus-square");
            $("#informacionAdicional").hide();
        }                  
    });
    $("#iconInfAdicional").trigger("click");
    
    var options = {
        url: `${params.baseUrl}views/expediente/informacion.php`,
        params: {
            idexpediente: $("#idexpediente").val()
        },
        size: "modal-lg",
        title: "",
        centerAlign: false,
        buttons: {}
    };

    $("#cancelarExp").click(function (){
        top.topModal(options);
    });

    $("#formularioExp").validate({
        rules : {
            agrupador : {
                required : true
            },
            nombre : {
                required : true
            },
            cod_padre : {
                required : true
            },
            idexpediente : {
                required : true
            }
        },
        submitHandler : function(form) {
            $("#guardarExp").attr('disabled',true);
            let codPadre=$("#cod_padre").val(); 
            let idexpediente=$("#idexpediente").val(); 

            $.ajax({
                type : 'POST',
                url: `${params.baseUrl}app/expediente/ejecutar_acciones.php`,
                data : $("#formularioExp").serialize(),
                dataType : 'json',
                success : function(objeto) {
                    if (objeto.exito) {
                        top.notification({
                            message: objeto.message,
                            type: "success",
                            duration: 3000
                        });
                        top.topModal(options);
                    } else {
                        $("#guardarExp").attr('disabled',false);
                        top.notification({
                            message : objeto.message,
                            type : "error",
                            duration : 3000
                        });
                    }
                },
                error : function() {
                    $("#guardarExp").attr('disabled', false);
                    top.notification({
                        message : "Error al procesar la solicitud (actualizar el expediente)",
                        type : "error",
                        duration : 3000
                    });
                }
            });

            return false;
        }
    });
});