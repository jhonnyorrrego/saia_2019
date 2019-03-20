<?php

$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
      }
    $ruta .= "../";
    $max_salida--;
  }

include_once($ruta_db_superior . "db.php");
include_once($ruta_db_superior . "calendario/calendario.php");

function busca_nodos($id = null)
{
  global $conn;
  $resultado = array();

  if (!isset($id))  //Obtengo la dependencia de mas alto nivel !! sin Padre
    {
      $dependencias = busca_filtro_tabla("*", "dependencia d", "cod_padre is NULL AND d.estado=1", "nombre ASC", $conn);
    } else // Dependencias con padre !!
    {
      $dependencias = busca_filtro_tabla("*", "dependencia d", "d.cod_padre=$id AND d.estado=1 ", "d.nombre ASC", $conn);
    }
  //print_r($dependencias);
  if ($dependencias["numcampos"]) {
      for ($i = 0; $i < $dependencias["numcampos"]; $i++) {
          $artmp = array();
          $artmp["id"] = $dependencias[$i]["iddependencia"] . "#";
          $array["nombre"] = htmlspecialchars($dependencias[$i]["nombre"]);
          $hijos = busca_filtro_tabla("*", "dependencia D", "D.cod_padre='" . $dependencias[$i]["iddependencia"] . "'", "iddependencia", $conn);
          echo "despues <br>";
          print_r($resultado);
          if ($hijos["numcampos"]) // El hijo tiene mas hijos recursion
            {
              $arhijos = busca_nodos($dependencias[$i]["iddependencia"]);

              $artmp["hijos"] = $arhijos;
            }
          array_push($resultado, $artmp);
          echo "despues <br>";
          print_r($resultado);
        }

      return  $resultado;
    } // fin if numcampos

  return ($resultado);
}



function adicionar_tarea($nombre, $descripcion, $tiempo_respuesta, $idpadre = null, $idcontrol = null, $arentidad = null, $reprograma = null, $tipo_reprograma = null)
{
  global $conn;
  $sql = "INSERT INTO tarea (nombre,descripcion,tiempo_respuesta,reprograma,tipo_reprograma";
  $valores = " VALUES('$nombre','$descripcion',$tiempo_respuesta" . "," . $reprograma . ",'" . $tipo_reprograma . "'";
  if ($idpadre) {
      $sql .= ",idpadre";
      $valores .= ",$idpadre";
    }
  if ($idcontrol) {
      $sql .= ",idcontrol";
      $valores .= ",$idcontrol";
    }
  $sql .= ")";
  $valores .= ")";
  $sql .= $valores;
  //  echo($sql."<br />");die();
  phpmkr_query($sql, $conn);
  $id = phpmkr_insert_id();

  if ($arentidad && $id) {
    $list_entidad = array();
    $list_dep = array();
    $arent = explode(",", $arentidad);
    $res = busca_filtro_tabla("*", "entidad", "nombre='funcionario'", "identidad", $conn);
    $identidadf = $res[0]['identidad'];
    $res = busca_filtro_tabla("*", "entidad", "nombre='dependencia'", "identidad", $conn);
    $identidadd = $res[0]['identidad'];
    foreach ($arent as $entidad) {
      if (!strstr($entidad, '#')) {
        array_push($list_entidad, $entidad);
      } else {
        array_push($list_dep, str_replace("#", "", $entidad));
      }
    }
    for ($i = 0; isset($list_dep[$i]); $i++) {
      $sql = "INSERT INTO entidad_tarea(entidad_identidad,llave_entidad,tarea_idtarea) VALUES('" . $identidadd . "','" . $list_dep[$i] . "'," . $id . ")";

      phpmkr_query($sql, $conn);
    }
    for ($i = 0; isset($list_entidad[$i]); $i++) {

      $sql = "INSERT INTO entidad_tarea(entidad_identidad,llave_entidad,tarea_idtarea) VALUES('" . $identidadf . "','" . $list_entidad[$i] . "'," . $id . ")";

      phpmkr_query($sql, $conn);
    }
  }
  return ($id);
}

