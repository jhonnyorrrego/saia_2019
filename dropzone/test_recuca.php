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
	<form id="formulario_formatos" action="pantallas/hola.php">

		<div id="actions" class="row">

			<div class="col-lg-7">
				<!-- The fileinput-button span is used to style the file input field as button -->
				<span class="btn btn-success fileinput-button dz-clickable"> <i
					class="glyphicon glyphicon-plus"></i> <span>Adicionar archivos...</span>
				</span>
				<button class="btn btn-primary start">
					<i class="glyphicon glyphicon-upload"></i> <span>Iniciar env&iacute;o</span>
				</button>
				<button type="reset" class="btn btn-warning cancel">
					<i class="glyphicon glyphicon-ban-circle"></i> <span>Cancelar env&iacute;o</span>
				</button>
			</div>

			<div class="col-lg-5">
				<!-- The global file processing state -->
				<span class="fileupload-process">
					<div id="total-progress" class="progress progress-striped active"
						role="progressbar" aria-valuemin="0" aria-valuemax="100"
						aria-valuenow="0">
						<div class="progress-bar progress-bar-success" style="width: 0%;"
							data-dz-uploadprogress=""></div>
					</div>
				</span>
			</div>

		</div>

		<div id="dz_campo_4611" class="row">

			<!-- HTML heavily inspired by http://blueimp.github.io/jQuery-File-Upload/ -->
			<div class="table table-striped" class="files" id="previews_4611">

				<div id="template" class="file-row">
					<!-- This is used as the file preview template -->
					<div>
						<span class="preview"><img data-dz-thumbnail /></span>
					</div>
					<div>
						<p class="name" data-dz-name></p>
						<strong class="error text-danger" data-dz-errormessage></strong>
					</div>
					<div>
						<p class="size" data-dz-size></p>
						<div class="progress progress-striped active" role="progressbar"
							aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
							<div class="progress-bar progress-bar-success" style="width: 0%;"
								data-dz-uploadprogress></div>
						</div>
					</div>
					<div>
						<button type="button" class="btn btn-primary startx">
							<i class="glyphicon glyphicon-upload"></i> <span>Enviar</span>
						</button>
						<button type="button" data-dz-remove class="btn btn-warning cancel">
							<i class="glyphicon glyphicon-ban-circle"></i> <span>Cancelar</span>
						</button>
						<button type="button" data-dz-remove class="btn btn-danger delete">
							<i class="glyphicon glyphicon-trash"></i> <span>Eliminar</span>
						</button>
					</div>
				</div>

			</div>
		</div>
	</form>

</body>
<script type="text/javascript">

//Get the template HTML and remove it from the document
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
//console.log(previewTemplate);
previewNode.parentNode.removeChild(previewNode);

var myDropzone = new Dropzone("div#dz_campo_4611", {
  url: "cargar_archivos.php",
  thumbnailWidth: 80,
  thumbnailHeight: 80,
  parallelUploads: 20,
  previewTemplate: previewTemplate,
  autoQueue: false, // Make sure the files aren't queued until manually added
  previewsContainer: "#previews_4611", // Define the container to display the previews
  clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
  params: {idformato: 388, idcampo_formato: 4611}

});

myDropzone.on("addedfile", function(file) {
  // Hookup the start button
  file.previewElement.querySelector(".startx").onclick = function() {
	  var url = myDropzone.resolveOption(myDropzone.options.url, [file]);
	  //alert(myDropzone.options.url);
	  alert(url);
	  myDropzone.enqueueFile(file); };
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
  document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
});

myDropzone.on("sending", function(file) {
  // Show the total progress bar when upload starts
  document.querySelector("#total-progress").style.opacity = "1";
  // And disable the start button
  file.previewElement.querySelector(".startx").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
  document.querySelector("#total-progress").style.opacity = "0";
});

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
  myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
};
document.querySelector("#actions .cancel").onclick = function() {
  myDropzone.removeAllFiles(true);
};

//console.log(myDropzone);

//
//	autoProcessQueue: false,
/*	addedfile: function(archivo){
		alert("Nuevo archivo");
		}
*/
/*var myDropzone = new Dropzone("div#dz_campo_4611", {
	url: "cargar_archivos.php",
	params: {idformato: 388, idcampo_formato: 4611}
});*/
/*myDropzone.on("sending", function(file, xhr, formData) {

	// Will sendthe filesize along with the file as POST data.

	 formData.append("idformato", 388);
	 formData.append("idcampo_formato", 4611);

	});*/
//console.log(myDropzone);
/*this.on("addedfile", function() {
    // Show submit button here and/or inform user to click it.
  });*/

</script>
</html>