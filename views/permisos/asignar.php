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
                <form id="permissions">
                    <input type="hidden" name="type" value="<?= $_REQUEST['type'] ?>">
                    <input type="hidden" name="typeId" value="<?= $_REQUEST['typeId'] ?>">
                    <input type="hidden" name="user" id="user_list">
                    <input type="hidden" name="key">
                    <div class="row py-1">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="pl-1">Privacidad</label>
                                <div>
                                    <label class="px-1" for="publico">
                                        <input type="radio" value="1" name="private" id="public">
                                        Público
                                    </label>
                                    <label class="px-1" for="inactivo">
                                        <input type="radio" value="2" name="private" id="private">
                                        Privado
                                    </label>
                                    <label class="px-1" for="specific">
                                        <input type="radio" value="3" name="private" id="specific">
                                        Usuarios especificos
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row py-1" id="user_container">
                        <div class="col-12">
                            <div class="form-group form-group-default form-group-default-select2">
                                <label>Responsable:</label>
                                <select class="full-width" id="select_responsable" multiple="multiple"></select>                                
                            </div>
                        </div>
                    </div>
                    <div class="row py-1" id="edit_container">
                        <div class="col-12">
                            <div class="form-group">
                                <input name="edit" value="1" type="checkbox" id="edit">
                                <label for="edit">Puede editar y compartir</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group pull-right">
                        <button type="submit" class="btn btn-complete">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?= select2() ?>
    <script src="<?= $ruta_db_superior ?>views/permisos/js/asignar.js" data-baseurl="<?= $ruta_db_superior ?>"></script>
</body>

</html> 