<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
  if (is_file($ruta . "db.php")) {
    $ruta_db_superior = $ruta;    
  }
  $ruta .= "../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
ini_get('display_errors',true);
include_once($ruta_db_superior."formatos/librerias/funciones_generales.php");

/*ADICIONAR*/
function validar_responsable($idformato, $iddoc) {
  global $conn;
  $responsable = busca_filtro_tabla("responsables", "ft_hallazgo a", "a.documento_iddocumento=" . $_REQUEST["anterior"], "", $conn);

  $vector = explode(",", str_replace("#", "d", $responsable[0][0]));
  $vector = array_unique($vector);
  sort($vector);
  $arreglo = array();

  foreach ($vector as $fila) {
    if (strpos($fila, 'd') > 0) {
      $datos = busca_filtro_tabla("distinct(funcionario_idfuncionario)", "dependencia_cargo a", "a.estado=1 and dependencia_iddependencia=" . str_replace("d", "", $fila), "", $conn);
      $arreglo = array_merge($arreglo, extrae_campo($datos, "funcionario_idfuncionario"));
    } else {
      if ($pos = strpos($fila, "_"))
        $fila = substr($fila, 0, $pos);
      $datos = busca_filtro_tabla("idfuncionario", "funcionario", "funcionario_codigo=" . $fila, "", $conn);
      $arreglo[] = $datos[0]["idfuncionario"];
    }
  }
  $arreglo[] = 404;
  $arreglo[] = 148;
  if (!in_array(usuario_actual('idfuncionario'), $arreglo)) {
    alerta("Usted no es el Responsable del Mejoramiento");
    abrir_url("../../vacio.php", "_self");
    die();
  }
}

/*ADICIONAR - EDITAR*/
function listado_avance($idformato, $campo, $iddoc = NULL) {
  global $conn;
  $formato = busca_filtro_tabla("", "formato", "idformato=" . $idformato, "", $conn);
  if ($iddoc <> NULL)
    $doc = busca_filtro_tabla("", $formato[0]["nombre_tabla"], "documento_iddocumento=" . $iddoc, "", $conn);

  echo "<td><select name='porcentaje'>";
  for ($i = 0; $i <= 100; $i += 5) {
    echo "<option value='$i' ";
    if ($i == @$doc[0]["porcentaje"])
      echo " selected ";
    echo ">$i</option>";
    if (@$doc[0]["porcentaje"] > $i && @$doc[0]["porcentaje"] < ($i + 5))
      echo "<option value='" . @$doc[0]["porcentaje"] . "' selected >" . @$doc[0]["porcentaje"] . "</option>";
  }
  echo "</select></td>";
}

/*MOSTRAR*/
function mostrar_anexos_seguimientop($idformato, $iddoc) {
  global $conn, $ruta_db_superior;
  $anexos = busca_filtro_tabla("ruta,etiqueta,idanexos", "anexos", "documento_iddocumento=" . $iddoc, "", $conn);
  for ($i = 0; $i < $anexos["numcampos"]; $i++) {
    echo('<a href="' . $ruta_db_superior . 'anexosdigitales/parsea_accion_archivo.php?idanexo=' . $anexos[$i]["idanexos"] . '&accion=descargar" >' . $anexos[$i]["etiqueta"] . '</a><br/>');
  }
}
function mostrar_fecha_seguimiento_plan_mejoramiento($idformato,$iddoc){
    global $conn;
    $fecha=busca_filtro_tabla(fecha_db_obtener("fecha","Y-m-d H:i:s")." AS fecha","documento","iddocumento","",$conn);
    echo($fecha[0]['fecha']);
}
/*POSTERIOR APROBAR*/
function notificar_seguimiento($idformato, $iddoc) {
  global $conn;
  $datos=busca_filtro_tabla("dp.numero,h.responsable_seguimiento,s.logros_alcanzados,s.porcentaje","ft_plan_mejoramiento p,documento dp,ft_hallazgo h,ft_seguimiento s","p.documento_iddocumento=dp.iddocumento and p.idft_plan_mejoramiento=h.ft_plan_mejoramiento and h.idft_hallazgo=s.ft_hallazgo and s.documento_iddocumento=".$iddoc,"",$conn);
  if($datos["numcampos"] && $datos[0]["responsable_seguimiento"]!=""){
    $responsable=explode(",", $datos[0]["responsable"]);
    $mensaje="En la fecha ".date("d/m/Y")." se realizo el formato reporte de avance acciones del Radicado del Plan de Mejoramiento No. ".$datos[0]["numero"].", con la siguiente informacion:<br/><br/>
    <strong>AVANCE: </strong>".$datos[0]["porcentaje"]."<br/><br/>
    <strong>LOGROS ALCANZADOS:</strong> ".html_entity_decode($datos[0]["logros_alcanzados"])."<br/><br/>";
    enviar_mensaje("", $responsable, $mensaje, "e-interno", array(), "Notificacion Reporte de avance acciones");    
  }
}

?>