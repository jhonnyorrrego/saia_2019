<?php
if((!isset($_REQUEST["tipo"]) || $_REQUEST["tipo"]==1)){
  $contenido_pie=busca_filtro_tabla("pie","pantalla_encabezado","fk_idpantalla='".$_REQUEST["idpantalla"]."'","",$conn);
  echo('</table>
  </div>
      </div>
        <div class="page_margin_bottom" id="doc_footer">');
  if($contenido_pie[0]["pie"]){
    echo crear_encabezado_pie(stripslashes($contenido_pie[0][0]),$_REQUEST["iddoc"],$formato);
  }    
  echo('</div>
    </div>
  </div>
  </div>');
  //echo formulario_rechazar_aprobar($_REQUEST["iddoc"],"mostrar_".$formato[0]["nombre"]);  
  if(isset($_REQUEST["ver_notas"])){
     if(!isset($_REQUEST["comentario"])){
       $comentario=busca_filtro_tabla("*","comentario_img","documento_iddocumento=".$_REQUEST["iddoc"]." AND tipo='PLANTILLA' AND pagina='".$_REQUEST["iddoc"]."'","",$conn);
      echo '<script type="text/javascript" src="../../js/bubble-tooltip.js"></script>
            <link rel="STYLESHEET" type="text/css" href="../../css/bubble-tooltip.css">
            <div id="notas" style="display:block;" style="font-size:xx-small" >';
?>
  <div id="bubble_tooltip">
	<div class="bubble_top" style="background-color:white"></div>
	<div class="bubble_middle"><span id="bubble_tooltip_content"></span></div>
	<div class="bubble_bottom"></div>
  </div>
   <?php
    for($i=0; $i<$comentario["numcampos"]; $i++){  
      $posx=$comentario[$i]["posx"];
      $posy=$comentario[$i]["posy"];
      $texto=$comentario[$i]["comentario"];
      $id = $comentario[$i]["idcomentario_img"];
      $nombre_usuario_nota = busca_filtro_tabla("nombres, apellidos","funcionario","login='".$comentario[$i]["funcionario"]."'","",$conn);
       ?>       
       <table class="tooltip_text" href="#" onmousemove="showToolTip(event,'<?php echo trim($texto); ?>','<?php echo ($posy-75); ?>'); return false" onmouseout="hideToolTip()" width="20px" height="20px" style="position:absolute; top:<?php echo ($posy-10); ?>px; left:<?php echo ($posx); ?>px">
       <tr><td  align="center" background="../../images/mostrar_nota.png" style="background-repeat: no-repeat; font-size:xx-small"><?php echo ($i+1);?></td></tr>
       </table>   
       Comentario N&ordm;
       <?php   
       echo ($i+1).".  Autor: ".$nombre_usuario_nota[0]["nombres"]." ".$nombre_usuario_nota[0]["apellidos"]."&nbsp;&nbspFecha: ".$comentario[0]["fecha"]."&nbsp;&nbsp;Texto:".$texto."<br>";
     }
     echo "</div>";
    }
    $notas=busca_filtro_tabla("notas,nombres,apellidos,".fecha_db_obtener("fecha","Y-m-d H:i")." as fecha","buzon_salida,funcionario","funcionario_codigo=origen and destino=".usuario_actual("funcionario_codigo")." and trim(notas)<>'' and archivo_idarchivo=".$_REQUEST["iddoc"],"fecha desc",$conn);
    if($notas["numcampos"])
    {echo "<font size=1>Notas Transferencias:<br />";
     for($i=0; $i<$notas["numcampos"]; $i++)
        echo ($i+1).". Autor: ".$notas[$i]["nombres"]." ".$notas[$i]["apellidos"]." Fecha: ".$notas[$i]["fecha"]." Nota: ".$notas[$i]["notas"]."<br />";
      echo "</font>";
     } 
    } 
echo('</div></body>');
}
?>