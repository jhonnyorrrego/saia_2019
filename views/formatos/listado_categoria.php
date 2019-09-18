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

include_once $ruta_db_superior . "core/autoload.php";
include_once $ruta_db_superior . "assets/librerias.php";

$idcategoria_formato = $_REQUEST['idcategoria_formato'] ?? 2;
$formats = Formato::findAllByAttributes([
    'cod_padre' => 0,
]);
$proceso = busca_filtro_tabla('', 'categoria_formato', 'idcategoria_formato=' . $idcategoria_formato, '');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= accionesKaiten() ?>
</head>

<body>
    <div class="container" style="font-size:16px">
        <div class="row pt-2">
            <div class="col-12">
                <table class="table table-hover table-bordered">
                    <tr>
                        <td class="text-center">
                            <b><?= strtoupper($proceso[0]['nombre']) ?></b>
                        </td>
                    </tr>
                    <?php foreach ($formats as $Formato) :
                        $categories = explode(',', $Formato->fk_categoria_formato);

                        if (!in_array($idcategoria_formato, $categories)) {
                            continue;
                        }

                        if (PermisoController::moduleAccess($Formato->nombre)) :
                            $enlace_adicionar = "formatos/{$Formato->nombre}/{$Formato->ruta_adicionar}?";
                            $enlace_adicionar .= http_build_query($_REQUEST + ['idformato' => $Formato->getPK()]);
                            ?>
                            <tr>
                                <td>
                                    <div class="kenlace_saia" style="cursor:pointer" titulo="<?= $Formato->etiqueta ?>" title="<?= $Formato->etiqueta ?>" enlace="<?= $enlace_adicionar . $adicional ?>" conector="iframe">
                                        <?= $Formato->etiqueta ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>