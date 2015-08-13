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
//include_once($ruta_db_superior."header.php");
include_once($ruta_db_superior."formatos/librerias/estilo_formulario.php");
include_once($ruta_db_superior."workflow/libreria_paso.php");
?>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide-full.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<?php
$idpaso=$_REQUEST["idpaso_documento"];
$flujo_documento=busca_filtro_tabla("","paso_documento A,diagram_instance B","A.diagram_iddiagram_instance=B.iddiagram_instance AND A.idpaso_documento=".$idpaso,"",$conn);
$flujo=busca_filtro_tabla("","diagram_history","diagram_iddiagram=".$flujo_documento[0]["diagram_iddiagram"],"iddiagram_history DESC",$conn);
$imagen=$ruta_db_superior.@$flujo[0]["ruta_imagen"];
$datos_imagen=getimagesize($imagen);
?>
<link rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/estilo_flujos.css"/>
<style>           
  #contenedor{
    border:0px solid;
    position:absolute;
    width:70%;
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
/* CSS for wrapperClassName: 'full-size' */
.full-size .highslide-html-content {
  width: auto;
}
</style>
<script type='text/javascript'>
    hs.graphicsDir = '<?php echo($ruta_db_superior);?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
    hs.outlineType = 'rounded-white';
    //hs.marginLeft = 610;
    hs.targetX = 'descriptor -350px';
    hs.targetY = 'descriptor 0px';
</script>
<div id="contenedor">
  <img src="<?php echo($imagen);?>" style="z-index:-1;">
  <?php
  $pasos=busca_filtro_tabla("","paso","diagram_iddiagram=".$flujo_documento[0]["diagram_iddiagram"]." AND estado=1","",$conn);
  $pasos_documento=busca_filtro_tabla("","paso_documento","diagram_iddiagram_instance=".$flujo_documento[0]["diagram_iddiagram_instance"],"idpaso_documento",$conn);

  $doc = $pasos_documento[($pasos_documento["numcampos"]-1)]["documento_iddocumento"];
  $descripcion = busca_filtro_tabla("","documento","iddocumento=".$doc,"",$conn);
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
    $esta=array_search($pasos[$i]["idpaso"],$datos_paso_documento);  
    if($esta!==FALSE){       
        $estado=$pasos_documento[$esta]["estado_paso_documento"];
        //var_dump($pasos_documento);
        $diagram=$pasos_documento[$esta]["diagram_iddiagram_instance"];
        $documento=$pasos_documento[$esta]["documento_iddocumento"];
        $idpaso_documento=$pasos_documento[$esta]["idpaso_documento"]; 
    }
    else{
      $esta="";
      $diagram="";
      $documento="";
      $idpaso_documento="";
    }
    ?>
    <a href="actividades_paso_usuario.php?idpaso=<?php echo($pasos[$i]["idpaso"]);?>&diagrama=<?php echo($diagram);?>&documento=<?php echo($documento);?>&idpaso_documento=<?php echo($idpaso_documento);?>"  class="highslide" onclick="return hs.htmlExpand(this, { objectType: 'iframe',width: 520, height:400, preserveContent:'false'} )" id="paso_documento<?php echo($idpaso_documento);?>">
    <div  class="paso<?php echo($estado);?> transparencia_paso" style=" position:absolute; top:<?php echo($y1);?>px; left:<?php echo($x1);?>px; width:<?php echo($x2-$x1);?>; height:<?php echo($y2-$y1);?>;"> 
    </div>
    </a>
  <?php
  }
  ?>
  <br>
  <table style="font-family:arial">
  	<tr>
  		<td colspan="2">
  			<strong>Informaci&oacute;n del documento que inicia el flujo</strong>	
  		</td>
   	</tr>
  	<tr>
  		<td>
  			<strong>Descripci&oacute;n </strong>
  		</td>
  		<td>
  			<?php echo ucfirst(strtolower(strip_tags($descripcion[0]["descripcion"]))); ?>
  		</td>
  	</tr>
  	<tr>
  		<td>
  			<strong>N&uacute;mero de radicado </strong>			
  		</td>
  		<td>
  			<?php echo $descripcion[0]["numero"]; ?>
  		</td>
  	</tr>
  	<tr>
  		<td>
  			<strong>Fecha de radicado </strong>
  		</td>
  		<td>
  			<?php echo $descripcion[0]["fecha"]; ?>
  		</td>
  	</tr>
  	<tr>
  		<td>
  			<strong>Iniciado desde </strong>
  		</td>
  		<td>
  			<?php if($descripcion[0]["plantilla"]!=""){$formato=busca_filtro_tabla("","formato","nombre='".$descripcion[0]["plantilla"]."'","",$conn); echo(@$formato[0]["etiqueta"]);} else if(@$descripcion[0]["tipo_radicado"]==1){echo("RADICACI&Oacute;n ENTRADA");} ?>
  		</td>
  	</tr>
  </table>
