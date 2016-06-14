<script type="text/javascript" src="../../js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="../../js/jquery-ui-1.8.2.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../css/ui-darkness/jquery-ui-1.8.6.custom.css"/>

Prueba
<input type="hidden" id="rango_colores" name="rango_colores" value="10,50"/>
                     <div id="slider_rango_colores"></div>
                     <script type="text/javascript">
	$(function(){	
	 valores=$("#rango_colores").val();
	 vector=valores.split(",");
		$("#slider_rango_colores").slider({
			range: true,
  		min: 0,
  		max: 100,
  		values: [vector[0],vector[1]],
  		slide: function(event, ui) {
  			$("#etiqueta_rango_colores").html(ui.values[0] + " - " + ui.values[1]);
  			$("#rango_colores").val(ui.values[0] + "," + ui.values[1]);
  		}
		});
	$("#etiqueta_rango_colores").html($("#slider_rango_colores").slider("values", 0) + " - " + $("#slider_rango_colores").slider("values", 1));	
	$("#rango_colores").val($("#slider_rango_colores").slider("values", 0)+ "," +$("#slider_rango_colores").slider("values", 1));
	});
</script>	

