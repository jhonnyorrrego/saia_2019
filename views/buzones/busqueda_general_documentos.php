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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SAIA - SGDEA</title>
</head>

<body>
<div class="container">
    <div class="row">
        <div class="col-12">
            <form id="find_documents_form">
                <input type="hidden" name="idbusqueda_componente" id="component">
                <div class="form-group form-group-default">
                    <label>Radicado:</label>
                    <input name="numero" type="text" class="form-control">
                </div>
                <div class="form-group">
                    <button type="reset" class="btn btn-danger">Limpiar</button>
                    <button type="submit" class="btn btn-complete">Buscar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="<?= $ruta_db_superior ?>views/buzones/js/busqueda_general_documentos.js" data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>
</html>