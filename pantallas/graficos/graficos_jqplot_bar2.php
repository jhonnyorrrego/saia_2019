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
<div id="chart2" style="height:500px; width:500px;"></div>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jquery.jqplot.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot.json2.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.dateAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.canvasTextRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.canvasAxisTickRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.categoryAxisRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo($ruta_db_superior);?>js/jqplot_plugins/jqplot.barRenderer.min.js"></script>
<script  type="text/javascript" >
$(document).ready(function(){
    $.ajax({      
      async: false,
      url: "<?php echo($ruta_db_superior)?>pantallas/graficos/datos_graficos_bar2.php?idbusqueda_grafico=<?php echo(2);?>",
      dataType:"json",
      success: function(data) {

var line1 = [['Cup Holder Pinion Bob', 7], ['Generic Fog Lamp', 9], ['HDTV Receiver', 15], 
  ['8 Track Control Module', 12], [' Sludge Pump Fourier Modulator', 3], 
  ['Transcender/Spice Rack', 6], ['Hair Spray Danger Indicator', 18]];
 
  
  var plot1b = $.jqplot('chart2', [line1], {
    title: 'Concern vs. Occurrance',
    seriesDefaults:{			
      pointLabels: {show: true}
		},
    series:[{renderer:$.jqplot.BarRenderer}],
    axesDefaults: {
        tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
        tickOptions: {
          fontFamily: 'Georgia',
          fontSize: '10pt',
          angle: -30
        }
    },
    highlighter: {
      show: true,
      sizeAdjust: 7.5
    },
    axes: {
      xaxis: {
        renderer: $.jqplot.CategoryAxisRenderer
      }
    }
  });
      }
    });
});
</script>