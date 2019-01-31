<?php
$max_salida = 6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
  }
  $ruta .= "../";
  $max_salida--;
}
include_once $ruta_db_superior . "db.php";
include_once $ruta_db_superior . "pantallas/lib/librerias_componentes.php";
function procesar_hidden($idcampo = '', $seleccionado = '', $accion = '', $campo = '')
{
  global $conn;
  if ($idcampo == '') {
    return "<div class='alert alert-error'>No existe campo para procesar</div>";
  }
  if ($campo == '') {
    $dato = busca_filtro_tabla("A.*, B.idpantalla_componente", "campos_formato A,pantalla_componente B", "A.etiqueta_html=B.nombre AND A.idcampos_formato=" . $idcampo, "", $conn);
    $campo = $dato[0];
  }

  $texto = '';
  $encabezado_hidden = '';
  $pie_hidden = '';
  $adicionales_hidden = ' type="hidden" ';
  if ($seleccionado == '') {
    if ($campo["valor"] == "now()") {
      if ($campo["tipo_dato"] == "date") {
        $seleccionado = date('Y-m-d');
      } else if ($campo["tipo_dato"] == "datetime") {
        $seleccionado = date('Y-m-d H:i:s');
      }
    } else {
      $seleccionado = $campo["valor"];
    }
  }
  if ($accion == '') {
    $eliminarCampo = clase_eliminar_pantalla_componente($idcampo);
    $adicionales_hidden = ' type="text" class="elemento_formulario" placeholder="' . $campo["placeholder"] . '"  disabled="disabled" ';
    $encabezado_hidden = "<li class ='ui-state-default element' idpantalla_componente = '{$campo["idpantalla_componente"]}' idpantalla_campo = '{$idcampo}' id = 'pc_{$idcampo}' nombre = '{$campo["etiqueta_html"]}' >{$eliminarCampo}
    <span class='ui-icon ui-icon-arrowthick-2-n-s' style='font-size:12px;'><b>{$campo["etiqueta"]}";
    if ($campo["obligatoriedad"]) {
      $encabezado_hidden .= '*';
    }
    $encabezado_hidden .= '</b></span><div class="controls">';
    $pie_hidden = '</div></li>';
  }
  $texto .= $encabezado_hidden . '<input ' . $adicionales_hidden . ' name="' . $campo["nombre"] . '" id="' . $campo["nombre"] . '" value="' . $seleccionado . '">' . $pie_hidden;
  return $texto;
}
?>
