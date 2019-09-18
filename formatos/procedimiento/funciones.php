<?php
include_once("../../db.php");
include_once("../librerias/funciones_generales.php");
/*
function listado_pasos_procedimiento($idformato,$iddoc){

$texto="No existen Pasos Para este Procedimiento";
$formato=busca_filtro_tabla("","formato B","B.idformato=".$idformato,"");
print_r($formato);
if($formato["numcampos"]){
  $procedimiento=busca_filtro_tabla("",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"");
  print_r($procedimiento);
 if($procedimiento["numcampos"]){
    $actividades=busca_filtro_tabla("","ft_actividades_procedimiento","ft_procedimiento=".$procedimiento[0]["id".$formato[0]["nombre_tabla"]],"orden");
    if($actividades["numcampos"]){
      $texto.='<td class="encabezado_list" ></td>';
      $texto.="</tr>";
      for($i=0;$i<$actividades["numcampos"];$i++){
        $texto='<table class="tabla_borde" border="1" ><tr class="encabezado_list">';
      for($i=0;$i<$hijo["numcampos"];$i++){
        $texto.='<tr class="celda_transparente">';
        for($j=0;$j<$lcampos["numcampos"];$j++){
          $texto.='<td align="center">'.mostrar_valor_campo($lcampos[$j]["nombre"],$lcampos[$j]["formato_idformato"],$hijo[$i]["id".$tabla],1)."</td>";
        }
        $texto.='</tr>';
      }
      $texto.='</table>';
      }
    }
  }
}
echo($texto);
}
function control_procedimiento($idformato,$iddoc){


$texto="No existen Pasos Para este Procedimiento";
$formato=busca_filtro_tabla("","formato B","B.idformato=".$idformato,"");
if($formato["numcampos"]){
  $procedimiento=busca_filtro_tabla("",$formato[0]["nombre_tabla"],"idft_procedimiento=".$iddoc,"");
  //print_r($procedimiento);
  if($procedimiento["numcampos"]){
    $campos=array("nombre","responsable");
    $texto=listar_formato_hijo($campos,"ft_control_procedimiento","ft_procedimiento",$procedimiento[0]["id".$formato[0]["nombre_tabla"]],"");
  }
//$control=busca_filtro_tabla("","ft_control_procedimiento","ft_procedimiento=".$iddoc,"");

}
echo($texto);
}
function riesgo_procedimientos($idformato,$iddoc){

$proceso=busca_filtro_tabla("ft_proceso","ft_procedimiento","idft_procedimiento=".$iddoc,"");
if($proceso["numcampos"]){
  include_once("../proceso/funciones.php");
  enlace_riesgos(1,$proceso[0]["ft_proceso"]);
}
}
*/
function listar_pasos_procedimiento($idformato,$iddoc){
  
  $texto="No existen Pasos Para este Procedimiento";
  $formato=busca_filtro_tabla("","formato B","B.idformato=".$idformato,"");
  if($formato["numcampos"]){
    $procedimiento=busca_filtro_tabla("",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"");
  
    if($procedimiento["numcampos"]){
      $formato_actividades=busca_filtro_tabla("","formato A","nombre LIKE 'actividades_procedimiento'","");
      if(!$formato_actividades["numcampos"]){
        $formato_actividades[0]["idformato"]=4;
      }
      $actividades=busca_filtro_tabla("","ft_actividades_procedimiento,documento","documento_iddocumento=iddocumento and documento.estado<>'ELIMINADO' and ft_actividades_procedimiento.estado<>'INACTIVO' and ft_procedimiento=".$procedimiento[0]["id".$formato[0]["nombre_tabla"]],"orden");
      if($actividades["numcampos"]){
        $texto='<table class="tabla_borde" border="1" style="border-collapse:collapse" bordercolor="gray">
                  <tr class="encabezado_list">
                    <td rowspan="2">Orden</td><td rowspan="2">PASOS</td><td colspan="2">Responsable</td><td rowspan="2">Documento o Registro</td><td rowspan="2">Punto de Control</td>
                  </tr>
                  <tr><td class="encabezado_list">Area</td><td class="encabezado_list">Cargo</td></tr>
                  ';
        for($i=0;$i<$actividades["numcampos"];$i++){
          $texto.='<tr><td>'.($i+1).'</td><td>'.mostrar_valor_campo("definicion",$formato_actividades[0]["idformato"],$actividades[$i]["documento_iddocumento"],1).'</td><td>'.mostrar_valor_campo("areas",$formato_actividades[0]["idformato"],$actividades[$i]["documento_iddocumento"],1).'</td><td>'.$actividades[$i]["cargos"].'</td><td>'.mostrar_valor_campo("anexos",$formato_actividades[0]["idformato"],$actividades[$i]["documento_iddocumento"],1).'</td><td>'.mostrar_valor_campo("control",$formato_actividades[0]["idformato"],$actividades[$i]["documento_iddocumento"],1).'</td></tr>';
        }
        $texto.="</table>";
      }
      else $texto="No se han Encontrado Pasos Para Mostrar";
    }
  }
  echo($texto);
}
function vigencia_procedimiento($idformato,$iddoc){
  
  $formato=busca_filtro_tabla("","formato","idformato=".$idformato,"");
  $fecha = busca_filtro_tabla("",$formato[0]["nombre_tabla"],"documento_iddocumento=".$iddoc,"");
  //$fecha_vigencia = explode("-",$fecha[0]["fecha_nomina"]);
  
  return($fecha[0]["vigencia"]);
}
?>