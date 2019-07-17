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

$params = json_encode([
    'baseUrl' => $ruta_db_superior,
    'documentId' => $_REQUEST['documentId']
]);
?>
<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Devolver</title>
</head>

<body>
    <div class="container-fluid px-0">
        <!-- START card -->
        <div class="card card-default mb-0">
            <div class="card-body py-2">
                <form id="user_form">
                    <p>Los campos con <span class="text-danger">*</span> son obligatorios</p>
                    <div class="form-group form-group-default">
                        <label>CAMBIANDO ESTADO AL DOCUMENTO:</label>
                        <span id="document_description"></span>
                    </div>
                    <div class="form-group form-group-default">
                        <label>Fecha:</label>
                        <span id="return_date"></span>
                        <input type="hidden" name="fecha">
                    </div>
                    <div class="form-group form-group-default">
                        <label>DEVUELTO A:</label>
                        <span id="username"></span>
                        <input type="hidden" name="userId">
                    </div>
                    <div class="form-group form-group-default required">
                        <label class="pl-1 mb-0 mt-1">MOTIVO</label>
                        <div class="radio radio-success my-0">
                            <input id="mdvu" type="radio" name="motivo" value="Mal direccionamiento de Ventanilla Unica" required>
                            <label for="mdvu">Mal direccionamiento de Ventanilla Unica</label>
                            <input id="cfu" type="radio" name="motivo" value="Cambio de Funciones del Usuario">
                            <label for="cfu">Cambio de Funciones del Usuario</label>
                            <input id="cd" type="radio" name="motivo" value="Se Necesitan Cambios en el Documento">
                            <label for="cd">Se Necesitan Cambios en el Documento</label>
                            <input id="other" type="radio" name="motivo" value="Otras">
                            <label for="other"> Otras</label>
                        </div>
                    </div>
                    <div class="form-group form-group-default required">
                        <label>OBSERVACIONES</label>
                        <textarea name="observacion" id="observation" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="<?= $ruta_db_superior ?>views/documento/js/devolver.js" data-returnparams='<?= $params ?>'>
    </script>
</body>

</html>