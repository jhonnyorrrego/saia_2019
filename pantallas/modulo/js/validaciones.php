<script>
$(".eliminar_modulo").live("click",function(){
	if(confirm('Esta seguro de eliminar el modulo?')){
		var modulo=$(this).attr("id");
		$.post("<?php echo $ruta_db_superior; ?>pantallas/modulo/modulodelete.php",{idmodulo:modulo},function(respuesta){
			window.location="<?php echo $ruta_db_superior; ?>pantallas/busquedas/consulta_busqueda.php?idbusqueda_componente=30";
		});
	}
});
</script>