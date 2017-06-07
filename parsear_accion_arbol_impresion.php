<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header("Cache-Control: no-store, no-cache, must-revalidate"); // HTTP/1.1
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
include("db.php");
include("class_transferencia.php");
//print_r($_REQUEST);
//echo("<br /><br />");
$formato["numcampos"]=0;
if(@$_REQUEST["id"]){
  $datos=parsea_idformato($_REQUEST["id"]);
  //print_r($datos);
  $formato["numcampos"]=0;
  if($datos[0]=="p"){
    if(intval($datos[1])){
      $datos_pagina=busca_filtro_tabla("","pagina","consecutivo=".$datos[1],"",$conn);
      if($datos_pagina["numcampos"]){
        echo('<img src="'.$datos_pagina[0]["ruta"].'">');
      }
      else
        alerta("Pagina no encontrada");
    }
    else {
      $datos_pagina=busca_filtro_tabla("","pagina","id_documento=".$datos[2],"pagina",$conn);
      if($datos_pagina["numcampos"]){
        echo('<table border="1" height="100%" width="100%" style="border-collapse:collapse;" valign="top" >');
        for($i=0,$j=0;$i<$datos_pagina["numcampos"];$i++,$j++){
          if($i%4==0 ){
            echo('<tr>');
          }
          echo('<td valign="top" width="25%" align="center" ><span class="phpmaker">Pagina '.($i+1).'</span><br /><img src="'.$datos_pagina[$i]["imagen"].'"></td>');
          if($i%4==0 && $i!=$j){
            echo('</tr>');
          }
        }
        for($i;$i%4!=0;$i++){
          echo('<td valign="top" width="25%" align="center">&nbsp;</td>');
        }
        echo('</table>');
      }
    }
  }
  else
    $formato=busca_filtro_tabla("","formato","idformato=".$datos[0],"",$conn);
  if($formato["numcampos"]){
    $ruta="";
    $alerta="existe problema para redireccionar";
    if($datos[1]&&$datos[2]){
      $datos_formato=busca_filtro_tabla("",$formato[0]["nombre_tabla"],"id".$formato[0]["nombre_tabla"]."=".$datos[2],"",$conn);
    }
    switch($datos[3]){
      case "mostrar":
        if($datos[2]){
          $ruta=FORMATOS_CLIENTE.$formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"]."?iddoc=".$datos_formato[0]["documento_iddocumento"]."&idformato=".$formato[0]["idformato"];
          if(is_file(FORMATOS_CLIENTE.$formato[0]["nombre"]."/".$formato[0]["ruta_mostrar"]))
            redirecciona($ruta);
          else if(is_file(FORMATOS_CLIENTE.$formato[0]["nombre"]."/previo_".$formato[0]["ruta_mostrar"]))
            redirecciona(FORMATOS_CLIENTE.$formato[0]["nombre"]."/previo_".$formato[0]["ruta_mostrar"]);
        }
        //die($ruta);
      break;
    }
    if($ruta!="")
      redirecciona($ruta);
    else{
      alerta($alerta);
/*      print_r($datos);
      alerta($ruta);*/
      redirecciona("vacio.php");
      //volver(1);
    }
  }
}
else alerta("El formato No se ha podido capturar");
/*debe retornar un arreglo con el siguiente orden:
[0]=>idtabla,[1]=>nombre_tabla,[2]=>campo_descripcion,[3]=>idformato,[4]=>accion,[5]=>llave
*/
function parsea_idformato($id=0){
$arreglo=array();
if($id){
  $arreglo=explode("-",$id);
}
else if($_REQUEST["id"]){
  $arreglo=explode("-",$_REQUEST["id"]);
}
else return($arreglo);
if($arreglo[2][0]=="r"){
  $arreglo[2]=0;
}
if($_REQUEST["accion"]){
  $arreglo[3]=$_REQUEST["accion"];
}
else
  $arreglo[3]="mostrar";

/*if(@$_REQUEST["llave"]){
  array_push($arreglo,$_REQUEST["llave"]);
}
else
  array_push($arreglo,0);*/
return($arreglo);
}
?>