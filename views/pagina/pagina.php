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

include_once $ruta_db_superior . "controllers/autoload.php";
include_once $ruta_db_superior . "views/documento/encabezado.php";

$iddocumento = $_REQUEST["iddoc"];
$paginas = Pagina::getAllResultDocument($iddocumento, "pagina asc");
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
				<?=plantilla($iddocumento); ?>
			</div>
			<div class="row">
				<div class="col-12">
				    <?php if(UtilitiesController::permisoModulo("editar_paginas")):?>
					<a href="listar_pagina.php?iddoc=<?=$iddocumento; ?>" class="btn btn-mini float-right"><i class="fa fa-edit"></i></a>
					<?php endif; ?>
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-12 owl-carousel text-center">
					<?php
                    for ($i = 0; $i < $paginas["numcampos"]; $i++): 
                        $fileMin = $paginas["data"][$i] -> getUrlImagenTemp();
                        $fileMax = $paginas["data"][$i] -> getUrlRutaTemp();
                        if ($fileMin !== false && $fileMax !== false):?>
                            <div data-image="<?=$fileMin; ?>" data-src="<?=$fileMax; ?>" data-toggle="tooltip" data-placement="bottom" title="P&aacute;gina No <?=$paginas["data"][$i] -> getPagina(); ?>"></div>
                        <?php
                        endif;
                        endfor;
					?>                 
				</div>
			</div>
			<hr/>
			<div class="row">
				<div class="col-12">
				    <?php if($paginas["numcampos"]):?>
				    <span id="num_pagina" class="float-right">P&aacute;gina No <?=$paginas["data"][0] -> getPagina(); ?></span>
					<img id="img-pagina" class="w-100" src="<?=$paginas["data"][0] -> getUrlRutaTemp(); ?>"/>
					<?php endif; ?>
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

						var title = $(this).attr('title');
						$("#num_pagina").empty().text(title);
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