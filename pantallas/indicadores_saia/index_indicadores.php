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
include_once($ruta_db_superior."librerias_saia.php");
?>
<style>    
  .item{padding:0px; margin: 10px;overflow:auto;}
  .encabezado_grafico{border: 1px solid #2f96b4; }
  .encabezado_grafico p.desc_iframe{height:20px; padding:4px; margin: 0 !important; }
  .alert-info{padding:0px; margin-bottom:5px; padding-top:5px;}
  .item h6{margin:2px; }
  .menu_grafico{height: 20px;cursor:pointer;}
  .menu_reporte{height: 20px;}
  .recargar_indicadores{height: 20px;}  
  .loader{background-image: url('<?php echo($ruta_db_superior);?>imagenes/cargando.gif'); width:16px; height:16px;}
</style>
<?php 
echo(estilo_bootstrap());
$indicador=busca_filtro_tabla("","indicador","idindicador=".$_REQUEST["idindicador"],"",$conn);
$reporte_graficos=busca_filtro_tabla("A.*,B.nombre AS componente,B.busqueda_idbusqueda","busqueda_grafico A,busqueda_componente B","A.busqueda_idbusqueda_componente=B.idbusqueda_componente AND A.indicador_idindicador=".$_REQUEST["idindicador"],"A.orden",$conn);
$datos = array();
?>
<style>
.contenedor_body{
		margin-top:0px;
		width: 100%;
  	overflow:auto;
  	height:100%;
  	-webkit-overflow-scrolling:touch;
  }
</style>
<div class="contenedor_body" id="contenedor_body">
<div class="row-fluid">
	<div class="span12"><h5><span class="texto_azul"><?php echo($indicador[0]["etiqueta"]);?></span></h5></div>
	<div class="pull-left loader" id="formulario_busqueda">   		
	</div>
</div>
<div id="container">	
	<?php
	for($i=0;$i<$reporte_graficos["numcampos"];$i++){
		$url=$ruta_db_superior;
		switch($reporte_graficos[$i]["tipo_grafico"]){
			case 1:
				$url.='pantallas/graficos/graficos_jqplot.php?idbusqueda_grafico='.$reporte_graficos[$i]["idbusqueda_grafico"];
			break;
			default:
				$url.='pantallas/graficos/graficos_jqplot_bar.php?idbusqueda_grafico='.$reporte_graficos[$i]["idbusqueda_grafico"];
			break;					
		}
	?>
	<div class="item" id="grafico_<?php echo($reporte_graficos[$i]["idbusqueda_grafico"]);?>">
		<div class="menu_grafico" id="enlace_informe" componente="<?php echo($reporte_graficos[$i]["busqueda_idbusqueda_componente"]);?>"><h6 class="pull-right">Ver informe</h6></div> 
		<div class="encabezado_grafico" id='item_<?php echo($reporte_graficos[$i]["idbusqueda_grafico"]);?>'>
			<div class='alert-info' id='desc_iframe_<?php echo($reporte_graficos[$i]["idbusqueda_grafico"]);?>'>
				<h6 >&nbsp;&nbsp;&nbsp;<?php echo($reporte_graficos[$i]["etiqueta"]);?></h6>			
			</div>
			<?php if($url!=$ruta_db_superior){ ?>
				<iframe frameborder='0' class="iframe_grafico" filtro='' scrolling='auto' width='<?php echo($reporte_graficos[$i]["ancho"]);?>px' height='<?php echo($reporte_graficos[$i]["alto"]-100);?>px' id="frame_grafico<?php echo($reporte_graficos[$i]["idbusqueda_grafico"]);?>" src='<?php echo($url);?>' enlace='<?php echo($url);?>'></iframe>
			<?php }?>	
		</div>
	</div>		
<?php }
$valor_variables=array();
$reportes=busca_filtro_tabla("A.*,B.nombre AS componente,B.busqueda_idbusqueda,C.ruta_libreria","busqueda_indicador A,busqueda_componente B, busqueda C","B.busqueda_idbusqueda=C.idbusqueda AND A.busqueda_idbusqueda_componente=B.idbusqueda_componente AND A.indicador_idindicador=".$_REQUEST["idindicador"],"A.idbusqueda_indicador",$conn);
for($i=0;$i<$reportes["numcampos"];$i++){
	$url=$ruta_db_superior;
	$url.="pantallas/graficos/datos_indicador.php?idbusqueda_indicador=".$reportes[$i]["idbusqueda_indicador"];
	?>
	<div class="item" id="reporte_<?php echo($reportes[$i]["idbusqueda_indicador"]);?>">
		<div class="encabezado_grafico" id='item_<?php echo($reportes[$i]["idbusqueda_indicador"]);?>'>
			<div class='alert-info' id='desc_reporte_<?php echo($reportes[$i]["idbusqueda_indicador"]);?>'>
				<h6 style="text-align: center;"><?php echo($reportes[$i]["etiqueta"]);?></h6>			
			</div>
			<iframe frameborder='0' class="iframe_grafico" filtro='' scrolling='auto' width='<?php echo($reportes[$i]["ancho"]);?>px' height='<?php echo($reportes[$i]["alto"]);?>px' id="frame_grafico<?php echo($reportes[$i]["idbusqueda_indicador"]);?>" src='<?php echo($url);?>' enlace='<?php echo($url);?>'></iframe>
		</div>	
	</div>
	<?php	
}
?>							
</div>
</div>
<?php
echo(librerias_jquery("1.7"));
echo(librerias_bootstrap());  
?> 
<script src="<?php echo ($ruta_db_superior); ?>js/jquery.isotope.min.js"></script>     
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>pantallas/lib/validaciones_formulario.js"></script>
<script type="text/javascript">
$(document).ready(function(){	
	$("#formulario_busqueda").load("<?php echo($ruta_db_superior.$indicador[0]["ruta_formulario"]);?>",function(){
    $("#formulario_busqueda").removeClass("loader");
    <?php
    $busqueda_componente="";
		if($reporte_graficos[0]["busqueda_idbusqueda_componente"]){
			$busqueda_componente=$reporte_graficos[0]["busqueda_idbusqueda_componente"];
		}else{
			$busqueda_componente=$reportes[0]["busqueda_idbusqueda_componente"];
		}
    ?>
    $("#recargar_indicadores").attr("componente",'<?php echo($busqueda_componente);?>');
  });
	$("#container").isotope({
  	itemSelector : '.item',
  	layoutMode : 'fitRows',
  	animationOptions:{
    duration: 750,
    easing: 'linear',
    queue: false
    }
	});
	$(".enlace_saia").live("click",function(){
		window.open($(this).attr("enlace"),$(this).attr("destino"));
	});  
	$(".menu_grafico").live("click",function(){
		if(!$("#idbusqueda_componente").length){
			$("#kformulario_saia").append('<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="'+$(this).attr("componente")+'">');
		}		
		var id_parent=$(this).parent().attr('id');
		var vector_idgrafico=id_parent.split('_');
		var idgrafico=vector_idgrafico[1];
		if(!$('[name="idbusqueda_grafico"]').length){
			var cadena_input='<input type="hidden" name="idbusqueda_grafico" value="'+idgrafico+'">';
			$("#kformulario_saia").append(cadena_input);
		}else{
			$('[name="idbusqueda_grafico"]').remove();
			var cadena_input='<input type="hidden" name="idbusqueda_grafico" value="'+idgrafico+'">';
			$("#kformulario_saia").append(cadena_input);
		}		
		enviar_formulario_saia("<?php echo($ruta_db_superior);?>pantallas/busquedas/procesa_filtro_busqueda.php","",'',1);		
	});
	$(".menu_reporte").live("click",function(){
		if($("#idbusqueda_componente").length){
			$("#idbusqueda_componente").val($(this).attr("componente"));
		}
		else{
			$("#kformulario_saia").append('<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="'+$(this).attr("componente")+'">');
		}			
		enviar_formulario_saia("pantallas/busquedas/procesa_filtro_busqueda.php","",'',1);		
	});	    
	$(".recargar_indicadores").live("click",function(){
		if($("#idbusqueda_componente").length){
			$("#idbusqueda_componente").val($(this).attr("componente"));
		}else{
			$("#kformulario_saia").append('<input type="hidden" name="idbusqueda_componente" id="idbusqueda_componente" value="'+$(this).attr("componente")+'">');
		}
		var datos=enviar_formulario_saia("<?php echo($ruta_db_superior);?>pantallas/busquedas/procesa_filtro_busqueda.php","<?php echo($ruta_db_superior);?>",'',0);
		if(datos.exito){
			$(".iframe_grafico").each(function(indice,valor){
			 	$(this).attr("src", $(this).attr("enlace")+datos.filtro);
			});
		}	
	});
});
</script>