function busca_tareas_documento($iddoc)
{
  global $conn;
  $tareas = array();
  $documento = busca_filtro_tabla("", "documento", "iddocumento=" . @$iddoc, "", $conn);
  if ($documento["numcampos"]) {
    $tareas_series = busca_filtro_tabla("", "asignacion", "serie_idserie=" . $documento[0]["serie"], "", $conn);
    if ($tareas_series["numcampos"]) {
      $tareas = extrae_campo($tareas_series, "tarea_idtarea", "U");
    }
  } else alerta("El sistema no ha podido encontrar el documento", 'error', 4000);
  return ($tareas);
}
/*Asigna las tareas a un Documento y define los responsables definidos en la tarea
ademas busca las tareas asignadas a la serie documental de poseer y realiza el proceso
como parametro recibe el id del documento y el listado de  tareas adicionales con el formato array("tarea"=>idtarea,"fecha"=>fecha_inicio_tarea) */

function asignar_tarea_a_documento($iddoc, $ltareas_adicionales = null)
{
  global $conn;

  $totales = array();
  $ltareas = busca_tareas_documento($iddoc); // Anexa las tareas acorde a la serie documental

  $num_tareas = count($ltareas);
  if ($num_tareas) {
    $tareas = busca_filtro_tabla("", "tarea", "idtarea IN(" . implode(",", $ltareas) . ")", "", $conn);
    $ltareas = array();
    for ($i = 0; $i < $tareas["numcampos"]; $i++) {
      array_push($ltareas, array("tarea" => $tareas[$i]["idtarea"], "fecha" => $tareas[$i]["fecha"]));
    }
  } else {
      $ltareas = array();
    }

  /*print_r($ltareas);
echo("-------<br />");
print_r($ltareas_adicionales);*/
  $totales = array_merge((array)$ltareas_adicionales, (array)$ltareas);

  $numero_tareas = count($totales);
  for ($i = 0; $i < $numero_tareas; $i++) {
    $ltareas = $totales[$i]["tarea"];
    $entidades = busca_filtro_tabla("", "entidad_tarea", "tarea_idtarea=" . $totales[$i]["tarea"], "", $conn);
    if ($entidades["numcampos"]) {
      for ($j = 0; $j < $entidades["numcampos"]; $j++) { // Responsables predefinidos de la tarea
        // Asigna la tarea a varios func   
        asignar_tarea($iddoc, false, $totales[$i]["tarea"], $entidades[$j]["llave_entidad"], $entidades[$j]["entidad_identidad"], $totales[$i]["fecha"], null);
      }
    } else { // Asigna el usuario actual como  responsable si no hay nadie asignado
      asignar_tarea($iddoc, false, $totales[$i]["tarea"], usuario_actual("funcionario_codigo"), 1, $totales[$i]["fecha"], null);
    }
  } // Fin for
}

