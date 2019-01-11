<?php
include_once ('lib/nusoap.php');
include_once ('define.php');

$cliente = new nusoap_client(SERVIDOR_INFO_QR_EXP);
$retorno = $cliente -> call('cargar_datos_qr_exp_caja', array(json_encode($_REQUEST["key_cripto"])));
$array = json_decode($retorno, true);
$table = '';
$table2 = '';
$logo = '';
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
	if($array["exito_indice"]){
		$table2='<table class="table table-bordered" style="border-collapse: collapse; width: 100%;" border="1">';
		$datos_indice=$array["info_tabla_indice"];
		$table2.='<tr style="background-color:'.$bgcolor.';color: #fff;text-align: center"><th>N&uacute;mero Radicado</th> <th>Fecha</th> <th>Serie</th> <th>Descripci&oacute;n</th></tr>';
		for ($i=0; $i <$array["exito_indice"] ; $i++) { 
			$table2.='<tr>';
				$table2.='<td>'.$datos_indice[$i]["numero"].'</td>';
				$table2.='<td>'.$datos_indice[$i]["fecha"].'</td>';
				$table2.='<td>'.$datos_indice[$i]["serie"].'</td>';
				$table2.='<td>'.$datos_indice[$i]["descripcion"].'</td>';
			$table2.='</tr>';
		}
		$table2.='</table>';
	}

	
} else {
	$bgcolor = "#3f91f2";
	$array["title"] = "EL CONTENIDO NO EST&Aacute; DISPONIBLE";
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
			<?php echo $table2;?>
		</div>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>

