<?php
$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
  if(is_file($ruta."db.php")){
    $ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
  }
  $ruta.="../";
  $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
$flujo=busca_filtro_tabla("","diagram_history A,diagram B","A.diagram_iddiagram=B.id AND A.diagram_iddiagram=".$_REQUEST["iddiagram"],"A.iddiagram_history DESC",$conn);
$imagen=$ruta_db_superior.$flujo[0]["ruta_imagen"];
$datos_imagen=getimagesize ($imagen);
?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/estilo_flujos.css"/>
<style>           
  #contenedor{
    border:0px solid;
    position:absolute;
    width:98%;
    overflow:auto;
    float:left;
    height:100%;
  }
  #imagen_flujo{
    position:absolute;
    background-image:url(<?php echo($imagen);?>); 
    height: <?php echo($datos_imagen[1].'px');?>; 
    width: <?php echo($datos_imagen[0].'px');?>; 
    border: 0px solid;

  }
  #rastro_flujo{
    border:1px solid;
    width:29%;
    height:95%;
    overflow:auto;
    float: right;
  }
  .texto{
    opacity:1; 
    position:relative;
  }
  .alterno{
    background-color:#FFFFFF;
  }
  .alterno2{
    background-color:#CDCDCD;
  }
  td{
    border:1px solid;
  }
  .lista li{
    padding-left: 0px;
  }
   ul{
    padding-left:10px;
    margin:4px;
  }
</style>

<div id="contenedor">
  <img src="<?php echo($imagen);?>" style="z-index:-1;">
  <?php
  $pasos=busca_filtro_tabla("","paso","diagram_iddiagram=".$flujo[0]["diagram_iddiagram"]." AND estado=1","",$conn);
  ?>
  <script>
    hs.addEventListener(window, "load", function() {
    // click the element virtually:
    document.getElementById("paso_documento<?php echo($pasos_documento[($pasos_documento["numcampos"]-1)]["idpaso_documento"]);?>").onclick();
});
  </script>
  <?php
  //print_r($pasos_documento);
  //echo("<hr>");
  $datos_paso_documento=extrae_campo($pasos_documento,"paso_idpaso","jj");
  $datos_paso_documento=array_unique($datos_paso_documento); 
  //print_r($datos_paso_documento);
  //echo("<hr>");
  for($i=0;$i<$pasos["numcampos"];$i++){
    $posiciones=explode(",",$pasos[$i]["posicion"]);
    $estado=4;
    $x1=$posiciones[0];
    $x2=$posiciones[2];
    $y1=$posiciones[1];
    $y2=$posiciones[3];
    ?>
    <div  class="paso<?php echo($estado);?> transparencia_paso" style=" position:absolute; top:<?php echo($y1);?>px; left:<?php echo($x1);?>px; width:<?php echo($x2-$x1);?>; height:<?php echo($y2-$y1);?>;"> 
    </div> 
  <?php
  }
  ?>  
</div>
<div id="rastro_flujo">
<a href="index.php?diagramId=<?php echo($_REQUEST["iddiagram"]);?>">Editar Flujo</a>
  <?php 
  $texto='<table style="width:100%;" id="descriptor"><tr><td class="encabezado_list" colspan="2">Datos del Flujo</td></tr>';
  $texto.='<tr><td class="encabezado" width="100px">Nombre</td><td>'.$flujo[0]["title"].'</td></tr>';
  $texto.='<tr><td class="encabezado" width="100px">Descripci&oacute;n</td><td>'.$flujo[0]["description"].'</td></tr>';  
  $texto.='</table>';
  echo $texto.$enlaces;
  ?>
  
<table width="100%" style="border-collapse: collapse; border: 1px solid;">
  <tr class="encabezado_list"><td>Inicio</td><td>Fin</td><td>Actividades y Responsable</td></tr>

<?php
$pasos_flujo=busca_filtro_tabla("","paso A,paso_enlace B","A.idpaso=B.origen AND A.diagram_iddiagram=".$flujo[0]["diagram_iddiagram"],"A.idfigura",$conn);
for($i=0;$i<$pasos_flujo["numcampos"];$i++){
  $actividades=array();
  $texto2="";
  $terminada=0;
  $estado='';
  $color='4';
  $documento="&nbsp;";
  if($i==0){
    $paso_inicial=busca_filtro_tabla("","paso_enlace","origen=-1 AND diagram_iddiagram=".$flujo[0]["diagram_iddiagram"],"",$conn);
    if($paso_inicial["numcampos"])
      $inicio='Inicio';
    else
      $inicio='<span style="color:red;">Error Inicio</span>';  
  }  
  else{
    $inicio=$final;    
  }
  if($i%2==0){
    $clase="alterno";
  }
  else{
    $clase="alterno2";
  }
  $observaciones_terminacion='&nbsp;';
  $final=$pasos_flujo[$i]["nombre_paso"];
  $actividades_paso=busca_filtro_tabla("","paso_actividad","paso_idpaso=".$pasos_flujo[$i]["idpaso"],"",$conn);
  $texto2='';
  for($j=0;$j<$actividades_paso["numcampos"];$j++){
    $chulo="";
    if($actividades_paso[$j]["restrictivo"]){
      $restrictivo="Obligatorio";
    }
    else{
      $restrictivo="";
    }
    $texto2.="<li>".$actividades_paso[$j]["descripcion"]."(".$restrictivo.")".$chulo."</li>";  
  }
  $texto='<tr class="'.$clase.'"><td>'.$inicio.'</td><td>'.$final.'</td><td><ul  class="lista">'.$texto2.'</ul></td></tr>';
  echo($texto);
}
$paso_final=busca_filtro_tabla("","paso_enlace","destino=-2 AND diagram_iddiagram=".$flujo[0]["diagram_iddiagram"],"",$conn);
if($paso_final["numcampos"]){
  $fin='Fin';
}
else{
  $fin='<span style="color:red;">Error Final</span>'; 
}
$texto='<tr><td>'.$final.'</td><td>'.$fin.'</td><td>---</td></tr>';
echo($texto);
?>
</table>
</div>
<?php //include_once($ruta_db_superior."footer.php");?> 