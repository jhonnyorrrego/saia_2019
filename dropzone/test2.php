<?php
$max_salida = 10; // Previene algun posible ciclo infinito limitando a 10 los ../
$ruta_db_superior = $ruta = "";
while ($max_salida > 0) {
    if (is_file($ruta . "db.php")) {
        $ruta_db_superior = $ruta; // Preserva la ruta superior encontrada
    }
    $ruta .= "../";
    $max_salida--;
}
?>

<!DOCTYPE HTML>

<html lang="es">
<head>

<link href="dist/dropzone.css" type="text/css" rel="stylesheet" />
<link href="bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" />

<script src="dist/dropzone.js"></script>

</head>
<body>
	<form id="formulario_formatos" action="../pantallas/whatever.php">
		<!-- <button type="submit" class="btn btn-primary">
			<i class="glyphicon glyphicon-upload"></i> <span>Enviar archivos</span>
		</button> -->
		<div id="dz_campo_4611" class="row saia_dz">
			<div class="dz-message"><span>Suelte aquí los archivos adjuntos</span></div>
		</div>
		<div id="dz_campo_4612" class="row saia_dz dropzone-previews">
			<div class="dz-default dz-message"><span>Suelte aquí los archivos adjuntos</span></div>
		</div>
	</form>

</body>
<script type="text/javascript">
var upload_url = "cargar_archivos.php";
var mensaje = "Arrastre aquí los archivos";
Dropzone.autoDiscover = false;
var archivo1 = new Dropzone("div#dz_campo_4611", {
	url: upload_url,
	dictDefaultMessage: mensaje,
	paramName: 'archivo1',
	params: {idformato: 388, idcampo_formato: 4611},
	addRemoveLinks: true,
	dictRemoveFile: "Quitar archivo",
	uploadMultiple: true
});

var archivo2 = new Dropzone("div#dz_campo_4612", {
	url: upload_url,
	paramName: 'archivo2',
	params: {idformato: 388, idcampo_formato: 4612},
	addRemoveLinks: true,
    dictRemoveFile: "Quitar archivo"
});


document.querySelector("div#dz_campo_4611").classList.add('dropzone');
document.querySelector("div#dz_campo_4612").classList.add('dropzone');
</script>
</html>