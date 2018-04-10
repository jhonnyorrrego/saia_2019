<?php
session_start();
include_once ('lib/nusoap.php');
include_once ('define.php');
$_SESSION["verifica"] =1;

$ok = 0;
if ($_SESSION["verifica"] == 1 && $_REQUEST["ingreso"] == 1) {
	$_SESSION["varifica"] = 2;
	$cliente = new nusoap_client(SERVIDOR_REMOTO);
	$retorno = $cliente -> call('aprobar_devolver_documento', array(json_encode($_REQUEST)));
	$array = json_decode($retorno, true);
	if($array["exito"]){
		$ok=1;
	}
	$mensaje = $array["msn"];
} else {
	$mensaje = "Por favor ingrese desde el link enviado al correo.";
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>APROBACI&Oacute;N DE DOCUMENTOS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
	</head>
	<body>

		<div class="container-fluid"><br/>
			<div class="encabezado" style="background-color:<?php echo $_SESSION["color_saia"]; ?>">
				<?php echo $_SESSION["encabezado"]; ?>
			</div>
			<section id="content">
				<?php	echo $_SESSION["logo"];
				if($ok){
					?>
				  <br/><span style="color: green;font-weight: bold;">Exito!!</span><br/><br/>
				  <?php echo $mensaje; ?><br/><br/>
					<?php
					}else{
					?>
					<br/><span style="color: red;font-weight: bold;">Error!!</span><br/><br/>
					<?php echo $mensaje; ?><br/><br/>
					<?php
					}
				?>
			</section>
			<div class="pie">
				<table style='border:none; font-size:11px;color:#646464; vertical-align:middle;'>
					<tr>
						<td style="vertical-align:middle;"> SAIA (Sistema de Administraci&oacute;n Integral de Documentos y Procesos). </td>
						<td style='text-align:right;'><?php echo $_SESSION["pie"]; ?></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>