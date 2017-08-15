<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
    }
    $ruta.="../";
    $max_salida--;
}
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
include_once($ruta_db_superior."pantallas/documento/menu_principal_documento.php");

require_once($ruta_db_superior . 'StorageUtils.php');
require_once($ruta_db_superior . 'filesystem/SaiaStorage.php');
require($ruta_db_superior . 'vendor/autoload.php');

use Imagine\Image\Box;
use Imagine\Gd\Imagine;

//echo(estilo_bootstrap());
$modulo="ordenar_pag";
echo (menu_principal_documento($_REQUEST["iddocumento"], 1, array(
		"nombre" => $modulo,
		"tipo" => 0
)));
unset($_SESSION["pagina_actual"]);
unset($_SESSION["tipo_pagina"]);
$_SESSION["pagina_actual"]=$_REQUEST["idpagina"];
//echo(librerias_jquery("1.7"));
//echo(librerias_bootstrap());
$modulo_pagina= busca_filtro_tabla("","modulo", "nombre='".$modulo."'", "", $conn);
$pagina=  busca_filtro_tabla("", "pagina", "consecutivo=".$_REQUEST["idpagina"], "", $conn);

$ultima_pagina = busca_filtro_tabla("consecutivo,pagina","pagina","id_documento=".$_REQUEST['iddocumento'],"pagina DESC",$conn);
$primera_pagina = busca_filtro_tabla("consecutivo,pagina","pagina","id_documento=".$_REQUEST['iddocumento'],"pagina ASC",$conn);

if($pagina[0]['pagina'] == 1){
	$pagina_anterior = 0; 
}else{
	$pagina_anterior = busca_filtro_tabla("consecutivo,pagina","pagina","id_documento=".$_REQUEST['iddocumento']." AND pagina=".($pagina[0]['pagina']-1),"",$conn);	
}

if($pagina[0]['pagina'] == $ultima_pagina[0]['pagina']){
	$pagina_siguiente = 0;
}else{
	$pagina_siguiente = busca_filtro_tabla("consecutivo,pagina","pagina","id_documento=".$_REQUEST['iddocumento']." AND pagina=".($pagina[0]['pagina']+1),"",$conn);	
}

$paginas = busca_filtro_tabla("consecutivo,pagina","pagina","id_documento=".$_REQUEST['iddocumento'],"pagina ASC",$conn);
if($pagina["numcampos"]){
	$contenido_base64 = StorageUtils::get_binary_file($pagina[0]["ruta"]);
	$contenido_bin = StorageUtils::get_file_content($pagina[0]["ruta"]);
	$imagine = new Imagine();
	$imagen = $imagine->load($contenido_bin);

	//list ($width, $height) = getimagesize($ruta_db_superior . $pagina[0]["imagen"]);
	$width = $imagen->getSize()->getWidth();
	$height = $imagen->getSize()->getHeight();

	echo ('<div><img src="' . $contenido_base64 . '" id="pagina_documento" idregistro="' . $pagina[0]["consecutivo"] . '"></div>');
  echo(librerias_acciones_kaiten());           
  echo(librerias_zoom());
  echo(librerias_rotate());
}
?>
<style>
  #pagina_documento{ max-width:20000000px; max-height:200000000px; min-width:<?php echo($width);?>; min-height:<?php echo($height);?>;}
  
