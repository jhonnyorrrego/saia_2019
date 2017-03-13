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
include_once ("db.php");
include_once ("librerias_saia.php");
echo(estilo_bootstrap());
echo(librerias_jquery());
echo(librerias_notificaciones());

if(isset($_REQUEST['login']) && $_REQUEST['login']==''){

	?>
		<script>
			notificacion_saia('<b>ATENCI&Oacute;N!</b> <br> Debe ingresar el login!','error','',4000);
		</script>	
	
	<?php	
	
}


if($_REQUEST['login']){
	if(!$_SESSION["LOGIN".LLAVE_SAIA]){
		$_SESSION["LOGIN".LLAVE_SAIA]="cerok";
	}
	$busca_login=busca_filtro_tabla("funcionario_codigo,email,nombres,apellidos","funcionario","login='".$_REQUEST['login']."'","",$conn);
	if($busca_login['numcampos']){
		//$usuario_administrador=busca_filtro_tabla("a.valor","configuracion a","a.nombre ='correo_administrador'","",$conn);
		$usuario_administrador=busca_filtro_tabla("a.nombre,a.valor,b.nombres,b.apellidos,b.email","configuracion a,funcionario b","b.login=a.valor AND a.nombre ='login_administrador'","nombre",$conn);
		
		
		$contenido="
			<br>
			<br>
			<b>RECUPERACIÓN DE CONTRASEÑA</b><br><br><br>
			
			Cordial saludo,<br/><br/>".$_REQUEST['contenido']."<br/><br/>
			Funcionario: <b>".$busca_login[0]['nombres']." ".$busca_login[0]['apellidos']."</b><br/><br/> 
			Login: <b>".$_REQUEST['login']."</b><br/><br/> 
			Email:<b>".$busca_login[0]['email']."<b/><br/><br/><br/>
			Este email te ha sido enviado automáticamente desde SAIA (Sistema de Administración Integral de Documentos y Procesos).
			<br>
			<br>
			Por favor NO responda a este email.
			<br>
			<br>
			Para obtener soporte o realizar preguntas, envíe un correo electrónico a ".$usuario_administrador[0]['email']."
			<br>
			<br>
		";
		
		$envio_correo=enviar_mensaje("",'email',array($usuario_administrador[0]['email']),"SAIA - RESTABLECER CLAVE DE ACCESO ".$_REQUEST['login'],$contenido,"",0);
		if($envio_correo){
			?>
			<script>
				//noty({text: "Solicitud enviada con exito",type: 'success',layout: "topCenter",timeout:5000});
				notificacion_saia('<b>Solicitud enviada con &eacute;xito!</b> <br> el administrador se pondr&aacute; en contacto','success','',5000);
				window.parent.hs.close();
			</script>
<?php
			echo("<div class='alert-success'>Solicitud enviada con &eacute;xito!</div>");
		}else{
						
			?>
				<script>
					notificacion_saia('<b>Error al enviar la solicitud! </b> <br> por favor intente de nuevo','error','',5000);
					window.parent.hs.close();
				</script>				
			<?php		
				
			echo("<div class='alert alert-error'>Error al enviar la solicitud, por favor intente de nuevo</div>");
			
			
			
		}
		$_SESSION["LOGIN".LLAVE_SAIA]="";
	}else{
		$_SESSION["LOGIN".LLAVE_SAIA]="";
		
		?>
		<script>
			notificacion_saia('<b>ATENCI&Oacute;N!</b> <br> El login no existe!','error','',5000);
		</script>
		<?php
		
		redirecciona("recordar_contrasena.php");
	}
}else{

	
if(!$_SESSION["LOGIN".LLAVE_SAIA]){
	$_SESSION["LOGIN".LLAVE_SAIA]="cerok";
}

$usuario_administrador=busca_filtro_tabla("a.nombre,a.valor,b.nombres,b.apellidos","configuracion a,funcionario b","b.login=a.valor AND a.nombre ='login_administrador'","nombre",$conn);

$_SESSION["LOGIN".LLAVE_SAIA]="";
?>
<form class="form-horizontal" name="formulario_recordar_contrasena" id="formulario_recordar_contrasena" method="post" enctype="multipart/form-data" novalidate="novalidate">
	
	<div class="control-group element">
		<legend>
			¿No puedes acceder a tu cuenta?
		</legend>
		<br>
	</div>
	<div class="control-group element">
		<label class="control-label" for="login"><b>Escribe tu login *</b></label>
		<div class="controls">
			<input type="text" name="login" maxlength="255" class="elemento_formulario required" placeholder="login" idpantalla_campos="2" value="" id="login">
		</div>
	</div>
	<div class="control-group element">
		<label class="control-label" for="contenido"><b>Mensaje para el administrador *</b></label>
		<div class="controls">
			<textarea name="contenido" class="elemento_formulario required" placeholder="" idpantalla_campos="3" id="contenido">Por favor restablecer clave para ingreso al Sistema SAIA.</textarea>
</div>	</div>
	<div class="control-group element">
		El administrador actual del sistema es  <?php echo($usuario_administrador[0]['nombres']." ".$usuario_administrador[0]['apellidos']); ?>.
	</div>
	<div class="form-actions">
		<input type="submit" class="btn btn-primary btn-mini" id="submit_formulario_recordar_contrasena" value="Enviar">
		<!--div class="btn btn-mini" id="cancel_formulario_recordar_contrasena">Cancelar</div-->
		<div id="cargando_enviar" class="pull-right"></div>
	</div>
</form>
<?php
}
?>