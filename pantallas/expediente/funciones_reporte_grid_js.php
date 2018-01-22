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
include_once($ruta_db_superior."librerias_saia.php");
echo(librerias_jquery("1.7"));
?>
<script type="text/javascript">
$(document).ready(function(){
	$(document).on('change', '.seleccionar', function(e) {
		var checkedVals = $('.seleccionar:checkbox:checked').map(function() {
		    return this.value;
		}).get();
		$("#seleccionados_expediente").val(checkedVals.join(","));
	});
	$(document).on("click","#transferencia_documental",function(){
		var seleccionados=$("#seleccionados_expediente").val();
		$.ajax({
			type : "GET",
			url : "../expediente/validar_cierre_expedientes.php",
			data : {
				idexpedientes : seleccionados
			},
			success : function (response){
				response = JSON.parse(response);
				if(response.tipo == 1){
					if(seleccionados){
						enlace_katien_saia("formatos/transferencia_doc/adicionar_transferencia_doc.php?id="+seleccionados,"Transferencia documental","iframe","");
					}
					else{
						alert("Seleccione por lo menos un expediente");
					}
				}else{
					alert("Expedientes abiertos : " + response.msn);
				}
			},
			error : function (err){
				console.log("error");
			}
		});
			
	});
	$(document).on("click","#prestamo_documento",function(){
		var seleccionados=$("#seleccionados_expediente").val();
		var estado_archivo=1;
		if(seleccionados){
			enlace_katien_saia("formatos/solicitud_prestamo/adicionar_solicitud_prestamo.php?id="+seleccionados+"&estado_archivo="+estado_archivo,"Solicitud de prestamo","iframe","");
		}else{
			alert("Seleccione por lo menos un expediente");
		}
	});
});
</script>