<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ( $max_salida > 0 ) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida --;
}
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_jquery());
?>
<div style="width:20%;text-align:left;" id="acceder" class='well well-large'>
Login:
<input type="text" name="login" id="login"><br/>
Token:
<input type="text" name="token" id="token"><br/>
<button type="button" class="btn btn-primary btn-mini" id="solicita">
	Solicitar Token
</button>
<button type="button" class="btn btn-primary btn-mini" id="ingresar">
	Ingresar
</button>
</div>
<div id="respuesta" style="width:20%;text-align:left;"></div>
<script>
$("#solicita").click(function(){
	$.ajax({
		type:'POST',
		url: "token_backdoor.php",
		data: {login:$("#login").val()},
		success: function(respuesta){
			if(respuesta==1){
				$("#respuesta").html("Token generado correctamente.");
				$("#respuesta").removeClass("alert alert-error");
				$("#respuesta").addClass("alert alert-success");
				$("#respuesta").show();
				$("#token").val("");
				setTimeout(function(){
					$("#respuesta").fadeOut(1500);
				}, 4500);
			}else if(respuesta==2){
				$("#respuesta").html("Usuario no existe o esta inactivo.");
				$("#respuesta").removeClass("alert alert-success");
				$("#respuesta").addClass("alert alert-error");
				$("#respuesta").show();
				setTimeout(function(){
					$("#respuesta").fadeOut(1500);
				}, 4500);
			}else{
				$("#respuesta").html("Error generando Token");
				$("#respuesta").removeClass("alert alert-success");
				$("#respuesta").addClass("alert alert-error");
				$("#respuesta").show();
				setTimeout(function(){
					$("#respuesta").fadeOut(1500);
				}, 4500);
			}
		}
	});
});
$("#ingresar").click(function(){
	$.ajax({
		type:'POST',
		dataType: "json",
		url: "token_backdoor.php",
		data: {token:$("#token").val()},
		success: function(respuesta){
			if(respuesta.login){
				window.location='<?php echo $ruta_db_superior; ?>index_actualizacion.php?token='+btoa(respuesta.login);
				return false;
			}else{
				$("#respuesta").html("Error Token:"+respuesta.error);
				$("#respuesta").removeClass("alert alert-success");
				$("#respuesta").addClass("alert alert-error");
				$("#respuesta").show();
				setTimeout(function(){
					$("#respuesta").fadeOut(1500);
				}, 4500);
				return false;
			}
		}
	});
});
</script>