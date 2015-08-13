<?php
function ocultar_radio_funcion($idformato,$iddoc){
	global $conn;
	$x=@$_REQUEST["x"];
	$y=@$_REQUEST["y"];
	$x2=@$_REQUEST["x2"];
	$y2=@$_REQUEST["y2"];
	$w=@$_REQUEST["w"];
	$h=@$_REQUEST["h"];
	$idft=@$_REQUEST["padre"];
	?>
	<script>
	$('input[name$="opcion_item"]').parent().parent().hide();
	$('input[name$="x"]').val("<?php echo($x);?>");
	$('input[name$="y"]').val("<?php echo($y);?>");
	$('input[name$="x2"]').val("<?php echo($x2);?>");
	$('input[name$="y2"]').val("<?php echo($y2);?>");
	$('input[name$="w"]').val("<?php echo($w);?>");
	$('input[name$="h"]').val("<?php echo($h);?>");
	$('input[name$="ft_orden_trabajo_vehiculo"]').val("<?php echo($idft);?>");
	</script>
	<?php
}
function redireccionar_papa($id){
	global $conn;
	$max_salida=6;
	$ruta_db_superior=$ruta="";
	while($max_salida>0){
  	if(is_file($ruta."db.php")){
    	$ruta_db_superior=$ruta;
  	}
  	$ruta.="../";
  	$max_salida--;
	}
	$nombre=busca_filtro_tabla("","formato a","a.nombre='orden_trabajo_vehiculo'","",$conn);
	$doc=busca_filtro_tabla("","ft_orden_trabajo_vehiculo a","a.idft_orden_trabajo_vehiculo=".@$_REQUEST["ft_orden_trabajo_vehiculo"],"",$conn);
	abrir_url($ruta_db_superior."formatos/orden_trabajo_vehiculo/mostrar_orden_trabajo_vehiculo.php?iddoc=".$doc[0]["documento_iddocumento"]."&idformato=".$nombre[0]["idformato"],"_parent");
}
?>