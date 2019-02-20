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
            { field: 'expVinc', title: 'EXPEDIENTES VINCULADOS',align:'center' }
        ]    
    });

    $(document).on("click",".remove-doc",function(){
        $(this).closest("tr").remove();
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
            let sel=$('#treebox').fancytree('getTree').getSelectedNodes();
            $.each( sel, function( i, val ) {
                $( "#" + val ).text( "Mine is " + val + "." );
            });
            console.log(sel)
            /*
            console.log($("#table").bootstrapTable('getData'));
            alert(JSON.stringify($("#table").bootstrapTable('getData')))*/
            return false;
        }
    })

});
</script>