function asignar_tarea($iddocumento = false, $idserie = false, $idtarea = false, $list_entidad = null, $identidad = null, $fecha_inicial = null, $fecha_final = null, $descripcion = "")
{
  global $conn;
  $lasignaciones = array();
  $datos_tarea = busca_filtro_tabla("*", "tarea A", "A.idtarea=" . $idtarea, "", $conn);

  if ($datos_tarea["numcampos"]) {
    $formato = "Y-m-d H:i:s";
    $estado = "PENDIENTE";



    if (!$fecha_inicial)
      $fecha_inicial = date("Y-m-d H:i:s");

    /*************** Cambio Asigna la Fecha Inicial sumando calculando la primera periodicidad para no colocarla inmediata****************/
    //$fecha_inicial=actualiza_fechas_tareas($fecha_inicial,$datos_tarea[0]["reprograma"],$datos_tarea[0]["tipo_reprograma"],0,NULL);

    $ar_fechaini = date_parse($fecha_inicial);
    $anioinicial = $ar_fechaini["year"];
    $mesinicial = $ar_fechaini["month"];
    $diainicial = $ar_fechaini["day"];
    $tiempo_respuesta = $datos_tarea[0]["tiempo_respuesta"]; // En horas

    $id = 0;
    if (!$fecha_final)
      $fecha_final = date($formato, mktime(($ar_fechaini["hour"] + $tiempo_respuesta), $ar_fechaini["minute"], $ar_fechaini["second"], $mesinicial, $diainicial, $anioinicial));

    if (($idserie || $iddocumento) && isset($idtarea) && $idtarea) {
      if ($descripcion == "") {
        $descripcion = "Asignacion Automatica - " . $datos_tarea[0]["nombre"];
      }
      $responsables = responsables_asignacion($idtarea, 1, $list_entidad); // Responsables Funcionarios
      //print_r($responsables);
      for ($i = 0; $i < $responsables["numcampos"]; $i++) {  //array con id's de  Entidades

        if ($iddocumento) {
          /*Valida que el documento exista y que no se tenga una asignacion Menor a la que se esta tratando de asignar*/
          $sql = "INSERT INTO asignacion (documento_iddocumento,tarea_idtarea,fecha_inicial,fecha_final,estado,entidad_identidad,llave_entidad,reprograma,tipo_reprograma,descripcion) VALUES('" . $iddocumento . "','" . $idtarea . "'," . fecha_db_almacenar($fecha_inicial, $formato) . "," . fecha_db_almacenar($fecha_final, $formato) . ",'" . $estado . "','" . $responsables[$i]["entidad"] . "','" . $responsables[$i]["llave"] . "','" . $datos_tarea[0]["reprograma"] . "','" . $datos_tarea[0]["tipo_reprograma"] . "','" . $descripcion . "')";
          phpmkr_query($sql, $conn) or error("No se Pudo Realizar la insercion de la Asignacion ");
          $id = phpmkr_insert_id();
          // echo $sql,$id;
          array_push($lasignaciones, $id);
        } else if ($idserie) {
          $sql = "INSERT INTO asignacion (serie_idserie,tarea_idtarea,fecha_inicial,fecha_final,entidad_identidad,llave_entidad,reprograma,tipo_reprograma,descripcion) VALUES('" . $idserie . "','" . $idtarea . "'," . fecha_db_almacenar($fecha_inicial, $formato) . "," . fecha_db_almacenar($fecha_final, $formato) . ",'" . $estado . "','" . $responsables[$i]["entidad"] . "','" . $responsables[$i]["llave"] . "','" . $responsables[$i]["llave"] . "','" . $datos_tarea[0]["reprograma"] . "','" . $datos_tarea[0]["tipo_reprograma"] . "','" . $descripcion . "')";
          phpmkr_query($sql, $conn) or error("No se Pudo Realizar la insercion de la Asignacion ");
          $id = phpmkr_insert_id();
          array_push($lasignaciones, $id);
        } else {
          $sql = "INSERT INTO asignacion (tarea_idtarea,fecha_inicial,fecha_final,entidad_identidad,llave_entidad,reprograma,tipo_reprograma,descripcion) VALUES('" . $idtarea . "'," . fecha_db_almacenar($fecha_inicial, $formato) . "," . fecha_db_almacenar($fecha_final, $formato) . ",'" . $estado . "','" . $responsables[$i]["entidad"] . "','" . $responsables[$i]["llave"] . "','" . $responsables[$i]["llave"] . "','" . $datos_tarea[0]["reprograma"] . "','" . $datos_tarea[0]["tipo_reprograma"] . "','" . $descripcion . "')";
          phpmkr_query($sql, $conn) or error("No se Pudo Realizar la insercion de la Asignacion ");
          $id = phpmkr_insert_id();
          array_push($lasignaciones, $id);
        }
        $controles = busca_filtro_tabla("", "control_tarea", "tarea_idtarea=" . $idtarea, "", $conn);
        for ($j = 0; $j < $controles["numcampos"] && $id; $j++) {

          $fechaf = actualiza_fechas_tareas($fecha_inicial, 0, $controles[$j]["tipo_periocidad"], $controles[$j]["anticipacion"], $coontroles[$j]["tipo_anticipacion"]);
          $sql = "INSERT INTO control_asignacion(accion,periocidad,tipo_periocidad,asignacion_idasignacion,anticipacion,tipo_anticipacion,fecha_actualizacion) VALUES('" . $controles[$j]["accion"] . "','" . $controles[$j]["periocidad"] . "','" . $controles[$j]["tipo_periocidad"] . "','" . $id . "','" . $controles[$j]["anticipacion"] . "','" . $controles[$j]["tipo_anticipacion"] . "'," . fecha_db_almacenar($fechaf) . ")";
          //  echo $sql; die();
          phpmkr_query($sql, $conn);
        }
      }
    } else {
      alerta("Diligencie correctamente los datos e intente nuevamente", 'error', 4000);
      return false;
    }
  } // Fin if $datos_tarea["num_campos"]
  else {
    alerta("Error la informacion de la tarea no pudo ser obtenida", 'error', 4000);
    return (false);
  }
  return true;
}

