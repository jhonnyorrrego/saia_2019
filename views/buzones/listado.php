<?php
$max_salida = 10;
$ruta_db_superior = $ruta = "";

while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';
include_once $ruta_db_superior . 'librerias_saia.php';

global $conn;
$component = busca_filtro_tabla('a.ruta_libreria_pantalla,b.encabezado_componente', 'busqueda a,busqueda_componente b', 'a.idbusqueda = b.busqueda_idbusqueda and b.idbusqueda_componente='. $_REQUEST['idbusqueda_componente'], '', $conn);
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>SAIA - SGDEA</title>
        <?= jquery() ?>
        <?= bootstrap() ?>
        <?= icons() ?>
        <?= bootstrapTable() ?>
        <?= theme() ?>
    </head>
    <body>
        <div class="container px-2">
            <div class="row sticky-top bg-master-lightest mx-0" style="height:36px" id="header_list"></div>
            <div class="row mx-0" id="content">
                <table id="table" data-selections=""></table>
            </div>
        </div>
        <script data-baseurl='<?= $ruta_db_superior ?>' id="baseUrl">
            $(function(){
                var baseUrl = '<?= $ruta_db_superior ?>';
                var encabezado = '<?= $component[0]['encabezado_componente'] ?>'
                var component = '<?= $_REQUEST['idbusqueda_componente'] ?>';
                var param = '<?= $_REQUEST['variable_busqueda'] ?>';

                $('#table').bootstrapTable({
                    url: `${baseUrl}app/busquedas/datosBootstrapTable.php?idbusqueda_componente=${component}&variable_busqueda=${param}`,
                    sidePagination: 'server',
                    queryParamsType: 'other',
                    columns: [{
                        field: 'info',
                    }],
                    responseHandler: function(response){
                        for (let index = 0; index < response.rows.length; index++) {
                            let node = $(response.rows[index].info);
                            let identificador = node.find('.identificator').val();

                            node.find('#checkbox_location').html(`<input data-index="${index}" data-id="${identificador}" name="btSelectItem" type="checkbox">`);

                            response.rows[index].info = node.prop('outerHTML');
                        }
                        
                        return response;
                    },
                    onPostBody: function(){
                        var selections = $('#table')
                            .data('selections')
                            .split(',')
                            .map(Number)
                            .filter(n => n > 0);

                        if(sessionStorage.getItem('documentSelected')){
                            let id = sessionStorage.getItem('documentSelected');
                            let index = $(`input[data-id="${+id}"]`).data('index');
                            $(`tr[data-index="${+index}"]`).addClass('selected');
                        }
                        
                        if(selections.length){
                            $('[name="btSelectItem"]').each(function (i, e) {
                                let selected = $.inArray($(e).data('id'), selections) != -1;
                                $(e).attr('checked', selected);

                                if(selected){
                                    $(`tr[data-index="${$(e).data('index')}"]`).addClass('selected');
                                }
                            });

                            $("#selected_rows").text(selections.length);
                        }
                    },
                    onClickRow: function(row, element, field){
                        element.parent().find('tr[data-index]').each(function(i, e){
                            if(!$(e).find(':checkbox').is(':checked'))
                                $(e).removeClass('selected');
                            else
                                $(e).addClass('selected');

                        });
                        element.addClass('selected');
                    },
                    cardView : true,
                    pagination: true,
                    maintainSelected: true,
                    pageSize: 20
                });

                $('#table').on('check.bs.table uncheck.bs.table', function () {
                    var selections = $(this).data('selections').split(',').map(Number).filter(n => n > 0);

                    $('[name="btSelectItem"]').each(function (i, element) {
                        let id = $(element).data('id');
                        
                        if(element.checked && $.inArray(id, selections) == -1){
                            selections.push(id);
                        }else if(!element.checked){
                            selections = selections.filter(n => n != id );
                        }
                    });

                    $(this).data('selections', selections.join(','))
                    $("#selected_rows").text(selections.length);
                });

                if(encabezado){
                    $("#header_list").load(baseUrl+encabezado,{
                        idbusqueda_componente: component
                    }, function(){
                        $('[data-toggle="tooltip"]').tooltip();
                    });
                }
            });
        </script>
        <?php
            if ($component['numcampos'] && $component[0]['ruta_libreria_pantalla']) {
                $libraries = explode(',', $component[0]['ruta_libreria_pantalla']);

                foreach ($libraries as $librarie) {
                    include_once $ruta_db_superior . $librarie;
                }
            }
        ?>
    </body>
</html>