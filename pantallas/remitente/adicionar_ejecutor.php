<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) { $ruta_db_superior = $ruta;
	} $ruta .= "../";
	$max_salida--;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_bootstrap());
echo(librerias_notificaciones());
echo (librerias_jquery("1.7"));
include_once($ruta_db_superior."pantallas/lib/librerias_cripto.php");

?>
<form name="formulario_datos_ejecutor" id="formulario_datos_ejecutor" method="post">
	<table class="table table-bordered" style="width:70%;margin: 20px;margin-left: auto;margin-right: auto;">
		<tr>
			<td style="width:30%;" class="prettyprint"><b>Tipo</b></td>
			<td style="width:40%;">
				Persona natural <input type="radio" name="tipo_ejecutor" id="tipo_ejecutor1" value="1" checked/> 
				Persona Jur&iacute;dica <input type="radio" name="tipo_ejecutor" id="tipo_ejecutor2" value="2" /> 
			</td>
		</tr>		
		<tr>
			<td style="width:30%;" class="prettyprint" id="etiqueta_nombre"><b>Nombres y apellidos</b></td>
			<td style="width:40%;">
			<input type="text" name="nombre" id="nombre">
			</td>
		</tr>
		<tr>
			<td class="prettyprint"><b>Identificacion</b></td>
			<td>
			<input type="text" name="identificacion" id="identificacion"> <span id="msn_identificacion"></span>
			</td>
		</tr>
		<tr>
			<input type="hidden" name="ejecutar_remitente" value="insert_remitente"/>
			<input type="hidden" name="tipo_retorno" value="1"/>
			<td colspan="2" style="text-align: center">
			<button class="btn btn-primary btn-mini" id="submit_formulario_ejecutor">
				Guardar
			</button>
			</td>
		</tr>
	</table>
</form>
<div id="tabla_identificacion"></div>
<div id="tabla_nombre"></div>


<script>
	$(document).ready(function() {
		
		$('[name="tipo_ejecutor"]').click(function(){
			var valor=parseInt($(this).val());
			var etiqueta='<b>Nombres y apellidos</b>';
			if(valor==2){
				etiqueta='<b>Entidad</b>';
			}
			$('#etiqueta_nombre').html(etiqueta);
		});	
		
	  $("#identificacion").keyup(function (){
	    this.value = (this.value + '').replace(/[^0-9]/g, '');
	  });
	  
	  $("#nombre,#identificacion").blur(function (){
	  	var valor_campo=$(this).val();
		  var nombre_campo=$(this).attr("id");
	  	if(valor_campo!=""){
	  		if(nombre_campo=="identificacion"){
	  			$("#msn_identificacion").empty();
	  		}
	  		$.ajax({
					type : 'POST',
					async : false,
					dataType: 'json',
					url: "<?php echo($ruta_db_superior); ?>pantallas/remitente/solicitud_ciudad.php",
					data : {tipo:3,campo:nombre_campo,valor:valor_campo},
					success : function(retorno) {
						if (retorno.exito) {
							if(retorno.existe){
								$("#identificacion").val("");
								$("#msn_identificacion").empty().html('<font color="red">La identificaci&oacute;n Existe</font>');
							}
							$("#tabla_"+nombre_campo).empty().html(retorno.html);
						}else{
							$("#tabla_"+nombre_campo).empty();
						}
					}
				});
	  	}else{
	  		$("#tabla_"+nombre_campo).empty();
	  	}
	  });

		$("#submit_formulario_ejecutor").click(function() {
	  	var nombre=$("#nombre").val();
	  	var identificacion=$("#identificacion").val();
			if(nombre.trim()!="" && identificacion.trim()!="" && identificacion!=0){
				if(confirm("Esta Seguro de Guardar?")){
					<?php encriptar_sqli("formulario_datos_ejecutor",0,"form_info",$ruta_db_superior); ?>
					$.ajax({
						type : 'POST',
						async : false,
						dataType: 'json',
						url: "<?php echo($ruta_db_superior); ?>pantallas/remitente/ejecutar_acciones.php",
						data : "rand=" + Math.round(Math.random() * 100000) + "&" + $("#formulario_datos_ejecutor").serialize(),
						success : function(objeto) {
							if (objeto.exito) {
								notificacion_saia(objeto.mensaje, "success", "", 2500);
								window.open('mostrar_datos_ejecutor.php?idejecutor='+objeto.idejecutor,'_self');
							}
						}
					});
				}
			}else{
				notificacion_saia('<span style="color:#000">Los campos son obligatorios</span>',"error", "", 2500);
			}
			return false;
		});
	}); 
</script>