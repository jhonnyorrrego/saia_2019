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
                        <label>Nombre:</label>
                        <input name="bqsaia_nombre" type="text" class="form-control">
                        <input type="hidden" name="bksaiacondicion_nombre" value="like">
                    </div>
                    <div class="form-group">
                        <label class="pl-1 mb-0 mt-1">Estado</label>
                        <div class="radio radio-success my-0">
                            <input type="hidden" name="bksaiacondicion_estado" id="bksaiacondicion_estado" value="=">
                            <input type="radio" value="1" name="bqsaia_estado" id="activo">
                            <label for="activo">Activo</label>
                            <input type="radio" value="0" name="bqsaia_estado" id="inactivo">
                            <label for="inactivo">Inactivo</label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="<?= $_REQUEST["idbusqueda_componente"]; ?>">
                        <input type="hidden" name="adicionar_consulta" id="adicionar_consulta" value="1">
                        <input type="hidden" name="bqtipodato" value="date|b@fecha_x,b@fecha_y">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(function() {
            let baseUrl = '<?= $ruta_db_superior ?>';
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
</body>

</html>