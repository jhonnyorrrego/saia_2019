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
$lista_formatos = busca_filtro_tabla("", "formato", "mostrar=1 AND (cod_padre IS NULL OR cod_padre=0) AND (fk_categoria_formato like'" . $idcategoria_formato . "' OR   fk_categoria_formato like'%," . $idcategoria_formato . "'  OR   fk_categoria_formato like'" . $idcategoria_formato . ",%' OR   fk_categoria_formato like'%," . $idcategoria_formato . ",%') AND (fk_categoria_formato like'2' OR   fk_categoria_formato like'%,2'  OR   fk_categoria_formato like'2,%' OR   fk_categoria_formato like'%,2,%')", "etiqueta ASC", $conn);
$proceso = busca_filtro_tabla('', 'categoria_formato', 'idcategoria_formato=' . $idcategoria_formato, '', $conn);
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
                        <td class="text-center"><b>
                                <?= strtoupper($proceso[0]['nombre']) ?></b></td>
                    </tr>
                    <?php for ($i = 0; $i < $lista_formatos['numcampos']; $i++) :
                        if (PermisoController::moduleAccess($lista_formatos[$i]['nombre'])) :
                            $etiqueta = $lista_formatos[$i]['etiqueta'];
                            $etiqueta = ucwords(strtolower($etiqueta));

                            $enlace_adicionar = 'formatos/' . $lista_formatos[$i]['nombre'] . '/' . $lista_formatos[$i]['ruta_adicionar'] . '?';
                            $enlace_adicionar .= http_build_query($_REQUEST + ['idformato' => $lista_formatos[$i]['idformato']]);
                            ?>
                            <tr>
                                <td>
                                    <div class="kenlace_saia" style="cursor:pointer" titulo="<?= $etiqueta ?>" title="<?= $etiqueta ?>" enlace="<?= $enlace_adicionar . $adicional ?>" conector="iframe">
                                        <?= $etiqueta ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endfor; ?>
                </table>
            </div>
        </div>
    </div>
</body>

</html>