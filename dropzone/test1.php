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
	<form action="/file-upload" class="dropzone" id="my-awesome-dropzone"></form>
	<form id="formulario_formatos" action="../pantallas/whatever.php">
		<button type="submit" class="btn btn-primary">
			<i class="glyphicon glyphicon-upload"></i> <span>Enviar archivos</span>
		</button>

		<div id="dz_campo_4611" class="panel panel-default">
		<div class="dz-default dz-message"><span>Suelte aquí los archivos adjuntos</span></div>
		</div>

	</form>

</body>
<script type="text/javascript">
//
//	autoProcessQueue: false,
/*	addedfile: function(archivo){
		alert("Nuevo archivo");
		}
*/
var myDropzone = new Dropzone("div#dz_campo_4611", {
	url: "cargar_archivos.php",
	params: {idformato: 388, idcampo_formato: 4611}
});
/*myDropzone.on("sending", function(file, xhr, formData) {

	// Will sendthe filesize along with the file as POST data.

	 formData.append("idformato", 388);
	 formData.append("idcampo_formato", 4611);

	});*/
console.log(myDropzone);
/*this.on("addedfile", function() {
    // Show submit button here and/or inform user to click it.
  });*/

</script>
</html>