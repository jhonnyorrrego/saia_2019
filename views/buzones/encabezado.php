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

include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "assets/librerias.php";

$datos_busqueda = busca_filtro_tabla("", "busqueda A,busqueda_componente B", "A.idbusqueda=B.busqueda_idbusqueda AND B.idbusqueda_componente=" . $_REQUEST["idbusqueda_componente"], "");

if ($datos_busqueda[0]["ruta_libreria"]) {
    $librerias = array_unique(explode(",", $datos_busqueda[0]["ruta_libreria"]));
    array_walk($librerias, "incluir_librerias_busqueda");
}

function incluir_librerias_busqueda($elemento, $indice)
{
    global $ruta_db_superior;
    include_once $ruta_db_superior . $elemento;
}
?>
<div class="" id="menu_buscador">
    <?php if ($datos_busqueda[0]["busqueda_avanzada"]) {
        if (strpos($datos_busqueda[0]["busqueda_avanzada"], "?")) {
            $datos_busqueda[0]["busqueda_avanzada"] .= "&";
        } else {
            $datos_busqueda[0]["busqueda_avanzada"] .= "?";
        }

        $datos_busqueda[0]["busqueda_avanzada"] .= 'idbusqueda_componente=' . $datos_busqueda[0]["idbusqueda_componente"];
        ?>
        <div class="btn-group">
            <button class="btn btn-mini kenlace_saia" titulo="B&uacute;squeda <?= $datos_busqueda[0]['etiqueta'] ?>" title="B&uacute;squeda <?= $datos_busqueda[0]['etiqueta'] ?>" conector="iframe" enlace="<?= $datos_busqueda[0]['busqueda_avanzada'] ?>">B&uacute;squeda &nbsp;</button>
        </div>
    <?php } ?>

    <div class="btn-group">
        <button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">
            Seleccionados &nbsp;<span class="caret"></span>
        </button>
        <ul class="dropdown-menu" id='listado_seleccionados'>
            <li>
                <a href="#">
                    <div id="filtrar_seleccionados">Filtrar Seleccionados</div>
                </a>
            </li>
            <li>
                <a href="#">
                    <div id="restaurar_seleccionados">Restaurar Listado</div>
                </a>
            </li>
            <?php if ($datos_busqueda[0]["acciones_seleccionados"]) {
                echo '<li class="nav-header">Acciones</li>';

                $acciones = explode(",", $datos_busqueda[0]["acciones_seleccionados"]);
                $cantidad = count($acciones);
                for ($i = 0; $i < $cantidad; $i++) {
                    echo $acciones[$i]();
                }
            } ?>
        </ul>
    </div>
    <?php if ($datos_busqueda[0]["nombre"] == 'documentos_importantes') { ?>
        <div class="btn-group">
            <button class="btn dropdown-toggle btn-mini" data-toggle="dropdown">
                Indicadores &nbsp;<span class="caret"></span>&nbsp;
            </button>
            <ul class="dropdown-menu" id='listado_indicadores'>
                <li>
                    <a href="#">
                        <div name="filtro_indicadores" valor=""><b>Restaurar Listado</b></div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div name="filtro_indicadores" valor="1"><span class="icon-flag-rojo"></span>&nbsp; Rojo</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div name="filtro_indicadores" valor="2"><span class="icon-flag-morado"></span>&nbsp; Morado</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div name="filtro_indicadores" valor="3"><span class="icon-flag-naranja"></span>&nbsp; Naranja</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div name="filtro_indicadores" valor="4"><span class="icon-flag-amarillo"></span>&nbsp; Amarillo</div>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div name="filtro_indicadores" valor="5"><span class="icon-flag-verde"></span>&nbsp; Verde</div>
                    </a>
                </li>
            </ul>
            <script>
                $(document).ready(function() {
                    $('[name="filtro_indicadores"]').click(function() {
                        var valor = $(this).attr('valor');
                        window.location = 'consulta_busqueda_documento.php?idbusqueda_componente=<?php echo ($datos_busqueda[0]['idbusqueda_componente']); ?>&filtro_indicadores=' + valor + '';
                    });
                });
            </script>

        </div>
        <?php if ($_REQUEST['filtro_indicadores']) {
                $vector_indicadores = array(0 => '<span class="icon-flag"></span>', 1 => '<span class="icon-flag-rojo"></span>', 2 => '<span class="icon-flag-morado"></span>', 3 => '<span class="icon-flag-naranja"></span>', 4 => '<span class="icon-flag-amarillo"></span>', 5 => '<span class="icon-flag-verde"></span>');
                ?>
            <div class="btn-group">
                <button class="btn btn-mini" disabled>
                    <?php echo ($vector_indicadores[intval($_REQUEST['filtro_indicadores'])]); ?>
                </button>
            </div>
        <?php } ?>
    <?php } ?>

    <?php if ($datos_busqueda[0]["enlace_adicionar"]) { ?>
        <div class="btn-group">
            <button class="btn btn-mini kenlace_saia" conector="iframe" id="adicionar_pantalla" destino="_self" title="Adicionar <?php echo ($datos_busqueda[0]["etiqueta"]); ?>" titulo="Adicionar <?php echo ($datos_busqueda[0]["etiqueta"]); ?>" enlace="<?php echo ($datos_busqueda[0]["enlace_adicionar"]); ?>">Adicionar</button>
        </div>
    <?php } ?>

    <?php if ($datos_busqueda[0]["menu_busqueda_superior"]) {
        $funcion_menu = explode("@", $datos_busqueda[0]["menu_busqueda_superior"]);
        echo ($funcion_menu[0](@$funcion_menu[1]));
    }

    if (@$datos_busqueda[0]["exportar"]) {
        if (function_exists(exportar_excel)) {
            echo (exportar_excel());
        }
    } ?>
</div>