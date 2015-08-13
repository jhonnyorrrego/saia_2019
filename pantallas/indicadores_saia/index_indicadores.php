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
		<!--div class="recargar_indicadores" id="recargar_indicadores" componente="<?php echo($reporte_graficos[$i]["busqueda_idbusqueda_componente"]);?>"><h6 class="pull-right">Actualizar Gr&aacute;ficos | </h6></div-->
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
$reportes=busca_filtro_tabla("A.*,B.nombre AS componente,B.busqueda_idbusqueda,C.ruta_libreria","busqueda_indicador A,busqueda_componente B, busqueda C","B.busqueda_idbusqueda=C.idbusqueda AND A.busqueda_idbusqueda_componente=B.idbusqueda_componente AND A.indicador_idindicador=".$_REQUEST["idindicador"],"",$conn);
for($i=0;$i<$reportes["numcampos"];$i++){
	if($reportes[$i]["ruta_libreria"]!=''){
		$librerias=explode(",",$reportes[$i]["ruta_libreria"]);
		$cant_librerias=count($librerias);
		for($j=0;$j<$cant_librerias;$j++){			
			include_once($ruta_db_superior.$librerias[$j]);
		}		
	}
	$regs=array();	
	$resultado=preg_match_all( '({\*([a-z]+[0-9]*[_]*[a-z]*[0-9]*[.]*[,]*[@]*)+\*})',$reportes[$i]["descripcion"], $regs );
  unset($valor_variables);
  $valor_variables=array();
	if($resultado){
		$cadena=str_replace("{*", "", str_replace("*}", "", $regs[0][0]));				
		$funcion=explode("@",$cadena);
		$variables=array();		
		if(@$funcion[1]!=''){	
			$variables=explode(",",@$funcion[1]);
		}
		$cant_variables=count($variables);
		for($h=0;$h<$cant_variables;$h++){
		    array_push($valor_variables,$variables[$h]);
		}
		$resultado_call=call_user_func_array($funcion[0],$valor_variables);
		$reportes[$i]["descripcion"]=str_replace("{*".$cadena."*}",$resultado_call,$reportes[$i]["descripcion"]);
	}  
	?>
	<div class="item" id="reporte_<?php echo($reportes[$i]["idbusqueda_indicador"]);?>">
		<!--div class="menu_reporte" id="enlace_informe" componente="<?php echo($reportes[$i]["busqueda_idbusqueda_componente"]);?>"><h6 class="pull-right">Ver informe</h6></div-->
		<div class="encabezado_grafico" id='item_<?php echo($reportes[$i]["idbusqueda_indicador"]);?>'>
			<div class='alert-info' id='desc_reporte_<?php echo($reportes[$i]["idbusqueda_indicador"]);?>'>
				<h6 style="text-align: center;"><?php echo($reportes[$i]["etiqueta"]);?></h6>			
			</div>
			<div style='width:<?php echo($reportes[0]["ancho"]);?>px; height:<?php echo($reportes[0]["alto"]);?>px;'>
				<?php echo($reportes[$i]["descripcion"]);?>
			</div>	
		</div>	
	</div>
	<?php	
}
?>							
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
    $("#recargar_indicadores").attr("componente",'<?php echo($reporte_graficos[0]["busqueda_idbusqueda_componente"]);?>');
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
		}
		else{
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