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
include_once $ruta_db_superior . 'core/autoload.php';
function procesar_checkbox($idcampo = '', $seleccionado = '', $accion = '', $campo = '')
{
  global $conn;
  if ($idcampo == '') {
    return ("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
  if ($campo == '') {
    $dato = busca_filtro_tabla("", "campos_formato A", "A.idcampos_formato=" . $idcampo, "", $conn);
    $campo = $dato[0];
  }
  if ($seleccionado != '') {
    $predeterminado = explode(",", $seleccionado);
  } else {
    $predeterminado = explode(",", $campo["predeterminado"]);
  }
  $sql2 = trim($campo["valor"]);
  $accion2 = strtoupper(substr($sql2, 0, strpos($sql2, ' ')));
  $listado0 = array();
  if ($accion2 == "SELECT") {
    $datos = ejecuta_filtro_tabla($campo["valor"], $conn);
    if ($datos["numcampos"]) {
      for ($i = 0; $i < $datos["numcampos"]; $i++) {
        array_push($listado0, html_entity_decode($datos[$i][0] . "," . $datos[$i][1]));
      }
      $llenado = implode(";", $listado0);
    } else alerta("POSEE UN PROBLEMA EN LA BUSQUEDA CAMPO: " . $campo["etiqueta"]);
  } else {
    $dato = busca_filtro_tabla("", "campos_formato A", "A.idcampos_formato=" . $idcampo, "", $conn);
    $llenado = json_decode($dato[0]['opciones'], true);
    $cantidadOpciones = count($llenado);
  }
  $texto = "";
  $listado3 = array();
  if ($cantidadOpciones) {
    for ($j = 0; $j < $cantidadOpciones; $j++) {
      $texto .= '<label class="checkbox inline" for="' . $campo["nombre"] . "_" . $j . '">
      <input type="checkbox" class="checkbox"';
      $texto .= ' name="' . $campo["nombre"] . '[]" id="' . $campo["nombre"] . "_" . $j . '" value="' . $llenado[$j]['llave'] . '"';
      if (in_array(($listado3[$j][0]), $predeterminado))
        $texto .= ' checked ';
      $texto .= '>' . $llenado[$j]['item'] . '</label>';
    }
  } else {
    $texto .= '<label class="checkbox inline" for="">
      <input type="checkbox" class="checkbox"  name="" id="" value="" >1</label>
      <label class="checkbox inline" for="">
      <input type="checkbox" class="checkbox"  name="" id="" value="" >2</label>
      <label class="checkbox inline" for="">
      <input type="checkbox" class="checkbox"  name="" id="" value="" >3</label>
      <label class="checkbox inline" for="">
      <input type="checkbox" class="checkbox"  name="" id="" value="" >4</label>';
  }

  return ($texto);
}
function validacion_adicional_checkbox($reglas, $nombre_campo)
{
  $reglas["rules"][$nombre_campo]["minlength"] = 1;
  return ($reglas);
}
function mostrar_checkbox($idcampo = '', $seleccionado = '', $accion = '', $campo = '')
{
  global $conn;
  if ($idcampo == '') {
    return ("<div class='alert alert-error'>No existe campo para procesar</div>");
  }
  if ($campo == '') {
    $dato = busca_filtro_tabla("", "campos_formato A", "A.idcampos_formato=" . $idcampo, "", $conn);
    $campo = $dato[0];
  }
  if ($seleccionado != '') {
    $predeterminado = $seleccionado;
  } else {
    $predeterminado = $campo["predeterminado"];
  }
  $sql2 = trim($campo["valor"]);
  $accion = strtoupper(substr($sql2, 0, strpos($sql2, ' ')));
  $listado0 = array();

  $seleccionados = explode(",", $seleccionado);
  if ($accion == "SELECT") {
    $datos = ejecuta_filtro_tabla($campo["valor"], $conn);
    if ($datos["numcampos"]) {
      for ($i = 0; $i < $datos["numcampos"]; $i++) {
        array_push($listado0, html_entity_decode($datos[$i][0] . "," . $datos[$i][1]));
      }
      $llenado = implode(";", $listado0);
    } else alerta("POSEE UN PROBLEMA EN LA BUSQUEDA CAMPO: " . $campo["etiqueta"]);
  } else
    $llenado = utf8_encode(html_entity_decode($campo["valor"]));
  $texto = "";
  $listado3 = array();
  $ultimo = substr($llenado, -1);
  if ($ultimo == ";") $llenado = substr($llenado, 0, -1);
  if ($llenado != "" && $llenado != "Null") {
    $listado1 = explode(";", $llenado);
    $cont1 = count($listado1);
    for ($i = 0; $i < $cont1; $i++) {
      $listado2 = explode(",", $listado1[$i]);
      if (in_array($listado2[0], $seleccionados))
        $listado3[] = $listado2[1];
    }
  }
  return (implode(", ", $listado3));
}
 