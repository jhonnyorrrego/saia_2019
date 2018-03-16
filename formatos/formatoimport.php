<?php
include_once("../db.php");
if(@$_REQUEST["nombre"]){
  $nombre=$_REQUEST["nombre"];
  $ruta="importar/".$nombre."_datos_exportar.sql";
  if(is_file($ruta)){
    if ($secuencia = fopen($ruta, 'r')) {      
      $cadena=stream_get_contents($secuencia);    
      fclose($secuencia);
      if($cadena!=""){
        $sentencias=explode("||",$cadena);               
        $formato=busca_filtro_tabla("","formato","nombre LIKE '".$nombre."'","",$conn);
        $cant_sentencias=count($sentencias);    
        for($i=0;$i<$cant_sentencias && !$formato["numcampos"];$i++){
          if($sentencias[$i]!=''){            
            phpmkr_query($sentencias[$i],$conn);
          }
        }
        $formato=busca_filtro_tabla("","formato","nombre LIKE '".$nombre."'","",$conn);
        if($formato["numcampos"]){
          $campos=busca_filtro_tabla("","campos_formato","formato_idformato=".$formato[0]["idformato"],"",$conn);
          $funciones=busca_filtro_tabla("","funciones_formato","formato LIKE '".$formato[0]["idformato"]."' OR formato LIKE '%,".$formato[0]["idformato"].",%' OR formato LIKE '%,".$formato[0]["idformato"]."' OR formato LIKE '".$formato[0]["idformato"].",%'","",$conn);
          if(!$campos["numcampos"] && !$funciones["numcampos"]){
            importar_campos("|-formato_idformato-|",$formato[0]["idformato"],"importar/".$nombre."_campos_formato.sql");
            importar_funciones("|-formato-|",$formato[0]["idformato"],"importar/".$nombre."_funciones_formato.sql");
            alerta("Por favor recuerde Generar su formato y la tabla correspondiente, los datos solo se han cargado y estan listos para ser ejecutados");
            redirecciona("funciones_formatolist.php?idformato=".$formato[0]["idformato"]);
          }
          else{
            if($funciones["numcampos"]){
              alerta(".:Existen funciones para el formato:.");
            }
            if($campos["numcampos"])
              alerta(".:Existe campos para el formato:."); 
          }  
        }
        else alerta("Formato no Insertado o no encontrado");
      }
    }
    else alerta("Problema al abrir el archivo");
  }
  else {
    alerta("El formato que desea importar no se ha encontrado en la carpeta de importar");
  }
}
else alerta("debe seleccionar el nombre de un formato para importar");

function importar_campos($nombre_llave,$llave,$ruta){
global $conn;
  if(is_file($ruta) ){
    if ($secuencia = fopen($ruta, 'r')) {
      $cadena=stream_get_contents($secuencia);
      fclose($secuencia);
      if($cadena!=""){
        $cadena=str_replace($nombre_llave,$llave,$cadena);
        $sentencias=explode("||",$cadena);
        for($i=0;$i<count($sentencias);$i++)
          phpmkr_query($sentencias[$i],$conn);
      }
    }
    else alerta("Problema al abrir el archivo");
  }
  else
    alerta("Los campos que desea importar no se ha encontrado en la carpeta de importar");
}
function importar_funciones($nombre_llave,$llave,$ruta){
global $conn;
  if(is_file($ruta)){
    if ($secuencia = fopen($ruta, 'r')) {
      $cadena=stream_get_contents($secuencia);
      fclose($secuencia);
      if($cadena!=""){
        $posinicio=strpos($cadena,"/*inicio_datos--");
        $posfinal=strpos($cadena,"--fin_datos*/");
        $nombres=substr($cadena,$posinicio,($posfinal-$posinicio));
        $nombres=str_replace("/*inicio_datos--","",$nombres);
        $lnombres=explode(",",$nombres);
        $funciones=busca_filtro_tabla("","funciones_formato","nombre LIKE '".implode("' OR nombre LIKE '",$lnombres)."'","",$conn);
        $sentencias=explode("||",$cadena);
        array_pop($sentencias);
        $actualizar=array();
        $insertar=array();
        for($i=0;$i<$funciones["numcampos"];$i++){
          if(in_array($funciones[$i]["nombre"],$lnombres)){
            array_push($actualizar,$funciones[$i]["idfunciones_formato"]);
            $id=array_search($funciones[$i]["nombre"],$lnombres);
            unset($lnombres[$id]);
          }
        }
        for($i=0;$i<count($actualizar);$i++){
          $sql="UPDATE funciones_formato SET formato= ".concatenar_cadena_sql(array("formato","','",$llave))." WHERE idfunciones_formato=".$actualizar[$i];
          phpmkr_query($sql,$conn);
        }
        sort($lnombres);
        for($j=0;$j<count($sentencias);$j++){
          for($i=0;$i<count($lnombres);$i++){
            $pos=strpos($sentencias[$j],trim($lnombres[$i]));
            if($pos!==false){
              $sql=str_replace($nombre_llave,$llave,$sentencias[$j]);
              phpmkr_query($sql,$conn);
              unset($lnombres[$i]);
            }
          }
        }
      }
    }
    else alerta("Problema al abrir el archivo");
  }
  else
    alerta("El formato que desea importar no se ha encontrado en la carpeta de importar formatos");
}
?>