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

include_once $ruta_db_superior . 'core/autoload.php';

function acceso_modulo($idmodulo = 0)
{

    if ($idmodulo) {
        $modulo = busca_filtro_tabla("nombre", "modulo", "idmodulo=" . $idmodulo, "");
        return PermisoController::moduleAccess($modulo[0]["nombre"]);
    } else {
        return true;
    }
}

$components = busca_filtro_tabla("A.*", "busqueda_componente A, busqueda B", "A.busqueda_idbusqueda=B.idbusqueda AND B.idbusqueda=" . $_REQUEST["idbusqueda"] . " AND A.estado<>0", "orden");
?>
<div class="panel-body">
    <div class="block-nav">
        <?php
        $texto = '';

        for ($i = 0; $i < $components["numcampos"]; $i++) {
            if (!acceso_modulo($components[$i]["modulo_idmodulo"]))
                continue;

            switch ($components[$i]["tipo"]) {
                case 1:
                    //sumary, es un componente tipo div html tiene un label y un info
                    $texto .= '<div class="summary" id="' . $components[$i]["nombre"] . '">';
                    $texto .= '<div class="label"><strong>' . $components[$i]["etiqueta"] . "</strong></div>";
                    $texto .= '<div class="info">' . $components[$i]["info"] . "</div>";
                    $texto .= '</div>';
                    break;
                case 2:
                    //quicksearch (formulario busqueda), es un componente tipo form html la redireccion sale del url en la bd y la estructura completa del codigo inclusive el javascript debe salir del info
                    $texto .= $components[$i]["info"];
                    break;
                case 3:
                    //items navegable , es un componente tipo data-load que hace enlace a un componente kaiten especifico
                    switch ($components[$i]["conector"]) {
                        case 1:
                            $conector = 'html.page';
                            break;
                        case 2:
                            $conector = 'iframe';
                            break;
                        case 3:
                            $conector = 'html.string';
                            break;
                        case 4:
                            $conector = 'html.dom';
                            break;
                        default:
                            $conector = '';
                            break;
                    }

                    if ($components[$i]["url"]) {
                        $url = '../../' . $components[$i]["url"];
                    } else {
                        $url = '../../' . 'pantallas/busquedas/consulta_busqueda_tabla.php';
                    }

                    if ($url) {
                        if ($components[$i]["conector"] == 1 || $components[$i]["conector"] == 2) {
                            if (strpos($url, "?")) {
                                $url .= "&";
                            } else {
                                $url .= "?";
                            }

                            $url .= 'idbusqueda_componente=' . $components[$i]["idbusqueda_componente"];
                        }
                    }

                    if ($conector) {
                        $texto .= '<div title="' . $components[$i]["etiqueta"] . '" data-load=\'{"kConnector":"' . $conector . '", "url":"' . $url . '", "kTitle":"' . $components[$i]["etiqueta"] . '"}\' class="items navigable">';
                        $texto .= '<div class="head"></div>';
                        $texto .= '<div class="label">' . $components[$i]["etiqueta"] . '</div>';
                        $texto .= '<div class="info"></div>';
                        $texto .= '<div class="tail"></div>';
                        $texto .= '</div>';
                    }
                    break;
                case 4:
                    $etiqueta = codifica_encabezado(html_entity_decode($components[$i]['etiqueta']));
                    $url = $ruta_db_superior . $components[$i]['url'];

                    switch ($components[$i]["conector"]) {
                        case 1:
                            $conector = 'html.page';
                            break;
                        case 2:
                            $conector = 'iframe';
                            break;
                        case 3:
                            $conector = 'html.string';
                            break;
                        case 4:
                            $conector = 'html.dom';
                            break;
                        default:
                            $conector = '';
                            break;
                    }

                    $texto .= '<div title="' . $etiqueta . '" data-load=\'{"kConnector":"' . $conector . '", "url":"' . $url . '", "kTitle":"' . $etiqueta . '"}\' class="items navigable">';
                    $texto .= '<div class="head"></div>';
                    $texto .= '<div class="label">' . $etiqueta . '</div>';
                    $texto .= '<div class="info"></div>';
                    $texto .= '<div class="tail"></div>';
                    $texto .= '</div>';

                    break;
                default:
                    //sumary error, es un componente tipo div html tiene un label y un info con la descripcion del error en la secuencia de la base de datos.
                    $texto .= '<div class="summary" id="error_' . $components[$i]["nombre"] . '">';
                    $texto .= '<div class="label"><strong> ERROR EN EL COMPONENTE ' . $components[$i]["etiqueta"] . "  Tipo:" . $components[$i]["tipo"] . " NO RECONOCIDO</strong></div>";
                    $texto .= '<div class="info">' . $components[$i]["info"] . "</div>";
                    $texto .= '</div>';
                    break;
            }
        }
        echo $texto;
        ?>
    </div>
</div>