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
include_once($ruta_db_superior."formatos/librerias/funciones_formatos_generales.php");

function campos_peridontales($idformato,$iddoc){
	global $conn,$ruta_db_superior;
	
	$cajas_periodontales='

<p><b>Tejidos periodontales</b></p>
<p>Inflamacion &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recesiones &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sangrado &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Placa blanda &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;movilidad &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Placa calcificada<br /><br />Defecto osea vertical &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Compromiso de furca &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;OTROS&nbsp;</p>
<p>&nbsp;</p>

<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 2%;">&nbsp;</td>
<td style="width: 6%; text-align: center;">&nbsp;18</td>
<td style="width: 6%; text-align: center;">&nbsp;17</td>
<td style="width: 6%; text-align: center;">16</td>
<td style="width: 6%; text-align: center;">&nbsp;15</td>
<td style="width: 6%; text-align: center;">&nbsp;14</td>
<td style="width: 6%; text-align: center;">&nbsp;13</td>
<td style="width: 6%; text-align: center;">&nbsp;12</td>
<td style="width: 6%; text-align: center;">&nbsp;11</td>
<td style="width: 6%; text-align: center;">&nbsp;21</td>
<td style="width: 6%; text-align: center;">&nbsp;22</td>
<td style="width: 6%; text-align: center;">&nbsp;23</td>
<td style="width: 6%; text-align: center;">&nbsp;24</td>
<td style="width: 6%; text-align: center;">&nbsp;25</td>
<td style="width: 6%; text-align: center;">&nbsp;26</td>
<td style="width: 6%; text-align: center;">&nbsp;27</td>
<td style="width: 6%; text-align: center;">&nbsp;28</td>
<td style="width: 2%;">&nbsp;</td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 2%;">&nbsp;V</td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_uno" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_dos" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_tres" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_cuatro" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_cinco" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_seis" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_siete" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_ocho" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_nueve" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_diez" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_once" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_doce" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_trece" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_catorce" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_quince" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja_diezseis" style="width:100%; "></td>
<td style="width: 2%;">&nbsp;V</td>
</tr>
<tr>
<td style="width: 2%;">&nbsp;P</td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja17" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja18" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja19" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja20" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja21" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caj22" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja23" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja24" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja9" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja10" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja11" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja12" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja13" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja14" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja15" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja16" style="width:100%; "></td>
<td style="width: 2%;">&nbsp;P</td>
</tr>
</tbody>
</table>
<p>&nbsp;</p>
<table style="border-collapse: collapse; width: 100%;" border="1">
<tbody>
<tr>
<td style="width: 2%;">&nbsp;L</td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja1" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja2" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja3" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja4" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja5" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja6" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja7" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja8" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja9" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja10" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja11" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja12" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja13" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja14" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja15" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja16" style="width:100%; "></td>
<td style="width: 2%;">&nbsp;L</td>
</tr>
<tr>
<td style="width: 2%;">&nbsp;V</td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja1" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja2" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja3" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja4" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja5" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja6" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja7" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja8" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja9" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja10" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja11" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja12" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja13" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="caja" id="caja14" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="highslide" id="caja15" style="width:100%; "></td>
<td style="width: 6%;">&nbsp; <input type="text" class="highslide" id="caja16" style="width:100%; "></td>
<td style="width: 2%;">&nbsp;V</td>
</tr>
</tbody>
</table>
<table style="border-collapse: collapse; width: 100%;" border="0">
<tbody>
<tr>
<td style="width: 2%;">&nbsp;</td>
<td style="width: 6%; text-align: center;">&nbsp;48</td>
<td style="width: 6%; text-align: center;">&nbsp;47</td>
<td style="width: 6%; text-align: center;">&nbsp;46</td>
<td style="width: 6%; text-align: center;">&nbsp;45</td>
<td style="width: 6%; text-align: center;">&nbsp;44</td>
<td style="width: 6%; text-align: center;">&nbsp;43</td>
<td style="width: 6%; text-align: center;">&nbsp;42</td>
<td style="width: 6%; text-align: center;">&nbsp;41</td>
<td style="width: 6%; text-align: center;">&nbsp;31</td>
<td style="width: 6%; text-align: center;">&nbsp;32</td>
<td style="width: 6%; text-align: center;">&nbsp;33</td>
<td style="width: 6%; text-align: center;">&nbsp;34</td>
<td style="width: 6%; text-align: center;">&nbsp;35</td>
<td style="width: 6%; text-align: center;">&nbsp;36</td>
<td style="width: 6%; text-align: center;">&nbsp;37</td>
<td style="width: 6%; text-align: center;">&nbsp;38</td>
<td style="width: 2%;">&nbsp;</td>
</tr>
</tbody>
</table>
	';
	
	echo($cajas_periodontales);
	echo(librerias_highslide());
?>
 <script type='text/javascript'>   
   $(document).ready(function(){
   							   						
		$(".caja").click(function(){			
 			var doc="<?php echo($iddoc)?>"
			var ruta = "<?php echo($ruta_db_superior) ?>formatos/tejidos_periodontales/cajas_periodontales.php?caja="+$(this).attr("id")+"&documento="+doc;	
			var opacity = 0;
			var ancho = 250;
			var alto = 300;
			
			if($(this).attr("opacity")){
			opacity = $(this).attr("opacity");
			}
			
			if($(this).attr("ancho")){
			ancho = $(this).attr("ancho");
			}
			
			if($(this).attr("alto")){
			alto = $(this).attr("alto");
			}
			
			hs.graphicsDir = '<?php echo($ruta_db_superior); ?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
			   hs.outlineType = 'rounded-white';
					hs.htmlExpand( this, {
					src: ruta,	
					objectType: 'iframe',	
					outlineType: 'rounded-white', 
					wrapperClassName: 'highslide-wrapper drag-header',
					dimmingOpacity: opacity, 
					preserveContent: false,
					align: 'center',	
					width:  ancho,	
					height: alto	
					});  	
			});
   });

</script>
<?php
  
     //$slide='<a class="highslide" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',width: 500, height: 500,preserveContent:false} )" href="'.$ruta_db_superior.'">toque</a>';
     
   //echo $slide;

 }
			
function ocultar_cajas($idformato,$iddoc){
	
?>
<script type='text/javascript'>   
   $(document).ready(function(){
   	$("#caja_uno").parent().parent().hide();
   	$("#caja_dos").parent().parent().hide();
   	$("#caja_tres").parent().parent().hide();
   	$("#caja_cuatro").parent().parent().hide();
   	
   	  });
</script>

<?php
}
?>