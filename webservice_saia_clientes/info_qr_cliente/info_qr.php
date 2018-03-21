<?php
include_once ('lib/nusoap.php');
include_once ('define.php');

$cliente = new nusoap_client(SERVIDOR_INFO_QR);
$retorno = $cliente -> call('generar_html_info_qr', array(json_encode($_REQUEST["key_cripto"])));
$array = json_decode($retorno, true);
$table = '';
$logo='';
if ($array["exito"]) {
	foreach ($array["info_tabla"] as $key => $value) {
		$table .= '<tr><th>' . str_replace("_", " ", $key) . '</th> <td>' . $value . '</td></tr>';
	}
	if ($array["logo"]) {
		$logo = "<img src='" . $array["logo"] . "' />";
	}
	if ($array["color_saia"]) {
		$bgcolor = $array["color_saia"];
	}
}else{
	$bgcolor="#3f91f2";
	$array["title"]="EL CONTENIDO NO EST&Aacute; DISPONIBLE";
	$table .= '<tr><td colspan="2">Es posible que el enlace del navegador haya caducado o que la p&aacute;gina solo pueda verla personal autorizado.</td></tr>';
}
?>

<!doctype html>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="css/bootstrap.min.css" >
		<style>
			span, p, div, table {
				color: #333333;
				font-size: 11px;
			}
			td, th {
				border: 1px solid #b6b8b7;
			}
		</style>
		<title>Informaci&oacute;n del QR</title>
	</head>
	<body>
		<div class="container">
			<?php echo $logo;?>
			<table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="1">
				<thead>
					<tr>
						<th colspan="2" style="background-color:<?php echo $bgcolor;?>;color: #fff;text-align: center"><?php echo $array["title"]; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php echo $table; ?>
				</tbody>
			</table>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>

