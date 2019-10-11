<?php
$max_salida = 10;
$ruta_db_superior = $ruta = '';

while ($max_salida > 0) {
    if (is_file($ruta . 'db.php')) {
        $ruta_db_superior = $ruta;
        break;
    }

    $ruta .= '../';
    $max_salida--;
}

include_once $ruta_db_superior . 'assets/librerias.php';
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <img id="img_edit_photo" width="100%">
        </div>
    </div>
    <div class="row">
        <div class="col-12 float-rigth">
            <label class="btn btn-danger">Cargar imagen
                <input type="file" style="display:none" id="file_photo">
            </label>
            <div class="btn btn-complete" id="btn_save_photo">Guardar</div>
        </div>
    </div>
</div>

<link href="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-imgareaselect/css/imgareaselect-default.css" rel="stylesheet" type="text/css" media="screen" />
<script src="<?= $ruta_db_superior ?>assets/theme/assets/plugins/jquery-imgareaselect/scripts/jquery.imgareaselect.js" type="text/javascript"></script>
<script>
    $(function() {
        let baseUrl = '<?= $ruta_db_superior ?>';

        (function init() {
            find();
        })();

        $('#file_photo').on('change', function() {
            var data = new FormData();
            $.each($('#file_photo')[0].files, function(i, file) {
                data.append('image', file);
            });

            $.ajax({
                type: 'POST',
                data: data,
                dataType: 'json',
                url: `${baseUrl}app/funcionario/guardar_imagen.php`,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#img_edit_photo')
                        .hide()
                        .parent()
                        .addClass('progress-circle-indeterminate');
                    window.hideImgAreaSelect();
                    return true;
                },
                success: function(response) {
                    if (response.success) {
                        let route = baseUrl + response.data;
                        $('#img_edit_photo').attr('src', route);
                    } else {
                        top.notification({
                            message: 'Error en la carga!',
                            type: 'error',
                            title: 'Error!'
                        });
                    }
                }
            });
        });

        $('#btn_save_photo').on('click', function() {
            let ias = $('#img_edit_photo').imgAreaSelect({
                instance: true
            });
            let options = ias.getSelection();
            options.imageWidth = $('#img_edit_photo').width();
            options.imageHeight = $('#img_edit_photo').height();

            $.post(
                `${baseUrl}app/funcionario/guardar_recorte.php`,
                options,
                function(response) {
                    if (response.success) {
                        let user = JSON.parse(localStorage.getItem('user'));
                        user.cutedPhoto = response.data.foto_recorte;
                        localStorage.setItem('user', JSON.stringify(user));

                        $('.cuted_photo', parent.document).attr(
                            'src',
                            baseUrl + response.data.foto_recorte
                        );
                        $('#img_edit_photo').attr(
                            'src',
                            baseUrl + response.data.foto_original
                        );
                        window.hideImgAreaSelect();
                        top.closeTopModal();
                    }
                },
                'json'
            );
        });

        $('#img_edit_photo').on('load', function() {
            $('#img_edit_photo')
                .show()
                .parent()
                .removeClass('progress-circle-indeterminate');

            imageAreaSelect();
        });

        function imageAreaSelect() {
            window.hideImgAreaSelect();

            setTimeout(() => {
                $('#img_edit_photo').imgAreaSelect({
                    handles: 'corners',
                    aspectRatio: '1:1',
                    minHeight: 40,
                    x1: 0,
                    y1: 0,
                    x2: 70,
                    y2: 70,
                    persistent: true
                });
            }, 500);
        }

        window.hideImgAreaSelect = function() {
            let ias = $('#img_edit_photo').imgAreaSelect({
                instance: true
            });
            ias.setOptions({
                hide: true
            });
            ias.update();
        }

        function find() {
            $.post(`${baseUrl}app/funcionario/consulta_funcionario.php`, {
                type: 'userInformation',
                key: localStorage.getItem('key'),
                token: localStorage.getItem('token')
            }, function(response) {
                if (response.success) {
                    $("#img_edit_photo").attr("src", baseUrl + response.data.originalPhoto);
                }
            }, 'json');
        }
    });
</script>