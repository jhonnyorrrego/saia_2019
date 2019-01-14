<?php
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Cropper + Dropzone</title>
    <link rel="stylesheet" href="cropper/cropper.min.css">
    <link rel="stylesheet" href="dist/basic.css">
    <link rel="stylesheet" href="dist/dropzone.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">


<style type="text/css">

.dropzone {
	margin: 0 auto;
	border: 3px dashed #247bbb;
	height: 500px;
	width: 1000px;
}

img {
	max-width: 100%;
}
</style>
</head>
<body>
<div style="padding-top: 50px;">
    <form action="upload.php" class="dropzone" id="my-dropzone-container" method="post" enctype="multipart/form-data">
        <div class="fallback">
            <input name="file" type="file">
        </div>
        <div class="dz-message"><span>Seleccionar Imagen</span></div>

    </form>
</div>


<script src="https://code.jquery.com/jquery-2.2.4.min.js"
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="cropper/cropper.js"></script>
<script src="dist/dropzone.js"></script>
<script>
//transform cropper dataURI output to a Blob which Dropzone accepts
var dataURItoBlob = function (dataURI) {
    var byteString = atob(dataURI.split(',')[1]);
    var ab = new ArrayBuffer(byteString.length);
    var ia = new Uint8Array(ab);
    for (var i = 0; i < byteString.length; i++) {
        ia[i] = byteString.charCodeAt(i);
    }
    return new Blob([ab], {type: 'image/jpeg'});
};

Dropzone.autoDiscover = false;
var c = 0;

var myDropzone = new Dropzone("#my-dropzone-container", {
    addRemoveLinks: true,
    parallelUploads: 10,
    uploadMultiple: false,
    maxFiles: 10,
    init: function () {
        this.on('success', function (file) {
            var $button = $('<a href="#" class="js-open-cropper-modal" data-file-name="' + file.name + '">Recortar</a>');
            $(file.previewElement).append($button);
        });
    }
});

$('#my-dropzone-container').on('click', '.js-open-cropper-modal', function (e) {
    e.preventDefault();
    var fileName = $(this).data('file-name');

    var modalTemplate =
        '<div class="modal fade" tabindex="-1" role="dialog">' +
        '<div class="modal-dialog modal-lg" role="document">' +
        '<div class="modal-content">' +
        '<div class="modal-header">' +
        '<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>' +
        '<h4 class="modal-title">Recortar</h4>' +
        '</div>' +
        '<div class="modal-body">' +
        '<div class="image-container">' +
        '<img id="img-' + ++c + '" src="uploads/' + fileName + '">' +
        '</div>' +
        '</div>' +
        '<div class="modal-footer">' +
        '<button type="button" class="btn btn-warning rotate-left"><span class="fa fa-rotate-left"></span></button>' +
        '<button type="button" class="btn btn-warning rotate-right"><span class="fa fa-rotate-right"></span></button>' +
        '<button type="button" class="btn btn-warning scale-x" data-value="-1"><span class="fa fa-arrows-h"></span></button>' +
        '<button type="button" class="btn btn-warning scale-y" data-value="-1"><span class="fa fa-arrows-v"></span></button>' +
        '<button type="button" class="btn btn-warning reset"><span class="fa fa-refresh"></span></button>' +
        '<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>' +
        '<button type="button" class="btn btn-primary crop-upload">Recortar & enviar</button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>';

    var $cropperModal = $(modalTemplate);

    $cropperModal.modal('show').on("shown.bs.modal", function () {
        var cropper = new Cropper(document.getElementById('img-' + c), {
            autoCropArea: 1,
            movable: false,
            cropBoxResizable: true,
            rotatable: true
        });
        var $this = $(this);
        $this
            .on('click', '.crop-upload', function () {
                // get cropped image data
                var blob = cropper.getCroppedCanvas().toDataURL();
                // transform it to Blob object
                var croppedFile = dataURItoBlob(blob);
                croppedFile.name = fileName;

                var files = myDropzone.getAcceptedFiles();
                for (var i = 0; i < files.length; i++) {
                    var file = files[i];
                    if (file.name === fileName) {
                        myDropzone.removeFile(file);
                    }
                }
                myDropzone.addFile(croppedFile);
                $this.modal('hide');
            })
            .on('click', '.rotate-right', function () {
                cropper.rotate(90);
            })
            .on('click', '.rotate-left', function () {
                cropper.rotate(-90);
            })
            .on('click', '.reset', function () {
                cropper.reset();
            })
            .on('click', '.scale-x', function () {
                var $this = $(this);
                cropper.scaleX($this.data('value'));
                $this.data('value', -$this.data('value'));
            })
            .on('click', '.scale-y', function () {
                var $this = $(this);
                cropper.scaleY($this.data('value'));
                $this.data('value', -$this.data('value'));
            });
    });
});

</script>
</body>
</html>