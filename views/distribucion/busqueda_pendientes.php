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

include_once $ruta_db_superior . "assets/librerias.php";

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>
    <div class=" container-fluid px-0">
        <!-- START card -->
        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="kformulario_saia" method="post">
                    <div class="form-group form-group-default">
                        <label>Número:</label>
                        <input name="bqsaia_a@numero" type="text" class="form-control">
                        <input type="hidden" name="bksaiacondicion_a@numero" value="like">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Asunto:</label>
                        <input name="bqsaia_a@descripcion" type="text" class="form-control">
                        <input type="hidden" name="bksaiacondicion_a@descripcion" value="like">
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="form-group form-group-default input-group">
                                <div class="form-input-group">
                                    <label>Fecha inicial:</label>
                                    <input type="hidden" name="bksaiacondicion_a@fecha_x" id="bksaiacondicion_a@fecha_x" value=">=">
                                    <input type="text" class="form-control" name="bqsaia_a@fecha_x" id="initial_date">
                                    <input type="hidden" name="bqsaiaenlace_a@fecha_x" id="bqsaiaenlace_a@fecha_x" value="y" />
                                </div>
                                <div class="input-group-append ">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group form-group-default input-group">
                                <div class="form-input-group">
                                    <label>Fecha final:</label>
                                    <input type="hidden" name="bksaiacondicion_a@fecha_y" id="bksaiacondicion_a@fecha_y" value="<=">
                                    <input type="text" class="form-control" name="bqsaia_a@fecha_y" id="final_date">
                                    <input type="hidden" name="bqsaiaenlace_a@fecha_y" id="bqsaiaenlace_a@fecha_y" value="y" />
                                </div>
                                <div class="input-group-append ">
                                    <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?= $_REQUEST["idbusqueda_componente"]; ?>">
                        <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
                        <input type="hidden" name="bqtipodato" value="date|a@fecha_x,a@fecha_y">  
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            let baseUrl = '<?= $ruta_db_superior ?>';
            
            $('#initial_date,#final_date').datetimepicker({
                locale: 'es',
                format: 'YYYY-MM-DD'
            });

            $('#initial_date')
                .data('DateTimePicker')
                .defaultDate(null);
            $('#final_date')
                .data('DateTimePicker')
                .defaultDate(null);

            $('#btn_success').on('click', function() {
                $.post(`${baseUrl}pantallas/busquedas/procesa_filtro_busqueda.php`,
                    $("#kformulario_saia").serialize(),
                    function(data) {
                        if (data.exito) {
                            top.successModalEvent(data);
                        } else {
                            top.notification({
                                message: data.mensaje,
                                type: 'error'
                            });
                        }
                    },
                    'json');
            });
        });
    </script>
    <script type="text/javascript" src="<?php echo $ruta_db_superior; ?>pantallas/lib/validaciones_formulario.js"></script>
</body>
<?= dateTimePicker() ?>
</html>