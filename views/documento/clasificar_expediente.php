<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';
echo arboles_ft("2.24", 'filtro');
echo bootstrapTable ();
echo validate();
?>

<div class="container-fluid">
    <form id="formulario" name="formulario">
        <div class="row">
            <div class="col-12 py-2">
                <table id="table" data-selections=""></table>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-12">
                <label>Clasificar en:</label>
                <div id="treebox"></div>
            </div>
        </div>

        <div class="row py-2">
            <div class="col-12">
                <button class="btn btn-complete float-right" id="save">Guardar</button>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function (){
    let baseUrl = Session.getBaseUrl();
    let iddocs=<?= json_encode(explode(',',$_REQUEST['selections'])) ?>;

    $('#table').bootstrapTable({
        url: `${baseUrl}app/expediente/obtener_expediente.php`,
        queryParams: function (queryParams) {
            queryParams.key = localStorage.getItem('key');
            queryParams.ids=iddocs;
            return queryParams;
        },
        columns: [
            { field: 'icono', title: 'OMITIR', align:'center' },
            { field: 'documento', title: 'DESCRIPCIÓN DEL DOCUMENTO' },
            { field: 'tipoDoc', title: 'TIPO DOCUMENTAL' },
            { field: 'expVinc', title: 'EXPEDIENTES VINCULADOS' }
        ]    
    });



    $(document).on("click",".remove-doc",function(){
        let id=$(this).data('id');
        $("#table").bootstrapTable('remove', {
            field: 'id',
            values: [id]
        })

        if($("#table tr").length==1){
            $("#dinamic_modal").modal('hide');
        }
    });

    var configuracion = {
        icon : false,
        lazy : false,
        autoScroll: true,
        strings : {
            loadError : "Error en la carga!",
            moreData : "Mas...",
            noData : "Cargando...."
        },
        selectMode : 2,
        source : {
            url : `${baseUrl}arboles/arbol_expediente_funcionario.php`
        }
    };
    $("#treebox").fancytree(configuracion);
                
    $("#formulario").validate({
        submitHandler : function(form) {
            //$("#save").attr('disabled',true);
            let dataDocs=$("#table").bootstrapTable('getData');
            if(dataDocs.length){
                let iddocs_sel=[];
                let tipo=[];
                $.each( dataDocs, function(i, val ) {
                    iddocs_sel.push(val.id);
                    if(val.idserie){
                        if($.inArray(val.idserie, tipo) === -1){
                            tipo.push(val.idserie);
                        }
                    }
                });

                let idserieDoc= tipo.length ? tipo[0] : 0;
                if(tipo.length<=1){
                    let selTipo=$('#treebox').fancytree('getTree').getSelectedNodes();
                    if(selTipo.length){

                        let tipoSel=[];
                        let expedienteSel=[];

                        $.each( selTipo, function(i, val ) {
                            if($.inArray(val.data.fk_serie, tipoSel) === -1){
                                tipoSel.push(val.data.fk_serie);
                            }
                            expedienteSel.push(val.data.fk_expediente);
                        });
                        
                        if(tipoSel.length==1){
                            if(!idserieDoc || (idserieDoc==tipoSel[0])){
                                $.ajax({
                                    type : 'POST',
                                    async : false,
                                    url: `${baseUrl}pantallas/ejecutar_acciones.php`,
                                    data : {
                                        methodInstance:'VincularExpedienteDocCont',
                                        nameInstance:'ExpedienteController',
                                        iddocumentos:iddocs_sel,
                                        idexpedientes:expedienteSel,
                                        tipodocumental:tipoSel[0]
                                    },
                                    dataType : 'json',
                                    success : function(objeto) {
                                        if (objeto.exito) {
                                            top.notification({
                                                message : objeto.message,
                                                type : "success",
                                                duration : 3000
                                            });
                                            $("#dinamic_modal").modal('hide');
                                        } else {
                                            top.notification({
                                                message : objeto.message,
                                                type : "error",
                                                duration : 3000
                                            });
                                        }
                                    },
                                    error : function() {
                                        top.notification({
                                            message : "Error al procesar la solicitud (clasificar expediente)",
                                            type : "error",
                                            duration : 3000
                                        });
                                    }
                                });

                            }else{
                                top.notification({
                                    message : 'Los expedientes seleccionados NO tienen el mismo tipo que los documentos',
                                    type : "error",
                                    duration : 3000
                                });
                            }
                        }else{
                            top.notification({
                                message : 'debe seleccionar expedientes con el mismo tipo documental',
                                type : "error",
                                duration : 3000
                            });
                        }

                    }else{
                        top.notification({
                            message : 'Por favor seleccione el expediente',
                            type : "error",
                            duration : 3000
                        });
                    }
                }else{
                    top.notification({
                        message : 'Los documentos pertenecen a tipos documentales diferentes',
                        type : "error",
                        duration : 3000
                    });
                }
            }else{
                top.notification({
                    message : 'Por favor seleccione los documentos',
                    type : "error",
                    duration : 3000
                });
            }
            return false;
        }
    })

});
</script>