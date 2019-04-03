<?php
$max_salida = 6;
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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?= jquery() ?>
    <?= jqueryUi() ?>
    <?= bootstrap() ?>
    <?= theme() ?>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <table id="treegrid">
                    <thead>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th></th>
                            <th>Key</th>
                            <th>Like</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="alignRight"></td>
                            <td class="alignCenter">
                                <input type="checkbox" name="like">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?= fancyTree(true) ?>
    <script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-fancytree/2.30.0/modules/jquery.fancytree.table.js"></script>
</body>

</html> 