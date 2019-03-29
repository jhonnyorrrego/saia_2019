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
    <div class=" container-fluid container-fixed-lg px-0">
        <!-- START card -->
        <div class="card card-default">
            <div class="card-body pb-1">
                <h6>FILTRAR FUNCIONARIOS</h6>
                <form id="kformulario_saia" method="post">
                    <div class="form-group form-group-default">
                        <label>Usuario:</label>
                        <input name="bqsaia_login" type="text" class="form-control">
                        <input type="hidden" name="bksaiacondicion_login" value="like">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Nombres:</label>
                        <input name="bqsaia_nombres" type="text" class="form-control">
                        <input type="hidden" name="bksaiacondicion_nombres" value="like">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Apellidos:</label>
                        <input name="bqsaia_apellidos" type="text" class="form-control">
                        <input type="hidden" name="bksaiacondicion_apellidos" value="like">
                    </div>
                    <div class="form-group form-group-default">
                        <label>Identificación:</label>
                        <input name="bqsaia_nit" type="text" class="form-control">
                        <input type="hidden" name="bksaiacondicion_nit" value="=">
                    </div>
                    <div class="form-group form-group-default form-group-default-select2">
                        <label class="">Perfil</label>
                        <select class="full-width" id="select_perfil" name="bqsaia_perfil">
                            <option value="">Seleccione...</option>
                        </select>
                        <input type="hidden" name="bksaiacondicion_perfil" value="like_comas">
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
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= select2() ?>
    <script>
        $(function() {
            let baseUrl = '<?= $ruta_db_superior ?>';
            $.post(
                `${baseUrl}app/funcionario/consulta_perfiles.php`, {
                    key: localStorage.getItem("key")
                },
                function(response) {
                    if (response.success) {
                        response.data.forEach(element => {
                            $("#select_perfil").append(
                                $("<option>", {
                                    value: element.idperfil,
                                    text: element.nombre
                                })
                            );
                        });
                        $("#select_perfil").select2();
                    }
                },
                "json"
            );
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