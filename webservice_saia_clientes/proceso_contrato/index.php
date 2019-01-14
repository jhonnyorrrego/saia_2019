<?php
session_start();
$_SESSION["idsession"] = session_id();
if (isset($_SESSION["temp_pdf_".$_SESSION["idsession"]]) && count($_SESSION["temp_pdf_".$_SESSION["idsession"]])) {
	foreach ($_SESSION["temp_pdf_".$_SESSION["idsession"]] as $url_pdf) {
		unlink($url_pdf);
		unset($_SESSION["temp_pdf_".$_SESSION["idsession"]]);
	}
}
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<title>CONTRATOS</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href="css/bootstrap_v3.1.min.css" rel="stylesheet">
		<style>
			.my-error-class {
				color: #FF0000;
			}
			.my-valid-class {
				color: #000000;
			}
			.error {
				color: red;
			}
			body {
				font-size: 8pt;
			}
		</style>
		<script src="js/jquery-1.11.1.min.js"></script>
		<script src="js/jquery.validate.1.12.0.js"></script>
	</head>
	<body>
		<div class="container">
			<center><img src="../imagenes_webservice/header.jpg">
			</center>
			<div id="loginbox">
				<div class="panel" style="width: auto; height: auto;">

					<div id="consulta_pqr">
						<form class="form-horizontal" name="formulario_consulta" id="formulario_consulta">
							<div>
								<div class="col-sm-2"></div>
								<p >
									Por favor escriba su documento de identificaci&oacute;n y el n&uacute;mero de radicado para buscar su solicitud:
								</p>
								<br/>
							</div>
							<div class="form-group">
								<label for="valor" class="col-sm-4 control-label">NUMERO DE RADICADO</label>
								<div class="col-sm-6">
									<input type="text" name="numero_radicado" id="numero_radicado" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-4 col-md-offset-3">
									<input class="btn btn-primary" style="font-size:8pt;" type="submit" class="form-control" value="Consultar">
								</div>
							</div>
						</form>
						<br/>
						<br/>
						<div id="respuesta_solicitud"></div>
					</div>
				</div>
			</div>
			<center><img src="../imagenes_webservice/footer.jpg">
			</center>
		</div>

		<script type="text/javascript">
			$(document).ready(function() {
		
				$("#formulario_consulta").validate({
					debug : true,
					rules : {
						numero_radicado : {
							required : true,
							digits : true
						}
					},
					messages : {
						numero_radicado : {
							required : "Campo obligatorio",
							digits : "Ingrese solo valores numericos"
						}
					},
					submitHandler : function(form) {
						var x_valor2 = $("#numero_radicado").val();
						$.ajax({
							url : "consultar_documentos.php",
							method : "post",
							dataType : 'html',
							data : {
								numero_radicado : x_valor2
							},
							success : function(html) {
								$("#respuesta_solicitud").html(html);
							}
						});
					}
				});
			});
		</script>
	</body>
</html>