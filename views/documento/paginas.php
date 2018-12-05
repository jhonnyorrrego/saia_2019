<?php
$max_salida = 6;
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta;
    }
    $ruta .= "../";
    $max_salida--;
}

if (!isset($_REQUEST["iddoc"])) {
    return false;
}

include_once $ruta_db_superior . 'db.php';
include_once $ruta_db_superior . "pantallas/documento/menu_principal_documento.php";
include_once $ruta_db_superior . 'models/pagina.php';
$iddocumento = $_REQUEST["iddoc"];
$paginas = Pagina::getAllResultDocument($iddocumento);
?>
<!DOCTYPE >
<html>
	<head>
		<link href="<?=$ruta_db_superior; ?>assets/theme/assets/plugins/owl-carousel/assets/owl.carousel.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="<?=$ruta_db_superior; ?>assets/theme/assets/plugins/owl-carousel/assets/owl.theme.default.min.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
    <div class="container-fluid bg-master-lightest px-4">
        <div class="row sticky-top pt-2 bg-master-lightest px-3">
				<?= menu_principal_documento($iddocumento) ?>
			</div>
			<hr/>
			<div class="row">
				<div class="col-12 owl-carousel text-center">
					<?php for($i=0;$i<$paginas["numcampos"];$i++):?>
                        <div data-image="<?=$paginas["img_small"][$i]["url"]; ?>" data-src="<?=$paginas["img_big"][$i]["url"]; ?>"></div>
                    <?php endfor; ?>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-12">
					<img id="img-pagina" class="w-100" src="<?=$paginas["img_big"][0]["url"]; ?>"/>
				</div>
			</div>

		</div>
		<script src="<?= $ruta_db_superior; ?>assets/theme/assets/plugins/owl-carousel/owl.carousel.min.js" type="text/javascript"></script>
		<script>
			$(document).ready(function() {
				$('.owl-carousel > div').each(function() {
					var img = $(this).data('image');
					$(this).css({
						'background-image' : 'url(' + img + ')',
						'width' : '90px',
						'height' : '116px'
					});

					$(this).on('click', function(event) {
						var img2 = $(this).data('src');
						$("#img-pagina").attr("src", img2);
					});
				});

				var owl = $('.owl-carousel');
				owl.owlCarousel({
					nav : true,
					smartSpeed : 100,
					responsive : {
						0 : {
							items : 3
						},
						480 : {
							items : 6
						}
					},
					navText : ['<span class="btn"><i class="fa fa-chevron-left"></i></span>', '<span class="btn"><i class="fa fa-chevron-right"></i></span>'],
				});

			});
		</script>
	</body>
</html>