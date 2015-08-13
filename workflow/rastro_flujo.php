<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")) {
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
$instancia=busca_filtro_tabla("","diagram_instance A","iddiagram_instance=".$_REQUEST["idflujo_instancia"],"",$conn);
$pasos_flujo=busca_filtro_tabla("","paso A,paso_enlace B","A.idpaso=B.origen AND A.diagram_iddiagram=".$instancia[0]["diagram_iddiagram"],"A.idfigura",$conn);
?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/estilo_flujos.css"/>
<style >
  td{
    border:1px solid;
  }
</style>
<table width="98%" style="border-collapse: collapse; border: 1px solid;">
  <tr class="encabezado_list"><td>Inicio</td><td>Fin</td><td>Actividades y Responsable</td><td>Estado</td><td>Documentos Asociados</td><td>Observaciones</td></tr>
<?php
for($i=0;$i<$pasos_flujo["numcampos"];$i++){
  $actividades=array();
  $texto2="";
  $terminada=0;
  $estado='';
  $color='4';
  $documento="&nbsp;";
  if($i==0){
    $inicio='Inicio';
  }  
  else{
    $inicio=$final;    
  }
  $observaciones_terminacion='&nbsp;';
  $final=$pasos_flujo[$i]["nombre_paso"];
  $paso_documento=busca_filtro_tabla("","paso_documento A,documento B","A.documento_iddocumento=B.iddocumento AND paso_idpaso=".$pasos_flujo[$i]["idpaso"]." AND diagram_iddiagram_instance=".$_REQUEST["idflujo_instancia"],"",$conn);
  if($paso_documento["numcampos"]){
    $documento=$paso_documento[0]["descripcion"]."(".$paso_documento[0]["numero"].")<br ><a href='".$ruta_db_superior."ordenar.php?mostrar_formato=1&accion=mostrar&key=".$paso_documento[0]["iddocumento"]."' target='centro'>Detalles</a>";
    //$estado=estado_paso_documento($paso_documento[0]["idpaso_documento"]);
  }
  $actividades_paso=busca_filtro_tabla("","paso_actividad","paso_idpaso=".$pasos_flujo[$i]["idpaso"],"",$conn);
  $texto2='';
  for($j=0;$j<$actividades_paso["numcampos"];$j++){
    $chulo="";
    
    $terminadas=busca_filtro_tabla("","paso_instancia_terminada","actividad_idpaso_actividad=".$actividades_paso[$j]["idpaso_actividad"]." AND documento_iddocumento=".$paso_documento[0]["documento_iddocumento"],"",$conn);
    //print_r($terminadas);
    if($terminadas["numcampos"]){
      //print_r($terminadas);
    for($h=0;$h<$terminadas["numcampos"];$h++){
      $notas_terminacion=busca_filtro_tabla("nombres,apellidos,observaciones","paso_inst_terminacion A, funcionario B","A.funcionario_codigo=B.funcionario_codigo AND A.paso_instancia_idpaso_instancia=".$terminadas[$h]["idpaso_instancia"],"",$conn);
      //print_r($notas_terminacion);
      if($notas_terminacion["numcampos"]){
        $observaciones_terminacion.="<b>".$notas_terminacion[0]["nombres"]." ".$notas_terminacion[0]["apellidos"]."</b>: ".$notas_terminacion[0]["observaciones"]."<br />";
      } 
      $notas_devolucion=busca_filtro_tabla("","paso_instancia_rastro","paso_instancia_idpaso_instancia=".$terminadas[$h]["idpaso_instancia"],"",$conn);
      //print_r($notas_devolucion); 
      $responsable=busca_filtro_tabla("nombres, apellidos","funcionario","funcionario_codigo=".$terminadas[$h]["responsable"],"",$conn);
      if(in_array($terminadas[$h]["estado_actividad"],array(1,2))){
        $terminada++;
        $chulo='<img src="'.$ruta_db_superior.'images/check.jpg" border="0px" width="10px">';
      }
      else{
        $devuelta++;
      }
    }
    if($actividades_paso[$j]["restrictivo"]){
      $restrictivo="Obligatorio";
    }
    else{
      $restrictivo="";
    }
    $texto2.="<li>".$actividades_paso[$j]["descripcion"]."(".$restrictivo.")".$chulo."<br /><b>Responsable:</b>".$responsable[0]["nombres"]." ".$responsable[0]["apellidos"]."</li>";
    //print_r($paso_documento);
    //array_push($actividades,."@".$actividades_paso[$j]["idpaso_actividad"]."@".);
    }
    else{
      $texto2.="<li>".$actividades_paso[$j]["descripcion"]."(".$restrictivo.")".$chulo."</li>";  
    }
    if($paso_documento[0]["estado_paso_documento"]){
      $color=$paso_documento[0]["estado_paso_documento"];
    }
  }
  if($actividades_paso["numcampos"]){
    $porcentaje=($terminada*100)/$actividades_paso["numcampos"];
  }  
  else 
    $porcentaje=0;
  $estado.="<b>Terminadas:</b><br />(".$terminada."/".$actividades_paso["numcampos"].")".$porcentaje."%";
  //print_r($paso_documento);
  if($observaciones_terminacion!='&nbsp;'){
    $observaciones_terminacion2.="<b>Notas Terminaci&oacute;n :</b><br />".$observaciones_terminacion;
  }
  $texto='<tr><td>'.$inicio.'</td><td>'.$final.'</td><td><ul>'.$texto2.'</ul></td><td class="paso'.$color.'">'.$estado.'</td><td>'.$documento.'</td><td>'.$observaciones_terminacion2.'</td></tr>';
  echo($texto);
}
$texto='<tr><td>'.$final.'</td><td>Fin</td><td>---</td><td>---</td><td>---</td><td>---</td></tr>';
echo($texto);
//$pasos_documento=busca_filtro_tabla("","paso_documento");
//print_r($instancia);
?>
</table>