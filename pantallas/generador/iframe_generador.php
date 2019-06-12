<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
	if (is_file($ruta . "db.php")) {
		$ruta_db_superior = $ruta; //Preserva la ruta superior encontrada
	}
	$ruta .= "../";
	$max_salida--;
}

include_once $ruta_db_superior . 'core/autoload.php';
include_once $ruta_db_superior . "librerias_saia.php";
include_once $ruta_db_superior . "pantallas/generador/librerias_pantalla.php";
include_once $ruta_db_superior . "assets/librerias.php";
include_once $ruta_db_superior . "pantallas/lib/librerias_componentes.php";

if ($_REQUEST["idformato"]) {
	$idpantalla = $_REQUEST["idformato"];
	$datos_formato = busca_filtro_tabla("", "formato", "idformato=" . $idpantalla, "", $conn);
	$route = $ruta_db_superior . "pantallas/formato/listado_formatos.php?";
	$route.= http_build_query([
		"no_kaiten" => 1,
		"id" => $idpantalla,
		"cargar_seleccionado" => 1,
		"tabla" => "formato"
	]);
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Generador Pantallas SAIA</title>
<style>

</style>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=10.0, shrink-to-fit=no" />    
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta content="" name="description" />
    <meta content="" name="author" />  
    <?= jquery() ?>
    <?= bootstrap() ?>
    <?= jqueryUi() ?>
    <?= icons() ?>
    <?= theme() ?>
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-scrollbar/jquery.scrollbar.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/switchery/css/switchery.min.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-imgareaselect/css/imgareaselect-default.css" rel="stylesheet" type="text/css" media="screen" />
    <link class="main-stylesheet" href="<?= $ruta_db_superior ?>assets/theme/pages/css/pages.css" rel="stylesheet" type="text/css" />
	<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/modernizr.custom.js" type="text/javascript"></script>
<?php
?>
</head>
	<body>
		<div class="container-fluid px-0" >
			<div class="row mx-0">					
				<div class="col-3 m-0 p-0 px-0" id="panel_izquierdo" style="">    
						<div id="arbol_formato">
						<?php if ($idpantalla) : ?>
							<iframe src="<?= $route ?>" width="100%" frameborder="0"></iframe>
						<?php endif; ?>
						</div>	
				</div>			
				<div class="col mx-0 p-0" id="admin_generador">
					<iframe frameborder="0" id="iframe_generador" width="100%" src="<?php echo $ruta_db_superior . "pantallas/generador/generador_pantalla.php?idformato=" . $idpantalla; ?>" scrolling="no"></iframe> 
				</div>
			</div>
		</div>
		<script> 
		$(document).ready(function(){
		
			$("iframe").height($(window).height()-10);
				
		}); 
		</script>
	</body>
</html>
