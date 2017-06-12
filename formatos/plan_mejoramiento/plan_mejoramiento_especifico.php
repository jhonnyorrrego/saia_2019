<?php
include_once("funciones.php");
include_once("../librerias/funciones_generales.php");
include_once("../librerias/estilo_formulario.php");
$idformato_plan_mejoramiento=busca_filtro_tabla("idformato","formato","nombre='plan_mejoramiento'","",$conn);
switch($_REQUEST["tipo"]){
  case "2":
    if($_REQUEST["proceso"]){
      $dato=$_REQUEST["proceso"];
      $condicion="(A.procesos_vinculados LIKE '".$dato.",%' OR A.procesos_vinculados LIKE '%,".$dato.",%' OR A.procesos_vinculados LIKE '%,".$dato."' OR A.procesos_vinculados LIKE '".$dato."') AND (B.tipo_plan LIKE '%2%' OR B.tipo_plan LIKE'%3%')";
      listar_hallazgo_plan_mejoramiento($idformato_plan_mejoramiento[0]['idformato'],"",$condicion);
    }
  break;
  case "3":
    if($_REQUEST["usuario"]){
      $dato=$_REQUEST["usuario"];
      $condicion="(A.responsables LIKE '".$dato.",%' OR A.responsables LIKE '%,".$dato.",%' OR A.responsables LIKE '%,".$dato."' OR A.responsables LIKE '".$dato."') ";
      listar_hallazgo_plan_mejoramiento($idformato_plan_mejoramiento[0]['idformato'],"",$condicion);
    }
    case "4":
      if($_REQUEST["proceso"]){
        $dato=$_REQUEST["proceso"];
        $condicion="(A.procesos_vinculados LIKE '".$dato.",%' OR A.procesos_vinculados LIKE '%,".$dato.",%' OR A.procesos_vinculados LIKE '%,".$dato."' OR A.procesos_vinculados LIKE '".$dato."') AND (B.tipo_plan LIKE '%2%')";
        $planes=busca_filtro_tabla("","ft_hallazgo A, ft_plan_mejoramiento B",$condicion,"GROUP BY idft_plan_mejoramiento",$conn);
        echo("<br />");
        for($h=0;$h<$planes["numcampos"];$h++){
          $url="formatos/plan_mejoramiento/mostrar_plan_mejoramiento.php?iddoc=".$planes[$h]["idft_plan_mejoramiento"]."&idformato=".$idformato_plan_mejoramiento[0]['idformato'];
          echo($url."<br />");
        }
      }
    break;
  break;
}

?>