function asignar_tarea_manual($iddocumento = false, $idserie = false, $idtarea = false, $list_entidad = null, $identidad = null, $fecha_inicial = null, $fecha_final = null, $reprograma = null, $tipo_reprograma = null, $descripcion = null)
{
  global $conn;
  //print_r($list_entidad);
  $formato = "Y-m-d H:i:s";
  $estado = "PENDIENTE";
  if (!$fecha_inicial)
    $fecha_inicial = date("Y-m-d H:i:s");
  $ar_fechaini = date_parse($fecha_inicial);
  $anioinicial = $ar_fechaini["year"];
  $mesinicial = $ar_fechaini["month"];
  $diainicial = $ar_fechaini["day"];
  $id = 0;
  if (!$fecha_final)
    $fecha_final = date($formato, mktime(($ar_fechaini["hour"]), $ar_fechaini["minute"], $ar_fechaini["second"], $mesinicial, $diainicial, $anioinicial));
  if (($idserie >= 0 || $iddocumento >= 0)) {
    $responsables = responsables_asignacion(0, 1, $list_entidad); // Responsables Funcionarios
    $lasignaciones = array();
    for ($i = 0; $i < $responsables["numcampos"]; $i++) {  //array con id's de  Entidades
      if ($iddocumento || ($iddocumento == 0 && $idserie == 0)) // Si viene el id del coumento o si ambios son cero indica que seran actualizados por que la asignacion es desde un popup de formato
        {
          /*Valida que el documento exista y que no se tenga una asignacion Menor a la que se esta tratando de asignar*/
          $sql = "INSERT INTO asignacion (documento_iddocumento,fecha_inicial,fecha_final,estado,entidad_identidad,llave_entidad,reprograma,tipo_reprograma,descripcion) VALUES('" . $iddocumento . "'," . fecha_db_almacenar($fecha_inicial, $formato) . "," . fecha_db_almacenar($fecha_final, $formato) . ",'" . $estado . "','" . $responsables[$i]["entidad"] . "','" . $responsables[$i]["llave"] . "','" . $reprograma . "','" . $tipo_reprograma . "','" . $descripcion . "')";
          phpmkr_query($sql, $conn) or error("No se Pudo Realizar la insercion de la Asignacion ");
          $id = phpmkr_insert_id();
          array_push($lasignaciones, $id);
        } else if ($idserie) {
        $sql = "INSERT INTO asignacion (serie_idserie,fecha_inicial,fecha_final,entidad_identidad,llave_entidad,reprograma,tipo_reprograma,descripcion) VALUES('" . $idserie . "'," . fecha_db_almacenar($fecha_inicial, $formato) . "," . fecha_db_almacenar($fecha_final, $formato) . ",'" . $estado . "','" . $responsables[$i]["entidad"] . "','" . $responsables[$i]["llave"] . "','" . $responsables[$i]["llave"] . "','" . $reprograma . "','" . $tipo_reprograma . "','" . $descripcion . "')";
        phpmkr_query($sql, $conn) or error("No se Pudo Realizar la insercion de la Asignacion ");
        $id = phpmkr_insert_id();
        array_push($lasignaciones, $id);
      } else {
        $sql = "INSERT INTO asignacion (fecha_inicial,fecha_final,entidad_identidad,llave_entidad,reprograma,tipo_reprograma,descripcion) VALUES(" . fecha_db_almacenar($fecha_inicial, $formato) . "," . fecha_db_almacenar($fecha_final, $formato) . ",'" . $estado . "','" . $responsables[$i]["entidad"] . "','" . $responsables[$i]["llave"] . "','" . $responsables[$i]["llave"] . "','" . $reprograma . "','" . $tipo_reprograma . "','" . $descripcion . "')";
        phpmkr_query($sql, $conn) or error("No se Pudo Realizar la insercion de la Asignacion ");
        $id = phpmkr_insert_id();
        array_push($lasignaciones, $id);
      }
    }
  } else {
    alerta("Diligencie correctamente los datos e intente nuevamente", 'error', 4000);
  }
  return ($lasignaciones);
}

