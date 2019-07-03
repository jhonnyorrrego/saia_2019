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
                        <label>Identificación:</label>
                        <input name="bqsaia_identificacion" type="text" class="form-control">
                        <input type="hidden" name="bksaiacondicion_identificacion" value="=">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Nombre:</label>
                        <input name="bqsaia_nombre" type="text" class="form-control">
                        <input type="hidden" name="bksaiacondicion_nombre" value="like">
                    </div>
                    <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?= $_REQUEST["idbusqueda_componente"]; ?>">
                    <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            let baseUrl = '<?= $ruta_db_superior ?>';

            $(document).keypress(function(event) {
                var keycode = event.keyCode || event.which;
                if (keycode == '13') {
                    $("#ksubmit_saia").trigger('click');
                }
            });

            $('#btn_success').on('click', function() {
                $.post(`${baseUrl}pantallas/busquedas/procesa_filtro_busqueda.php`,
                    $("#kformulario_saia").serialize(),
                    function(data) {
                        if (data.exito) {
                            top.successModalEvent(data);
                            top.closeTopModal();
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

</html>