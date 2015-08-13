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
echo(estilo_bootstrap());
echo(librerias_jquery("1.7"));
$graficos=busca_filtro_tabla("","busqueda_grafico A,busqueda_grafico_serie B","A.idbusqueda_grafico=B.busqueda_grafico_idbusqueda_grafico AND A.idbusqueda_grafico=".@$_REQUEST["idbusqueda_grafico"]." AND A.estado=1","",$conn);
?>
<link class="include" rel="stylesheet" type="text/css" href="<?php echo($ruta_db_superior);?>css/jquery.jqplot.min.css" />
<style>
body{padding:0px;}
</style>
<div id="chart2" style="height:300px; width:500px;"></div>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot.json2.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins//jqplot.barRenderer.min.js"></script>

<script  type="text/javascript" >
$(document).ready(function(){
    $.ajax({      
      async: false,
      url: "<?php echo($ruta_db_superior)?>pantallas/graficos/datos_graficos_bar_line.php?idbusqueda_grafico=<?php echo(1);?>",
      dataType:"json",
      success: function(data) {
  	var plot2 = $.jqplot('chart2', data.datos, {
   
   title:data.nombregrafico,
   seriesDefaults:{			
      pointLabels: {show: true}
		},
    series:[{renderer:$.jqplot.BarRenderer}, {xaxis:'x2axis', yaxis:'y2axis'}],
    axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer
      },
      x2axis: {
        renderer: $.jqplot.CategoryAxisRenderer
      },
      yaxis: {
      	label: data.xaxis,
        autoscale:true
      },
      y2axis: {
      	 label: data.yaxis,
        autoscale:true
      }
    },
    highlighter: {
      show: true,
      sizeAdjust: 7.5
    },
    legend: {
      show: true,
      placement: 'outsideGrid'
    }
  });
      }
    });

});
</script>