function asignar_tarea_general($iddocumento = false, $idserie = false, $list_entidad = null, $entidad_identidad = null, $fecha_inicial = null, $fecha_final = null)
{
  global $conn;
  $datos = busca_filtro_tabla("", "tarea", "documento_iddocumento=-1", "", $conn);
}

function responsables_asignacion($idtarea, $identidad, $list_entidad)
{
  global $conn;
  $retorno = array();
  if ($identidad && $list_entidad) {
    if (is_array($list_entidad)) {
      for ($i = 0; $i < count($list_entidad); $i++) {
        $retorno[$i]["llave"] = $list_entidad[$i];
        $retorno[$i]["entidad"] = $identidad;
      }
    } else {
      $i = 1;
      $retorno[0]["llave"] = $list_entidad;
      $retorno[0]["entidad"] = $identidad;
    }
    $retorno["numcampos"] = $i;
    //print_r($retorno);die();
    return ($retorno);
  }
  $entidades = busca_filtro_tabla("", "entidad_tarea", "tarea_idtarea=" . $idtarea, "", $conn);
  /////Aqui se deben buscar todas las demas entidad
  for ($j = 0; $j < $entidades["numcampos"]; $i++, $j++) {
    $retorno[$i]["llave"] = $entidades[$j]["llave_entidad"];
    $retorno[$i]["entidad"] = $entidades[$j]["entidad_identidad"];
  }

  $retorno["numcampos"] = $i;
  return ($retorno);
}
/*
 * Revisa asignaciones, cambia el estado de las mismas y siexiste alguna tarea de
 * control para la asignacion genera la nueva asignacion.
 *
*/

function revisar_fechas_tareas()
{
  global $conn;
}

function asignaciones_documento($id_documento = null, $anio = 0, $mes = 0, $dia = 0, $hora = 0, $minuto = 0, $segundo = 0)
{
  global $conn;
  $lista_asignaciones = array();
  $formato = 'Y-m-d H:i:s';
  $fecha_busca = date($formato, mktime($hora, $minuto, $segundo, $mes, $dia, $anio));
  //Busco asignaciones directamente al documento
  $fecha_busca = fecha_db_almacenar($fecha_busca, $formato); // devuelve la fecha el formato adecuado para comparar o almacenar
  $asignaciones = busca_filtro_tabla("idasignacion", "asignacion", "documento_iddocumento=\"$id_documento\" AND fecha_inicial<=\"$fecha_busca\" AND  fecha_final>=\"$fecha_busca\"", "", $conn);

  if ($asignaciones["numcampos"]) //hay asignaciones sobre el documento en la fecha recibida
    {
      for ($i = 0; $i < $asignaciones["numcampos"]; $i++) // Se recorren las asignaciones para el documento
        {
          array_push($lista_asignaciones, $asignaciones[$i]["idasignacion"]);
        }
    } //Fin if asignaciones por documento

  $series_doc = busca_filtro_tabla("documento.serie", "documento", "documento.iddocumento=\"$id_documento\"", "", $conn);
  $id_serie = $series_doc[0]["serie"];
  //Busca asignaciones para la serie a la cual pertenece
  $asignaciones = busca_filtro_tabla("idasignacion", "asignacion", "serie_idserie=\"$id_serie\" AND fecha_inicial<=\"$fecha_busca\" AND  fecha_final>=\"$fecha_busca\"", "", $conn);
  if ($asignaciones["numcampos"]) //hay asignaciones sobre el documento en la fecha recibida
    {
      for ($i = 0; $i < $asignaciones["numcampos"]; $i++) // Se recorren las asignaciones para el documento
        {
          array_push($lista_asignaciones, $asignaciones[$i]["idasignacion"]);
        }
    } //if asignaciones por serie
  // Retrona los identificadores con el listado de asignaciones en la fecha a evaluar
  return $lista_asignaciones;
} // Fin Funcion asignaciones_documento

