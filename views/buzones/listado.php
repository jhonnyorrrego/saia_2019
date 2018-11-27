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
        <?= moment() ?>
        <?= theme() ?>
        <?= librerias_acciones_kaiten() ?>
    </head>
    <body>
        <div class="container">
            <div class="row sticky-top bg-master-lightest" id="header_list"></div>
            <div class="row" id="content">
                <table id="table" data-selections=""></table>
            </div>
        </div>
        <script data-baseurl='<?= $ruta_db_superior ?>' id="baseUrl">
            $(function(){
                var baseUrl = '<?= $ruta_db_superior ?>';
                var encabezado = '<?= $component[0]['encabezado_componente'] ?>'
                var component = '<?= $_REQUEST['idbusqueda_componente'] ?>';

                $('#table').bootstrapTable({
                    url: `${baseUrl}app/busquedas/datosBootstrapTable.php?idbusqueda_componente=${component}`,
                    sidePagination: 'server',
                    queryParamsType: 'other',
                    height: $(document).height() - 6,
                    columns: [{
                        field: 'info',
                    }],
                    responseHandler: function(response){
                        for (let index = 0; index < response.rows.length; index++) {
                            let node = $(response.rows[index].info);
                            let identificador = node.find('.identificador').val();

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
                        
                        if(selections.length){
                            $('[name="btSelectItem"]').each(function (i, element) {
                                $(element).attr('checked', $.inArray($(element).data('id'), selections) != -1)
                            });
                        }
                    },
                    onClickRow: function(row, element, field){
                        element.parent().find('tr[data-index]').removeClass('selected');
                        element.addClass('selected');
                    },
                    cardView : true,
                    pagination: true,
                    maintainSelected: true
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
                });

                $("#header_list").load(baseUrl+encabezado,{
                    idbusqueda_componente: component
                }, function(){
                    $('[data-toggle="tooltip"]').tooltip();
                });
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