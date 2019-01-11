<script>
$(".eliminar_remitente").live('click',function(){
	var id=$(this).attr("idregistro");
	var nombre=$(this).attr("nombre");
	$("#remitente_"+$(this).attr("idregistro")).remove();
	
	var guardados=$("#"+nombre).val().split(",");
	var cantidad=guardados.length;
	var seleccionados=new Array();
	var a=0;
	for(var i=0;i<cantidad;i++){
		if(guardados[i]!=id){
			seleccionados[a]=guardados[i];
			a++;
		}
	}
	$("#"+nombre).val(seleccionados.join(","));
});
</script>