function buscar_asignacion()
{ }

function elimina_asignacion($idasignacion, $accion = "REPROGRAMA", $justificacion = null)
{
  global $conn;


  if (!$justificacion) // Se debe justificar declarar terminada o eliminar una asignacion 
    return (false);

  if ($accion == "ELIMINA") {
      $resultado = true;
      $asignacion = busca_filtro_tabla("", "asignacion A", "A.idasignacion=" . $idasignacion . " AND estado='PENDIENTE'", "", $conn);


      if ($asignacion["numcampos"] > 0) {
          if ($asignacion[0]["documento_iddocumento"] != -1) // PROTEGE ELIMINAR ASIGNACIONES GENERICAS 
            {

              $fecha_act = fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s");
              $func_codigo = usuario_actual("funcionario_codigo");
              $sql_insert = "INSERT INTO asignacion_terminar (asignacion_idasignacion , justificacion , fecha_terminacion ,funcionario_codigo, tarea_idtarea , fecha_inicial , fecha_final , documento_iddocumento, serie_idserie , estado , entidad_identidad , llave_entidad , reprograma ,  tipo_reprograma, descripcion )";
              $sql_insert .= "VALUES (" . $idasignacion . ",'" . $justificacion . "'," . $fecha_act . ",'" . $func_codigo . "','" . $asignacion[0]["tarea_idtarea"] . "','" . $asignacion[0]["fecha_inicial"] . "','" . $asignacion[0]["fecha_inicial"] . "','" . $asignacion[0]["documento_iddocumento"] . "','" . $asignacion[0]["serie_idserie"] . "','" . $asignacion[0]["estado"] . "','" . $asignacion[0]["entidad_identidad"] . "','" . $asignacion[0]["llave_entidad"] . "','" . $asignacion[0]["reprograma"] . "','" . $asignacion[0]["tipo_reprograma"] . "','" . $asignacion[0]["descripcion"] . "')";
              // Registro de la eliminacion 

              phpmkr_query($sql_insert, $conn);

              $sql = "DELETE FROM control_asignacion WHERE asignacion_idasignacion=" . $idasignacion;
              phpmkr_query($sql, $conn);
              //echo($sql."<br /><br /><br />");
              $sql = "DELETE FROM asignacion WHERE idasignacion=" . $idasignacion;
              phpmkr_query($sql, $conn);
              //echo($sql."<br /><br /><br />");
              alerta("La asignacion se ha Eliminado", 'success', 4000);
            } else {
              $resultado = false;
              alerta(" Esta es una Asignacion especial que involucra alertas automaticas de los formatos de la empresa - no se permite su eliminacion", 'error', 5000);
            }
        } else {
          $resultado = false;
          alerta(" No se encuentran datos de la asignacion", 'error', 4000);
        }
      return ($resultado);
    } elseif ($accion == "REPROGRAMA")    // SE REPROGRAMA LA ASIGNACION
    {
      $resultado = true;

      $asignacion = busca_filtro_tabla("", "asignacion A", "A.idasignacion=" . $idasignacion . " AND estado='PENDIENTE'", "", $conn);

      if (@$asignacion["numcampos"]) {
        if ($asignacion[0]["reprograma"] != 0 && $asignacion[0]["reprograma"] != '' && $asignacion[0]["reprograma"] != null) // VERIFICACION EXTRA
          {

            $fecha_act = fecha_db_almacenar(date("Y-m-d H:i:s"), "Y-m-d H:i:s");
            $func_codigo = usuario_actual("funcionario_codigo");
            $sql_insert = "INSERT INTO asignacion_terminar (asignacion_idasignacion , justificacion , fecha_terminacion ,funcionario_codigo, tarea_idtarea , fecha_inicial , fecha_final , documento_iddocumento, serie_idserie , estado , entidad_identidad , llave_entidad , reprograma ,  tipo_reprograma, descripcion )";
            $sql_insert .= "VALUES (" . $idasignacion . ",'" . $justificacion . "'," . $fecha_act . ",'" . $func_codigo . "','" . $asignacion[0]["tarea_idtarea"] . "','" . $asignacion[0]["fecha_inicial"] . "','" . $asignacion[0]["fecha_inicial"] . "','" . $asignacion[0]["documento_iddocumento"] . "','" . $asignacion[0]["serie_idserie"] . "','" . $asignacion[0]["estado"] . "','" . $asignacion[0]["entidad_identidad"] . "','" . $asignacion[0]["llave_entidad"] . "','" . $asignacion[0]["reprograma"] . "','" . $asignacion[0]["tipo_reprograma"] . "','" . $asignacion[0]["descripcion"] . "')";
            //echo $sql_insert;
            // print_r($asignacion);die();

            // Registra la justificacion y datos generales de la reprograamcion 
            phpmkr_query($sql_insert, $conn);

            $fecha_actualizacion = actualiza_fechas_tareas($asignacion[0]["fecha_inicial"], $asignacion[0]["reprograma"], $asignacion[0]["tipo_reprograma"]);
            $fecha_vencimiento = actualiza_fechas_tareas($asignacion[0]["fecha_final"], $asignacion[0]["reprograma"], $asignacion[0]["tipo_reprograma"]);
            $sql = "UPDATE asignacion SET fecha_inicial=" . fecha_db_almacenar($fecha_actualizacion, "Y-m-d H:i:s") . ",fecha_final=" . fecha_db_almacenar($fecha_vencimiento, "Y-m-d H:i:s") . " WHERE idasignacion=" . $idasignacion;
            phpmkr_query($sql, $conn);
            //echo($sql."<br /><br />");
            //  $controles=busca_filtro_tabla("","control_asignacion","asignacion_idasignacion=".$idasignacion." AND ejecutar_hasta > ".fecha_actual(),"",$conn);
            // LE RETIRE LO DE EJECUTAR HASTA PARA QUE PUEDA REPROGRAMAR EL CONTROL

            $controles = busca_filtro_tabla("", "control_asignacion", "asignacion_idasignacion=" . $idasignacion, "", $conn);
            for ($j = 0; $j < $controles["numcampos"]; $j++) {
                $fecha_actualizacion = actualiza_fechas_tareas($asignacion[0]["fecha_inicial"], $asignacion[0]["reprograma"], $asignacion[0]["tipo_reprograma"], $controles[$j]["anticipacion"], $controles[$j]["tipo_anticipacion"]);
                $sql = "UPDATE control_asignacion SET fecha_actualizacion=" . fecha_db_almacenar($fecha_actualizacion, "Y-m-d H:i:s") . " WHERE idcontrol_asignacion=" . $controles[$j]["idcontrol_asignacion"];
                phpmkr_query($sql, $conn);
                //echo($sql."<br /><br />");
              }
            alerta("La asignacion se ha reprogramado", 'success', 4000);
          } else {
          $resultado = false;
          alerta("La asignacion no posee informacion para la reprogramacion", 'error', 4000);
        }
      } else {
          $resultado = false;
          alerta(" No se encuentran datos de la asignacion", 'error', 4000);
        }
      return ($resultado);
    } // Fin ELSEIF REPROGRAMA
  return (false);
}