</div>
<div id="rastro_flujo">
  <?php 
    $flujo=estado_flujo_instancia($idpaso);  
  //print_r($flujo);
  $porcentaje=$flujo["porcentaje"];
  $fecha_final_diagram=$flujo["fecha_final_diagrama"];
  $diferencia=$flujo["diferenciad"];
   switch($flujo[0]["estado_diagram_instance"]){
    case 1:
      $estadod="<br /><strong>Vencimiento Flujo</strong>:".$fecha_final_diagram;
    break;
    case 2:
      $estadod="<br /><strong>Vencimiento Flujo</strong>:".$fecha_final_diagram;
    break;
    case 3:
      $estadod="<br /><strong>Vencimiento Flujo</strong>:".$fecha_final_diagram;      
    break;
    case 4:                     
      $estadod="<br /><strong>Vencimiento Flujo</strong>:".$fecha_final_diagram;                       
    break;                                       
    case 5:
      $estadod="<br /> <strong>Vencimiento Flujo</strong>:".$fecha_final_diagram." <br />Atrasado: ".$diferenciad["year"]." A&ntilde;os ".$diferenciad["month"]." Meses ".$diferenciad["day"]." d&iacute;as";
    break;
    case 6:
      $estadod="<br />  <strong>Vencimiento Flujo</strong>:".$fecha_final_diagram;
    break;
  }
  $instancia_flujo=busca_filtro_tabla("","diagram A,diagram_instance B","A.id=B.diagram_iddiagram AND B.iddiagram_instance=".$flujo[0]["iddiagram_instance"],"",$conn);
  //print_r($instancia_flujo); 
  $fecha_inicial=date_parse($instancia_flujo[0]["fecha"]);
  $texto='<table style="width:100%;" id="descriptor"><tr><td class="encabezado_list" colspan="2">Datos del Flujo</td></tr>';
  $texto.='<tr><td class="encabezado" width="100px">N&uacute;mero</td><td>'.$instancia_flujo[0]["iddiagram_instance"].'</td></tr>';
  $texto.='<tr><td class="encabezado" width="100px">Nombre</td><td>'.$instancia_flujo[0]["title"].'</td></tr>';
  $texto.='<tr><td class="encabezado" width="100px">Fecha de Creaci&oacute;n </td><td>'.$fecha_inicial["year"]."-".$fecha_inicial["month"]."-".$fecha_inicial["day"].'</td></tr>';
  $texto.='<tr><td class="encabezado" width="100px">Fecha de Vencimiento</td><td>'.$fecha_final_diagram.'</td></tr>';
  $texto.='<tr><td class="encabezado" width="100px">Estado</td><td>'.'<strong>Paso Actual: </strong>'.$flujo[0]["nombre_paso"]."<br /><br /><strong>Terminados:</strong> (".(($flujo["numcampos"]))."/".$flujo["pasos_flujo"]."):".$porcentaje.'% <br><strong>Devueltos</strong>:'.$flujo["devueltos"];
  if($instancia_flujo[0]["estado_diagram_instance"] == 3){
  		$idpaso = busca_filtro_tabla("c.nombre_paso,a.observaciones","diagram_closed a,paso_documento b,paso c","a.diagram_iddiagram_instance=".$instancia_flujo[0]["iddiagram_instance"]." and documento_idpaso_documento=idpaso_documento and b.paso_idpaso=idpaso","",$conn);
	  	
  		$texto .= '<br><strong>Cancelado en paso:</strong> '.$idpaso[0]["nombre_paso"];
		$texto .= '<br><strong>Nota:</strong> '.$idpaso[0]["observaciones"];
  }	
  $texto.='</td></tr>';
  $texto.='<tr><td class="encabezado" width="100px">Descripci&oacute;n</td><td>'.$instancia_flujo[0]["description"].'</td></tr>';
  $texto.='<tr><td colspan="2" align="center"><a href="rastro_flujo.php?idflujo_instancia='.$instancia_flujo[0]["iddiagram_instance"].'" class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\', wrapperClassName: \'draggable-header full-size\', targetX: \'contendor 0px\', targetY: \'contenedor 10px\', height:350, preserveContent:false} )">Ver Rastro del Flujo</a></td></tr>';
  $texto.='</table>';
  /*1,Ejecutado(#99FF66);2,Cerrado(#99FF66),3,Cancelado(#FF00FF);4,Pendiente(#FFFF66);5,Atrasado(#FF3333);6,Iniciado( #FFFF66);7,Devuelto(#000000)*/
  $enlaces='';
  $enlaces.="<table><tr><td style='vertical-align:top;'>&nbsp;Terminados<div class='paso1' style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>";
      //$enlaces.="<td class='paso2'><a href='../verificar_flujoslist.php?estado_flujo=2' target='centro'>Flujos Cerrados</a>&nbsp;</td>";
  $enlaces.="<tr><td style='vertical-align:top;'>&nbsp;Pendientes<div class='paso4' style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr>";
  $enlaces.="<tr><td style='vertical-align:top;'>&nbsp;Atrasados</a>&nbsp;<div class='paso5' style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr><tr><td style='vertical-align:top;'>&nbsp;Cancelados<div class='paso3' style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;</div></td></tr><tr><td style='vertical-align:top;'>&nbsp;Con devoluciones<div class='paso7' style='float:left;'>&nbsp;&nbsp;&nbsp;&nbsp;</div></td>";
  $enlaces.="</tr></table>";
  echo $texto.$enlaces;
  ?>
</div>
<?php //include_once($ruta_db_superior."footer.php");
?> 