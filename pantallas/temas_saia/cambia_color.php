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
include_once ($ruta_db_superior . "db.php");

$color = "";

if (!isset($_REQUEST["color"])) {
    die("Debe especificar un color");
}
$color = $_REQUEST["color"];
$valores = [
    "azul" => [
        'icono_saia' => 'logosaia_azul.png',
        'letra_tabs' => '#0B7BB6',
        'letra_panel_kaiten' => '#FFFFFF',
        'label_info' => '#0B7BB6',
        'imagen_minimizar' => '#69B3E3',
        'icono_maximizar' => '#69B3E3',
        'fondo_tab' => '#EDF9FF,#EDF9FF',
        'foco_input' => '#CCCCCC',
        'enlace_hover' => '#006699',
        'color_letra_ppal' => '#0B7BB6',
        'color_encabezado_list' => '#57B0DE',
        'color_encabezado' => '#57B0DE',
        'btn_primary' => '#6BA5DD,#0044CC',
        'boton_hover' => '#0044cc',
        'borde_input' => '#CCCCCC',
        'barra_inferior' => '#69B3E3',
        'barra_busqueda' => '#6BA5DD,#196BBA',
        'letra_tabs_superior' => '#0B7BB6',
        'color_letra_modulos' => '#69B3E3',
        'color_letra_buzones' => '#69B3E3',
        'color_letra_login' => '#69B3E3',
        'noty_text' => '#6BA5DD'
    ],
    "gris" => [
        'icono_saia' => 'logosaia_gris.png',
        'letra_tabs' => '#FFFFFF',
        'letra_panel_kaiten' => '#FFFFFF',
        'label_info' => '#0B7BB6',
        'imagen_minimizar' => '#696E6F',
        'icono_maximizar' => '#696E6F',
        'fondo_tab' => '#696E6F,#696E6F',
        'foco_input' => '#cccccc',
        'enlace_hover' => '#696E6F',
        'color_letra_ppal' => '#696E6F',
        'color_encabezado_list' => '#696E6F',
        'color_encabezado' => '#696E6F',
        'btn_primary' => '#696E6F,#696E6F',
        'boton_hover' => '#696E6F',
        'borde_input' => '#cccccc',
        'barra_inferior' => '#696E6F',
        'barra_busqueda' => '#696E6F,#696E6F',
        'letra_tabs_superior' => '#6E6E6E'
    ],
    "rojo" => [
        'icono_saia' => 'logosaia_rojo.png',
        'letra_tabs' => '#FFFFFF',
        'letra_panel_kaiten' => '#FFFFFF',
        'label_info' => '#FE2E2E',
        'imagen_minimizar' => '#808285',
        'icono_maximizar' => '#808285',
        'fondo_tab' => '#6E6E6E,#808285',
        'foco_input' => '#808285',
        'enlace_hover' => '#808285',
        'color_letra_ppal' => '#808285',
        'color_encabezado_list' => '#808285',
        'color_encabezado' => '#808285',
        'btn_primary' => '#6E6E6E,#808285',
        'boton_hover' => '#808285',
        'borde_input' => '#cccccc',
        'barra_inferior' => '#E8001E',
        'barra_busqueda' => '#6E6E6E,#808285',
        'letra_tabs_superior' => '#E8001E',
        'color_letra_modulos' => '#808285',
        'color_letra_buzones' => '#E8001E',
        'color_letra_login' => '#808285',
        'noty_text' => '#6E6E6E'
    ],
    "verde" => [
        'icono_saia' => 'logosaia_verde.png',
        'letra_tabs' => '#FFFFFF',
        'letra_panel_kaiten' => '#FFFFFF',
        'label_info' => '#666666',
        'imagen_minimizar' => '#A5CE5D',
        'icono_maximizar' => '#A5CE5D',
        'fondo_tab' => '#A5CE5D,#A5CE5D',
        'foco_input' => '#CCCCCC',
        'enlace_hover' => '#A5CE5D',
        'color_letra_ppal' => '#666666',
        'color_encabezado_list' => '#666666',
        'color_encabezado' => '#666666',
        'btn_primary' => '#666666,#A5CE5D',
        'boton_hover' => '#A5CE5D',
        'borde_input' => '#CCCCCC',
        'barra_inferior' => '#A5CE5D',
        'barra_busqueda' => '#A5CE5D,#666666',
        'letra_tabs_superior' => '#666666'
    ]
];

$resp = 0;

if ($_REQUEST['color'] != '') {
    unlink($ruta_db_superior . "asset/img/layout/logosaia.png");
    copy($ruta_db_superior . "pantallas/temas_saia/tema_$color/logosaia_$color.png", $ruta_db_superior . "asset/img/layout/logosaia.png");
    foreach ($valores[$color] as $key => $value) {
        if (strpos($value, "#") !== false) {
            if (is_file($ruta_db_superior . "asset/img/layout/" . $value)) {
                unlink($ruta_db_superior . "asset/img/layout/" . $value);
                copy($ruta_db_superior . "pantallas/temas_saia/tema_$color/" . $value, $ruta_db_superior . "asset/img/layout/" . $value);
            }
        }
        $update = "update configuracion set valor='" . $value . "' where nombre = '$key'";
        phpmkr_query($update) or die($update);
        $resp = 1;
    }
}
echo $resp;
?>