/*
 * Verifica que una entidad no tenga una tarea Restrictiva pendiente
 * al momento verifica unicamente funcionarios o dep	endencias
*/
function verificar_restriccion($id_documento, $id_entidad, $llave_entidad)
{
  global $conn;
  $lista_asignaciones = array(); // retrona array vacio para los demas casos

  switch ($id_entidad) {
    case 1: // funcionarios  busca tareas RESTRICTIVAS SOBRE EL DOCUMENTO para un funcionario y  depen. a las que pertenece
      $datosfun = busca_datos_administrativos_funcionario($llave_entidad);
      $dependencias = $datosfun["dependencias"];
      // Verifico restricciones sobre dependencias a las cuales pertenece el funcionario
      foreach ($dependencias as $id_dependencia) {
          $restric_depend = $asignaciones = busca_filtro_tabla("A.idasignacion", "asignacion A, asignacion_entidad B, tarea C,dependencia D", "A.documento_iddocumento=\"$id_documento\" AND A.idasignacion=B.asignacion_idasignacion AND B.entidad_identidad =\"2\" AND B.llave_entidad=$id_dependencia AND B.entidad_identidad=D.iddependencia AND A.tarea_idtarea=C.idtarea AND C.accion=\"RESTRICTIVA\"", "", $conn);

          if ($restric_depend["numcampos"]) {
              for ($i = 0; $i < $restric_depend["numcampos"]; $i++) {
                  array_push($lista_asignaciones, $restric_depend[$i]["idasignacion"]); // adiciona al listado de tareas restrictivas sobre el documento
                }
            }
        }
      // Verifico restricciones sobre el funcionario directamente
      $restric_funcionario = busca_filtro_tabla("A.idasignacion", "asignacion A, asignacion_entidad B, tarea C", "A.documento_iddocumento=\"$id_documento\" AND A.idasignacion=B.asignacion_idasignacion AND B.entidad_identidad =$id_entidad AND B.llave_entidad=$llave_entidad AND A.tarea_idtarea=C.idtarea AND C.accion=\"RESTRICTIVA\"", "", $conn);
      if ($restric_funcionario["numcampos"]) {
          for ($i = 0; $i < $restric_funcionario["numcampos"]; $i++) {
              array_push($lista_asignaciones, $restric_funcionario[$i]["idasignacion"]); // adiciona al listado de tareas restrictivas sobre el documento
            }
        }
      return $lista_asignaciones;
      break;

    case 2:
      $restric_depend = $asignaciones = busca_filtro_tabla("A.idasignacion", "asignacion A, asignacion_entidad B, tarea C,dependencia D", "A.documento_iddocumento=\"$id_documento\" AND A.idasignacion=B.asignacion_idasignacion AND B.entidad_identidad =\"2\" AND B.llave_entidad=$llave_entidad AND B.entidad_identidad=D.iddependencia AND A.tarea_idtarea=C.idtarea AND C.accion=\"RESTRICTIVA\"", "", $conn);
      if ($restric_depend["numcampos"]) {
          for ($i = 0; $i < $restric_depend["numcampos"]; $i++) {
              array_push($lista_asignaciones, $restric_depend[$i]["idasignacion"]); // adiciona al listado de tareas restrictivas sobre el documento
            }
        }
      return $lista_asignaciones;
      break;
  }
}
function actualiza_fechas_tareas($fecha, $periocidad = 0, $tipo_periocidad = "day", $anticipacion = 0, $tipo_anticipacion = "")
{
  $fecha_actualizada = $fecha;
  $fecha_actualizacion = date_parse($fecha);
  $actualiza = 0;
  if ($tipo_periocidad != "" && $periocidad) {
    $fecha_actualizacion[$tipo_periocidad] += $periocidad;
    $actualiza = 1;
  }
  if ($tipo_anticipacion != "" && $anticipacion) {
    $fecha_actualizacion[$tipo_anticipacion] -= $anticipacion;
    $actualiza = 1;
  }
  if ($actualiza) {
    $fecha_actualizada = date("Y-m-d H:i:s", mktime($fecha_actualizacion["hour"], $fecha_actualizacion["minute"], $fecha_actualizacion["second"], $fecha_actualizacion["month"], $fecha_actualizacion["day"], $fecha_actualizacion["year"]));
  }
  return ($fecha_actualizada);
}
 