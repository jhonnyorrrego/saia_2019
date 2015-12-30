<?php
$max_salida=6; $ruta_db_superior=$ruta=""; while($max_salida>0){ if(is_file($ruta."db.php")){ $ruta_db_superior=$ruta;} $ruta.="../"; $max_salida--; } 
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/lib/librerias_fechas.php");
//ini_set("display_errors",true);
echo(estilo_bootstrap());
$condicional=busca_filtro_tabla("","paso_condicional A, paso_condicional_admin B","A.idpaso_condicional=B.fk_paso_condicional AND A.idpaso_condicional=".$_REQUEST["idpaso_condicional"],"B.orden ASC",$conn);
if($condicional["numcampos"]){
  $nombre_condicional=$condicional[0]["etiqueta"];
}
else{
  $condicional2=busca_filtro_tabla("","paso_condicional","idpaso_condicional=".$_REQUEST["idpaso_condicional"],"",$conn);
  $nombre_condicional=@$condicional2[0]["etiqueta"];
}
?>
Condicionales: <b> <?php echo($nombre_condicional);?></b><br>
<?php 
$texto='';
if($condicional["numcampos"]){
  $texto.='<table class="table">';
  $texto_formato='';
  //TODO: Se debe evaluar si se implementa que no pueda poner varias condiciones direccionadas al mismo paso por problemas de posible entrelazado a posos diferentes en codiciones diferentes, simpre debe direccionar a un paso siguiente o no ????? 
  $texto.='<thead><tr><th>Formato</th><th>campo</th><th>Valor registro</th><th>Comparaci&oacute;n</th><th>Valor</th><th>Pasos si cumple</th><th>Pasos no cumple</th></tr></thead>';
  for($i=0;$i<$condicional["numcampos"];$i++){
    $texto_pasos_no='';
    $texto_pasos_si='';
    $tareas=busca_filtro_tabla("A.*,B.*,C.*,D.nombre_tabla, D.etiqueta AS formato, C.etiqueta AS campo","paso_documento A, paso_actividad B, campos_formato C, formato D","C.formato_idformato=D.idformato AND A.paso_idpaso=B.paso_idpaso AND A.diagram_iddiagram_instance=".$_REQUEST["bpmni"]." AND A.estado_paso_documento NOT IN(3,7) AND B.formato_idformato=C.formato_idformato AND C.idcampos_formato=".$condicional[$i]["fk_campos_formato"],"",$conn);
    if($tareas["numcampos"]){
      $tabla=busca_filtro_tabla($tareas[0]["nombre"],$tareas[0]["nombre_tabla"],"documento_iddocumento=".$tareas[0]["documento_iddocumento"],"",$conn);
      if($tabla["numcampos"]){
        $evaluacion=eval("return(".$tabla[0][$tareas[0]["nombre"]].$condicional[$i]["comparacion"].$condicional[$i]["valor"].");");
        if($evaluacion){
          $texto_pasos_si=texto_pasos($condicional[$i]["habilitar_pasos_si"]);
        }
        else{
          $texto_pasos_no=texto_pasos($condicional[$i]["habilitar_pasos_no"]);          
        }
      }
    }
    $texto.='<tr><td>'.@$tareas[0]["formato"].'&nbsp;</td><td>'.$tareas[0]["campo"].'&nbsp;</td><td>'.$tabla[0][$tareas[0]["nombre"]].'</td><td align="center">'.$condicional[$i]["comparacion"].'</td><td>'.$condicional[$i]["valor"].'</td><td>'.$texto_pasos_si.'</td><td>'.$texto_pasos_no.'</td></tr>';
  }
  $texto.='</table>';
  $texto.='<div id="detalles_actividad"></div>';
}
echo($texto);
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());
echo(librerias_datepicker_bootstrap());
echo(librerias_notificaciones());
function texto_pasos($dato_paso){
$texto='';
if($dato_paso){
  $pasos=busca_filtro_tabla("","paso","idpaso IN(".$dato_paso.")","",$conn);
  if($pasos["numcampos"]){
    $texto.='<ul>';
    for($j=0;$j<$pasos["numcampos"];$j++){
      $texto.='<li>'.$pasos[$j]["nombre_paso"].'</li>';
    }
    $texto.='</ul>';
  }
return($texto);
}
}
?>
<script type="text/javascript">
  $(document).ready(function(){
    $(".tooltip_saia").tooltip();
  });  
  
</script>