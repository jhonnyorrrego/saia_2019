<?php
include_once("funciones.php");
include_once("../librerias/funciones_generales.php");
include_once("../librerias/estilo_formulario.php");

switch($_REQUEST["tipo"]){
  case "2":
    if($_REQUEST["proceso"]){
      $dato=$_REQUEST["proceso"];
      $condicion="(A.procesos_vinculados LIKE '".$dato.",%' OR A.procesos_vinculados LIKE '%,".$dato.",%' OR A.procesos_vinculados LIKE '%,".$dato."' OR A.procesos_vinculados LIKE '".$dato."') AND (B.tipo_plan LIKE '%2%' OR B.tipo_plan LIKE'%3%')";
      listar_hallazgo_plan_mejoramiento(379,"",$condicion);
    }
  break;
  case "3":
    if($_REQUEST["usuario"]){
      $dato=$_REQUEST["usuario"];
      $condicion="(A.responsables LIKE '".$dato.",%' OR A.responsables LIKE '%,".$dato.",%' OR A.responsables LIKE '%,".$dato."' OR A.responsables LIKE '".$dato."') ";
      listar_hallazgo_plan_mejoramiento(379,"",$condicion);
    }
    case "4":
      if($_REQUEST["proceso"]){
        $dato=$_REQUEST["proceso"];
        $condicion="(A.procesos_vinculados LIKE '".$dato.",%' OR A.procesos_vinculados LIKE '%,".$dato.",%' OR A.procesos_vinculados LIKE '%,".$dato."' OR A.procesos_vinculados LIKE '".$dato."') AND (B.tipo_plan LIKE '%2%')";
        $planes=busca_filtro_tabla("","ft_hallazgo A, ft_plan_mejoramiento B",$condicion,"GROUP BY idft_plan_mejoramiento",$conn);
        //print_r($planes);
        echo("<br />");
        //$ch = curl_init();
        //curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        for($h=0;$h<$planes["numcampos"];$h++){
          $url="formatos/plan_mejoramiento/mostrar_plan_mejoramiento.php?iddoc=".$planes[$h]["idft_plan_mejoramiento"]."&idformato=1";
          echo($url."<br />");
          //curl_setopt($ch, CURLOPT_URL,"http://".RUTA_PDF."/".$url);
          //$texto.=curl_exec ($ch);  
        }
        //curl_close ($ch);
      }
    break;
  break;
}

?>
