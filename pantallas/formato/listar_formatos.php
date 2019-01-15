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

include_once $ruta_db_superior . "controllers/autoload.php";
include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "librerias_saia.php";

echo jquery();
echo bootstrap();
echo librerias_acciones_kaiten();

$idcategoria_formato = $_REQUEST['idcategoria_formato'];
if (!$idcategoria_formato) {
	$idcategoria_formato = 2;
}
$lista_formatos = busca_filtro_tabla("idformato,nombre,etiqueta,ruta_adicionar", "formato", "mostrar=1 AND (fk_categoria_formato like '" . $idcategoria_formato . "' OR   fk_categoria_formato like '%," . $idcategoria_formato . "'  OR   fk_categoria_formato like '" . $idcategoria_formato . ",%' OR   fk_categoria_formato like '%," . $idcategoria_formato . ",%') AND (fk_categoria_formato like '2' OR fk_categoria_formato like '%,2'  OR fk_categoria_formato like '2,%' OR fk_categoria_formato like '%,2,%')", "etiqueta ASC", $conn);
$proceso = busca_filtro_tabla('', 'categoria_formato', 'idcategoria_formato=' . $idcategoria_formato, '', $conn);
$nombre_proceso = codifica_encabezado(html_entity_decode($proceso[0]['nombre']));
$nombre_proceso = mb_strtoupper($nombre_proceso);
?>
<div class="container" style="font-size:16px">
    <table class="table table-hover" >
        <tr>
            <td class="text-center"><b><?= $nombre_proceso?></b></td>
        </tr>
        <?php for ($i = 0; $i < $lista_formatos['numcampos']; $i++):
            if (UtilitiesController::permisoModulo('crear_' . $lista_formatos[$i]['nombre'])) :
                $etiqueta = codifica_encabezado(html_entity_decode($lista_formatos[$i]['etiqueta']));
                $etiqueta = ucwords(strtolower($etiqueta));

                $enlace_adicionar = FORMATOS_CLIENTE . $lista_formatos[$i]['nombre'] . '/' . $lista_formatos[$i]['ruta_adicionar'] . '?';
                $enlace_adicionar.= http_build_query($_REQUEST + ['idformato' => $lista_formatos[$i]['idformato']]);
                ?>
                <tr>
                    <td>
                        <div class="kenlace_saia" style="cursor:pointer" titulo="<?= $etiqueta ?>" title="<?= $etiqueta ?>" enlace="<?= $enlace_adicionar . $adicional ?>" conector="iframe"><?= $etiqueta ?></div>
                    </td>
                </tr>
            <?php endif; ?>
        <?php endfor; ?>
    </table>
</div>
