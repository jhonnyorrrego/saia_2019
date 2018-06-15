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
include_once ($ruta_db_superior . "db.php");
include_once ($ruta_db_superior . "librerias_saia.php");
echo(librerias_jquery("1.8"));
echo(estilo_bootstrap());
echo(librerias_bootstrap());
?>
<script>
	$(document).ready(function($) {
		console.log("1")
		$("li button").click(function(e) {
			console.log("2");
			$(this).next('ul.dropdown-menu').css("display", "block");
			e.stopPropagation();
		});
	}); 
</script>
<div class="navbar">
	<div class="navbar-inner">
		<ul class="nav">
			<li>
				<div class="btn-group">
					<button type="button" class="btn btn-mini" data-toggle="dropdown">
						click aqui
					</button>
					<ul class="dropdown-menu">
						<li>
							aparece esto
						</li>
					</ul>
				</div>
			</li>
		</ul>
	</div>
</div>
