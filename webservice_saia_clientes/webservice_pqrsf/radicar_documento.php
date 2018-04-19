<?php
session_start();
set_time_limit(0);
include_once ('define.php');
require_once ('lib/nusoap.php');

if ($_SESSION["verifica"] == 1) {
	$_SESSION["verifica"] = 2;
} elseif ($_SESSION["verifica"] == 2) {
	echo "<META HTTP-EQUIV='Refresh' CONTENT='0; url=index.php'>";
	die();
}

if ($_SESSION["verifica"] == 2) {
	$cliente = new nusoap_client(SERVIDOR_REMOTO);
	$error = $cliente -> getError();
	if ($error) {
		echo "<b>Error => </b>" . $error;
	}

	$array_anexos = array();
	foreach ($_FILES["anexo_digital"]["name"] as $key => $value) {
		if ($_FILES["anexo_digital"]["tmp_name"][$key]) {
			$tmpfile = $_FILES["anexo_digital"]["tmp_name"][$key];
			// temp filename
			$filename = $_FILES["anexo_digital"]["name"][$key];
			// Original filename
			$handle = fopen($tmpfile, "r");
			// Open the temp file
			$contents = fread($handle, filesize($tmpfile));
			// Read the temp file
			fclose($handle);
			// Close the temp file
			$decodeContent = base64_encode($contents);
			$array_anexos[$key] = array("filename" => $filename, "content" => $decodeContent);
		}
	}
	$_REQUEST["anexos"] = $array_anexos;

	$datos = json_encode($_REQUEST);
	unset($_REQUEST);
	unset($_POST);
	$resultado = $cliente -> call('radicar_documento_remoto', array($datos));
	$resultado = json_decode($resultado, true);

	$_SESSION["datos_documento"] = $resultado;
	$_SESSION["verifica"] = 3;

} elseif ($_SESSION["verifica"] == 3) {
	$resultado = $_SESSION["datos_documento"];
}
$logo='';
if ($resultado["exito"]) {
	if ($resultado["logo"]) {
		$logo = "<img src='" . $resultado["logo"] . "' />";
	}
	if ($resultado["color_saia"]) {
		$bgcolor = $resultado["color_saia"];
	}
	if($resultado["exito"]==1){
		$msn_correo=' De igual forma se ha enviado una copia en PDF al correo ingresado.';
	}else{
		$msn_correo='<br/><br/><strong>NOTA:</strong> No se pudo enviar el PDF al correo ingresado';
	}
	$table .= '<tr><td colspan="2" height="50%"><div style="text-align:right"><a href="index.php?rand='.rand(0, 10000).'">Volver</a></div>
	<strong>Radicado No: '.$resultado["numero"].'</strong><br/><br/>
	Su solicitud ha sido radicada.'.$msn_correo.'<br/><br/>';
	if($resultado["pdf"]!=""){
		$table .='<iframe width="100%" height="500px" src="data:application/pdf;base64,' . $resultado["pdf"] . '"></iframe>';
	}
	$table .='</td></tr>';
	
}else{
	$bgcolor="#3f91f2";
	$table .= '<tr><td colspan="2"><span style="color:red"><strong>Se ha presentado un error!</strong></span><br/><br/>'.$resultado["msn"].'.</td></tr>';
}
?>

<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link href="css/bootstrap_v3.1.min.css" rel="stylesheet">
		<style>
			span, p, div, table {
				color: #333333;
				font-size: 11px;
			}
			td, th {
				border: 1px solid #b6b8b7;
			}
		</style>
		<title>RADICACI&Oacute;N DE PETICIONES, QUEJAS, RECLAMOS Y SUGERENCIAS</title>
	</head>
	<body>
		<div class="container">
			<?php echo $logo; ?>
			<table class="table table-bordered" style="border-collapse: collapse; width: 100%;height:80%" border="1">
				<thead>
					<tr>
						<th colspan="2" style="background-color:<?php echo $bgcolor; ?>;color: #fff;text-align: center">RADICACI&Oacute;N DE PETICIONES, QUEJAS, RECLAMOS Y SUGERENCIAS</th>
					</tr>
				</thead>
				<tbody>
					<?php echo $table; ?>
				</tbody>
			</table>
		</div>
	</body>
</html>