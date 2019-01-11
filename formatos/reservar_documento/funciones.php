<?php
function ft_tabla_funcion($idformato,$iddoc){
	global $conn;
	?>
	<td id="td_doc_relacionado"><input type="text" name="doc_relacionado" id="doc_relacionado" value="<?php echo($_REQUEST["anterior"]); ?>"></td>
	<script>
	$("#td_doc_relacionado").parent().hide();
	</script>
	<?php
}
function enviar_mostrar_formato($idformato,$iddoc){
	global $conn;
	$max_salida=6; // Previene algun posible ciclo infinito limitando a 10 los ../
	$ruta_db_superior=$ruta="";
	while($max_salida>0){
		if(is_file($ruta."db.php")){
			$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
		}
		$ruta.="../";
		$max_salida--;
	}
	include_once($ruta_db_superior."librerias_saia.php");
	echo(librerias_notificaciones());
	$documento=busca_filtro_tabla("B.nombre_tabla,B.nombre,B.ruta_mostrar,B.idformato","documento A, formato B","A.iddocumento=".$_REQUEST["doc_relacionado"]." AND lower(A.plantilla)=lower(B.nombre)","",$conn);
	?>
	<script>
	notificacion_saia('Reserva realizada','success','',3500);
	</script>
	<?php
	abrir_url($ruta_db_superior."formatos/".$documento[0]["nombre"]."/".$documento[0]["ruta_mostrar"]."?iddoc=".$_REQUEST["doc_relacionado"]."&idformato=".$documento[0]["idformato"],"_self");
	die();
}
?>