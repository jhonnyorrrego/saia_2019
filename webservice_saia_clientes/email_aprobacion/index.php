<?php
session_start();
$_SESSION["varifica"]=1;
include_once ('lib/nusoap.php');
include_once ('define.php');

$cliente = new nusoap_client(SERVIDOR_REMOTO);
$retorno = $cliente -> call('color_logo_empresa', array());
$array = json_decode($retorno, true);
$ok = 1;
$logo = '';
$pie = '';
if ($array["exito"]) {
	if ($array["logo"]) {
		$logo = "<img src='" . $array["logo"] . "' />";
	}
	if ($array["pie"]) {
		$pie = "<img src='" . $array["pie"] . "' />";
	}
	if ($array["color_saia"]) {
		$bgcolor = $array["color_saia"];
	}
	$encabezado = "APROBACIONES - SAIA";
} else {
	$ok = 0;
	$bgcolor = "#3f91f2";
	$encabezado = "EL CONTENIDO NO EST&Aacute; DISPONIBLE";
}

$usuario = "";
$iddoc = "";
if (@$_REQUEST['info'] != "") {
	$datos = base64_decode($_REQUEST['info']);
	$info = explode(",", $datos);
	foreach ($info as $data) {
		$parametros = explode("-", $data);
		$_REQUEST[$parametros[0]] = $parametros[1];
	}
	$usuario = $_REQUEST['usuario'];
	$info = $_REQUEST['info'];
	$iddoc = $_REQUEST['iddoc'];
}

if ($usuario != "" && $iddoc) {
	if (!is_numeric($iddoc)) {
		$ok = 0;
	}
}else{
	$ok = 0;
}
$_SESSION["logo"] = $logo;
$_SESSION["pie"] = $pie;
$_SESSION["color_saia"] = $bgcolor;
$_SESSION["encabezado"] = $encabezado;

?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>APROBACI&Oacute;N DE DOCUMENTOS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<style>
			.error-class {
				color: #FF0000; /* red */
			}
		</style>
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/jquery.validate.1.12.0.js"></script>
	</head>
	<body>

		<div class="container-fluid"><br/>
			<div class="encabezado" style="background-color:<?php echo $bgcolor; ?>">
				<?php echo $encabezado; ?>
			</div>
			<section id="content">
				<?php
				echo $logo;
				if($ok){
					?>
				<form id="formulario" id="formulario" method="POST" action="validar_ingreso.php">
					<div>
						<input type="hidden" id="login_aprob" id="login_aprob" value="<?php echo $usuario; ?>"/>
						<input type="text" placeholder="Login"  id="login" name="login" />
					</div>
					<div>
						<input type="password" placeholder="Password" id="password" name="password" />
					</div>
					<div>
						<input type="hidden" id="iddoc" name="iddoc"  value="<?php echo $iddoc; ?>"/>
						<input type="hidden" id="ingreso" name="ingreso" value="1"/>
						<input type="radio" name='accion' value='1' checked="true">
						Aprobar
						<input type="radio" name='accion' value='2'>
						Devolucion
						<br/>
						<br/>
						<div id='div_notas'>
							OBSERVACIONES DE LA DEVOLUCIÓN
							<textarea name='notas' id='notas' rows="4" cols="30"></textarea>
						</div>
						<input type="submit" value="Enviar" />
					</div>
				</form>
					<?php
					}else{
					?>
						<br/>Es posible que el enlace haya caducado o que la p&aacute;gina solo pueda verla personal autorizado.<br/><br/>
					<?php
					}
				?>
			</section>
			<div class="pie">
				<table style='border:none; font-size:11px;color:#646464; vertical-align:middle;'>
					<tr>
						<td style="vertical-align:middle;"> SAIA (Sistema de Administración Integral de Documentos y Procesos). </td>
						<td style='text-align:right;'><?php echo $pie; ?></td>
					</tr>
				</table>
			</div>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#div_notas').hide();
				$("input[name='accion']").click(function() {
					var valor = $(this).val();
					if (valor == 2) {
						$('#div_notas').show();
					} else {
						$('#div_notas').hide();
						$('#notas').val("");
					}
				});
				$("#formulario").validate({
					debug : true,
					errorClass : "error-class",
					rules : {
						login : {
							required : true,
							equalTo : "#login_aprob"
						},
						password : {
							required : true
						}
					},
					messages : {
						login : {
							equalTo : "El login no corresponde"
						}
					},
					submitHandler : function(form) {
						form.submit();
					}
				});
			});
		</script>
	</body>
</html>