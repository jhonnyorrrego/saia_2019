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
include_once($ruta_db_superior."pantallas/graficos/librerias.php");
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
$graficos=busca_filtro_tabla("","busqueda_grafico A,busqueda_grafico_serie B","A.idbusqueda_grafico=B.busqueda_grafico_idbusqueda_grafico AND A.idbusqueda_grafico=".@$_REQUEST["idbusqueda_grafico"]." AND A.estado=1","",$conn);
$filtro=array();
foreach($_REQUEST AS $key=>$valor){
	array_push($filtro,$key."=".$valor);
}
?>
<link class="include" rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/jquery.jqplot.min.css" />
<style>
body{padding:0px;}
</style>
<div id="grafico_<?php echo($graficos[0]["idbusqueda_grafico"]);?>" style="height:<?php echo($graficos[0]['alto']-$resta_alto);?>px; width:<?php echo($graficos[0]["ancho"]-$resta_ancho);?>px;"></div>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.json2.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.barRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.pointLabels.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.canvasAxisLabelRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.highlighter.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.cursor.min.js"></script>
<script  type="text/javascript" >
$(document).ready(function(){
  $.ajax({      
    async: false,
    url: "<?php echo($ruta_db_superior)?>pantallas/graficos/datos_graficos_bar.php?<?php echo(implode("&", $filtro));?>",
    dataType:"json",
    success: function(data) {	       
			var plot3 = $.jqplot('grafico_<?php echo($graficos[0]["idbusqueda_grafico"]);?>', data.datos, {
				title: data.nombre_grafico,			
				seriesDefaults:{
					renderer:$.jqplot.BarRenderer,
          pointLabels: {show: true}
				},
				series: data.nombre_serie,
				 highlighter:{tooltipFadeSpeed:'slow', 
tooltipLocation:'n'} ,
				axes: {
				  xaxis: {				    
				    label: data.xaxis,				    
				    tickRenderer: $.jqplot.CanvasAxisTickRenderer,
				    tickOptions: {
				        angle: -90,
				        fontFamily: 'Verdana,Arial',
				        fontSize: '10pt'
				    },
				    renderer: $.jqplot.CategoryAxisRenderer    		    				     
				  },
				  yaxis:{
          	label:data.yaxis,  
          	labelRenderer: $.jqplot.CanvasAxisLabelRenderer
        	}
				},        
				legend: {
					show: true,
					placement: 'outside'
				}
			});      	
  	}
	});
});
</script>