</style>
<script type="text/javascript">
$(document).ready(function(){
  var angulo=90;
  $("#modulo_adicional_<?php echo($modulo);?>").find(".kenlace_saia_propio").each(function(){
      var enlace=$(this).attr("enlace");
      enlace=enlace.toString().replace("@iddocumento@","<?php echo($_REQUEST["iddocumento"]);?>");
      enlace=enlace.toString().replace("@idpagina@","<?php echo($_REQUEST["idpagina"]);?>");        
      $(this).attr("enlace",enlace);
  });          
  $('.alejar_pagina').live('click',function(){    
    var width=$("#pagina_documento").width();
    var height=$("#pagina_documento").height();
    var nwidth=$("#pagina_documento").width()-20;
    var nheight=$("#pagina_documento").height()-20;
    if (width < height) {
      nwidth = (nheight / height) * width;
    } else {
      nheight = (nwidth / width) * height;
    }    	                      
		$("#pagina_documento").width(nwidth);						
		$("#pagina_documento").height(nheight);								
		return false; 
  });
  $('.acercar_pagina').live('click',function(){								
		var width=$("#pagina_documento").width();
    var height=$("#pagina_documento").height();
    var nwidth=$("#pagina_documento").width()+20;
    var nheight=$("#pagina_documento").height()+20;
    if (width < height) {
      nwidth = (nheight / height) * width;
    } else {
      nheight = (nwidth / width) * height;
    }    	                      
		$("#pagina_documento").width(nwidth);						
		$("#pagina_documento").height(nheight);				
		return false; 
  });  
  $('.rotar_pagina').live('click',function(){    	
		$("#pagina_documento").rotate(angulo);
		angulo=angulo+90;			
		return false; 
  });
  
  if("<?php echo($pagina_anterior)?>" === '0'){
  	$('.pagina_anterior').attr("disabled","disabled");
    $('.pagina_anterior').removeClass("pagina_anterior");
  }
  
  if("<?php echo($pagina_siguiente)?>" === '0'){
  	$('.pagina_siguiente').attr("disabled","");
    $('.pagina_siguiente').removeClass("pagina_siguiente");
  }

  $('.eliminar_pagina').live('click',function(){    	
		window.open("<?php echo($ruta_db_superior);?>pantallas/pagina/eliminar_pagina.php?paginas=<?php echo($_REQUEST["idpagina"]);?>&iddocumento=<?php echo($_REQUEST['iddocumento']);?>","detalles");
  });
  
  $('.pagina_anterior').live('click',function(){
  	window.open("<?php echo($ruta_db_superior);?>pantallas/pagina/mostrar_pagina.php?idpagina=<?php echo($pagina_anterior[0]['consecutivo']);?>&iddocumento=<?php echo($_REQUEST['iddocumento']);?>","detalles");
  });
  
  $('.pagina_siguiente').live('click',function(){
  	window.open("<?php echo($ruta_db_superior);?>pantallas/pagina/mostrar_pagina.php?idpagina=<?php echo($pagina_siguiente[0]['consecutivo']);?>&iddocumento=<?php echo($_REQUEST['iddocumento']);?>","detalles");
  });
  
  $('.primera_pagina').live('click',function(){
  	window.open("<?php echo($ruta_db_superior);?>pantallas/pagina/mostrar_pagina.php?idpagina=<?php echo($primera_pagina[0]['consecutivo']);?>&iddocumento=<?php echo($_REQUEST['iddocumento']);?>","detalles");
  });
  
  $('.ultima_pagina').live('click',function(){
  	window.open("<?php echo($ruta_db_superior);?>pantallas/pagina/mostrar_pagina.php?idpagina=<?php echo($ultima_pagina[0]['consecutivo']);?>&iddocumento=<?php echo($_REQUEST['iddocumento']);?>","detalles");
  });    
});
</script>
<?php
notas_imagenes();
function notas_imagenes(){
	global $ruta_db_superior, $conn;
	$comentario=busca_filtro_tabla("","comentario_img","pagina=".$_REQUEST["idpagina"],"",$conn);
	if($comentario["numcampos"]){
		echo '<div id="notas" style="display:block;">';
  ?>
  <script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/ordenar_list.js"></script>	
	<link rel="stylesheet" href="<?php echo($ruta_db_superior);?>css/bubble-tooltip.css" media="screen">
	<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/bubble-tooltip.js"></script>
  <style type="text/css">
.estilotextarea 
{   width: 140px;
    height:100px;
    border: none;
    background-color: #ffff99;       
    font-family: Verdana; 
    font-size: 9px;  
}
.ppal{
		margin:0px;
		margin-top:0px;
		width:100%;		
		background-color:#CCCCCC;
		font-family: Verdana;
		font-size: 9px;
    overflow:scroll;
	}
.tool_tabla{
    border-width: 10px;
    border-color: blue;    
    border: outset 3pt;    
    border-spacing: 2pt;   
    border: 5px solid #073A78;     
}
.tool_td{
    border: 1px solid #073A78; 
    padding: 1em;     
}	
img{
    border: none;   
}	

	</style>
  <div id="bubble_tooltip" >
		<div class="bubble_top"></div>
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
	  	<table class="tooltip_text" href="#" onmousemove="showToolTip(event,'<?php echo trim($texto); ?>','<?php echo ($posy-40); ?>'); return false" onmouseout="hideToolTip()" style="font-size:8pt;width:15px;height:10px;position:absolute; top:<?php echo ($posy+24); ?>px; left:<?php echo ($posx); ?>px">
	    	<tr><td  align="center" background="<?php echo ($ruta_db_superior); ?>images/mostrar_nota.png"><?php echo ($i+1);?></td></tr>
	    </table>
	    Comentario N&ordm;
	    <?php   
	    echo ($i+1).": ".$texto."&nbsp;&nbsp;&nbsp;&nbsp; Autor: ".$nombre_usuario_nota[0]["nombres"]." ".$nombre_usuario_nota[0]["apellidos"]."<br>";
		}
   	echo '</div>';
	}
}
?>
