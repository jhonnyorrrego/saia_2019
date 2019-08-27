<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
include_once $ruta_db_superior . 'core/autoload.php';

function procesar_textarea_cke($idcampo = '', $seleccionado = '', $accion = '', $campo = '')
{
    global $conn, $ruta_db_superior;
    $campo = '';
    if ($idcampo == '') {
        return "<div class='alert alert-error'>No existe campo para procesar</div>";
    }
    if ($campo == '') {
        $dato = busca_filtro_tabla("A.*, B.idpantalla_componente", "campos_formato A,pantalla_componente B", "A.etiqueta_html=B.nombre AND A.idcampos_formato=" . $idcampo, "", $conn);
        $campo = $dato[0];
    }
    if ($seleccionado != '') {
        $selec = $seleccionado;
    } else {
        $selec = $campo["predeterminado"];
    }
    $texto = <<<FINTAG
    <li class='ui-state-default element' idpantalla_componente='{$campo["idpantalla_componente"]}' idpantalla_campo='{$idcampo}' id='pc_{$idcampo}' nombre='{$campo["etiqueta_html"]} background:white;'>
FINTAG;
    $texto .= "clase_eliminar_pantalla_componente($idcampo)";
    $obligatoriedad = "";"
    if ($campo["obligatoriedad"]) {
        $obligatoriedad = '*';
    }
    $texto .= "<span style='font-size:12px;'><b>{$campo["etiqueta"]} {$obligatoriedad}</b></span>";

    $texto .= '<div class="controls"><textarea name="' . $campo["nombre"] . '" id="' . $campo["nombre"] . '">' . $selec . '</textarea>';
    $texto .= <<<FINJS
    <script>
    var config = {
        removePlugins : 'sourcedialog,flash,iframe,forms,sourcearea,base64image,div,showblocks,smiley,save',
        width: '70%',
        height: 100
    };
    var editor = CKEDITOR.replace('{$campo["nombre"]}', config);
    </script></div>
</li>
FINJS;
    return $texto;
}
