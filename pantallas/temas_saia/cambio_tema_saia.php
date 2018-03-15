<?php
$max_salida = 10;
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
include_once($ruta_db_superior."db.php");
include_once($ruta_db_superior."librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_jquery());
echo(librerias_notificaciones());
?><center>
<div class="well well-large" style="width: 50%;margin-top: 20;text-align: center;">
<b>COLOR TEMA SAIA:</b> <select name='colores' id='colores'>
<option value='0'>Seleccione...</option>
<option value='gris'>Gris</option>
<option value='rojo'>Rojo</option>
<option value='azul'>Azul</option>
<option value='verde'>Verde</option>
</select><br/>
<input type="button" id="cambiar" value='Cambiar' class="btn btn-primary"/>
</div>
</center>
<script>
	$(document).ready(function(){
		$("#cambiar").click(function(){
			if($("#colores").val()!=0){
				$.ajax({
					type:'POST',
					url:"<?php echo $ruta_db_superior; ?>pantallas/temas_saia/tema_"+$("#colores").val()+"/cambia_color.php",
					data:{color:$("#colores").val()},
					success:function(respuesta){
						if(respuesta==1){
							top.noty({text:"Cambios realizados!!", type:"warning", layout:"topCenter", timeout:3500});
							window.parent.parent.location.reload();
						}else{
							top.noty({text:"Error al actualizar los valores", type:"warning", layout:"topCenter", timeout:3500});
							window.location.reload();
						}
					},error:function (){
						top.noty({text:"Error al procesar la solicitud", type:"error", layout:"topCenter", timeout:3500});
					}
				});
			}else{
				alert("Seleccione por favor");
			}
		});
	});
</script>