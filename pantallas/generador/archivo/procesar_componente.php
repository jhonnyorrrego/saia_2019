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
include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "pantallas/lib/librerias_componentes.php";

function procesar_archivo($idcampo = '', $seleccionado = '', $accion = '', $campo = '') {
    global $conn, $ruta_db_superior;
    $campo = '';
    if ($idcampo == '') {
        return "<div class='alert alert-error'>No existe campo para procesar</div>";
    }
    if ($campo == '') {
        $dato = busca_filtro_tabla("A.*", "campos_formato A", "A.idcampos_formato=" . $idcampo, "", $conn);
        $campo = $dato[0];
    }
    if ($seleccionado != '') {
        $texto = $seleccionado;
    } else {
        $texto = $campo["predeterminado"];
    }
    $extensiones = ".jpg,.png";
    $obligatoriedad = 0;
    $multiple = "true";
    $idelemento = "dz_campo_$idcampo";
    $texto .= '<div id="' . $idelemento . '" class="saia_dz" data-nombre-campo="' . $campo["nombre"] . '" data-idcampo-formato="' . $idcampo . '" data-extensiones="' . $extensiones . '" data-multiple="' . $multiple . '">';
    $texto .= '<div class="dz-message"><span>Arrastra el anexo hasta aqu&iacute;. </br> O si prefieres...</br></br> <span class="boton_upload">Elije un anexo para subir.</span> </span></div>';
    if ($obligatoriedad) {
        $texto .= '<input type="hidden" class="required" id="' . $campo["nombre"] . '" name="' . $campo["nombre"] . '" value="">';
    }
    $uuid = uniqid("$idcampo-") . "-" . uniqid();
    $texto .= '<input type="hidden" id="form_uuid" name="form_uuid" value="' . $uuid . '">';

    $texto .= '</div>';

    return $texto;


}

?>
