<?php
$max_salida = 6;
// Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta;
		//Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior."db.php");
include_once ($ruta_db_superior."assets/librerias.php");
echo jquery();

if($_REQUEST['idbusqueda_componente']==340){
	
?>
<script type="text/javascript" src="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/highslide.css" />
<script type='text/javascript'>
  hs.graphicsDir = '<?php echo $ruta_db_superior;?>anexosdigitales/highslide-4.0.10/highslide/graphics/';
  hs.outlineType = 'rounded-white';
</script>
<script>
	$(document).ready(function(){
		$("#nav_busqueda").after("<div style='margin:5px' class='ui-state-default ui-jqgrid-pager ui-corner-bottom'> <button class='btn btn-mini' title='Numero facturas' id='pagar_facturas'>Registrar pago</button> </div>");
		$("#pagar_facturas").click(function (){
			var iddocs='';
			$(".iddoc_fact").each(function(){
				if($(this).is(':checked')===true){
					iddocs+=$(this).val()+",";
				}
			});
			
			iddocs = iddocs.substring(0, iddocs.length-1);
			if(iddocs!=''){
				hs.htmlExpand(null, { objectType: 'iframe',width: 300, height: 250, src:"http://nuevosaia.camarapereira.net/camara_pruebas/saia/formatos/radicacion_facturas/observaciones_check.php?iddocs="+iddocs,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header' });
			}else{
				alert('Debe seleccionar al menos un documento');
			}
			
		});
	});

</script>
<?php
}
?>