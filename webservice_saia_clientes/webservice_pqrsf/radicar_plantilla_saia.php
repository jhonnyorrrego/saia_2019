<?php
@session_start();
@set_time_limit(0);
include_once('define_remoto.php');
require_once('lib/nusoap.php');
if($_SESSION["verifica"] == 1){
	$_SESSION["verifica"] = 2;
}elseif($_SESSION["verifica"] == 2){
	//echo "<META HTTP-EQUIV='Refresh' CONTENT='0; url=index.php'>";  
}

if($_SESSION["verifica"] == 2){
	$cliente = new nusoap_client(SERVIDOR_REMOTO.'/servidor_remoto_radicacion_pqr.php');
	$error = $cliente->getError();
	if($error){
		echo "<b>Error => </b>".$error;
	}
	
	$array_anexos = array();
	foreach ($_FILES["anexo_digital"]["name"] as $key => $value) {
		if($_FILES["anexo_digital"]["tmp_name"][$key]){
			$tmpfile  = $_FILES["anexo_digital"]["tmp_name"][$key];   // temp filename		
			$filename = $_FILES["anexo_digital"]["name"][$key];      // Original filename
			$handle   = fopen($tmpfile, "r");                  // Open the temp file
			$contents = fread($handle, filesize($tmpfile));  // Read the temp file
	  	fclose($handle);                                 // Close the temp file
	  	$decodeContent = base64_encode($contents);
			$array_anexos[$key] = array(
			 "filename"  => $filename,
			 "content"   => $decodeContent,
			 "extencion" => $_FILES["anexo_digital"]["type"][$key]
		 );					
		} 	
	}
	$_REQUEST["anexos"] = $array_anexos;

	$datos = json_encode($_REQUEST);
	unset($_REQUEST);	unset($_POST);
	$resultado = $cliente->call('radicar_documento_remoto', array($datos));
	$_SESSION["datos_documento"] = $resultado;
	$resultado = json_decode($resultado,true);
	
	$_SESSION["verifica"] = 3;
}elseif($_SESSION["verifica"] == 3){	
	$resultado = json_decode($_SESSION["datos_documento"],true);
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>RADICACI&Oacute;N DE PETICIONES, QUEJAS, RECLAMOS Y SUGERENCIAS</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Le styles -->
	<link href="css/bootstrap.css" rel="stylesheet">
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>
<body>
	<div class="container">
		<!--img src="img/encabezado.jpg" style="height:120px !important;"-->
		<div class="hero-unit">			
			<p>
				<?php 
					if($resultado['numero']){
						$texto='
										<style>body,td{ font-family:verdana; font-size:10px;}</style>
	    								<div class="alert alert-success">
	    								<table style="width:580px;" align="center" border="0" cellspacing="0" cellpadding="0">
												<tr>
													<td valign="top"><b>Radicado No.'.$resultado['numero'].'</b><br /><br /></td>
												</tr>
												<tr>
													<td valign="top">																			
														Su solicitud ha sido radicada el día '.date("d").' mes '.date("m").' de '.date("Y").' con el número de radicado '.$resultado['numero'].'. De igual forma se ha enviado una Copia al correo ingresado. 
													</td>
												</tr>
												<tr>
													<td ><iframe style="width:580px;height:400px" frameborder="0" src="'.$resultado['pdf'].'"></iframe></td>
												</tr>
											</table></div>';
					}else{
						$texto = '
											<div class="alert alert-error">
  											<button type="button" class="close" data-dismiss="alert">&times;</button>
  											<h4>Existe un Problema</h4>
  											No se ha podido completar su solicitud.<br /> Por favor intente de nuevo o informenos a <a href="mailto:#" target="_blank">nuestro corrreo electronico</a><br/><br/>
  											Error: '.$resultado['msn'].'
											</div>
										 ';
					} 

					echo($texto);
					
					$resultado = $cliente->call('enviar_correo_solicitante', array(json_encode($resultado)));
				?>
			</p>			
		</div>
	</div>
	<script src="js/jquery-1.7.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/jasny-bootstrap.min.js"></script>
	<script src="js/jquery.validate.1.12.0.js"></script>
</body>
</html>