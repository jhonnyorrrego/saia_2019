<?php
$max_salida=10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior=$ruta="";
while($max_salida>0){
	if(is_file($ruta."db.php")){
		$ruta_db_superior=$ruta; //Preserva la ruta superior encontrada
	}
	$ruta.="../";
	$max_salida--;
}
include_once($ruta_db_superior."db.php");
?>
<script> 
$(document).ready(function(){
	$(".open_highslide").live('click',function(){		
		var enlace=$(this).attr("enlace");
		var identificador=$(this).attr("identificador");
		top.hs.htmlExpand(this, { objectType: 'iframe',width: 730, height: 550,contentId:'cuerpo_paso', preserveContent:false, src:enlace,outlineType: 'rounded-white',wrapperClassName:'highslide-wrapper drag-header'});
		top.hs.Expander.prototype.onAfterClose = function() {
			$.ajax({
			url: "<?php echo($ruta_db_superior);?>pantallas/funcionario/fotografia/foto.php?idfuncionario="+identificador+"&ruta_recorte=1",
			dataType: 'json',
			async:false,
			type: "POST",
			success : function(data){
				if(data.ruta!='' && data.ruta!=null){
					$('#foto_funcionario_'+identificador).attr('src',data.ruta);
					$('#highslide_funcionario_'+identificador).attr('enlace','pantallas/funcionario/fotografia/foto.php?idfuncionario='+identificador+'&recortar=1');
				}else{
					$('#foto_funcionario_'+identificador).attr('src','<?php echo($ruta_db_superior); ?>imagenes/funcionario_sin_foto.jpg');
					$('#highslide_funcionario_'+identificador).attr('enlace','pantallas/funcionario/fotografia/foto.php?idfuncionario='+identificador);
				}
           	}
       		});
		} 
	});
});
</script>
<style>
    .well{
        padding:4px;
    }
</style>
