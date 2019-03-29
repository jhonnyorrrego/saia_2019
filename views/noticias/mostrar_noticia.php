<?php
$max_salida = 10;
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

echo(estilo_bootstrap());
$noticias = busca_filtro_tabla("titulo,subtitulo,imagen,noticia," . fecha_db_obtener("fecha", "Y-m-d") . " as fecha", "noticia_index", "estado=1 and idnoticia_index=" . $_REQUEST['idnoticia_index'], "", $conn);
?>
<!DOCTYPE html>
<html>
<body>
	<div class="container">
		<h4><?php echo($noticias[0]['titulo'] . ' - ' . $noticias[0]['fecha']); ?></h4>
		<table class="table table-striped">
			<thead>
				<tr>
					<th colspan="2"><?php echo($noticias[0]['subtitulo']); ?></th>
				</tr>
			</thead>
			<tbody>
    	
    <?php
		$cadena = '';
		for ($i = 0; $i < $noticias['numcampos']; $i++) {
			$archivo_binario = StorageUtils::get_binary_file($noticias[$i]['imagen']);
			$imagen = '<img src="' . $archivo_binario . '" height=200  width=200 align="left" class="img-rounded">';
			$cadena .= '
				<tr>
					<td style="text-align:justify;">' . $imagen . $noticias[$i]['noticia'] . '</td>
				</tr>			
			';
		}
		echo $cadena;
    ?>	
    </tbody>
		</table>
	</div>
</body>
</html>