<?php
include_once('define_remoto.php');
require_once('lib/nusoap.php');
if($_REQUEST["ingreso"]==1 && $_REQUEST["info"]!="" && $_REQUEST["iddoc"]!=""){
	$cliente = new nusoap_client(SERVIDOR_REMOTO.'/email_aprobacion/servidor_remoto.php');
	$iddoc=$_REQUEST["iddoc"];
	$info=$_REQUEST["info"];
	$datos = json_encode($_REQUEST);
	$resultado_conexion = $cliente->call('validar_login_ingreso', array($datos));
	$resultado=json_decode($resultado_conexion);
	$datos_funcion=array();
	$datos_funcion['iddoc']=$resultado->iddoc;
	$datos_funcion['idformato']=$resultado->idformato;
	$datos_funcion['accion']=$resultado->accion;
	$ejecutar = $cliente->call('ejecuta_funciones', array(json_encode($datos_funcion)));
	$resultado2=json_decode($ejecutar);
}else{
	echo '<div class="alert alert-error"><strong>Error!</strong><br/><br/><br/><br/></div>';
	die();
}

?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html lang="es" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="es" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="es" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="es"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<title>Gestion comunicacion externa</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/style.css" />
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
</head>
<body>
	<div class="container-fluid">
	<br>
	<div class="encabezado">
		APROBACIONES - SAIA
	</div>
		<section id="content">
			<form>
				<!--img src="../imagenes/logo.jpg"></img--><br/><br/>
				<div>
					<?php
					if($resultado->exito==1){
						?>
						<div class="alert alert-success">
						  <strong>Exito!</strong><br/><br/> <span style="text-align:left;"><?php echo $resultado->msn;?></span><br/><br/>
						</div>
						<?php
						unset($datos);
					}else{
						if($resultado->msn==""){
							$resultado->msn="Ingrese Nuevamente desde el Link Enviado al Correo!";
						}
						?>
						<div class="alert alert-error">
						  <strong>Error</strong><br/><br/> <?php echo $resultado->msn; ?><br/><br/>
						</div>
						<?php
					}
					?>
				</div><br/><br/>
			</form>
		</section>
	<div class="pie">

  	<table style='border:none; font-size:11px;font-family:Roboto,Arial,Helvetica,sans-serif;color:#646464; vertical-align:middle;'>
		<tr>
			<td style="vertical-align:middle;">
				SAIA (Sistema de Administración Integral de Documentos y Procesos).
			</td>
			<td style='text-align:right;'>
				<img src='<?php echo(PROTOCOLO_CONEXION.RUTA_PDF_LOCAL); ?>/imagenes/saia_gray.png'>
			</td>
		</tr>
	</table>

	</div>
	</div>
</body>
</html>
